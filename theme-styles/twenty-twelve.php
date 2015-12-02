<?php
/**
 * Theme: Twenty Twelve
 * Theme Url: https://wordpress.org/themes/twentytwelve
 */

$css = <<<MMM
	
	.post {
		background: {{color-post-bg-0}};
		color: {{color-post-fg-0}};
	}
	.nav-menu {
		background: {{color-menu-bg-0}};
	}
	.nav-menu li a{
		color: {{color-menu-fg-0}};
	}
	aa {
		color: {{color-link-fg-0}};
	}
	aa:hover {
		color: {{color-link-bg-1}};
	}
MMM;

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
	
) );