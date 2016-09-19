/* Sticky Post Fading Slider 
 *
 * set the stickies in a wrapper set to overflow hidden
 * wrap instead of wrapAll is working for me
 * version:1.1
 * Description: - Optimizing jQuery code by storing functions into variable so that jQuery runs only once
 *				- Also replacing jQuery keyword with $.
				- Removing test scripts
 * Date: 24-4-16
 *****************************************************/

//jQuery(function($){ 
/* shortcut for document ready
 * Since we want to optimize the code by replacing jQuery by $ this will not work here
 * instead we have to choose following approach
 */

 jQuery(document).ready(function($){
 var $sticky = $('.sticky'); //Assigning jQuery selection to variables for better performance and speed
							 // $ sign FOR THE VARIABLES IS ONLY USED AS CONVENTION..To show that it holds jQuery selection
 
 $("article:not(.sticky)").has(".bgimage").css('padding','0'); // restricting padding only to non sticky post without image. see article element in style
 
 
 $sticky.css({	// Adjusting .sticky class to make sticky post stack over each other
 position: 'absolute',
 top: '0',
 margin: '0',
 width: '100%',
 height: '400px',
 overflow: 'hidden'
 });

/*set the stickies in a wrapper set to overflow hidden*/
 $sticky.wrapAll('<div id="stickyRotate" style=" position: absolute;height: 400px; width: 100%; overflow:hidden; border: 1px solid #000;"></div>');
 
 
 $('.post:not(.sticky):first').css('margin-top','480px');//This Pushes the First not sticky posts down out of the way
														// Also determines height of article element with 
														// stickyRotate class@see above


/* Making a fancy slider 
 * set  "duration1" length short for each slide:(this is the var our function uses)
 * My aim is not to slide infinitely with short ntervals as it becomes boring after a while rather my design
 * Strategy is set long time say 5 minutes and then option to slide Manually.
 * This is acheived by using two timers and calling slider function twice, once without setinterval.
 */
 
$('.sticky:first').fadeTo(1000,1).hide().effect('slide',1000); //Giving sliding effect in the start
															   // using wp built-in 'effect' plugin
var duration1 = 5000;   // 5 sec duration for short slider
var duration2 = 300000; // 5 minutes repetition for longer slider
var intervalDuration = duration2 * $('.sticky').length; //create total interval duration length

loopStickies(duration1); // Function needs to run once before the setInterval kicks in

setInterval( 'loopStickies("'+duration2+'")', intervalDuration ); // setInterval will kick off slide in longer interval, duration2

/* Creating slider numbers 
 */

 $('.sticky:last')
//.after('<div id="stickyNav" style="position: absolute; padding: 10px 0 0 0; margin: 270px 0 0 550px; height: 25px; width: 250px; color: #eee; background: #000; text-align: center;"></div>');
.after('<div id="stickyNav"></div>');

$sticky
.each( function (i){
	var $sNav = $('#stickyNav');
	$sNav
	.fadeTo(10, 1)
	.append("<div class='sN' >"+(i+1)+"</div> ");
});


});//end docReady


/* A part of Sticky script that i put outside doc ready function because setInterval doesnot work inside doc ready function.
 * This function will be called from script placed inside doc ready function
 */
function loopStickies(duration) {
	var $ = jQuery.noConflict();  // Another way to use $ instead of jQuery keyword
	/*note the variable "duration" being passed*/
	var $sticky = $('.sticky');
	//$sticky.hide().each( function (i) {$(this).fadeIn(2000).delay(i*duration);});
	
	$sticky
	.hide()  // we want to hide all elements in the start
	.each( function (i){//i = numeric value that will increase with each loop		
		var $this = $(this);
		$this
		.css('z-index','i+10') //make sure each div is on it's own z-index. DOES NOT HAVE ANY EFFECT HOWEVER!
		//.fadeIn(2000).delay(i*duration).fadeOut(2000);
		.animate({backgroundColor:'black'}, i*duration, function(){ // bgcolor only used for the posts without bg image
		/*actual div fade in*/
		//$this.fadeIn( 3000 );
		$this.slideDown( 1000 );
		/* highlighting current post slider number */
		$("#stickyNav .sN").css('color','#666666');
		$('#stickyNav .sN:eq('+i+')').css('color','#ffffff');
		});//end animate
	});//end each
	
} //end loopStickies
