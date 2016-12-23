/*! Note: By Mubashir Mufti
*  Trying to convert this into plug-in on modular pattern using UMD
*  Universal module definition, which is a module pattern
*  compatible with multiple module systems like
*  AMD, CommonJS, Node, RequireJS or plain JS script */



/* This function is included(.attr function see below) in the html attribute in search field
 * Aim is to bring saerchh submit button on top( click enabled) when input field is not empty
 * Otherwise icon picture element (.image-holder) is enabled 
 */
 
 ;(function(root, factory) {
	'use strict';
	// if Node Module or commonJS like
    if(typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    }
	// if AMD
    else if (typeof define === 'function' && define.amd) {
        define('cm-search', ['jquery'], factory);
    } else {
	// Browser globals (root is window)
       root.CharmeemSearch = factory(root.$ || root.jQuery);
    }

}(this, function($) {
	'use strict';
	
	
function keyUp(){
         var input = jQuery('#s').val(); 
            input = jQuery.trim(input).length;
            if(input !== 0){
                jQuery('#searchsubmit').css('z-index','99');
            } else{
                jQuery('#s').val(''); 
                jQuery('#searchsubmit').css('z-index','-999');
            }
    }
    
    jQuery(document).ready(function($){
	// A new class is added here to use as place holder for my mag_glass image..
	$('.cm-nav-menu-search #searchsubmit').after("<span class='image-holder'></span>");
	
	$('.cm-nav-menu-search #s').attr("onkeyup","keyUp();");
    
    var submitIcon = $('.image-holder');
        var submitInput = $('#s');
        var searchBox = $('.cm-nav-menu-search');
		var submitButton = $('#searchsubmit');
        var isOpen = false;
			  
	   /* When icon picture clicked a new class is added and removed alternatively. See style.css for more detail */
        submitIcon.click(function(){
			submitInput.val('');  // resetting the old search values to zero
            if(isOpen == false){
                searchBox.addClass('cm-search-open');
                isOpen = true;
            } else {
                searchBox.removeClass('cm-search-open');
                isOpen = false;
            }
    });

}); //end doc ready

}));
