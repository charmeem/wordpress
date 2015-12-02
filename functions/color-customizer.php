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
		add_action( 'wp_head', array( &$this, 'process_styles' ), 99 );
		add_action( 'customize_preview_init', array( &$this, 'color_picker_preview_js' ), 99 );
	}
	
	/**
	 * Check current theme and include theme style file if it exists
	 *
	 * @param type $theme_name
	 */
	function check_theme() {

		$current_theme = wp_get_theme();

		$theme_name = $current_theme->get( 'Name' );
		$theme_name = strtolower( $theme_name );
		$theme_name = str_replace( ' ', '-', $theme_name );

		$file = plugin_dir_path( __FILE__ ) . '../theme-styles/' . $theme_name . '.php';

		// if there's no template file for the current theme then load the default
		if ( ! file_exists( $file ) ) {
			$file = plugin_dir_path( __FILE__ ) . '../theme-styles/_default.php';
		}

		include( $file );

	}
	
	/**
	 * Setup customizer panel
	 *
	 * @param type $
	 */
 
	
	function customizer_setup( $wp_customize ) {
	
	$settings = $this->get_settings();
	
		if ( $settings ) {

			// include custom controls
			include_once( 'custom-controls.php' );

			$priority = 1;
			
			// add color controls
			if ( ! empty( $settings[ 'colors' ] ) ) {

				// does the color control already exist (through background and header colour customization?
				// if not then create the control - else reuse the existing one

				// loop through colours and output controls
				foreach( $settings[ 'colors' ] as $color_key => $color ) {
			//var_dump($color);
					$key = 'colorpicker_color_' . $color_key;
					$wp_customize->add_setting( $key, array(
						'default' => $color[ 'default' ],
						'capability' => 'edit_theme_options',
						'transport' => 'postMessage', // change to postMessage if using js
						'sanitize_callback' => 'colorpicker_sanitize_hex_color',
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


			}

		}
	} // end of function	

	
	/**
	 * output the css styles for the current theme
	 */
	function process_styles() {

		$settings = $this->get_settings();
		
		if ( ! empty( $settings[ 'colors' ] ) ) {

			include_once( 'csscolor.php' );

			// if a background color is set
			if ( current_theme_supports( 'custom-background' ) ) {
				$this->process_colors( 'theme-background', get_background_color() );
				
			}

			// other custom colors
			foreach( $settings[ 'colors' ] as $color_key => $color ) {
				$this->process_colors( $color_key, get_theme_mod( 'colorpicker_color_' . $color_key, $color[ 'default' ] ) );
				
			}

			// if there's any color combos then do them too
			if ( ! empty( $settings[ 'color-combos' ] ) ) {
				foreach( $settings[ 'color-combos' ] as $combo_key => $combo ) {
					$this->process_colors( $combo_key, $this->colors[ $combo[ 'background' ] . '-bg-0' ], $this->colors[ $combo[ 'foreground' ] . '-bg-0' ] );
				}
			}

		}

		if ( ! empty( $settings[ 'css' ] ) ) {
			$this->output_css( $settings[ 'css' ] );
		}

	}
	
	/**
	 * process the colours and save them for later use
	 *
	 * @param type $colors
	 * @param type $colorpicker
	 */
	function process_colors( $colorpicker, $color1, $color2 = null ) {
		
		if ( null !== $color2 ) {
			$colors = new CSS_Color( colorpicker_sanitize_hex_color( $color1 ), colorpicker_sanitize_hex_color( $color2 ) );
		} else {
			$colors = new CSS_Color( colorpicker_sanitize_hex_color( $color1 ) );
		
		}
		
		$this->add_colors( $colorpicker . '-fg', $colors->fg );
		$this->add_colors( $colorpicker . '-bg', $colors->bg );
		
		/*----- Added and commented by mmm to utilize complementary colors if needed in future---*/
		//$this->add_colors( $colorpicker . '-fgc', $colors->fgc );
		//$this->add_colors( $colorpicker . '-bgc', $colors->bgc );

	}
	
	
	/**
	 * add colors to the global array so that they can be easily accessed
	 *
	 * @param type $colors
	 * @param type $colorpicker
	 */
	function add_colors( $colorpicker, $colors ) {

		foreach( $colors as $key => $color ) {

			if ( $key == '0' ) {
				$key = '-0';
			}
			$this->colors[ ( $colorpicker . $key ) ] = '#' . $color;
			
		}

	}
	
	
	/**
	 * print css to the head
	 *
	 * @param type $css
	 */
	function output_css( $css ) {

		$css = trim( $css );
		$start_css = $css;

		// replace colours in the css template
		foreach( $this->colors as $key => $color ) {
		
			$css = str_replace( '{{color-' . $key . '}}', colorpicker_sanitize_hex_color( $color ), $css );
			
		}

		
		// if the css has changed then output css
		if ( $start_css != $css ) {
			echo '<!-- Colorpicker styles -->' . "\r\n";
			echo '<style>' . stripslashes( wp_filter_nohtml_kses( $css ) ) . '</style>';
		}

	}
	
	
	/**
	 * EnQueueing JS file for live previewing
	 *
	 * This js file is needed when we change transport = postMessage to have fast preview in customizer
	 *
	 * @param type $
	 */
	
		
	function color_picker_preview_js($wp_customize) {
	
		if ( $wp_customize->is_preview() && ! is_admin() ){
			wp_enqueue_script('color-customizer-js', plugins_url('charmeem-plugins/js/color-picker-preview.js'), array('customize-preview'), '1.0.0', true );
		}	
	}
	
	
	/**
	 * get settings for the current theme from the file in theme-styles directory
	 *
	 * @param type $key
	 */
	function get_settings( $key = null ) {

		$settings = get_theme_support( 'colorpicker' );
		if ( isset( $settings[0] ) ) {
			$settings = $settings[0];
		}
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
		

	
	





