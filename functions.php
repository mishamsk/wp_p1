<?php
/**
 * Defining constants
 */
define( 'PERLOVS_THEME_URL', get_template_directory_uri() );
define( 'PERLOVS_THEME_TEMPLATE', get_stylesheet_directory() );
define( 'PERLOVS_FF_CATEGORY_SLUG', 'friends-family');
define( 'PERLOVS_TRAVEL_CATEGORY_SLUG', 'travel');

/**
 * Includes
 */

// Navigation menus, walker func, breadcrumbs, pagination
require_once('lib/navigation.php');

// Social partials
require_once('lib/social-share.php');

// Helper functions for single blog entries and pages
require_once('lib/entry-helpers.php');

// Helper functions for the front page
require_once('lib/front-page-helpers.php');

// Travel taxonomies
require_once('lib/travel.php');

// Travel taxonomies
require_once('lib/search-func.php');

// Theme options
require_once('lib/theme-options.php');

// Helper functions for editor
require_once('lib/editor-helpers.php');

// Responsive images settings and functions
require_once('lib/responsive-images.php');

/**
 * Functions
 */

add_action( 'after_setup_theme', 'perlovs_setup' );
if ( ! function_exists( 'perlovs_setup' ) ) :
/**
 * Theme support, cleanup, textdomain
 *
 * This function is attached to the 'after_setup_theme' action hook.
 */
function perlovs_setup() {
	load_theme_textdomain( 'perlovs', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for archive pages
	add_theme_support( 'post-thumbnails' );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form') );

	// Add menu support
    add_theme_support('menus');

    // Editor styles
    add_editor_style( 'editor-style.css' );
    add_editor_style( str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:400,300,700&subset=latin,cyrillic') );

    // -------
    // CleanUp
    // -------

    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );

    // Category feed links
    remove_action( 'wp_head', 'feed_links_extra', 3 );

    // Post and comment feed links
    remove_action( 'wp_head', 'feed_links', 2 );

    // Windows Live Writer
    remove_action( 'wp_head', 'wlwmanifest_link' );

    // Index link
    remove_action( 'wp_head', 'index_rel_link' );

    // Previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

    // Start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

    // Canonical
    remove_action('wp_head', 'rel_canonical', 10, 0 );

    // Shortlink
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

    // Links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    // WP version
    remove_action( 'wp_head', 'wp_generator' );

    // Disqus lazy load
    remove_action('wp_footer', 'dsq_output_footer_comment_js');

    // Global vars for blog separation and such
    global $perlovs_ff_category_id, $perlovs_travel_category_id;
    $perlovs_ff_category_id = get_category_by_slug(PERLOVS_FF_CATEGORY_SLUG)->term_id;
    $perlovs_travel_category_id = get_category_by_slug(PERLOVS_TRAVEL_CATEGORY_SLUG)->term_id;

}
endif; // perlovs_setup

add_filter( 'script_loader_src', 'perlovs_cache_busting' );
add_filter( 'style_loader_src', 'perlovs_cache_busting' );
if ( ! function_exists( 'perlovs_cache_busting' ) ) :
/**
 * Adds md5 hash to js and css filenames
 */
function perlovs_cache_busting( $src ) {
    // Don't touch admin scripts.
    if ( is_admin() ) {
        return $src;
    }

    $_src = $src;
    if ( '//' === substr( $_src, 0, 2 ) ) {
        $_src = 'http:' . $_src;
    }

    $_src = parse_url( $_src );

    // Give up if malformed URL.
    if ( false === $_src ) {
        return $src;
    }

    // Check if it's a local URL.
    $wp = parse_url( home_url() );
    if ( isset( $_src['host'] ) && $_src['host'] !== $wp['host'] ) {
        return $src;
    }

    $hash = md5(dirname( __FILE__ ) . $_src['path']);

    return preg_replace(
        '/\.(js|css).*$/',
        '\.' . $hash . '\.$1',
        $src
    );
}
endif; // perlovs_cache_busting

add_action( 'wp_enqueue_scripts', 'perlovs_scripts' );
if ( ! function_exists( 'perlovs_scripts' ) ) :
/**
 * Load all JavaScript to header& footer, load styles
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 */
function perlovs_scripts() {
	// deregister the jquery version bundled with wordpress
    wp_deregister_script( 'jquery' );

	// register help scripts
    // wp_register_script( 'jquery', PERLOVS_THEME_URL . '/bower_components/jquery/dist/jquery.min.js' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), null, true );

	// enqueue head scripts
    // if(!is_front_page()) {
    //     wp_enqueue_script( 'modernizr', PERLOVS_THEME_URL .'/js/modernizr/modernizr.perlovs.js', array(), null, false );
    // }

	// enqueue footer scripts
	//wp_enqueue_script( 'jq', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/jquery.js', array(), null, true );
	//wp_enqueue_script( 'fnd', PERLOVS_THEME_URL . '/bower_components/foundation/js/foundation.min.js', array( 'jq' ), null, true );
	//wp_enqueue_script( 'fastclick', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/fastclick.js', array(), null, true );
	//wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/app.js', array( 'jq', 'fnd', 'fastclick' ), null, true );
    if(is_front_page()) {
        wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/min/app-front-min.js', array(), null, true );
    }
    else {
        wp_register_script( 'theme_js', PERLOVS_THEME_URL .'/js/min/app-min.js', array('jquery'), null, true );
        perlovs_gmaps_localize('theme_js');
        wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/min/app-min.js', array('jquery'), null, true );
    }

	// enqueue style
    wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700&subset=latin,cyrillic', array(), null );
    wp_enqueue_style( 'google_hfonts', 'http://fonts.googleapis.com/css?family=Dancing+Script:700&text=' . urldecode("Perlov's"), array(), null );
    if(is_front_page()) {
        wp_enqueue_style( 'theme_stylesheet', PERLOVS_THEME_URL .'/style-front.css', array('google_fonts','google_hfonts'), null );
    }
    else {
        wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri(), array('google_fonts','google_hfonts'), null );
    }
}
endif; // perlovs_scripts

add_filter( 'wp_title', 'perlovs_wp_title_for_home' );
if ( ! function_exists( 'perlovs_wp_title_for_home' ) ) :
/**
 * Adjust home title
 */
function perlovs_wp_title_for_home( $title )
{
    if( empty( $title ) && ( is_home() || is_front_page() ) ) {
        return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
    }
    return $title;
}
endif; // perlovs_wp_title_for_home

add_filter('user_contactmethods', 'perlovs_add_user_contactdata');
if ( ! function_exists( 'perlovs_add_user_contactdata' ) ) :
/**
 * Comment
 */
function perlovs_add_user_contactdata( $user_contact )
{
    /* Add user contact methods */
    $user_contact['facebook'] = __('Facebook Username', 'perlovs');
    $user_contact['twitter'] = __('Twitter Username', 'perlovs');
    $user_contact['instagram'] = __('Instagram Username', 'perlovs');
    $user_contact['linkedin'] = __('Linkedin Username', 'perlovs');
    $user_contact['vk'] = __('Vkontakte Username', 'perlovs');
    $user_contact['google-plus'] = __('Google+ Username', 'perlovs');

    /* Remove user contact methods */
    unset($user_contact['aim']);
    unset($user_contact['jabber']);

    return $user_contact;
}
endif; // perlovs_add_user_contactdata

