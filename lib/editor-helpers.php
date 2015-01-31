<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Helper functions for editor
*
*/

add_filter('tiny_mce_before_init', 'perlovs_add_styles_tinymce');
if(!function_exists('perlovs_add_styles_tinymce')) :
    /*
        WP wraps all images in <p> tags, add special class for styling
    */
    function perlovs_add_styles_tinymce($init)
    {
        $style_formats = array(
            // small format
            array(
                'title' => __('Small text', 'perlovs'),
                'inline' => 'small',
            ),
        );
        // Insert the array, JSON ENCODED, into 'style_formats'
        $init['style_formats'] = json_encode( $style_formats );
        $init['style_formats_merge'] = 'true';

        $init['extended_valid_elements'] = 'small';

        $init['menubar'] = true;

        return $init;
    }
endif; // perlovs_add_styles_tinymce

?>