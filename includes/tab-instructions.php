<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Instructions tab.
 */
$tab_instructions_label = esc_html__( 'Instructions', 'azrcrv-m' );
$tab_instructions       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Markdown shortcode', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( 'When the %1$s shortcode functionality is enabled, text containing markdown can be wrapped with the %2$s shortcode to be converted on output to HTML.', 'azrcrv-m' ), 'markdown', '<code>[markdown]</code>' ) . '					
			</p>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Markdown in posts and pages', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				esc_html__( 'Posts and pages can be individually enabled for markdown; any markdown in the enabled post type will have markdown converted upon output to HTML. Any shortcode in the post content will be removed to avoid possible conflicts.', 'azrcrv-m' ) . '
					
			</p>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Markdown in comments', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				esc_html__( 'Comments can be enabled for markdown; any markdown in the comment will have markdown converted to HTML on output.', 'azrcrv-m' ) . '
					
			</p>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Markdown in custom post types', 'azrcrv-m' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				esc_html__( 'Custom post types which are public can also be enabled for markdown; this section of the options is only visible if such post types exist.', 'azrcrv-m' ) . '
					
			</p>
		
		</td>
	
	</tr>
	
</table>';
