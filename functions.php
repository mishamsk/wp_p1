<?php
/**
 * Defining constants
 */
define( 'PERLOVS_THEME_URL', get_template_directory_uri() );
define( 'PERLOVS_THEME_TEMPLATE', get_stylesheet_directory() );

/**
 * Includes
 */

// Required for Foundation to work properly
//require_once('library/foundation.php');

// Navigation menus, walker func, breadcrumbs, pagination
require_once('lib/navigation.php');

// Add menu walker
require_once('lib/social-share.php');

// Helper func for posts: meta
require_once('lib/entry-helpers.php');


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

    // CleanUp

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
}
endif; // perlovs_setup

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
	wp_register_script( 'jquery', PERLOVS_THEME_URL . '/bower_components/jquery/dist/jquery.min.js' );

	// enqueue head scripts
	wp_enqueue_script( 'modernizr', PERLOVS_THEME_URL .'/bower_components/foundation/js/vendor/modernizr.js', array(), null, false );

	// enqueue footer scripts
	//wp_enqueue_script( 'jq', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/jquery.js', array(), null, true );
	//wp_enqueue_script( 'fnd', PERLOVS_THEME_URL . '/bower_components/foundation/js/foundation.min.js', array( 'jq' ), null, true );
	//wp_enqueue_script( 'fastclick', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/fastclick.js', array(), null, true );
	//wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/app.js', array( 'jq', 'fnd', 'fastclick' ), null, true );
	wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/min/app-min.js', array(), null, true );

	// enqueue style
	wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri(), array(), null );
}
endif; // perlovs_scripts

add_filter( 'wp_title', 'perlovs_wp_title_for_home' );
if ( ! function_exists( 'perlovs_wp_title_for_home' ) ) :
/**
 * Load all JavaScript to header& footer, load styles
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 */
function perlovs_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}
endif; // perlovs_wp_title_for_home