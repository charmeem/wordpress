<!DOCTYPE html>
<html lang="en" class='no-js'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Who is our Lord</title>
		
		<!--Setting Viewport for mobile devices -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="apple-touch-icon" sizes="57x57" href="images/pngs/apple-touch-icon-57x57.png"/>
		<link rel="apple-touch-icon" sizes="72x72" href="images/pngs/apple-touch-icon-72x72.png"/>
		<link rel="apple-touch-icon" sizes="114x114" href="images/pngs/apple-touch-icon-114x114.png"/>
		<meta name="description" content="Description of content that contains top keyword phrases"></meta>
		<meta name="keywords" content="Key words and phrases, comma separated, not directly used in content - google ignores this tag but used in other engines as a fall back"></meta>

		<?php
		
 		
		 wp_head(); ?> 
		 <!-- Hook for plugin supports
			  NOTE: Without this the enqueue scripts function that I have added in function.php DOES not Work
			        However if i add enqueue script here directly then it works even without wp_head() hook.
		 -->
	
	</head>
	<body <?php body_class('bg-main'); ?>> <!-- auto generating classes-->
		<div id="container"><!--layout container-->
			<header class="cm-header">
				<div id="cm-effect">
				<?php
				//Excluding Ticker for Single post types
				//and including post-title in the header by defining new id post-title...
				
					if(!is_single()) {
				?>
					<h1 class = "left" id="site-title"><?php bloginfo('name'); ?>
					<!--<a href="<?php// bloginfo('url'); ?>" title="<?php// bloginfo('name'); ?>"><?php// bloginfo('name'); ?></a>-->
					</h1>
					
					<div class = "ticker" >
					<h1 class="" id="site-description"><?php bloginfo( 'description' ); ?></h1>
					</div> 
				<?php }
					else { ?>
				
				<h1 class = "left" id="site-title"><?php bloginfo('name');?></h1>
				<h1 id="post-title-in-header"><span><?php the_title();?></span></h1>
				<?php } ?>
					
				<nav id="mainNav" class="grd-vt-tertiary shdw-centered">
					<h2 class="screen-reader-text">Main Navigation:</h2>
					<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'sfTab')); ?>
				</nav><!--//top_navlist-->
				<!-- Dont need this
			<div id="sb-search" class="sb-search">
				<form>
					<input class="sb-search-input" placeholder="Enter your search term..." type="search" value="" name="search" id="search">
					<input class="sb-search-submit" type="submit" value="">
					<span class="sb-icon-search"></span>
				</form>
			</div>
			-->	
	</div>


			</header><!--//header-->
		
		