<?php
/**
 * The header for our theme , using thematic & twentyseventeen as a startup
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg">
<!-- 
    language_attribute Builds set of html attributes containing text direction and language information for the page
	class=no-js&no-svg used for sites does not support js and svg , separate css layouts are used for these sites
    if js and svg are used then js script in functions.php file is used to replace no-js to js and no-svg to svg
-->
	
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"> 
<!-- avaoiding unknown characters-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- resetting any default zoom for mobile devices, useful for responsive layouts-->

<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- XFN™ (XHTML Friends Network) is a simple way to represent human relationships using hyperlinks-->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--Using WordPress pingbacks is a good way to get more links to your blog.-->

<?php wp_head(); ?> 
		 
		 <!-- Hook for plugin supports
		  NOTE: Without this, the enqueue scripts function that I have added in function.php DOES not Work
		  However if i add enqueue script here directly then it works even without wp_head() hook.
		  REASON:
		  - wp_head() is action hook and is equivalent to do_action(wp_head);
		  - similarly in file 'wp-includes/default-filters.php', you'll see: 
     	     add_action( 'wp_head', 'wp_enqueue_scripts',1 );
			 and wp_enqueue_scripts is call back function equivalent to  do_action( 'wp_enqueue_scripts' );
			 Thats why we see that wp_enqueue_scripts DOESNOT WORK without wp_head()
 		  -->
</head>

<body <?php body_class(); ?>> 
<!--automatically generating classes for the body elements -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>
    <!-- for screen reader , go directly to the content -->

    <header id="masthead" class="site-header" role="banner">
    <!-- role attribute makes navigation easier for those using assistive devices -->
	
	<?php get_template_part( 'template-parts/header/header', 'image' ); ?>
	<!--Adding custom header, relevant custom-header Code is added in functions.php file-->
	
    <!-- Now comes navigation menu -->	
	<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->
		
		