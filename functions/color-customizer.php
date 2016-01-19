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
		//add_action( 'customize_controls_enqueue_scripts', array(&this, 'colorpicker_customize_control_js' ), 99);
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
		$theme_name = str_replace( ' ', '-', $theme_name );//replace space in theme name with '-'

		$file = plugin_dir_path( __FILE__ ) . '../theme-styles/' . $theme_name . '.php';

		// if there's no template file for the current theme then load the default
		if ( ! file_exists( $file ) ) {
			$file = plugin_dir_path( __FILE__ ) . '../theme-styles/default.php';
		}

		include( $file );

	}
	
	/**
	 * Setup customizer panel
	 *
	 * @param type $
	 */
 
	
	function customizer_setup( $wp_customize ) {
	
	$settings = $this->get_settings(); // A function defined at the end.
	
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
			//var_dump($color_key);
					$key = 'colorpicker_color_' . $color_key;
			//var_dump($key);		
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

		$settings = $this->get_settings();// A function defined below to fetch the theme settings 
		
		if ( ! empty( $settings[ 'colors' ] ) ) {

			include_once( 'csscolor.php' ); // An external file used for creating readable color schemes, see below for more explanation

			// if a background color is set
			if ( current_theme_supports( 'custom-background' ) ) {
				$this->process_colors( 'theme-background', get_background_color() );
				
			}

			// other custom colors
			foreach( $settings[ 'colors' ] as $color_key => $color ) {
				$this->process_colors( $color_key, get_theme_mod( 'colorpicker_color_' . $color_key, $color[ 'default' ] ) );
			// The color values from the control customizer is fetched via get_theme_mod 
			// and used as a argument in function process_colors
			}

			// if there's any color combos then do them too
			if ( ! empty( $settings[ 'color-combos' ] ) ) {
				foreach( $settings[ 'color-combos' ] as $combo_key => $combo ) {
					$this->process_colors( $combo_key, $this->colors[ $combo[ 'background' ] . '-bg-0' ], $this->colors[ $combo[ 'foreground' ] . '-bg-0' ] );
				}
			}

		}
		// getting css style from theme style file
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
		
		// Creating object of Class CSS_Color defined in file csscolor.php
		// Beauty of this class is that when given a background color and a foreground 
		// it modifies the foreground color so it will have enough contrast
		// to be seen against the background color.
		
		if ( null !== $color2 ) {
			$colors = new CSS_Color( colorpicker_sanitize_hex_color( $color1 ), colorpicker_sanitize_hex_color( $color2 ) );
		} else {
			$colors = new CSS_Color( colorpicker_sanitize_hex_color( $color1 ) );
		
		}
		// bg is the value of $color1 whereas fg color is calculated from bg color by adjusting the contrast
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
	 // An array is built that is used later to replace css template
	function add_colors( $colorpicker, $colors ) {
//var_dump($colors);
		foreach( $colors as $key => $color ) {
//var_dump($key);
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

		// replace colors in the css template
		foreach( $this->colors as $key => $color ) {
		//var_dump($key);
			$css = str_replace( '{{color-' . $key . '}}', colorpicker_sanitize_hex_color( $color ), $css );
			
		}
	
	
		// if the css has changed then output css
		if ( $start_css != $css ) {
		
		?>	
	<script type="text/html" id="tmpl-twentyfifteen-color-scheme">
		<?php echo twentyfifteen_get_color_scheme_css( $colors ); ?>
		//console.log(colors);
	</script>
	<?php
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
	
	// Already added action hook above	
	function color_picker_preview_js($wp_customize) {
    // As per document	https://codex.wordpress.org/Theme_Customization_API  is_admin check should not be used in customizer
		//if ( $wp_customize->is_preview() && ! is_admin() ){
		if ( $wp_customize->is_preview()) {
			wp_enqueue_script('color-customizer-js', plugins_url('charmeem-plugins/js/color-picker-preview.js'), array('customize-preview'), '1.0.0', true );
		}	
	}
	
	
	/**
	 * get settings for the current theme from the file in theme-styles directory
	 *
	 * @param type $key
	 */
	function get_settings( $key = null ) {

		$settings = get_theme_support( 'colorpicker' );// see add_theme_support defined in the themes files in theme-styles directory
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
		

	
	





