<?php
/**
 * @since             1.0.0
 * @package           Custom_CSS_And_JS_Editor/includes
 *
 * Set plugin default options
 */ 

// Prevent direct file access
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
	* @since 1.0.0
	* Plugin activation
	*/ 
function miccaje_activation_plugin() {
	// Set default settings
	if ( ! get_option( 'miccaje_editor_settings_word_wrap' ) ) {
		update_option('miccaje_editor_settings_word_wrap', '1');
	}
	if ( ! get_option( 'miccaje_editor_settings_font_size' ) ) {
		update_option('miccaje_editor_settings_font_size', '16px');
	}
	if ( ! get_option( 'miccaje_editor_settings_line_height' ) ) {
		update_option('miccaje_editor_settings_line_height', '1.5');
	}
}
register_activation_hook( MICCAJE_PLUGIN_FILE_URL, 'miccaje_activation_plugin' );