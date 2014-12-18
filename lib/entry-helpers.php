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

/*
	Generates meta for post
*/
if(!function_exists('p1_meta')) :
    function p1_meta() {
    	global $post;

    	echo '<div class="post-meta">';
    	// output time
    	$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day   = get_the_time('d');
        echo '<time class="icon-g-time post-time" datetime="' . get_the_time('c') .'">';
        echo '	<a href="' . get_day_link( $archive_year, $archive_month, $archive_day) . '">' . get_the_time('j (l)') . '</a>, ';
        echo '	<a href="' . get_month_link( $archive_year, $archive_month) . '">' . get_the_time('F') . '</a>, ';
        echo '	<a href="' . get_year_link( $archive_year) . '">' . get_the_time('Y') . '</a>';
        echo '</time>';
        // output link to post author
        echo '<span class="icon-g-author post-author">';
        echo '	<a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author">'. get_the_author() .'</a></span>';
        // output countries if present
        if (get_the_terms( $post->ID, 'countries' )) {
        	echo '<span class="icon-g-place post-countries">';
        	echo '	' . get_the_term_list( $post->ID, 'countries', '', ', ' );
        	echo '</span>';
        }
        echo "</div>";
    }
endif;

/*
	WP wraps all images in <p> tags which is not nice for css
*/
if(!function_exists('filter_ptags_on_images')) :
	function filter_ptags_on_images($content)
	{
	    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
endif; // filter_ptags_on_images

// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'filter_ptags_on_images');
?>