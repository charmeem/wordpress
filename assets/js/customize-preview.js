/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'charmeem-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! to.length ) {
					$( '#charmeem-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-branding, .site-branding a, .site-description, .site-description a' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Color scheme.
	wp.customize( 'colorscheme', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'colorscheme_hue', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		});
	});

	// Page layouts.
	wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );
	
/**
 * My Customization
 * 1.0 Header image as background
 * 2.0 Title
 *    2.1 Title position
 */
 
 /**
  * 1.0 Header image as background.
  */
	wp.customize( 'background_header', function( value ) {
		value.bind( function( to ) {
//console.log (to);
			if ( true == to ){
			    $( '.site-content-contain ' ).css ( "background" , "transparent");
	        			
			} 
			else if( false === to) {
			    $bckgd_image = wp.customize( 'background_image' )();
			    $bckgd_color = wp.customize( 'background_color' )();
	            if ($bckgd_image) {
				//console.log ($bckgd_image);
				    $( '.site-content-contain ' ).css ("background-image", "url(" + $bckgd_image + ")" );
				} else {
			        wp.customize( 'background_image', function( value ) {	
				        //console.log(value);
				        //console.log (to);
		                value.bind( function( to ) {
					    //console.log (to);
					        $( '.site-content-contain ' ).css ("background-image", "url(" + to + ")" );
						
				         });	
	          	    });	
                  }
            }				  
	    });
	});	

/**
 * 2.1 Title Position
 */
//wp.customize('title_position', function  (value) {
//    value.bind( function ( to ){
//	    switch ( to ) {
//		    case 'topleft':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"-450px", "left":"0%"});
//				break;
//			case 'topcenter':
//			    $( '.site-title a' ).css ({ "position":"absolute", "top":"-450px", "left":"30%"});
//				break;
//			case 'topright':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"-450px", "left":"60%"});
//				break;
//			case 'midleft':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"-200px", "left":"0%"});
//				break;
//			case 'midcenter':
//			    $( '.site-title a' ).css ({ "position":"absolute", "top":"-200px", "left":"30%"});
//				break;
//			case 'midright':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"-200px", "left":"60%"});
//				break;
//			case 'bottomleft':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"0px", "left":"0%"});
//				break;
//			case 'bottomcenter':
//			    $( '.site-title a' ).css ({ "position":"absolute", "top":"0px", "left":"30%"});
//				break;
//			case 'bottomright':
//			    $( '.site-title a' ).css ({ "position":"absolute","top":"0px", "left":"60%"});
//				break;	
//		    }
//		} 
//	);
//});


} )( jQuery );