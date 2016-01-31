/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 *
 */

 
( function( api ) {
	var cssTemplate = wp.template( 'mm-cm-color-scheme' );
		//colorSample,   see localize_script in php file
		// colorSetting, see localize_script in php file
		
        
	api.controlConstructor.select = api.Control.extend( {   
	
	ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
				// here colorSetting and colorScheme is new object created by wp_localize_script function
				// in file mm-cm-customizer.php, see the comments there..
				for ( var i =0; i < colorSetting.length; i++ ) {
					api( colorSetting[i] ).set( colorScheme[value].colors[i] );
					api.control( colorSetting[i] ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[i] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[i] );
					}
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.Base color
	function updateCSS() {
		//Get 6 colors of selected Color scheme Control value from the panel
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSample, colorScheme[ scheme ].colors );
		//_.object is underscore javascript that
		// associate colorSchemeKeys with colorScheme[scheme].colors
				
		
		_.each( colorSetting, function( setting ) {
			colors[ setting ] = api( setting )();
		});

		css = cssTemplate( colors );
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS in the PHP file whenever a color setting is changed.
	_.each( colorSetting, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
