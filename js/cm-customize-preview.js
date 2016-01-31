/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var $style = $( '#mm-cm-color-scheme-css' ),
		api = wp.customize;
		
	if ( ! $style.length ) {
		$style = $( 'head' ).append( '<style type="text/css" id="mm-cm-color-scheme-css" />' )
		                    .find( '#mm-cm-color-scheme-css' );
							
	}

	// Site title.
	api( 'blogname', function( value ) {
	
			
			//It says " control 'blogname' value is bind to text of element with class '.site-title a'
	
	value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {  // api is binding CUSTOM EVENT 'preview-ready'
											 // this custom event is triggered from file '/include/customize-preview.js'
											 
		// Listen to the 'update-color-scheme-css' event which is triggered from previewer in 'cm-color-scheme-control.js' file
		api.preview.bind( 'update-color-scheme-css', function( css ) { 
		
		//console.log(css);
			$style.html( css );
		} );
	} );

} )( jQuery );
