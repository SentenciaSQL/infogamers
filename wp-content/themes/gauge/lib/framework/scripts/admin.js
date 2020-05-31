jQuery( document ).ready( function( $ ) {

	'use strict';
	
	/**
	 * Show page template/post format dependant metaboxes
	 *
	 */
	if ( $( 'body' ).hasClass( 'block-editor-page' ) ) { // Is Gutenberg active?

		wp.data.subscribe( () => {

			var newPageTemplate = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'template' );
		
			$( 'body:not(.post-type-post) .redux-metabox' ).each( function() {
		
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );

				if ( metaboxID !== 'redux-gp-metabox-page-options' ) {

					metaboxID = metaboxID.replace( 'redux-gp-metabox-', '' );
					metaboxID = metaboxID.replace( 'template-options', '' );
					metaboxID = metaboxID + 'template.php';
			
					if ( metaboxID === newPageTemplate ) {
						metabox.removeClass( 'hide-if-js closed' );
					} else if ( 'page' !== newPageTemplate ) {
						metabox.addClass( 'hide-if-js' );
					}
					
				}	
		
			});

		});

		wp.data.subscribe( () => {

			var newPostFormat = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' );

			$( '.post-type-post .redux-metabox' ).each( function() {
	
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );
					
				if ( metaboxID !== 'redux-gp-metabox-post-options' ) {
		
					metaboxID = metaboxID.replace( 'redux-gp-metabox-', '' );
					metaboxID = metaboxID.replace( '-format-options', '' );
			
					if ( metaboxID === newPostFormat ) {
						metabox.removeClass( 'hide-if-js closed' );
					} else {
						metabox.addClass( 'hide-if-js' );
					}
				
				}	
	
			});

		});

	}

	
	/*--------------------------------------------------------------
	Convert parent dropdown menu to select2 menu
	--------------------------------------------------------------*/

	if ( $( 'select#parent_id' ).length > 0 ) {	
		var parent_id = $( 'select#parent_id' );
		if ( !$.isEmptyObject( parent_id ) ) {
			parent_id.select2({
				width: '100%'
			});  
		}
	}
	
	
	/*--------------------------------------------------------------
	Show/hide meta boxes depending on page template
	--------------------------------------------------------------*/

	if ( document.getElementById( 'page_template' ) != null ) {
	
		// Settings upon page load
		var value = document.getElementById( 'page_template' ).value;
		
		if ( value.indexOf( 'hub-template.php' ) >= 0 || value.indexOf( 'hub-review-template.php' ) >= 0 ) {
			$( 'div[id*="tagsdiv-"]' ).show();
			$( '#tagsdiv-post_tag' ).show();
		} else if ( value.indexOf( 'review-template.php' ) >= 0 ) {
			$( 'div[id*="tagsdiv-"]' ).hide();
			$( '#tagsdiv-post_tag' ).show();		
		} else {
			$( 'div[id*="tagsdiv-"]' ).hide();
			$( '#tagsdiv-post_tag' ).show();
		}
			
		// Settings when changing menu
		document.getElementById( 'page_template' ).onchange = function ( value ) {
			var value = document.getElementById( 'page_template' ).value;	
			if ( value.indexOf( 'hub-template.php' ) >= 0 || value.indexOf( 'hub-review-template.php' ) >= 0 ) {
				$( 'div[id*="tagsdiv-"]' ).show();	
			} else if ( value.indexOf( 'review-template.php' ) >= 0 ) {
				$( 'div[id*="tagsdiv-"]' ).hide();
				$( '#tagsdiv-post_tag' ).show();				
			} else {	
				$( 'div[id*="tagsdiv-"]' ).hide();
				$( '#tagsdiv-post_tag' ).show();
			}				
		};
		
	}
				
				
	/*--------------------------------------------------------------
	Setup homepage
	--------------------------------------------------------------*/
	
	$( '.gp_vc_homepage_1_template, .gp_vc_homepage_3_template' ).click( function() {
    	$( '#page_template' ).val( 'flexslider-template.php' );
		$( '.postbox.redux-metabox' ).hide();	
		$( '#redux-gp-metabox-flexslider-template-options' ).show();			
	});

	$( '.gp_vc_homepage_2_template, .gp_vc_homepage_4_template' ).click( function() {
    	$( '#page_template' ).val( 'default' );
		$( '.postbox.redux-metabox' ).hide();	
		$( '#redux-gp-metabox-page-options' ).show();			
	});
		
	$( '.gp_vc_homepage_5_template' ).click( function() {
    	$( '#page_template' ).val( 'featured-template.php' );	
		$( '.postbox.redux-metabox' ).hide();
		$( '#redux-gp-metabox-featured-template-options' ).show();			
	});


	/*--------------------------------------------------------------
	Setup hub page
	--------------------------------------------------------------*/
	
	$( '.gp_vc_hub_page_template' ).click( function() {
    	$( '#page_template' ).val( 'hub-template.php' );
		$( '.postbox.redux-metabox' ).hide();	
		$( '#redux-gp-metabox-hub-template-options' ).show();	
	});
		
});