﻿<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"> 
    <!-- avoiding unknown characters-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- resetting any default zoom for mobile devices, useful for responsive layouts-->

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- XFN™ (XHTML Friends Network) is a simple way to represent human relationships using hyperlinks-->

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <!--Using WordPress pingbacks is a good way to get more links to your blog.-->
	
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?> </title>
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<?php wp_head(); ?>
	
</head>
<body>
    
	<div class = "grid">
	<div id ="header">
	    <h1><a href="<?php bloginfo('url'); ?> ">wiol</a></h1>
	    <ul>
			<li><a href="#">HOME</a></li>
			<?php wp_list_pages('title_li=&include=2,11,13'); ?> <!--generates dynamic page lists-->
			<li id = "search">
			    <input type="text" name = "s" id ="s" value = "Enter search item" />
			</li>
		</ul>
	</div> <!--end header -->
	</div> <!--end grid -->
	
	<div id ="hero">
	  <div id = "heading">
	    <h1><a href="http://localhost/psd_to_html_/whoisourlord/inner1.php"> Who is Our Lord</a></h1>
		<p>All praise be to Allah. <br>The Lord of the Universe. <br>The most Merciful, the ever Merciful. <br>Master of the day of judgment.</p>
	  </div>  <!--end heading -->	
	  <div id ="player">
		    			
			<p>In the name of Allah, <br>the most Merciful, the <br> ever Merciful.</p>
			<p>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْم</p>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/play_button.png'; ?>" height="65" width="65" alt="play" />
			</a>
			
			
	  </div> <!-- end player -->
	</div> <!-- end hero -->
	
	<div id="content">
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	    <div id = "centre">
	      <div class="article">
	        <h2 style="background:url(<?php echo bloginfo('template_directory') . '/img/brushg1.png'; ?>) 10px 0px/266px 222px no-repeat #002157; "><a>Who is our Lord</a></h2>
            <p class ="caption">The Lord of the Universe. <br>The most Merciful, the ever Merciful. <br>Master of the day of judgment.</p>		
		  </div> <!-- end article -->
	    </div> <!-- end center-->
	
	    <div id = "lower">
          <div class = "grid">	
            <div class="article">
	       
		   <!-- <h2 style="background:url(img/pregnancy-week-13.jpg) 0px 0px/360px 260px no-repeat; "><a>Who are We</a></h2> -->
			<a href = "#" >
			<h2>Who are We</h2>
		    <img src="<?php echo bloginfo('template_directory') . '/img/pregnancy-week-13.jpg'; ?>" width='430px' height='300px' alt="1st article" />
			</a>
            </div> <!-- end article -->
	      </div> <!-- end grid -->	
	    </div> <!-- end lower -->    
	<?php endwhile; ?>
	
    <?php else: ?>
        <p> I am not Sure what you are looking for ></p>	
	<?php endif; ?>
	
	
	</div> <!-- end content -->
	
	<div id = "footer">
	    <div class = "grid">
		   <div id ="wiol">
		    <h2>Who is our Lord</h2>
		    <p> Phasellus interdum dignissim nibh, eget egestas
			velit bibendum vel. Integer aliquet, purus pretium  
			gravida maximus, ante nulla convallis nulla, sit amet 
			pulvinar odio tellus in mauris. Sed egestas varius rhoncus. 
			Fusce sed ultrices erat, et laoreet tortor. Curabitur 
			viverra gravida tellus.</p>
		 </div>
	    <div id ="kc">
		    <h2>Keep Connected</h2>
		    <p>Phasellus interdum :www.facebook.com</p>
		    <p>nibh, eget egestas ve: www.linkedin.com</p>
		    <p>it bibendum vel. Int  : www.twitter.com</p>
		    <p>ger aliquet, purus pre: www.skype.com</p>
		</div>
		<div id ="lb">
		    <h2>Latest Blogs</h2>
		    <p>Phasellus interdum iium jkj ddde </p>
		    <p>nibh, eget egestas veuytgu g g h</p>
		    <p>it bibendum vel. Int askjhkkjnjn </p>
		    <p>ger aliquet, purus pre kjhkjh kh </p>
		</div>
		<div id ="gallery">
		    <h2>Gallery</h2>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/imgg5.png'; ?>" width="65px" height="65px" alt="thumb1" />
			</a>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/logo.png'; ?>" width="65px" height="65px" alt="thumb2" />
			</a>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/imgg2.png'; ?>" width="65px" height="65px" alt="thumb3" />
			</a>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/imgg4.png'; ?>" width="65px" height="65px" alt="thumb4" />
			</a>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/pregnancy-week-13.jpg'; ?>" width="65px" height="65px" alt="thumb5" />
			</a>
			<a href = "#" >
			    <img src="<?php echo bloginfo('template_directory') . '/img/imgg3.png'; ?>" width="65px" height="65px" alt="thumb6" />
			</a>
			
		</div>
		</div> <!-- end grid -->
		<div id = "copyright">
		    <p> copyright@2018 charmeem soft</p>
		    <ul>
			    <li><a href="#">HOME</a></li>
			    <li><a href="#">CATEGORIES</a></li>
			    <li><a href="#">LEARNING</a></li>
			    <li><a href="#">ABOUT</a></li>
			</ul>	
		</div>
	<?php wp_footer(); ?>
	
	</div> <!-- end footer -->
	
	
</body>
</html>