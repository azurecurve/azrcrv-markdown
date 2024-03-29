<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Other Plugins tab.
 */
$plugin_array = get_option( 'azrcrv-plugin-menu' );

$plugin_list = '';
foreach ( $plugin_array as $plugin_name => $plugin_details ) {
	if ( $plugin_details['retired'] == 0 ) {
		$alternative_color = '';
		if ( isset( $plugin_details['bright'] ) and $plugin_details['bright'] == 1 ) {
			$alternative_color = 'bright-';
		}
		if ( isset( $plugin_details['premium'] ) and $plugin_details['premium'] == 1 ) {
			$alternative_color = 'premium-';
		}
		if ( ! is_plugin_active( $plugin_details['plugin_link'] ) ) {
			$plugin_list .= "<a href='{$plugin_details['dev_URL']}' class='azrcrv-{$alternative_color}plugin-index'>{$plugin_name}</a>";
		}
	}
}

if ( is_plugin_active( 'azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php' ) ) {
	$plugin_sic = '<a href="admin.php?page=azrcrv-sic" class="azrcrv-plugin-index">Shortcodes in Comments</a>';
} else {
	$plugin_sic = '<a href="' . DEVELOPER_RAW_LINK . 'shortcodes-in-comments/" class="azrcrv-plugin-index">Shortcodes in Comments</a>';
}
if ( is_plugin_active( 'azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php' ) ) {
	$plugin_siw = '<a href="admin.php?page=azrcrv-siw" class="azrcrv-plugin-index">Shortcodes in Widgets</a>';
} else {
	$plugin_siw = '<a href="' . DEVELOPER_RAW_LINK . 'shortcodes-in-widgets/" class="azrcrv-plugin-index">Shortcodes in Widgets</a>';
}

$tab_plugins_label = esc_html__( 'Other Plugins', 'azrcrv-m' );
$tab_plugins       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( '%1$s was one of the first plugin developers to start developing for ClassicPress; all plugins are available from %2$s and are integrated with the %3$s plugin for fully integrated, no hassle, updates.', 'azrcrv-m' ), '<strong>' . DEVELOPER_SHORTNAME . '</strong>', DEVELOPER_LINK, '<a href="https://directory.classicpress.net/plugins/update-manager/">Update Manager</a>' )
			. '</p>
			
		</td>
		
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Complementary Plugins', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>
	
	<tr>
	
		<td scope="row" colspan=2>
		
			<p>
				
				' . sprintf( esc_html__( '%s has the following plugins which allow shortcodes to be used in comments and widgets:', 'azrcrv-m' ), DEVELOPER_LINK ) . '</label>
				
				<ul class="azrcrv-plugin-index">
					<li>
						' .

						$plugin_sic

						. '
					</li>
					<li>
						' .

						$plugin_siw

						. '
					</li>
				</ul>
				
			</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Available Plugins', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>
	
	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( 'Other plugins available from %s, which you are not using, are:', 'azrcrv-m' ), '<strong>' . DEVELOPER_NAME . '</strong>' )
			. '</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<td scope="row" colspan=2>
		
			' . $plugin_list . '
			
		</td>

	</tr>
	
</table>';
