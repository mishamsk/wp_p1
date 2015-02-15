<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Responsive images settings and functions
*
*/

if(defined('PICTUREFILL_WP_VERSION') && '2' === substr(PICTUREFILL_WP_VERSION, 0, 1)){
    add_action('picturefill_wp_before_replace_images', 'perlovs_deregister_picturefill_js');
    if ( ! function_exists( 'perlovs_deregister_picturefill_js' ) ) :
    /**
     * Deregister picturefill js before plugin enqueues is since we minified it as apart of single app script
     */
    function perlovs_deregister_picturefill_js(  )
    {
        wp_deregister_script( 'picturefill' );
    }
    endif; // perlovs_deregister_picturefill_js

    add_action('picturefill_wp_register_srcset', 'perlovs_register_theme_sizes');
    if ( ! function_exists( 'perlovs_register_theme_sizes' ) ) :
    /**
     * Register sizes accroding to site breakpoints
     */
    function perlovs_register_theme_sizes(){
        picturefill_wp_register_sizes('perlovs-img-sizes', '(max-width: 61.25em) calc(100vw - 1em), 60em', 'full');
        picturefill_wp_register_sizes('perlovs-img-sizes', '(max-width: 61.25em) calc(100vw - 1em), 60em', 'medium');
        picturefill_wp_register_sizes('perlovs-img-sizes', '(max-width: 61.25em) calc(100vw - 1em), 60em');
        picturefill_wp_register_srcset('perlovs-img-srcset', array('medium', 'full'), 'full');
        picturefill_wp_register_srcset('perlovs-img-srcset', array('medium', 'full'), 'medium');
        picturefill_wp_register_srcset('perlovs-img-srcset', array('medium', 'full'));
    }
    endif; // perlovs_register_theme_sizes


}

?>