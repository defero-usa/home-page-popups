=== Home Page Popups ===
Contributors: 
Donate link: https://www.deferousa.com/
Tags: popups, home page popups, defero
Requires at least: 3.0.1
Tested up to: 5.8.2
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin allow to configure and schedule popups.

== Description ==

Publish, schedule, and edit home page popups.

== Installation ==

This section describes how to install the plugin and get it working.

add the following: 

<?php do_action('homepage_popups', ['category', 'category-2]); ?>

e.g.

1. Upload `home-page-popups.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.3.3 =
* Bug Fixes

= 1.3.2 =
* Bug Fixes

= 1.3.1 =
* Fixed options not loading

= 1.3.0 =
* Adding option for Bootstrap Version
* Updates to how it's displayed based on Bootstrap Version

= 1.2.5 =
* changed it to the action homepage_popups

= 1.2.4 =
* Updated modal to Bootstrap 5 (BREAKS COMPATIBILITY WITH BOOTSTRAP 4)

= 1.2.3 =
* Updated the Github Updater

= 1.2.2 =
* Removed general settings

= 1.2.1 =
* Small fixes

= 1.2 =
* Adding an updater

= 1.0 =
* Initial Release