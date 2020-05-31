//function vc_prettyPhoto() { }  // Disable Visual Composer prettyPhoto override

jQuery( document ).ready( function( $ ) {

	'use strict';

	/*--------------------------------------------------------------
	Screen size class
	--------------------------------------------------------------*/

	function gpScreenSizeClass() {
	
		if ( $( window ).width() <= 767 && $( 'body' ).hasClass( 'gp-responsive' ) ) {
		
			$( 'body' ).addClass( 'gp-mobile' ).removeClass( 'gp-desktop' ).removeClass( 'gp-tablet-portrait' ).removeClass( 'gp-tablet-landscape' );
			
		} else if ( $( window ).width() <= 1023 && $( 'body' ).hasClass( 'gp-responsive' ) ) {
			
			$( 'body' ).addClass( 'gp-tablet-portrait' ).removeClass( 'gp-desktop' ).removeClass( 'gp-tablet-landscape' ).removeClass( 'gp-mobile' );
			
		} else if ( $( window ).width() <= 1082 && $( 'body' ).hasClass( 'gp-responsive' ) ) {
			
			$( 'body' ).addClass( 'gp-tablet-landscape' ).removeClass( 'gp-desktop' ).removeClass( 'gp-tablet-portrait' ).removeClass( 'gp-mobile' );	
		
		} else {
			
			$( 'body' ).addClass( 'gp-desktop' ).removeClass( 'gp-tablet-landscape' ).removeClass( 'gp-tablet-portrait' ).removeClass( 'gp-mobile' );
		
		}
		
	}
	
	gpScreenSizeClass();
	$( window ).resize( gpScreenSizeClass );
	

	/*--------------------------------------------------------------
	Retina images
	--------------------------------------------------------------*/

	if ( $( 'body' ).hasClass( 'gp-retina' ) ) {
	
		window.devicePixelRatio >= 2 && $( '.gp-post-thumbnail img' ).each( function() {
			$( this ).attr( { src: $( this ).attr( 'data-rel' ) } );
		});
	
		window.devicePixelRatio >= 2 && $( '.image-loop img' ).each(function() {
			$( this ).attr( { 'data-original': $( this ).attr( 'data-rel' ) } );
		});

		window.devicePixelRatio >= 2 && $( '.gp-slider .slide-image' ).each(function(){
			var bgImage = $(this).attr( 'data-rel' );
			$( this ).css( 'background-image', 'url(' + bgImage + ')' );
		});
	
	}
	

	/*--------------------------------------------------------------
	Parallax Effect
	--------------------------------------------------------------*/

	if( $( 'div' ).hasClass( 'gp-parallax' ) || $( 'header' ).hasClass( 'gp-parallax' ) ) {
		$( '.gp-parallax' ).css( 'opacity', 0 );		
		$( window ).load( function() {
			$.stellar({
				responsive: true,
				horizontalScrolling: false
			});
			$( '.gp-parallax' ).css( 'opacity', 1 );
		});
	}
			
			
	/*--------------------------------------------------------------
	Blog masonry
	--------------------------------------------------------------*/

	if ( $( '.gp-blog-wrapper' ).hasClass( 'gp-blog-masonry' ) ) {
	
		var container = $( '.gp-blog-masonry .gp-inner-loop' ),
			element = container;

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

	
	/*--------------------------------------------------------------
	Portfolio masonry
	--------------------------------------------------------------*/
		
	if ( $( '#gp-portfolio' ).hasClass( 'gp-portfolio-wrapper' ) ) {
	
		var container = $( '#gp-portfolio .gp-inner-loop' ),
			element = container;

		if ( container.find( 'img' ).length == 0 ) {
			element = $( '<img />' );
		}

		if ( container.find( '.gp-portfolio-item' ).length == 1 ) {
			var columnwidth = '.gp-portfolio-item';
		} else {
			var columnwidth = '.gp-portfolio-item:nth-child(3n)';
		}	

		imagesLoaded( element, function( instance ) {

			container.isotope({
				itemSelector: '.gp-portfolio-item',
				percentPosition: true,
				filter: '*',
				masonry: {
					columnWidth: columnwidth,
					gutter: '.gp-gutter-size'
				}
			});

			container.animate( { 'opacity': 1 }, 1300 );
			$( '.gp-pagination' ).animate( { 'opacity': 1 }, 1300 );

		});

		// Add portfolio filters
		$( '#gp-portfolio-filters ul li a' ).click( function() {

			var selector = $( this ).attr( 'data-filter' );
			container.isotope( { filter: selector } );

			$( '#gp-portfolio-filters ul li a' ).removeClass( 'gp-active' );
			$( this ).addClass( 'gp-active' );

			return false;

		});
		
		// Remove portfolio filters not found on current page
		if ( $( 'div' ).hasClass( 'gp-portfolio-filters' ) ) {

			var isotopeCatArr = [];
			var $portfolioCatCount = 0;
			$( '#gp-portfolio-filters ul li' ).each( function( i ) {
				if ( $( this ).find( 'a' ).length > 0 ) {
					isotopeCatArr[$portfolioCatCount] = $( this ).find( 'a' ).attr( 'data-filter' ).substring( 1 );	
					$portfolioCatCount++;
				}
			});

			isotopeCatArr.shift();

			var itemCats = '';

			$( '#gp-portfolio .gp-inner-loop > .gp-portfolio-item' ).each( function( i ) {
				itemCats += $( this ).attr( 'data-portfolio-cat' );
			});
			itemCats = itemCats.split( ' ' );

			itemCats.pop();

			itemCats = $.unique( itemCats );

			var notFoundCats = [];
			$.grep( isotopeCatArr, function( el ) {
				if ( $.inArray(el, itemCats ) == -1 ) {
					notFoundCats.push( el  );
				}
			});

			if ( notFoundCats.length != 0 ) {
				$( '#gp-portfolio-filters ul li' ).each( function() {
					if ( $( this ).find( 'a' ).length > 0 ) {
						if( $.inArray( $( this ).find( 'a' ).attr( 'data-filter' ).substring( 1 ), notFoundCats ) != -1 ) {
							$( this ).hide();
						}
					}
				});
			}

		}

	}
	
	
	/*--------------------------------------------------------------
	Lazyload Images
	--------------------------------------------------------------*/

	if ( $( 'div' ).hasClass( 'gp-images-lazyload-wrapper' ) ) {

		$( this ).find( '.gp-image-loop img' ).lazyload({
			 effect: 'fadeIn'
		});
	
		$( '.gp-images-lazyload-wrapper').animate( { 'opacity': 1 }, 1300 );

	}
	
		
	/*--------------------------------------------------------------
	Switch navigation position if near edge
	--------------------------------------------------------------*/

	function gpSwitchNavPosition() {
		$( '#gp-main-nav .menu > li.standard-menu, #gp-right-top-nav .menu > li' ).each( function() {
			$( this ).on( 'mouseenter mouseleave', function(e) {
				if ( $( this ).find( 'ul' ).length > 0 ) {
					var menuElement = $( 'ul:first', this ),
						pageWrapper = $( '#gp-page-wrapper' ),
						pageWrapperOffset = pageWrapper.offset(),
						menuOffset = menuElement.offset(),
						menuLeftOffset = menuOffset.left - pageWrapperOffset.left,
						menuWidth = menuElement.width() + 260,	
						pageWrapperWidth = pageWrapper.width(),
						isEntirelyVisible = ( menuLeftOffset + menuWidth <= pageWrapperWidth );	
					if ( ! isEntirelyVisible ) {
						$( this ).addClass( 'gp-nav-edge' );
					} else {
						$( this ).removeClass( 'gp-nav-edge' );
					}
				}   
			});
		});	
	}

	gpSwitchNavPosition();
	$( window ).resize( gpSwitchNavPosition );

		
	/*--------------------------------------------------------------
	Mega menus text/image support
	--------------------------------------------------------------*/
		
	if ( $( '.megamenu' ).length > 0 ) {
		
		$( '.menu-text > a' ).contents().unwrap().wrap( '<span></span>' );
			
		$( '.gp-nav .megamenu .sub-menu .sub-menu li.menu-image' ).each( function() {
			if ( $( this ).find( 'a' ).length > 0 ) {	
				var src = $( this ).find( 'a' ).attr( 'href' );
				$( '<img class="gp-menu-image" alt="">' ).insertAfter( $( this ).children( ':first' ) );
				$( this ).find( '.gp-menu-image' ).attr( 'src', src );
				$( this ).find( 'a' ).remove();				
			}			
		});
	
		$( '#gp-mobile-nav .menu-image' ).hide();
	
	}

		
	/*--------------------------------------------------------------
	FontAwesome menu icons
	--------------------------------------------------------------*/
		
	$( '.menu li.fa' ).each( function() {	
		var all = $( this ).attr( 'class' ).split(' ');
		for ( var i = 0; i < all.length; ++i ) {
			var cls = all[i];
			if ( cls.indexOf( 'fa' ) == 0 ) {
				$( this ).find( '> a:first-child' ).addClass( cls );
				$( this ).removeClass( cls );
			}
		}
	});
		

	/*--------------------------------------------------------------
	Dropdown menu icons
	--------------------------------------------------------------*/
		
	$( '#gp-main-nav .menu > li' ).each( function() {
		if ( $( this ).find( 'ul' ).length > 0 ) {	
			$( '<i class="gp-dropdown-icon gp-primary-dropdown-icon fa fa-caret-down" />' ).appendTo( $( this ).children( ':first' ) );		
		}		
	});
	
	$( '#gp-main-nav .menu > li.standard-menu ul > li' ).each( function() {
		if ( $( this ).find( 'ul' ).length > 0 ) {	
			$( '<i class="gp-dropdown-icon gp-secondary-dropdown-icon fa" />' ).appendTo( $( this ).children( ':first' ) );
		}					
	});		
		
									
	/*--------------------------------------------------------------
	Slide up/down header mobile navigation
	--------------------------------------------------------------*/

	function gpHeaderMobileNav() {
		$( '#gp-mobile-nav-button' ).click( function() {
			$( 'body' ).addClass( 'gp-mobile-nav-active' );
		});
		
		$( '#gp-mobile-nav-close-button, #gp-mobile-nav-bg' ).click( function() {
			$( 'body' ).removeClass( 'gp-mobile-nav-active' );
		});		
	}
	
	gpHeaderMobileNav();


	/*--------------------------------------------------------------
	Slide up/down header mobile dropdown menus
	--------------------------------------------------------------*/

	$( '#gp-mobile-nav .menu li' ).each( function() {
		if ( $( this ).find( 'ul' ).length > 0 ) {
			$( '<i class="gp-mobile-dropdown-icon" />' ).insertAfter( $( this ).children( ':first' ) );		
		}		
	});
	
	function gpHeaderMobileTopNav() {

		$( '#gp-mobile-nav ul > li' ).each( function() {
			
			var navItem = $( this );
			
			if ( $( navItem ).find( 'ul' ).length > 0 ) {	
		
				$( navItem ).children( '.gp-mobile-dropdown-icon' ).toggle( function() {
					$( navItem ).addClass( 'gp-active' );
					$( navItem ).children( '.sub-menu' ).stop().slideDown()
					$( '#gp-mobile-nav' ).addClass( 'gp-auto-height' );
				}, function() {
					$( navItem ).removeClass( 'gp-active' );
					$( navItem ).children( '.sub-menu' ).stop().slideUp();
				});
		
			}
					
		});
	
	}
	
	gpHeaderMobileTopNav();

	
	/*--------------------------------------------------------------
	Slide up/down hub tabs mobile navigation
	--------------------------------------------------------------*/

	function gpTabsMobileNav() {
		$( '#gp-hub-tabs #gp-hub-tabs-mobile-nav-button' ).toggle( function() {
			$( '#gp-hub-tabs ul' ).stop().slideDown();
			$( '#gp-hub-tabs-mobile-nav-button' ).addClass( 'gp-active' );
		}, function() {
			$( '#gp-hub-tabs ul' ).stop().slideUp();
			$( '#gp-hub-tabs-mobile-nav-button' ).removeClass( 'gp-active' );
		});	
	}
	
	gpTabsMobileNav();
			
			
	/*--------------------------------------------------------------
	Smooth scroll
	--------------------------------------------------------------*/

	if ( $( 'body' ).hasClass( 'gp-smooth-scrolling' ) && $( window ).width() > 767 && $( 'body' ).outerHeight( true ) > $( window ).height() ) {
		$( 'html' ).niceScroll({
			cursorcolor: '#424242',
			scrollspeed: 100,
			mousescrollstep: 40,
			cursorwidth: 10,
			cursorborder: '0',
			zindex: 10000,
			cursoropacitymin: 0.3,
			cursoropacitymax: 0.6
		});
	}
	
	
	/*--------------------------------------------------------------
	Back to top button
	--------------------------------------------------------------*/

	if ( ! $( 'body' ).hasClass( 'gp-no-back-to-top' ) ) {	
		$().UItoTop({ 
			containerID: 'gp-to-top',
			text: '<i class="fa fa-chevron-up"></i>',
			scrollSpeed: 600
		});
	}
		

	/*--------------------------------------------------------------
	prettyPhoto lightbox
	--------------------------------------------------------------*/

	if ( ghostpool_script.lightbox != 'disabled' ) {
		$( 'a.prettyphoto, a[data-rel^="prettyPhoto"]' ).prettyPhoto({
			hook: 'data-rel',
			theme: 'pp_default',
			deeplinking: false,
			social_tools: '',
			default_width: '768'
		});
	}	


	/*--------------------------------------------------------------
	Gallery category post slider
	--------------------------------------------------------------*/

	$( window ).load( function() {
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
		

	/*--------------------------------------------------------------
	Gallery single post slider
	--------------------------------------------------------------*/

	$( window ).load( function() {
		$( '.gp-entry-featured .gp-post-format-gallery-slider' ).flexslider( { 
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
	});
	
	
	/*--------------------------------------------------------------
	Portfolio slider
	--------------------------------------------------------------*/

	$( window ).load( function() {
		$( '.gp-portfolio-slider' ).flexslider({ 
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
	});
	
		
	/*--------------------------------------------------------------
	Remove gallery shortcode when gallery slider active 
	--------------------------------------------------------------*/

	$( '.gallery-slider-active .gallery' ).remove();


	/*--------------------------------------------------------------
	Load scripts in WPB tabs
	--------------------------------------------------------------*/

	$( '.vc_tta-tab, .vc_tta-panel-title' ).click( function() {
						
		setTimeout( function() {
		   $( window ).trigger( 'resize' );
		}, 0 );
		setTimeout( function() {
		   $( window ).trigger( 'resize' );
		}, 2 );

	});

	
	/*--------------------------------------------------------------
	Follow Items
	--------------------------------------------------------------*/

	$( '.gp-follow-button .gp-unfollow-item' ).show();
	
	$( document ).on( 'click', '.gp-follow-link', function() {
		var dhis = $( this );
		wpfp_do_js( dhis, 1 );
		if ( dhis.hasClass( 'gp-unfollow-item' ) ) {
			dhis.parent( 'section' ).fadeOut();
		}
		return false;
	});

	function wpfp_do_js( dhis, doAjax ) {
		dhis.addClass( 'gp-follow-loading' );
		var url = document.location.href.split( '#' )[0];
		var params = dhis.attr( 'href' ).replace( '?', '' ) + '&ajax=1';
		if ( doAjax ) {
			jQuery.get( url, params, function( data ) {
					dhis.parent().html( data );
					if ( typeof wpfp_after_ajax == 'function' ) {
						wpfp_after_ajax( dhis );
					}
					dhis.removeClass( 'gp-follow-loading' );
				}
			);
		}
	}
	
	
	/*--------------------------------------------------------------
	Title header video
	--------------------------------------------------------------*/
	
	if ( $( '.gp-page-header' ).hasClass( 'gp-has-video' ) ) {
		headerVideo.init({
			mainContainer: $( '.gp-page-header' ),
			videoContainer: $( '.gp-video-header' ),
			header: $( '.gp-video-media' ),
			videoTrigger: $( '.gp-play-video-button' ),
			closeButton: $( '.gp-close-video-button' ),
			autoPlayVideo: false
		});
	}
		
		
	/*--------------------------------------------------------------
	Resize header
	--------------------------------------------------------------*/

	function gpResizeHeader() {

		// Before Scrolling
		
		if ( ( $( window ).width() <= 982 && $( 'body' ).hasClass( 'gp-responsive' ) ) || ( $( window ).scrollTop() > 0 && $( 'body' ).hasClass( 'gp-desktop' ) && $( 'body' ).hasClass( 'gp-fixed-header' ) && $( 'body' ).hasClass( 'gp-header-resize' ) ) ) {

			$( 'body' ).addClass( 'gp-scrolling' );

			$( '.gp-header-standard #gp-main-header' ).data( 'size', 'small' ).addClass( 'gp-header-small' ).removeClass( 'gp-header-large' ).stop().css({
				height: parseInt( ghostpool_script.smallHeaderHeight )
			});
					
			$( '.gp-header-centered #gp-main-header' ).data( 'size', 'small' ).addClass( 'gp-header-small' ).removeClass( 'gp-header-large' ).stop().css({
				height: parseInt( ghostpool_script.smallHeaderHeight ) + parseInt( ghostpool_script.logoMarginTop ) / ghostpool_script.headerSizeReduction + parseInt( ghostpool_script.logoMarginBottom ) / ghostpool_script.headerSizeReduction
			});
														
			$( '#gp-main-header #gp-logo' ).stop().css({
				marginTop: parseInt( ghostpool_script.logoMarginTop ) / ghostpool_script.headerSizeReduction,
				marginBottom: parseInt( ghostpool_script.logoMarginBottom ) / ghostpool_script.headerSizeReduction
			}); 
		
			$( '#gp-main-header #gp-logo img' ).stop().css({
				height: parseInt( ghostpool_script.logoHeight ) / ghostpool_script.headerSizeReduction
			}); 
			
					
			$( '#gp-fixed-header-padding' ).stop().css({
				paddingTop: parseInt( ghostpool_script.smallHeaderHeight )
			});
				
		} else {
		
			$( 'body' ).removeClass( 'gp-scrolling' );

			$( '.gp-header-standard #gp-main-header' ).data( 'size', 'large' ).addClass( 'header-large' ).removeClass( 'gp-header-small' ).stop().css({
				height: ghostpool_script.headerHeight
			});
					
			$( '.gp-header-centered #gp-main-header' ).data( 'size', 'large' ).addClass( 'header-large' ).removeClass( 'gp-header-small' ).stop().css({
				height: parseInt( ghostpool_script.headerHeight ) + parseInt( ghostpool_script.logoMarginTop ) + parseInt( ghostpool_script.logoMarginBottom )
			});
														 
			$( '#gp-main-header #gp-logo' ).stop().css({
				marginTop: parseInt( ghostpool_script.logoMarginTop ),
				marginBottom: parseInt( ghostpool_script.logoMarginBottom )
			}); 
		
			$( '#gp-main-header #gp-logo img' ).stop().css({
				height: parseInt( ghostpool_script.logoHeight )
			});
			
		
			$( '#gp-fixed-header-padding' ).stop().css({
				paddingTop: parseInt( ghostpool_script.headerHeight )
			});
									
		}
					
		// Upon Scrolling

		$( window ).scroll( function() {
		
			if ( $( 'body' ).hasClass( 'gp-desktop' ) && $( 'body' ).hasClass( 'gp-fixed-header' ) && $( 'body' ).hasClass( 'gp-header-resize' ) ) {

				if ( $( document ).scrollTop() > 50 ) {

					if ( $( '#gp-main-header' ).data( 'size' ) == 'large' )  {
					
						$( 'body' ).addClass( 'gp-scrolling' );
	
						$( '.gp-header-standard #gp-main-header' ).data( 'size', 'small' ).addClass( 'gp-header-small' ).removeClass( 'header-large' ).stop().animate({
							height: parseInt( ghostpool_script.smallHeaderHeight )
						}, 300 );
						
						$( '.gp-header-centered #gp-main-header' ).data( 'size', 'small' ).addClass( 'gp-header-small' ).removeClass( 'header-large' ).stop().animate({
							height: parseInt( ghostpool_script.smallHeaderHeight ) + ( parseInt( ghostpool_script.logoMarginTop ) / ghostpool_script.headerSizeReduction ) + ( parseInt( ghostpool_script.logoMarginBottom ) / ghostpool_script.headerSizeReduction )
						}, 300 );
															
						$( '#gp-main-header #gp-logo' ).stop().animate({
							marginTop: parseInt( ghostpool_script.logoMarginTop ) / ghostpool_script.headerSizeReduction,
							marginBottom: parseInt( ghostpool_script.logoMarginBottom ) / ghostpool_script.headerSizeReduction
						}, 300 ); 
			
						$( '#gp-main-header #gp-logo img' ).stop().animate({
							height: parseInt( ghostpool_script.logoHeight ) / ghostpool_script.headerSizeReduction
						}, 300 ); 
				
						
						$( '#gp-fixed-header-padding' ).stop().animate({
							paddingTop: parseInt( ghostpool_script.smallHeaderHeight )
						}, 400 );
						
					}

				} else {

					if ( $( '#gp-main-header' ).data( 'size' ) == 'small' ) {
					
						$( 'body' ).removeClass( 'gp-scrolling' );
	
						$( '.gp-header-standard #gp-main-header' ).data( 'size', 'large' ).addClass( 'gp-header-large' ).removeClass( 'gp-header-small' ).stop().animate({
							height: ghostpool_script.headerHeight
						}, 300 );
						
						$( '.gp-header-centered #gp-main-header' ).data( 'size', 'large' ).addClass( 'gp-header-large' ).removeClass( 'gp-header-small' ).stop().animate({
							height: parseInt( ghostpool_script.headerHeight ) + parseInt( ghostpool_script.logoMarginTop ) + parseInt( ghostpool_script.logoMarginBottom )
						}, 300 );
															 
						$( '#gp-main-header #gp-logo' ).stop().animate({
							marginTop: parseInt( ghostpool_script.logoMarginTop ),
							marginBottom: parseInt( ghostpool_script.logoMarginBottom )
						}, 300 ); 
			
						$( '#gp-main-header #gp-logo img' ).stop().animate({
							height: parseInt( ghostpool_script.logoHeight )
						}, 300 );
				
			
						$( '#gp-fixed-header-padding' ).stop().animate({
							paddingTop: parseInt( ghostpool_script.headerHeight )
						}, 400 );
							 
					}
				
				}
			
			}

		});				

	}

	gpResizeHeader();
	$( window ).resize( gpResizeHeader );


	/*--------------------------------------------------------------
	Set slider height to auto 
	--------------------------------------------------------------*/

	$( window ).load( function() {
		if ( $( window ).width() > 1082 ) {
			$( '#gp-homepage-slider' ).css( 'height', 'auto' );	
		}
	});


	/*--------------------------------------------------------------
	Featured wrapper caption
	--------------------------------------------------------------*/

	$( '.gp-featured-post' ).css( 'opacity', 1 );	
	
	function gpCaptionPadding() {
		var padding = ( $( '#gp-featured-wrapper .gp-container' ).width() - $( '#gp-main-header .gp-container' ).width() ) / 2;
		$( '.gp-large-post .gp-featured-caption' ).css( 'padding-left', padding );
		$( '.gp-small-posts .gp-featured-caption' ).css( 'padding-right', padding );	 	
	}

	gpCaptionPadding();
	$( window ).resize( gpCaptionPadding );


	/*--------------------------------------------------------------
	Close reset success message
	--------------------------------------------------------------*/

	$( '#gp-close-reset-message' ).click( function() {
		$( '#gp-reset-message' ).remove();
	});
	
	
	/*--------------------------------------------------------------
	Remove "|" from BuddyPress item options
	--------------------------------------------------------------*/

	$( '.item-options' ).contents().filter( function() {
		return this.nodeType == 3;
	}).remove();


	/*--------------------------------------------------------------
	Hide BuddyPress item options if width too small
	--------------------------------------------------------------*/

	function gpBPWidgetOptions() {
		
		$( '.widget.buddypress' ).each( function() {
			
			var widget = $( this ),
				optionsWidth = 230,
				widgettitle = widget.find( '.widgettitle' ).html(),
				textWidth = widget.find( '.gp-widget-title' ).width(),
				containerWidth = widget.find( '.widgettitle' ).width();

			if ( ( containerWidth - optionsWidth ) > textWidth ) {
				widget.find( '.item-options' ).removeClass( 'gp-small-item-options' );
				widget.find( '.gp-item-options-button' ).remove();
			} else {	
				widget.find( '.item-options' ).addClass( 'gp-small-item-options' );
				widget.find( '.item-options' ).append( '<div class="gp-item-options-button"></div>' );
			}
			
			widget.find( '.gp-item-options-button' ).toggle( function() {
				widget.find( '.gp-small-item-options' ).addClass( 'gp-active' );
			}, function() {
				widget.find( '.gp-small-item-options' ).removeClass( 'gp-active' );
			});		
						
		});
		
	}
	
	gpBPWidgetOptions();
	$( window ).resize( gpBPWidgetOptions );

	
	/*--------------------------------------------------------------
	BuddyPress tabs for mobile
	--------------------------------------------------------------*/			
						
	$( '.item-list-tabs:not(#subnav)' ).prepend( '<div id="gp-bp-tabs-button"></div>' );
	var bptabs = $( '.item-list-tabs:not(#subnav) > ul' );
	
	function gpBPTabs() {

		if ( $( '.item-list-tabs:not(#subnav)' ).find( 'ul' ).length > 0 ) {	

			if ( $( window ).width() <= 567 && $( 'body' ).hasClass( 'gp-responsive' ) ) {
	
				$( bptabs ).hide();

				$( '#gp-bp-tabs-button' ).toggle( function() {
					$( bptabs ).stop().slideDown();
					$( this ).addClass( 'gp-active' );
				}, function() {
					$( bptabs ).stop().slideUp();
					$( this ).removeClass( 'gp-active' );
				});
		
			} else {
		
				$( bptabs ).css( 'height', 'auto' ).show();
		
			}
		
		}
						
	}
	
	gpBPTabs();
	$( window ).resize( gpBPTabs );
	

	/*--------------------------------------------------------------
	WooCommerce image overlay 
	--------------------------------------------------------------*/

	$( '.gp-product-image-container .gp-image-overlay' ).css( 'opacity', 0 ).hover( function() {
		$( this ).fadeTo( 'fast', 1 );
	}, function() {
		$( this ).fadeTo( 'fast', 0 );
	});	


	/*--------------------------------------------------------------
	Login box
	--------------------------------------------------------------*/

	// Submit forms
	var formArray = ['.gp-login-form', '.gp-lost-password-form', '.gp-register-form'];
	
	$.each( formArray, function( index, value ) {
	
		$( value ).submit( function() {
			var form = $( this ); 
			form.find( '.gp-login-results' ).html( '<span class="gp-verify-form">' + $( '.gp-login-results' ).data( 'verify' ) + '</span>' ).fadeIn();
			var input_data = form.serialize();
			$.ajax({
				type: 'POST',
				url:  ghostpool_script.url,
				data: input_data,
				success: function( msg ) {
					
					form.find( '.gp-verify-form' ).remove();
					
					$( '<span>' ).html( msg ).appendTo( form.find( '.gp-login-results' ) ).fadeIn( 'slow' );
					
					if ( $( '.gp-register-form' ).find( '.gp-login-results .gp-success' ) ) {						
						$( '.gp-register-form' ).find( 'p, .gglcptch, .wp-submit' ).hide();
					}
					
				},
				error: function( xhr, status, error ) {
				
					// Reset captcha on error
					if ( $( '.gglcptch > div' ).length > 0 ) {
						grecaptcha.getResponse();
						grecaptcha.reset();
					}
											
					form.find( '.gp-verify-form' ).remove();
					$( '<span>' ).html( xhr.responseText ).appendTo( form.find( '.gp-login-results' ) ).fadeIn( 'slow' );
					
				}
			});
			return false;
		});
	
	});
			
	// Close modal window when clicking close button
	$( '#gp-login-close' ).click( function() {		
		$( '#login' ).hide();
		$( '.gp-login-results > span' ).remove();
	});	
	
	// Open login modal window when clicking links		
	$( '.gp-login-link, a[href="#login"]' ).click( function() {
		$( '#login' ).show();
		$( '.gp-login-form-wrapper' ).show();
		$( '.gp-register-form-wrapper, .gp-lost-password-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	});		

	// Open login modal window directly from URL
	if ( /#login/.test( window.location.href ) ) {
		$( '#login' ).show();
		$( '.gp-login-form-wrapper' ).show();
		$( '.gp-register-form-wrapper, .gp-lost-password-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	}	
								
	// Open lost password modal window when clicking link								
	$( '.gp-lost-password-link' ).click( function() {
		$( '.gp-lost-password-form-wrapper' ).show();
		$( '.gp-register-form-wrapper, .gp-login-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	});		

	// Open lost password modal window directly from URL
	if ( /#lost-password/.test( window.location.href ) ) {
		$( '#login' ).show();
		$( '.gp-lost-password-form-wrapper' ).show();
		$( '.gp-register-form-wrapper, .gp-login-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	}
	
	// Open registration modal window when clicking links		
	$( 'a[href="#register"]' ).click( function() {
		$( '#login' ).show();
		$( '.gp-register-form-wrapper, .gp-register-form .login-form > p, .gp-register-form .wp-submit' ).show();
		$( '.gp-register-form .login-form p > input[type="text"]' ).val( '' );
		$( '.gp-login-form-wrapper, .gp-lost-password-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	});

	// Open registration modal window directly from URL
	if ( /#register/.test( window.location.href ) ) {
		$( '#login' ).show();
		$( '.gp-register-form-wrapper, .gp-register-form .login-form > p, .gp-register-form .wp-submit' ).show();
		$( '.gp-register-form .login-form p > input[type="text"]' ).val( '' );
		$( '.gp-login-form-wrapper, .gp-lost-password-form-wrapper, .gp-social-login-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	}
				
	// Close reset success message	
	$( '#gp-close-reset-message' ).click( function() {
		$( '#gp-reset-message' ).remove();
	});		

	// Open social links modal window
	$( '.gp-social-login-link' ).click(function() {
		$( '.gp-social-login-form-wrapper' ).show();
		$( '.gp-login-form-wrapper, .gp-register-form-wrapper, .gp-lost-password-form-wrapper' ).hide();
		$( '.gp-login-results > span' ).remove();
	});


	/*--------------------------------------------------------------
	Hide links if they go outside header
	--------------------------------------------------------------*/

	function gpMenuWidths() {
	
		if ( ghostpool_script.hide_move_primary_menu_links == 'enabled' && jQuery( window ).width() >= 992 ) {

			if ( $( '#gp-main-nav' ).length > 0 ) {
	
				var navContainer = $( '#gp-main-nav' ),
					headerWidth = $( '#gp-main-header .gp-container' ).width(),
					logoWidth = $( '#gp-logo' ).width(),
					searchWidth = $( '#gp-main-header .searchform' ).width(),
					navWidth = ( headerWidth - logoWidth - searchWidth ),
					linkWidth = 0,
					newNavWidth = 0;
					
				navContainer.removeClass( 'gp-hide-main-nav' );	

				navContainer.find( 'ul' ).first().children( 'li:visible' ).each( function() {
					linkWidth += $( this ).outerWidth( true );
					if ( linkWidth > navWidth - 60 ) {
						$( this ).addClass( 'gp-hide-menu' ); // Add class to all links you want to hide
					}
				});
			
				if ( ! navContainer.find( '.menu-item' ).hasClass( 'gp-more-menu-items' ) ) {
					navContainer.find( '.gp-hide-menu' ).wrapAll( '<li class="menu-item gp-standard-menu menu-item-has-children gp-more-menu-items"><ul class="sub-menu"></ul><li>' );
				}
						
				if ( ! navContainer.find( '.gp-more-menu-items span' ).hasClass( 'gp-more-menu-items-icon' ) ) {
					navContainer.find( '.gp-more-menu-items' ).prepend( '<span class="gp-more-menu-items-icon"></span>' );
				}		
				
				navContainer.css( 'width', navWidth );

			}
		
		}	

	}
	
	$( window ).on( 'load resize', function(e) {
		gpMenuWidths();
	});    	

});