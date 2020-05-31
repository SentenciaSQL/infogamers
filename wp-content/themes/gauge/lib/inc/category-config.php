<?php

/**
 * Category fields
 *
 */
 
// Media field
function ghostpool_category_media_field( $option, $term_meta ) { 
 			
	// Load scripts
	wp_enqueue_media();
	
	?>
	<script>
	jQuery( document ).ready( function( $ ) {
		var mediaUploader;
		$( '#gp_upload_image_<?php echo esc_attr( $option["id"] ); ?>' ).click( function( e ) {
			e.preventDefault();
			if ( mediaUploader ) {
				mediaUploader.open();
				return;
			}
			mediaUploader = wp.media.frames.file_frame = wp.media({
				title: '<?php esc_html_e( "Choose Image", "gauge" ); ?>',
				button: {
					text: '<?php esc_html_e( "Choose Image", "gauge" ); ?>'
				}, 
				multiple: false 
			});
			mediaUploader.on( 'select', function() {
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
				$( '#gp_term_meta_<?php echo esc_attr( $option["id"] ); ?>' ).val( attachment.url );
				$( '#gp-cat-image-preview-<?php echo esc_attr( $option["id"] ); ?>' ).show();
				$( '#gp-cat-image-preview-<?php echo esc_attr( $option["id"] ); ?> img' ).attr( 'src', attachment.sizes.thumbnail.url );
				$( '#gp-remove-image-<?php echo esc_attr( $option["id"] ); ?>' ).show();
			});
			mediaUploader.open();
		});
		$( '#gp-remove-image-<?php echo esc_attr( $option["id"] ); ?>' ).click( function( e ) {
			e.preventDefault();
			$( '#gp_term_meta_<?php echo esc_attr( $option["id"] ); ?>' ).val( '' );
			$( '#gp-cat-image-preview-<?php echo esc_attr( $option["id"] ); ?>' ).hide();
			$( this ).hide();
		});
	});
	</script>

	<?php if ( $term_meta[$option['id']] ) {
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $term_meta[$option['id']] ) ); 
		$image_id = $attachment[0]; 
		$image_thumb = wp_get_attachment_image_src( $image_id, 'thumbnail' );
		$image_thumb = $image_thumb[0];
	} else {
		$image_thumb = '';
	} ?>

	<div id="gp-cat-image-preview-<?php echo esc_attr( $option['id'] ); ?>" class="gp-cat-image-preview"<?php if ( $term_meta[$option['id']] ) { ?> style="display: block;"<?php } ?>>
		<img src="<?php echo $image_thumb; ?>" alt="" />
	</div>

	<input type="button" id="gp_upload_image_<?php echo esc_attr( $option["id"] ); ?>" class="gp-upload-image-button button button-primary" value="<?php if ( $term_meta[$option['id']] ) { esc_attr_e( 'Change Image', 'gauge' ); } else { esc_attr_e( 'Add Image', 'gauge' ); } ?>" />
	<?php if ( $term_meta[$option['id']] ) { ?>
		<a class="gp-remove-image-button" id="gp-remove-image-<?php echo esc_attr( $option["id"] ); ?>" href="#"><?php esc_attr_e( 'Remove Image', 'gauge' ); ?></a>
	<?php } ?>

	<input id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" type="hidden" name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]" value="<?php echo esc_url( $term_meta[$option['id']] ? $term_meta[$option['id']] : '' ); ?>" />
	<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
	
<?php }

/**
 * Category options
 *
 * @since Gauge 6.9
 */
if ( ! function_exists( 'ghostpool_category_options' ) ) {
	function ghostpool_category_options() {

		// Enable options on hub fields 
		$hub_field_array = array();
		if ( ghostpool_option( 'hub_fields' ) ) {
			
			$char_table = array();
			if ( function_exists( 'ghostpool_hub_field_characters' ) ) {
				$char_table = ghostpool_hub_field_characters();
			}
			
			foreach( ghostpool_option( 'hub_fields' ) as $hub_field ) {
				$hub_field_slug = strtr( $hub_field, $char_table );
				if ( function_exists( 'iconv' ) ) {
					$hub_field_slug = iconv( 'UTF-8', 'UTF-8//TRANSLIT//IGNORE', $hub_field_slug );
				}
				$hub_field_slug = sanitize_title( $hub_field_slug );
				$hub_field_slug = substr( $hub_field_slug, 0, 32 );	
				$hub_field_slugs[] = $hub_field_slug;
			}
			$hub_field_array = $hub_field_slugs;
		}

		// Taxonomy Arrays
		$color_array = array( 'gp_hubs', 'gp_videos' );
		$page_header_array = array( 'category', 'post_tag', 'gp_portfolios', 'gp_hubs', 'gp_videos' );
		$bg_image_array = array( 'category', 'post_tag', 'gp_portfolios', 'gp_hubs', 'gp_videos' );	
		$layout_array = array( 'category', 'post_tag', 'gp_portfolios', 'gp_hubs', 'gp_videos' );	
		$sidebar_array = array( 'category', 'post_tag', 'gp_portfolios', 'gp_hubs', 'gp_videos' );
		$format_array_1 = array( 'category', 'post_tag', 'gp_hubs', 'gp_videos' );
		$format_array_2 = array( 'gp_portfolios' );

		// Enable options on hub fields 
		if ( ghostpool_option( 'hub_fields' ) ) {
		
			foreach( ghostpool_option( 'hub_fields' ) as $hub_field ) {
				$hub_field_slug = strtr( $hub_field, $char_table );
				if ( function_exists( 'iconv' ) ) {
					$hub_field_slug = iconv( 'UTF-8', 'UTF-8//TRANSLIT//IGNORE', $hub_field_slug );
				}
				$hub_field_slug = sanitize_title( $hub_field_slug );
				$hub_field_slug = substr( $hub_field_slug, 0, 32 );		
				add_action( $hub_field_slug . '_add_form_fields', 'ghostpool_add_tax_fields' );
				add_action( $hub_field_slug . '_edit_form_fields', 'ghostpool_edit_tax_fields' );
				add_action( 'created_' . $hub_field_slug, 'ghostpool_save_tax_fields' );	
				add_action( 'edited_' . $hub_field_slug, 'ghostpool_save_tax_fields' );			
			}
		}	
		
		global $ghostpool_cat_options;

		if ( ! is_array( $ghostpool_cat_options ) ) {
			$ghostpool_cat_options = array();
		}
		
		// Category Options	
		$ghostpool_cat_options[] = array( 
			'id'      => 'color',
			'name'    => esc_html__( 'Color', 'gauge' ),
			'desc'    => esc_html__( 'Select a color to associate with this category.', 'gauge' ),
			'type'    => 'color',
			'tax'     => array_merge( $color_array, $hub_field_array ),
			'default' => '',
		);

		$ghostpool_cat_options[] = array( 
			'id'      => 'page_header',
			'name'    => esc_html__( 'Page Header', 'gauge' ),
			'desc'    => esc_html__( 'The page header on the page.', 'gauge' ),
			'type'    => 'select',
			'tax'     => array_merge( $page_header_array, $hub_field_array ),
			'options' => array( 
				'default' => esc_html__( 'Default', 'gauge' ), 
				'gp-large-title' => esc_html__( 'Enabled', 'gauge' ), 
				'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ), 
			),
			'default' => 'default',
		);

		$ghostpool_cat_options[] = array( 
			'id'      => 'bg_image',
			'name'    => esc_html__( 'Page Header Background', 'gauge' ),
			'desc'    => esc_html__( 'The background of the page header.', 'gauge' ),
			'type'    => 'media',
			'tax'     => array_merge( $bg_image_array, $hub_field_array ),
			'default' => '',
		);

		$ghostpool_cat_options[] = array( 
			'id'      => 'layout',
			'name'    => esc_html__( 'Page Layout', 'gauge' ),
			'desc'    => esc_html__( 'The page header on the page.', 'gauge' ),
			'type'    => 'select',
			'tax'     => array_merge( $layout_array, $hub_field_array ),
			'options' => array( 
				'default' => esc_html__( 'Default', 'gauge' ), 
				'gp-left-sidebar' => esc_html__( 'Left Sidebar', 'gauge' ), 
				'gp-right-sidebar' => esc_html__( 'Right Sidebar', 'gauge' ),
				'gp-no-sidebar' => esc_html__( 'No Sidebars', 'gauge' ), 
				'gp-fullwidth' => esc_html__( 'Fullwidth', 'gauge' ),
			),
			'default' => 'default',
		);

		$ghostpool_cat_options[] = array( 
			'id'      => 'sidebar',
			'name'    => esc_html__( 'Sidebar', 'gauge' ),
			'desc'    => esc_html__( 'The sidebar to display.', 'gauge' ),
			'type'    => 'sidebars',
			'tax'     => array_merge( $sidebar_array, $hub_field_array ),
			'options' => array( 
				'default' => esc_html__( 'Default', 'gauge' ),
			),
			'default' => 'default',
		);

		$ghostpool_cat_options[] = array( 
			'id'      => 'format',
			'name'    => esc_html__( 'Format', 'gauge' ),
			'desc'    => esc_html__( 'The format to display the items in.', 'gauge' ),
			'type'    => 'select',
			'tax'     => array_merge( $format_array_1, $hub_field_array ),
			'options' => array( 
				'default' => esc_html__( 'Default', 'gauge' ),
				'blog-standard' => esc_html__( 'Standard', 'gauge' ),  
				'blog-large' => esc_html__( 'Large', 'gauge' ), 
				'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
				'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ), 
				'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ), 
				'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ), 
				'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ), 
				'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ), 
				'blog-masonry' => esc_html__( 'Masonry', 'gauge' ), 
			),
			'default' => 'default',
		);

		$ghostpool_cat_options[] = array(  
			'id'      => 'format',
			'name'    => esc_html__( 'Format', 'gauge' ),
			'desc'    => esc_html__( 'The format to display the items in.', 'gauge' ),
			'type'    => 'select',
			'tax'     => $format_array_2,
			'options' => array( 
				'default' => esc_html__( 'Default', 'gauge' ),
				'portfolio-columns-2' => esc_html__( '2 Columns', 'gauge' ), 
				'portfolio-columns-3' => esc_html__( '3 Columns', 'gauge' ), 
				'portfolio-columns-4' => esc_html__( '4 Columns', 'gauge' ), 
				'portfolio-columns-5' => esc_html__( '5 Columns', 'gauge' ), 
				'portfolio-columns-6' => esc_html__( '6 Columns', 'gauge' ), 
				'portfolio-masonry' => esc_html__( 'Masonry', 'gauge' ), 
			),
			'default' => 'default',
		);

	}
}
add_action( 'after_setup_theme', 'ghostpool_category_options', 11 );

// New category options 
if ( ! function_exists( 'ghostpool_add_tax_fields' ) ) {
	function ghostpool_add_tax_fields( $tag ) {		

		global $ghostpool_cat_options;
 
		// Get current screen
		$screen = get_current_screen();

		// Get category option
		if ( isset( $tag->term_id ) ) {
			$term_id = $tag->term_id;
			$term_meta = get_option( "taxonomy_$term_id" );
		} else {
			$term_meta = null;
		}

		// Run category options through filter to add custom options
		$options = apply_filters( 'gp_custom_category_options', $ghostpool_cat_options );
		
		foreach ( $options as $option ) {
		
			switch( $option['type'] ) {
			
				case 'select' :
				
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
		
						<div class="form-field">
							<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							<select id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]">
								<?php foreach ( $option['options'] as $key => $value ) { ?>
									<?php if ( $term_meta[$option['id']] != '' ) { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $term_meta[$option['id']] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
									<?php } else { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $option['default'] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
						</div>
			
					<?php }
					
				break;

				case 'sidebars' :
			
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
	
						<div class="form-field">
							<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							<select id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]">
								
								<?php foreach ( $option['options'] as $key => $value ) { ?>
									<?php if ( $term_meta[$option['id']] != '' ) { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $term_meta[$option['id']] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
									<?php } else { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $option['default'] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
									<?php } ?>
								<?php } ?>
								
								<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
									<option value="<?php echo sanitize_title( $sidebar['id'] ); ?>"<?php if ( isset( $term_meta[$option['id']] ) && $term_meta[$option['id']] == $sidebar['id'] ) { ?>selected="selected"<?php } ?>>
										<?php echo ucwords( $sidebar['name'] ); ?>
									</option>
								<?php } ?>
							</select>
							<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
						</div>
		
					<?php } 
					
				break;
				
				case 'text' :
			
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
	
						<div class="form-field">
							<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							<input name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]" id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" type="text" value="<?php echo esc_url( $term_meta[$option['id']] ? $term_meta[$option['id']] : '' ); ?>" />
							<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
						</div>
		
					<?php }
					
				break;

				case 'color' :

					// Load scripts
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'wp-color-picker' );
				
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
		
						<div class="form-field">
							<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							<script>
								jQuery( document ).ready( function($){  
									$( '#gp_term_meta_<?php echo esc_attr( $option["id"] ); ?>' ).wpColorPicker();
								});
							</script>
							<input name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]" id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" type="text" value="<?php echo esc_attr( $term_meta[$option['id']] ? $term_meta[$option['id']] : '' ); ?>" />
							<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
						</div>
			
					<?php }
					
				break;

				case 'media' :
			
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
				
						<div class="form-field">
							<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							<?php ghostpool_category_media_field( $option, $term_meta ); ?>
						</div>

					<?php } 
				
				break;
									
			}
						
		}
		
	}
}
add_action( 'category_add_form_fields', 'ghostpool_add_tax_fields' );	
add_action( 'post_tag_add_form_fields', 'ghostpool_add_tax_fields' );
add_action( 'gp_portfolios_add_form_fields', 'ghostpool_add_tax_fields' );	
add_action( 'gp_hubs_add_form_fields', 'ghostpool_add_tax_fields' );
add_action( 'gp_videos_add_form_fields', 'ghostpool_add_tax_fields' );	

// Edit category options
if ( ! function_exists( 'ghostpool_edit_tax_fields' ) ) {
	function ghostpool_edit_tax_fields( $tag ) {

		global $ghostpool_cat_options;

		// Get current screen
		$screen = get_current_screen();

		// Get category option
		if ( isset( $tag->term_id ) ) {
			$term_id = $tag->term_id;
			$term_meta = get_option( "taxonomy_$term_id" );
		} else {
			$term_meta = null;
		}
		
		// Run category options through filter to add custom options
		$options = apply_filters( 'gp_custom_category_options', $ghostpool_cat_options );
		
		foreach ( $options as $option ) {
		
			switch( $option['type'] ) {
			
				case 'select' :
				
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
		
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							</th>
							<td>	
								<select id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]">
									<?php foreach ( $option['options'] as $key => $value ) { ?>
										<?php if ( $term_meta[$option['id']] != '' ) { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $term_meta[$option['id']] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
										<?php } else { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $option['default'] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
										<?php } ?>
									<?php } ?>
								</select>
								<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
							</td>
						</tr>
			
					<?php }
					
				break;

				case 'sidebars' :
			
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
	
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							</th>
							<td>	
								<select id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]">
								
									<?php foreach ( $option['options'] as $key => $value ) { ?>
										<?php if ( $term_meta[$option['id']] != '' ) { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $term_meta[$option['id']] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
										<?php } else { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $option['default'] == $key ) { echo ' selected="selected"'; } ?>><?php echo esc_attr( $value ); ?></option>
										<?php } ?>
									<?php } ?>
								
									<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
										<option value="<?php echo sanitize_title( $sidebar['id'] ); ?>"<?php if ( isset( $term_meta[$option['id']] ) && $term_meta[$option['id']] == $sidebar['id'] ) { ?>selected="selected"<?php } ?>>
											<?php echo ucwords( $sidebar['name'] ); ?>
										</option>
									<?php } ?>
								</select>
								<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
							</td>
						</tr>
		
					<?php } 
					
				break;
				
				case 'text' :
			
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
	
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							</th>
							<td>
								<input name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]" id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" type="text" value="<?php echo esc_url( $term_meta[$option['id']] ? $term_meta[$option['id']] : '' ); ?>" />
								<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
							</td>
						</tr>
		
					<?php }
					
				break;

				case 'color' :

					// Load scripts
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'wp-color-picker' );
					
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
	
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							</th>
							<td>
								<script>
									jQuery( document ).ready( function($){  
										$( '#gp_term_meta_<?php echo esc_attr( $option["id"] ); ?>' ).wpColorPicker();
									});
								</script>
								<input name="gp_term_meta[<?php echo esc_attr( $option['id'] ); ?>]" id="gp_term_meta_<?php echo esc_attr( $option['id'] ); ?>" type="text" value="<?php echo esc_attr( $term_meta[$option['id']] ? $term_meta[$option['id']] : '' ); ?>" />
								<p class="description"><?php echo esc_attr( $option['desc'] ); ?></p>
							</td>
						</tr>
		
					<?php }
					
				break;
	
				case 'media' :
				
					// Checking what category pages to show this option on
					$add_field = false;
					foreach ( $option['tax'] as $type ) {
						if ( $screen->taxonomy == $type ) {
							$add_field = true;
						}
					}

					if ( $add_field == true ) { ?>
					
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="category-<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_attr( $option['name'] ); ?></label>
							</th>
							<td>
								<?php ghostpool_category_media_field( $option, $term_meta ); ?>
							</td>
						</tr>

					<?php } 
					
				break;
															
			}
			
		}	
	
	}
}
add_action( 'edit_category_form_fields', 'ghostpool_edit_tax_fields' );	
add_action( 'post_tag_edit_form_fields', 'ghostpool_edit_tax_fields' );
add_action( 'gp_portfolios_edit_form_fields', 'ghostpool_edit_tax_fields' );
add_action( 'gp_hubs_edit_form_fields', 'ghostpool_edit_tax_fields' );
add_action( 'gp_videos_edit_form_fields', 'ghostpool_edit_tax_fields' );

// Save category options
if ( ! function_exists( 'ghostpool_save_tax_fields' ) ) {	
	function ghostpool_save_tax_fields( $term_id ) {
		if ( isset( $_POST['gp_term_meta'] ) ) {
			$term_id = $term_id;
			$term_meta = get_option( "taxonomy_$term_id" );
			$cat_keys = array_keys( $_POST['gp_term_meta'] );
				foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['gp_term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['gp_term_meta'][$key];
				}
			}
			update_option( "taxonomy_$term_id", $term_meta );
		}
	}			
}
add_action( 'created_category', 'ghostpool_save_tax_fields' );		
add_action( 'edit_category', 'ghostpool_save_tax_fields' );
add_action( 'created_post_tag', 'ghostpool_save_tax_fields' ); 
add_action( 'edited_post_tag', 'ghostpool_save_tax_fields' );
add_action( 'created_gp_portfolios', 'ghostpool_save_tax_fields' );	
add_action( 'edited_gp_portfolios', 'ghostpool_save_tax_fields' );	
add_action( 'created_gp_hubs', 'ghostpool_save_tax_fields' );	
add_action( 'edited_gp_hubs', 'ghostpool_save_tax_fields' );	
add_action( 'created_gp_videos', 'ghostpool_save_tax_fields' );	
add_action( 'edited_gp_videos', 'ghostpool_save_tax_fields' );			

?>