<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Various navigation functions (menu walkers, breadcrumbs, pagination)
*
*/

/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
register_nav_menus(array(
    'mobile-off-canvas' => __( 'Mobile Menu', 'perlovs' )
));

/**
 * Mobile off-canvas
 */
if ( ! function_exists( 'menu_mobile_off_canvas' ) ) :
	function menu_mobile_off_canvas() {
	    wp_nav_menu(array(
	        'container' => false,                           // remove nav container
	        'container_class' => '',                        // class of container
	        'menu' => '',                                   // menu name
	        'menu_class' => 'off-canvas-list',              // adding custom nav class
	        'theme_location' => 'mobile-off-canvas',        // where it's located in the theme
	        'before' => '',                                 // before each link <a>
	        'after' => '',                                  // after each link </a>
	        'link_before' => '',                            // before each link text
	        'link_after' => '',                             // after each link text
	        'depth' => 5,                                   // limit the depth of the nav
	        'fallback_cb' => false                         // fallback function (see below)
	        //'walker' => new top_bar_walker()
	    ));
	}
endif; // menu_mobile_off_canvas

/**
 * Display breadcrumbs
 * @visibility - wrapper class (defaults to all)
*/
if ( ! function_exists( 'p1_breadcrumbs') ) :
	function p1_breadcrumbs($visibility = '') {
		global $post;

		// Travel posts/lists
		if (get_the_terms( $post->ID, 'travel' )) {
			$travel = array_pop(get_the_terms( $post->ID, 'travel' ));
			$links = '<a href="' . esc_url( home_url( '/' ) ) . 'travel">' . __('Travel', 'perlovs') . '</a>';
			$links .= '<span class="divider"></span><a href="' . get_term_link( $travel ) . '">' . $travel->name . '</a>';
		}
		// Single post, not travel
		elseif (is_single()) {
			$links = get_the_category_list('<span class="divider"></span>', 'multiple');
		}

		// Append home link
		$links = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . __('Home', 'perlovs') . '</a><span class="divider"></span>' . $links;

	    echo '<nav class="breadcrumbs ' . $visibility . '">';
		echo $links;
		echo '</nav><!--// end .breadcrumbs -->';
	}
endif; // p1_breadcrumbs

/**
 * Display pagination
*/
if ( ! function_exists( 'p1_pagination') ) :
	function p1_pagination() {
		global $wp_query;

		$big = 999999999; // This needs to be an unlikely integer

		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 2,
			'prev_next' => True,
		    'prev_text' => __('&lt;', 'perlovs'),
		    'next_text' => __('&gt;', 'perlovs'),
			'type' => 'array'
		) );

		if ( $paginate_links ) {
			// if more than 1 page, replace elements and classes, display pagination

			echo '<div id="pagination" class="pagination-centered">';
			echo '<ul class="pagination" role="menubar" aria-label="Pagination">';

			if (1 == max( 1, get_query_var('paged') )) // if first page - add disabled left quotes
				echo '<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&lt;', 'perlovs') . '</a></li>';

			foreach ($paginate_links as $link) {
				// replace for current page
				$link = str_replace( "<span class='page-numbers current'>", '<li class="current"><a href="#">', $link );
				// replace for dots
				$link = str_replace( '<span class="page-numbers dots">' . __( '&hellip;' ), '<li class="unavailable" aria-disabled="true"><a href="#">' . __( '&hellip;', 'perlovs' ), $link );
				$link = str_replace( "</span>", "</a>", $link );

				// replace for normal numbers
				$link = str_replace( "<a class='page-numbers'", '<li><a ', $link );
				// replace for active arrows
				$link = str_replace( '<a class="prev page-numbers"', '<li class="arrow"><a ', $link );
				$link = str_replace( '<a class="next page-numbers"', '<li class="arrow"><a ', $link );

				echo $link . '</li>';
			}

	  		if ($wp_query->max_num_pages == get_query_var('paged')) // if last page - add disabled right quotes
				echo '<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&gt;', 'perlovs') . '</a></li>';
			echo '	</ul>';
			echo '</div><!--// end .pagination -->';
		}
	}
endif; // p1_pagination

/**
 * Display single post pagination
*/
if ( ! function_exists( 'p1_single_pagination') ) :
	function p1_single_pagination() {
		global $wp_query, $multipage, $page, $numpages, $post;

		echo '<div class="row footer-nav">';

		$previous = '<div class="columns small-12 medium-4"><h5 class="previous-post-link small-text-center medium-text-left">%link</h5></div>';
		$next = '<div class="columns small-12 medium-4"><h5 class="next-post-link small-text-center medium-text-right">%link</h5></div>';
		// Travel posts/lists
		if (get_the_terms( $post->ID, 'travel' )) {
			previous_post_link( $previous, '&lt;&lt; %title', true, '', 'travel' );
		}
		else {
			$travel_terms = get_terms( 'travel', array('fields' => 'ids') );
			previous_post_link( $previous, '&lt;&lt; %title', false, $travel_terms);
		}

		if ($multipage) {
			echo '<div class="columns small-12 medium-4"><div id="pagination" class="pagination-centered">';
			echo '<ul class="pagination" role="menubar" aria-label="Pagination">';

			if ($page > 1) // if first page - add disabled left quotes, else calculate prevous page
				echo '<li class="arrow" aria-disabled="true">' . _wp_link_page( $page - 1 ) . __('&lt;', 'perlovs') . '</a></li>';
			else
				echo '<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&lt;', 'perlovs') . '</a></li>';

			for ( $i = 1; $i <= $numpages; $i++ ) {
				if ( $i != $page )
					echo '<li>' . _wp_link_page( $i ) . $i . '</a></li>';
				else
					echo '<li class="current">' . _wp_link_page( $i ) . $i . '</a></li>';
			}

	  		if ($page != $numpages) // if last page - add disabled right quotes, else calculate next page
				echo '<li class="arrow" aria-disabled="true">' . _wp_link_page( $page + 1 ) . __('&gt;', 'perlovs') . '</a></li>';
			else
				echo '<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&gt;', 'perlovs') . '</a></li>';
			echo '</ul>';
			echo '</div><!--// end .pagination -->';
			echo '</div><!--// end .columns -->';
		}

		// Travel posts/lists
		if (get_the_terms( $post->ID, 'travel' )) {
			next_post_link( $next, '%title &gt;&gt;', true, '', 'travel' );
		}
		else {
			$travel_terms = get_terms( 'travel', array('fields' => 'ids') );
			next_post_link( $next, '%title &gt;&gt;', false, $travel_terms);
		}

		echo '</div><!--// end .row -->';
	}
endif; // p1_single_pagination

?>