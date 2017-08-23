<?php
/**
 * Displays content for front page
 *
 */
 ?>
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

