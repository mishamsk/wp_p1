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

?>