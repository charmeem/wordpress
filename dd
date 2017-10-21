<!DOCTYPE html>
<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 */
 get_header(); ?>
 <div class = "wrap">
     <div id="primary" class="content-area">
 <!-- Content are is enclosed in container class 'content-area' and comes before sidebar or other widgets
  this is search engine friendly approach and also makes CSS styling into multiple column easier -->
 
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		woocommerce_content();  ?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== charmeem_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param $num_sections integer
			 */
			$num_sections = apply_filters( 'charmeem_front_page_sections', 4 );
			global $charmeemcounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$charmeemcounter = $i;
				charmeem_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== charmeem_panel_count() ) ends here. ?>

	</main><!-- #main -->
    </div><!-- #primary -->
	
	<!-- if want to include sidebar on Front page-->
	<?php get_sidebar(); ?>
	
</div><!--.wrap-->		
		<?php get_footer();?>