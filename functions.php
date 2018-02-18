<?php
/**
 * Charmeem functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 */

/**
 * Charmeem only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function charmeem_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/charmeem
	 * If you're building a theme based on Charmeem, use a find and replace
	 * to change 'charmeem' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'charmeem' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'charmeem-featured-image', 2000, 1200, true );

	add_image_size( 'charmeem-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'charmeem' ),
		'social' => __( 'Social Links Menu', 'charmeem' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true, // mmm
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', charmeem_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'charmeem' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'charmeem' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'charmeem' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'charmeem' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'charmeem' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'charmeem_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'charmeem_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charmeem_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( charmeem_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'charmeem_content_width', $content_width );
}
add_action( 'template_redirect', 'charmeem_content_width', 0 );

/**
 * Register custom fonts.
 */
function charmeem_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'charmeem' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function charmeem_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'charmeem-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'charmeem_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function charmeem_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'charmeem' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'charmeem' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'charmeem' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'charmeem' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'charmeem' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'charmeem' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'charmeem_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function charmeem_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'charmeem' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'charmeem_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function charmeem_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'charmeem_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function charmeem_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'charmeem_pingback_header' );

/**
 * Display custom color CSS.
 */
function charmeem_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo charmeem_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'charmeem_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function charmeem_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'charmeem-fonts', charmeem_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'charmeem-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'charmeem-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'charmeem-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'charmeem-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'charmeem-style' ), '1.0' );
		wp_style_add_data( 'charmeem-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'charmeem-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'charmeem-style' ), '1.0' );
	wp_style_add_data( 'charmeem-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'charmeem-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$charmeem_l10n = array(
		'quote'          => charmeem_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'charmeem-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
		$charmeem_l10n['expand']         = __( 'Expand child menu', 'charmeem' );
		$charmeem_l10n['collapse']       = __( 'Collapse child menu', 'charmeem' );
		$charmeem_l10n['icon']           = charmeem_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'charmeem-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'charmeem-skip-link-focus-fix', 'charmeemScreenReaderText', $charmeem_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'charmeem_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function charmeem_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'charmeem_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function charmeem_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'charmeem_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function charmeem_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'charmeem_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function charmeem_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'charmeem_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );



/*------------------------------------------------------------------
Charmeem Customization: Adding new features on top of base theme2017

 1.0 Sidebar functionality on front page
 2.0 svg Social icons
 3.0 Customizer
   3.1 Add  header image as background image.
   3.2 Static front page settings
   3.3 Adding background Image section and settings
   3.4 Adding more Title controls
 4.0 Woocommerce
   4.1 Making charmeem theme woocommerce compatible
---------------------------------------------------*/
 
 
/*-------------------------------------------------------
1.0 Adding sidebar functionality support in front-page
    other customization done in front-page by adding get_sidebar template tag
----------------------------------------------------------*/
function twentyseventeen_body_classes_child( $classes ){
if ( is_active_sidebar( 'sidebar-1' ) &&  is_front_page() ) {
		$classes[] = 'has-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'twentyseventeen_body_classes_child' );


/*-----------------------------------
2.0 Adding svg social icons
    NOT WORKING YET
--------------------------------------*/
function childtheme_include_svg_icons() { 
 // Define SVG sprite file. 
    $custom_svg_icons = get_theme_file_path( '/assets/images/svg-icons.svg' ); 
// If it exists, include it.
     if ( file_exists( $custom_svg_icons ) ) { 
         require_once( $custom_svg_icons ); 
     }
 }
add_action( 'wp_footer', 'childtheme_include_svg_icons', 99999 );

/*----------------------------------------------------------
3.0 Customizer customization
    Some  shuffling done in some sections as well as new settings and
	controls are added into existing sections and some sections are renamed as well.
	Further I also add new panels and sections . All are described and docemented below.
	
	- How to find existing sections/settings/controls name?
      Search in wordpress directory the customizer section title.
	
	- See for details: wp-include/class-wp-customize-manager.php  
	
-------------------------------------------------------------*/

/*----------------------------------------------------------
3.1 Add  header image as background image.
      - Adding new setting and check-box control in background section
	  - Front end via get_theme_mod in section 3.3 <STYLE> 
	  - changing priorities of control elements
	  - updated js preview file to preview live in customizer
-------------------------------------------------------------*/
add_action( 'customize_register', 'charmeem_background_header_register' );
function charmeem_background_header_register ($wp_customize) {

    // Add new setting
    $wp_customize->add_setting( 'background_header', array(
		'transport'         => 'postMessage',

		) );
		
    // Add new control 'background_header'
    $wp_customize->add_control( 'background_header', array(
			'label'    => __( 'Select header image as Background' ),
			'description' => __( 'This will supercede background color and image settings'),
			'section'  => 'background_image',
			'type'     => 'checkbox',
		) );
	
	$wp_customize->get_setting( 'background_image' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
	// Changing appearance order of control elements	
    $wp_customize->get_control('background_header')->priority = 1;
	$wp_customize->get_control('background_color')->priority = 2;
	$wp_customize->get_control('background_image')->priority = 3;
	
}

  
    
add_action( 'customize_register', 'charmeem_customization_register' );
function charmeem_customization_register ($wp_customize) {
/*----------------------------------------------------------------
3.2 Static front page Customizer settings
    -some changes in labelling names of static front page Section
----------------------------------------------------------------*/
    $wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 'charmeem');
    $wp_customize->get_section('static_front_page')->priority = 20;
    $wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preferences', 'charmeem');
    $wp_customize->get_control('page_on_front')->label = __('Select Homepage', 'charmeem');
    $wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 'charmeem');
    // Rename section name from 'Site Identity' to 'Title and logo'
    $wp_customize->get_section('title_tagline')->title = __('Title and Logo', 'charmeem');

	/*----------------------------------------------------------------------------
3.3 Adding background Image section and settings
     - see style.css file for adding background image as hard-coded alternate
	 - uses call back function for re styling 2017 default style
	  - Customizer gives 3 choices to the user:
	    a. Use header image as background image as well
		b. Use some other image as background image or,
		c. in absence of any image choose color for the background
	 - Also see updated js preview file to preview live in customizer
--------------------------------------------------------------------------*/ 
    // renaming Background section/panel
    $wp_customize->get_section('background_image')->title = __('Background Styles', 'charmeem');

    //bringing background color control to background section/panel from Color section/panel
    $wp_customize->get_control('background_color')->section = 'background_image';

    /* not working*/
    //$wp_customize->get_setting('background_image')->transport = 'postMessage';

}

// Adding theme support
add_action( 'after_setup_theme', 'cm_custom_back');
function cm_custom_back() {
    $args = array(
           'default-color' => '#e09500',
	       'default-image' => get_template_directory_uri() . '/assets/images/nagar9.jpg',
		   'wp-head-callback'   => 'cm_background_style',
	    );
    add_theme_support( 'custom-background', $args);
}

// Call back function that customises and replaces 2017 default background style 
function cm_background_style() {

    $cm_background_color = get_background_color();
    $cm_background_image = get_background_image();

    //checking background default color
    if ( get_theme_support( 'custom-background', 'default-color' ) === $cm_background_color ) {
        return;
    } 
	// get customizer setting user input values from database 
	// second priority to background image setting
	// and in case of np background image selected , use color setting value 
    ?>
    <style id = "cm-custom-background-style" type = "text/css" >
	
        .site-content-contain {
		    <?php
			if( get_theme_mod( 'background_header')){ ?>
			background-color: transparent;
		          
		    <?php  
			} elseif (get_theme_mod( 'background_image')) { ?>
			background-image: url(<?php echo esc_attr( $cm_background_image ); ?>);
			<?php 
			}else  { ?> 
		      background-color: #<?php echo esc_attr( $cm_background_color ); ?>;
<?php } ?>			  
	    }
    </style>
    <?php

}

/*-----------------------------------------------------------------------------------
3.4 Adding new controls to Title section & get_theme_mod for CSS rendering
    - section name = title_tagline  ( found from: wp-include/class-wp-customize-manager.php )
	- live preview code is entered in customize-preview.js
	- Any control object customization is added in customize-control.js
	
 ------------------------------------------------------------------------------------*/

//add_action( 'customize_register', 'cm_custom_title');
//
//function cm_custom_title($wp_customize) {
//
//    // Rename section name from 'Site Identity' to 'Title and logo'
//   $wp_customize->get_section('title_tagline')->title = __('Title and Logo', 'charmeem');
//   
//   // TESTING ONLY TESTING ONLY TESTING ONLY 
//      // showing static_front_page Section only on front page 
//   //$wp_customize->get_section('static_front_page')->active_callback = 'is_front_page';
//   
//   
//           
//        $wp_customize->add_setting( 'title_position', array(
//		    'default'           => 'midcenter',
//		    'transport'         => 'postMessage',
//
//		) );	
//    $wp_customize->add_control( 'title_position', array(
//			'label'    => __( 'Title Position' ),
//			'section'  => 'title_tagline',
//			'type'     => 'select',
//			'choices'  => array(
//			    'topleft' => 'Top-left',
//				'topcenter' => 'Top-center',
//				'topright' => 'Top-right',
//				'midleft' => 'Mid-left',
//				'midcenter' => 'Mid-center',
//				'midright' => 'Mid-right',
//				'bottomleft' => 'Bottom-left',
//				'bottomcenter' => 'Bottom-center',
//				'bottomright' => 'Bottom-right',
//				)
//		) );
//}



// get_theme_mod for CSS rendering

add_action('wp_head', 'cm_title_position');
function cm_title_position() {
   
   $css_title = cm_title_pos();
	
    ?>
    <style type = 'text/css'>
	    .site-title a {
		     position: <?php echo $css_title['position']; ?>;
			 top : <?php echo $css_title['top']; ?>;
			 left: <?php echo $css_title['left']; ?>;
			 } 
	</style>	
<?php    
	
}

function cm_title_pos() {

    $title_positions = array(
        'topleft'  => array (
    	    'position' => 'absolute',
    		'top'      => '-450px',
    		'left'     => '0%'
    	),
    	'topcenter'  => array (
    	    'position' => 'absolute',
    		'top'      => '-450px',
    		'left'     => '30%'
    	),
    	'topright'  => array (
    	    'position' => 'absolute',
    		'top'      => '-450px',
    		'left'     => '50%'
    	),
		'midleft'  => array (
    	    'position' => 'absolute',
    		'top'      => '-200px',
    		'left'     => '0%'
    	),
    	'midcenter'  => array (
    	    'position' => 'relative',
    		'top'      => '-200px',
    		'left'     => '30%'
    	),
    	'midright'  => array (
    	    'position' => 'absolute',
    		'top'      => '-200px',
    		'left'     => '60%'
    	),
		'bottomleft'  => array (
    	    'position' => 'absolute',
    		'top'      => '0px',
    		'left'     => '0%'
    	),
    	'bottomcenter'  => array (
    	    'position' => 'relative',
    		'top'      => '0px',
    		'left'     => '30%'
    	),
    	'bottomright'  => array (
    	    'position' => 'absolute',
    		'top'      => '0px',
    		'left'     => '60%'
    	),
    );
    	
    $title_position = get_theme_mod( 'title_position' );
    return $title_css = $title_positions[$title_position];
    		
}
/*-----------------------------------------------------------------------------------
4.1 Woocommerce Customization
    Making charmeem theme woocommerce compatible
	as per 'Third party / custom / non-WC theme compatibility' document
------------------------------------------------------------------------------------*/
//First unhook the WooCommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//hook in  own functions to display the wrappers charmeem theme requires
add_action('woocommerce_before_main_content', 'charmeem_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'charmeem_wrapper_end', 10);

function charmeem_wrapper_start() {
  echo '<section id="main">';
}

function charmeem_wrapper_end() {
  echo '</section>';
}

//Once you’re happy that your theme fully supports WooCommerce, you should declare it in the code to hide the, “Your theme does not declare WooCommerce support” message
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}