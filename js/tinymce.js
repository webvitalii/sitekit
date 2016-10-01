(function() {
    tinymce.PluginManager.add('sitekit_tinymce_button', function( editor, url ) {
        editor.addButton( 'sitekit_tinymce_button', {
            text: 'Sitekit',
            type: 'menubutton',
            menu: [{
				text: 'Iframe',
				onclick: function() {
					editor.windowManager.open( {
						title: 'Insert iframe shortcode params',
						body: [{
							type: 'textbox',
							name: 'src',
							label: 'Source'
						}],
						onsubmit: function( e ) {
							editor.insertContent( '[sitekit_iframe src="' + e.data.src + '"]');
						}
					});
				}
			}]
        });
    });
})();