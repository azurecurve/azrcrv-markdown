<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Markdown
 * Description: Allows markdown to be wrapped in a shortcode and converted to HTML.
 * Version: 1.1.1
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/markdown/
 * Text Domain: markdown
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname(__FILE__).'/pluginmenu/menu.php');
register_activation_hook(__FILE__, 'azrcrv_create_plugin_menu_m');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

// include Parsedown and ParsedownExtra
require "libraries/Parsedown/Parsedown.php";
require "libraries/ParsedownExtra/ParsedownExtra.php";

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// add actions
register_activation_hook(__FILE__, 'azrcrv_m_set_default_options');

// add actions
add_action('admin_menu', 'azrcrv_m_create_admin_menu');
add_action('admin_post_azrcrv_m_save_options', 'azrcrv_m_save_options');
add_action('plugins_loaded', 'azrcrv_m_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_m_add_plugin_action_link', 10, 2);
add_filter('the_content', 'azrcrv_m_markdown_shortcode_preprocess', 1);

// add shortcode
add_shortcode('markdown', 'azrcrv_m_markdown_shortcode');

// create global array to store markdown
$azrcrv_m_markdown = array();

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('markdown', false, $plugin_rel_path);
}

/**
 * Set default options for plugin.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_set_default_options($networkwide){
	
	$option_name = 'azrcrv-m';
	
	$new_options = array(
						'allow_shortcodes' => 1,
			);
	
	// set defaults for multi-site
	if (function_exists('is_multisite') && is_multisite()){
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide){
			global $wpdb;

			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			$original_blog_id = get_current_blog_id();

			foreach ($blog_ids as $blog_id){
				switch_to_blog($blog_id);

				if (get_option($option_name) === false){
					add_option($option_name, $new_options);
				}
			}

			switch_to_blog($original_blog_id);
		}else{
			if (get_option($option_name) === false){
				add_option($option_name, $new_options);
			}
		}
		if (get_site_option($option_name) === false){
			add_option($option_name, $new_options);
		}
	}
	//set defaults for single site
	else{
		if (get_option($option_name) === false){
			add_option($option_name, $new_options);
		}
	}
}

/**
 * Add plugin action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-m">'.esc_html__('Settings' ,'markdown').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add to menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_create_admin_menu(){
	//global $admin_page_hooks;
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Markdown Settings", 'markdown')
						,esc_html__("Markdown", 'markdown')
						,'manage_options'
						,'azrcrv-m'
						,'azrcrv_m_display_options');
}

/**
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_is_plugin_active($plugin){
    return in_array($plugin, (array) get_option('active_plugins', array()));
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_display_options(){
	if (!current_user_can('manage_options')){
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'markdown'));
    }
	
	// Retrieve plugin configuration options from database
	$options = get_option('azrcrv-m');
	?>
	<div id="azrcrv-m-general" class="wrap">
		<fieldset>
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			
			<?php if(isset($_GET['settings-updated'])){ ?>
				<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Settings have been saved.', 'markdown'); ?></strong></p>
				</div>
			<?php } ?>
			
			<form method="post" action="admin-post.php">
			
				<input type="hidden" name="action" value="azrcrv_m_save_options" />
				<input name="page_options" type="hidden" value="allow_shortcodes" />
				
				<!-- Adding security through hidden referrer field -->
				<?php wp_nonce_field('azrcrv-m', 'azrcrv-m-nonce'); ?>
				<table class="form-table">
				
					<tr><th scope="row"><label for="card_type"><?php esc_html_e('Enable shortcodes?', 'markdown'); ?></label></th><td>
						<fieldset><legend class="screen-reader-text"><span>Allow shortcodes in markdown</span></legend>
							<label for="allow_shortcodes"><input name="allow_shortcodes" type="checkbox" id="allow_shortcodes" value="1" <?php checked('1', $options['allow_shortcodes']); ?> /><?php esc_html_e('Allow markdown supplied in shortcodes to be parsed', 'markdown'); ?></label>
						</fieldset>
					</td></tr>
				
				</table>
				<input type="submit" value="Save Changes" class="button-primary"/>
			</form>
		</fieldset>
	</div>
	<?php
}

/**
 * Save settings.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_save_options(){
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'markdown'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-m', 'azrcrv-m-nonce')){
	
		// Retrieve original plugin options array
		$options = get_option('azrcrv-m');
		
		$option_name = 'allow_shortcodes';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		$option_name = 'min_length';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field(intval($_POST[$option_name]));
		}
		
		// Store updated options array to database
		update_option('azrcrv-m', $options);
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-m&settings-updated', admin_url('admin.php')));
		exit;
	}
}

/**
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_markdown_shortcode($atts, $content = null){
	global $azrcrv_m_markdown;
	
	$options = get_option('azrcrv-m');
	
    if (isset($azrcrv_m_markdown[$content])) {
      $content = $azrcrv_m_markdown[$content];
    }
	
    $content = html_entity_decode($content);
    $content = trim($content);
	
	$Parsedown = new ParsedownExtra();
	
	if ($options['allow_shortcodes'] == 1){
		$content = do_shortcode($content);
	}
	
	$output = $Parsedown->text($content);
	
	return $output;

}

// Replaces more than one underscore to same amount of spaces
function underscores_to_spaces($content) {
	$content = preg_replace_callback('/_{2,}/', function ($matches) {
		return str_replace('_', ' ', $matches[0]);
	}, $content);
	return $content;
}

function azrcrv_m_markdown_shortcode_preprocess($content) {
	global $shortcode_tags;

	// Backup current registered shortcodes and clear them all out
	$orig_shortcode_tags = $shortcode_tags;
	$shortcode_tags = array();

	add_shortcode('markdown', 'azrcrv_m_markdown_shortcode_pre');

	// Do the shortcode (only the one above is registered)
	$content = do_shortcode($content);	

	// Put the original shortcodes back
	$shortcode_tags = $orig_shortcode_tags;
	
	return $content;
}

function azrcrv_m_markdown_shortcode_pre($attr, $content = null) {
	global $azrcrv_m_markdown;
	$key = sha1($content);
	$azrcrv_m_markdown[$key] = $content;
	return "[markdown]{$key}[/markdown]";
}