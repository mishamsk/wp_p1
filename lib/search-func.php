<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Search realted functions
*
*/


/**
 * Function to display search-form (with options)
*/
if ( ! function_exists( 'perlovs_searchform') ) :
	function perlovs_searchform($form_classes = '', $id = NULL, $post_filter = 'post', $search_label_text = NULL, $search_placeholder_text = NULL, $search_submit_text = NULL) {

		if (is_null($search_label_text)) $search_label_text = __( 'Search', 'perlovs' );
		if (is_null($search_placeholder_text)) $search_placeholder_text = __( 'Type in and hit enter...', 'perlovs' );
		if (is_null($search_submit_text)) $search_submit_text = __( 'Go!', 'perlovs' );

		echo '<form role="search" method="get"' . ($id ? 'id="' . $id . '"' : '') . 'class="search-form ' . $form_classes . '" action="' . home_url( '/' ) . '">';
		echo '	<p class="search-label">' . $search_label_text . '</p>';
		echo '	<div class="search-inner-container">';
		echo '		<input type="text" class="search-field" placeholder="' . $search_placeholder_text . '" value="" name="s" />';
		echo '		<input type="hidden" value="' . $post_filter . '" name="post_type" id="post_type" />';
		echo '		<input type="submit" class="search-submit" value="' . $search_submit_text . '" />';
		echo '	</div>';
		echo '</form>';
	}
endif; // perlovs_searchform

?>