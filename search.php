<?php get_header(); ?>
<!-- Begin #container2 this holds the content and sidebars-->
	<div id="container2" class="bdr bdr-top">
	<!-- Begin first section holds the left content columns-->
		<div class="content left full">
		<!--<h2 class="thisMonth embossed" style="color:#fff;">Here are your Search results</h2>-->
			<?php if (have_posts())	: ?>
			<?php while (have_posts()) : the_post();?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title();?></a></h2>
					<p class="entry-meta">by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> in <?php the_category(", ")?></p>
					<!--<div class="entry-content">-->
						<?php
						    // if ( has_post_thumbnail() ) {
							//the_post_thumbnail('large');
							//} 
						 //the_content();
						 the_excerpt();?>
					<!--</div>
					<p class="left"><a class="more" href="<?php the_permalink()?>">Read more &raquo;</a></p>
					<p class='right'><a class='comments-count' href='<?php the_permalink() ?>'><?php comments_number('0', '1', '%')?></a></p>
					<div class="push"></div>-->
				</article>
					<?php endwhile; ?>
					<?php else : ?>
						<h2 class="center">Not Found</h2>
						<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
					<h3>Latest articles:</h3>
					<?php $query = new WP_Query( array ( 'post_type' => 'post', 'post_count' => '5' ) );
					while ( $query->have_posts() ) : $query->the_post(); ?>
						<ul>
							<li>
								<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
								</a>
							</li>
						</ul>
					<?php endwhile; ?>
				<?php endif; ?>
				<div class="push"></div>
			</div><!--content-->
			
			<!-- Second section holds the right columns- the sidebar-->
			<?php// get_sidebar(); ?>
				
			<div class="push"></div>
			</div><!--//#container2-->
			
		</div><!--//container-->
		<div id="across" class = "bdr grd-vt-main rnd shdw-centered">
		
		<?php get_footer();?>