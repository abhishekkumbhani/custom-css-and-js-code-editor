<?php
/**
 * Plugin Name:       Custom CSS and JS Code Editor
 * Description:       A simple, lightweight WordPress plugin, allows you to add CSS and JS to your WordPress site with minification!.
 * Version:           1.0.0
 * Author:            Monster Infotech
 * Author URI:        https://monsterinfotech.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-css-and-js-code-editor
 * Domain Path:       /languages
 *
 * @since             1.0.0
 * @author      			Abhishek Kumbhani
 * @package           Custom_CSS_And_JS_Code_Editor
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
	* @since 1.0.0
	* Define plugin version
	*/
define( 'MICCAJCE_VERSION', '1.0.0' );

/**
	* @since 1.0.0
	* Define plugin directory file URL
	*/ 
define( 'MICCAJCE_PLUGIN_FILE_URL', __FILE__ );

/**
	* @since 1.0.0
	* Define plugin directory path
	*/ 
define( 'MICCAJCE_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

/**
	* @since 1.0.0
	* Register enqueue scripts
	*/ 
require_once plugin_dir_path( MICCAJCE_PLUGIN_FILE_URL ) . 'includes/load-scripts.php';

/**
	* @since 1.0.0
	* Register admin menu
	*/ 
require_once plugin_dir_path( MICCAJCE_PLUGIN_FILE_URL ) . 'includes/admin-menu.php';

/**
	* @since 1.0.0
	* Include Custom CSS and JS Code Editor settings
	*/ 
require_once plugin_dir_path( MICCAJCE_PLUGIN_FILE_URL ) . 'includes/admin-settings.php';
