<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Theme options
*
*/

add_action( 'customize_register', 'perlovs_customize_register' );
if ( ! function_exists( 'perlovs_customize_register' ) ) :
/**
 * Add theme options to customization screen
 */
function perlovs_customize_register( $wp_customize )
{
    // Gmaps API key
    $wp_customize->add_setting( 'gmaps_api_key' , array(
        'default'     => '',
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_section( 'gmaps_section' , array(
        'title'      => __( 'Gmaps settings', 'perlovs' ),
        'priority'   => 200,
    ) );

    $wp_customize->add_control(
        'gmaps_api_key_control',
        array(
            'label'    => __( 'Gmaps Api key', 'perlovs' ),
            'section'  => 'gmaps_section',
            'settings' => 'gmaps_api_key',
            'type'     => 'text',
        )
    );
}
endif; // perlovs_customize_register


?>