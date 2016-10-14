(function() {
    tinymce.PluginManager.add('sitekit_tinymce_button', function(editor, url) {
        editor.addButton('sitekit_tinymce_button', {
            text: 'Sitekit',
            type: 'menubutton',
            menu: [{
				text: 'Iframe',
				onclick: function() {
					editor.windowManager.open({
						title: 'Iframe shortcode params',
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
			}, {
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
			}]
        });
    });
})();