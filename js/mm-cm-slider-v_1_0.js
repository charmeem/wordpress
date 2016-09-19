//jQuery(function($){ 
/* shortcut for document ready
 * Since we want to optimize the code by replacing jQuery by $ this will not work here
 * instead we have to choose following approach
 */

 jQuery(document).ready(function($){
 /* Now we can replace jQuery with $ sign below */
 
//jQuery(".post:odd").css("background", "#21759b");
//jQuery(".post:eq(4)").css("background", "#26b5b0");
//jQuery(".bgimage")bgImage[0]).hide();
//jQuery(".post").append("<div class='bgimage' style='background:url(http://localhost/wordpress/test.jpg); background-size:50% auto;'>");
//jQuery(".post").append("<div class='bgimage' style='background:url(<?php echo $image_url[0]; ?>) #81e742 center no-repeat; background-size:50% auto;'>");
//jQuery(".div [style='background']").hide();
/*
jQuery(".bgimage")
	.animate({
		fontSize: '140%',
		backgroundColor: '#21759b',
		},2000
	);
*/


/*
jQuery('.post:first')
	.hide()
	.slideDown(5000, 'linear')
	.delay(3000)
	.fadeTo('slow', .5);
*/	


/* First post tricks
jQuery('.post:first')
	.hide()
	.fadeTo(0, .1)
	.css("height","5px")
	.animate({
		height: '+=576px',
	},
	{
		duration: 4000,
		easing: 'swing',
		queue: false  // false means all arguments in .aniamate executes simultenously, height increase and fadeto together
					  // if set to true the height increases first then fadeto 1
	}
	)
	.fadeTo(3000, 1);	
*/
	
/*
jQuery('.bgimage')
.animate({'backgroundColor':'#ff6600'}, 'slow')
.animate({'backgroundColor':'#ffff99'}, 'slow')
.animate({'backgroundColor':'#ff6600'}, 'slow')
.animate({'backgroundColor':'#ffff99'}, 'slow');	
*/

	
/*
jQuery(".post .entry-content").hide();
jQuery(".post").after("<div class='openIt' style='color: #036; text-align:right; cursor:pointer;'>Expand</div>");
jQuery(".openIt").click(function() {
jQuery(this).prev(".post").find(".entry-content").slideToggle("slow");
});
jQuery(".openIt").toggle(function(){
jQuery(this).html("Close")},
function(){
jQuery(this).html("Expand")
});
*/

/* Snazzy Navigation
//this adds our #ufo div
//under our theme's menu header div
jQuery('#mainNav').prepend('<div id="ufo"> </div>');
//this fades the ufo div to 60%
jQuery('#ufo').fadeTo('slow', 0.6);
jQuery('li.menu-item').hover(function(){
	//animates each menu item to the right (from the left)
	jQuery(this).animate({paddingLeft: '+=25px'}, 400, 'swing');
	//this over rides the style sheet's background on hover
	jQuery(this).find('a').css('background','none');
	//this custom moves the ship image
	var p = jQuery(this);
	var position = p.position();
	jQuery("#ufo").fadeTo('slow', 1)
	.animate({marginLeft: position.left-175},
	{duration: 600, queue: false});
	},
	function(){
	//returns the menu item to it's location
	jQuery(this).animate({paddingLeft: '-=25px'}, 400, 'swing');
});//end hover
//this fades and moves the ship back to it's starting point
jQuery('.mainNav').hover(function(){
jQuery("#ufo").fadeIn(1000);
}, function(){
jQuery("#ufo").fadeTo('slow', .4)
.animate({marginLeft: '-5px'},
{duration: 600, queue: false});
});//end hover
*/


/* Sticky Post showcase 
 *
 * set the stickies in a wrapper set to overflow hidden
 * wrap instead of wrapAll is working for me
 *****************************************************/
 // Changing only the h1 of header to white , rest h1 follows style.css
jQuery(".cm-effect h1").css('color','white'); 
jQuery("article:not(.sticky)").has(".bgimage").css('padding','0'); // restricting padding only to non sticky post without image. see article element in style
//jQuery(".sticky").wrap('<div id="stickyRotate" style=" position: absolute;height: 298px; width: 1350px; overflow:hidden; border: 1px solid #000;"></div>');
jQuery('.sticky').wrap( "<div id='stickyRotate'></div>" );

//Adjusting background image, post-title and entry-meta(which is child of .sticky)
//jQuery('.sticky .bgimage').css('marginTop','-120px');
//jQuery('.sticky .post-title').css('padding','11% 7% 0 4%');
//jQuery('.sticky .entry-meta').css('padding','0 0 6.3% 4%');  //4% of 1350px

//This Pushes the First not sticky posts down out of the way
// Also detremines height of article element with stickyRotate class@see above
jQuery('.post:not(.sticky):first').css('margin-top','480px');	

//make sure the first .sticky post fades in:
//jQuery('.sticky:first').fadeIn();
// Note: here fadeIn does not work instead use fadeTo. See explan. in book 

// Making a fancy slider
//jQuery('.sticky:first').fadeTo(1000,1).hide().slideDown(2000, 'linear');
jQuery('.sticky:first').fadeTo(1000,1).hide().effect('slide',1000);
//using wp built-in 'effect' plugin


//set the "duration" length to 7 seconds for each slide:(this is the var our function uses)
var duration = 5000;

/*create the interval duration length, based on the duration:*/
var intervalDuration = duration * jQuery('.sticky').length;


/*the function needs to run once before the setInterval kicks in*/
loopStickies(duration);

//the setInterval will kick off loopStickies in 12 seconds: (6secs x number of sticky posts) */
setInterval( 'loopStickies("'+duration+'")', intervalDuration ); 

/* Creating slider numbers */
jQuery('.sticky:last')
//.after('<div id="stickyNav" style="position: absolute; padding: 10px 0 0 0; margin: 270px 0 0 550px; height: 25px; width: 250px; color: #eee; background: #000; text-align: center;"></div>');
.after('<div id="stickyNav"></div>');

jQuery('.sticky')
.each( function (i){
	jQuery('#stickyNav')
	.fadeTo(10, 1)
	.append("<div class='sN' >"+(i+1)+"</div> ");
});

/* Playing with EFFECTS
 */
 /* Highlight
 jQuery(".cm-effect h1").mouseover(
	function(){
	jQuery(this).effect('highlight', {color:'orange'},2000);
	//}, function(){
		//jQuery(this).stop().effect('highlight', {color:'white'}, 2000);
		});
*/
/* Size 
jQuery(".post-title a").hover(
	function(){
	jQuery(this).effect('size',	{to:{width:20, height:20}}, 2000 ); 
	}, function(){
	jQuery(this).effect('size',	{to:{width:50, height:50}}, 2000 );
	});
*/

/* Resizing with css 
jQuery(".cm-effect h1").hover(
	function(){
	jQuery(this).css('fontSize','31px')
	}, function(){
	jQuery(this).css('fontSize','34px')
	});
*/
	

});//end docReady





/* A part of Sticky script that i put outside doc ready function because setInterval doesnot work inside doc ready function.
 * This function will be called from script placed inside doc ready function
 */
function loopStickies(duration) {
	/*note the variable "duration" being passed*/
	jQuery('.sticky')
	.hide()  // we want to hide all elements in the start
	.each( function (i){
		/*i = numeric value that will increase with each loop*/
		//jQuery(this).hide();
		jQuery(this)
		/*make sure each div is on it's own z-index*/
		.css('z-index','i+10')
		//using the animate function to fade in each div 3 seconds apart*/
		.animate({'backgroundColor': '#bada55'}, i*duration, function(){
		/*actual div fade in*/
		jQuery(this).fadeIn(2000);
		/* highlighting current post slider number */
		jQuery("#stickyNav .sN").css('color','#666666');
		jQuery('#stickyNav .sN:eq('+i+')').css('color','#ffffff');
		});//end animate
	});//end each
} //end loopStickies
