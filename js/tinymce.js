(function() {
    tinymce.PluginManager.add('sitekit_tinymce_button', function(editor, url) {
        editor.addButton('sitekit_tinymce_button', {
            text: 'Sitekit',
            type: 'menubutton',
            menu: [{
				text: 'Posts',
				onclick: function() {
					editor.windowManager.open({
						title: 'Sitekit Posts shortcode params',
						body: [{
							type: 'textbox',
							name: 'posts_per_page',
							label: 'Posts per page',
							value: '10' // by default
						}, {
							type: 'listbox', // listbox | combobox
							name: 'order',
							label: 'Order',
							values : [
								{ text: 'Descending', value: 'DESC' },
								{ text: 'Ascending', value: 'ASC' }
							],
							value: 'DESC' // by default
						}, {
							type: 'listbox', // listbox | combobox
							name: 'orderby',
							label: 'Order by',
							values : [
								{ text: 'Created date', value: 'date' },
								{ text: 'Modified date', value: 'modified' },
								{ text: 'Post title', value: 'title' },
								{ text: 'Post URL slug', value: 'name' },
								{ text: 'Post ID', value: 'ID' },
								{ text: 'Random', value: 'rand' }
							],
							value: 'date'
						}/*, {
							type: 'textbox',
							name: 'cat',
							label: 'category ID (for example: 7, 15)',
							value: '' // by default
						}*/],
						onsubmit: function(e) {
							var shortcode = '';
							
							shortcode += '[sitekit_posts';
							shortcode += ' posts_per_page="' + e.data.posts_per_page + '"';
							shortcode += ' order="' + e.data.order + '"';
							shortcode += ' orderby="' + e.data.orderby + '"';
							//shortcode += ' cat="' + e.data.cat + '"';
							shortcode += ']';
							
							editor.insertContent(shortcode);
						}
					});
				}
			}, {
				text: 'Iframe',
				onclick: function() {
					editor.windowManager.open({
						title: 'Sitekit Iframe shortcode params',
						body: [{
							type: 'textbox',
							name: 'src',
							label: 'URL (source)'
						}, {
							type: 'textbox',
							name: 'width',
							label: 'Width',
							value: '100%'
						}, {
							type: 'textbox',
							name: 'height',
							label: 'Height',
							value: '500'
						}, {
							type: 'textbox',
							name: 'style',
							label: 'Style (CSS styles, for example: margin: 20px;)'
						}],
						onsubmit: function(e) {
							editor.insertContent('[sitekit_iframe src="' + e.data.src + '" width="' + e.data.width + '" height="' + e.data.height + '" style="' + e.data.style + '"]');
						}
					});
				}
			}/*, {
				text: 'Embed',
				onclick: function() {
					editor.windowManager.open({
						title: 'Embed shortcode params',
						body: [{
							type: 'textbox',
							name: 'url',
							label: 'URL More about Embeds https://codex.wordpress.org/Embeds'
						}, {
							type: 'textbox',
							name: 'width',
							label: 'width',
							value: '600'
						}, {
							type: 'textbox',
							name: 'height',
							label: 'height',
							value: '400'
						}],
						onsubmit: function(e) {
							editor.insertContent('[embed width="' + e.data.width + '" height="' + e.data.height + '"]' + e.data.url + '[/embed]');
						}
					});
				}
			}*/]
        });
    });
})();