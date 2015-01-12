<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Travel taxonomies and post types
*
*/

// hook into the init action and call create_travel_taxonomies when it fires
add_action( 'init', 'create_travel_taxonomies', 0 );

// create two taxonomies, for trips and countries for the travel posts
function create_travel_taxonomies() {
	// travel-trips
	$labels = array(
		'name'              			=> _x( 'Travel', 'taxonomy general name', 'perlovs' ),
		'singular_name'     			=> _x( 'Trip', 'taxonomy singular name', 'perlovs' ),
		'search_items'      			=> __( 'Search for Trips', 'perlovs' ),
		'popular_items'              	=> __( 'Popular Trips', 'perlovs' ),
		'all_items'         			=> __( 'All Trips', 'perlovs' ),
		'parent_item'       			=> null,
		'parent_item_colon' 			=> null,
		'edit_item'         			=> __( 'Edit Trip', 'perlovs' ),
		'update_item'       			=> __( 'Update Trip', 'perlovs' ),
		'add_new_item'      			=> __( 'Add New Trip', 'perlovs' ),
		'new_item_name'     			=> __( 'New Trip Name', 'perlovs' ),
		'separate_items_with_commas' 	=> __( 'Separate trips with commas', 'perlovs' ),
		'add_or_remove_items'        	=> __( 'Add or remove trips', 'perlovs' ),
		'choose_from_most_used'      	=> __( 'Choose from the most used trips', 'perlovs' ),
		'not_found'                  	=> __( 'No trips found.', 'perlovs' ),
		'menu_name'         			=> __( 'Travel', 'perlovs' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => false,
		//'rewrite'           => array( 'slug' => 'travel' ),
	);

	register_taxonomy( 'travel', array( 'post' ), $args );

	// Countries
	$labels = array(
		'name'              			=> _x( 'Countries', 'taxonomy general name', 'perlovs' ),
		'singular_name'     			=> _x( 'Country', 'taxonomy singular name', 'perlovs' ),
		'search_items'      			=> __( 'Search for Countries', 'perlovs' ),
		'popular_items'              	=> __( 'Popular Countries', 'perlovs' ),
		'all_items'         			=> __( 'All Countries', 'perlovs' ),
		'parent_item'       			=> null,
		'parent_item_colon' 			=> null,
		'edit_item'         			=> __( 'Edit Country', 'perlovs' ),
		'update_item'       			=> __( 'Update Country', 'perlovs' ),
		'add_new_item'      			=> __( 'Add New Country', 'perlovs' ),
		'new_item_name'     			=> __( 'New Country Name', 'perlovs' ),
		'separate_items_with_commas' 	=> __( 'Separate countries with commas', 'perlovs' ),
		'add_or_remove_items'        	=> __( 'Add or remove countries', 'perlovs' ),
		'choose_from_most_used'      	=> __( 'Choose from the most common countries', 'perlovs' ),
		'not_found'                  	=> __( 'No countries found.', 'perlovs' ),
		'menu_name'         			=> __( 'Countries', 'perlovs' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => false,
		//'rewrite'           => array( 'slug' => 'travel' ),
	);

	register_taxonomy( 'countries', array( 'post' ), $args );
}

add_filter( 'body_class', 'perlovs_taxonomy_body_class' );
if ( ! function_exists( 'perlovs_taxonomy_body_class' ) ) :
/**
 * add taxoonomy and terms to body_class
 */
function perlovs_taxonomy_body_class( $classes )
{
	if( is_singular() )
	{
		$categories_list = get_the_category();
		if ($categories_list) {
			foreach ($categories_list as $category) {
				$classes[] = 'category-' . $category->slug;
			}
		}
	}
	return $classes;
}
endif; // perlovs_taxonomy_body_class

if ( ! function_exists( 'perlovs_gmaps_localize' ) ) :
/**
 * Localize gmaps scripts to provide it with all countries in the blog and current country if present
 */
function perlovs_gmaps_localize( $handle )
{
    global $wp_query, $post;

    $gmaps_all_query = '';
    $gmaps_other_query = '';
    $current_query = '';

    $terms = get_terms( 'countries' );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$all_country_slugs = array_map(function($o) { return ucfirst($o->slug); }, $terms);
		$gmaps_all_query = "Name IN ('" . implode($all_country_slugs, "','") . "')";
		$gmaps_other_query = $gmaps_all_query;

		if (is_tax( 'countries' )) {
		    $current_country = $wp_query->get_queried_object()->slug;
			$other_country_slugs = array_filter($all_country_slugs, function($a) use($current_country) { return $a !== ucfirst($current_country); });
			$gmaps_other_query = "Name IN ('" . implode($other_country_slugs, "','") . "')";
			$current_query = "Name IN ('" . ucfirst($current_country) . "')";
	    }
	}

    $gmaps_vars = array(
        'allQuery' => $gmaps_all_query,
        'otherQuery' => $gmaps_other_query,
        'currentQuery' => $current_query
    );

    wp_localize_script( $handle, 'gmapsVars', $gmaps_vars );

}
endif; // perlovs_gmaps_localize

if ( ! function_exists( 'perlovs_get_country_links' ) ) :
/**
 * Get country links except current
 */
function perlovs_get_country_links( $echo = true )
{
    $current_country = get_queried_object()->term_id;
    $args = array( 'hide_empty' => '0',
    				'exclude' => $current_country );

	$terms = get_terms( 'countries', $args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	    $term_list = '';
	    foreach ( $terms as $term ) {
	    	$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( _x( 'View all post from %s', 'countries list', 'perlovs' ), $term->name ) . '">' . $term->name . '</a> ';
	    }
	}

	if ($echo) echo $term_list;
	else return $term_list;
}
endif; // perlovs_get_country_links

if(!function_exists('perlovs_get_tax_bg_image_style')) :
    /*
        Echoes style="background-image: ..." with latest post in given taxonomy term featured image
    */
    function perlovs_get_tax_bg_image_style($taxonomy, $term, $size = 'full') {
    	$args = array( 'numberposts' => 1, 'post_status' => 'publish',
    					'tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug',
									'terms' => $term
								)
							));
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
endif; // perlovs_get_tax_bg_image_style

?>