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
//var_dump($colors);

// 'wp_parse_args' merging together incoming array of $colors and default array
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
	) );
   //var_dump($colors);
	$css = <<<CSS
	/* Color Scheme */

	.post {
		background: {$colors['background_color']};
		color: {$colors['textcolor']};
	}
	.nav-menu {
		background: {$colors['box_background_color']};
	}
	.nav-menu li a{
		color: {$colors['textcolor']};
	}
	aa {
		color: {$colors['textcolor']};
	}
	aa:hover {
		color: {$colors['textcolor']};
	}
	 
CSS;
	return $css;
	var_dump($css);
}

$emptyStyle = <<<MMM
	array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
	);
MMM;

$themeStyle = <<<MMM

		array(
		'background_color'            => '{{ data.background_color }}',
		'header_background_color'     => '{{ data.header_background_color }}',
		'box_background_color'        => '{{ data.box_background_color }}',
		'textcolor'                   => '{{ data.textcolor }}',
		'secondary_textcolor'         => '{{ data.secondary_textcolor }}',
		'border_color'                => '{{ data.border_color }}',
		'border_focus_color'          => '{{ data.border_focus_color }}',
		'sidebar_textcolor'           => '{{ data.sidebar_textcolor }}',
		'sidebar_border_color'        => '{{ data.sidebar_border_color }}',
		'sidebar_border_focus_color'  => '{{ data.sidebar_border_focus_color }}',
		'secondary_sidebar_textcolor' => '{{ data.secondary_sidebar_textcolor }}',
		'meta_box_background_color'   => '{{ data.meta_box_background_color }}',
	);
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
	//'css' => $css,
	'themeStyle' => $themeStyle,
	'emptyStyle' => $emptyStyle,
	
) );