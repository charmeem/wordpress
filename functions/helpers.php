<?php


/**
 * sanitize a hexadecimal colour
 *
 * @param type $color
 * @return string
 */
function colorpicker_sanitize_hex_color( $color ) {

	if ( '' === $color ) {
		return '';
	}

	$color = str_replace( '#', '', $color );

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return '#' . $color;
	}

	return null;

}

