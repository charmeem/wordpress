<?php

/*
	Plugin Name: Charmeem Color Design
	Plugin URI: http://www.charmeen.com
	Description:	*A simple interface to make customize colourful themes.
					*Designing Themes made easy by utilizing WP built-in 'Customizer' that gives live-preview of any customize
					*changes made to Wordpress.
					*Multiple themes supports
	Version: 2.0
	Author: Mubashir Mufti
	Author URI: http://www.charmeem.com
	License: GPLv2
	License URI:	http://www.gnu.org/licenses/gpl-2.0.html

	Copyright 2013  Mubashir Mufti  (email : mmufti@charmeem.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2,
	as published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	The license for this software can likely be found here:
	http://www.gnu.org/licenses/gpl-2.0.html
	If not, write to the Free Software Foundation Inc.
	51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

/********************************************
* Security for preventig direct access to files
*********************************************/
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/********************************************
* TRANSLATION FUNCTION
*********************************************/

add_action( 'plugins_loaded', 'charmeem_colorpicker_translation' ); //Add the translation function after the plugins loaded hook.

function charmeem_colorpicker_translation() {
if ( !is_admin() ) 													//If we’re not in the admin, load any translation of our plugin.
	load_plugin_textdomain( 'charmeem-plugins', false, 'charmeem-plugins/languages' );
	
}
	
/********************************************
* GLOBAL VARIABLES
********************************************/
$plugin_version = '2.0';											// for use on admin pages
$plugin_file = plugin_basename(__FILE__);							// plugin file for reference
define( 'THEME_COLOR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );	// define the absolute plugin path for includes
//$theme_color_options = get_option('theme_color_settings');			// retrieve our plugin settings from the options table

/********************************************
* INCLUDES - keeping it modular
********************************************/
//include_once( THEME_COLOR_PLUGIN_PATH . 'functions/color-customizer.php' );	// Adds control settings in customizer menu
//include_once( THEME_COLOR_PLUGIN_PATH . 'functions/customizer_classify.php' );	// Adds control settings in customizer menu
include_once( THEME_COLOR_PLUGIN_PATH . 'functions/customizer_nonclassify.php' );	// Adds control settings in customizer menu
include_once( THEME_COLOR_PLUGIN_PATH . 'functions/helpers.php' );			// Sanitizing
//include_once( THEME_COLOR_PLUGIN_PATH . 'functions/header-divider.php' ); // Divides header into 2 parts, title and branding
?>
