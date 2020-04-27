<?php
/**
 * @since             1.0.0
 * @package           Custom_CSS_And_JS_Editor/includes
 *
 */ 

// Prevent direct file access
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
	* @since 1.0.0
	* Register menu in admin
	* miccaje_settings_page_html function add in admin-settings.php file
	*/ 
if ( !function_exists( 'miccaje_admin_menu' ) ) {	

	function miccaje_admin_menu() {
		add_submenu_page(
        'themes.php',
        'Custom CSS and JS Editor',
        'Custom CSS / JS',
        'manage_options',
        'miccaje-settings',
        'miccaje_settings_page_html'
    );
	}
	add_action( 'admin_menu', 'miccaje_admin_menu' );

}

/**
	* @since 1.0.0
	* Add CSS and JS link to plugin diretory
	*/ 
if ( !function_exists( 'miccaje_css_editor_link' ) ) {	

	function miccaje_css_editor_link( $links ) {
		return array_merge(
			array(
				'css-editor' => '<a href="' . admin_url( 'themes.php?page=miccaje-settings&tab=css-editor.php&tab=css-editor' ) . '">' . __( 'Add CSS', 'custom-css-and-js-editor' ) . '</a>',
				'js-editor' => '<a href="' . admin_url( 'themes.php?page=miccaje-settings&tab=js-editor.php&tab=js-editor' ) . '">' . __( 'Add JS', 'custom-css-and-js-editor' ) . '</a>',
			),
			$links
		);
	}
	add_filter( 'plugin_action_links_' . plugin_basename( MICCAJE_PLUGIN_FILE_URL ), 'miccaje_css_editor_link' );

}

