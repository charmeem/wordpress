<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Charmeem
 *
 */

?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php _e( 'Top Menu', 'charmeem' ); ?>">

	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo charmeem_get_svg( array( 'icon' => 'bars' ) ); echo charmeem_get_svg( array( 'icon' => 'close' ) ); _e( 'Menu', 'charmeem' ); ?></button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

	<?php if ( ( charmeem_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo charmeem_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'charmeem' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->

<!-- original nav
<nav id="mainNav" class="grd-vt-tertiary shdw-centered">
						<h2 class="screen-reader-text">Main Navigation:</h2>
						<!--//Adding navigation menu that is already register with register_nav_menu in functions.php file
						
						<?php// wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'sfTab')); ?>
</nav>//top_navlist

-->