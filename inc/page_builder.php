<?php
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
 * Can also try in Page section later..
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

    ?>
		<p> Press Add box button to create boxes then press Edit in respective box then take mouse to
			  the Editor below and type contents, once finished press Save Content button.
			  Repeat same procedure for the other boxes, Once finished Press Publish to save the Post </p>
		 
         <a class = "button" id = "add-widget" href="#" >Add Box</a>
		 <a class = " button-primary " id = "save-edit" href="#"  style="position:relative; " >Save Content</a> 
         <div class="gridster" style="background-color: #dde3e5; width: 840px;" >
			<ul></ul>
         </div>
         <input type="text" name="complete_layout_data" id="complete_layout_data" style="display: none">
		 
		 
		<!-- Adding tinymce editor in my custom meta box -->
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
			
			// event handlers for id's defined above in html '' attribute above	
			// try using $window.on(click, callbackbelowfunction); as in colorizer mm-cm-scroll-animation.js
			
             (document.getElementById("add-widget")).onclick = function() {
				gridster.add_widget("<li style='background-color: #96d200;list-style: none;' data-content=\"\"><button onclick=\"remove_widget(event);\">Remove Box</button><button onclick=\"edit(event);\">Edit</button></li>", 1, 1);
				// gridster.add_widget(html,size_x,size_y) in gridster.js script
                 save();
             };
			
			(document.getElementById("save-edit")).onclick = function()  {
			if(currently_editing !== null) { //Avoiding null reference error
			tmceGc = tinyMCE.activeEditor.getContent();
			currently_editing.setAttribute("data-content", encodeURIComponent(tmceGc));
			//currently_editing.setAttribute("data-content", encodeURIComponent(document.getElementById("gridster_edit").value));
					}
				 save();
             };
			 
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