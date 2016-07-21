=== Sitekit ===
Contributors: webvitaly
Donate link: http://web-profile.net/donate/
Tags: widget, widgets, search, archive, archives, category, categories, pages, shortcode, shortcodes, bloginfo
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 1.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Widgets: search, archives and categories. Shortcodes: archives, bloginfo and categories.

== Description ==

> **[Speedup and Protect WordPress](http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii "Silver Bullet Pro - Speedup and Protect WordPress in a Smart Way")** |
> **[Sitekit](http://web-profile.net/wordpress/plugins/sitekit/ "Plugin page")** |
> **[Donate](http://web-profile.net/donate/ "Support the development")** |
> **[GitHub](https://github.com/webvitalii/sitekit "Fork")**

= Settings: =

* Google Analytics code
* Show/hide google analytics code if user is logged in
* Head code
* Footer code

= Widgets: =

* Archives
* Categories
* Pages
* Search

= Shortcodes: =

* `[sitekit_archives]`
* `[sitekit_categories]`
* `[sitekit_bloginfo]`

[Shortcodes with params](https://wordpress.org/plugins/sitekit/other_notes/)


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


= Parameters for [sitekit_categories]: =
* **orderby** - the column to use for ordering categories list: `[sitekit_categories orderby="id"]`; by default list is sorted by title: `[sitekit_categories orderby="name"]`;
* **order** - how to sort categories list: `[sitekit_categories order="DESC"]`; by default list is sorted by ascending order (A-Z): `[sitekit_categories order="ASC"]`;
* **show_count** - display counter of posts in the categories list: `[sitekit_categories show_count="1"]`; by default counter is not shown: `[sitekit_categories show_count="0"]`;
* **hide_empty** - the column to use for ordering categories list: `[sitekit_categories hide_empty="0"]`; by default empty categories are hidden: `[sitekit_categories hide_empty="1"]`;
* **hierarchical** - show tree-like categories list: `[sitekit_categories hierarchical="0"]`; by default the list is hierarchical: `[sitekit_categories hierarchical="1"]`;
* **depth** - how many levels to include in categories list: `[sitekit_categories depth="5"]`; by default depth is unlimited: `[sitekit_categories depth="0"]`;
* **taxonomy** - which taxonomy to show in the list: `[sitekit_categories taxonomy="post_tag"]`; by default categories are shown: `[sitekit_categories taxonomy="category"]`;
* **child_of** - term ID to retrieve child terms of: `[sitekit_categories child_of="77"]`; by default all categories are shown: `[sitekit_categories child_of="0"]`;
* **exclude** - comma/space-separated string of term IDs to exclude: `[sitekit_categories exclude="77"]`; by default all categories are shown: `[sitekit_categories exclude=""]`;
* **exclude_tree** - comma/space-separated string of term IDs to exclude, along with their descendants: `[sitekit_categories exclude_tree="77"]`; by default all categories are shown: `[sitekit_categories exclude_tree=""]`;

[sitekit_categories] is based on [wp_list_categories function](https://developer.wordpress.org/reference/functions/wp_list_categories/).


= Parameters for [sitekit_bloginfo]: =
* `[sitekit_bloginfo show="name"]` - [sitekit_bloginfo params](https://developer.wordpress.org/reference/functions/bloginfo/);


[sitekit_bloginfo] is based on [bloginfo function](https://developer.wordpress.org/reference/functions/bloginfo/).


== Changelog ==

= 1.2 - 2016.06.07 =
* Added Google Analytics code setting
* Added Show/hide google analytics code if user is logged in setting
* Added Head code setting
* Added Footer code setting

= 1.1 - 2016.04.01 =
* Added pages widgets.

= 1.0 - 2016.03.30 =
* initial release: Widgets: search, archives and categories. Shortcodes: archives, bloginfo and categories.


== Installation ==

1. install and activate the plugin on the Plugins page
2. enjoy all plugin's features
