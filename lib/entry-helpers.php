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

if ( ! function_exists( 'perlovs_get_author_card' ) ) :
/**
 * Returns author card for front-page with contact info
 */
function perlovs_get_author_card( $author_login )
{
    $id = get_user_by( 'login', $author_login )->ID;
    $url = get_author_posts_url($id);
    $avatar = get_stylesheet_directory_uri() . '/img/' . $author_login . '-avatar.jpg';
    $name = get_the_author_meta( 'display_name' , $id );
    $bio = get_the_author_meta( 'description' , $id );
    $email = 'mailto:' . urlencode(get_the_author_meta( 'user_email' , $id ));
    if (get_the_author_meta( 'facebook' , $id ) != '') $facebook =  'https://www.facebook.com/' . get_the_author_meta( 'facebook' , $id ) ; else $facebook = '';
    if (get_the_author_meta( 'twitter' , $id ) != '') $twitter =  'https://twitter.com/' . get_the_author_meta( 'twitter' , $id ) ; else $twitter = '';
    if (get_the_author_meta( 'instagram' , $id ) != '') $instagram =  'http://instagram.com/' . get_the_author_meta( 'instagram' , $id ) ; else $instagram = '';
    if (get_the_author_meta( 'linkedin' , $id ) != '') $linkedin =  'https://www.linkedin.com/in/' . get_the_author_meta( 'linkedin' , $id ) ; else $linkedin = '';
    if (get_the_author_meta( 'vk' , $id ) != '') $vk =  'http://vk.com/' . get_the_author_meta( 'vk' , $id ) ; else $vk = '';
    if (get_the_author_meta( 'google-plus' , $id ) != '') $google_plus =  'https://www.google.com/' . get_the_author_meta( 'google_plus' , $id ) ; else $google_plus = '';
    $contacts = compact('facebook', 'twitter', 'instagram', 'linkedin', 'vk', 'google_plus', 'email');

    echo '<div id="author-' . $author_login . '" class="author-card">';
    echo '  <a href="' . $url . '">';
    echo '      <img class="author-avatar" src="' . $avatar . '" width="200px" height="200px">';
    echo '  </a>';
    echo '  <h1 class="author-name"><a href="' . $url . '">'. $name . '</a></h1>';

    if (!empty($bio)) {
        echo '  <h6 class="author-bio-header">Обо мне</h6>';
        echo '  <p class="author-bio">' . $bio . '</p>';
    }

    echo '  <div class="author-contacts-container">';
    echo '      <h6 class="author-contacts-header">Связаться со мной</h6>';
    echo '      <div id="author-contacts-' . $author_login . '" class="author-contacts-bar">';

    foreach ($contacts as $contact => $link) {
        $contact = $contact != 'google_plus' ? $contact : 'google-plus';
        if (!empty($link)) {
            echo '          <a class="social-' . $contact . '" rel="external nofollow" href="' . $link . '" target="_blank" title="Я в ' . ucfirst($contact) . '!">';
            echo $contact == 'email' ? '            <i class="icon-at-sign"></i>' : '          <i class="icon-social-' . $contact . '"></i>';
            echo '          </a>';
        }
    }
    echo '      </div> <!-- #author-contacts -->';
    echo '  </div> <!-- .author-contacts-container -->';
    echo '  <a class="author-blog-link" href="' . $url . '">Мой блог</a>';
    echo '</div> <!-- #author-' . $author_login . ' -->';
}
endif; // perlovs_get_author_card

add_filter('the_content', 'filter_ptags_on_images');
if(!function_exists('filter_ptags_on_images')) :
    /*
        WP wraps all images in <p> tags, add special class for styling
    */
	function filter_ptags_on_images($content)
	{
	    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '<p class="image-container">\1\2\3<p>', $content);
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