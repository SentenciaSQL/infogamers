(function ($) {

	function user_rating() {
		if ($('#gp-user-rating-wrapper').length) {
			this.el = this.build_el();
			if (!this.is_rated()) {
				this.el.slider.unrated.css('width', ghostpool_rating.rating_width);
				this.bind_events();
			} else {
				this.display_user_rating();
				this.el.slider.rated.addClass('gp-rating-rated');
			}
		}
	}

	user_rating.prototype.is_rated = function () {
		if (this.readCookie('ghostpool_rating_' + ghostpool_rating.post_id) === 'rated' || ghostpool_rating.rated === 'rated' ) {
			$( '.gp-submit-rating' ).hide();
			return true;
		} else {
			return false;
		}
	};

	user_rating.prototype.display_user_rating = function () {
		if ( ghostpool_rating.rating != '' ) {
			var score = ghostpool_rating.rating;
		} else {
			var score = this.readCookie('ghostpool_rating_score_' + ghostpool_rating.post_id);
		}		
		if ( ghostpool_rating.position != '' ) {
			var position = ghostpool_rating.position;
		} else {
			var position = this.readCookie('ghostpool_rating_position_'+ ghostpool_rating.post_id);
		}
		this.el.rating.score.html(score);
		this.el.slider.rated.css('width', position + 'px');
	};

	user_rating.prototype.build_el = function () {
		var el = {
			rating:{
				score:$('span.gp-score', '.gp-current-rating'),
				count:$('span.gp-count', '.gp-current-rating'),
			},
			slider:{
				unrated:$('.gp-rating-unrated', '.gp-rating-slider-wrapper'),
				rated:$('.gp-rating-selection', '.gp-rating-slider-wrapper'),
			}
		};
	
		// Plain JS style retrieval
		el.slider.old_position = parseInt(el.slider.rated[0].style.width, 10);
		el.rating.old_score = el.rating.score.html();

		return el;
	};

	user_rating.prototype.bind_events = function () {
		var me = this;

		me.el.slider.unrated.on('mouseover', function () {
			 me.el.slider.rated.addClass( 'gp-rating-hover' );
			$(this).css('cursor', 'pointer');
		});
		me.el.slider.unrated.on('mouseout', function () {

			me.el.slider.rated.removeClass( 'gp-rating-hover' );

			// Returns the initial position
			me.el.slider.rated.css('width', me.el.slider.old_position + 'px');

			// Returns the text and initial rating
			me.el.rating.score.html(me.el.rating.old_score);

		});
		me.el.slider.unrated.on('mousemove', function (e) {
			if (!e.offsetX){
				e.offsetX = e.clientX - $(e.target).offset().left;
			}
			// Moves the width
			var offset = e.offsetX + 4;
			if (offset > ghostpool_rating.rating_width) {
				offset = ghostpool_rating.rating_width;
			}
			me.el.slider.rated.css('width', offset + 'px');

			// Update the real-time score
			var score = Math.floor((((((offset / ghostpool_rating.rating_width) * 100) * ghostpool_rating.rating_number) / 100) * 10)) / 10;
			if (score >= ghostpool_rating.rating_number) {
				score = ghostpool_rating.rating_number;
			}
			if (score < 1 ) {
				score = 1;
			}
			me.el.rating.score.html(score);

		});

		// Click effect
		me.el.slider.unrated.on('click', function (e) {
		
			if (!e.offsetX){
				e.offsetX = e.clientX - $(e.target).offset().left;
			}
			var count = parseInt(me.el.rating.count.html(), 10) + 1,
				score = (Math.floor(((((((e.offsetX + 4) / ghostpool_rating.rating_width) * 100) * ghostpool_rating.rating_number) / 100) * 10)) / 10),
				position = e.offsetX + 4;
			if (score > ghostpool_rating.rating_number) {
				score = ghostpool_rating.rating_number;
			}        
			if (score < 1 ) {
				score = 1;
			}			
			if (position > ghostpool_rating.rating_width) {
				position = ghostpool_rating.rating_width;
			}		
			
			function gpResizeWindow() {
			
				if ( $(window).innerWidth() <= 1082 ) {	

					// slider animation
					me.el.slider.rated.fadeOut(function () {
						me.el.slider.rated.addClass( 'gp-rating-hover' );
						me.el.slider.rated.fadeIn();
						me.el.rating.score.html(score);
						me.el.slider.rated.css('width', me.el.slider.position + 'px');
					});		
							
					$( '.gp-submit-rating' ).off('click').on('click', function (e) {
			
						me.el.slider.rated.fadeOut(function () {
							me.el.slider.rated.addClass( 'gp-rating-hover' );
							me.el.slider.rated.fadeIn();
							me.el.rating.score.html(score);
							me.el.slider.rated.css('width', me.el.slider.position + 'px');
							$( '.gp-submit-rating' ).hide();
						});		

						// Unbind events
						me.el.slider.unrated.off();
						me.el.slider.unrated.css('cursor', 'default');
			
						// Count increment
						me.el.rating.count.html(count);

						// AJAX call to wordpress
						var req = {
							action:'ghostpool_rating',
							rating_position:position,
							rating_score:score,
							post_id:ghostpool_rating.post_id
						};

						$.post(ghostpool_rating.ajaxurl, req, function () {
							// Save cookie
							me.createCookie('ghostpool_rating_' + ghostpool_rating.post_id, 'rated', 900);
							me.createCookie('ghostpool_rating_score_' + ghostpool_rating.post_id, score, 900);
							me.createCookie('ghostpool_rating_position_' + ghostpool_rating.post_id, position, 900);
						})
			
					})
				
				} else {

					// Unbind events
					me.el.slider.unrated.off();
					me.el.slider.unrated.css('cursor', 'default');

					// slider animation
					me.el.slider.rated.fadeOut(function () {
						me.el.slider.rated.addClass( 'gp-rating-hover' );
						me.el.slider.rated.fadeIn();
					});

					// Count increment
					me.el.rating.count.html(count);

					// AJAX call to wordpress
					var req = {
						action:'ghostpool_rating',
						rating_position:position,
						rating_score:score,
						post_id:ghostpool_rating.post_id
					};

					$.post(ghostpool_rating.ajaxurl, req, function () {
						// Save cookie
						me.createCookie('ghostpool_rating_' + ghostpool_rating.post_id, 'rated', 900);
						me.createCookie('ghostpool_rating_score_' + ghostpool_rating.post_id, score, 900);
						me.createCookie('ghostpool_rating_position_' + ghostpool_rating.post_id, position, 900);
					})
				
				}	

			}
						
			gpResizeWindow();
			$( window ).resize( gpResizeWindow );
			
		});
	};

	user_rating.prototype.createCookie = function (name, value, days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
        } else {
            var expires = "";
		}
		document.cookie = name + "=" + value + expires + "; path=/";
    };
	user_rating.prototype.readCookie = function (name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1, c.length);
			}
            if (c.indexOf(nameEQ) == 0) {
                return c.substring(nameEQ.length, c.length);
			}
        }
        return null;
    };
	user_rating.prototype.eraseCookie = function (name) {
		createCookie(name, "", -1);
    };
	$(document).ready(function () {
		new user_rating();
	});

})(jQuery);