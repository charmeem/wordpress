<?php

/*
 * colorPicker Class
 *
 */
 class colorPicker	{
	// Declaring Variables
	private $colors = array();

	private $version = '2.0';
	
	/**
	 * Constructor
	 */
	public function __construct() {
		
		global $colorpicker;

		if ( isset( $colorpicker ) ) {
			return $colorpicker;
		}
		
		add_action( 'after_setup_theme', array( &$this, 'check_theme' ), 99);
		add_action( 'customize_register', array( &$this, 'customizer_setup' ), 99);
		add_action( 'wp_enqueue_scripts', array( &$this, 'charmeem_color_scheme_css' ), 99);
		add_action( 'customize_controls_enqueue_scripts', array( &$this, 'charmeem_customize_control_js' ), 99);
		add_action( 'customize_preview_init', array( &$this, 'charmeem_customize_preview_js' ), 99);

		// This is a action hook defined in wp-admin/customize.php
		add_action( 'customize_controls_print_footer_scripts', array( &$this, 'charmeem_color_scheme_css_template' ), 99);

		
		//add_action( 'wp_head', array( &$this, 'process_styles' ), 99 );
		//add_action( 'customize_preview_init', array( &$this, 'color_picker_preview_js' ), 99 );
		//add_action( 'customize_controls_enqueue_scripts', array(&this, 'colorpicker_customize_control_js' ), 99);
		
		
	
	} // End constructor


/**
 * Charmeem plugin Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

	/**
	 * Check current theme and include theme style file if it exists
	 *
	 * @param type $theme_name
	 */
	 
	 function check_theme() {

		$current_theme = wp_get_theme();

		$theme_name = $current_theme->get( 'Name' );
		$theme_name = strtolower( $theme_name );
		$theme_name = str_replace( ' ', '-', $theme_name );//replace space in theme name with '-'

		$file = plugin_dir_path( __FILE__ ) . '../theme-styles/' . $theme_name . '.php';

		// if there's no template file for the current theme then load the default
		if ( ! file_exists( $file ) ) {
			$file = plugin_dir_path( __FILE__ ) . '../theme-styles/default.php';
		}

		include( $file );

	}
 
 
 
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function customizer_setup( $wp_customize ) {
	$color_scheme = $this->charmeem_get_color_scheme_wrap();
	// Changing Transport type of Existing settings
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => '$this->charmeem_sanitize_color_scheme_wrap',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'charmeem' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => $this->charmeem_get_color_scheme_choices_wrap(),
		'priority' => 1,
	) );

	
	$settings = $this->get_settings(); // A function defined at the end that fetches the settings of current theme
	                                   // from respective file in theme-styles directory
	
		if ( $settings ) {

			// include custom controls if any
			include_once( 'custom-controls.php' );

			$priority = 1;
			
			// add color controls
			if ( ! empty( $settings[ 'colors' ] ) ) {

				// does the color control already exist (through background and header colour customization?
				// if not then create the control - else reuse the existing one

				/**
				 * loop through colour keys defined in respective theme file
				 */
				 
				foreach( $settings[ 'colors' ] as $color_key => $color ) {
			//var_dump($color_key);
					$key = 'colorpicker_color_' . $color_key;
			//var_dump($key);		
					$wp_customize->add_setting( $key, array(
						'default' => $color[ 'default' ],
						'capability' => 'edit_theme_options',
						'transport' => 'postMessage', // change to postMessage if using js
						'sanitize_callback' => 'colorpicker_sanitize_hex_color', // function defined in helper.php file
					) );

					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$key,
							array(
								'label' => $color[ 'label' ],
								'section' => 'colors',
								'settings' => $key,
								'priority' => $priority,
							)
						)
					);

					$priority ++;

				}
				
	// Adding Background color Setting and Control if the theme does not support this feature by default
	if(!current_theme_supports('custom-background')){
	$wp_customize->add_setting( 'background_color', array(
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'default' => '#e2ad00', // setting default title color to black
		'transport' => 'postMessage', // change to postMessage if using js
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );
	
	$wp_customize->add_control( new WP_customize_Color_Control( $wp_customize, 'body_color', array(
		'label' => 'Background Color',
		'section' => 'colors',  // ID of already existing color section.
		'settings' => 'background_color',
	) ) );
	}
			}
		}
	} // end of function	
	
function charmeem_get_color_scheme_wrap() {   // to wrap 'if' instruction as it is not allowed in classes directly

if ( ! function_exists( 'charmeem_get_color_scheme' ) ) :
/**
 * Get the current charmeem color scheme.
 *
 * @since charmeem 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function charmeem_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );// fetches setting value from control panel
	
	                //var_dump($color_scheme_option);
	
	$color_schemes = $this->charmeem_get_color_schemes();
	
	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
	//var_dump($color_schemes);
		return $color_schemes[ $color_scheme_option ]['colors'];
		
	}

	return $color_schemes['default']['colors'];
}
endif; // charmeem_get_color_scheme
} // end wrap

function charmeem_get_color_scheme_choices_wrap() {   // to wrap 'if' instruction as it is not allowed in classes directly
if ( ! function_exists( 'charmeem_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return array Array of color schemes.
 */
function charmeem_get_color_scheme_choices() {
	$color_schemes = $this->charmeem_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // charmeem_get_color_scheme_choices
} // end wrap function

function charmeem_sanitize_color_scheme_wrap() {   // to wrap 'if' instruction as it is not allowed in classes directly
if ( ! function_exists( 'charmeem_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function charmeem_sanitize_color_scheme( $value ) {
	$color_schemes = charmeem_get_color_scheme_choices_wrap();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // charmeem_sanitize_color_scheme
} // end function wrap
	/**
 * Register color schemes for Twenty Fifteen.
 *
 * Can be filtered with {@see 'charmeem_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return array An associative array of color scheme options.
 */
function charmeem_get_color_schemes() {
	return apply_filters( 'charmeem_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'charmeem' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'charmeem' ),
			'colors' => array(
				'#111111',
				'#202020',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'charmeem' ),
			'colors' => array(
				'#f4ca16',
				'#ffdf00',
				'#ffffff',
				'#111111',
				'#111111',
				'#f1f1f1',
			),
		),
		'pink'    => array(
			'label'  => __( 'Pink', 'charmeem' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'purple'  => array(
			'label'  => __( 'Purple', 'charmeem' ),
			'colors' => array(
				'#674970',
				'#2e2256',
				'#ffffff',
				'#2e2256',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'charmeem' ),
			'colors' => array(
				'#e9f2f9',
				'#55c3dc',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
			),
		),
	) );
}

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function charmeem_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'colar_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = charmeem_get_color_scheme_wrap();

	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = charmeem_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = charmeem_hex2rgb( $color_scheme[4] );
	$colors = array(
		'background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1],
		'box_background_color'        => $color_scheme[2],
		'textcolor'                   => $color_scheme[3],
		'secondary_textcolor'         => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_textcolor_rgb ),
		'border_color'                => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_textcolor_rgb ),
		'border_focus_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_textcolor_rgb ),
		'sidebar_textcolor'           => $color_scheme[4],
		'sidebar_border_color'        => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_sidebar_textcolor_rgb ),
		'sidebar_border_focus_color'  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_sidebar_textcolor_rgb ),
		'secondary_sidebar_textcolor' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_textcolor_rgb ),
		'meta_box_background_color'   => $color_scheme[5],
	);

	$color_scheme_css = charmeem_get_color_scheme_css( $colors );

	//Adding extra CSS on top of default style.css defined in function.css as follows:
	//wp_enqueue_style( 'charmeem-style', get_stylesheet_uri() );
	
	wp_add_inline_style( 'charmeem-style', $color_scheme_css );
}

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Twenty Fifteen 1.0
 */
function charmeem_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', $this->charmeem_get_color_schemes() );
	//wp_localize_script is used to transfer data from php file into javascript file.
	// here colorScheme is new object created while its parametres are fetched from charmeem-get_color_schemes
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Fifteen 1.0
 */
function charmeem_customize_preview_js() {
	wp_enqueue_script( 'charmeem-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}

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

	// 'wp_parse_args' merging together incoming array of $colors and default array defined in theme file
    $settings = $this->get_settings();
	$merge = $settings['emptyStyle'];
	
	$colors = wp_parse_args( $colors, $merge );
	
  // var_dump($colors);
    $css = $settings[ 'css' ];
	

	return $css;
	
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since Twenty Fifteen 1.0
 */
function charmeem_color_scheme_css_template() {
	$settings = $this->get_settings();
	$colors = $settings[ 'themeStyle' ]; // I have customized the theme style by moving the templete array into
										   // respective theme file , e.g. in twenty-twelve.php
	
	//var_dump($colors['background_color']);
	//var_dump($colors);
	?>
	<script type="text/html" id="tmpl-charmeem-color-scheme">
		<?php echo $this->charmeem_get_color_scheme_css( $colors ); ?>
		//console.log(colors);
	</script>
	<?php
	//var_dump($colors);
}

/**
	 * get settings for the current theme from the file in theme-styles directory
	 *
	 * @param type $key
	 */
	function get_settings( $key = null ) {

		$settings = get_theme_support( 'colorpicker' );// see add_theme_support defined in the theme files in theme-styles directory
		//var_dump($key);
		if ( isset( $settings[0] ) ) {
			$settings = $settings[0];
		//var_dump($settings);	
		}
		//var_dump($key);
		// check request for key
		if ( null !== $key ) {
		
			if ( isset( $settings[ $key ] ) ) {
				return $settings[ $key ];
			} else {
				return false;
			}
		}

		return $settings;

	}
	
 }		//End Class
 
$colorpicker = new colorPicker();	