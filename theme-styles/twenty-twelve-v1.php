<?php
/**
 * Theme: Twenty Twelve
 * Theme Url: https://wordpress.org/themes/twentytwelve
 */


add_theme_support( 'colorpicker', array(
	'colors' => array(
		'link' => array(
			'label' => __( 'Link Color', 'colorpicker' ),
			'default' => '#21759b',
		),
		'menu' => array(
			'label' => __( 'Menu Color', 'colorpicker' ),
			'default' => '#26b5b0',
		),
		'post' => array(
			'label' => __( 'Post Color', 'colorpicker' ),
			'default' => '#2cd6d6',
		),
	),
	'css' => $css,
	//'themeStyle' => $themeStyle,
	//'emptyStyle' => $emptyStyle,
	
) );