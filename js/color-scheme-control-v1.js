/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'charmeem-color-scheme' ),
		colorSchemeKeys = [
			'colorpicker_color_link',
			'colorpicker_color_menu',
			'colorpicker_color_post'
		],
		colorSettings = [
			'colorpicker_color_link',
			'colorpicker_color_menu',
			'colorpicker_color_post'
		];
        
	api.controlConstructor.select = api.Control.extend( {   
	// select points to control type defined for this control in customizer.php file @mmm
	//extends , extends Control of customize by overriding ready function in initializer	@mmm
	ready: function() {
			if ( 'color_scheme' === this.id ) {  // if control id = color_scheme
				this.setting.bind( 'change', function( value ) {  // update all controls when color scheme changes
					// Update Background Color.
					api( 'colorpicker_color_link' ).set( colorScheme[value].colors[0] );
					// here colorScheme is new object created by wp_localize_script function
					// in file customizer_nonclassify.php, see the comments there..
					
					api.control( 'colorpicker_color_link' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[0] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[0] );

					// Update Header/Sidebar Background Color.
					api( 'colorpicker_color_menu' ).set( colorScheme[value].colors[1] );
					api.control( 'colorpicker_color_menu' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[1] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[1] );

					// Update Header/Sidebar Text Color.
					//api( 'post' ).set( colorScheme[value].colors[4] );
					api.control( 'colorpicker_color_post' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[4] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[4] );
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
