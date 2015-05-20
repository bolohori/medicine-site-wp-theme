( function( e ) {
	e( function( ) {
	tinymce.create( 'tinymce.plugins.medicinebutton', {
		init : function( editor, url ) {
			if( editor.buttons.wusmbutton ) {
				editor.buttons.wusmbutton.menu.push({
					text: 'Button',
                    icon: false,
                    onclick: function( ) {
                        var text_selection = tinymce.activeEditor.selection.getContent( {format: 'text'} );
                        editor.windowManager.open( {
                        title: 'Insert Button',
                        body: [{
                            type: 'textbox',
                            name: 'text',
                            label: 'Text',
                            size: 30,
                            value: text_selection
                        }, {
                            type: 'textbox',
                            name: 'link',
                            label: 'URL',
                            value: ''
                        }, {
                            type: 'checkbox',
                            name: 'newwindow',
                            label: 'Open in a new window?'
                        }, ],
                        onsubmit: function( e ) {
                            if( e.data.newwindow == true ) {
                                var openin = 'target="_blank"';
                            }
                            editor.insertContent( 
                                '<a class="wusm-button"' + openin + '" href="' + e.data.link + '">' + e.data.text + '</a>'
                             );
                        }
                        } );
                    }
				});
			} else {
				url = url.substring(0, url.length - 2);
				editor.addButton( 'medicinebutton', {
					title: 'Insert',
                    image: url + 'img/add.svg',
                    type: 'menubutton',
                    menu: [ {
                            text: 'Button',
                            icon: false,
                            onclick: function( ) {
                                var text_selection = tinymce.activeEditor.selection.getContent( {format: 'text'} );
                                editor.windowManager.open( {
                                title: 'Insert Button',
                                body: [{
                                    type: 'textbox',
                                    name: 'text',
                                    label: 'Text',
                                    size: 30,
                                    value: text_selection
                                }, {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'URL',
                                    value: ''
                                }, {
                                    type: 'checkbox',
                                    name: 'newwindow',
                                    label: 'Open in a new window?'
                                }, ],
                                onsubmit: function( e ) {
                                    if( e.data.newwindow == true ) {
                                        var openin = 'target="_blank"';
                                    }
                                    editor.insertContent( 
                                        '<a class="wusm-button"' + openin + '" href="' + e.data.link + '">' + e.data.text + '</a>'
                                     );
                                }
                                } );
                            }
                        } ]
				});
			}
            editor.on('click',function(e) {
                if (jQuery(e.target).hasClass('wusm-button')) {
                    var link = jQuery(e.target).attr('href');
                    var text = e.target.text;
                    var newwindow = e.target.target;
                    if(newwindow == '_blank') {
                        var target = true;
                    }
                    editor.selection.select(e.toElement);
                    editor.windowManager.open({
                        title: 'Edit Button',
                        body: [{
                            type: 'textbox',
                            name: 'text',
                            label: 'Text',
                            size: 30,
                            value: text
                        }, {
                            type: 'textbox',
                            name: 'link',
                            label: 'URL',
                            value: link
                        }, {
                            type: 'checkbox',
                            name: 'newwindow',
                            label: 'Open in a new window?',
                            checked: target
                        }],
                        onsubmit: function(e) {
                            if(e.data.newwindow == true) {
                                var openin = 'target="_blank"';
                            }
                            editor.insertContent(
                                '<a class="wusm-button"' + openin + '" href="' + e.data.link + '">' + e.data.text + '</a>'
                            );
                        }
                    })
                }
            });
		},

		createControl : function( n, cm ) {
			return null;
		},
 
		getInfo : function( ) {
			return {
				longname  : 'Medicine Button',
				author    : 'Medical Public Affairs',
				authorurl : 'http://medicine.wustl.edu',
				version   : "1.0"
			};
		}
	} );

	tinymce.PluginManager.add( 'medicinebutton', tinymce.plugins.medicinebutton );
	} )
} )( jQuery );