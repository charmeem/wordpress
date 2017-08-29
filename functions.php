<?php

/**
 * Enqueue Scripts and Styles
 *
 */
 
add_action( 'wp_enqueue_scripts', 'charmeem_scripts' );
//NOTE: Need wp_head hook in header.php file
function charmeem_scripts() {
	
	// --- JS-JQuery files ---
	// Fading slider file
	if(!is_single()) {  
		// Bypassing slider for single post
		wp_enqueue_script('mm-cm-slider', get_bloginfo('stylesheet_directory') . '/js/mm-cm-slider-latest.js', array('jquery'),'20160419' ); 
	}
	//scroll header-header resizes while scrolling
	wp_enqueue_script('mm-cm-header', get_bloginfo('stylesheet_directory') . '/js/mm-cm-header.js', array('jquery'),'20160419' ); 
		
	//scroll Animation - different types of animations while scrolling
	wp_enqueue_script('mm-cm-animation', get_bloginfo('stylesheet_directory') . '/js/mm-cm-scroll-animation.js', array('jquery'),'20160425' ); 
		
	//Animated Search box in menu
	wp_enqueue_script('mm-cm-search', get_bloginfo('stylesheet_directory') . '/js/mm-cm-search-menu.js', array('jquery'),'20160506' ); 
		
	//Jquery Built-in EFFECTS plug-ins	
	
	// One liner Registering Built-in plug-ins for Color, UI both core and specific as well as dependencies
	// wp_enqueue_script("jquery-color","jquery-ui-core", "jquery-effects-core", "jquery-effects-blind", "jquery-effects-clip","jquery-effects-drop","jquery-effects-highlight","jquery-effects-puff","jquery-effects-scale","jquery-effects-size","jquery-effects-slide");
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-widget");
	wp_enqueue_script("jquery-color");
	wp_enqueue_script("jquery-effects-blind");
	wp_enqueue_script("jquery-effects-clip");
	wp_enqueue_script("jquery-effects-drop");
	wp_enqueue_script("jquery-effects-highlight");
	wp_enqueue_script("jquery-effects-size");
	wp_enqueue_script("jquery-effects-puff");
	wp_enqueue_script("jquery-effects-scale");
	wp_enqueue_script("jquery-effects-slide");
	wp_enqueue_script("jquery-effects-pulsate");
	wp_enqueue_script("jquery-effects-easing");
	
	// --- CSS Files ---
	// Load our main default stylesheet.
	wp_enqueue_style( 'mm-cm-style', get_stylesheet_uri() );
	
	//Style1- Title,Menu on one line- sliding description on second
	wp_enqueue_style( 'mm-cm-title1', get_template_directory_uri() . '/styles/style-1.css', array( 'mm-cm-style' ), '20160910' );
	
	//Style2- Title,Description on one line- Menu on second
	//wp_enqueue_style( 'mm-cm-title1', get_template_directory_uri() . '/styles/style-2.css', array( 'mm-cm-style' ), '20160910' );
	
	//scroll header
	wp_enqueue_style( 'mm-cm-sch', get_template_directory_uri() . '/styles/style-sh.css', array( 'mm-cm-style' ), '20160910' );
	
	//scroll animation
	wp_enqueue_style( 'mm-cm-sca', get_template_directory_uri() . '/styles/style-scroll-animation.css', array( 'mm-cm-style' ), '20160910' );
	
	//search icon in header with animation
	//wp_enqueue_style( 'mm-cm-sca', get_template_directory_uri() . '/styles/style-search-icon3.css', array( 'mm-cm-style' ), '20160910' );
	
}		 

//Selecting separate style sheets for different posts based on Categories.Can use separate file later.

//add_action( 'wp_enqueue_scripts', 'load_script_styles' );

//wp_enqueue_scripts hook does not work here  

//following is the right filter to use for category conditions.
// more condition tags can be used in the same function for different posts types.
/* 
add_filter( 'body_class', 'load_script_styles' );
function load_script_styles() {
	//if (is_page_template('single.php')) {  This does not work because page_template only work for post type= page not post or custom post types
	//if (is_single ()) {  This works but I want to be more specific based on the categories
	if (is_single() && in_category('dawah')) {  
	// posts with 'dawah' ( case sensitive) category has unique stylesheet named 'single-dawah' 'is_category' will not work here
	wp_enqueue_style("single-dawah", get_bloginfo('stylesheet_directory') . '/styles/single-dawah.css');
	}
 }
*/ 
 // body_class can be used to assign classes to different pages types. see related file in my_web directory

 
 /**
 * Registering New menu and showing Menu link on appearance panel
 *
 */
add_action( 'init', 'register_cm_menu' );
function register_cm_menu() {
	register_nav_menus(	array(
	    'top'   => __('Top Menu', 'charmeem'),
		'below' => __('Low Menu', 'charmeem'),
		'social'=> __('Social Menu', 'charmeem'),
	) );
}

/* Registering Widget areas and showing widget link on appearance Panel */	
	add_action( 'init', 'register_cm_widget' );
	function register_cm_widget() {
		register_sidebar (array(
							'name' => __('Sidebar','charmeem'),
							'id' => "sidebar-widget-area",
							'before_widget' => '<li id="%1$s" class="widget %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<h2 class="widgettitle">',
							'after_title' => '</h2>' )
		);
		register_sidebar (array(
							'name' => __('Left Footer','charmeem'),
							'id' => "footer-left-widget-area",
							'before_widget' => '<li id="%1$s" class="widget %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<h2 class="widgettitle">',
							'after_title' => '</h2>' )
		);
		register_sidebar (array(
							'name' => __('Right Footer','charmeem'),
							'id' => "footer-right-widget-area",
							'before_widget' => '<li id="%1$s" class="widget %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<h2 class="widgettitle">',
							'after_title' => '</h2>' )
		);
		// Defining My own widget Area on top of header
		register_sidebar (array(
							'name' => __('Right Above Header','charmeem'),
							'id' => "above-header-right-area",
							'before_widget' => '<li id="%1$s" class="widget %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<h2 class="widgettitle">',
							'after_title' => '</h2>' )
		);
		register_sidebar (array(
							'name' => __('Left Above Header','charmeem'),
							'id' => "above-header-left-area",
							'before_widget' => '<li id="%1$s" class="widget %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<h2 class="widgettitle">',
							'after_title' => '</h2>' )
		);
	}
	
// Place the widget before the header
add_action ('wp_head', 'add_my_widget');
function add_my_widget() {
	if ( is_active_sidebar( 'above-header-right-area' ) ) : ?>
		<div class="right two-thirds">
		<?php dynamic_sidebar( 'above-header-right-area' ); ?>
		</div>
		<div class="push"></div>
	<?php endif;
	
}


// Adding Featured image support
add_theme_support( 'post-thumbnails' );

/* Using Featured image as a post background image
 * By default featured image appears as <img> tag not as background

 //add_action( 'wp_head', 'cm_set_featured_background', 999);
	function cm_set_featured_background() {
	if(is_single()) {
		global $post;
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), small, false );
		if ($image_url[0]) {
			?>
			<style>
			html,body {
				height:100%;
				margin:0!important;
			}
			body {
				background:url(<?php echo $image_url[0]; ?>) #000 left top no-repeat;
				background-size: 100% 100%;	
			}
			</style>
			<?php
		}
		}
	}
 */
 
/* Customizer modification as per book
 * NOT WORKING AT THE MOMENT
 * I might use my own js method later

function add_theme_customizer( $wp_customize ) {
// SETTINGS
	$wp_customize->add_setting( 'content_link_color', array(
	'default' => '#088fff',
	'transport' => 'refresh',
	) );
// CONTROLS
	$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize, 'content_link_color', array(
	'label' => 'Content Link Color',
	'section' => 'colors',
	) ) );
}
add_action( 'customize_register', ' add_theme_customizer');

function theme_customize_css() {
	?>
	<style type="text/css">a { color:<?php echo get_theme_mod( 'content_link_color' ); ?>; }
	</style>
	<?php
}
add_action( 'wp_head', 'theme_customize_css');

*/


/* Changing excerpt() length */
function custom_excerpt_length( $length ) 
{
    return 100; // limit length to 20 words
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/* Adding a Class 'excerpt' to the_excerpt() paragraph <p>  */
function add_excerpt_class( $excerpt )
{
    $excerpt = str_replace( "<p", "<p class=\"excerpt\"", $excerpt );
    return $excerpt;
	}
add_filter( "the_excerpt", "add_excerpt_class" );


/* Adding Search box in the Menu 
 * BUT not Exactly the way as other li items
 */

// As of 3.1.10, Customizr doesn't output an html5 form.
//add_theme_support( 'html5', array( 'searchform' ) );
add_filter('wp_nav_menu_items', 'add_search_form_to_menu', 10, 2);
function add_search_form_to_menu($items, $args) {
  // If this isn't equal to 'header-menu' set up by function 'wp_nav_menu' in functions.php file, do nothing
  // It avaoids duplicate search form appended in the footer li section !!
    if( !($args->theme_location == 'header-menu') ) 
  	return $items;
  // On main menu: put styling around search and append it to the menu items
  return $items . '<li class="cm-nav-menu-search">' . get_search_form(false) . '</li>';
	  }

/* 
add_filter('wp_nav_menu_items','add_search_box', 10, 2);
function add_search_box($items, $args) {
        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();
 
        $items .= '<li>' . $searchform . '</li>';
 
    return $items;
}
*/


/* Page builder
 *
 */
//include_once( get_stylesheet_directory() . '/inc/page_builder.php');	

/* Customizer functionality
 *
 */
 include_once( get_stylesheet_directory() . '/inc/mm-cm-customizer.php');
 //include_once can be replaced by require_once if the included file is integral part of the project not optional.
 
 
/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );
 
?>
