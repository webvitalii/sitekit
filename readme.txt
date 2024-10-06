=== Sitekit ===
Contributors: webvitaly
Donate link: http://web-profile.net/donate/
Tags: widget, widgets, search, archive, archives, category, categories, pages, shortcode, shortcodes, bloginfo, iframe
Requires at least: 4.0
Tested up to: 6.6.2
Stable tag: 1.8
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Widgets: search, archives and categories. Shortcodes: archives, bloginfo, iframe and categories.

== Description ==

* **[Advanced iFrame Pro](https://1.envato.market/KdRNz "Advanced iFrame Pro")**
* **[Sitekit](http://web-profile.net/wordpress/plugins/sitekit/ "Plugin page")**
* **[Donate](http://web-profile.net/donate/ "Support the development")**
* **[GitHub](https://github.com/webvitalii/sitekit "Fork")**

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

* `[sitekit_posts]`
* `[sitekit_archives]`
* `[sitekit_categories]`
* `[sitekit_bloginfo]`
* `[sitekit_iframe]`


== Other Notes ==

= Parameters for [sitekit_posts]: =
* **post_type** - show posts associated with certain type: `[sitekit_posts post_type="page"]`; by default posts are shown: `[sitekit_posts post_type="post"]`; Possible params: post | page | revision | attachment | nav_menu_item | any | your_custom_post_type
* **orderby** - the column to use for ordering posts list: `[sitekit_posts orderby="id"]`; by default list is sorted by date: `[sitekit_posts orderby="date"]`; Possible params: modified | title | name | ID | rand
* **order** - how to sort posts list: `[sitekit_posts order="DESC"]`; by default list is sorted by ascending order (A-Z): `[sitekit_posts order="ASC"]`;
* **posts_per_page** - how many posts to show in the list: `[sitekit_posts posts_per_page="50"]`; by default: `[sitekit_posts posts_per_page="100"]`;

[sitekit_posts] is based on [WP_Query class](https://codex.wordpress.org/Class_Reference/WP_Query).

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


= Parameters for [sitekit_iframe]: =

* **src** - source of the iframe: `[sitekit_iframe src="http://www.youtube.com/embed/4qsGTXLnmKs"]`; by default src="http://www.youtube.com/embed/4qsGTXLnmKs";
* **width** - width in pixels or in percents: `[sitekit_iframe width="100%"]` or `[sitekit_iframe width="600"]`; by default width="100%";
* **height** - height in pixels: `[sitekit_iframe height="500"]`; by default height="500";
* **scrolling** - with or without the scrollbar: `[sitekit_iframe scrolling="no"]`; by default scrolling="yes";
* **frameborder** - with or without the frame border: `[sitekit_iframe frameborder="0"]`; by default frameborder="0";
* **marginheight** - height of the margin: `[sitekit_iframe marginheight="0"]`; removed by default;
* **marginwidth** - width of the margin: `[sitekit_iframe marginwidth="0"]`; removed by default;
* **allowtransparency** - allows to set transparency of the iframe: `[sitekit_iframe allowtransparency="true"]`; removed by default;
* **id** - allows to add the id of the iframe: `[sitekit_iframe id="custom_id"]`; removed by default;
* **class** - allows to add the class of the iframe: `[sitekit_iframe class="custom_class"]`; by default class="iframe-class";
* **style** - allows to add the css styles of the iframe: `[sitekit_iframe style="margin-left:-30px;"]`; removed by default;
* **any_other_param** - allows to add new parameter of the iframe `[sitekit_iframe any_other_param="any_value"]`;
* **any_other_empty_param** - allows to add new empty parameter of the iframe (like "allowfullscreen" on youtube) `[sitekit_iframe any_other_empty_param=""]`;


= Parameters for [sitekit_menu]: =
The `[sitekit_menu]` shortcode allows you to display a custom menu. It supports all the parameters of the WordPress [wp_nav_menu()](https://developer.wordpress.org/reference/functions/wp_nav_menu/) function.

* **menu** - The menu that should be displayed. Accepts (matching in order) id, slug, name. Default: empty. Example: `[sitekit_menu menu="main-menu"]`
* **container** - Whether to wrap the ul, and what to wrap it with. Default 'div'. Example without a container: `[sitekit_menu menu="main-menu" container=""]`
* **container_class** - The class that is applied to the container. Default 'menu-{menu slug}-container'. Example: `[sitekit_menu menu="main-menu" container_class="custom-container"]`
* **container_id** - The ID that is applied to the container. Default empty.
* **menu_class** - CSS class to use for the ul element which forms the menu. Default 'menu'.  Example: `[sitekit_menu menu="main-menu" menu_class="custom-menu"]`
* **menu_id** - The ID that is applied to the ul element. Default empty.
* **echo** - Whether to echo the menu or return it. Default false.
* **fallback_cb** - If the menu doesn't exist, a callback function will fire. Default 'wp_page_menu'.
* **before** - Text before the link markup. Default empty.
* **after** - Text after the link markup. Default empty.
* **link_before** - Text before the link text. Default empty.
* **link_after** - Text after the link text. Default empty.
* **items_wrap** - How the list items should be wrapped. Default `<ul id="%1$s" class="%2$s">%3$s</ul>`.
* **depth** - How many levels of the hierarchy are to be included. 0 means all. Default 0. Example: `[sitekit_menu menu="primary-menu" depth="2"]`
* **walker** - Custom walker object to use. Default empty.


== Changelog ==

= 1.8 =
* Added [sitekit_menu] shortcode.

= 1.7 =
* Removed srcdoc iframe param for security reasons.

= 1.6 =
* Updated Google Analytics with new GA4 version.

= 1.5 =
* Removed all iframe attributes starting with "on". Examples: onload, onmouseover, onfocus, onpageshow, onclick.

= 1.4 =
* Sanitize iframe URL.

= 1.3 =
* Minor cleanup.

= 1.2 =
* Added Google Analytics code setting
* Added Show/hide google analytics code if user is logged in setting
* Added Head code setting
* Added Footer code setting

= 1.1 =
* Added pages widgets.

= 1.0 =
* initial release: Widgets: search, archives and categories. Shortcodes: archives, bloginfo and categories.


== Installation ==

1. install and activate the plugin on the Plugins page
2. enjoy all plugin's features
