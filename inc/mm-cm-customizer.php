<?php

/*
 * UI for customizer
 *
 * Adding New Charmeem Theme Panels and Sections along with settings and controls
 *
 */
add_action( 'customize_register', 'cm_th_customizer_setup' , 11);
function cm_th_customizer_setup( $wp_customize ) {
	
	/******************************************************************************************************
    * PANEL : GENERAL SETTINGS
    ******************************************************************************************************/
	$wp_customize->add_panel( 'cm_general', array(
	'title' => __( 'General Settings' ),
	'description' => __( 'General Settings' ),
	'priority' => 10, // Mixed with top-level-section hierarchy.
	) );
    
    /*-----------------------------------------------------------------------------------------------------
                              SETION: COLORS SETTINGS
    ------------------------------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'cm_colors', array(
	'title' => __( 'Colors' ),
	'description' => __( 'Customize Colors' ),
	'panel' => 'cm_general', 
	'priority' => 40,
	//'capability' => 'edit_theme_options',
	//'theme_supports' => '', // Rarely needed.
	) );

	// Settings and controls
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'mm_cm_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'mm_cm' ),
		'section'  => 'cm_colors',
		'type'     => 'select',
		'choices'  =>  array(
			'left'  => 'left',
			'right' => 'right',
			),
		'priority' => 1,
	) );
	
	/*-----------------------------------------------------------------------------------------------------
                                   SECTION: FONTS SETTINGS
    ------------------------------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'cm_fonts', array(
	'title' => __( 'Google Fonts' ),
	'description' => __( 'Customize section for Fonts' ),
	'panel' => 'cm_general', 
	'priority' => 40,
	//'capability' => 'edit_theme_options',
	//'theme_supports' => '', // Rarely needed.
	) );
	$wp_customize->add_setting( 'cm_fonts_size', array(
		'default'           => 'default',
		'sanitize_callback' => 'mm_cm_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );
    // Logo
	$wp_customize->add_control( 'cm_fonts_size', array(
		'label'    => __( 'Font size', 'mm_cm' ),
		'section'  => 'cm_fonts',
		'type'     => 'select',
		'choices'  =>  array(
			'left'  => 'left',
			'right' => 'right',
			),
		'priority' => 2,
	) );
	/******************************************************************************************************
    * PANEL : HEADER Settings
    ******************************************************************************************************/
	
	$wp_customize->add_panel( 'cm_header', array(
	'title' => __( 'Header Settings' ),
	'description' => __( 'Header Settings' ), // Include html tags such as <p>.
	'priority' => 11, // Mixed with top-level-section hierarchy.
	) );
    
	/*-----------------------------------------------------------------------------------------------------
                                   SECTION: Logo SETTINGS 
    ------------------------------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'cm_logo', array(
	'title' => __( 'Logo' ),
	'description' => __( 'Customize Logo' ),
	'panel' => 'cm_header', 
	'priority' => 40,
	//'capability' => 'edit_theme_options',
	//'theme_supports' => '', // Rarely needed.
	) );
	$wp_customize->add_setting( 'cm_logo_orientation', array(
		'default'           => 'default',
		'sanitize_callback' => 'mm_cm_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );
    $wp_customize->add_control( 'cm_logo_orientation', array(
		'label'    => __( 'Place Logo', 'mm_cm' ),
		'section'  => 'cm_logo',
		'type'     => 'select',
		'choices'  =>  array(
			'left'  => 'left',
			'right' => 'right',
			),
		'priority' => 2,
	) );
	
}

 
 
 ?>
 