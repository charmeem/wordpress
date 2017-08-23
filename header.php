<html lang="en" class='no-js'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Who is our Lord</title>
		
		<!--Setting Viewport for mobile devices -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!-- Temporarily commenting out
		<link rel="apple-touch-icon" sizes="57x57" href="images/pngs/apple-touch-icon-57x57.png"/>
		<link rel="apple-touch-icon" sizes="72x72" href="images/pngs/apple-touch-icon-72x72.png"/>
		<link rel="apple-touch-icon" sizes="114x114" href="images/pngs/apple-touch-icon-114x114.png"/>
		-->
		<meta name="description" content="Description of content that contains top keyword phrases">
		<meta name="keywords" content="Key words and phrases, comma separated, not directly used in content - google ignores this tag but used in other engines as a fall back">

		<?php
		wp_head(); ?> 
		 
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
	<body <?php body_class('bg-main'); ?>> <!--this filter tag is used by add_filter e.g in function.php for loading category based stylesheet-->
		<div id="container"><!--defined in -layout-core.css  -->
			<header class="cm-header">
				<div id="cm-effect">
					<h1 class = "left" id="site-title"><?php bloginfo('name'); ?></h1>
					<?php if( !is_single() && !is_page() ) { 
					//Excluding Ticker for Single post and page types
					//and including post-title in the header by defining new id post-title...
					?>
						<div class = "ticker" >
							<h1 class="" id="site-description"><?php bloginfo( 'description' ); ?></h1>
						</div> 
					<?php }
					else { ?>
						<h1 id="post-title-in-header"><span><?php the_title();?></span></h1>
					<?php } ?>
					
					<nav id="mainNav" class="grd-vt-tertiary shdw-centered">
						<h2 class="screen-reader-text">Main Navigation:</h2>
						<!--//Adding navigation menu that is already register with register_nav_menu in functions.php file-->
						<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'sfTab')); ?>
					</nav><!--//top_navlist-->
					
				</div>	<!--//cm-effect-->

			</header>	<!--//header-->
		
		