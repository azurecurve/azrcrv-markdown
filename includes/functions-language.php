<?php
/*
	language functions
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Load language files.
 */
function load_languages() {
	$plugin_rel_path = basename( dirname( __FILE__ ) ) . '../assets/languages';
	load_plugin_textdomain( 'azrcrv-m', false, $plugin_rel_path );
}
