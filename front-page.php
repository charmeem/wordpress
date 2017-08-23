<!DOCTYPE html>
<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 *
 */
 get_header(); ?>
<!-- Begin #container2 this holds the cononontent and sidebars-->
	<div id="container2" class="bdr bdr-top">
	<!-- Begin first section holds the left content columns-->
		<div class="content left two-thirds">
        <main id="main" class="site-main" role="main">

		<?php  // show frontpage content
		if (have_posts())	:
			while (have_posts()) : the_post();
			    get_template_part( 'template-parts/page/content' , 'front-page' );
            endwhile;
		else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php get_search_form();
		endif; ?>
		
		<div class="push"></div>
		
		</main><!-- #main -->
		
		</div><!--content-->
			
		<!-- Second section holds the right columns- the sidebar-->
		<?php get_sidebar(); ?>
				
		</div><!--//container-->
		
		<div id="across">
		
		<?php get_footer();?>