<?php
/**
 * @since             1.0.0
 * @package           Custom_CSS_And_JS_Editor/includes
 *
 * Load Style and JS file in client side and admin side
 */ 


/**
	* @since 1.0.0
	* Load style and script in client side
	*/ 
if ( !function_exists( 'miccaje_plugin_admin_scripts' ) ) {

	function miccaje_plugin_admin_scripts( $hook ) {
		if ( 'appearance_page_miccaje-settings' != $hook ) {
			return;
		}
		if( is_admin() ) {  
      // add codemirror css
      wp_enqueue_style( 'miccaje-codemirror-css', MICCAJE_PLUGIN_DIR. 'admin/codemirror/codemirror.css' );
      wp_enqueue_style( 'miccaje-addon-hint-css', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/show-hint.css' );
      wp_enqueue_style( 'miccaje-addon-lint-css', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/lint.css' );
      wp_enqueue_style( 'miccaje-theme-css', MICCAJE_PLUGIN_DIR. 'admin/codemirror/theme/material.css' );
      wp_enqueue_style( 'miccaje-css', MICCAJE_PLUGIN_DIR. 'admin/css/style.css', '', '1.0.0' );
			
			// add codemirror js
      wp_enqueue_script( 'miccaje-codemirror-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/codemirror.js', '', '', true );
      wp_enqueue_script( 'miccaje-mode-css-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/mode/css.js', '', '', true );
      wp_enqueue_script( 'miccaje-mode-javascript-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/mode/javascript.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-show-hint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/show-hint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-show-css-hint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/css-hint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-show-javascript-hint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/javascript-hint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-active-line-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/active-line.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-closebrackets-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/closebrackets.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-lint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/lint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-csslint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/csslint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-javascript-hint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/jshint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-css-lint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/css-lint.js', '', '', true );
      wp_enqueue_script( 'miccaje-addon-js-lint-js', MICCAJE_PLUGIN_DIR. 'admin/codemirror/addon/javascript-lint.js', '', '', true );
      wp_enqueue_script( 'miccaje-admin-js', MICCAJE_PLUGIN_DIR. 'admin/js/script.js', '', '1.0.0', true ); 

      // get editor settings
      $editor_word_wrap = get_option('miccaje_editor_settings_word_wrap');
      if ( !empty( $editor_word_wrap ) && $editor_word_wrap == 1 ) {
      	$editor_word_wrap = 'true';
      } else {
      	$editor_word_wrap = 'false';
      }
      $editor_tab_size = get_option('miccaje_editor_settings_tab_size');
      if ( empty( $editor_tab_size ) ) {
      	$editor_tab_size = '2';
      }
      $editor_theme = get_option('miccaje_editor_settings_theme');
      if ( !empty( $editor_theme ) && $editor_theme == 'light' ) {
      	$editor_theme = '"default"';
      } else if ( !empty( $editor_theme ) && $editor_theme == 'dark' ) {
      	$editor_theme = '"material"';
      } else {
      	$editor_theme = '"default"';
      }
      $editor_font_size = get_option('miccaje_editor_settings_font_size');
      if ( empty( $editor_font_size ) ) {
      	$editor_font_size = '16px';
      }
      $editor_line_height = get_option('miccaje_editor_settings_line_height');
      if ( empty( $editor_line_height ) ) {
      	$editor_line_height = '1.5';
      }

    	// add inline style
    	$editor_style = '
				.miccaje_form .css-editor,
				.miccaje_form .js-editor {
					font-size: '.$editor_font_size.';
					line-height: '.$editor_line_height.';
				}
    	';
			wp_add_inline_style('miccaje-css', $editor_style);

			// define codemirror
      $css_script = 'jQuery( document ).ready( function() {
    		var css_editor = CodeMirror.fromTextArea(document.getElementById( "miccaje_css_editor_content" ), {
    			lineNumbers: true,
    			lineWrapping: '.$editor_word_wrap.',
    			indentUnit: '.$editor_tab_size.',
					tabSize: '.$editor_tab_size.',
					lint: true,
					gutters: [ "CodeMirror-lint-markers" ],
    			extraKeys: {"Ctrl-Space": "autocomplete"},
    			mode: "css",
    			autoCloseBrackets: true,
    			styleActiveLine: true,
    			theme: '.$editor_theme.',
    		});
    		css_editor.setSize(null, 500);
    	} );';

    	$js_script = 'jQuery( document ).ready( function() {
    		var css_editor = CodeMirror.fromTextArea(document.getElementById( "miccaje_js_editor_content" ), {
    			lineNumbers: true,
    			lineWrapping: '.$editor_word_wrap.',
    			indentUnit: '.$editor_tab_size.',
					tabSize: '.$editor_tab_size.',
					lint: true,
					gutters: [ "CodeMirror-lint-markers" ],
    			extraKeys: {"Ctrl-Space": "autocomplete"},
    			mode: "javascript",
    			autoCloseBrackets: true,
    			styleActiveLine: true,
    			theme: '.$editor_theme.',
    		});
    		css_editor.setSize(null, 500);
    	} );';

      // add inline script
			if ( ! wp_script_is( 'jquery', 'done' ) ) {
			 wp_enqueue_script( 'jquery' );
			}
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'css-editor';
			if( $active_tab == 'css-editor' ) {
				wp_add_inline_script( 
					'jquery-migrate', 
					$css_script 
				);
			} else if( $active_tab == 'js-editor' ) {
				wp_add_inline_script( 
					'jquery-migrate', 
					$js_script 
				);
			}
    }
	}
	add_action('admin_enqueue_scripts', 'miccaje_plugin_admin_scripts');

}