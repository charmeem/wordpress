/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 *
 */

 
( function( api ) {
	var cssTemplate = wp.template( 'mm-cm-color-scheme' ),
		colorSchemeKeys = colorSample,
		/*
		    6colors in colorscheme control element in customizer panel
			'inner_background',
			'outer_background',
			'box_background',
			'text',
			'header_textcolor',
			'sidebar'
		*/
		colorSettings = colorSetting;
		/*
		 *    other control elements in the customizer panel based on selected theme
		 */
        
	api.controlConstructor.select = api.Control.extend( {   
	// This function triggers only when color scheme changes from front panel
	//It update/set the control elements to the new / changed values
	//extends Control of customize by overriding ready function in initializer
	
	ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
				// here colorSetting and colorScheme is new object created by wp_localize_script function
				// in file customizer_nonclassify.php, see the comments there..
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
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );
			//_.object is underscore javascript that
			// associate colorSchemeKeys with colorScheme[scheme].colors
		//console.log(colors);
		
		// Get individual color value of controls , background_color,header_..,sidebar_textcolor from the panel 
		// Merge in color scheme overrides.
		//_.each is also underscorejs used in place of for loop
	
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
			//console.log(colors);
		});

		/*Add additional colors.
		colors.secondary_textcolor = Color( colors.textcolor ).toCSS( 'rgba', 0.7 );
		colors.border_color = Color( colors.textcolor ).toCSS( 'rgba', 0.1 );
		colors.border_focus_color = Color( colors.textcolor ).toCSS( 'rgba', 0.3 );
		colors.secondary_sidebar_textcolor = Color( colors.sidebar_textcolor ).toCSS( 'rgba', 0.7 );
		colors.sidebar_border_color = Color( colors.sidebar_textcolor ).toCSS( 'rgba', 0.1 );
		colors.sidebar_border_focus_color = Color( colors.sidebar_textcolor ).toCSS( 'rgba', 0.3 );*/
		//console.log(cssTemplate);
		css = cssTemplate( colors );
//console.log(colors);
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS in the PHP file whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
