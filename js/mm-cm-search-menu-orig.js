/* Related Style sheet style.css 
//(function($) { this is not working 
jQuery(document).ready(function($){
// A new class is added here to use as place holder for my mag_glass image..
$('.cm-nav-menu-search #searchsubmit').after("<span class='image-holder'></span>");
$('.image-holder').click(function() {
	$('.cm-nav-menu-search').toggleClass("cm-search-open");
	});
}); 
*/
/*
jQuery(document).ready(function($){
// A new class is added here to use as place holder for my mag_glass image..
$('.cm-nav-menu-search #searchsubmit').after("<span class='image-holder'></span>");
$('.cm-nav-menu-search #s').attr("onkeyup","keyUp();");
$('.image-holder').click(function() {
	$('.cm-nav-menu-search').addClass("cm-search-open");
	});
// Once submit #s gets open we can check for an input
$('.cm-nav-menu-search #s').on('input', function() {
	var input = $(this);
	var is_input = input.val();		
	if (is_input){$('#searchsubmit').submit();}
	else{$('.cm-nav-menu-search').removeClass("cm-search-open");}
	
});
}); 
*/

/* This function is included(.attr function see below) in the html attribute in search field
 * Aim is to bring saerchh submit button on top( click enabled) when input field is not empty
 * Otherwise icon picture element (.image-holder) is enabled 
 */

function keyUp(){
         var valux = jQuery('#s').val(); 
            valux = jQuery.trim(valux).length;
            if(valux !== 0){
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
		
        /* Not needed
        $(document).mouseup(function(){
            if(isOpen == true){
            submitInput.val('');
            $('#searchsubmit').css('z-index','-999');
            submitIcon.click();
            }
        });
        
        searchBox.mouseup(function(){
            return false;
        });
        
		*/
	  
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

});


/*
jQuery(document).ready(function($){
	$('#searchsubmit').remove();
	$('#s').after("<button id = 'searchsubmit' type='submit'><img 'src=images/mag_glass.svg'/></button>");
});

*/

/*
jQuery(document).ready(function($){
// A new class is added here to use as place holder for my mag_glass image..
$('.cm-nav-menu-search #searchsubmit').after("<span class='image-holder'></span>");
});

;( function( window ) {
	
	function UISearch( el, options ) {	
		this.el = el;
		this.inputEl = el.querySelector( 'form > input#s' );
		this._initEvents();
	}

	UISearch.prototype = {
		_initEvents : function() {
			var self = this,
				initSearchFn = function( ev ) {
					ev.stopPropagation();
					
					if( !classie.has( self.el, 'cm-search-open' ) ) { // open it
						ev.preventDefault();
						self.open();
					}
					else if( classie.has( self.el, 'cm-search-open' ) && /^\s*$/.test( self.inputEl.value ) ) { // close it
						self.close();
					}
				}

			this.el.addEventListener( 'click', initSearchFn );
			this.inputEl.addEventListener( 'click', function( ev ) { ev.stopPropagation(); });
		},
		open : function() {
			var self = this;
			classie.add( this.el, 'cm-search-open' );
			// close the search input if body is clicked
			var bodyFn = function( ev ) {
				self.close();
				this.removeEventListener( 'click', bodyFn );
			};
			document.addEventListener( 'click', bodyFn );
		},
		close : function() {
			classie.remove( this.el, 'cm-search-open' );
		}
	}

	// add to global namespace
	window.UISearch = UISearch;

} )( window );
*/

