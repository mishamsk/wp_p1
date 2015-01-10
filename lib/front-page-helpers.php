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
    	$args = array( 'numberposts' => 1, 'post_status' => 'publish', 'category_name' => $category_name);
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

    echo '<div id="author-' . $author_login . '" class="card author-card">';
    echo '  <a href="' . $url . '">';
    echo '      <img class="author-avatar" src="' . $avatar . '" width="200px" height="200px">';
    echo '  </a>';
    echo '  <h1 class="author-name"><a href="' . $url . '">'. $name . '</a></h1>';

    if (!empty($bio)) {
        echo '  <h6 class="author-bio-header">Обо мне</h6>';
        echo '  <p class="author-bio">' . $bio . '</p>';
    }

    echo '  <h6 class="author-contacts-header">Связаться со мной</h6>';
    echo '  <div id="author-contacts-' . $author_login . '" class="author-contacts-bar">';

    foreach ($contacts as $contact => $link) {
        $contact = $contact != 'google_plus' ? $contact : 'google-plus';
        if (!empty($link)) {
            echo '      <a class="social-' . $contact . '" rel="external nofollow" href="' . $link . '" target="_blank" title="Я в ' . ucfirst($contact) . '!">';
            echo $contact == 'email' ? '          <i class="icon-at-sign"></i>' : '          <i class="icon-social-' . $contact . '"></i>';
            echo '      </a>';
        }
    }
    echo '  </div> <!-- #author-contacts -->';
    echo '  <a class="author-blog-link" href="' . $url . '">Мой блог</a>';
    echo '</div> <!-- #author-' . $author_login . ' -->';
}
endif; // perlovs_get_author_card










?>