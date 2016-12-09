/* Related STYLE Sheet : /styles/style-scroll-animation.css */

/* Ways of Working
 *
 * 1. Patterns or Best practices are followed as per Book: Professional JQuery
 *
 * 2. One of them is .widget UI that I will try to use here 
 *
 */

 (function($) { 

var $window = $(window);	
//
//$('article:not(.sticky)').addClass("animation-element slide-left");
//$(".post-title").addClass("animation-element slide-left");

function check_if_in_view() {

//1.Grab all .post-title class in article which are not sticky Then adding animation and slide-left class to it..
//NOTE SPACE before .post-title  .. see PAGE49 JQUERY and WORDPRESS BOOK
//$("article:not(.sticky) .post-title").addClass("animation-element slide-left");
//2.Grab all .post-title class in article which are even Then adding animation and slide-left class to it..
//$("article:even .post-title").addClass("animation-element slide-left");
//3.Grab all .post-title class in article which are not sticky and odd Then adding animation and slide-left class to it..
//$("article:not(.sticky):odd .post-title").addClass("animation-element slide-left");
//4.Grab all .post-title that contains specific text Then adds animation and slide-left class to it..
//$(".post-title:contains('Jesus')").addClass("animation-element slide-left");
//5.Grab all .post-title in post that has specific content Then adding animation and slide-left class to it.
//NOT WORKING
//$(".post:content('Allah') .post-title").addClass("animation-element slide-left");
//6.Grab .post-title class equal to a number Then adding different animation classes to it..
$("article:eq(4) .post-title").addClass("animation-element slide-left"); //slide-left selected element
$("article:eq(4) .bgimage").addClass("animation-element scale-small"); //scale selected element smaller
$("article:eq(5) .post-title").addClass("animation-element slide-left"); //slide-left selected element
//$("article:eq(6) .bgimage").addClass("animation-element scale-big");    	// scaling the selected element bigger
//$("article:eq(7) .bgimage").addClass("animation-element scale-small");    	// scaling the selected element smaller
//$("article:eq(8) .bgimage").addClass("animation-element scale-small");    	// scaling the selected element smaller
$("article:eq(9) .bgimage").addClass("animation-element slide-left");	//slide-left selected element
$("article:eq(11) .post-title").addClass("animation-element slide-left");//slide-left selected element
$("article:eq(12) .bgimage").addClass("animation-element slide-left");	//slide-left selected element
$("article:eq(14) .bgimage").addClass("animation-element bounce-up");	//slide-left selected element

  var $animation_elements = $('.animation-element');
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);
 
  $.each($animation_elements, function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);
 
    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
      $element.addClass('in-view');
    } else {
      $element.removeClass('in-view');
    }
  });
}
$window.on('scroll resize', check_if_in_view);
$window.trigger('scroll');
})(jQuery); 
