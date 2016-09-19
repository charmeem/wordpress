(function($) { 
    $(window).scroll(function() {  //using window selector to find scroll position of viewport
        var scroll = $(window).scrollTop(); 
        if (scroll >= 500) { 
            $(".cm-header").addClass('smaller'); 
        } else { 
            $(".cm-header").removeClass("smaller"); 
        } 
    }); 
})(jQuery); 
