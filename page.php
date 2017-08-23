<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>
<!-- Begin #container2 this holds the cononontent and sidebars-->
	<div id="container2" class="bdr bdr-top">
	<!-- Begin first section holds the left content columns-->
		<div class="content left two-thirds">
			<?php if (have_posts())	: ?>
			<?php while (have_posts()) : the_post();?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title();?></a></h2>
					<div class="entry-content"><!--//post-->
					<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('large');
							}
					 the_content();
					 ?>
					</div><!--//.entry-content-->
					<div class="push"></div>
				</article>
					<?php endwhile; ?>
					<?php else : ?>
						<h2 class="center">Not Found</h2>
						<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
				<?php endif; ?>
				<div class="push"></div>
			</div><!--content-->
			
			<!-- Second section holds the right columns- the sidebar-->
			<?php get_sidebar(); ?>
				
			<div class="push"></div>
			</div><!--//#container2-->
			
		</div><!--//container-->
		<div id="across">
		
		<?php get_footer();?>