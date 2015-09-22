<?php

// Registering customizer
add_action( 'customize_register', 'charmeem_colors');

function charmeem_colors( $wp_customize ) {
	// Only Adding Color picker controls/setting for post , header( title + branding) etc
	// Reusing already existing color Section, and setting/control of background color.
	
	// Adding color picker Setting and Control for Title
	$wp_customize->add_setting( 'title_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#000000', // setting default title color to black
		'transport' => 'refresh', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'title_color', array(
		'label' => 'Title Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'title_color',
	) ) );	
	
	// Adding Color Picker Setting and Control for Branding
	$wp_customize->add_setting( 'brand_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#000000', // setting default title color to black
		'transport' => 'refresh', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'brand_color', array(
		'label' => 'Brand Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'brand_color',
	) ) );	
	
	// Adding Color Picker Setting and Control for Posts
	$wp_customize->add_setting( 'post_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#000000', // setting default title color to black
		'transport' => 'refresh', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'post_color', array(
		'label' => 'Post Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'post_color',
	) ) );	
}

function charmeem_customizer_title_styles() {
	$title_color = get_option( 'title_color' ); 
	$brand_color = get_option( 'brand_color' ); 
	$post_color = get_option( 'post_color' );
		
	?>
		<style type="text/css">
			#blog-title {
				background: <?php echo $title_color; ?>;
			}
			#branding{
				background:<?php echo $brand_color; ?>;
			}
			.post {
				background:<?php echo $post_color; ?>;
			}
		</style>
	<?php
	
}
add_action( 'wp_head', 'charmeem_customizer_title_styles' );
