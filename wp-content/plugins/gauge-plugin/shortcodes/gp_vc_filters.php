<?php 
	
if ( ! function_exists( 'ghostpool_filters' ) ) {

	function ghostpool_filters( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'parent_cat' => '',
			//'cats' => '',
			'fields' => '',
			'date_posted' => 'enabled',
			'date_modified' => 'disabled',
			'parent_cat_text' =>  esc_html__( 'Categories', 'gauge-plugin' ),
			'date_posted_text' =>  esc_html__( 'Release Date', 'gauge-plugin' ),
			'date_modified_text' =>  esc_html__( 'Last Updated', 'gauge-plugin' ),
			'submit_button_text' =>  esc_html__( 'Filter Items', 'gauge-plugin' ),
			'classes' => '',
			'bg_color' => '',
			'border_color' => '',
		), $atts ) );	
		
		global $post;
		
		if ( ! is_archive() )
			return;
		
		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'filters';
				
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_filters_wrapper_' . $gp_i;

		// Get parent cat ID and/or slug
		if ( $parent_cat && is_numeric( $parent_cat ) ) {
			$parent_cat	= (int) $parent_cat;
		}
		if ( $parent_cat && term_exists( $parent_cat ) !== 0 && term_exists( $parent_cat ) !== null ) {
			if ( is_numeric( $parent_cat ) ) { // ID
				$gp_parent_cat_slug = get_term_by( 'id', $parent_cat, 'gp_hubs' );
				$gp_parent_cat_slug = $gp_parent_cat_slug->slug;	
				$gp_parent_cat_id = $parent_cat;
			} else { // Slug
				$gp_parent_cat_slug = $parent_cat;
				$gp_parent_cat_id = get_term_by( 'slug', $parent_cat, 'gp_hubs' );
				$gp_parent_cat_id = $gp_parent_cat_id->term_id;
			}
		}
	
		// Get cat IDs and/or slugs
		/*if ( $cats ) {
			if ( preg_match( '/[a-zA-Z\-]+/', $cats ) ) {			
				$cat_ids = array();
				$cat_slugs = explode( ',', $cats );
				foreach( $cat_slugs as $cat_slug ) {
					$cat_id = get_term_by( 'slug', $cat_slug, 'gp_hubs' );
					$gp_cat_array[] = $cat_id->term_id;
				}
				$cat_ids = $gp_cat_array;
			} else {
				$cat_ids = $cats;
			}
		}*/		
				
		// Fields to add to filter
		if ( $fields ) {
			$gp_filters = explode( ',', $fields );
		}
		
		ob_start();
		
		//global $query_string;
		//var_dump( $query_string );
		
		?>

		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-filters-wrapper gp-vc-element <?php echo esc_attr( $classes ); ?>"<?php if ( $bg_color OR $border_color ) { ?> style="background: <?php echo esc_attr( $bg_color ); ?>; border-color: <?php echo esc_attr( $border_color ); ?>"<?php } ?>>

			<?php if ( $widget_title ) { ?><h3 class="widgettitle"><?php echo esc_attr( $widget_title ); ?></h3><?php } ?>
	
			<form method="post" name="filter_form" action="" enctype="multipart/form-data" role="form">

				<?php if ( $date_posted == 'enabled' ) { ?>
					<p>
						<span class="gp-filter-title"><?php echo esc_attr( $date_posted_text ); ?></span>
						<select id="gp-filter-date-posted" name="date_posted">
							<option value="all"<?php if ( isset( $_POST['date_posted'] ) && $_POST['date_posted'] == 'all' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'Any date', 'gauge-plugin' ); ?></option>
							<option value="year"<?php if ( isset( $_POST['date_posted'] ) && $_POST['date_posted'] == 'year' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last year', 'gauge-plugin' ); ?></option>
							<option value="month"<?php if ( isset( $_POST['date_posted'] ) && $_POST['date_posted'] == 'month' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last month', 'gauge-plugin' ); ?></option>
							<option value="week"<?php if ( isset( $_POST['date_posted'] ) && $_POST['date_posted'] == 'week' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last week', 'gauge-plugin' ); ?></option>
							<option value="day"<?php if ( isset( $_POST['date_posted'] ) && $_POST['date_posted'] == 'day' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last day', 'gauge-plugin' ); ?></option>
						</select>
					</p>
				<?php } ?>
			
				<?php if ( $date_modified == 'enabled' ) { ?>
					<p>
						<span class="gp-filter-title"><?php echo esc_attr( $date_modified_text ); ?></span>
						<select id="gp-filter-date-modified" name="date_modified">
							<option value="all"<?php if ( isset( $_POST['date_modified'] ) && $_POST['date_modified'] == 'all' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'Any date', 'gauge-plugin' ); ?></option>
							<option value="year"<?php if ( isset( $_POST['date_modified'] ) && $_POST['date_modified'] == 'year' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last year', 'gauge-plugin' ); ?></option>
							<option value="month"<?php if ( isset( $_POST['date_modified'] ) && $_POST['date_modified'] == 'month' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last month', 'gauge-plugin' ); ?></option>
							<option value="week"<?php if ( isset( $_POST['date_modified'] ) && $_POST['date_modified'] == 'week' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last week', 'gauge-plugin' ); ?></option>
							<option value="day"<?php if ( isset( $_POST['date_modified'] ) && $_POST['date_modified'] == 'day' ) { echo ' selected="selected"'; } ?>><?php esc_html_e( 'In the last day', 'gauge-plugin' ); ?></option>
						</select>
					</p>
				<?php } ?>
				
				<?php if ( $parent_cat && term_exists( $parent_cat ) !== 0 && term_exists( $parent_cat ) !== null ) { ?>						
					<p>
						<span class="gp-filter-title"><?php echo esc_attr( $parent_cat_text ); ?></span>
						<select id="gp-filter-parent-cat" name="gp_hubs">
							<option value="<?php echo sanitize_html_class( $gp_parent_cat_slug ); ?>" selected="selected"><?php esc_html_e( 'All', 'gauge-plugin' ); ?></option>
							<?php 
							$gp_args = array(
								'parent' => (int) $gp_parent_cat_id,
							);
							$gp_cats = get_terms( 'gp_hubs', $gp_args );				
							foreach( $gp_cats as $gp_cat ) {
								$gp_cat_slug = $gp_cat->slug;
								$gp_cat_name = $gp_cat->name; ?>
								<option value="<?php echo esc_attr( $gp_cat_slug ); ?>"<?php if ( ( isset( $_POST['gp_hubs'] ) && $_POST['gp_hubs'] == $gp_cat_slug ) OR ( get_queried_object()->slug == $gp_cat_slug ) ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $gp_cat_name ); ?></option>
							<?php } ?>
						</select>
					</p>
				<?php } ?>
							
				<!--<?php $gp_cats = ''; if ( $gp_cats ) { ?>						
					<p>
						<span class="gp-filter-title"><?php echo esc_attr( $parent_cat_text ); ?></span>
						<select id="gp-hub-cats" name="gp_hubs">
							<option value="" selected="selected"><?php esc_html_e( 'All', 'gauge-plugin' ); ?></option>
							<?php
							$gp_args = array(
								'include' => $gp_cat_ids,
							);
							$gp_cats = get_terms( 'gp_hubs', $gp_args );				
							foreach( $gp_cats as $gp_cat ) {
								$gp_cat_slug = $gp_cat->slug;
								$gp_cat_name = $gp_cat->name; ?>
								<option value="<?php echo esc_attr( $gp_cat_slug ); ?>"<?php if ( isset( $_POST['gp_hubs'] ) && $_POST['gp_hubs'] == $gp_cat_slug ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $gp_cat_name ); ?></option>
							<?php } ?>
						</select>
					</p>
				<?php } ?>-->
											
				<?php if ( $fields ) {
				
					foreach( $gp_filters as $gp_filter ) {

						// Get taxonomy name from slug                    
						$gp_taxonomy = get_taxonomy( $gp_filter );
						if ( ! $gp_taxonomy ) {
							continue;
						}
						$gp_name = $gp_taxonomy->labels->singular_name;
	
						// Get terms for given taxonomy
						$gp_terms = get_terms( $gp_filter );
	
					?>
					<p>
						<span class="gp-filter-title"><?php echo esc_attr( $gp_name ); ?></span>
						<select id="gp-filter-<?php echo esc_attr( $gp_filter ); ?>" name="<?php echo esc_attr( $gp_filter ); ?>">
							<option value=""><?php esc_html_e( 'All', 'gauge-plugin' ); ?></option>
							<?php foreach( $gp_terms as $gp_term ) {
								$gp_term_slug = $gp_term->slug;
								$gp_term_name = $gp_term->name; ?>
								<option value="<?php echo esc_attr( $gp_term_slug ); ?>"<?php if ( ( isset( $_POST[ $gp_filter ] ) && $_POST[ $gp_filter ] == $gp_term_slug ) OR ( get_queried_object()->slug == $gp_term_slug ) ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $gp_term_name ); ?></option>
							<?php } ?>
						</select>
					</p>
					<?php }
				
				} ?>
				
				<input type="submit" value="<?php echo esc_attr( $submit_button_text ); ?>" tabindex="40" id="gp-filter-submit" name="submit" class="button" />
			
				<input type="hidden" name="action" value="ghostpool_filter" />
		
			</form>
		
		</div>
		
		<?php

		$output_string = ob_get_contents();
		ob_end_clean();
		$GLOBALS['ghostpool_shortcode'] = null;
		return $output_string;

	}

}

add_shortcode( 'filters', 'ghostpool_filters' );
	
?>