jQuery( function( $ ) {
	
	/*--------------------------------------------------------------
	Default values
	--------------------------------------------------------------*/

	var cats_new = 0;
	var menu_cats_new = 0;
	var orderby_new = 0;
	var date_posted_new = 0;
	var date_modified_new = 0;
	var pagenumber = 1;

	
	/*--------------------------------------------------------------
	Get current filter values
	--------------------------------------------------------------*/

	function gpCurrentFilterValues( parent ) {
		if ( cats_new != '' ) {
			cats_new = parent.find( 'select[name="gp-filter-cats"]' ).attr( 'value' );
		}
		menu_cats_new = parent.find( '.gp-menu-tabs li.gp-selected' ).attr( 'id' );
		orderby_new = parent.find( 'select[name="gp-filter-orderby"]' ).attr( 'value' );
		date_posted_new = parent.find( 'select[name="gp-filter-date-posted"]' ).attr( 'value' );
		date_modified_new = parent.find( 'select[name="gp-filter-date-modified"]' ).attr( 'value' );		
		pagenumber = 1;
	}
		
		
	/*--------------------------------------------------------------
	Load posts
	--------------------------------------------------------------*/
	
	function gpLoadPosts( element ) { 	

		var ajaxLoop = element.find( '.ajax-loop' );	
		var filterWrapper = element.find( '.gp-filter-wrapper' );

		// Parse data from blog wrapper to ajax loop
		var type = element.data('type');
		var postid = element.data('postid');
		var hubid = element.data('hubid');
		var cats = element.data('cats');
		var hubfieldslugs = element.data('hubfieldslugs');
		var postassociation = element.data('postassociation');
		var posttypes = element.data('posttypes');
		var format = element.data('format');
		var size = element.data('size');
		var orderby = element.data('orderby');
		var dateposted = element.data('dateposted');
		var datemodified = element.data('datemodified');
		var perpage = element.data('perpage');
		var menuperpage = element.data('menuperpage');
		var offset = element.data('offset');
		var featuredimage = element.data('featuredimage');
		var imagewidth = element.data('imagewidth');
		var imageheight = element.data('imageheight');
		var hardcrop = element.data('hardcrop');
		var imagealignment = element.data('imagealignment');
		var titleposition = element.data('titleposition');
		var contentdisplay = element.data('contentdisplay');
		var excerptlength = element.data('excerptlength');
		var metaauthor = element.data('metaauthor');
		var metadate = element.data('metadate');
		var metacommentcount = element.data('metacommentcount');
		var metaviews = element.data('metaviews');
		var metafollowers = element.data('metafollowers');
		var metacats = element.data('metacats');
		var metatags = element.data('metatags');
		var metahubcats = element.data('metahubcats');
		var metahubfields = element.data('metahubfields');
		var metahubaward = element.data('metahubaward');
		var hubcatsselected = element.data('hubcatsselected');
		var displaysiterating = element.data('displaysiterating');
		var displayuserrating = element.data('displayuserrating');
		var readmorelink = element.data('readmorelink');
		var pagenumbers = element.data('pagenumbers');
		var authorid = element.data('authorid');
				
		// Ajax query
		$.ajax({
			type: 'GET',
			data: {
				action: 'ghostpool_ajax',
				ajaxnonce: ghostpoolAjax.ajaxnonce,
				querystring: ghostpoolAjax.querystring,
				cats_new: cats_new,
				menu_cats_new: menu_cats_new,
				orderby_new: orderby_new,
				date_posted_new: date_posted_new,
				date_modified_new: date_modified_new,
				pagenumber: pagenumber,
				type: type,
				hubid: hubid,
				postid: postid,
				cats: cats,
				hubfieldslugs: hubfieldslugs,
				postassociation: postassociation,
				posttypes: posttypes,
				format: format,
				size: size,
				orderby: orderby,
				dateposted: dateposted,
				datemodified: datemodified,
				perpage: perpage,
				menuperpage: menuperpage,
				offset: offset,
				featuredimage: featuredimage,
				imagewidth: imagewidth,
				imageheight: imageheight,
				hardcrop: hardcrop,
				imagealignment: imagealignment,
				titleposition: titleposition,
				contentdisplay: contentdisplay,
				excerptlength: excerptlength,
				metaauthor: metaauthor,
				metadate: metadate,
				metacommentcount: metacommentcount,
				metaviews: metaviews,
				metafollowers: metafollowers,
				metacats: metacats,
				metatags: metatags,
				metahubcats: metahubcats,
				metahubfields: metahubfields,
				metahubaward: metahubaward,
				hubcatsselected: hubcatsselected,
				displaysiterating: displaysiterating,
				displayuserrating: displayuserrating,
				readmorelink: readmorelink,
				pagenumbers: pagenumbers,
				authorid: authorid
			},
			dataType: 'html',
			url: ghostpoolAjax.ajaxurl,
			success: function(data) {

				$( 'section:last-child .gp-post-image' ).promise().done( function() {
				   ajaxLoop.html(data).removeClass( 'gp-filter-loading' ).find( 'section' ).fadeIn();
					element.find( '.gp-standard-pagination' ).hide();	
				});
    
				// Needed for blog masonry positioning of page numbers
				ajaxLoop.after( $( '.gp-blog-masonry .gp-ajax-pagination.gp-pagination-numbers' ) );
				$( '.gp-blog-masonry .gp-ajax-pagination.gp-pagination-numbers:not(:first)' ).remove();

				// If clicking ajax pagination numbers
				element.find( '.gp-ajax-pagination.gp-pagination-numbers a' ).click( function() {
					
					if ( $( this ).hasClass( 'page-numbers' ) ) {
						var parentElement = $( this ).parent().parent().parent().parent().parent();
					} else {
						var parentElement = $( this ).parent().parent().parent();	
					}		
					gpCurrentFilterValues( parentElement );
					
					// Get page numbers from page links
					var ajaxPagination = $( this );	
						
					if ( ajaxPagination.hasClass( 'prev' ) ) {
						var pagelink = ajaxPagination.attr( 'href' );
						if ( pagelink.match( 'pagenumber=2' ) ) {
							pagenumber = 1;
						} else {
							var prev = pagelink.match(/\d+/);
							pagenumber = prev[0];
						}	
					} else if ( ajaxPagination.hasClass( 'next' ) ) {
						var next = ajaxPagination.attr( 'href' ).match(/\d+/);
						pagenumber = next[0];
					} else {
						pagenumber = ajaxPagination.text();
					}
					
					gpLoadPosts( element );

					if ( ! element.is( '.gp-vc-element' ) ) {
						$( 'html, body' ).animate({ scrollTop : 0 }, 0);
					} else {
						$( 'html, body' ).animate({ scrollTop: ( parentElement.offset().top - 200 ) }, 0);
					}
					
					return false;
				});
				
				// If clicking ajax pagination arrows
				element.find( '.gp-ajax-pagination.gp-pagination-arrows a' ).click( function() {
					
					if ( $( this ).hasClass( 'page-numbers' ) ) {
						var parentElement = $( this ).parent().parent().parent().parent().parent();
					} else {
						var parentElement = $( this ).parent().parent().parent();	
					}		
					gpCurrentFilterValues( parentElement );
					
					// Get page numbers from page links
					var ajaxPagination = $( this );	
					
					pagenumber = ajaxPagination.data( 'pagelink' );	
					
					gpLoadPosts( element );

					if ( ! element.is( '.gp-vc-element' ) ) {
						$( 'html, body' ).animate({ scrollTop : 0 }, 0);
					} else {
						$( 'html, body' ).animate({ scrollTop: ( parentElement.offset().top - 200 ) }, 0);
					}
					
					return false;
				});
				
				// Load WordPress media players	
				/*if ( element.find( '.wp-audio-shortcode' ).length > 0 ) {
					element.find( '.wp-audio-shortcode' ).mediaelementplayer({
						alwaysShowControls: true
					});
				}
				if ( element.find( '.wp-video-shortcode' ).length > 0 ) {		
					element.find( '.wp-video-shortcode' ).mediaelementplayer({
						alwaysShowControls: true
					});
				}*/
						
			},
			error: function(jqXHR, textStatus, errorThrown) {
				//alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
		
		// Add loading class
		ajaxLoop.addClass( 'gp-filter-loading' );
					
		return false;	

	}
	
	
	/*--------------------------------------------------------------
	Filter options
	--------------------------------------------------------------*/
				
	// If selecting category filter	
	$( 'select[name="gp-filter-cats"]' ).change( function() {
		var filterCats = $( this );
		var parentElement = filterCats.parent().parent().parent();
		gpCurrentFilterValues( parentElement );
		cats_new = filterCats.attr( 'value' );	
		gpLoadPosts( parentElement );		
	});

	// If clicking menu categories
	$( '.gp-menu-tabs li' ).click( function() {
		var filterMenuCats = $( this );
		var parentElement = filterMenuCats.parent().parent();
		gpCurrentFilterValues( parentElement );
		menu_cats_new = filterMenuCats.attr( 'id' );
		$( 'li.gp-selected' ).removeClass( 'gp-selected' );
		filterMenuCats.addClass( 'gp-selected' );	
		gpLoadPosts( parentElement );		
	});	
					
	// If selecting orderby filter		
	$( 'select[name="gp-filter-orderby"]' ).change( function() {
		var filterOrderby = $( this );
		var parentElement = filterOrderby.parent().parent().parent();
		gpCurrentFilterValues( parentElement );
		orderby_new = filterOrderby.attr( 'value' );
		gpLoadPosts( parentElement );
	});

	// If selecting date posted filter		
	$( 'select[name="gp-filter-date-posted"]' ).change( function() {
		var filterDatePosted = $( this );
		var parentElement = filterDatePosted.parent().parent().parent();
		gpCurrentFilterValues( parentElement );
		date_posted_new = filterDatePosted.attr( 'value' );
		gpLoadPosts( parentElement );
	});		
		
	// If selecting date modified filter	
	$( 'select[name="gp-filter-date-modified"]' ).change( function() {
		var filterDateModified = $( this );
		var parentElement = filterDateModified.parent().parent().parent();
		gpCurrentFilterValues( parentElement );
		date_modified_new = filterDateModified.attr( 'value' );
		gpLoadPosts( parentElement );		
	});
	
	// If clicking original pagination (numbers)
	$( '#gp-content-wrapper .ajax-loop + .gp-pagination ul.page-numbers a' ).click( function() {
		// Get page numbers from page links
		var filterPagination = $( this );
		var parentElement = filterPagination.parent().parent().parent().parent();
		gpCurrentFilterValues( parentElement );
		if ( filterPagination.hasClass( 'prev' ) ) {
			var prev = filterPagination.attr('href').match(/(\d+)\D*$/);
			pagenumber = prev[0];
		} else if ( filterPagination.hasClass( 'next' ) ) {
			var next = filterPagination.attr( 'href' ).match(/(\d+)\D*$/);
			pagenumber = next[0];
		} else {
			pagenumber = filterPagination.text();
		}
		gpLoadPosts( parentElement );
		if ( ! parentElement.is( '.gp-vc-element' ) ) {
			$( 'html, body' ).animate({ scrollTop : 0 }, 0);
		} else {
			$( 'html, body' ).animate({ scrollTop: ( parentElement.offset().top - 200 ) }, 0);
		}
		return false;
	});	

	// If clicking original pagination (arrows)
	$( '#gp-content-wrapper .gp-pagination-arrows a' ).click( function() {	
		var filterPagination = $( this );
		var parentElement = filterPagination.parent().parent();
		gpCurrentFilterValues( parentElement );
		pagenumber = filterPagination.data( 'pagelink' );
		gpLoadPosts( parentElement );
		return false;
	});	
		
	// If clicking original menu pagination
	$( '.gp-nav .ajax-loop + .gp-pagination-arrows a' ).click( function() {
		var filterPagination = $( this );
		var parentElement = filterPagination.parent().parent();	
		pagenumber = filterPagination.data( 'pagelink' );
		gpLoadPosts( parentElement );
		return false;
	});
	
	
	/*--------------------------------------------------------------
	Load scripts within ajax
	--------------------------------------------------------------*/
	
	$( document ).ajaxComplete( function( e, xhr, settings ) {
			
		// Load Isotope
		if ( $( '.gp-blog-wrapper' ).hasClass( 'gp-blog-masonry' ) ) {
		
			var container = $( '.gp-blog-masonry .gp-inner-loop' ),
				element = container;

			// Destroy previous isotope
			container.isotope( 'destroy' );
			container.css( 'opacity', 0 );

			if ( container.find( 'img' ).length == 0 ) {
				element = $( '<img />' );
			}	

			imagesLoaded( element, function( instance ) {

				container.isotope({
					itemSelector: 'section',
					percentPosition: true,
					masonry: {
						columnWidth: container.find( 'section' )[0],
						gutter: '.gp-gutter-size'
					}
				});

				container.animate( { 'opacity': 1 }, 1300 );
				$( '.gp-pagination' ).animate( { 'opacity': 1 }, 1300 );
				
			});
			
		}	
			
		// Load Advanced Responsive Video Embedder
		var arve_iframe_btns = document.getElementsByClassName( 'arve-iframe-btn' );

		for ( var i=0; i < arve_iframe_btns.length; i++ ) {

			arve_iframe_btns[i].onclick = function() {

				var target = document.getElementById( this.getAttribute( 'data-target' ) );
				target.setAttribute( 'src', target.getAttribute( 'data-src' ) );
				target.className = 'arve-inner';
				this.parentNode.removeChild( this );
			};
		};
			
		// Get height of first image
		$( '.gp-ajax-loop .flex-viewport' ).each( function() {
			var firstImageHeight = $( this ).find( 'ul.slides li:first-child img' ).css( 'height' );
			$( this ).css( 'height', firstImageHeight );
		});
  		
  		// Gallery category post slider
		$( '.gp-blog-wrapper:not(.gp-blog-masonry) .gp-post-format-gallery-slider' ).flexslider( { 
			animation: 'fade',
			slideshowSpeed: 9999999,
			animationSpeed: 600,
			directionNav: true,			
			controlNav: false,			
			pauseOnAction: true, 
			pauseOnHover: false,
			prevText: '',
			nextText: '',
			smoothHeight: true
		});

		$( '.gp-blog-masonry .gp-post-format-gallery-slider' ).flexslider( { 
			animation: 'fade',
			slideshowSpeed: 9999999,
			animationSpeed: 600,
			directionNav: true,			
			controlNav: false,			
			pauseOnAction: true, 
			pauseOnHover: false,
			prevText: '',
			nextText: ''
		});
								
	}); 

});