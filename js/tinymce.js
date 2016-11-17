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
							label: 'posts per page',
							value: '10' // by default
						}, {
							type: 'listbox', // listbox | combobox
							name: 'order',
							label: 'order',
							values : [
								{ text: 'DESC', value: 'DESC' },
								{ text: 'ASC', value: 'ASC' }
							],
							value: 'DESC' // by default
						}, {
							type: 'listbox', // listbox | combobox
							name: 'orderby',
							label: 'order by',
							values : [
								{ text: 'created date', value: 'date' },
								{ text: 'modified date', value: 'modified' },
								{ text: 'post title', value: 'title' },
								{ text: 'post slug', value: 'name' },
								{ text: 'post ID', value: 'ID' },
								{ text: 'random', value: 'rand' }
							],
							value: 'date'
						}],
						onsubmit: function(e) {
							editor.insertContent('[sitekit_posts posts_per_page="' + e.data.posts_per_page + '" order="' + e.data.order + '" orderby="' + e.data.orderby + '"]');
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
							label: 'src (source)'
						}, {
							type: 'textbox',
							name: 'width',
							label: 'width',
							value: '100%'
						}, {
							type: 'textbox',
							name: 'height',
							label: 'height',
							value: '500'
						}, {
							type: 'textbox',
							name: 'style',
							label: 'style (CSS styles, for example: margin: 20px;)'
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