=== Markdown ===

Description:	Allows markdown to be wrapped in a shortcode and converted to HTML.
Version:		1.1.0
Tags:			markdown
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/markdown/
Download link:	https://github.com/azurecurve/azrcrv-markdown/releases/download/v1.1.0/azrcrv-markdown.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	markdown
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Allows markdown to be wrapped in a shortcode and converted to HTML.

== Description ==

# Description

Wrap markdown in the [markdown]shortcodes[/markdown] to have it parsed and converted into HTML.

Option to allow the output of other shortcodes to be parsed for markdown; if not enabled any markdown output by other shortcodes will remain markdown.

Uses (Parsedown)[https://github.com/erusev/parsedown] and (Parsedown Extra)[https://github.com/erusev/parsedown-extra] as well as some code from (Markdown Shortcode)[https://github.com/JohannesHoppe/markdown-shortcode/].

This plugin is multisite compatible; settings need to be configured for each site.

== Installation ==

# Installation Instructions

 * Download the plugin from [GitHub](https://github.com/azurecurve/azrcrv-markdown/releases/latest/).
 * Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
 * Activate the plugin.
 * Configure relevant settings via the configuration page in the admin control panel (azurecurve menu).

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot fie is in the plugins languages folder and can also be downloaded from the plugin page on https://development.azurecurve.co.uk; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-markdown/tree/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-markdown/tree/v1.0.0)
 * Initial release.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://codepotent.com/classicpress/plugins/update-manager/) by [CodePotent](https://codepotent.com/) for fully automated, no hassle, updates.

Some of the top plugins available from **azurecurve** are:
* [Add Twitter Cards](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/)
* [Breadcrumbs](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/)
* [Series Index](https://development.azurecurve.co.uk/classicpress-plugins/series-index/)
* [To Twitter](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/)
* [Theme Switches](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/)
* [Toggle Show/Hide](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/)