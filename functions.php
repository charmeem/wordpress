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
 
add_filter( 'body_class', 'load_script_styles' );
function load_script_styles() {
	//if (is_page_template('single.php')) {  This does not work because page_template only work for post type= page not post or custom post types
	//if (is_single ()) {  This works but I want to be more specific based on the categories
	if (is_single() && in_category('dawah')) {  
	// posts with 'dawah' ( case sensitive) category has unique stylesheet named 'single-dawah' 'is_category' will not work here
	wp_enqueue_style("single-dawah", get_bloginfo('stylesheet_directory') . '/styles/single-dawah.css');
	}
 } 
 // body_class can be used to assign classes to different pages types. see related file in my_web directory

 
 /**
 * Registering New menu and showing Menu link on appearance panel
 *
 */
add_action( 'init', 'register_cm_menu' );
function register_cm_menu() {
	register_nav_menus(
		array('header-menu' => __('Header Menu'))
	);
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
function custom_excerpt_length( $length ) {
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

/**PAGE BUILDER
 *
 * Taken from the blog of Narayan Prutsy ;qninmqte.com 
 * 
 * Description:
 * Simple Page builder Made in 5 Steps:
 * 
 * Using Jquery plugin 'gridster'
 */ 
	
 
// Workaround for not able to save the POST in case of empty Post Title or content
// If the post content, title and excerpt are empty WordPress will prevent the insertion of the post.
// You can trick WordPress by first filtering the input array so empty values are set to something else,
// and then later resetting these values back to empty strings. This will bypass the standard check.

add_filter('pre_post_title', 'wpse28021_mask_empty');
add_filter('pre_post_content', 'wpse28021_mask_empty');
function wpse28021_mask_empty($value)
{
    if ( empty($value) ) {
        return ' ';
    }
    return $value;
}

add_filter('wp_insert_post_data', 'wpse28021_unmask_empty');
function wpse28021_unmask_empty($data)
{
    if ( ' ' == $data['post_title'] ) {
        $data['post_title'] = '';
    }
    if ( ' ' == $data['post_content'] ) {
        $data['post_content'] = '';
    }
    return $data;
}

/* Enqueing gridster jQuery plugin files
 */
 
 add_action("admin_enqueue_scripts", "load_admin_scripts");
 function load_admin_scripts()	{ 
	 
	 wp_enqueue_style("gridster-style", get_bloginfo('stylesheet_directory') . '/gridster_v7/dist/jquery.gridster.min.css', false);
     wp_enqueue_script("jquery-gridster", get_bloginfo('stylesheet_directory') . '/js/jquery-2.2.4.min.js', false);
     wp_enqueue_script("gridster-script", get_bloginfo('stylesheet_directory') . '/gridster_v7/dist/jquery.gridster.min.js', false);
     wp_enqueue_script("gridster-script-extra", get_bloginfo('stylesheet_directory') . '/gridster_v7/dist/jquery.gridster.with-extras.min.js', false);
}

/* Embedding DRag and drop Page Builder Meta box in POST Edit SEction
 */

add_action("add_meta_boxes", "my_custom_meta_box");
function my_custom_meta_box() {  
	
	// First removing default post edit meta box 
	global $_wp_post_type_features;
	if(isset($_wp_post_type_features['post']['editor'])) {
		unset ($_wp_post_type_features['post']['editor']);
		}

	// Adding New Meta box in post section	
     add_meta_box("page-builder", "Charmeem Page Builder", "meta_box_callback", "post", "normal", "high", null);
	}
	
function meta_box_callback($object) { // Call back from add_meta_box function above
	wp_nonce_field(basename(__FILE__), 'page-builder');

    ?>	<!-- needs to change the following bad practice in href.-->
         <a class = "button" href="javascript:add_widget();" >Add Box</a><br>
         <div class="gridster" style="background-color: #dde3e5; width: 840px;" >
			<ul></ul>
         </div>
         <input type="text" name="complete_layout_data" id="complete_layout_data" style="display: none">
		 <a class = " button-primary " href="javascript:save_edit();" style="position: absolute; top:0; left:100px; " >Save Content</a><br/>
		 <!--Styling to bring save button up with the add button -->
		<!-- Renders an editor in my custom meta box -->
		<?php wp_editor("", "gridster_edit", array("tinymce" => true)); ?> <br> 
		
		<script type="text/javascript">
            var gridster = null;
            var currently_editing = null;
            var saved_data = <?php echo json_encode(get_post_meta($object->ID, 'complete_layout_data', true)); ?>;

            (function($){
			
                $(".gridster ul").gridster({
                    widget_base_dimensions: [200, 200],
					widget_margins: [10, 10],
                    resize: {
                        enabled: true,
                        stop: save,
                        axes: ['both']
                    },
                    draggable: {
                        stop: save
                    },
                    serialize_params: function($w, wgd){ 
					var obj = {col: wgd.col, row: wgd.row, size_x: wgd.size_x, size_y: wgd.size_y, content: decodeURIComponent($w[0].getAttribute("data-content"))} ; // Typo from decode to encode caused me lot of problems!
                     return obj;
                    }                 });

                 gridster = $(".gridster ul").gridster().data('gridster');
			
				if(saved_data !== ''){// avoiding syntax error for undefined saved_data in case of new post
                 saved_data = JSON.parse(saved_data);
				  // MAking object from already jason encoded var from above


                 for(var iii = 0; iii < saved_data.length; iii++)
					{	/* This add_widget populates when the post is saved or reloaded */
					gridster.add_widget("<li style='background-color: #ed3a00;'data-content=\""+encodeURIComponent(saved_data[iii].content)+"\"> <button onclick=\"remove_widget(event);\">Remove Box</button> <button onclick=\"edit(event);\">Edit</button></li>", saved_data[iii].size_x, saved_data[iii].size_y);       
					/* data-content is custom html5 attribute */
					/* encodeURIComponent encodes special characters in URI */
					}
				}
                 save();
             })(jQuery);

             function add_widget() {
				gridster.add_widget("<li style='background-color: #96d200;list-style: none;' data-content=\"\"><button onclick=\"remove_widget(event);\">Remove Box</button><button onclick=\"edit(event);\">Edit</button></li>", 1, 1);
                 save();
             }

             function remove_widget(e)
             {
                 e.target.parentNode.setAttribute("id", "remove_box");
                 gridster.remove_widget($('.gridster li#remove_box'));
                 save();
                 e.preventDefault();
             }

             function edit(e)
             {
                 currently_editing = e.target.parentNode;
				// console.log(currently_editing);
				// After pressing EDIT Button, fetch already saved content from data-content into editor= 'gridster_edit'
				//document.getElementById("gridster_edit").value = decodeURIComponent(currently_editing.getAttribute("data-content"));
				
				// Setting content of TinyMce text box equal to existing ,if any, data-content
				tmceSc = decodeURIComponent(currently_editing.getAttribute("data-content"));
				tinyMCE.activeEditor.setContent(tmceSc);
                
                 e.preventDefault();
             }

             function save_edit()
             {
			if(currently_editing !== null) { //Avoiding null reference error
			tmceGc = tinyMCE.activeEditor.getContent();
			currently_editing.setAttribute("data-content", encodeURIComponent(tmceGc));
			//currently_editing.setAttribute("data-content", encodeURIComponent(document.getElementById("gridster_edit").value));
					}
				 save();
             }

             function save()
             {
                 var json_str = JSON.stringify(gridster.serialize());
				 //console.log(json_str);
                 document.getElementById("complete_layout_data").value = json_str;
				 //"complete_layout_data" is a hidden input text field crteated above to save and retrive page data
             }
         </script>
     <?php

	}



/* Save CUSTOM Meta Box
 */
 
 add_action("save_post", "save_my_custom_meta_box", 10, 3);
 function save_my_custom_meta_box($post_id,  $post, $update)
{
     if (!isset($_POST["page-builder"]) || !wp_verify_nonce($_POST["page-builder"], basename(__FILE__)))
       return $post_id;
       
     if(!current_user_can("edit_post", $post_id))
         return $post_id;

     if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
         return $post_id;

     $slug = "post";
	
     if($slug != $post->post_type)
         return;


     $complete_layout_data = "";
     if(isset($_POST["complete_layout_data"])) // Check for any data input entered to our custom meta box
     {
         $complete_layout_data = $_POST["complete_layout_data"];
		// $complete_layout_data = wpautop( $complete_layout_data, false);
     }
     else
     {
         $complete_layout_data = "";
     }
     update_post_meta($post_id, "complete_layout_data", $complete_layout_data);
}

 /* Display Page on FrontEnd
  */
  
	
 add_filter("the_content", "page_builder_content_filter");
 function page_builder_content_filter($content) {
     global $post;
	 if("post" == get_post_type()) {
         $builder_content = json_decode(get_post_meta($post->ID, 'complete_layout_data', true));
		
		//print_r($builder_content);
		//var_dump($builder_content);
         $current_row = 0;

         foreach($builder_content as $key => $value) {
             
			 $con = wpautop($value->content, true); //Solving a chronic line feed disappearing problem in my Post content!!!
													// WAsted my 2 Dayz
			 
			 $col = $value->col;
             $row = $value->row;
             $size_x = $value->size_x;
			//print_r($current_row);
			//var_dump($con);
             if($row == $current_row){ // for 2nd column of first row
                 $content = $content . "";
// This $content is the Post content not the content of the page builder meta elements above !
                 if($size_x == 1) {
                     $content = $content . "<div class='gridster-box gridster-box-width-one'>";
                 }
                 else if($size_x == 2){
                     $content = $content . "<div class='gridster-box gridster-box-width-two'>";
                 }
                 else if($size_x == 3){
                     $content = $content . "<div class='gridster-box gridster-box-width-three'>";
                 }

                 $content = $content . $con . "</div>";
             }
             else
             {
                 if($current_row != 0) // For new rows we want to set display clear so that text appear on new row
                 {
                     $content = $content . "<div class='clear'></div></div>";    
                 }
				// for first row first column
                 $content = $content . "<div class='gridster-box-holder'>";
                 $current_row = $row;

                 if($size_x == 1)
                 {
                     $content = $content . "<div class='gridster-box gridster-box-width-one'>";
                 }
                 else if($size_x == 2)
                 {
                     $content = $content . "<div class='gridster-box gridster-box-width-two'>";
                 }
                 else if($size_x == 3)
                 {
                     $content = $content . "<div class='gridster-box gridster-box-width-three'>";
                 }

                 $content = $content . $con . "</div>";
             }
         }

         $content = $content . "</div>"; 
     }

     return $content;
}
/*
function clear_br($content){
		return str_replace("<br />","<br clear='none'/>", $content);
	}
	add_filter('the_content', 'clear_br');*/
/* Style and Position LAyout Builder Content
 */

 add_action("wp_footer", "frontend_inline_css");
 function frontend_inline_css() {
     
     $custom_css = "
		
         .gridster-box-holder{
         }
         .gridster-box{
             display: inline-block;
             float: left;
         }
         .gridster-box-width-one{
             width: 33%;
         }
         .gridster-box-width-two{
             width: 66%;
         }
         .gridster-box-width-three{
             width: 99%;
         }
         .clear{clear: both;}
         @media only screen and (min-width: 320px) and (max-width: 768px) {
             .gridster-box{
                 display: block;
                 float: none;
             }
             .gridster-box-width-one{
                 width: 100%;
             }
             .gridster-box-width-two{
                 width: 100%;
             }
             .gridster-box-width-three{
                 width: 100%;
             }   
         }
         ";

     echo "<style>".$custom_css."</style>";
}
 

	
?>
