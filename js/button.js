( function() {
    tinymce.PluginManager.add( 'sociallockplugin', function( editor, url ) {

	var cont_sel = false;
	var format_to_apply ='';
        // Add a button that opens a window
        editor.addButton( 'sociallockplugin', {

            text: 'Social Lock',
            icon: 'sl-dashicons-lock',
			
			
			
            onclick: function() {
            
				  selected = tinyMCE.activeEditor.selection.getContent();
					if(selected)
                        editor.selection.setContent( '[social_lock]' +selected+' [/social_lock]' );
					else
					    editor.insertContent( '[social_lock] your content [/social_lock]' );
               
            }

        } );

    } );

} )();