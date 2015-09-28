/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

( function( $ ) {
	
	wp.customize('title_color',function( value ) {
                value.bind(function(to) {
                    $('.site-header, .header, .site-title, #blog-title').css('background', to );
                });
			});
	wp.customize('menu_color',function( value ) {
                value.bind(function(to) {
                    $('.menu, .navbar, .nav-menu').css('background', to );
                });
			});
	wp.customize('post_color',function( value ) {
                value.bind(function(to) {
                    $('.post').css('background', to );
                });
			});
	wp.customize('aside_color',function( value ) {
                value.bind(function(to) {
                    $('.aside').css('background', to );
                });
			});
	wp.customize('wgtitle_color',function( value ) {
                value.bind(function(to) {
                    $('.widgettitle').css('background', to );
                });
			});
	wp.customize('body_color',function( value ) {
                value.bind(function(to) {
                    $('body').css('background', to );
                });
			});
	wp.customize('entry_color',function( value ) {
                value.bind(function(to) {
                    $('.entry-title').css('background', to );
                });
			});
	wp.customize('footer_color',function( value ) {
                value.bind(function(to) {
                    $('#footer, .site-footer').css('background', to );
                });
			});
			
	
	
} )( jQuery );
