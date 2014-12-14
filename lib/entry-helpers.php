<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Helper functions for single blog entries and pages
*
*/
if(!function_exists('p1_meta')) :
    function p1_meta() {
        echo '<time class="updated" datetime="'. get_the_time('c') .'">'. sprintf(__('Posted on %s at %s.', 'FoundationPress'), get_the_time('l, F jS, Y'), get_the_time()) .'</time>';
        echo '<p class="byline author">'. __('Written by', 'FoundationPress') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
    }
endif;

if(!function_exists('filter_ptags_on_images')) :
	/*
		WP wraps all images in <p> tags which is not nice for css
	*/
	function filter_ptags_on_images($content)
	{
	    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
endif; // filter_ptags_on_images

// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'filter_ptags_on_images');
?>