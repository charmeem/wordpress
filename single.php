<?php
// Selecting different template file for my single article POST based on category ID
//$post = $wp_query->post;
//if (in_category('1')) {  // Category DAWAH
//	include(TEMPLATEPATH . '/single-article.php');
//}
//else {
?>

<?php get_header();?>
<!-- Begin #container2 this holds the contenttttttt and sidebars-->
	<div id="container2" class="bdr bdr-top">
	<!-- Begin first section holds the left content columns-->
		<div class="content left full">
			<?php if (have_posts())	: ?>
			<?php while (have_posts()) : the_post();?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<!--moving post-title from here to the header file
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a>
					</h2>
					<-->
					<!--  Removing post meta  from single post
					<p class="entry-meta">by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> in <?php the_category(", ")?></p>
					-->
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
		
		<?php get_footer();
//		}	//end if article post template
	
		?>