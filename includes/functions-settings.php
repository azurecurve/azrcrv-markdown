<?php
/*
	tab output on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Get options including defaults.
 */
function get_option_with_defaults( $option_name ) {

	$defaults = array(
		'allow_markdown' => array(
			'shortcodes' => 1,
			'post'       => 0,
			'page'       => 0,
			'comment'    => 0,
			'post_types' => array(),
		),
	);

	$options = get_option( $option_name, $defaults );

	$options = wp_parse_args( $options, $defaults );

	return $options;

}

/**
 * Display Settings page.
 */
function display_options() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'azrcrv-m' ) );
	}

	// Retrieve plugin configuration options from database.
	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	echo '<div id="' . esc_attr( PLUGIN_HYPHEN ) . '-general" class="wrap">';

		echo '<h1>';
			echo '<a href="' . esc_url_raw( DEVELOPER_RAW_LINK ) . esc_attr( PLUGIN_SHORT_SLUG ) . '/"><img src="' . esc_url_raw( plugins_url( '../assets/images/logo.svg', __FILE__ ) ) . '" style="padding-right: 6px; height: 20px; width: 20px;" alt="azurecurve" /></a>';
			echo esc_html( get_admin_page_title() );
		echo '</h1>';

	// phpcs:ignore.
	if ( isset( $_GET['settings-updated'] ) ) {
		echo '<div class="notice notice-success is-dismissible">
					<p><strong>' . esc_html__( 'Settings have been saved.', 'azrcrv-m' ) . '</strong></p>
				</div>';
	}

		require_once 'tab-settings.php';
		require_once 'tab-instructions.php';
		require_once 'tab-other-plugins.php';
		require_once 'tabs-output.php';
	?>
		
	</div>
	<?php
}

/**
 * Save settings.
 */
function save_options() {

	// Check that user has proper security level.
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permissions to perform this action', 'azrcrv-m' ) );
	}

	// Check that nonce field created in configuration form is present.
	if ( ! empty( $_POST ) && check_admin_referer( PLUGIN_HYPHEN, PLUGIN_HYPHEN . '-nonce' ) ) {

		// Retrieve original plugin options array.
		$options = get_option_with_defaults( PLUGIN_HYPHEN );

		$option_name = 'shortcodes';
		if ( isset( $_POST['allow_shortcodes'] ) ) {
			$options['allow_markdown'][ $option_name ] = 1;
		} else {
			$options['allow_markdown'][ $option_name ] = 0;
		}

		$option_name = 'post';
		if ( isset( $_POST['allow_post_markdown'] ) ) {
			$options['allow_markdown'][ $option_name ] = 1;
		} else {
			$options['allow_markdown'][ $option_name ] = 0;
		}

		$option_name = 'page';
		if ( isset( $_POST['allow_page_markdown'] ) ) {
			$options['allow_markdown'][ $option_name ] = 1;
		} else {
			$options['allow_markdown'][ $option_name ] = 0;
		}

		$option_name = 'comment';
		if ( isset( $_POST['allow_comment_markdown'] ) ) {
			$options['allow_markdown'][ $option_name ] = 1;
		} else {
			$options['allow_markdown'][ $option_name ] = 0;
		}

		// post types
		// phpcs:ignore.sanitized on next row
		$post_types                              = isset( $_POST['post_types'] ) ? (array) $_POST['post_types'] : array();
		$post_types                              = array_map( 'sanitize_text_field', $post_types );
		$options['allow_markdown']['post_types'] = $post_types;

		// Store updated options array to database.
		update_option( PLUGIN_HYPHEN, $options );

		// Redirect the page to the configuration form that was processed.
		wp_safe_redirect( add_query_arg( 'page', PLUGIN_HYPHEN . '&settings-updated', admin_url( 'admin.php' ) ) );
		exit;
	}
}
