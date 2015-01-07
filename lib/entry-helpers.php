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
if(!function_exists('perlovs_meta')) :
    function perlovs_meta() {
    	global $post;

        $need_divider = false;

        if (!is_date()) {
        	// output time
        	$archive_year  = get_the_time('Y');
    		$archive_month = get_the_time('m');
    		$archive_day   = get_the_time('d');
            echo '<time class="icon-g-time post-time" datetime="' . get_the_time('c') .'">';
            echo '	<a href="' . get_day_link( $archive_year, $archive_month, $archive_day) . '">' . get_the_time('j') . '</a>, ';
            echo '	<a href="' . get_month_link( $archive_year, $archive_month) . '">' . get_the_time('F') . '</a>, ';
            echo '	<a href="' . get_year_link( $archive_year) . '">' . get_the_time('Y') . '</a>';
            echo '</time>';

            $need_divider = true;
        }
        if (!is_author()) {
            // divider to allow white-space wrap
            if ($need_divider) echo '<span> </span>';
            // output link to post author
            echo '<span class="icon-g-author post-author">';
            echo '	<a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author">'. get_the_author() .'</a></span>';

            $need_divider = true;
        }
        // output countries if present
        if (get_the_terms( $post->ID, 'countries' ) && !is_tax('countries') ) {
            // divider to allow white-space wrap
            if ($need_divider) echo '<span> </span>';
            // output country link
        	echo '<span class="icon-g-place post-countries">';
        	echo '	' . get_the_term_list( $post->ID, 'countries', '', ', ' );
        	echo '</span>';
        }
    }
endif;

add_filter('the_content', 'filter_ptags_on_images');
if(!function_exists('filter_ptags_on_images')) :
    /*
        WP wraps all images in <p> tags which is not nice for css
    */
	function filter_ptags_on_images($content)
	{
	    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
endif; // filter_ptags_on_images

add_filter( 'the_title', 'add_default_title', 10, 2 );
if ( ! function_exists( 'add_default_title' ) ) :
/**
 * Add default title to posts without one
 */
function add_default_title( $title, $id = null )
{
    return $title ? $title : __('No title', 'perlovs');
}
endif; // add_default_title

add_filter( 'the_content_more_link', 'remove_more_link_scroll' );
if ( ! function_exists( 'remove_more_link_scroll' ) ) :
/**
 * Remove hash at more url
 */
function remove_more_link_scroll( $link ) {
    $link = preg_replace( '|#more-[0-9]+|', '', $link );
    return $link;
}
endif; // remove_more_link_scroll

add_filter( 'the_content_more_link', 'modify_read_more_link' );
if ( ! function_exists( 'modify_read_more_link' ) ) :
/**
 * Make pretty more link + add class for styling + add id for analytics
 */
function modify_read_more_link() {
    return '';
    // return '<a class="more-link" id="more-' .  get_the_ID() . '" href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . __('Continue reading...', 'perlovs') . '</a>';
}
endif; // modify_read_more_link

add_filter('excerpt_more', 'modify_excerpt_more');
if ( ! function_exists( 'modify_excerpt_more' ) ) :
/**
 * Make pretty more link + add class for styling + add id for analytics
 */
function modify_excerpt_more($more) {
    return '...';
    // global $post;
    // return '...<a class="more-link" id="more-' .  $post->ID . '" href="' . get_permalink($post->ID) . '" title="' . the_title_attribute( array('echo' => '0', 'post' => $post->ID )) . '">' . __('Continue reading...', 'perlovs') . '</a>';
}
endif; // modify_excerpt_more

?>