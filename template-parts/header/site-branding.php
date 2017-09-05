<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Charmeem
 * 
 */

?>
<div class="site-branding">
	<div class="wrap">

		<?php the_custom_logo(); ?>
        <!-- template tag to display custom logo, add_theme_support is added in function.php--> 
		
		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php $description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
		</div><!-- .site-branding-text -->
       
	    <!--if no top-navigation then show svg icon-->
	    <?php if ( ( charmeem_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo charmeem_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'charmeem' ); ?></span></a>
	    <?php endif; ?>
		
		
		<!--OLD TEXT --
		<div id="cm-effect">
					<h1 class = "left" id="site-title"><?php// bloginfo('name'); ?></h1>
					<?php// if( !is_single() && !is_page() ) { 
					//Excluding Ticker for Single post and page types
					//and including post-title in the header by defining new id post-title...
					?>
						<div class = "ticker" >
							<h1 class="" id="site-description"><?php// bloginfo( 'description' ); ?></h1>
						</div> 
					<?php// }
					//else { ?>
						<h1 id="post-title-in-header"><span><?php// the_title();?></span></h1>
					<?php //} ?>
		</div> <!--cm-effect-->
        <!-- END OLD TEXT -->
		
	</div><!-- .wrap -->
</div><!-- .site-branding -->		