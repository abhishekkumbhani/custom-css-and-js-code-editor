<?php
/**
 * @since             1.0.0
 * @package           Custom_CSS_And_JS_Editor/includes
 *
 * Load Style and JS file in client side and admin side
 */ 

// Prevent direct file access
if ( !defined( 'ABSPATH' ) ) {
  exit;
}

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
      $editor_direction = get_option('miccaje_editor_settings_direction');
      if ( empty( $editor_direction ) ) {
        $editor_direction = 'ltr';
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
          direction: "'.$editor_direction.'",
    			theme: '.$editor_theme.',
    		});
    		css_editor.setSize(null, 600);
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
          direction: "'.$editor_direction.'",
    			theme: '.$editor_theme.',
    		});
    		css_editor.setSize(null, 600);
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

/**
  * @since 1.0.0
  * Whitelist query variables before processing
  */
  function miccaje_add_wp_var($public_query_vars) {
      $public_query_vars[] = 'miccaje_custom_css';
      return $public_query_vars;
  }
  add_filter('query_vars', 'miccaje_add_wp_var');

/**
  * @since 1.0.0
  * Genrate custom css file using
  */
  function miccaje_display_custom_css(){
    $get_query_string = get_query_var('miccaje_custom_css');
    if ($get_query_string == 'css'){
        header("Content-type: text/css");
        $miccaje_custom_css = get_option('miccaje_css_editor_content');

        // Filters text content and strips out disallowed HTML
        $miccaje_custom_css = wp_kses( $miccaje_custom_css, array( '\'', '\"' ) );

        $miccaje_custom_css = str_replace ( '&gt;' , '>' , $miccaje_custom_css );
        echo $miccaje_custom_css;
        exit;
    }
  }
  add_action('template_redirect', 'miccaje_display_custom_css');

/**
  * @since 1.0.0
  * If not empty add custom css file in frontend 
  */
  function miccaje_add_custom_css(){
    $get_css = get_option('miccaje_css_editor_content');
    if ( !empty($get_css) && $get_css != '' ) {
      $miccaje_base_url = site_url();
      if ( is_ssl() ) {
          $miccaje_css_base_url = site_url('/', 'https');
      }
      wp_enqueue_style( 'miccaje-custom',  $miccaje_css_base_url . '/?miccaje_custom_css=css' );
    }
  }
  add_action('wp_enqueue_scripts', 'miccaje_add_custom_css', 99999 );
