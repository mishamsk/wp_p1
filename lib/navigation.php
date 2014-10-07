<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Customize the output of menus for Foundation top bar
 */

class top_bar_walker extends Walker_Nav_Menu {

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $element->has_children = !empty( $children_elements[$element->ID] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children && $max_depth !== 1 ) ? 'has-dropdown not-click' : '';

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args );

        $output .= ( $depth == 0 ) ? '<li class="divider"></li>' : '';

        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        if( in_array('label', $classes) ) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html );
        }

    if ( in_array('divider', $classes) ) {
        $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
    }

        $output .= $item_html;
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }

}

/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
register_nav_menus(array(
    'top-bar-r' => __( 'Right top bar menu', 'perlovs' ),
    'mobile-off-canvas' => __( 'Mobile Menu', 'perlovs' )
));


/**
 * Right top bar
 */
if ( ! function_exists( 'menu_top_bar_r' ) ) :
	function menu_top_bar_r() {
	    wp_nav_menu(array(
	        'container' => false,                           // remove nav container
	        'container_class' => '',                        // class of container
	        'menu' => '',                                   // menu name
	        'menu_class' => 'top-bar-menu right',           // adding custom nav class
	        'theme_location' => 'top-bar-r',                // where it's located in the theme
	        'before' => '',                                 // before each link <a>
	        'after' => '',                                  // after each link </a>
	        'link_before' => '',                            // before each link text
	        'link_after' => '',                             // after each link text
	        'depth' => 5,                                   // limit the depth of the nav
	        'fallback_cb' => false,                         // fallback function (see below)
	        'walker' => new top_bar_walker()
	    ));
	}
endif; // menu_top_bar_r

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
	        'fallback_cb' => false,                         // fallback function (see below)
	        'walker' => new top_bar_walker()
	    ));
	}
endif; // menu_mobile_off_canvas

/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'add_menuclass') ) {
	function add_menuclass($ulclass) {
	    $find = array('/<a rel="button"/', '/<a title=".*?" rel="button"/');
	    $replace = array('<a rel="button" class="button"', '<a rel="button" class="button"');

	    return preg_replace($find, $replace, $ulclass, 1);
	}
	add_filter('wp_nav_menu','add_menuclass');
}

/**
 * Display breadcrumbs
 * @visibility - wrapper class (defaults to show-for-medium-up)
*/
if ( ! function_exists( 'p1_breadcrumbs') ) :
	function p1_breadcrumbs($visibility = 'show-for-medium-up') {
	    $links = explode('|',get_the_category_list('|', 'multiple'));
	    $links = implode(preg_replace("(rel=\"category.*\")", "$1 class=\"current\"", $links));

	    echo '<nav id="breadcrumbs" class="breadcrumbs ' . $visibility . '">';
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
		    'prev_text' => __('&laquo;', 'perlovs'),
		    'next_text' => __('&raquo;', 'perlovs'),
			'type' => 'array'
		) );

		if ( $paginate_links ) {
			// if more than 1 page, replace elements and classes, display pagination

			echo '<div id="pagination" class="pagination-centered">';
			echo '	<ul class="pagination" role="menubar" aria-label="Pagination">';

			if (1 == max( 1, get_query_var('paged') )) // if first page - add disabled left quotes
				echo '		<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&laquo;', 'perlovs') . '</a></li>';

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
				echo '		<li class="arrow unavailable" aria-disabled="true"><a href="#">' . __('&raquo;', 'perlovs') . '</a></li>';
			echo '	</ul>';
			echo '</div><!--// end .pagination -->';
		}
	}
endif; // p1_pagination

?>