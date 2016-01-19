<?php
/**
 * Theme: Twenty Twelve
 * Theme Url: https://wordpress.org/themes/twentytwelve
 */
/**
 * Returns CSS for the color schemes.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function charmeem_get_color_scheme_css( $colors ) {
/*$color_template = array(
					'box_background',
					'menu',
					'post'
					);*/
//var_dump($colors);

// 'wp_parse_args' merging together incoming array of $colors and default array
	$colors = wp_parse_args( $colors, array(
		'box_background'  => '',
		'menu'    		  => '',
		'post'  		  => '',
		) );
   //wp_localize_script( 'color-scheme-control', 'rainbow', $colors );
	$css = <<<CSS
	/* Color Scheme */
	
	.wrapper {
		background: {$colors['box_background']};
		}
	.post {
		background: {$colors['post']};
		color: {$colors['box_background']};
	}
	.nav-menu {
		background: {$colors['menu']};
	}
	.nav-menu li a{
		color: {$colors['box_background']};
	}
	aa {
		color: {$colors['box_background']};
	}
	aa:hover {
		color: {$colors['box_background']};
	}
	 
CSS;
    //var_dump($css);
	return $css;
	
}



add_theme_support( 'colorpicker', array( 
	'colors' => array(
		'box_background' => array( // these are the selected settings that will be displayed on customizer Panel front end
			'label' => __( 'Box Background Color', 'colorpicker' ),
			'default' => '#21759b',
		),
		'menu' => array(
			'label' => __( 'Menu', 'colorpicker' ),
			'default' => '#26b5b0',
		),
		'post' => array(
			'label' => __( 'Post Color', 'colorpicker' ),
			'default' => '#2cd6d6',
		),
	),
	//'css' => $css,
	'themeStyle' => array(
		'box_background' => '{{ data.box_background }}',
		'menu'    		 => '{{ data.menu }}',
		'post'   	     => '{{ data.post }}',
		),
	'color_template' => array(
					'box_background',
					'menu',
					'post'
					),
		
) );