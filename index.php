<!DOCTYPE html>

<!-- TEMPLATE FLOW - index.php-header.php
-->
<?php get_header(); ?>
<!-- Begin #container2 this holds the content -->
	<div id="container2" class=" bdr-top">
		<!-- changing front to full width-->
		<div class="content left full ">
			<!-- THE LOOP -->
			<?php if (have_posts())	: ?>
				<?php while (have_posts()) : the_post();?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" >
					<?php 
					/* Making featured image as background image 
					* Using 'wp_get_attachment_image_src' template tag
					*/
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small', false );
					//Checking if featured image is attached, index 0 of the array var '$image_url'
					if ($image_url[0]) {	?>
						<div class="bgimage" style = "background-image:url(<?php echo $image_url[0]; ?>); "></div>
						<!--	<img class ="bgimage" src = "<?php //echo $image_url[0]; ?>" > -->
						<?php }	?>
						<h2 class="post-title "><a  href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
						<p class="entry-meta "><span>by </span><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> 
						<!--in <?php //the_category(", ")?>-->
						</p>
						<!--<div class="entry-content "> -->
						<?php
						//the_post_thumbnail('large');
						the_excerpt();
						//the_content();?>
						<!--</div> //.entry-content-->
						<!--<div class="push"></div>  -->
				</article>
				<?php endwhile; ?>
				<?php else : ?>
					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
				<?php endif; ?>
				<!--<div class="push"></div>  -->
				<!--</div> //.bgimage--THIS POSITION IS CRITICAL OTHERWISE WILL GIVE ERRATIC POST LISTING -->
				</div><!--content-->
				<!--<div class="push"></div>  -->
			</div><!--//#container2-->
		</div><!--//container-->
		<div id="across" class = "bdr grd-vt-main rnd shdw-centered">
			<?php get_footer();
			//wp_localize_script( 'cm-bgimage', 'bgImage',  $image_url );
		?>