=== Markdown ===

Description:	Allows markdown to be converted to HTML markup in post, pages or by wrapping in a shortcode.
Version:		2.1.0
Tags:			markdown
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/markdown/
Download link:	https://github.com/azurecurve/azrcrv-markdown/releases/download/v2.1.0/azrcrv-markdown.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	markdown
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Allows markdown to be converted to HTML markup in post, pages or by wrapping in a shortcode.

== Description ==

# Description

Options to enable conversion of markdown in posts, pages or wrap markdown in the [markdown] to have it parsed and converted into HTML markup. Place opening and closing markdown shortcode tags on separate lines to ensure markdown converted correctly.

Uses (Parsedown)[https://github.com/erusev/parsedown] and (Parsedown Extra)[https://github.com/erusev/parsedown-extra].

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

### [Version 2.1.0](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v2.1.0)
 * Fix plugin action link to use admin_url() function.
 * Rewrite option handling so defaults not stored in database on plugin initialisation.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.
 * Amend to only load css when shortcode on page.

### [Version 2.0.3](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v2.0.3)
 * Fix bug with setting of default options.
 * Fix bug with plugin menu.
 * Update plugin menu css.

### [Version 2.0.2](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v2.0.2)
 * Rewrite default option creation function to resolve several bugs.
 * Upgrade azurecurve plugin to store available plugins in options.
 
### [Version 2.0.1](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v2.0.1)
 * Update Update Manager class to v2.0.0.
 * Update azurecurve menu icon with compressed image.
 
### [Version 2.0.0](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v2.0.0)
 * Added options to enable markdown in post and page content; option for shortcode needs to be reconfigured after upgrade.
 * Rewrite how markdown shortcode is handled.
 * Fix bug with shortcodes setting being ignored.
 * Add azurecurve icon to plugins action link.

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v1.1.1)
 * Fix bug with incorrect language load text domain.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-markdown/releases/tag/v1.0.0)
 * Initial release.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://codepotent.com/classicpress/plugins/update-manager/) by [CodePotent](https://codepotent.com/) for fully integrated, no hassle, updates.

Some of the top plugins available from **azurecurve** are:
* [Add Twitter Cards](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/)
* [Breadcrumbs](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/)
* [Series Index](https://development.azurecurve.co.uk/classicpress-plugins/series-index/)
* [To Twitter](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/)
* [Theme Switcher](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/)
* [Toggle Show/Hide](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/)