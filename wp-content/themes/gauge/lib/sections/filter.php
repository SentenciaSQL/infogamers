<?php

if ( $GLOBALS['ghostpool_filter'] == 'enabled' && ghostpool_option( 'ajax', '', 'ajax-loop' ) == 'ajax-loop' ) { ?>

	<div class="gp-filter-wrapper">
	
		<div class="gp-filter-menu-wrapper">

			<?php if ( isset( $GLOBALS['ghostpool_filter_cats'] ) && $GLOBALS['ghostpool_filter_cats'] == '1' ) { 

				$gp_taxonomies = get_taxonomies();
				$gp_args = array(
					'parent' => (int) $GLOBALS['ghostpool_filter_cats_id'],
				);
				$gp_terms = get_terms( array( 'category', 'gp_hubs', 'gp_videos' ) );
				foreach ( $gp_taxonomies as $gp_taxonomy ) {
					$gp_term = term_exists( (int) $GLOBALS['ghostpool_filter_cats_id'], $gp_taxonomy );
					if ( $gp_term !== 0 && $gp_term !== null ) {
						$gp_terms = get_terms( $gp_taxonomy, $gp_args );
						break;
					}
				}
				if ( $gp_terms ) { ?>
					<select name="gp-filter-cats" class="gp-filter-menu gp-filter-cats">
						<option value="<?php echo esc_attr( $GLOBALS['ghostpool_filter_cats_id'] ); ?>"><?php esc_html_e( 'All', 'gauge' ); ?></option>		
						<?php foreach( $gp_terms as $gp_term ) {
							if ( ! empty( $gp_terms ) && ! is_wp_error( $gp_terms ) ) { ?>
								<option value="<?php echo esc_attr( $gp_term->term_id ); ?>"><?php echo esc_attr( $gp_term->name ); ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				<?php } ?>
			<?php } ?>
		
			<?php if ( ( isset( $GLOBALS['ghostpool_filter_date'] ) && $GLOBALS['ghostpool_filter_date'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_title'] ) && $GLOBALS['ghostpool_filter_title'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_comment_count'] ) && $GLOBALS['ghostpool_filter_comment_count'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_views'] ) && $GLOBALS['ghostpool_filter_views'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_followers'] ) && $GLOBALS['ghostpool_filter_followers'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_site_rating'] ) && $GLOBALS['ghostpool_filter_site_rating'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_user_rating'] ) && $GLOBALS['ghostpool_filter_user_rating'] == '1' )
			OR ( isset( $GLOBALS['ghostpool_filter_hub_awards'] ) && $GLOBALS['ghostpool_filter_hub_awards'] == '1' ) ) { ?>

				<select name="gp-filter-orderby" class="gp-filter-menu gp-filter-orderby">
		
					<?php if ( isset( $GLOBALS['ghostpool_filter_date'] ) && $GLOBALS['ghostpool_filter_date'] == '1' ) { ?>
						<option value="newest"<?php if ( $GLOBALS['ghostpool_orderby'] == 'newest' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Newest', 'gauge' ); ?></option>
						<option value="oldest"<?php if ( $GLOBALS['ghostpool_orderby'] == 'oldest' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Oldest', 'gauge' ); ?></option>
					<?php } ?>
		
					<?php if ( isset( $GLOBALS['ghostpool_filter_title'] ) && $GLOBALS['ghostpool_filter_title'] == '1' ) { ?>
						<option value="title_az"<?php if ( $GLOBALS['ghostpool_orderby'] == 'title_az' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Title (A-Z)', 'gauge' ); ?></option>
						<option value="title_za"<?php if ( $GLOBALS['ghostpool_orderby'] == 'title_za' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Title (Z-A)', 'gauge' ); ?></option>
					<?php } ?>		
											
					<?php if ( isset( $GLOBALS['ghostpool_filter_comment_count'] ) && $GLOBALS['ghostpool_filter_comment_count'] == '1' ) { ?>
						<option value="comment_count"<?php if ( $GLOBALS['ghostpool_orderby'] == 'comment_count' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Most Comments', 'gauge' ); ?></option>
					<?php } ?>		
						
					<?php if ( isset( $GLOBALS['ghostpool_filter_views'] ) && $GLOBALS['ghostpool_filter_views'] == '1' ) { ?>
						<option value="views"<?php if ( $GLOBALS['ghostpool_orderby'] == 'views' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Most Views', 'gauge' ); ?></option>
					<?php } ?>

					<?php if ( isset( $GLOBALS['ghostpool_filter_followers'] ) && $GLOBALS['ghostpool_filter_followers'] == '1' ) { ?>
						<option value="followers"<?php if ( $GLOBALS['ghostpool_orderby'] == 'followers' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Most Followers', 'gauge' ); ?></option>
					<?php } ?>	
			
					<?php if ( isset( $GLOBALS['ghostpool_filter_site_rating'] ) && $GLOBALS['ghostpool_filter_site_rating'] == '1' ) { ?>
						<option value="site_rating"<?php if ( $GLOBALS['ghostpool_orderby'] == 'site_rating' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Top Site Rated', 'gauge' ); ?></option>
					<?php } ?>
		
					<?php if ( isset( $GLOBALS['ghostpool_filter_user_rating'] ) && $GLOBALS['ghostpool_filter_user_rating'] == '1' ) { ?>
						<option value="user_rating"<?php if ( $GLOBALS['ghostpool_orderby'] == 'user_rating' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Top User Rated', 'gauge' ); ?></option>
					<?php } ?>
					
					<?php if ( isset( $GLOBALS['ghostpool_filter_hub_awards'] ) && $GLOBALS['ghostpool_filter_hub_awards'] == '1' ) { ?>
						<option value="hub_awards"<?php if ( $GLOBALS['ghostpool_orderby'] == 'hub_awards' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Awards', 'gauge' ); ?></option>
					<?php } ?>
						
				</select>
	
			<?php } ?>

			<?php if ( isset( $GLOBALS['ghostpool_filter_date_posted'] ) && $GLOBALS['ghostpool_filter_date_posted'] == '1' ) { ?>		
		
				<select name="gp-filter-date-posted" class="gp-filter-menu gp-filter-date-posted">
					<option value="all"<?php if ( $GLOBALS['ghostpool_date_posted'] == 'all' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Posted any date', 'gauge' ); ?></option>
					<option value="year"<?php if ( $GLOBALS['ghostpool_date_posted'] == 'year' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Posted in the last year', 'gauge' ); ?></option>
					<option value="month"<?php if ( $GLOBALS['ghostpool_date_posted'] == 'month' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Posted in the last month', 'gauge' ); ?></option>
					<option value="week"<?php if ( $GLOBALS['ghostpool_date_posted'] == 'week' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Posted in the last week', 'gauge' ); ?></option>
					<option value="day"<?php if ( $GLOBALS['ghostpool_date_posted'] == 'day' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Posted in the last day', 'gauge' ); ?></option>	
				</select>
		
			<?php } ?>

			<?php if ( isset( $GLOBALS['ghostpool_filter_date_modified'] ) && $GLOBALS['ghostpool_filter_date_modified'] == '1' ) { ?>		
		
				<select name="gp-filter-date-modified" class="gp-filter-menu gp-filter-date-modified">
					<option value="all"<?php if ( $GLOBALS['ghostpool_date_modified'] == 'all' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Updated any date', 'gauge' ); ?></option>
					<option value="year"<?php if ( $GLOBALS['ghostpool_date_modified'] == 'year' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Updated in the last year', 'gauge' ); ?></option>
					<option value="month"<?php if ( $GLOBALS['ghostpool_date_modified'] == 'month' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Updated in the last month', 'gauge' ); ?></option>
					<option value="week"<?php if ( $GLOBALS['ghostpool_date_modified'] == 'week' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Updated in the last week', 'gauge' ); ?></option>
					<option value="day"<?php if ( $GLOBALS['ghostpool_date_modified'] == 'day' ) { ?> selected="selected"<?php } ?>><?php esc_html_e( 'Updated in the last day', 'gauge' ); ?></option>	
				</select>
		
			<?php } ?>			
									
		</div>
	
		<div class="gp-element-title-line"></div>
	
	</div>

<?php } ?>