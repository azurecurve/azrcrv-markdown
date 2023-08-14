<?php
/*
	tab output on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\Markdown;

/**
 * Convert markdown to markup in shortcode content.
 */
function markdown_shortcode( $atts, $content = null ) {

	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	if ( $options['allow_markdown']['shortcodes'] == 1 ) {

		$output = html_entity_decode( $content );

		$output = trim( $output );

		$Parsedown = new \ParsedownExtra();

		$output = do_shortcode( $output );

		$new_content = $Parsedown->text( $content );

	} else {

		$new_content = $content;

	}

	return $new_content;

}

/**
 * Convert markdown to markup in post content.
 */
function convert_post_content_markdown_to_markup( $content ) {

	global $post;

	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	if ( ( $options['allow_markdown']['post'] == 1 and $post->post_type == 'post' ) or ( $options['allow_markdown']['page'] == 1 and $post->post_type == 'page' ) or ( $options['allow_markdown']['post_types'][ $post->post_type ] == 1 ) ) {

		$Parsedown = new \ParsedownExtra();

		$new_content = $content;

		// remove markdown shortcode tags if present to avoid potential issues.
		$new_content = str_replace( '[markdown]', '', $new_content );
		$new_content = str_replace( '[/markdown]', '', $new_content );

		$new_content = $Parsedown->text( do_shortcode( $new_content ) );

	} else {

		$new_content = $content;

	}

	return $new_content;

}

/**
 * Convert markdown to markup in comments.
 */
function convert_comment_text_markdown_to_markup( $comment_text, $comment, $args ) {

	$new_comment = $comment_text;

	$options = get_option_with_defaults( PLUGIN_HYPHEN );

	if ( $options['allow_markdown']['comment'] == 1 ) {

		$Parsedown = new \ParsedownExtra();

		// remove markdown shortcode tags if present to avoid potential issues.
		$new_comment = str_replace( '[markdown]', '', $new_comment );
		$new_comment = str_replace( '[/markdown]', '', $new_comment );

		// execute shortcode
		$new_comment = $Parsedown->text( do_shortcode( $new_comment ) );

	}

	return $new_comment;

}
