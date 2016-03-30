=== Sitekit ===
Contributors: webvitaly
Donate link: http://web-profile.com.ua/donate/
Tags: widget, widgets, search, archive, archives, category, categories, shortcode, shortcodes, bloginfo
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Widgets: search, archives and categories. Shortcodes: archives and bloginfo.

== Description ==

> **[Silver Bullet Pro](http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii "Speedup and protect WordPress in a smart way")** |
> **[Sitekit](http://web-profile.com.ua/wordpress/plugins/sitekit/ "Plugin page")** |
> **[Donate](http://web-profile.com.ua/donate/ "Support the development")** |
> **[GitHub](https://github.com/webvitalii/sitekit "Fork")**

= Useful: =
* **[Silver Bullet Pro - Speedup and protect WordPress in a smart way](http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii "Speedup and protect WordPress in a smart way")**
* **[Anti-spam Pro - Block spam in comments](http://codecanyon.net/item/antispam-pro/6491169?ref=webvitalii "Block spam in comments")**


== Other Notes ==

= Parameters for [sitekit_archives]: =
* `[sitekit_archives]` - list of monthly archives links sorted by date;
* `[sitekit_archives type="yearly"]` - list of yearly archives links;
* `[sitekit_archives type="monthly"]` - list of monthly archives links;
* `[sitekit_archives type="weekly"]` - list of weekly archives links;
* `[sitekit_archives type="daily"]` - list of daily archives links;
* `[sitekit_archives type="postbypost"]` - list of all posts links sorted by date;
* `[sitekit_archives type="alpha"]` -  list of all posts links sorted by title;
* **limit** - how many links to be included in the list: `[sitekit_archives limit="10"]`; by default all links are shown: `[sitekit_archives limit=""]`;
* **format** - format for the archive: `[sitekit_archives format="option"]` - show as a dropdown; by default unordered list is shown: `[sitekit_archives format="html"]`;
* **show_post_count** - display counter of posts in the archive: `[sitekit_archives show_post_count="1"]`; by default counter is not shown: `[sitekit_archives show_post_count="0"]`;
* **order** - how to sort archives links: `[sitekit_archives order="ASC"]`; by default links are sorted by descending order (Z-A): `[sitekit_archives order="DESC"]`;

[sitekit_archives] is based on [wp_get_archives function](https://codex.wordpress.org/Function_Reference/wp_get_archives).


= Parameters for [sitekit_bloginfo]: =
* `[sitekit_bloginfo show="name"]` - [sitekit_bloginfo params](http://codex.wordpress.org/Function_Reference/get_bloginfo);


`[sitekit_bloginfo]` is based on [bloginfo function](https://codex.wordpress.org/Function_Reference/bloginfo).


== Changelog ==

= 1.0 - 2016.03.28 =
* initial release: search and archives widgets, [sitekit_archives] and [sitekit_bloginfo]


== Installation ==

1. install and activate the plugin on the Plugins page
2. enjoy all plugin's features
