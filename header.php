<!DOCTYPE html>
<html lang="en" class='no-js'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Who is our Lord</title>
		<!-- including Base stylesheet file -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
				
		<!--Style Type 1-- Title,Menu on one line- Description on second -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/styles/style-1.css" />
		<!--Style Type 2-- Title, Description on one line- Menu on second
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/styles/style-2.css" />
		-->
		<!--scroll header-->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/styles/style-sh.css" />
		<!--scroll animation-->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/styles/style-scroll-animation.css" />
		<!--search icon in header with animation
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/styles/search-icon3.css" />
		-->
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
		
 
		
		/* Here I include ( enqueue ) my JQuery files 
		 *
		 * Can include in seperate enqueue file later
		 *
		 * Plus JQuery built-in UI plug-ins
		 */
		
		 // Including My JQuery files
		 // Fading slider file
		 if(!is_single())  // Bypassing slider for single post
		wp_enqueue_script('mm-cm-slider', get_bloginfo('stylesheet_directory') . '/js/mm-cm-slider-latest.js', array('jquery'),'20160419' ); 
		
		/*--scroll header--header resizes while scrolling*/
		wp_enqueue_script('mm-cm-header', get_bloginfo('stylesheet_directory') . '/js/mm-cm-header.js', array('jquery'),'20160419' ); 
		
		/*--scroll Animation--*/
		wp_enqueue_script('mm-cm-animation', get_bloginfo('stylesheet_directory') . '/js/mm-cm-scroll-animation.js', array('jquery'),'20160425' ); 
		
		/*--Search box in menu Animation--*/
		wp_enqueue_script('mm-cm-search', get_bloginfo('stylesheet_directory') . '/js/mm-cm-search-menu.js', array('jquery'),'20160506' ); 
		
		
		//Jquery Built-in EFFECTS plug-ins	
		// One liner Registering Built-in plug-ins for Color, UI both core and specific as well as dependencies
		// wp_enqueue_script("jquery-color","jquery-ui-core", "jquery-effects-core", "jquery-effects-blind", "jquery-effects-clip","jquery-effects-drop","jquery-effects-highlight","jquery-effects-puff","jquery-effects-scale","jquery-effects-size","jquery-effects-slide");
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-color");
		wp_enqueue_script("jquery-effects-blind");
		wp_enqueue_script("jquery-effects-clip");
		wp_enqueue_script("jquery-effects-drop");
		wp_enqueue_script("jquery-effects-highlight");
		wp_enqueue_script("jquery-effects-size");
		wp_enqueue_script("jquery-effects-puff");
		wp_enqueue_script("jquery-effects-scale");
		wp_enqueue_script("jquery-effects-slide");
		wp_enqueue_script("jquery-effects-pulsate");
		wp_enqueue_script("jquery-effects-easing");
		
				
		// wp_head(); ?> <!-- hook for plugin supports-->
	
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
		
		