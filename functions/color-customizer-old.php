<?php

// Registering customizer
add_action( 'customize_register', 'charmeem_colors');
function charmeem_colors( $wp_customize ) {
	
	// Only Adding Color picker controls/setting for post , header etc
	// Reusing already existing color Section, and setting/control of background color.
	
	// Adding color picker Setting and Control for Title
	$wp_customize->add_setting( 'title_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#32d8db', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'title_color', array(
		'label' => 'Title Background Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'title_color',
	) ) );	
	
	// Adding color picker Setting and Control for Menu
	$wp_customize->add_setting( 'menu_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#32d8db', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'menu_color', array(
		'label' => 'Menu Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'menu_color',
	) ) );	
		
	// Adding Color Picker Setting and Control for Posts
	$wp_customize->add_setting( 'post_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#cad100', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'post_color', array(
		'label' => 'Post Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'post_color',
	) ) );	
	
	// Adding color picker Setting and Control for post header
	$wp_customize->add_setting( 'entry_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#000000', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'entry_color', array(
		'label' => 'Post header Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'entry_color',
	) ) );
	
	// Adding color picker Setting and Control for Aside
	$wp_customize->add_setting( 'aside_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#34c5e2', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'aside_color', array(
		'label' => 'Sidebar Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'aside_color',
	) ) );
	
	// Adding color picker Setting and Control for widget Title
	$wp_customize->add_setting( 'wgtitle_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#dd9933', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'wgtitle_color', array(
		'label' => 'Widget Title',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'wgtitle_color',
	) ) );
	$bck=$wp_customize->get_setting('header_textcolor');
	//var_dump(get_background_color());
	//var_dump($bck);
	
	// Adding color picker Setting and Control for Body only if the theme already does not support this feature
	if(!current_theme_supports('custom-background')){
	$wp_customize->add_setting( 'body_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#e2ad00', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'body_color', array(
		'label' => 'Body Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'body_color',
	) ) );
	}
	// Adding color picker Setting and Control for footer
	$wp_customize->add_setting( 'footer_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#25e1e8', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'footer_color', array(
		'label' => 'Footer Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'footer_color',
	) ) );

	// EnQueueing JS file for live previewing 
	// This js file is needed when we change transport = postMessage above to have fast preview in customizer
	if ( $wp_customize->is_preview() ){
	//add_action( 'wp_footer', 'color_picker_preview_js', 20);
	add_action( 'customize_preview_init', 'color_picker_preview_js' );
	function color_picker_preview_js() {
	wp_enqueue_script('color-customizer-js', plugins_url('charmeem-plugins/js/color-picker-preview.js'), array('customize-preview'), '1.0.0', true );
		}	
	}
	// Some of the themes like twentytwelve implement their custom settings in the customizer panel
	//Since I prefer my own custom settings to prevail therefore I am removing the theme customization here
	//if(current_theme_supports('custom-header')){
	//remove_theme_support('custom-header');
	//}
	//or
	//remove_theme_support('custom-background');
} // end of function	

		

	
	


add_action( 'wp_head', 'charmeem_customizer_title_styles' );
function charmeem_customizer_title_styles() {
	$title_color 	= get_option( 'title_color' ); 
	$menu_color 	= get_option( 'menu_color' );
	$brand_color 	= get_option( 'brand_color' ); 
	$post_color 	= get_option( 'post_color' );
	$aside_color 	= get_option( 'aside_color' );
	$wgtitle_color 	= get_option( 'wgtitle_color' );
	$body_color 	= get_option( 'body_color' );
	$entry_color 	= get_option( 'entry_color' );
	$footer_color 	= get_option( 'footer_color' );
		
	?>
		<style type="text/css">
		
			.site-header,.header,.site-title {
				background: <?php echo $title_color; ?>;
			}
			
			.menu, .navbar, .nav-menu{
				background:<?php echo $menu_color; ?>;
			}
			
			#blog-title {
				background: <?php echo $title_color; ?>;
			}
		
			.post {
				background:<?php echo $post_color; ?>;
			}
		
			.aside {
				background:<?php echo $aside_color; ?>;
			}
			
			.widgettitle {
				background:<?php echo $wgtitle_color; ?>;
			}
			
			body {
				background: <?php echo $body_color; ?>;
			}
			.entry-title {
				background:<?php echo $entry_color; ?>;
			}
			#footer,.site-footer{
			background:<?php echo $footer_color; ?>;
			}	
			
			
		</style>
	<?php
	
} // End function



