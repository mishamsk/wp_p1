<?php
/**
 * Defining constants
 *
 * @since 0.0.1
 */
define( 'PERLOVS_THEME_URL', get_template_directory_uri() );
define( 'PERLOVS_THEME_TEMPLATE', get_stylesheet_directory() );

/**
 * Includes
 *
 * @since 0.0.1
 */

add_action( 'after_setup_theme', 'perlovs_setup' );
if ( ! function_exists( 'perlovs_setup' ) ) :
/**
 * Initial setup
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses	load_theme_textdomain()
 *
 * @since 0.0.1
 */
function perlovs_setup() {
	load_theme_textdomain( 'perlovs', PERLOVS_THEME_TEMPLATE . '/languages' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'perlovs' ) );

	// This theme uses Featured Images (also known as post thumbnails) for archive pages
	add_theme_support( 'post-thumbnails' );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // perlovs_setup

add_action( 'wp_enqueue_scripts', 'perlovs_scripts' );
if ( ! function_exists( 'perlovs_scripts' ) ) :
/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 *
 * @since 0.0.1
 */
function perlovs_scripts() {
	// register help scripts
	//wp_register_script( 'jq', PERLOVS_THEME_URL . '/bower_components/jquery/dist/jquery.min.js' );

	// enqueue head scripts
	wp_enqueue_script( 'modernizr', PERLOVS_THEME_URL .'/bower_components/foundation/js/vendor/modernizr.js', array(), null, false );

	// enqueue footer scripts
	wp_enqueue_script( 'jq', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/jquery.js', array(), null, true );
	wp_enqueue_script( 'fnd', PERLOVS_THEME_URL . '/bower_components/foundation/js/foundation.min.js', array( 'jq' ), null, true );
	wp_enqueue_script( 'fastclick', PERLOVS_THEME_URL . '/bower_components/foundation/js/vendor/fastclick.js', array(), null, true );
	wp_enqueue_script( 'theme_js', PERLOVS_THEME_URL .'/js/app.js', array( 'jq', 'fnd', 'fastclick' ), null, true );

	// enqueue style
	wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri(), array(), null );
}
endif; // perlovs_add_js