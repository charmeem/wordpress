<?php
/*
Template Name: Two columns article page
*/

/* This is a template file created for PAGE not single POST . for single post template check the file single-xx.php
 * As we need different header for our article page we are removing get_header() INCLUDE and hard coding
 * header file code here */
?>


<!DOCTYPE html>
<html lang="en" class='no-js'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Who is our Lord</title>
		<!-- wp adaptation-->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<!-- -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<link rel="apple-touch-icon" sizes="57x57" href="images/pngs/apple-touch-icon-57x57.png"/>
		<link rel="apple-touch-icon" sizes="72x72" href="images/pngs/apple-touch-icon-72x72.png"/>
		<link rel="apple-touch-icon" sizes="114x114" href="images/pngs/apple-touch-icon-114x114.png"/>

		<meta name="description" content="Description of content that contains top keyword phrases"></meta>
		<meta name="keywords" content="Key words and phrases, comma separated, not directly used in content - google ignores this tag but used in other engines as a fall back"></meta>
		
		<?php wp_head(); ?> <!-- hook for plugin supports-->
	
	</head>
	<body <?php body_class('bg-light'); ?>> <!-- auto generating classes-->
		<div id="acontainer"><!--giving new name to our layout container-->
			<header class="bg-main">
				<hgroup class="">
					<h1 class = "left one-third" id="site-title">
						<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
					</h1>
					<h2 class="right two-thirds" id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			</header><!--//header-->
		<nav id="mainNav" class="grd-vt-tertiary shdw-centered">
			<h2 class="screen-reader-text">Main Navigation:</h2>
			<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'sfTab')); ?>
		</nav><!--//top_navlist-->
		
<!-- removing #container2 , replacing with #container3 as we dont need background image on our 
	article page-->
	<div id="container3" class="bdr bdr-top"> 
	<!-- Begin first section holds the left content columns-->
		<div class="content3 left full">
		
			<?php if (have_posts())	: ?>
			<?php while (have_posts()) : the_post();?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title();?></a></h2>
					<!-- meta removed -->
					<div class="entry-content"><!--//post-->
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('large');
							} 
						 the_content();?>
					</div><!--//.entry-content-->
					<!-- read More  removed -->
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
			
			
			<div class="push"></div>
			</div><!--//#container2-->
			
		</div><!--//container-->
		<div id="across" class = "bdr grd-vt-main rnd shdw-centered">
		
		<?php get_footer();?>