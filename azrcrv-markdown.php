<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Markdown
 * Description: Allows markdown to be converted to HTML markup in post, pages or by wrapping in a shortcode.
 * Version: 2.2.1
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
add_action('admin_init', 'azrcrv_create_plugin_menu_m');

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
add_action('admin_menu', 'azrcrv_m_create_admin_menu');
add_action('admin_post_azrcrv_m_save_options', 'azrcrv_m_save_options');
add_action('plugins_loaded', 'azrcrv_m_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_m_add_plugin_action_link', 10, 2);
add_filter ('the_content', 'azrcrv_m_convert_content_markdown_to_markup', 1, 2);
add_filter('codepotent_update_manager_image_path', 'azrcrv_m_custom_image_path');
add_filter('codepotent_update_manager_image_url', 'azrcrv_m_custom_image_url');

// add shortcode
add_shortcode('markdown', 'azrcrv_m_markdown_shortcode');

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
 * Custom plugin image path.
 *
 * @since 2.1.0
 *
 */
function azrcrv_m_custom_image_path($path){
    if (strpos($path, 'azrcrv-markdown') !== false){
        $path = plugin_dir_path(__FILE__).'assets/pluginimages';
    }
    return $path;
}

/**
 * Custom plugin image url.
 *
 * @since 2.1.0
 *
 */
function azrcrv_m_custom_image_url($url){
    if (strpos($url, 'azrcrv-markdown') !== false){
        $url = plugin_dir_url(__FILE__).'assets/pluginimages';
    }
    return $url;
}

/**
 * Get options including defaults.
 *
 * @since 2.1.0
 *
 */
function azrcrv_m_get_option($option_name){
 
	$defaults = array(
						'allow_markdown' => array(
												'shortcodes' => 1,
												'post' => 0,
												'page' => 0,
											),
					);

	$options = get_option($option_name, $defaults);

	$options = wp_parse_args($options, $defaults);

	return $options;

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
		$settings_link = '<a href="'.admin_url('admin.php?page=azrcrv-m').'"><img src="'.plugins_url('/pluginmenu/images/logo.svg', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'markdown').'</a>';
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
	$options = azrcrv_m_get_option('azrcrv-m');
	?>
	<div id="azrcrv-m-general" class="wrap">
		<fieldset>
			<h1>
				<?php
					echo '<a href="https://development.azurecurve.co.uk/classicpress-plugins/"><img src="'.plugins_url('/pluginmenu/images/logo.svg', __FILE__).'" style="padding-right: 6px; height: 20px; width: 20px;" alt="azurecurve" /></a>';
					esc_html_e(get_admin_page_title());
				?>
			</h1>
			
			<?php if(isset($_GET['settings-updated'])){ ?>
				<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Settings have been saved.', 'markdown'); ?></strong></p>
				</div>
			<?php } ?>
			
			<form method="post" action="admin-post.php">
			
				<input type="hidden" name="action" value="azrcrv_m_save_options" />
				<input name="page_options" type="hidden" value="allow_shortcodes,allow_post_markdown,allow_page_markdown" />
				
				<!-- Adding security through hidden referrer field -->
				<?php wp_nonce_field('azrcrv-m', 'azrcrv-m-nonce'); ?>
				<table class="form-table">
				
					<tr><th scope="row"><label for="card_type"><?php esc_html_e('Enable shortcodes?', 'markdown'); ?></label></th><td>
						<fieldset><legend class="screen-reader-text"><span>Allow shortcodes in markdown</span></legend>
							<label for="allow_shortcodes"><input name="allow_shortcodes" type="checkbox" id="allow_shortcodes" value="1" <?php checked('1', $options['allow_markdown']['shortcodes']); ?> /><?php esc_html_e('Allow markdown supplied in shortcodes to be parsed', 'markdown'); ?></label>
						</fieldset>
					</td></tr>
				
					<tr><th scope="row"><label for="card_type"><?php esc_html_e('Enable post markdown?', 'markdown'); ?></label></th><td>
						<fieldset><legend class="screen-reader-text"><span>Allow markdown in posts</span></legend>
							<label for="allow_post_markdown"><input name="allow_post_markdown" type="checkbox" id="allow_post_markdown" value="1" <?php checked('1', $options['allow_markdown']['post']); ?> /><?php esc_html_e('Allow markdown supplied in post content to be parsed', 'markdown'); ?></label>
						</fieldset>
					</td></tr>
				
					<tr><th scope="row"><label for="card_type"><?php esc_html_e('Enable page markdown?', 'markdown'); ?></label></th><td>
						<fieldset><legend class="screen-reader-text"><span>Allow markdown in pages</span></legend>
							<label for="allow_page_markdown"><input name="allow_page_markdown" type="checkbox" id="allow_page_markdown" value="1" <?php checked('1', $options['allow_markdown']['page']); ?> /><?php esc_html_e('Allow markdown supplied in page content to be parsed', 'markdown'); ?></label>
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
		
		$option_name = 'shortcodes';
		if (isset($_POST['allow_shortcodes'])){
			$options['allow_markdown'][$option_name] = 1;
		}else{
			$options['allow_markdown'][$option_name] = 0;
		}
		
		$option_name = 'post';
		if (isset($_POST['allow_post_markdown'])){
			$options['allow_markdown'][$option_name] = 1;
		}else{
			$options['allow_markdown'][$option_name] = 0;
		}
		
		$option_name = 'page';
		if (isset($_POST['allow_page_markdown'])){
			$options['allow_markdown'][$option_name] = 1;
		}else{
			$options['allow_markdown'][$option_name] = 0;
		}
		
		// Store updated options array to database
		update_option('azrcrv-m', $options);
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-m&settings-updated', admin_url('admin.php')));
		exit;
	}
}

/**
 * Convert markdown to markup in shortcode content.
 *
 * @since 1.0.0
 *
 */
function azrcrv_m_markdown_shortcode($atts, $content = null){
	
	$options = azrcrv_m_get_option('azrcrv-m');
	
	if ($options['allow_markdown']['shortcodes'] == 1){
		$output = html_entity_decode($content);
		$output = trim($output);
		
		$Parsedown = new ParsedownExtra();
		//$output = do_shortcode($output);
		$new_content = $Parsedown->text($content);
	}else{
		$new_content = $content;
	}
	
	return $new_content;

}

/**
 * Convert markdown to markup in post content.
 *
 * @since 2.0.0
 *
 */
function azrcrv_m_convert_content_markdown_to_markup($content){
	global $post;
	
	$options = azrcrv_m_get_option('azrcrv-m');
	
	if (($options['allow_markdown']['post'] == 1 AND $post->post_type == 'post') OR ($options['allow_markdown']['page'] == 1 AND $post->post_type == 'page')){
		$Parsedown = new ParsedownExtra();
		
		$new_content = $content;
		if ($options['allow_markdown']['post'] == 1){
			$new_content = str_replace('[markdown]', '', $new_content);
			$new_content = str_replace('[/markdown]', '', $new_content);
		}
		
		$new_content = $Parsedown->text(do_shortcode($new_content));
	}else{
		$new_content = $content;
	}
	
	return $new_content;
}