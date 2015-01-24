<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Helper functions for the front page
*
*/

if(!function_exists('perlovs_get_bg_image_style')) :
    /*
        Echoes style="background-image: ..." with latest post in given category featured image
    */
    function perlovs_get_bg_image_style($category_name, $size = 'full') {
    	$args = array(  'numberposts' => 1,
                        'post_status' => 'publish',
                        'category_name' => $category_name,
                        'meta_key' => '_thumbnail_id'
                    );
        $recent_posts = wp_get_recent_posts( $args, OBJECT );
        $post_id = $recent_posts[0]->ID;
        $bg_image = '';

        if ( get_the_post_thumbnail( $post_id, $size )) {
            $bg_image = get_the_post_thumbnail( $post_id, $size );
            $preg_ar = array();
            preg_match('/src="([^"]*)"/i', $bg_image, $preg_ar);
            $bg_image = 'background-image: url(' . $preg_ar[1] . ');';
        }

        if ( $bg_image != '' ) echo 'style="' . $bg_image . '"';
    }
endif; // perlovs_get_bg_image_style

?>