<?php

/* Decouple branding and Blog title using existing 
 * empty function childtheme_override_blogtitle in 
 * thematic parent file header-extension.php and also
 * using customize text title from my option plugin
 * Also changinging order, bringing blog-title before branding 
*/
 function childtheme_override_brandingopen() {
	
    /* Fetching 'Radio select header type' option values stored in meem_setting_page.php   */
	global $childoptions;
	foreach ($childoptions as $value) {
	$$value['id'] = get_option($value['id'], $value['std']);
		  if($value['id'] == 'header_type') {
					$toso=($$value['id']); // $$ is important here!!
					//var_dump($toto);
					if($toso == 'Title'){
					
					/* Fetching image option stored in media library section 'form' on my setting page
					*/
								$toto = get_option('header_image');
	
								/* Storing again in mysql, previously I used variables but that didnot work
								*  as the variables are destroyed when new form submits 
								*/
								update_option('title_image',$toto); 
								//var_dump($toto);
					} 
					else { 
								$toko = get_option('header_image');
								
								/* Storing again in mysql, previously I used variables but that didnot work
								*  as the variables are destroyed when new form submits 
								*/
								update_option('brand_image',$toko); 
							}
			}
		}
	?>
	   <div id="blog-title">
			<img class = "attachment-thumb wp-post-image" src="<?php echo stripslashes(get_option('title_image')); ?>" />
	   </div> <!-- blog-title close -->
      
		 <!-- Adding Branding --> 
		 <div id="branding">
		 <!-- Adding img element in branding to try svg image -->
			<img class = "attachment-thumb wp-post-image" src="<?php echo stripslashes(get_option('brand_image')); ?>" />
		 </div> <!--Branding close . decoupling from blogtitle-->
		
	<?php 
			
	}// end function
		function childtheme_override_blogtitle() { // Dummy function to override the blogtitlt function
		}
		function childtheme_override_brandingclose() { // Dummy function to override the next branding close DIV
		}
