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

if ( ! function_exists( 'p1_taxonomy_body_class' ) ) :
/**
 * add taxoonomy and terms to body_class
 */
function p1_taxonomy_body_class( $classes )
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
endif; // p1_taxonomy_body_class

// add taxoonomy and terms to body_class
add_filter( 'body_class', 'p1_taxonomy_body_class' );

if ( ! function_exists( 'p1_gmaps_load' ) ) :
/**
 * Append gmaps scripts to the bottom
 */
function p1_gmaps_load(  )
{
    global $wp_query, $post;
    if (is_tax( 'countries' )) {
	    $current_country = $wp_query->get_queried_object()->slug;
		$terms = get_terms( 'countries' );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$all_country_slugs = array_map(function($o) { return ucfirst($o->slug); }, $terms);
			$other_country_slugs = array_filter($all_country_slugs, function($a) use($current_country) { return $a !== ucfirst($current_country); });
			$gmaps_all_query = "Name IN ('" . implode($all_country_slugs, "','") . "')";
			$gmaps_other_query = "Name IN ('" . implode($other_country_slugs, "','") . "')";
			$current_query = "Name IN ('" . ucfirst($current_country) . "')";

    		echo "\n<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDW6yLw5xxjchnk0cyo8NeTAZ-XimgtxDk'></script>";
			echo "\n<script type='text/javascript'>
					var c_map;

					function init_map() {
				 		c_map = new google.maps.Map(document.getElementById('map-canvas'), {
				 			center: new google.maps.LatLng(30,0),
				 			zoom: 2,
				 			disableDefaultUI: true,
				 			mapTypeId: google.maps.MapTypeId.ROADMAP
				 		});
					}

					function init_ftl() {
				 		var world_geometry = new google.maps.FusionTablesLayer({
				 			query: {
				 				select: 'geometry',
				 				from: '1N2LBk4JHwWpOY4d9fobIn27lfnZ5MDy-NoqqRpk',
				 				where: \"$gmaps_all_query\"
				 			},
				 			styles: [{
				 				where: \"$current_query\",
				 				markerOptions: {
									iconName: 'red_circle'
								},
				 				polygonOptions: {
				 					fillColor: '#EB6841',
				 					fillOpacity: 0.3
				 				}
				 			}, {
				 				where: \"$gmaps_other_query\",
				 				polygonOptions: {
				 					fillColor: '#00A0B0',
				 					fillOpacity: 0.5
				 				}
				 			}],
				 			map: c_map,
				 			suppressInfoWindows: true
				 		});

				 		google.maps.event.addListener(world_geometry, 'click', function(e) {
				 			document.location.href = '../' + e.row['Name'].value.toLowerCase();
				 		});
				 	}

				 	$(window).on('load', function() {
				 		init_map();
				 		setTimeout(init_ftl, 0);
				 	});
				</script>";
		}
    }
}
endif; // p1_gmaps_load
add_action( 'wp_footer', 'p1_gmaps_load', 100 );

?>