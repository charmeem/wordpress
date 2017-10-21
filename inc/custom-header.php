<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage charmeem
 * 
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses cm_header_style()
 */
function charmeem_custom_header_setup() {

	/**
	 * Filter Charmeem custom-header support arguments.
	 *
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-image     		Default image of the header.
	 *     @type string $default_text_color     Default color of the header text.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 *     @type string $flex-height     		Flex support for height of header.
	 *
	 *  Support of svg: svg image cannot be added in custom header customizer due to the cropping
     *  image notsupported by svg fomat. 
     *  Solution : To add bin bodhi svg plugin + add flex width and flex height parameter as below.
     *             This will be resulted appearance of 'Skip Cropping' tab while adding image.	@mmm 
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'charmeem_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'width'              => 2000,
		'height'             => 1200,
		'flex-height'        => true,
		'flex-width'         => true,
		'default-text-color' => 'ea8a35',
		'video'              => true,
		'wp-head-callback'   => 'cm_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header.jpg',
			'thumbnail_url' => '%s/assets/images/header.jpg',
			'description'   => __( 'Default Header Image', 'charmeem' ),
		),
	) );
}
add_action( 'after_setup_theme', 'charmeem_custom_header_setup' );


if ( ! function_exists( 'cm_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see charmeem_custom_header_setup().
 */
function cm_header_style() {
	$header_text_color = get_header_textcolor();
  
	//'get_header_textcolor' returns Text color setup in customizer setting
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="charmeem-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		// 'blank' is a text returns from customizer when hide title / desrciption checkbox is checked
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.colors-dark .site-title a,
		.colors-custom .site-title a,
		body.has-header-image .site-title a,
		body.has-header-video .site-title a,
		body.has-header-image.colors-dark .site-title a,
		body.has-header-video.colors-dark .site-title a,
		body.has-header-image.colors-custom .site-title a,
		body.has-header-video.colors-custom .site-title a,
		.site-description,
		.colors-dark .site-description,
		.colors-custom .site-description,
		body.has-header-image .site-description,
		body.has-header-video .site-description,
		body.has-header-image.colors-dark .site-description,
		body.has-header-video.colors-dark .site-description,
		body.has-header-image.colors-custom .site-description,
		body.has-header-video.colors-custom .site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // End of cm_header_style.

/**
 * Customize video play/pause button in the custom header.
 */
function charmeem_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . __( 'Play background video', 'charmeem' ) . '</span>' . charmeem_get_svg( array( 'icon' => 'play' ) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . __( 'Pause background video', 'charmeem' ) . '</span>' . charmeem_get_svg( array( 'icon' => 'pause' ) );
	return $settings;
}
add_filter( 'header_video_settings', 'charmeem_video_controls' );

/**
 * My Customization of Header image section:
 *   . Renaming name of section
 *   . Moving header text color from 'color' into header section
 *   . Changing priority 
 */

add_action( 'customize_register', 'charmeem_header_image_customization_register' );

function charmeem_header_image_customization_register ($wp_customize) {

// renaming Header Media section to Header Style
$wp_customize->get_section('header_image')->title = __('Header Styles', 'charmeem');

$wp_customize->get_section('header_image')->priority = 20;

//bringing background color control to header_image section/panel from Color section/panel
$wp_customize->get_control('header_textcolor')->section = 'header_image';


}