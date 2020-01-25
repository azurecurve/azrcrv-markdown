=== Markdown ===
Contributors: azurecurve
Tags: markdown, parsedown
Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/markdown/
Donate link: https://development.azurecurve.co.uk/support-development/
Requires at least: 1.0.0
Tested up to: 1.1.2
Requires PHP: 5.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows markdown to be wrapped in a shortcode and converted to HTML.

== Description ==

Wrap markdown in the [markdown]shortcodes[/markdown] to have it parsed and converted into HTML.

Option to allow the output of other shortcodes to be parsed for markdown; if not enabled any markdown output by other shortcodes will remain markdown.

Uses (Parsedown)[https://github.com/erusev/parsedown] and (Parsedown Extra)[https://github.com/erusev/parsedown] as well as some code from (Markdown Shortcode)[https://github.com/JohannesHoppe/markdown-shortcode/].

This plugin is multisite compatible; settings need to be configured for each site. 

== Installation ==

To install the Markdown plugin:
* Download the plugin from <a href='https://github.com/azurecurve/azrcrv-markdown/releases/latest/'>GitHub</a>.
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Configure relevant settings via the configuration page in the admin control panel (under the azurecurve menu).

== Changelog ==

Changes and feature additions for the Markdown plugin:

= 1.0.0 =
* Initial release.

== Frequently Asked Questions ==

= Can I translate this plugin? =
* Yes, the .pot fie is in the plugins languages folder and can also be downloaded from the plugin page on https://development.azurecurve.co.uk; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

= Is this plugin compatible with both WordPress and ClassicPress? =
* This plugin is developed for ClassicPress, but will likely work on WordPress.