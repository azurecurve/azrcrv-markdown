<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Settings tab.
 */

$tab_settings_label = PLUGIN_NAME . ' ' . esc_html__( 'Settings', 'azrcrv-m' );
$tab_settings       = '
<table class="form-table azrcrv-settings">
		
	<tr>
	
		<th scope="row" colspan="2">
		
			<label for="explanation">
				' . esc_html__( 'Markdown allows the user of markdown, instead of HTML markup, through a shortcode or on posts, pages and other post types.', 'azrcrv-m' ) . '
			</label>
			
		</th>
		
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Enable markdown shortcode', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Enable markdown shortcode?', 'azrcrv-m' ) . '
			
		</th>
		
		<td>
		
			<fieldset>
			
				<legend class="screen-reader-text">
						' . esc_html__( 'Allow shortcodes in markdown?', 'azrcrv-m' ) . '
				</legend>
				
				<label for="allow_shortcodes">
					<input name="allow_shortcodes" type="checkbox" id="allow_shortcodes" value="1" ' . checked( '1', $options['allow_markdown']['shortcodes'], false ) . ' /> ' . esc_html__( 'Allows markdown supplied in shortcodes to be parsed.', 'azrcrv-m' ) . '
				</label>
				
			</fieldset>
			
		</td>
		
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Enable markdown in posts and pages', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Enable markdown in posts?', 'azrcrv-m' ) . '
			
		</th>
		
		<td>
		
			<fieldset>
			
				<legend class="screen-reader-text">
						' . esc_html__( 'Allow markdown in posts?', 'azrcrv-m' ) . '
				</legend>
				
				<label for="allow_post_markdown">
					<input name="allow_post_markdown" type="checkbox" id="allow_post_markdown" value="1" ' . checked( '1', $options['allow_markdown']['post'], false ) . ' /> ' . esc_html__( 'Allows markdown supplied in post content to be parsed.', 'azrcrv-m' ) . '
				</label>
				
			</fieldset>
			
		</td>
		
	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Enable markdown in pages?', 'azrcrv-m' ) . '
			
		</th>
		
		<td>
		
			<fieldset>
			
				<legend class="screen-reader-text">
						' . esc_html__( 'Allow markdown in pages?', 'azrcrv-m' ) . '
				</legend>
				
				<label for="allow_page_markdown">
					<input name="allow_page_markdown" type="checkbox" id="allow_page_markdown" value="1" ' . checked( '1', $options['allow_markdown']['page'], false ) . ' /> ' . esc_html__( 'Allows markdown supplied in page content to be parsed.', 'azrcrv-m' ) . '
				</label>
				
			</fieldset>
			
		</td>
		
	</tr>
	
	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Enable markdown in comments', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Enable markdown in comments?', 'azrcrv-m' ) . '
			
		</th>
		
		<td>
		
			<fieldset>
			
				<legend class="screen-reader-text">
						' . esc_html__( 'Allow markdown in comments?', 'azrcrv-m' ) . '
				</legend>
				
				<label for="allow_comment_markdown">
					<input name="allow_comment_markdown" type="checkbox" id="allow_comment_markdown" value="1" ' . checked( '1', $options['allow_markdown']['comment'], false ) . ' /> ' . esc_html__( 'Allows markdown supplied in comment content to be parsed.', 'azrcrv-m' ) . '
				</label>
				
			</fieldset>
			
		</td>
		
	</tr>';

	$posttype_args = array(
		'public'   => true,
		'_builtin' => false,
	);
	$posttypes     = get_post_types( $posttype_args, 'objects', 'and' );
	asort( $posttypes );

	if ( $posttypes ) {

		$tab_settings .= '<tr>
			
				<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
					
						<h2 class="' . esc_attr( PLUGIN_HYPHEN ) . '">' . esc_html__( 'Enable markdown in custom post types', 'azrcrv-m' ) . '</h2>
					
				</th>

			</tr>';

		foreach ( $posttypes as $posttype ) {

			if ( $posttype->name != 'revision' and $posttype->name != 'page' and $posttype->name != 'post' ) {

				if ( isset( $options['allow_markdown']['post_types'][ $posttype->name ] ) ) {
					$current_setting = $options['allow_markdown']['post_types'][ $posttype->name ];
				} else {
					$current_setting = 0;
				}

				$tab_settings .= '<tr>
			
										<th scope="row">
										
											' . sprintf( esc_html__( 'Enable markdown in %s?', 'azrcrv-m' ), $posttype->labels->name ) . '
											
										</th>
										
										<td>
										
											<fieldset>
											
												<legend class="screen-reader-text">
														' . sprintf( esc_html__( 'Allow markdown in %s?', 'azrcrv-m' ), $posttype->labels->name ) . '
												</legend>
												
												<label for="allow_page_markdown">
													<input name="post_types[' . $posttype->name . ']" type="checkbox" id="post_types[' . $posttype->name . ']" value="1" ' . checked( '1', $current_setting, false ) . ' /> ' . sprintf( esc_html__( 'Allows markdown supplied in %s content to be parsed.', 'azrcrv-m' ), $posttype->labels->name ) . '
												</label>
												
											</fieldset>
											
										</td>
										
									</tr>';

			}
		}
	}

	$tab_settings .= '</table>';
