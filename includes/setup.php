<?php
/*
	setup
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 */

// add actions.
add_action( 'admin_menu', __NAMESPACE__ . '\\create_admin_menu' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_languages' );
add_action( 'admin_init', __NAMESPACE__ . '\\register_admin_styles' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_styles' );
add_action( 'admin_init', __NAMESPACE__ . '\\register_admin_scripts' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts' );
add_action( 'admin_post_' . PLUGIN_UNDERSCORE . '_save_options', __NAMESPACE__ . '\\save_options' );

	// add additional actions.

// add filters.
add_filter( 'plugin_action_links', __NAMESPACE__ . '\\add_plugin_action_link', 10, 2 );
$plugin_slug_for_um = plugin_basename( trim( PLUGIN_FILE ) );
add_filter( 'codepotent_update_manager_' . $plugin_slug_for_um . '_image_path', __NAMESPACE__ . '\\custom_image_path' );
add_filter( 'codepotent_update_manager_' . $plugin_slug_for_um . '_image_url', __NAMESPACE__ . '\\custom_image_url' );

	// add additional filters.
	add_filter( 'the_content', __NAMESPACE__ . '\\convert_post_content_markdown_to_markup', 1, 2 );
	add_filter( 'comment_text', __NAMESPACE__ . '\\convert_comment_text_markdown_to_markup', 10, 3 );

// add shortcodes.
add_shortcode( 'markdown', __NAMESPACE__ . '\\markdown_shortcode' );
