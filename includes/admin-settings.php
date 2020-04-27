<?php
/**
 * @since             1.0.0
 * @package           Custom_CSS_And_JS_Editor/includes
 *
 * All Custom CSS and JS Code Editor settings are here
 */ 

// Prevent direct file access
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
	* @since 1.0.0
	* Generate setting page HTML
	*/ 
if ( !function_exists( 'miccaje_settings_page_html' ) ) {

	function miccaje_settings_page_html() {
		
		$miccaje_css_editor_content = get_option( 'miccaje_css_editor_content' );
		if ( empty( $miccaje_css_editor_content ) ) {
			$miccaje_css_editor_content = "/* Enter Your Custom CSS Here */\n";
		}
		$miccaje_js_editor_content = get_option( 'miccaje_js_editor_content' );
		if ( empty( $miccaje_js_editor_content ) ) {
			$miccaje_js_editor_content = "/* Enter Your Custom JS Here */\n";
		}

    ?>
    <div class="wrap">
    	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php settings_errors(); ?>
			
			<form action="options.php" method="post" name="miccaje_form" class="miccaje_form">
				
	    	<div class="miccaje-settings">
		      <?php
		        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'css-editor';
		      ?>
		       
		      <h2 class="nav-tab-wrapper">
		        <a href="?page=miccaje-settings&tab=css-editor" class="nav-tab <?php echo $active_tab == 'css-editor' ? 'nav-tab-active' : ''; ?>">CSS Editor</a>
		        <a href="?page=miccaje-settings&tab=js-editor" class="nav-tab <?php echo $active_tab == 'js-editor' ? 'nav-tab-active' : ''; ?>">JS Editor</a>
		        <a href="?page=miccaje-settings&tab=editor-settings" class="nav-tab <?php echo $active_tab == 'editor-settings' ? 'nav-tab-active' : ''; ?>">Editor Settings</a>
		      </h2>

		        <?php
		        	if( $active_tab == 'css-editor' ) {
		        		settings_fields( 'miccaje-css-editor' );
		            ?>
		            <div class="css-editor">
									<textarea name="miccaje_css_editor_content" class="css-js-editor" id="miccaje_css_editor_content" style="display: none;"><?php echo esc_html( $miccaje_css_editor_content ); ?></textarea>
								</div>
		            <?php
			        } else if( $active_tab == 'js-editor' ) {
			        	settings_fields( 'miccaje-js-editor' );
			        	?>
			        	<div class="js-editor">
			        		<textarea name="miccaje_js_editor_content" class="css-js-editor" id="miccaje_js_editor_content" style="display: none;"><?php echo esc_html( $miccaje_js_editor_content ); ?></textarea>
			        	</div>
			        	<?php
			        } else {
				    		echo "<div class='miccaje-white-box'>";
				    	  settings_fields( 'miccaje-editor-settings' );
				    	  do_settings_sections( 'miccaje-editor-settings' );
				    	  echo "</div>";
			        }
		        ?>

		        <?php 
		        	if( $active_tab == 'css-editor' ) {
		        		submit_button( __( 'Update Custom CSS', 'custom-css-and-js-editor' ), 'primary button-large' );
		        	} else if( $active_tab == 'js-editor' ) {
		        		submit_button( __( 'Update Custom JS', 'custom-css-and-js-editor' ), 'primary button-large' );
		        	} else {
		        		submit_button( __( 'Save Settings', 'custom-css-and-js-editor' ), 'primary button-large' );
		        	}
		        ?>
	  		</div>
  		</form>
    </div>
    <?php
	}

}


/**
	* @since 1.0.0
	* CSS and JS Settings
	*/
if ( !function_exists( 'miccaje_css_js_editor_init' ) ) {

	function miccaje_css_js_editor_init() {
		// register setting
	  register_setting('miccaje-css-editor', 'miccaje_css_editor_content');
	  register_setting('miccaje-js-editor', 'miccaje_js_editor_content');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_minify_css');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_minify_js');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_word_wrap');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_font_size');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_line_height');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_tab_size');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_direction');
	  register_setting('miccaje-editor-settings', 'miccaje_editor_settings_theme');

	  // add settings section
	  add_settings_section( 'miccaje_editor_settings', '', '', 'miccaje-editor-settings' );

	  // add settings field
	  add_settings_field( 'miccaje_editor_settings_minify_css', 'Minify CSS', 'miccaje_editor_settings_minify_css_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_minify_js', 'Minify JS', 'miccaje_editor_settings_minify_js_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_word_wrap', 'Word Wrap', 'miccaje_editor_settings_word_wrap_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_font_size', 'Font Size', 'miccaje_editor_settings_font_size_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_line_height', 'Line Height', 'miccaje_editor_settings_line_height_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_tab_size', 'Tab Size', 'miccaje_editor_settings_tab_size_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_direction', 'Multilingual Direction', 'miccaje_editor_settings_direction_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );
	  add_settings_field( 'miccaje_editor_settings_theme', 'Theme', 'miccaje_editor_settings_theme_cb', 'miccaje-editor-settings', 'miccaje_editor_settings' );

	}
	add_action('admin_init', 'miccaje_css_js_editor_init');

}

// Minify CSS callback
function miccaje_editor_settings_minify_css_cb() {
  $miccaje_editor_settings_minify_css = get_option('miccaje_editor_settings_minify_css');
  ?>
  <input type="checkbox" name="miccaje_editor_settings_minify_css" value="1" <?php echo checked( 1, $miccaje_editor_settings_minify_css, false ); ?>/>
  <?php
}

// Minify JS callback
function miccaje_editor_settings_minify_js_cb() {
  $miccaje_editor_settings_minify_js = get_option('miccaje_editor_settings_minify_js');
  ?>
  <input type="checkbox" name="miccaje_editor_settings_minify_js" value="1" <?php echo checked( 1, $miccaje_editor_settings_minify_js, false ); ?>/>
  <?php
}

// Word Wrap callback
function miccaje_editor_settings_word_wrap_cb() {
  $miccaje_editor_settings_word_wrap = get_option('miccaje_editor_settings_word_wrap');
  ?>
  <input type="checkbox" name="miccaje_editor_settings_word_wrap" value="1" <?php echo checked( 1, $miccaje_editor_settings_word_wrap, false ); ?>/>
  <?php
}

// Font Size callback
function miccaje_editor_settings_font_size_cb() {
  $miccaje_editor_settings_font_size = get_option('miccaje_editor_settings_font_size');
  ?>
  <input type="text" name="miccaje_editor_settings_font_size" value="<?php echo isset( $miccaje_editor_settings_font_size ) ? esc_attr( $miccaje_editor_settings_font_size ) : ''; ?>"> &nbsp;<span class="description">e.g. 16px or 2em</span>
  <?php
}

// Line Height callback
function miccaje_editor_settings_line_height_cb() {
  $miccaje_editor_settings_line_height = get_option('miccaje_editor_settings_line_height');
  ?>
  <input type="text" name="miccaje_editor_settings_line_height" value="<?php echo isset( $miccaje_editor_settings_line_height ) ? esc_attr( $miccaje_editor_settings_line_height ) : ''; ?>"> &nbsp;<span class="description">e.g. 1.5 or 20px</span>
  <?php
}

// Tab Size callback
function miccaje_editor_settings_tab_size_cb() {
  $miccaje_editor_settings_tab_size = get_option('miccaje_editor_settings_tab_size');
  ?>
  <select name="miccaje_editor_settings_tab_size">
	  <option value="1" <?php selected(get_option('miccaje_editor_settings_tab_size'), "1"); ?>>1</option>
	  <option value="2" <?php selected(get_option('miccaje_editor_settings_tab_size'), "2"); ?>>2</option>
	  <option value="3" <?php selected(get_option('miccaje_editor_settings_tab_size'), "3"); ?>>3</option>
	  <option value="4" <?php selected(get_option('miccaje_editor_settings_tab_size'), "4"); ?>>4</option>
	  <option value="5" <?php selected(get_option('miccaje_editor_settings_tab_size'), "5"); ?>>5</option>
	</select>
  <?php
}

// Multilingual LTR/RTL direction callback
function miccaje_editor_settings_direction_cb() {
  $miccaje_editor_settings_tab_size = get_option('miccaje_editor_settings_direction');
  ?>
  <select name="miccaje_editor_settings_direction">
	  <option value="ltr" <?php selected(get_option('miccaje_editor_settings_direction'), "ltr"); ?>>LTR</option>
	  <option value="rtl" <?php selected(get_option('miccaje_editor_settings_direction'), "rtl"); ?>>RTL</option>
	</select>
  <?php
}

// Theme callback
function miccaje_editor_settings_theme_cb() {
  $miccaje_editor_settings_theme = get_option('miccaje_editor_settings_theme');
  ?>
    <select name="miccaje_editor_settings_theme">
  	  <option value="light" <?php selected(get_option('miccaje_editor_settings_theme'), "light"); ?>>Light</option>
  	  <option value="dark" <?php selected(get_option('miccaje_editor_settings_theme'), "dark"); ?>>Dark</option>
  	</select>
  <?php
}