<?php

if ( ! function_exists( 'ghostpool_ratings' ) ) {

	function ghostpool_ratings( $gp_post_id = '' ) {
		
		global $post;

		// Get site rating
		if ( get_post_meta( $gp_post_id, '_wp_page_template', true ) == 'hub-template.php' ) {
			$GLOBALS['ghostpool_site_rating'] = get_post_meta( $gp_post_id, '_gp_site_rating', true );
		} elseif ( get_post_meta( $gp_post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) {	
			$review_site_rating = get_post_meta( $gp_post_id, 'hub_review_site_rating', true );
			if ( get_post_meta( $gp_post_id, '_gp_old_site_rating', true ) && ( ! isset( $review_site_rating[0] ) OR empty( $review_site_rating[0] ) ) ) {
				$GLOBALS['ghostpool_site_rating'] = get_post_meta( $gp_post_id, '_gp_old_site_rating', true );
			} else {
				$GLOBALS['ghostpool_site_rating'] = $review_site_rating;
			}
		} elseif ( get_post_meta( $gp_post_id, '_wp_page_template', true ) == 'review-template.php' ) {
			$review_site_rating = get_post_meta( $gp_post_id, 'review_site_rating', true );
			if ( get_post_meta( $gp_post_id, '_gp_old_site_rating', true ) && ( ! isset( $review_site_rating[0] ) OR empty( $review_site_rating[0] ) ) ) {
				$GLOBALS['ghostpool_site_rating'] = get_post_meta( $gp_post_id, '_gp_old_site_rating', true );
			} else {
				$GLOBALS['ghostpool_site_rating'] = $review_site_rating;
			}	
		} elseif ( $post && $post->post_type && $post->post_type == 'gp_user_review' ) {
			$GLOBALS['ghostpool_site_rating'] = get_post_meta( $gp_post_id, '_user_review_rating', true );
		}
		if ( ! isset( $GLOBALS['ghostpool_site_rating'][0] ) OR empty( $GLOBALS['ghostpool_site_rating'][0] ) ) {
			$GLOBALS['ghostpool_site_rating'] = '';
		}

		// Get user rating
		if ( get_post_meta( $gp_post_id, '_gp_user_rating', true ) ) { 
			$GLOBALS['ghostpool_user_rating'] = number_format( get_post_meta( $gp_post_id, '_gp_user_rating', true ), 1 ) + 0;
		} else {
			$GLOBALS['ghostpool_user_rating'] = '';
		}
			
		// Detect if site rating enabled
		if ( ( isset( $GLOBALS['ghostpool_display_site_rating'] ) && $GLOBALS['ghostpool_display_site_rating'] == '1' ) && $GLOBALS['ghostpool_site_rating'] != '' ) {
			$GLOBALS['ghostpool_site_rating_enabled'] = true;
		} else {
			$GLOBALS['ghostpool_site_rating_enabled'] = false;	
		}
		
		// Detect if user rating enabled
		if ( ( isset( $GLOBALS['ghostpool_display_user_rating'] ) && $GLOBALS['ghostpool_display_user_rating'] == '1' ) && $GLOBALS['ghostpool_user_rating'] != '' ) {
			$GLOBALS['ghostpool_user_rating_enabled'] = true;
		} else {
			$GLOBALS['ghostpool_user_rating_enabled'] = false;	
		}
				
		// Review score
		if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) {

			// Detect multiple site ratings
			if ( is_array( $GLOBALS['ghostpool_site_rating'] ) ) {
				if ( isset( $GLOBALS['ghostpool_site_rating'][0] ) && $GLOBALS['ghostpool_site_rating'][0] != '' ) {
					if ( count( $GLOBALS['ghostpool_site_rating'] ) === 1 ) {
						$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating'][0], 1 ) + 0;
					} else {
						$GLOBALS['ghostpool_site_rating_sum'] = array_sum( $GLOBALS['ghostpool_site_rating'] );
						$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating_sum'] / count( $GLOBALS['ghostpool_site_rating'] ), 1 ) + 0;
					}
				} else {
					$GLOBALS['ghostpool_total_score'] = '';
				}		
			} else {
				$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating'], 1 ) + 0;
			}
			
			// Get rating degrees
			$GLOBALS['ghostpool_site_deg'] = ( 360 * ( $GLOBALS['ghostpool_total_score'] / ghostpool_option( 'review_rating_number' ) ) );
						
			// Site rating text
			if ( $GLOBALS['ghostpool_total_score'] < 1 ) {
				$GLOBALS['ghostpool_site_rating_text'] = '';
			} elseif ( $GLOBALS['ghostpool_total_score'] < 2 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_1' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 3 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_2' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 4 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_3' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 5 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_4' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 6 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_5' );				
			} elseif ( $GLOBALS['ghostpool_total_score'] < 7 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_6' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 8 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_7' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 9 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_8' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 10 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_9' );
			} elseif ( $GLOBALS['ghostpool_total_score'] < 11 ) {
				$GLOBALS['ghostpool_site_rating_text'] = ghostpool_option( 'review_site_rating_text_10' );
			}

			// Clip class		
			if ( $GLOBALS['ghostpool_site_deg'] < 180 ) {
				$GLOBALS['ghostpool_site_clip_class_1'] = ' gp-score-clip-1';
				$GLOBALS['ghostpool_site_clip_class_2'] = ' gp-score-clip-2';
			} else {
				$GLOBALS['ghostpool_site_clip_class_1'] = ' gp-no-score-clip-1';
				$GLOBALS['ghostpool_site_clip_class_2'] = ' gp-no-score-clip-2';	
			}
		
		}

		// User score
		if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) {
			
			// Get rating degrees
			$GLOBALS['ghostpool_user_deg'] = ( 360 * ( $GLOBALS['ghostpool_user_rating'] / ghostpool_option( 'review_rating_number' ) ) );
						
			// Site rating text
			if ( $GLOBALS['ghostpool_user_rating'] < 1 ) {
				$GLOBALS['ghostpool_user_rating_text'] = '';
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 2 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_1' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 3 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_2' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 4 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_3' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 5 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_4' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 6 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_5' );				
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 7 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_6' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 8 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_7' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 9 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_8' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 10 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_9' );
			} elseif ( $GLOBALS['ghostpool_user_rating'] < 11 ) {
				$GLOBALS['ghostpool_user_rating_text'] = ghostpool_option( 'review_site_rating_text_10' );
			}

			// Clip class		
			if ( $GLOBALS['ghostpool_user_deg'] < 180 ) {
				$GLOBALS['ghostpool_user_clip_class_1'] = ' gp-score-clip-1';
				$GLOBALS['ghostpool_user_clip_class_2'] = ' gp-score-clip-2';
			} else {
				$GLOBALS['ghostpool_user_clip_class_1'] = ' gp-no-score-clip-1';
				$GLOBALS['ghostpool_user_clip_class_2'] = ' gp-no-score-clip-2';	
			}
		
		}
				
	}
}


/////////////////////////////////////// Store total score as meta key on hub and review pages ///////////////////////////////////////	

if ( is_admin() ) {
	if ( ! function_exists( 'ghostpool_total_score_meta' ) ) {
		function ghostpool_total_score_meta() {
			if ( ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' ) && get_post_meta( get_the_ID(), 'review_site_rating', true ) ) {
				global $wpdb, $post;
			
				if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' ) {
					$GLOBALS['ghostpool_site_rating'] = get_post_meta( get_the_ID(), 'review_site_rating', true );
				} else {
					$GLOBALS['ghostpool_site_rating'] = get_post_meta( get_the_ID(), 'hub_review_site_rating', true );
				}
				
				// Detect multiple site ratings
				if ( is_array( $GLOBALS['ghostpool_site_rating'] ) ) {
					if ( isset( $GLOBALS['ghostpool_site_rating'][0] ) && $GLOBALS['ghostpool_site_rating'][0] != '' ) {
						if ( count( $GLOBALS['ghostpool_site_rating'] ) === 1 ) {
							$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating'][0], 1 ) + 0;
						} else {
							$GLOBALS['ghostpool_site_rating_sum'] = array_sum( $GLOBALS['ghostpool_site_rating'] );
							$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating_sum'] / count( $GLOBALS['ghostpool_site_rating'] ), 1 ) + 0;
						}
					} else {
						$GLOBALS['ghostpool_total_score'] = '';
					}					
				} else {
					$GLOBALS['ghostpool_total_score'] = number_format( $GLOBALS['ghostpool_site_rating'], 1 ) + 0;
				}
							
				$GLOBALS['ghostpool_total_score'] = floatval( $GLOBALS['ghostpool_total_score'] );
							
				if ( ! wp_is_post_revision( get_the_ID() ) ) {
					if ( ! add_post_meta( get_the_ID(), '_gp_site_rating', true ) ) {
						delete_post_meta( $post->post_parent, '_gp_site_rating' );
					} elseif ( ! update_post_meta( get_the_ID(), '_gp_site_rating', $GLOBALS['ghostpool_total_score'] ) ) {
						add_post_meta( get_the_ID(), '_gp_site_rating', $GLOBALS['ghostpool_total_score'], true );
						if ( get_post_status( get_the_ID() ) != 'draft' ) {
							add_post_meta( $post->post_parent, '_gp_site_rating', $GLOBALS['ghostpool_total_score'], true );
						}
					} else {
						update_post_meta( get_the_ID(), '_gp_site_rating', $GLOBALS['ghostpool_total_score'] );
						if ( get_post_status( get_the_ID() ) != 'draft' ) {
							update_post_meta( $post->post_parent, '_gp_site_rating', $GLOBALS['ghostpool_total_score'] );
						}
					}
				}	
			}
		}
	}
	add_action( 'publish_page', 'ghostpool_total_score_meta' );
	add_action( 'save_post', 'ghostpool_total_score_meta' );
}


/////////////////////////////////////// Reset user ratings and votes ///////////////////////////////////////	

if ( is_admin() ) {
	if ( ! function_exists( 'ghostpool_reset_user_ratings' ) ) {
		function ghostpool_reset_user_ratings() {
			global $wpdb, $post;
			if ( ! wp_is_post_revision( get_the_ID() ) ) {
				if ( get_post_meta( get_the_ID(), 'hub_reset_user_ratings', true ) == 1 OR get_post_meta( get_the_ID(), 'hub_review_reset_user_ratings', true ) == 1 ) {
					delete_post_meta( get_the_ID(), '_gp_user_rating' );
					delete_post_meta( get_the_ID(), '_gp_user_votes' );
					delete_post_meta( get_the_ID(), '_gp_user_sum' );
					delete_post_meta( get_the_ID(), '_gp_current_position' );
					delete_user_meta( get_current_user_id(), '_gp_rated_' . get_the_ID() );
					delete_user_meta( get_current_user_id(), '_gp_user_rating_' . get_the_ID() );
					delete_user_meta( get_current_user_id(), '_gp_current_position_' . get_the_ID() );
					update_post_meta( get_the_ID(), 'hub_reset_user_ratings', 0 );
					update_post_meta( get_the_ID(), 'hub_review_reset_user_ratings', 0 );
				}
			}	

		}
	}	
	add_action( 'publish_page', 'ghostpool_reset_user_ratings' );
	add_action( 'save_post', 'ghostpool_reset_user_ratings' );
}

?>