<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = 'gp';

if ( ! function_exists( 'ghostpool_add_metaboxes' ) ) :

    function ghostpool_add_metaboxes( $metaboxes ) {

    $metaboxes = array();
             
                
	/*--------------------------------------------------------------
	Post Options
	--------------------------------------------------------------*/	

	// Audio Post Format Options

    $audio_format_options = array();
    $audio_format_options[] = array(
		'fields' => array(
						        
			array(
				'id'        => 'audio_mp3_url',
				'type'      => 'media',
				'title'     => esc_html__( 'MP3 Audio File', 'gauge' ),
				'mode'      => false,
				'desc'      => esc_html__( 'Upload a MP3 audio file.', 'gauge'),
				'default' => '',
			),

			array(
				'id'        => 'audio_ogg_url',
				'type'      => 'media',
				'title'     => esc_html__( 'OGG Audio File', 'gauge' ),
				'mode'      => false,
				'desc'      => esc_html__( 'Upload a OGG audio file.', 'gauge'),
				'default' => '',
			),
					
		),
	);	
    $metaboxes[] = array(
        'id' => 'audio-format-options',
        'title' => esc_html__( 'Audio Options', 'gauge' ),
        'post_types' => array( 'post' ),
        'post_format' => array( 'audio' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $audio_format_options,
    );
    	
    	
	// Gallery Post Format Options
    $gallery_format_options = array();
    $gallery_format_options[] = array(
        'fields' => array(
						        
			array(
				'id'        => 'gallery_slider',
				'type'      => 'gallery',
				'title'     => esc_html__( 'Gallery Slider', 'gauge' ),
				 'subtitle'  => esc_html__( 'Create a new gallery by selecting an existing one or uploading new images using the WordPress native uploader.', 'gauge' ),
				 'desc'  => esc_html__( 'Add a gallery slider.', 'gauge' ),
			),
 
		),
	);		
    $metaboxes[] = array(
        'id' => 'gallery-format-options',
        'title' => esc_html__( 'Gallery Options', 'gauge' ),
        'post_types' => array( 'post' ),
        'post_format' => array( 'gallery' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $gallery_format_options,
    );
    
    
    // Link Format Options   
    $link_format_options = array();
    $link_format_options[] = array(
        'fields' => array(
						        
			array(
				'id'       => 'link',
				'type'     => 'text',
				'title'    => esc_html__( 'Link', 'gauge' ),
				'desc'     => esc_html__( 'The link which your post goes to.', 'gauge' ),
				'validate' => 'url',
			),
			
			array( 
				'id' => 'link_target',
				'title' => esc_html__( 'Link Target', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The target for the link.', 'gauge' ),
				'options' => array(
					'_blank' => esc_html__( 'New Window', 'gauge' ),
					'_self' => esc_html__( 'Same Window', 'gauge' ),
				),
				'default' => '_blank',
			),
					 
		),
	);		
    $metaboxes[] = array(
        'id' => 'link-format-options',
        'title' => esc_html__( 'Link Options', 'gauge' ),
        'post_types' => array( 'post' ),
        'post_format' => array( 'link' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $link_format_options,
    );
    
    
    // Quote Format Options    
    $quote_format_options = array();
    $quote_format_options[] = array(
        'fields' => array(
						        
			array(
				'id'       => 'quote_source',
				'type'     => 'text',
				'title'    => esc_html__( 'Quote Source', 'gauge' ),
				'desc'     => esc_html__( 'The source of the quote.', 'gauge' ),
			),
					 
		),
	);
    $metaboxes[] = array(
        'id' => 'quote-format-options',
        'title' => esc_html__( 'Quote Options', 'gauge' ),
        'post_types' => array( 'post' ),
        'post_format' => array( 'quote' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $quote_format_options,
    );
    
            
    // Video Format Options    
    $video_format_options = array();
    $video_format_options[] = array(
        'fields' => array(
			
			array(
				'id'        => 'video_embed_url',
				'type'      => 'text',
				'title'     => esc_html__('Video URL', 'gauge'),
				'desc'      => esc_html__( 'Video URL uploaded to one of the major video sites e.g. YouTube, Vimeo, blip.tv, etc.', 'gauge'),
				'validate'  => 'url',
				'default' => '',
			),
			        
			array(
				'id'        => 'video_m4v_url',
				'type'      => 'media',
				'title'     => esc_html__( 'M4V Video', 'gauge' ),
				'desc'      => esc_html__( 'Upload a M4V video.', 'gauge'),
				'mode'      => false,
				'default' => '',
			),

			array(
				'id'        => 'video_mp4_url',
				'type'      => 'media',
				'title'     => esc_html__( 'MP4 Video', 'gauge' ),
				'desc'      => esc_html__( 'Upload a MP4 video.', 'gauge'),
				'mode'      => false,
				'default' => '',
			),

			array(
				'id'        => 'video_webm_url',
				'type'      => 'media',
				'title'     => esc_html__( 'WebM Video', 'gauge' ),
				'desc'      => esc_html__( 'Upload a WebM video.', 'gauge'),
				'mode'      => false,
				'default' => '',
			),
			
			array(
				'id'        => 'video_ogv_url',
				'type'      => 'media',
				'title'     => esc_html__( 'OGV Video', 'gauge' ),
				'desc'      => esc_html__( 'Upload a OGV video.', 'gauge'),
				'mode'      => false,
				'default' => '',
			),
		
		),
	);	
    $metaboxes[] = array(
        'id' => 'video-format-options',
        'title' => esc_html__( 'Video Options', 'gauge' ),
        'post_types' => array( 'post' ),
        'post_format' => array( 'video' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $video_format_options,
    ); 
       
       	
    // Main Post Options    	
	$post_options = array();
    $post_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(  

			array(
				'id'      => 'post_association',
				'type'    => 'select',
				'multi' => true,
				'title'   => esc_html__( 'Post Association', 'gauge' ),
				'desc' => esc_html__( 'Choose what hub pages to associate with this post.', 'gauge' ),
				'data' => 'page',
				'args' => array( 'post_status' => array( 'publish', 'future' ), 'sort_column' => 'menu_order' ),
				'default' => '',
			),	

			array(
				'id'      => 'primary_hub',
				'type'    => 'select',
				'data'    => 'primary_hub',
				'title'   => esc_html__( 'Primary Hub', 'gauge' ),
				'subtitle' => esc_html__( 'You will need to save the post/page before you will see the associated hubs in this list.', 'gauge' ),
				'desc' => esc_html__( 'Select a primary hub which will be shown in the hub header, rating box and associated posts for this post.', 'gauge' ),
				'required' => array( 'post_association', '!=', '' ),
				'default' => '',
			),	
			
			array(
				'id'      => 'post_subtitle',
				'type'    => 'text',
				'title'   => esc_html__( 'Post Subtitle', 'gauge' ),
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
			
			array(
				'id' => 'post_title_bg', 
				'title' => esc_html__( 'FlexSlider/Featured Page Template Image', 'gauge' ),
				'type'      => 'media',		
				'mode'      => false,
				'desc' => esc_html__( 'The FlexSlider or Featured page template image background.', 'gauge' ),
				'default' => '',
			),
					
			array( 
				'id' => 'post_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'post_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),

		),
	);

	$post_options[] = array(
		'title' => esc_html__( 'Image', 'gauge' ),
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-picture',
		'fields' => array(  
	
			array(  
				'id' => 'post_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'post_image',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '', 
					'height'    => '',
				),
			),

			array(
				'id' => 'post_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'post_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'Choose how the image aligns with the content.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'default',
			),
		
		),
	);	
    $metaboxes[] = array(
        'id' => 'post-options',
        'title' => esc_html__( 'Post Options', 'gauge' ),
        'post_types' => array( 'post', 'gp_user_review' ),
        'post_format' => array( '0', 'audio', 'gallery', 'quote', 'video' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $post_options
    );


	/*--------------------------------------------------------------
	Blog Page Template Options
	--------------------------------------------------------------*/	

    $blog_template_options = array();
    $blog_template_options[] = array(
		'title' => esc_html__( 'Blog', 'gauge' ),
		'icon' => 'el-icon-folder',
		'fields' => array(
			        
			array(
				'id'       => 'blog_template_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => array( 'category', 'gp_videos', 'gp_hubs' ), 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the categories you want to display.', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'blog_template_post_association',
				'title' => esc_html__( 'Post Association', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),

			array( 
				'id' => 'blog_template_post_types',
				'title' => esc_html__( 'Post Types', 'gauge' ),
				'desc' => esc_html__( 'Select the post types you want to display.', 'gauge' ),
				'type' => 'select',
				'multi' => true,
				'data' => 'post_types',
				'default' => array( 'post' ),
			),
													
			array( 
				'id' => 'blog_template_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-large' 	 => esc_html__( 'Large', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-standard',
			),

			array(  
				'id' => 'blog_template_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'followers' => esc_html__( 'Most Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Top Site Rated', 'gauge' ),
					'user_rating' => esc_html__( 'Top User Rated', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),
			
			array(  
				'id' => 'blog_template_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'blog_template_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
								
			array(  
				'id' => 'blog_template_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'        => 'blog_template_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'blog_template_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'followers' => esc_html__( 'Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'cats' => 0,
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'followers' => '0',
					'site_rating' => '0',
					'user_rating' => '0',
					'hub_awards' => '0',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),

			array(
				'id'       => 'blog_template_filter_cats_id',
				'type'     => 'select',
				'required'  => array( 'blog_template_filter', '=', 'enabled' ),
				'title'    => esc_html__( 'Filter Category', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => array( 'category', 'gp_videos', 'gp_hubs' ), 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the category you want to filter by, leave blank to display all categories.', 'gauge' ),
				'subtitle' => esc_html__( 'The sub categories of this category will also be displayed.', 'gauge' ),
				'default' => '',
			),
                    										
			array(
				'id'       => 'blog_template_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
			
			array( 
				'id' => 'blog_template_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
												
			array( 
				'id' => 'blog_template_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'blog_template_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'blog_template_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '400',
			),

			array(
				'id'        => 'blog_template_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
                    'views' => esc_html__( 'Views', 'gauge' ),
                    'followers' => esc_html__( 'Followers', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
					'hub_cats' => esc_html__( 'Hub Categories', 'gauge' ),
					'hub_fields' => esc_html__( 'Hub Fields', 'gauge' ),
					'hub_award' => esc_html__( 'Hub Award', 'gauge' ),
				),
				'default'   => array(
					'author' => '1',
					'date' => '1', 
					'comment_count' => '1',
					'views' => '1',
					'followers' => '0',
					'cats' => '1',
					'tags' => '0',
					'hub_cats' => '1',
					'hub_fields' => '1',
					'hub_award' => '1',
				),
			),

			array(
				'id'        => 'blog_template_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Ratings', 'gauge' ),
				'desc' => esc_html__( 'Select the ratings you want to display.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
					'user_rating' => '1',
				)
			),
									
			array(  
				'id' => 'blog_template_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
								
		)
	);
	
    $blog_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-cogs',
		'fields' => array(
		
			array( 
				'id' => 'blog_template_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header on the page (option not used when it has a parent hub page).', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
			
			array( 
				'id' => 'blog_template_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						
			array( 
				'id' => 'blog_template_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'blog_template_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
										
			array(
				'id'        => 'blog_template_title_bg',
				'type'      => 'media',
				'mode'      => false,
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'title'     => esc_html__( 'Page Header Image Background', 'gauge' ),
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),
			
			array(
				'id' => 'blog_template_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'blog_template_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'required' => array( 'blog_template_title', '!=', 'gp-no-large-title' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'blog_template_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'blog_template_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Blog', 'gauge' ),
			),
							
			array( 
				'id' => 'blog_template_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'blog_template_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
		
		),			
	);		
	
    $blog_template_options[] = array(
		'title' => esc_html__( 'Image', 'gauge' ),
		'icon' => 'el-icon-picture',
		'fields' => array(	
			
			array(  
				'id' => 'blog_template_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the featured images..', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'blog_template_image',
				'type' => 'dimensions',
				'required'  => array( 'blog_template_featured_image', '!=', 'disabled' ),
				'units' => false,
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'default'           => array(
					'width'     => 810, 
					'height'    => 300,
				),
			),

			array(
				'id' => 'blog_template_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'blog_template_featured_image', '!=', 'disabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'blog_template_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'blog_template_featured_image', '!=', 'disabled' ),
				'desc' => esc_html__( 'Choose how the image aligns with the content.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),

		),		
	);
    $metaboxes[] = array(
        'id' => 'blog-template-options',
        'title' => esc_html__( 'Blog Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'blog-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $blog_template_options,
    );


	/*--------------------------------------------------------------
	Portfolio Page Template Options
	--------------------------------------------------------------*/	

    $portfolio_template_options = array();
    $portfolio_template_options[] = array(
		'title' => esc_html__( 'Portfolio', 'gauge' ),
		'icon' => 'el-icon-photo-alt',
		'fields' => array(	
			        
			array(
				'id'       => 'portfolio_template_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Portfolio Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_portfolios', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the portfolio categories you want to display.', 'gauge' ),
				'default' => '',
			),	
	
			array( 
				'id' => 'portfolio_template_format',
				'title' => esc_html__( 'Format', 'gauge' ),					
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'portfolio-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'portfolio-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'portfolio-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'portfolio-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'portfolio-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'portfolio-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),	
				'default' => 'portfolio-columns-2',
			),

			array(  
				'id' => 'portfolio_template_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),

			array(  
				'id' => 'portfolio_template_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'portfolio_template_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),			

			array(  
				'id' => 'portfolio_template_filter',
				'title' => esc_html__( 'Portfolio Filter', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add category filter links to the page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),					

			array( 
				'id' => 'portfolio_template_per_page',
				'title' => esc_html__( 'Items Per Page', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => 12,
			),
				
		)
	);
	
    $portfolio_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-cogs',
		'fields' => array(
				
			array( 
				'id' => 'portfolio_template_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header on the page (option not used when it has a parent hub page).', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
			
			array( 
				'id' => 'portfolio_template_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						
			array( 
				'id' => 'portfolio_template_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'portfolio_template_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
							
			array(
				'id' => 'portfolio_template_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'type'      => 'media',	
				'mode'      => false,		
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),

			array(
				'id' => 'portfolio_template_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'portfolio_template_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'required' => array( 'portfolio_template_title', '!=', 'gp-no-large-title' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'portfolio_template_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'portfolio_template_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Portfolio', 'gauge' ),
			),
											
			array( 
				'id' => 'portfolio_template_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'portfolio_template_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			 
		),	
	);
    $metaboxes[] = array(
        'id' => 'portfolio-template-options',
        'title' => esc_html__( 'Portfolio Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'portfolio-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $portfolio_template_options,
    );


	/*--------------------------------------------------------------
	FlexSlider Page Template Options
	--------------------------------------------------------------*/	

    $flexslider_template_options = array();
    $flexslider_template_options[] = array(
		'title' => esc_html__( 'Slider', 'gauge' ),
		'icon' => 'el-icon-stop',
		'fields' => array(
			        
			array(
				'id'       => 'flexslider_cats',
				'type'     => 'select',
				'title'    => esc_html__( 'Categories', 'gauge' ),
				'data' => 'terms',
				'multi' => true,
				'args' => array( 'taxonomies' => array( 'gp_slides', 'gp_hubs', 'gp_videos', 'category', 'gp_portfolios' ), 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the categories you want to display in the slider.', 'gauge' ),
				'default' => '',
			),

			array(
				'id'       => 'flexslider_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Slides', 'gauge' ),
				'subtitle' => esc_html__( 'Set to -1 to display all slides.', 'gauge' ),
				'desc' => esc_html__( 'The number of slides to display.', 'gauge' ),
				'min' => -1,
				'max' => 999999,
				'default' => 3,
			),		
									
			array(
				'id'       => 'flexslider_timeout',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Slider Timeout', 'gauge' ),
				'desc' => esc_html__( 'The number of seconds between each slide transition.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => 6,
			),

			array( 
				'id' => 'flexslider_bottom_gradient_overlay',
				'title' => esc_html__( 'Bottom Gradient Overlay', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a gradient overlay to the bottom of the slider images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array( 
				'id' => 'flexslider_side_gradient_overlay',
				'title' => esc_html__( 'Side Gradient Overlay', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a gradient overlay to the left and right sides of the slider images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
												
			array(
				'id' => 'flexslider_dimensions',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Slider Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the slider (the slider will take the width of the website so the width you set will only crop the images to that size and not change the slider\'s overall width.)', 'gauge' ),
				'default'           => array(
					'width'     => '1170', 
					'height'    => '450',
				),
			),
												
			array(
				'id' => 'flexslider_mobile_dimensions',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Mobile Slider Height', 'gauge' ),
				'desc' => esc_html__( 'The height of the slider on mobile devices.', 'gauge' ),
				'width' => false,
				'default'           => array( 
					'height'    => '200',
				),
			),

			array( 
				'id' => 'flexslider_ratings',
				'title' => esc_html__( 'Display Ratings', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose whether to display hub/review ratings.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
																	 
		),		
	);
    $flexslider_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(
								
			array( 
				'id' => 'flexslider_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'flexslider_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			
		),		
	);		
    $metaboxes[] = array(
        'id' => 'flexslider-template-options',
        'title' => esc_html__( 'FlexSlider Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'flexslider-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $flexslider_template_options,
    );


	/*--------------------------------------------------------------
	Featured Page Template Options
	--------------------------------------------------------------*/	

    $featured_template_options = array();
    $featured_template_options[] = array(
		'title' => esc_html__( 'Featured', 'gauge' ),
		'icon' => 'el-icon-stop',
		'fields' => array(
			        
			array(
				'id'       => 'featured_cats',
				'type'     => 'select',
				'title'    => esc_html__( 'Categories', 'gauge' ),
				'data' => 'terms',
				'multi' => true,
				'args' => array( 'taxonomies' => array( 'gp_slides', 'gp_hubs', 'gp_videos', 'category', 'gp_portfolios' ), 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the categories you want to display in the slider.', 'gauge' ),
				'default' => '',
			),	

			array( 
				'id' => 'featured_bottom_gradient_overlay',
				'title' => esc_html__( 'Bottom Gradient Overlay', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a gradient overlay to the bottom of the slider images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array( 
				'id' => 'featured_side_gradient_overlay',
				'title' => esc_html__( 'Side Gradient Overlay', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a gradient overlay to the left and right sides of the slider images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
							
			array(
				'id' => 'featured_dimensions',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Slider Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured area.', 'gauge' ),
				'default'           => array(
					'width'     => '882', 
					'height'    => '450',
				),
			),

			array( 
				'id' => 'featured_ratings',
				'title' => esc_html__( 'Display Ratings', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose whether to display hub/review ratings.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
																	 
		),		
	);
    $featured_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(
								
			array( 
				'id' => 'featured_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'featured_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			
		),		
	);		
    $metaboxes[] = array(
        'id' => 'featured-template-options',
        'title' => esc_html__( 'Featured Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'featured-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $featured_template_options,
    );


	/*--------------------------------------------------------------
	Hub Page Template Options
	--------------------------------------------------------------*/	

    $hub_template_options = array();
    $hub_template_options[] = array(
		'title' => esc_html__( 'Hub', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-globe',
		'fields' => array( 

			array(
				'id'       => 'hub_synopsis',
				'type'     => 'editor',
				'title'    => esc_html__( 'Hub Synopsis', 'gauge' ),
				'desc' => esc_html__( 'Add a synopsis for the hub.', 'gauge' ),
				'default' => '',
			),

			array(
				'id'       => 'hub_award',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Hub Award', 'gauge' ),
				'desc' => esc_html__( 'Choose to award this hub.', 'gauge' ),
				'default'   => '0',
			),

			array( 
				'id' => 'hub_award_title',
				'title' => esc_html__( 'Hub Award Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The title for the hub award.', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'hub_award_icon',
				'title' => esc_html__( 'Hub Award Icon', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The icon for the hub award.', 'gauge' ),
				'options' => array(
					'fa-glass' => esc_html__( 'glass', 'gauge' ),'fa-music' => esc_html__( 'music', 'gauge' ),'fa-search' => esc_html__( 'search', 'gauge' ),'fa-envelope-o' => esc_html__( 'envelope-o', 'gauge' ),'fa-heart' => esc_html__( 'heart', 'gauge' ),'fa-star' => esc_html__( 'star', 'gauge' ),'fa-star-o' => esc_html__( 'star-o', 'gauge' ),'fa-user' => esc_html__( 'user', 'gauge' ),'fa-film' => esc_html__( 'film', 'gauge' ),'fa-th-large' => esc_html__( 'th-large', 'gauge' ),'fa-th' => esc_html__( 'th', 'gauge' ),'fa-th-list' => esc_html__( 'th-list', 'gauge' ),'fa-check' => esc_html__( 'check', 'gauge' ),'fa-times' => esc_html__( 'times', 'gauge' ),'fa-search-plus' => esc_html__( 'search-plus', 'gauge' ),'fa-search-minus' => esc_html__( 'search-minus', 'gauge' ),'fa-power-off' => esc_html__( 'power-off', 'gauge' ),'fa-signal' => esc_html__( 'signal', 'gauge' ),'fa-cog' => esc_html__( 'cog', 'gauge' ),'fa-trash-o' => esc_html__( 'trash-o', 'gauge' ),'fa-home' => esc_html__( 'home', 'gauge' ),'fa-file-o' => esc_html__( 'file-o', 'gauge' ),'fa-clock-o' => esc_html__( 'clock-o', 'gauge' ),'fa-road' => esc_html__( 'road', 'gauge' ),'fa-download' => esc_html__( 'download', 'gauge' ),'fa-arrow-circle-o-down' => esc_html__( 'arrow-circle-o-down', 'gauge' ),'fa-arrow-circle-o-up' => esc_html__( 'arrow-circle-o-up', 'gauge' ),'fa-inbox' => esc_html__( 'inbox', 'gauge' ),'fa-play-circle-o' => esc_html__( 'play-circle-o', 'gauge' ),'fa-repeat' => esc_html__( 'repeat', 'gauge' ),'fa-refresh' => esc_html__( 'refresh', 'gauge' ),'fa-list-alt' => esc_html__( 'list-alt', 'gauge' ),'fa-lock' => esc_html__( 'lock', 'gauge' ),'fa-flag' => esc_html__( 'flag', 'gauge' ),'fa-headphones' => esc_html__( 'headphones', 'gauge' ),'fa-volume-off' => esc_html__( 'volume-off', 'gauge' ),'fa-volume-down' => esc_html__( 'volume-down', 'gauge' ),'fa-volume-up' => esc_html__( 'volume-up', 'gauge' ),'fa-qrcode' => esc_html__( 'qrcode', 'gauge' ),'fa-barcode' => esc_html__( 'barcode', 'gauge' ),'fa-tag' => esc_html__( 'tag', 'gauge' ),'fa-tags' => esc_html__( 'tags', 'gauge' ),'fa-book' => esc_html__( 'book', 'gauge' ),'fa-bookmark' => esc_html__( 'bookmark', 'gauge' ),'fa-print' => esc_html__( 'print', 'gauge' ),'fa-camera' => esc_html__( 'camera', 'gauge' ),'fa-font' => esc_html__( 'font', 'gauge' ),'fa-bold' => esc_html__( 'bold', 'gauge' ),'fa-italic' => esc_html__( 'italic', 'gauge' ),'fa-text-height' => esc_html__( 'text-height', 'gauge' ),'fa-text-width' => esc_html__( 'text-width', 'gauge' ),'fa-align-left' => esc_html__( 'align-left', 'gauge' ),'fa-align-center' => esc_html__( 'align-center', 'gauge' ),'fa-align-right' => esc_html__( 'align-right', 'gauge' ),'fa-align-justify' => esc_html__( 'align-justify', 'gauge' ),'fa-list' => esc_html__( 'list', 'gauge' ),'fa-outdent' => esc_html__( 'outdent', 'gauge' ),'fa-indent' => esc_html__( 'indent', 'gauge' ),'fa-video-camera' => esc_html__( 'video-camera', 'gauge' ),'fa-picture-o' => esc_html__( 'picture-o', 'gauge' ),'fa-pencil' => esc_html__( 'pencil', 'gauge' ),'fa-map-marker' => esc_html__( 'map-marker', 'gauge' ),'fa-adjust' => esc_html__( 'adjust', 'gauge' ),'fa-tint' => esc_html__( 'tint', 'gauge' ),'fa-pencil-square-o' => esc_html__( 'pencil-square-o', 'gauge' ),'fa-share-square-o' => esc_html__( 'share-square-o', 'gauge' ),'fa-check-square-o' => esc_html__( 'check-square-o', 'gauge' ),'fa-arrows' => esc_html__( 'arrows', 'gauge' ),'fa-step-backward' => esc_html__( 'step-backward', 'gauge' ),'fa-fast-backward' => esc_html__( 'fast-backward', 'gauge' ),'fa-backward' => esc_html__( 'backward', 'gauge' ),'fa-play' => esc_html__( 'play', 'gauge' ),'fa-pause' => esc_html__( 'pause', 'gauge' ),'fa-stop' => esc_html__( 'stop', 'gauge' ),'fa-forward' => esc_html__( 'forward', 'gauge' ),'fa-fast-forward' => esc_html__( 'fast-forward', 'gauge' ),'fa-step-forward' => esc_html__( 'step-forward', 'gauge' ),'fa-eject' => esc_html__( 'eject', 'gauge' ),'fa-chevron-left' => esc_html__( 'chevron-left', 'gauge' ),'fa-chevron-right' => esc_html__( 'chevron-right', 'gauge' ),'fa-plus-circle' => esc_html__( 'plus-circle', 'gauge' ),'fa-minus-circle' => esc_html__( 'minus-circle', 'gauge' ),'fa-times-circle' => esc_html__( 'times-circle', 'gauge' ),'fa-check-circle' => esc_html__( 'check-circle', 'gauge' ),'fa-question-circle' => esc_html__( 'question-circle', 'gauge' ),'fa-info-circle' => esc_html__( 'info-circle', 'gauge' ),'fa-crosshairs' => esc_html__( 'crosshairs', 'gauge' ),'fa-times-circle-o' => esc_html__( 'times-circle-o', 'gauge' ),'fa-check-circle-o' => esc_html__( 'check-circle-o', 'gauge' ),'fa-ban' => esc_html__( 'ban', 'gauge' ),'fa-arrow-left' => esc_html__( 'arrow-left', 'gauge' ),'fa-arrow-right' => esc_html__( 'arrow-right', 'gauge' ),'fa-arrow-up' => esc_html__( 'arrow-up', 'gauge' ),'fa-arrow-down' => esc_html__( 'arrow-down', 'gauge' ),'fa-share' => esc_html__( 'share', 'gauge' ),'fa-expand' => esc_html__( 'expand', 'gauge' ),'fa-compress' => esc_html__( 'compress', 'gauge' ),'fa-plus' => esc_html__( 'plus', 'gauge' ),'fa-minus' => esc_html__( 'minus', 'gauge' ),'fa-asterisk' => esc_html__( 'asterisk', 'gauge' ),'fa-exclamation-circle' => esc_html__( 'exclamation-circle', 'gauge' ),'fa-gift' => esc_html__( 'gift', 'gauge' ),'fa-leaf' => esc_html__( 'leaf', 'gauge' ),'fa-fire' => esc_html__( 'fire', 'gauge' ),'fa-eye' => esc_html__( 'eye', 'gauge' ),'fa-eye-slash' => esc_html__( 'eye-slash', 'gauge' ),'fa-exclamation-triangle' => esc_html__( 'exclamation-triangle', 'gauge' ),'fa-plane' => esc_html__( 'plane', 'gauge' ),'fa-calendar' => esc_html__( 'calendar', 'gauge' ),'fa-random' => esc_html__( 'random', 'gauge' ),'fa-comment' => esc_html__( 'comment', 'gauge' ),'fa-magnet' => esc_html__( 'magnet', 'gauge' ),'fa-chevron-up' => esc_html__( 'chevron-up', 'gauge' ),'fa-chevron-down' => esc_html__( 'chevron-down', 'gauge' ),'fa-retweet' => esc_html__( 'retweet', 'gauge' ),'fa-shopping-cart' => esc_html__( 'shopping-cart', 'gauge' ),'fa-folder' => esc_html__( 'folder', 'gauge' ),'fa-folder-open' => esc_html__( 'folder-open', 'gauge' ),'fa-arrows-v' => esc_html__( 'arrows-v', 'gauge' ),'fa-arrows-h' => esc_html__( 'arrows-h', 'gauge' ),'fa-bar-chart-o' => esc_html__( 'bar-chart-o', 'gauge' ),'fa-twitter-square' => esc_html__( 'twitter-square', 'gauge' ),'fa-facebook-square' => esc_html__( 'facebook-square', 'gauge' ),'fa-camera-retro' => esc_html__( 'camera-retro', 'gauge' ),'fa-key' => esc_html__( 'key', 'gauge' ),'fa-cogs' => esc_html__( 'cogs', 'gauge' ),'fa-comments' => esc_html__( 'Comment Count', 'gauge' ),'fa-thumbs-o-up' => esc_html__( 'thumbs-o-up', 'gauge' ),'fa-thumbs-o-down' => esc_html__( 'thumbs-o-down', 'gauge' ),'fa-star-half' => esc_html__( 'star-half', 'gauge' ),'fa-heart-o' => esc_html__( 'heart-o', 'gauge' ),'fa-sign-out' => esc_html__( 'sign-out', 'gauge' ),'fa-linkedin-square' => esc_html__( 'linkedin-square', 'gauge' ),'fa-thumb-tack' => esc_html__( 'thumb-tack', 'gauge' ),'fa-external-link' => esc_html__( 'external-link', 'gauge' ),'fa-sign-in' => esc_html__( 'sign-in', 'gauge' ),'fa-trophy' => esc_html__( 'trophy', 'gauge' ),'fa-github-square' => esc_html__( 'github-square', 'gauge' ),'fa-upload' => esc_html__( 'upload', 'gauge' ),'fa-lemon-o' => esc_html__( 'lemon-o', 'gauge' ),'fa-phone' => esc_html__( 'phone', 'gauge' ),'fa-square-o' => esc_html__( 'square-o', 'gauge' ),'fa-bookmark-o' => esc_html__( 'bookmark-o', 'gauge' ),'fa-phone-square' => esc_html__( 'phone-square', 'gauge' ),'fa-twitter' => esc_html__( 'twitter', 'gauge' ),'fa-facebook' => esc_html__( 'facebook', 'gauge' ),'fa-github' => esc_html__( 'github', 'gauge' ),'fa-unlock' => esc_html__( 'unlock', 'gauge' ),'fa-credit-card' => esc_html__( 'credit-card', 'gauge' ),'fa-rss' => esc_html__( 'rss', 'gauge' ),'fa-hdd-o' => esc_html__( 'hdd-o', 'gauge' ),'fa-bullhorn' => esc_html__( 'bullhorn', 'gauge' ),'fa-bell' => esc_html__( 'bell', 'gauge' ),'fa-certificate' => esc_html__( 'certificate', 'gauge' ),'fa-hand-o-right' => esc_html__( 'hand-o-right', 'gauge' ),'fa-hand-o-left' => esc_html__( 'hand-o-left', 'gauge' ),'fa-hand-o-up' => esc_html__( 'hand-o-up', 'gauge' ),'fa-hand-o-down' => esc_html__( 'hand-o-down', 'gauge' ),'fa-arrow-circle-left' => esc_html__( 'arrow-circle-left', 'gauge' ),'fa-arrow-circle-right' => esc_html__( 'arrow-circle-right', 'gauge' ),'fa-arrow-circle-up' => esc_html__( 'arrow-circle-up', 'gauge' ),'fa-arrow-circle-down' => esc_html__( 'arrow-circle-down', 'gauge' ),'fa-globe' => esc_html__( 'globe', 'gauge' ),'fa-wrench' => esc_html__( 'wrench', 'gauge' ),'fa-tasks' => esc_html__( 'tasks', 'gauge' ),'fa-filter' => esc_html__( 'filter', 'gauge' ),'fa-briefcase' => esc_html__( 'briefcase', 'gauge' ),'fa-arrows-alt' => esc_html__( 'arrows-alt', 'gauge' ),'fa-users' => esc_html__( 'users', 'gauge' ),'fa-link' => esc_html__( 'link', 'gauge' ),'fa-cloud' => esc_html__( 'cloud', 'gauge' ),'fa-flask' => esc_html__( 'flask', 'gauge' ),'fa-scissors' => esc_html__( 'scissors', 'gauge' ),'fa-files-o' => esc_html__( 'files-o', 'gauge' ),'fa-paperclip' => esc_html__( 'paperclip', 'gauge' ),'fa-floppy-o' => esc_html__( 'floppy-o', 'gauge' ),'fa-square' => esc_html__( 'square', 'gauge' ),'fa-bars' => esc_html__( 'bars', 'gauge' ),'fa-list-ul' => esc_html__( 'list-ul', 'gauge' ),'fa-list-ol' => esc_html__( 'list-ol', 'gauge' ),'fa-strikethrough' => esc_html__( 'strikethrough', 'gauge' ),'fa-underline' => esc_html__( 'underline', 'gauge' ),'fa-table' => esc_html__( 'table', 'gauge' ),'fa-magic' => esc_html__( 'magic', 'gauge' ),'fa-truck' => esc_html__( 'truck', 'gauge' ),'fa-pinterest' => esc_html__( 'pinterest', 'gauge' ),'fa-pinterest-square' => esc_html__( 'pinterest-square', 'gauge' ),'fa-google-plus-square' => esc_html__( 'google-plus-square', 'gauge' ),'fa-google-plus' => esc_html__( 'google-plus', 'gauge' ),'fa-money' => esc_html__( 'money', 'gauge' ),'fa-caret-down' => esc_html__( 'caret-down', 'gauge' ),'fa-caret-up' => esc_html__( 'caret-up', 'gauge' ),'fa-caret-left' => esc_html__( 'caret-left', 'gauge' ),'fa-caret-right' => esc_html__( 'caret-right', 'gauge' ),'fa-columns' => esc_html__( 'columns', 'gauge' ),'fa-sort' => esc_html__( 'sort', 'gauge' ),'fa-sort-asc' => esc_html__( 'sort-asc', 'gauge' ),'fa-sort-desc' => esc_html__( 'sort-desc', 'gauge' ),'fa-envelope' => esc_html__( 'envelope', 'gauge' ),'fa-linkedin' => esc_html__( 'linkedin', 'gauge' ),'fa-undo' => esc_html__( 'undo', 'gauge' ),'fa-gavel' => esc_html__( 'gavel', 'gauge' ),'fa-tachometer' => esc_html__( 'tachometer', 'gauge' ),'fa-comment-o' => esc_html__( 'comment-o', 'gauge' ),'fa-comments-o' => esc_html__( 'comments-o', 'gauge' ),'fa-bolt' => esc_html__( 'bolt', 'gauge' ),'fa-sitemap' => esc_html__( 'sitemap', 'gauge' ),'fa-umbrella' => esc_html__( 'umbrella', 'gauge' ),'fa-clipboard' => esc_html__( 'clipboard', 'gauge' ),'fa-lightbulb-o' => esc_html__( 'lightbulb-o', 'gauge' ),'fa-exchange' => esc_html__( 'exchange', 'gauge' ),'fa-cloud-download' => esc_html__( 'cloud-download', 'gauge' ),'fa-cloud-upload' => esc_html__( 'cloud-upload', 'gauge' ),'fa-user-md' => esc_html__( 'user-md', 'gauge' ),'fa-stethoscope' => esc_html__( 'stethoscope', 'gauge' ),'fa-suitcase' => esc_html__( 'suitcase', 'gauge' ),'fa-bell-o' => esc_html__( 'bell-o', 'gauge' ),'fa-coffee' => esc_html__( 'coffee', 'gauge' ),'fa-cutlery' => esc_html__( 'cutlery', 'gauge' ),'fa-file-text-o' => esc_html__( 'file-text-o', 'gauge' ),'fa-building-o' => esc_html__( 'building-o', 'gauge' ),'fa-hospital-o' => esc_html__( 'hospital-o', 'gauge' ),'fa-ambulance' => esc_html__( 'ambulance', 'gauge' ),'fa-medkit' => esc_html__( 'medkit', 'gauge' ),'fa-fighter-jet' => esc_html__( 'fighter-jet', 'gauge' ),'fa-beer' => esc_html__( 'beer', 'gauge' ),'fa-h-square' => esc_html__( 'h-square', 'gauge' ),'fa-plus-square' => esc_html__( 'plus-square', 'gauge' ),'fa-angle-double-left' => esc_html__( 'angle-double-left', 'gauge' ),'fa-angle-double-right' => esc_html__( 'angle-double-right', 'gauge' ),'fa-angle-double-up' => esc_html__( 'angle-double-up', 'gauge' ),'fa-angle-double-down' => esc_html__( 'angle-double-down', 'gauge' ),'fa-angle-left' => esc_html__( 'angle-left', 'gauge' ),'fa-angle-right' => esc_html__( 'angle-right', 'gauge' ),'fa-angle-up' => esc_html__( 'angle-up', 'gauge' ),'fa-angle-down' => esc_html__( 'angle-down', 'gauge' ),'fa-desktop' => esc_html__( 'desktop', 'gauge' ),'fa-laptop' => esc_html__( 'laptop', 'gauge' ),'fa-tablet' => esc_html__( 'tablet', 'gauge' ),'fa-mobile' => esc_html__( 'mobile', 'gauge' ),'fa-circle-o' => esc_html__( 'circle-o', 'gauge' ),'fa-quote-left' => esc_html__( 'quote-left', 'gauge' ),'fa-quote-right' => esc_html__( 'quote-right', 'gauge' ),'fa-spinner' => esc_html__( 'spinner', 'gauge' ),'fa-circle' => esc_html__( 'circle', 'gauge' ),'fa-reply' => esc_html__( 'reply', 'gauge' ),'fa-github-alt' => esc_html__( 'github-alt', 'gauge' ),'fa-folder-o' => esc_html__( 'folder-o', 'gauge' ),'fa-folder-open-o' => esc_html__( 'folder-open-o', 'gauge' ),'fa-smile-o' => esc_html__( 'smile-o', 'gauge' ),'fa-frown-o' => esc_html__( 'frown-o', 'gauge' ),'fa-meh-o' => esc_html__( 'meh-o', 'gauge' ),'fa-gamepad' => esc_html__( 'gamepad', 'gauge' ),'fa-keyboard-o' => esc_html__( 'keyboard-o', 'gauge' ),'fa-flag-o' => esc_html__( 'flag-o', 'gauge' ),'fa-flag-checkered' => esc_html__( 'flag-checkered', 'gauge' ),'fa-terminal' => esc_html__( 'terminal', 'gauge' ),'fa-code' => esc_html__( 'code', 'gauge' ),'fa-reply-all' => esc_html__( 'reply-all', 'gauge' ),'fa-mail-reply-all' => esc_html__( 'mail-reply-all', 'gauge' ),'fa-star-half-o' => esc_html__( 'star-half-o', 'gauge' ),'fa-location-arrow' => esc_html__( 'location-arrow', 'gauge' ),'fa-crop' => esc_html__( 'crop', 'gauge' ),'fa-code-fork' => esc_html__( 'code-fork', 'gauge' ),'fa-chain-broken' => esc_html__( 'chain-broken', 'gauge' ),'fa-question' => esc_html__( 'question', 'gauge' ),'fa-info' => esc_html__( 'info', 'gauge' ),'fa-exclamation' => esc_html__( 'exclamation', 'gauge' ),'fa-superscript' => esc_html__( 'superscript', 'gauge' ),'fa-subscript' => esc_html__( 'subscript', 'gauge' ),'fa-eraser' => esc_html__( 'eraser', 'gauge' ),'fa-puzzle-piece' => esc_html__( 'puzzle-piece', 'gauge' ),'fa-microphone' => esc_html__( 'microphone', 'gauge' ),'fa-microphone-slash' => esc_html__( 'microphone-slash', 'gauge' ),'fa-shield' => esc_html__( 'shield', 'gauge' ),'fa-calendar-o' => esc_html__( 'calendar-o', 'gauge' ),'fa-fire-extinguisher' => esc_html__( 'fire-extinguisher', 'gauge' ),'fa-rocket' => esc_html__( 'rocket', 'gauge' ),'fa-maxcdn' => esc_html__( 'maxcdn', 'gauge' ),'fa-chevron-circle-left' => esc_html__( 'chevron-circle-left', 'gauge' ),'fa-chevron-circle-right' => esc_html__( 'chevron-circle-right', 'gauge' ),'fa-chevron-circle-up' => esc_html__( 'chevron-circle-up', 'gauge' ),'fa-chevron-circle-down' => esc_html__( 'chevron-circle-down', 'gauge' ),'fa-html5' => esc_html__( 'html5', 'gauge' ),'fa-css3' => esc_html__( 'css3', 'gauge' ),'fa-anchor' => esc_html__( 'anchor', 'gauge' ),'fa-unlock-alt' => esc_html__( 'unlock-alt', 'gauge' ),'fa-bullseye' => esc_html__( 'bullseye', 'gauge' ),'fa-ellipsis-h' => esc_html__( 'ellipsis-h', 'gauge' ),'fa-ellipsis-v' => esc_html__( 'ellipsis-v', 'gauge' ),'fa-rss-square' => esc_html__( 'rss-square', 'gauge' ),'fa-play-circle' => esc_html__( 'play-circle', 'gauge' ),'fa-ticket' => esc_html__( 'ticket', 'gauge' ),'fa-minus-square' => esc_html__( 'minus-square', 'gauge' ),'fa-minus-square-o' => esc_html__( 'minus-square-o', 'gauge' ),'fa-level-up' => esc_html__( 'level-up', 'gauge' ),'fa-level-down' => esc_html__( 'level-down', 'gauge' ),'fa-check-square' => esc_html__( 'check-square', 'gauge' ),'fa-pencil-square' => esc_html__( 'pencil-square', 'gauge' ),'fa-external-link-square' => esc_html__( 'external-link-square', 'gauge' ),'fa-share-square' => esc_html__( 'share-square', 'gauge' ),'fa-compass' => esc_html__( 'compass', 'gauge' ),'fa-caret-square-o-down' => esc_html__( 'caret-square-o-down', 'gauge' ),'fa-caret-square-o-up' => esc_html__( 'caret-square-o-up', 'gauge' ),'fa-caret-square-o-right' => esc_html__( 'caret-square-o-right', 'gauge' ),'fa-eur' => esc_html__( 'eur', 'gauge' ),'fa-gbp' => esc_html__( 'gbp', 'gauge' ),'fa-usd' => esc_html__( 'usd', 'gauge' ),'fa-inr' => esc_html__( 'inr', 'gauge' ),'fa-jpy' => esc_html__( 'jpy', 'gauge' ),'fa-rub' => esc_html__( 'rub', 'gauge' ),'fa-krw' => esc_html__( 'krw', 'gauge' ),'fa-btc' => esc_html__( 'btc', 'gauge' ),'fa-file' => esc_html__( 'file', 'gauge' ),'fa-file-text' => esc_html__( 'file-text', 'gauge' ),'fa-sort-alpha-asc' => esc_html__( 'sort-alpha-asc', 'gauge' ),'fa-sort-alpha-desc' => esc_html__( 'sort-alpha-desc', 'gauge' ),'fa-sort-amount-asc' => esc_html__( 'sort-amount-asc', 'gauge' ),'fa-sort-amount-desc' => esc_html__( 'sort-amount-desc', 'gauge' ),'fa-sort-numeric-asc' => esc_html__( 'sort-numeric-asc', 'gauge' ),'fa-sort-numeric-desc' => esc_html__( 'sort-numeric-desc', 'gauge' ),'fa-thumbs-up' => esc_html__( 'thumbs-up', 'gauge' ),'fa-thumbs-down' => esc_html__( 'thumbs-down', 'gauge' ),'fa-youtube-square' => esc_html__( 'youtube-square', 'gauge' ),'fa-youtube' => esc_html__( 'youtube', 'gauge' ),'fa-xing' => esc_html__( 'xing', 'gauge' ),'fa-xing-square' => esc_html__( 'xing-square', 'gauge' ),'fa-youtube-play' => esc_html__( 'youtube-play', 'gauge' ),'fa-dropbox' => esc_html__( 'dropbox', 'gauge' ),'fa-stack-overflow' => esc_html__( 'stack-overflow', 'gauge' ),'fa-instagram' => esc_html__( 'instagram', 'gauge' ),'fa-flickr' => esc_html__( 'flickr', 'gauge' ),'fa-adn' => esc_html__( 'adn', 'gauge' ),'fa-bitbucket' => esc_html__( 'bitbucket', 'gauge' ),'fa-bitbucket-square' => esc_html__( 'bitbucket-square', 'gauge' ),'fa-tumblr' => esc_html__( 'tumblr', 'gauge' ),'fa-tumblr-square' => esc_html__( 'tumblr-square', 'gauge' ),'fa-long-arrow-down' => esc_html__( 'long-arrow-down', 'gauge' ),'fa-long-arrow-up' => esc_html__( 'long-arrow-up', 'gauge' ),'fa-long-arrow-left' => esc_html__( 'long-arrow-left', 'gauge' ),'fa-long-arrow-right' => esc_html__( 'long-arrow-right', 'gauge' ),'fa-apple' => esc_html__( 'apple', 'gauge' ),'fa-windows' => esc_html__( 'windows', 'gauge' ),'fa-android' => esc_html__( 'android', 'gauge' ),'fa-linux' => esc_html__( 'linux', 'gauge' ),'fa-dribbble' => esc_html__( 'dribbble', 'gauge' ),'fa-skype' => esc_html__( 'skype', 'gauge' ),'fa-foursquare' => esc_html__( 'foursquare', 'gauge' ),'fa-trello' => esc_html__( 'trello', 'gauge' ),'fa-female' => esc_html__( 'female', 'gauge' ),'fa-male' => esc_html__( 'male', 'gauge' ),'fa-gittip' => esc_html__( 'gittip', 'gauge' ),'fa-sun-o' => esc_html__( 'sun-o', 'gauge' ),'fa-moon-o' => esc_html__( 'moon-o', 'gauge' ),'fa-archive' => esc_html__( 'archive', 'gauge' ),'fa-bug' => esc_html__( 'bug', 'gauge' ),'fa-vk' => esc_html__( 'vk', 'gauge' ),'fa-weibo' => esc_html__( 'weibo', 'gauge' ),'fa-renren' => esc_html__( 'renren', 'gauge' ),'fa-pagelines' => esc_html__( 'pagelines', 'gauge' ),'fa-stack-exchange' => esc_html__( 'stack-exchange', 'gauge' ),'fa-arrow-circle-o-right' => esc_html__( 'arrow-circle-o-right', 'gauge' ),'fa-arrow-circle-o-left' => esc_html__( 'arrow-circle-o-left', 'gauge' ),'fa-caret-square-o-left' => esc_html__( 'caret-square-o-left', 'gauge' ),'fa-dot-circle-o' => esc_html__( 'dot-circle-o', 'gauge' ),'fa-wheelchair' => esc_html__( 'wheelchair', 'gauge' ),'fa-vimeo-square' => esc_html__( 'vimeo-square', 'gauge' ),'fa-try' => esc_html__( 'try', 'gauge' ),'fa-plus-square-o' => esc_html__( 'plus-square-o', 'gauge' ),'fa-angellist' => esc_html__( 'angellist', 'gauge' ),'fa-area-chart' => esc_html__( 'area-chart', 'gauge' ),'fa-at' => esc_html__( 'at', 'gauge' ),'fa-bell-slash' => esc_html__( 'bell-slash', 'gauge' ),'fa-bell-slash-o' => esc_html__( 'bell-slash-o', 'gauge' ),'fa-bicycle' => esc_html__( 'bicycle', 'gauge' ),'fa-binoculars' => esc_html__( 'binoculars', 'gauge' ),'fa-birthday-cake' => esc_html__( 'birthday-cake', 'gauge' ),'fa-bus' => esc_html__( 'bus', 'gauge' ),'fa-calculator' => esc_html__( 'calculator', 'gauge' ),'fa-cc' => esc_html__( 'cc', 'gauge' ),'fa-cc-amex' => esc_html__( 'cc-amex', 'gauge' ),'fa-cc-discover' => esc_html__( 'cc-discover', 'gauge' ),'fa-cc-mastercard' => esc_html__( 'cc-mastercard', 'gauge' ),'fa-cc-paypal' => esc_html__( 'cc-paypal', 'gauge' ),'fa-cc-stripe' => esc_html__( 'cc-stripe', 'gauge' ),'fa-cc-visa' => esc_html__( 'cc-visa', 'gauge' ),'fa-copyright' => esc_html__( 'copyright', 'gauge' ),'fa-eyedropper' => esc_html__( 'eyedropper', 'gauge' ),'fa-futbol-o' => esc_html__( 'futbol-o', 'gauge' ),'fa-google-wallet' => esc_html__( 'google-wallet', 'gauge' ),'fa-ils' => esc_html__( 'ils', 'gauge' ),'fa-ioxhost' => esc_html__( 'ioxhost', 'gauge' ),'fa-lastfm' => esc_html__( 'lastfm', 'gauge' ),'fa-lastfm-square' => esc_html__( 'lastfm-square', 'gauge' ),'fa-line-chart' => esc_html__( 'line-chart', 'gauge' ),'fa-meanpath' => esc_html__( 'meanpath', 'gauge' ),'fa-newspaper-o' => esc_html__( 'newspaper-o', 'gauge' ),'fa-paint-brush' => esc_html__( 'paint-brush', 'gauge' ),'fa-paypal' => esc_html__( 'paypal', 'gauge' ),'fa-pie-chart' => esc_html__( 'pie-chart', 'gauge' ),'fa-plug' => esc_html__( 'plug', 'gauge' ),'fa-shekel' => esc_html__( 'shekel', 'gauge' ),'fa-sheqel' => esc_html__( 'sheqel', 'gauge' ),'fa-slideshare' => esc_html__( 'slideshare', 'gauge' ),'fa-soccer-ball-o' => esc_html__( 'soccer-ball-o', 'gauge' ),'fa-toggle-off' => esc_html__( 'toggle-off', 'gauge' ),'fa-toggle-on' => esc_html__( 'toggle-on', 'gauge' ),'fa-trash' => esc_html__( 'trash', 'gauge' ),'fa-tty' => esc_html__( 'tty', 'gauge' ),'fa-twitch' => esc_html__( 'twitch', 'gauge' ),'fa-wifi' => esc_html__( 'wifi', 'gauge' ),'fa-yelp' => esc_html__( 'yelp', 'gauge' )			
				),
				'default' => 'fa-trophy',
			),

			array( 
				'id' => 'hub_affiliate_button_link',
				'title' => esc_html__( 'Affiliate Button Link', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Add a button to your hub header', 'gauge' ),
				'validate' => 'url',
				'default' => '',
			),

			array( 
				'id' => 'hub_affiliate_button_text',
				'title' => esc_html__( 'Affiliate Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text used for your affiliate button in your hub header.', 'gauge' ),
				'default' => '',
			),
								
			array(
				'id' => 'hub_user_rating',
				'title' => esc_html__( 'User Rating Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the user rating box where users can vote.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
								
			array(
				'id'        => 'hub_reset_user_ratings',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Reset User Ratings & Votes', 'gauge' ),
				'desc' => esc_html__( 'Reset the user ratings and votes for this hub only.', 'gauge' ),
				'default'  => '0',
			),
												
		),
	);
			
    $hub_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(   
		  
			array( 
				'id' => 'hub_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'hub_title_header_format',
				'title' => esc_html__( 'Page Header Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format of the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'hub-header' => esc_html__( 'Hub Header', 'gauge' ),
					'review-header' => esc_html__( 'Review Header', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'hub_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array( 
				'id' => 'hub_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
															
			array(
				'id' => 'hub_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',	
				'mode'      => false,		
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),
			
			array(
				'id' => 'hub_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'hub_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'hub_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						
			array( 
				'id' => 'hub_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => '',
			),
																	
			array( 
				'id' => 'hub_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'hub_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
																													 
		),
	);
    $metaboxes[] = array(
        'id' => 'hub-template-options',
        'title' => esc_html__( 'Hub Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'hub-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $hub_template_options,
    );
    

	/*--------------------------------------------------------------
	Hub Review Page Template Options
	--------------------------------------------------------------*/	

    $hub_review_template_options = array();
    $hub_review_template_options[] = array(
		'title' => esc_html__( 'Hub Review', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-star',
		'fields' => array(  
			
			array( 
				'id' => 'hub_review_site_rating',
				'title' => esc_html__( 'Site Rating', 'gauge' ),
				'desc' => esc_html__( 'Add a rating for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple ratings click the "Add Site Rating" button.', 'gauge' ),
				'type' => 'multi_text',
				'validate' => 'numeric',
				'add_text' => esc_html__( 'Add Site Rating', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'hub_review_rating_criteria',
				'title' => esc_html__( 'Rating Criteria', 'gauge' ),
				'desc' => esc_html__( 'Add multiple rating criteria to your site rating.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple criteria click the "Add Rating Criteria" button. If you want to use your global rating criteria from the Theme Options page leave this empty.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Rating Criteria', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'hub_review_good_points',
				'title' => esc_html__( 'Good Points', 'gauge' ),
				'desc' => esc_html__( 'Add a good point for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple good points click the "Add Good Point" button.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Good Point', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'hub_review_bad_points',
				'title' => esc_html__( 'Bad Points', 'gauge' ),
				'desc' => esc_html__( 'Add a bad point for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple bad points click the "Add Bad Point" button.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Bad Point', 'gauge' ),
				'default' => '',
			),

			array(
				'id'       => 'hub_review_synopsis',
				'type'     => 'editor',
				'title'    => esc_html__( 'Hub Synopsis', 'gauge' ),
				'desc' => esc_html__( 'Add a synopsis for the hub.', 'gauge' ),
				'default' => '',
			),
			
			array(
				'id'       => 'hub_review_award',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Hub Award', 'gauge' ),
				'desc' => esc_html__( 'Choose to award this hub.', 'gauge' ),
				'default'   => '0',
			),

			array( 
				'id' => 'hub_review_award_title',
				'title' => esc_html__( 'Hub Award Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The title for the hub award.', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'hub_review_award_icon',
				'title' => esc_html__( 'Hub Award Icon', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The icon for the hub award.', 'gauge' ),
				'options' => array(
					'fa-glass' => esc_html__( 'glass', 'gauge' ),'fa-music' => esc_html__( 'music', 'gauge' ),'fa-search' => esc_html__( 'search', 'gauge' ),'fa-envelope-o' => esc_html__( 'envelope-o', 'gauge' ),'fa-heart' => esc_html__( 'heart', 'gauge' ),'fa-star' => esc_html__( 'star', 'gauge' ),'fa-star-o' => esc_html__( 'star-o', 'gauge' ),'fa-user' => esc_html__( 'user', 'gauge' ),'fa-film' => esc_html__( 'film', 'gauge' ),'fa-th-large' => esc_html__( 'th-large', 'gauge' ),'fa-th' => esc_html__( 'th', 'gauge' ),'fa-th-list' => esc_html__( 'th-list', 'gauge' ),'fa-check' => esc_html__( 'check', 'gauge' ),'fa-times' => esc_html__( 'times', 'gauge' ),'fa-search-plus' => esc_html__( 'search-plus', 'gauge' ),'fa-search-minus' => esc_html__( 'search-minus', 'gauge' ),'fa-power-off' => esc_html__( 'power-off', 'gauge' ),'fa-signal' => esc_html__( 'signal', 'gauge' ),'fa-cog' => esc_html__( 'cog', 'gauge' ),'fa-trash-o' => esc_html__( 'trash-o', 'gauge' ),'fa-home' => esc_html__( 'home', 'gauge' ),'fa-file-o' => esc_html__( 'file-o', 'gauge' ),'fa-clock-o' => esc_html__( 'clock-o', 'gauge' ),'fa-road' => esc_html__( 'road', 'gauge' ),'fa-download' => esc_html__( 'download', 'gauge' ),'fa-arrow-circle-o-down' => esc_html__( 'arrow-circle-o-down', 'gauge' ),'fa-arrow-circle-o-up' => esc_html__( 'arrow-circle-o-up', 'gauge' ),'fa-inbox' => esc_html__( 'inbox', 'gauge' ),'fa-play-circle-o' => esc_html__( 'play-circle-o', 'gauge' ),'fa-repeat' => esc_html__( 'repeat', 'gauge' ),'fa-refresh' => esc_html__( 'refresh', 'gauge' ),'fa-list-alt' => esc_html__( 'list-alt', 'gauge' ),'fa-lock' => esc_html__( 'lock', 'gauge' ),'fa-flag' => esc_html__( 'flag', 'gauge' ),'fa-headphones' => esc_html__( 'headphones', 'gauge' ),'fa-volume-off' => esc_html__( 'volume-off', 'gauge' ),'fa-volume-down' => esc_html__( 'volume-down', 'gauge' ),'fa-volume-up' => esc_html__( 'volume-up', 'gauge' ),'fa-qrcode' => esc_html__( 'qrcode', 'gauge' ),'fa-barcode' => esc_html__( 'barcode', 'gauge' ),'fa-tag' => esc_html__( 'tag', 'gauge' ),'fa-tags' => esc_html__( 'tags', 'gauge' ),'fa-book' => esc_html__( 'book', 'gauge' ),'fa-bookmark' => esc_html__( 'bookmark', 'gauge' ),'fa-print' => esc_html__( 'print', 'gauge' ),'fa-camera' => esc_html__( 'camera', 'gauge' ),'fa-font' => esc_html__( 'font', 'gauge' ),'fa-bold' => esc_html__( 'bold', 'gauge' ),'fa-italic' => esc_html__( 'italic', 'gauge' ),'fa-text-height' => esc_html__( 'text-height', 'gauge' ),'fa-text-width' => esc_html__( 'text-width', 'gauge' ),'fa-align-left' => esc_html__( 'align-left', 'gauge' ),'fa-align-center' => esc_html__( 'align-center', 'gauge' ),'fa-align-right' => esc_html__( 'align-right', 'gauge' ),'fa-align-justify' => esc_html__( 'align-justify', 'gauge' ),'fa-list' => esc_html__( 'list', 'gauge' ),'fa-outdent' => esc_html__( 'outdent', 'gauge' ),'fa-indent' => esc_html__( 'indent', 'gauge' ),'fa-video-camera' => esc_html__( 'video-camera', 'gauge' ),'fa-picture-o' => esc_html__( 'picture-o', 'gauge' ),'fa-pencil' => esc_html__( 'pencil', 'gauge' ),'fa-map-marker' => esc_html__( 'map-marker', 'gauge' ),'fa-adjust' => esc_html__( 'adjust', 'gauge' ),'fa-tint' => esc_html__( 'tint', 'gauge' ),'fa-pencil-square-o' => esc_html__( 'pencil-square-o', 'gauge' ),'fa-share-square-o' => esc_html__( 'share-square-o', 'gauge' ),'fa-check-square-o' => esc_html__( 'check-square-o', 'gauge' ),'fa-arrows' => esc_html__( 'arrows', 'gauge' ),'fa-step-backward' => esc_html__( 'step-backward', 'gauge' ),'fa-fast-backward' => esc_html__( 'fast-backward', 'gauge' ),'fa-backward' => esc_html__( 'backward', 'gauge' ),'fa-play' => esc_html__( 'play', 'gauge' ),'fa-pause' => esc_html__( 'pause', 'gauge' ),'fa-stop' => esc_html__( 'stop', 'gauge' ),'fa-forward' => esc_html__( 'forward', 'gauge' ),'fa-fast-forward' => esc_html__( 'fast-forward', 'gauge' ),'fa-step-forward' => esc_html__( 'step-forward', 'gauge' ),'fa-eject' => esc_html__( 'eject', 'gauge' ),'fa-chevron-left' => esc_html__( 'chevron-left', 'gauge' ),'fa-chevron-right' => esc_html__( 'chevron-right', 'gauge' ),'fa-plus-circle' => esc_html__( 'plus-circle', 'gauge' ),'fa-minus-circle' => esc_html__( 'minus-circle', 'gauge' ),'fa-times-circle' => esc_html__( 'times-circle', 'gauge' ),'fa-check-circle' => esc_html__( 'check-circle', 'gauge' ),'fa-question-circle' => esc_html__( 'question-circle', 'gauge' ),'fa-info-circle' => esc_html__( 'info-circle', 'gauge' ),'fa-crosshairs' => esc_html__( 'crosshairs', 'gauge' ),'fa-times-circle-o' => esc_html__( 'times-circle-o', 'gauge' ),'fa-check-circle-o' => esc_html__( 'check-circle-o', 'gauge' ),'fa-ban' => esc_html__( 'ban', 'gauge' ),'fa-arrow-left' => esc_html__( 'arrow-left', 'gauge' ),'fa-arrow-right' => esc_html__( 'arrow-right', 'gauge' ),'fa-arrow-up' => esc_html__( 'arrow-up', 'gauge' ),'fa-arrow-down' => esc_html__( 'arrow-down', 'gauge' ),'fa-share' => esc_html__( 'share', 'gauge' ),'fa-expand' => esc_html__( 'expand', 'gauge' ),'fa-compress' => esc_html__( 'compress', 'gauge' ),'fa-plus' => esc_html__( 'plus', 'gauge' ),'fa-minus' => esc_html__( 'minus', 'gauge' ),'fa-asterisk' => esc_html__( 'asterisk', 'gauge' ),'fa-exclamation-circle' => esc_html__( 'exclamation-circle', 'gauge' ),'fa-gift' => esc_html__( 'gift', 'gauge' ),'fa-leaf' => esc_html__( 'leaf', 'gauge' ),'fa-fire' => esc_html__( 'fire', 'gauge' ),'fa-eye' => esc_html__( 'eye', 'gauge' ),'fa-eye-slash' => esc_html__( 'eye-slash', 'gauge' ),'fa-exclamation-triangle' => esc_html__( 'exclamation-triangle', 'gauge' ),'fa-plane' => esc_html__( 'plane', 'gauge' ),'fa-calendar' => esc_html__( 'calendar', 'gauge' ),'fa-random' => esc_html__( 'random', 'gauge' ),'fa-comment' => esc_html__( 'comment', 'gauge' ),'fa-magnet' => esc_html__( 'magnet', 'gauge' ),'fa-chevron-up' => esc_html__( 'chevron-up', 'gauge' ),'fa-chevron-down' => esc_html__( 'chevron-down', 'gauge' ),'fa-retweet' => esc_html__( 'retweet', 'gauge' ),'fa-shopping-cart' => esc_html__( 'shopping-cart', 'gauge' ),'fa-folder' => esc_html__( 'folder', 'gauge' ),'fa-folder-open' => esc_html__( 'folder-open', 'gauge' ),'fa-arrows-v' => esc_html__( 'arrows-v', 'gauge' ),'fa-arrows-h' => esc_html__( 'arrows-h', 'gauge' ),'fa-bar-chart-o' => esc_html__( 'bar-chart-o', 'gauge' ),'fa-twitter-square' => esc_html__( 'twitter-square', 'gauge' ),'fa-facebook-square' => esc_html__( 'facebook-square', 'gauge' ),'fa-camera-retro' => esc_html__( 'camera-retro', 'gauge' ),'fa-key' => esc_html__( 'key', 'gauge' ),'fa-cogs' => esc_html__( 'cogs', 'gauge' ),'fa-comments' => esc_html__( 'Comment Count', 'gauge' ),'fa-thumbs-o-up' => esc_html__( 'thumbs-o-up', 'gauge' ),'fa-thumbs-o-down' => esc_html__( 'thumbs-o-down', 'gauge' ),'fa-star-half' => esc_html__( 'star-half', 'gauge' ),'fa-heart-o' => esc_html__( 'heart-o', 'gauge' ),'fa-sign-out' => esc_html__( 'sign-out', 'gauge' ),'fa-linkedin-square' => esc_html__( 'linkedin-square', 'gauge' ),'fa-thumb-tack' => esc_html__( 'thumb-tack', 'gauge' ),'fa-external-link' => esc_html__( 'external-link', 'gauge' ),'fa-sign-in' => esc_html__( 'sign-in', 'gauge' ),'fa-trophy' => esc_html__( 'trophy', 'gauge' ),'fa-github-square' => esc_html__( 'github-square', 'gauge' ),'fa-upload' => esc_html__( 'upload', 'gauge' ),'fa-lemon-o' => esc_html__( 'lemon-o', 'gauge' ),'fa-phone' => esc_html__( 'phone', 'gauge' ),'fa-square-o' => esc_html__( 'square-o', 'gauge' ),'fa-bookmark-o' => esc_html__( 'bookmark-o', 'gauge' ),'fa-phone-square' => esc_html__( 'phone-square', 'gauge' ),'fa-twitter' => esc_html__( 'twitter', 'gauge' ),'fa-facebook' => esc_html__( 'facebook', 'gauge' ),'fa-github' => esc_html__( 'github', 'gauge' ),'fa-unlock' => esc_html__( 'unlock', 'gauge' ),'fa-credit-card' => esc_html__( 'credit-card', 'gauge' ),'fa-rss' => esc_html__( 'rss', 'gauge' ),'fa-hdd-o' => esc_html__( 'hdd-o', 'gauge' ),'fa-bullhorn' => esc_html__( 'bullhorn', 'gauge' ),'fa-bell' => esc_html__( 'bell', 'gauge' ),'fa-certificate' => esc_html__( 'certificate', 'gauge' ),'fa-hand-o-right' => esc_html__( 'hand-o-right', 'gauge' ),'fa-hand-o-left' => esc_html__( 'hand-o-left', 'gauge' ),'fa-hand-o-up' => esc_html__( 'hand-o-up', 'gauge' ),'fa-hand-o-down' => esc_html__( 'hand-o-down', 'gauge' ),'fa-arrow-circle-left' => esc_html__( 'arrow-circle-left', 'gauge' ),'fa-arrow-circle-right' => esc_html__( 'arrow-circle-right', 'gauge' ),'fa-arrow-circle-up' => esc_html__( 'arrow-circle-up', 'gauge' ),'fa-arrow-circle-down' => esc_html__( 'arrow-circle-down', 'gauge' ),'fa-globe' => esc_html__( 'globe', 'gauge' ),'fa-wrench' => esc_html__( 'wrench', 'gauge' ),'fa-tasks' => esc_html__( 'tasks', 'gauge' ),'fa-filter' => esc_html__( 'filter', 'gauge' ),'fa-briefcase' => esc_html__( 'briefcase', 'gauge' ),'fa-arrows-alt' => esc_html__( 'arrows-alt', 'gauge' ),'fa-users' => esc_html__( 'users', 'gauge' ),'fa-link' => esc_html__( 'link', 'gauge' ),'fa-cloud' => esc_html__( 'cloud', 'gauge' ),'fa-flask' => esc_html__( 'flask', 'gauge' ),'fa-scissors' => esc_html__( 'scissors', 'gauge' ),'fa-files-o' => esc_html__( 'files-o', 'gauge' ),'fa-paperclip' => esc_html__( 'paperclip', 'gauge' ),'fa-floppy-o' => esc_html__( 'floppy-o', 'gauge' ),'fa-square' => esc_html__( 'square', 'gauge' ),'fa-bars' => esc_html__( 'bars', 'gauge' ),'fa-list-ul' => esc_html__( 'list-ul', 'gauge' ),'fa-list-ol' => esc_html__( 'list-ol', 'gauge' ),'fa-strikethrough' => esc_html__( 'strikethrough', 'gauge' ),'fa-underline' => esc_html__( 'underline', 'gauge' ),'fa-table' => esc_html__( 'table', 'gauge' ),'fa-magic' => esc_html__( 'magic', 'gauge' ),'fa-truck' => esc_html__( 'truck', 'gauge' ),'fa-pinterest' => esc_html__( 'pinterest', 'gauge' ),'fa-pinterest-square' => esc_html__( 'pinterest-square', 'gauge' ),'fa-google-plus-square' => esc_html__( 'google-plus-square', 'gauge' ),'fa-google-plus' => esc_html__( 'google-plus', 'gauge' ),'fa-money' => esc_html__( 'money', 'gauge' ),'fa-caret-down' => esc_html__( 'caret-down', 'gauge' ),'fa-caret-up' => esc_html__( 'caret-up', 'gauge' ),'fa-caret-left' => esc_html__( 'caret-left', 'gauge' ),'fa-caret-right' => esc_html__( 'caret-right', 'gauge' ),'fa-columns' => esc_html__( 'columns', 'gauge' ),'fa-sort' => esc_html__( 'sort', 'gauge' ),'fa-sort-asc' => esc_html__( 'sort-asc', 'gauge' ),'fa-sort-desc' => esc_html__( 'sort-desc', 'gauge' ),'fa-envelope' => esc_html__( 'envelope', 'gauge' ),'fa-linkedin' => esc_html__( 'linkedin', 'gauge' ),'fa-undo' => esc_html__( 'undo', 'gauge' ),'fa-gavel' => esc_html__( 'gavel', 'gauge' ),'fa-tachometer' => esc_html__( 'tachometer', 'gauge' ),'fa-comment-o' => esc_html__( 'comment-o', 'gauge' ),'fa-comments-o' => esc_html__( 'comments-o', 'gauge' ),'fa-bolt' => esc_html__( 'bolt', 'gauge' ),'fa-sitemap' => esc_html__( 'sitemap', 'gauge' ),'fa-umbrella' => esc_html__( 'umbrella', 'gauge' ),'fa-clipboard' => esc_html__( 'clipboard', 'gauge' ),'fa-lightbulb-o' => esc_html__( 'lightbulb-o', 'gauge' ),'fa-exchange' => esc_html__( 'exchange', 'gauge' ),'fa-cloud-download' => esc_html__( 'cloud-download', 'gauge' ),'fa-cloud-upload' => esc_html__( 'cloud-upload', 'gauge' ),'fa-user-md' => esc_html__( 'user-md', 'gauge' ),'fa-stethoscope' => esc_html__( 'stethoscope', 'gauge' ),'fa-suitcase' => esc_html__( 'suitcase', 'gauge' ),'fa-bell-o' => esc_html__( 'bell-o', 'gauge' ),'fa-coffee' => esc_html__( 'coffee', 'gauge' ),'fa-cutlery' => esc_html__( 'cutlery', 'gauge' ),'fa-file-text-o' => esc_html__( 'file-text-o', 'gauge' ),'fa-building-o' => esc_html__( 'building-o', 'gauge' ),'fa-hospital-o' => esc_html__( 'hospital-o', 'gauge' ),'fa-ambulance' => esc_html__( 'ambulance', 'gauge' ),'fa-medkit' => esc_html__( 'medkit', 'gauge' ),'fa-fighter-jet' => esc_html__( 'fighter-jet', 'gauge' ),'fa-beer' => esc_html__( 'beer', 'gauge' ),'fa-h-square' => esc_html__( 'h-square', 'gauge' ),'fa-plus-square' => esc_html__( 'plus-square', 'gauge' ),'fa-angle-double-left' => esc_html__( 'angle-double-left', 'gauge' ),'fa-angle-double-right' => esc_html__( 'angle-double-right', 'gauge' ),'fa-angle-double-up' => esc_html__( 'angle-double-up', 'gauge' ),'fa-angle-double-down' => esc_html__( 'angle-double-down', 'gauge' ),'fa-angle-left' => esc_html__( 'angle-left', 'gauge' ),'fa-angle-right' => esc_html__( 'angle-right', 'gauge' ),'fa-angle-up' => esc_html__( 'angle-up', 'gauge' ),'fa-angle-down' => esc_html__( 'angle-down', 'gauge' ),'fa-desktop' => esc_html__( 'desktop', 'gauge' ),'fa-laptop' => esc_html__( 'laptop', 'gauge' ),'fa-tablet' => esc_html__( 'tablet', 'gauge' ),'fa-mobile' => esc_html__( 'mobile', 'gauge' ),'fa-circle-o' => esc_html__( 'circle-o', 'gauge' ),'fa-quote-left' => esc_html__( 'quote-left', 'gauge' ),'fa-quote-right' => esc_html__( 'quote-right', 'gauge' ),'fa-spinner' => esc_html__( 'spinner', 'gauge' ),'fa-circle' => esc_html__( 'circle', 'gauge' ),'fa-reply' => esc_html__( 'reply', 'gauge' ),'fa-github-alt' => esc_html__( 'github-alt', 'gauge' ),'fa-folder-o' => esc_html__( 'folder-o', 'gauge' ),'fa-folder-open-o' => esc_html__( 'folder-open-o', 'gauge' ),'fa-smile-o' => esc_html__( 'smile-o', 'gauge' ),'fa-frown-o' => esc_html__( 'frown-o', 'gauge' ),'fa-meh-o' => esc_html__( 'meh-o', 'gauge' ),'fa-gamepad' => esc_html__( 'gamepad', 'gauge' ),'fa-keyboard-o' => esc_html__( 'keyboard-o', 'gauge' ),'fa-flag-o' => esc_html__( 'flag-o', 'gauge' ),'fa-flag-checkered' => esc_html__( 'flag-checkered', 'gauge' ),'fa-terminal' => esc_html__( 'terminal', 'gauge' ),'fa-code' => esc_html__( 'code', 'gauge' ),'fa-reply-all' => esc_html__( 'reply-all', 'gauge' ),'fa-mail-reply-all' => esc_html__( 'mail-reply-all', 'gauge' ),'fa-star-half-o' => esc_html__( 'star-half-o', 'gauge' ),'fa-location-arrow' => esc_html__( 'location-arrow', 'gauge' ),'fa-crop' => esc_html__( 'crop', 'gauge' ),'fa-code-fork' => esc_html__( 'code-fork', 'gauge' ),'fa-chain-broken' => esc_html__( 'chain-broken', 'gauge' ),'fa-question' => esc_html__( 'question', 'gauge' ),'fa-info' => esc_html__( 'info', 'gauge' ),'fa-exclamation' => esc_html__( 'exclamation', 'gauge' ),'fa-superscript' => esc_html__( 'superscript', 'gauge' ),'fa-subscript' => esc_html__( 'subscript', 'gauge' ),'fa-eraser' => esc_html__( 'eraser', 'gauge' ),'fa-puzzle-piece' => esc_html__( 'puzzle-piece', 'gauge' ),'fa-microphone' => esc_html__( 'microphone', 'gauge' ),'fa-microphone-slash' => esc_html__( 'microphone-slash', 'gauge' ),'fa-shield' => esc_html__( 'shield', 'gauge' ),'fa-calendar-o' => esc_html__( 'calendar-o', 'gauge' ),'fa-fire-extinguisher' => esc_html__( 'fire-extinguisher', 'gauge' ),'fa-rocket' => esc_html__( 'rocket', 'gauge' ),'fa-maxcdn' => esc_html__( 'maxcdn', 'gauge' ),'fa-chevron-circle-left' => esc_html__( 'chevron-circle-left', 'gauge' ),'fa-chevron-circle-right' => esc_html__( 'chevron-circle-right', 'gauge' ),'fa-chevron-circle-up' => esc_html__( 'chevron-circle-up', 'gauge' ),'fa-chevron-circle-down' => esc_html__( 'chevron-circle-down', 'gauge' ),'fa-html5' => esc_html__( 'html5', 'gauge' ),'fa-css3' => esc_html__( 'css3', 'gauge' ),'fa-anchor' => esc_html__( 'anchor', 'gauge' ),'fa-unlock-alt' => esc_html__( 'unlock-alt', 'gauge' ),'fa-bullseye' => esc_html__( 'bullseye', 'gauge' ),'fa-ellipsis-h' => esc_html__( 'ellipsis-h', 'gauge' ),'fa-ellipsis-v' => esc_html__( 'ellipsis-v', 'gauge' ),'fa-rss-square' => esc_html__( 'rss-square', 'gauge' ),'fa-play-circle' => esc_html__( 'play-circle', 'gauge' ),'fa-ticket' => esc_html__( 'ticket', 'gauge' ),'fa-minus-square' => esc_html__( 'minus-square', 'gauge' ),'fa-minus-square-o' => esc_html__( 'minus-square-o', 'gauge' ),'fa-level-up' => esc_html__( 'level-up', 'gauge' ),'fa-level-down' => esc_html__( 'level-down', 'gauge' ),'fa-check-square' => esc_html__( 'check-square', 'gauge' ),'fa-pencil-square' => esc_html__( 'pencil-square', 'gauge' ),'fa-external-link-square' => esc_html__( 'external-link-square', 'gauge' ),'fa-share-square' => esc_html__( 'share-square', 'gauge' ),'fa-compass' => esc_html__( 'compass', 'gauge' ),'fa-caret-square-o-down' => esc_html__( 'caret-square-o-down', 'gauge' ),'fa-caret-square-o-up' => esc_html__( 'caret-square-o-up', 'gauge' ),'fa-caret-square-o-right' => esc_html__( 'caret-square-o-right', 'gauge' ),'fa-eur' => esc_html__( 'eur', 'gauge' ),'fa-gbp' => esc_html__( 'gbp', 'gauge' ),'fa-usd' => esc_html__( 'usd', 'gauge' ),'fa-inr' => esc_html__( 'inr', 'gauge' ),'fa-jpy' => esc_html__( 'jpy', 'gauge' ),'fa-rub' => esc_html__( 'rub', 'gauge' ),'fa-krw' => esc_html__( 'krw', 'gauge' ),'fa-btc' => esc_html__( 'btc', 'gauge' ),'fa-file' => esc_html__( 'file', 'gauge' ),'fa-file-text' => esc_html__( 'file-text', 'gauge' ),'fa-sort-alpha-asc' => esc_html__( 'sort-alpha-asc', 'gauge' ),'fa-sort-alpha-desc' => esc_html__( 'sort-alpha-desc', 'gauge' ),'fa-sort-amount-asc' => esc_html__( 'sort-amount-asc', 'gauge' ),'fa-sort-amount-desc' => esc_html__( 'sort-amount-desc', 'gauge' ),'fa-sort-numeric-asc' => esc_html__( 'sort-numeric-asc', 'gauge' ),'fa-sort-numeric-desc' => esc_html__( 'sort-numeric-desc', 'gauge' ),'fa-thumbs-up' => esc_html__( 'thumbs-up', 'gauge' ),'fa-thumbs-down' => esc_html__( 'thumbs-down', 'gauge' ),'fa-youtube-square' => esc_html__( 'youtube-square', 'gauge' ),'fa-youtube' => esc_html__( 'youtube', 'gauge' ),'fa-xing' => esc_html__( 'xing', 'gauge' ),'fa-xing-square' => esc_html__( 'xing-square', 'gauge' ),'fa-youtube-play' => esc_html__( 'youtube-play', 'gauge' ),'fa-dropbox' => esc_html__( 'dropbox', 'gauge' ),'fa-stack-overflow' => esc_html__( 'stack-overflow', 'gauge' ),'fa-instagram' => esc_html__( 'instagram', 'gauge' ),'fa-flickr' => esc_html__( 'flickr', 'gauge' ),'fa-adn' => esc_html__( 'adn', 'gauge' ),'fa-bitbucket' => esc_html__( 'bitbucket', 'gauge' ),'fa-bitbucket-square' => esc_html__( 'bitbucket-square', 'gauge' ),'fa-tumblr' => esc_html__( 'tumblr', 'gauge' ),'fa-tumblr-square' => esc_html__( 'tumblr-square', 'gauge' ),'fa-long-arrow-down' => esc_html__( 'long-arrow-down', 'gauge' ),'fa-long-arrow-up' => esc_html__( 'long-arrow-up', 'gauge' ),'fa-long-arrow-left' => esc_html__( 'long-arrow-left', 'gauge' ),'fa-long-arrow-right' => esc_html__( 'long-arrow-right', 'gauge' ),'fa-apple' => esc_html__( 'apple', 'gauge' ),'fa-windows' => esc_html__( 'windows', 'gauge' ),'fa-android' => esc_html__( 'android', 'gauge' ),'fa-linux' => esc_html__( 'linux', 'gauge' ),'fa-dribbble' => esc_html__( 'dribbble', 'gauge' ),'fa-skype' => esc_html__( 'skype', 'gauge' ),'fa-foursquare' => esc_html__( 'foursquare', 'gauge' ),'fa-trello' => esc_html__( 'trello', 'gauge' ),'fa-female' => esc_html__( 'female', 'gauge' ),'fa-male' => esc_html__( 'male', 'gauge' ),'fa-gittip' => esc_html__( 'gittip', 'gauge' ),'fa-sun-o' => esc_html__( 'sun-o', 'gauge' ),'fa-moon-o' => esc_html__( 'moon-o', 'gauge' ),'fa-archive' => esc_html__( 'archive', 'gauge' ),'fa-bug' => esc_html__( 'bug', 'gauge' ),'fa-vk' => esc_html__( 'vk', 'gauge' ),'fa-weibo' => esc_html__( 'weibo', 'gauge' ),'fa-renren' => esc_html__( 'renren', 'gauge' ),'fa-pagelines' => esc_html__( 'pagelines', 'gauge' ),'fa-stack-exchange' => esc_html__( 'stack-exchange', 'gauge' ),'fa-arrow-circle-o-right' => esc_html__( 'arrow-circle-o-right', 'gauge' ),'fa-arrow-circle-o-left' => esc_html__( 'arrow-circle-o-left', 'gauge' ),'fa-caret-square-o-left' => esc_html__( 'caret-square-o-left', 'gauge' ),'fa-dot-circle-o' => esc_html__( 'dot-circle-o', 'gauge' ),'fa-wheelchair' => esc_html__( 'wheelchair', 'gauge' ),'fa-vimeo-square' => esc_html__( 'vimeo-square', 'gauge' ),'fa-try' => esc_html__( 'try', 'gauge' ),'fa-plus-square-o' => esc_html__( 'plus-square-o', 'gauge' ),'fa-angellist' => esc_html__( 'angellist', 'gauge' ),'fa-area-chart' => esc_html__( 'area-chart', 'gauge' ),'fa-at' => esc_html__( 'at', 'gauge' ),'fa-bell-slash' => esc_html__( 'bell-slash', 'gauge' ),'fa-bell-slash-o' => esc_html__( 'bell-slash-o', 'gauge' ),'fa-bicycle' => esc_html__( 'bicycle', 'gauge' ),'fa-binoculars' => esc_html__( 'binoculars', 'gauge' ),'fa-birthday-cake' => esc_html__( 'birthday-cake', 'gauge' ),'fa-bus' => esc_html__( 'bus', 'gauge' ),'fa-calculator' => esc_html__( 'calculator', 'gauge' ),'fa-cc' => esc_html__( 'cc', 'gauge' ),'fa-cc-amex' => esc_html__( 'cc-amex', 'gauge' ),'fa-cc-discover' => esc_html__( 'cc-discover', 'gauge' ),'fa-cc-mastercard' => esc_html__( 'cc-mastercard', 'gauge' ),'fa-cc-paypal' => esc_html__( 'cc-paypal', 'gauge' ),'fa-cc-stripe' => esc_html__( 'cc-stripe', 'gauge' ),'fa-cc-visa' => esc_html__( 'cc-visa', 'gauge' ),'fa-copyright' => esc_html__( 'copyright', 'gauge' ),'fa-eyedropper' => esc_html__( 'eyedropper', 'gauge' ),'fa-futbol-o' => esc_html__( 'futbol-o', 'gauge' ),'fa-google-wallet' => esc_html__( 'google-wallet', 'gauge' ),'fa-ils' => esc_html__( 'ils', 'gauge' ),'fa-ioxhost' => esc_html__( 'ioxhost', 'gauge' ),'fa-lastfm' => esc_html__( 'lastfm', 'gauge' ),'fa-lastfm-square' => esc_html__( 'lastfm-square', 'gauge' ),'fa-line-chart' => esc_html__( 'line-chart', 'gauge' ),'fa-meanpath' => esc_html__( 'meanpath', 'gauge' ),'fa-newspaper-o' => esc_html__( 'newspaper-o', 'gauge' ),'fa-paint-brush' => esc_html__( 'paint-brush', 'gauge' ),'fa-paypal' => esc_html__( 'paypal', 'gauge' ),'fa-pie-chart' => esc_html__( 'pie-chart', 'gauge' ),'fa-plug' => esc_html__( 'plug', 'gauge' ),'fa-shekel' => esc_html__( 'shekel', 'gauge' ),'fa-sheqel' => esc_html__( 'sheqel', 'gauge' ),'fa-slideshare' => esc_html__( 'slideshare', 'gauge' ),'fa-soccer-ball-o' => esc_html__( 'soccer-ball-o', 'gauge' ),'fa-toggle-off' => esc_html__( 'toggle-off', 'gauge' ),'fa-toggle-on' => esc_html__( 'toggle-on', 'gauge' ),'fa-trash' => esc_html__( 'trash', 'gauge' ),'fa-tty' => esc_html__( 'tty', 'gauge' ),'fa-twitch' => esc_html__( 'twitch', 'gauge' ),'fa-wifi' => esc_html__( 'wifi', 'gauge' ),'fa-yelp' => esc_html__( 'yelp', 'gauge' )				
				),
				'default' => 'fa-trophy',
			),

			array( 
				'id' => 'hub_review_affiliate_button_link',
				'title' => esc_html__( 'Affiliate Button Link', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Add a button to your hub header', 'gauge' ),
				'validate' => 'url',
				'default' => '',
			),
			
			array( 
				'id' => 'hub_review_affiliate_button_text',
				'title' => esc_html__( 'Affiliate Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text used for your affiliate button in your hub header.', 'gauge' ),
				'default' => '',
			),
							
			array(
				'id' => 'hub_review_user_rating',
				'title' => esc_html__( 'User Rating Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the user rating box where users can vote.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
			
			array(
				'id'        => 'hub_review_reset_user_ratings',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Reset User Ratings & Votes', 'gauge' ),
				'desc' => esc_html__( 'Reset the user ratings and votes for this hub only.', 'gauge' ),
				'default'  => '0',
			),
						
		),
	);
	
    $hub_review_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(  

			array( 
				'id' => 'hub_review_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'hub_review_title_header_format',
				'title' => esc_html__( 'Page Header Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format of the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'hub-header' => esc_html__( 'Hub Header', 'gauge' ),
					'review-header' => esc_html__( 'Review Header', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'hub_review_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						        
			array( 
				'id' => 'hub_review_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'hub_review_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
							
			array(
				'id' => 'hub_review_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',	
				'mode'      => false,
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),

			array(
				'id' => 'hub_review_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'hub_review_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'hub_review_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'hub_review_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => '',
			),
					
			array( 
				'id' => 'hub_review_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'hub_review_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
					
			array( 
				'id' => 'hub_review_sidebar_position',
				'title' => esc_html__( 'Sidebar Position', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The position of the sidebar.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'top' => esc_html__( 'Top of page', 'gauge' ),
					'bottom' => esc_html__( 'Bottom of page', 'gauge' ),
				),
				'default' => 'default',
			),

		),
	);
    $metaboxes[] = array(
        'id' => 'hub-review-template-options',
        'title' => esc_html__( 'Hub Review Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'hub-review-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $hub_review_template_options,
    );
    
    
	/*--------------------------------------------------------------
	Review Page Template Options
	--------------------------------------------------------------*/	

    $review_template_options = array();
    $review_template_options[] = array(
		'title' => esc_html__( 'Review', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-star',
		'fields' => array(  

			array( 
				'id' => 'review_site_rating',
				'title' => esc_html__( 'Site Rating', 'gauge' ),
				'desc' => esc_html__( 'Add a rating for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple ratings click the "Add Site Rating" button.', 'gauge' ),
				'type' => 'multi_text',
				'validate' => 'numeric',
				'add_text' => esc_html__( 'Add Site Rating', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'review_rating_criteria',
				'title' => esc_html__( 'Rating Criteria', 'gauge' ),
				'desc' => esc_html__( 'Add multiple rating criteria to your site rating.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple criteria click the "Add Rating Criteria" button. If you want to use your global rating criteria from the Theme Options page leave this empty.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Rating Criteria', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'review_good_points',
				'title' => esc_html__( 'Good Points', 'gauge' ),
				'desc' => esc_html__( 'Add a good point for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple good points click the "Add Good Point" button.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Good Point', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'review_bad_points',
				'title' => esc_html__( 'Bad Points', 'gauge' ),
				'desc' => esc_html__( 'Add a bad point for this review.', 'gauge' ),
				'subtitle' => esc_html__( 'To add multiple bad points click the "Add Bad Point" button.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Bad Point', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'review_affiliate_button_link',
				'title' => esc_html__( 'Affiliate Button Link', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Add a button to your review header', 'gauge' ),
				'validate' => 'url',
				'default' => '',
			),
			
			array( 
				'id' => 'review_affiliate_button_text',
				'title' => esc_html__( 'Affiliate Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text used for your affiliate button in your hub header.', 'gauge' ),
				'default' => '',
			),
			
			array(
				'id' => 'review_user_rating',
				'title' => esc_html__( 'User Rating Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the user rating box where users can vote.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
						
		),
	);
	
    $review_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(  

			array( 
				'id' => 'review_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'review_title_header_format',
				'title' => esc_html__( 'Page Header Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format of the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'hub-header' => esc_html__( 'Hub Header', 'gauge' ),
					'review-header' => esc_html__( 'Review Header', 'gauge' ),
				),
				'default' => 'default',
			),

			array( 
				'id' => 'review_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						        
			array( 
				'id' => 'review_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'review_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
							
			array(
				'id' => 'review_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',	
				'mode'      => false,
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),

			array(
				'id' => 'review_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'review_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'review_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'review_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Review', 'gauge' ),
			),
					
			array( 
				'id' => 'review_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'review_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),	
							
			array( 
				'id' => 'review_sidebar_position',
				'title' => esc_html__( 'Sidebar Position', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The position of the sidebar.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'top' => esc_html__( 'Top of page', 'gauge' ),
					'bottom' => esc_html__( 'Bottom of page', 'gauge' ),
				),
				'default' => 'default',
			),

		),
	);
    $metaboxes[] = array(
        'id' => 'review-template-options',
        'title' => esc_html__( 'Review Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'review-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $review_template_options,
    );
    
    
	/*--------------------------------------------------------------
	News Page Template Options
	--------------------------------------------------------------*/	

    $news_template_options = array();
    $news_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),		
		'icon' => 'el-icon-cogs',
        'fields' => array(	

			array(
				'id'       => 'news_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Post Categories', 'gauge' ),
				'data' => 'categories',
				'desc' => esc_html__( 'Select the post categories you want to display (leave empty to display all posts associated with the parent hub page).', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'news_post_association',
				'title' => esc_html__( 'Post Association', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'       => 'news_filter_cats_id',
				'type'     => 'select',
				'title'    => esc_html__( 'Filter Category', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => array( 'category' ), 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the category you want to filter by, leave blank to display all categories.', 'gauge' ),
				'subtitle' => esc_html__( 'The sub categories of this category will also be displayed.', 'gauge' ),
			),
						
			array( 
				'id' => 'news_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'news_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'News', 'gauge' ),
			),
						
			array( 
				'id' => 'news_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),
			        
			array(
				'id'      => 'news_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
										 
		),
	);	
    $metaboxes[] = array(
        'id' => 'news-template-options',
        'title' => esc_html__( 'News Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'news-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $news_template_options,
    );
    
    
 	/*--------------------------------------------------------------
	Images Page Template Options
	--------------------------------------------------------------*/	

    $images_template_options = array();
    $images_template_options[] = array(
		'title' => esc_html__( 'Image', 'gauge' ),		
		'icon' => 'el-icon-picture',
        'fields' => array(	      
			
			array(
				'id'        => 'images_gallery',
				'type'      => 'gallery',
				'title'     => esc_html__( 'Images', 'gauge' ),
				'subtitle'  => esc_html__( 'Select or upload images using the WordPress native uploader.', 'gauge' ),
				'desc'  => esc_html__( 'Uploaded images will automatically show up on the page.', 'gauge' ),
				'default' => '',
			),
			
		),
	);

    $images_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),		
		'icon' => 'el-icon-cogs',
        'fields' => array(	

			array( 
				'id' => 'images_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			        	
 			array( 
				'id' => 'images_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Images', 'gauge' ),
			),
						       							
			array( 
				'id' => 'images_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'images_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),					
																													 
		),	
	);	
    $metaboxes[] = array(
        'id' => 'images-template-options',
        'title' => esc_html__( 'Image Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array('images-template.php'),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $images_template_options,
    );
    
 
	/*--------------------------------------------------------------
	Videos Page Template Options
	--------------------------------------------------------------*/	

    $videos_template_options = array();		
    $videos_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-cogs',
        'fields' => array(
        
			array(
				'id'       => 'videos_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Video Categories', 'gauge' ),				
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_videos', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the video categories you want to display (leave empty to display all videos associated with the parent hub page).', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'videos_post_association',
				'title' => esc_html__( 'Post Association', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(
				'id'       => 'videos_filter_cats_id',
				'type'     => 'select',
				'title'    => esc_html__( 'Filter Category', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_videos', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the category you want to filter by, leave blank to display all categories.', 'gauge' ),
				'subtitle' => esc_html__( 'The sub categories of this category will also be displayed.', 'gauge' ),
			),
			
			array( 
				'id' => 'videos_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			        
			array( 
				'id' => 'videos_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Videos', 'gauge' ),
			),
								
			array( 
				'id' => 'videos_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'videos_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
									 
		),
	);	
    $metaboxes[] = array(
        'id' => 'videos-template-options',
        'title' => esc_html__( 'Video Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'videos-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $videos_template_options,
    );
    
    
	/*--------------------------------------------------------------
	Link Page Template Options
	--------------------------------------------------------------*/	

    $link_template_options = array();
    $link_template_options[] = array(
        'fields' => array(
        
			array( 
				'id' => 'link_template_link',
				'title' => esc_html__( 'Link', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The link which your page goes to.', 'gauge' ),
				'default' => '',
				'validate' => 'url',
			),

			array( 
				'id' => 'link_template_link_target',
				'title' => esc_html__( 'Link Target', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The target for the link.', 'gauge' ),
				'options' => array(
					'_blank' => esc_html__( 'New Window', 'gauge' ),
					'_self' => esc_html__( 'Same Window', 'gauge' ),
				),
				'default' => '_self',
			),

			array( 
				'id' => 'link_template_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						
			array( 
				'id' => 'link_template_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => '',
			),
															 
		),
	);	
    $metaboxes[] = array(
        'id' => 'link-template-options',
        'title' => esc_html__( 'Link Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'link-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $link_template_options,
    );


	/*--------------------------------------------------------------
	Write A Review Page Template Options
	--------------------------------------------------------------*/	

    $write_a_review_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),		
		'icon' => 'el-icon-cogs',
        'fields' => array(	

			array( 
				'id' => 'write_a_review_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
			
			array( 
				'id' => 'write_a_review_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'Write A Review', 'gauge' ),
			),
						
			array( 
				'id' => 'write_a_review_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),
			        
			array(
				'id'      => 'write_a_review_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
										 
		),
	);	
    $metaboxes[] = array(
        'id' => 'write-a-review-template-options',
        'title' => esc_html__( 'Write A Review Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'write-a-review-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $write_a_review_template_options,
    );
    

	/*--------------------------------------------------------------
	User Reviews Page Template Options
	--------------------------------------------------------------*/	

    $user_reviews_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),		
		'icon' => 'el-icon-cogs',
        'fields' => array(	

			array( 
				'id' => 'user_reviews_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
			
			array( 
				'id' => 'user_reviews_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => esc_html__( 'User Reviews', 'gauge' ),
			),
						
			array( 
				'id' => 'user_reviews_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),
			        
			array(
				'id'      => 'user_reviews_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
										 
		),
	);	
    $metaboxes[] = array(
        'id' => 'user-reviews-template-options',
        'title' => esc_html__( 'User Reviews Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'user-reviews-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $user_reviews_template_options,
    );
            

	/*--------------------------------------------------------------
	My Reviews Template Options
	--------------------------------------------------------------*/	

    $my_reviews_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),		
		'icon' => 'el-icon-cogs',
        'fields' => array(	

			array( 
				'id' => 'my_reviews_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'gp-standard-title' => esc_html__( 'Standard', 'gauge' ),
					'gp-large-title' => esc_html__( 'Large', 'gauge' ),
					'gp-fullwidth-title' => esc_html__( 'Fullwidth', 'gauge' ),
					'gp-full-page-title' => esc_html__( 'Full Page', 'gauge' ),
					'gp-no-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
			
			array( 
				'id' => 'my_reviews_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'required' => array( 'my_reviews_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						        
			array( 
				'id' => 'my_reviews_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'required' => array( 'my_reviews_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'my_reviews_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'required' => array( 'my_reviews_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
				
			array(
				'id' => 'my_reviews_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',		
				'mode'      => false,	
				'required' => array( array( 'my_reviews_title', '!=', 'gp-standard-title' ), array( 'my_reviews_title', '!=', 'gp-no-title' ) ),
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),	
					
			array(
				'id' => 'my_reviews_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),	
				'required' => array( array( 'my_reviews_title', '!=', 'gp-standard-title' ), array( 'my_reviews_title', '!=', 'gp-no-title' ) ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'my_reviews_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),	
				'required' => array( array( 'my_reviews_title', '!=', 'gp-standard-title' ), array( 'my_reviews_title', '!=', 'gp-no-title' ) ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'my_reviews_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),
			        
			array(
				'id'      => 'my_reviews_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
										 
		),
	);	
    $metaboxes[] = array(
        'id' => 'my-reviews-template-options',
        'title' => esc_html__( 'My Reviews Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'my-reviews-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $my_reviews_template_options,
    );
    
    
	/*--------------------------------------------------------------
	Following Page Template Options
	--------------------------------------------------------------*/	

    $following_template_options[] = array(
		'title' => esc_html__( 'Following', 'gauge' ),
		'icon' => 'el-icon-eye-open',
        'fields' => array(

			array( 
				'id' => 'following_hub_items_post_types',
				'title' => esc_html__( 'Following Post Types', 'gauge' ),
				'desc' => esc_html__( 'Choose what post types to display for the latest items for each hub.', 'gauge' ),
				'type' => 'select',
				'multi' => true,
				'data' => 'post_types',
				'default' => array( 'post', 'page', 'gp_user_review' ),
			),
			
			array( 
				'id' => 'following_hub_items_modified',
				'title' => esc_html__( 'Include Modified Items', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display modified items for the latest items for each hub.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'following_hub_items_per_page',
				'title' => esc_html__( 'Items Per Page', 'gauge' ),
				'type'     => 'spinner',
				'desc' => esc_html__( 'The number of items to display for the latest items for each hub.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 5,
			),

			array( 
				'id' => 'following_hub_items_days_ago',
				'title' => esc_html__( 'Number Of Days', 'gauge' ),
				'type'     => 'spinner',
				'desc' => esc_html__( 'The number of days before am item is no longer displayed for the latest items for each hub.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 31,
			),

		)
	);
	
    $following_template_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-cogs',
		'fields' => array(
							
			array( 
				'id' => 'following_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'gp-standard-title' => esc_html__( 'Standard', 'gauge' ),
					'gp-large-title' => esc_html__( 'Large', 'gauge' ),
					'gp-fullwidth-title' => esc_html__( 'Fullwidth', 'gauge' ),
					'gp-full-page-title' => esc_html__( 'Full Page', 'gauge' ),
					'gp-no-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
			
			array( 
				'id' => 'following_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'required' => array( 'following_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						        
			array( 
				'id' => 'following_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'required' => array( 'following_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'following_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'required' => array( 'following_title', '!=', 'gp-no-title' ),
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
				
			array(
				'id' => 'following_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',		
				'mode'      => false,	
				'required' => array( array( 'following_title', '!=', 'gp-standard-title' ), array( 'following_title', '!=', 'gp-no-title' ) ),
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),	
					
			array(
				'id' => 'following_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),	
				'required' => array( array( 'following_title', '!=', 'gp-standard-title' ), array( 'following_title', '!=', 'gp-no-title' ) ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'following_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),	
				'required' => array( array( 'following_title', '!=', 'gp-standard-title' ), array( 'following_title', '!=', 'gp-no-title' ) ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'following_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),
			        
			array(
				'id'      => 'following_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
										 
		),
	);	
    $metaboxes[] = array(
        'id' => 'following-template-options',
        'title' => esc_html__( 'Following Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'following-template.php' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $following_template_options,
    );
    
                  
	/*--------------------------------------------------------------
	Portfolio Item Options
	--------------------------------------------------------------*/	

    $portfolio_item_options = array();
    $portfolio_item_options[] = array(
		'title' => esc_html__( 'Portfolio', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-photo-alt',
        'fields' => array(

			array(
				'id'        => 'portfolio_item_type',
				'type'      => 'radio',
				'title'     => esc_html__( 'Image/Slider Type', 'gauge' ),
				'desc' => esc_html__( 'The type of image or slider on the page.', 'gauge' ),
				'options'   => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'left-image' => 'Left Featured Image',
					'fullwidth-image' => 'Fullwidth Featured Image',
					'left-slider' => 'Left Slider',
					'fullwidth-slider' => 'Fullwidth Slider',
					'none' => 'None',
				), 
				'default'   => 'default',
			),   

			array(
				'id'        => 'portfolio_item_gallery_slider',
				'type'      => 'gallery',
				'title'     => esc_html__( 'Gallery Slider', 'gauge' ),
				'subtitle'  => esc_html__( 'Create a new gallery slider by selecting an existing image or uploading new ones using the WordPress native uploader.', 'gauge' ),
				'desc'  => esc_html__( 'Add a gallery slider.', 'gauge' ),
			),
			
			array(
				'id' => 'portfolio_item_image',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Image/Slider Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image or slider.', 'gauge' ),
				'default'           => array(
					'width'     => '', 
					'height'    => '',
				),
			),
			
			array(
				'id' => 'portfolio_item_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'portfolio_item_image_size',
				'title' => esc_html__( 'Image Size', 'gauge' ),
				'subtitle' => esc_html__( 'Only for use with the Masonry portfolio type.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Size of the image when displayed on a masonry portfolio page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'regular' => esc_html__( 'Regular', 'gauge' ),
					'wide' => esc_html__( 'Wide', 'gauge' ),
					'tall' => esc_html__( 'Tall', 'gauge' ),
					'large' => esc_html__( 'Large', 'gauge' ),
				),
				'default' => 'default',
			),
		
			array( 	
				'id' => 'portfolio_item_link',
				'title' => esc_html__( 'Button Link', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The link for the button.', 'gauge' ),
				'validate' => 'url',
				'default' => '',
			), 
								
			array( 	
				'id' => 'portfolio_item_link_text',
				'title' => esc_html__( 'Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text for the button.', 'gauge' ),
				'default' => '',
			), 

			array( 
				'id' => 'portfolio_item_link_target',
				'title' => esc_html__( 'Button Link Target', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The target for the button link.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'_blank' => esc_html__( 'New Window', 'gauge' ),
					'_self' => esc_html__( 'Same Window', 'gauge' ),
				),
				'default' => 'default',
			),
			
		),
	);		
	
    $portfolio_item_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),	
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),	
		'icon' => 'el-icon-cogs',
        'fields' => array(
        
			array( 
				'id' => 'portfolio_item_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
			
			array( 
				'id' => 'portfolio_item_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						 
			array( 
				'id' => 'portfolio_item_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'portfolio_item_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
									
			array(
				'id' => 'portfolio_item_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',
				'mode'      => false,
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),

			array(
				'id' => 'portfolio_item_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'portfolio_item_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
											
			array( 
				'id' => 'portfolio_item_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'portfolio_item_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
					 
		),
	);
    $metaboxes[] = array(
        'id' => 'portfolio-item-options',
        'title' => esc_html__( 'Portfolio Item Options', 'gauge' ),
        'post_types' => array( 'gp_portfolio_item' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $portfolio_item_options,
    );
    
    
	/*--------------------------------------------------------------
	Product Options
	--------------------------------------------------------------*/	

    $product_options = array();
    $product_options[] = array(
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
        'fields' => array( 
		
			array( 
				'id' => 'product_layout',
				'title' => esc_html__( 'Product Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'product_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),	
					 
		),
	);
    $metaboxes[] = array(
        'id' => 'product-options',
        'title' => esc_html__( 'Product Options', 'gauge' ),
        'post_types' => array( 'product' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $product_options,
    );


	/*--------------------------------------------------------------
	bbPress Options
	--------------------------------------------------------------*/	

	$bbpress_options = array();
    $bbpress_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(

			array( 
				'id' => 'bbpress_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
				
			array(
				'id' => 'bbpress_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',		
				'mode'      => false,
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),

			array( 
				'id' => 'bbpress_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'bbpress_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),		

		),
	);
    $metaboxes[] = array(
        'id' => 'bbpress-options',
        'title' => esc_html__( 'bbPress Options', 'gauge' ),
        'post_types' => array( 'forum', 'topic' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $bbpress_options,
    );
    
    
	/*--------------------------------------------------------------
	Slide Options
	--------------------------------------------------------------*/	

    $slide_options = array();
    $slide_options[] = array(
        'fields' => array( 

			array(
				'id'       => 'slide_caption_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Caption Title', 'gauge' ),
				'desc' => esc_html__( 'The caption title for the slide.', 'gauge' ),
			),	
			
			array(
				'id'       => 'slide_caption_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Caption Text', 'gauge' ),
				'desc' => esc_html__( 'The caption text for the slide.', 'gauge' ),
			),	
					
			array(
				'id'       => 'slide_link',
				'type'     => 'text',
				'title'    => esc_html__( 'Link', 'gauge' ),
				'desc'     => esc_html__( 'The link which your post goes to.', 'gauge' ),
				'validate' => 'url',
			),
			
			array( 
				'id' => 'slide_link_target',
				'title' => esc_html__( 'Link Target', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The target for the link.', 'gauge' ),
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'gauge' ),
					'_blank' => esc_html__( 'New Window', 'gauge' ),
				),
				'default' => '_self',
			),			
					 
		),		
	);
    $metaboxes[] = array(
        'id' => 'slide-options',
        'title' => esc_html__( 'Slide Options', 'gauge' ),
        'post_types' => array( 'gp_slide' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $slide_options,
    );
    
 
 	/*--------------------------------------------------------------
	Page Options
	--------------------------------------------------------------*/	

	$page_options = array();
    $page_options[] = array(
		'title' => esc_html__( 'General', 'gauge' ),		
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(

			array( 
				'id' => 'page_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),
			
			array( 
				'id' => 'page_title_text',
				'title' => esc_html__( 'Page Header Text', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the page header text.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						        
			array( 
				'id' => 'page_custom_title',
				'title' => esc_html__( 'Custom Page Header', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'A custom page header that overwrites the default page header.', 'gauge' ),
				'default' => '',
			),
									
			array( 
				'id' => 'page_subtitle',
				'title' => esc_html__( 'Page Subtitle', 'gauge' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add a subtitle below the page header.', 'gauge' ),
				'default' => '',
			),
				
			array(
				'id' => 'page_title_bg', 
				'title' => esc_html__( 'Page Header Image Background', 'gauge' ),
				'type'      => 'media',		
				'mode'      => false,
				'desc' => esc_html__( 'The page header image background.', 'gauge' ),
				'default' => '',
			),	
					
			array(
				'id' => 'page_title_teaser_video_bg', 
				'title' => esc_html__( 'Page Header Teaser Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports HTML5 video only. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',
				'desc' => esc_html__( 'Video URL to the teaser video that is displayed in the page header.', 'gauge' ),
				'default' => '',
			),	

			array(
				'id' => 'page_title_full_video_bg', 
				'title' => esc_html__( 'Page Header Full Video Background', 'gauge' ),
				'subtitle' => esc_html__( 'Supports YouTube, Vimeo and HTML5 video. For multiple HTML5 formats, each video should have exactly the same filename but remove the extension (e.g. .mp4) from the filename in the text box.', 'gauge' ),
				'type'      => 'text',	
				'validate'  => 'url',	
				'desc' => esc_html__( 'Video URL to the full video that is displayed when the play button is clicked.', 'gauge' ),
				'default' => '',
			),
						
			array( 
				'id' => 'page_tab',
				'title' => esc_html__( 'Hub Tab', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Show this page in the hub tabs.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
						
			array( 
				'id' => 'page_tab_title',
				'title' => esc_html__( 'Hub Tab Title', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'Custom title used in hub tabs.', 'gauge' ),
				'default' => '',
			),
											
			array( 
				'id' => 'page_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array('title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'page_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
			
		),		
	);	

    $page_options[] = array(
		'title' => esc_html__( 'Image', 'gauge' ),
		'desc' => esc_html__( 'By default most of these options are set from the Theme Options page to change all pages at once, but you can overwrite these options here so this page has different settings.', 'gauge' ),
		'icon' => 'el-icon-picture',
		'fields' => array(
		
			array(  
				'id' => 'page_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Shows the featured image on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'page_image',
				'type' => 'dimensions',
				'units' => false,
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '', 
					'height'    => '',
				),
			),

			array(
				'id' => 'page_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'page_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'Choose how the image aligns with the content.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( esc_html__( 'Default', 'gauge' ), 'gauge' ),
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'default',
			),	
			
		),
	);	
    $metaboxes[] = array(
        'id' => 'page-options',
        'title' => esc_html__( 'Page Options', 'gauge' ),
        'post_types' => array( 'page' ),
        'page_template' => array( 'default' ),
        'position' => 'normal',
        'priority' => 'high',
        'sections' => $page_options,
    ); 
           
    // Kind of overkill, but ahh well.  ;)
    $metaboxes = apply_filters( 'ghostpool_redux_metabox_options', $metaboxes, $page_options, $post_options, $audio_format_options, $gallery_format_options, $link_format_options, $quote_format_options, $video_format_options, $blog_template_options, $portfolio_template_options, $flexslider_template_options, $featured_template_options, $hub_template_options, $hub_review_template_options, $review_template_options, $news_template_options, $images_template_options, $videos_template_options, $link_template_options, $write_a_review_template_options, $user_reviews_template_options, $my_reviews_template_options, $following_template_options, $portfolio_item_options, $product_options, $bbpress_options, $slide_options );

    return $metaboxes;
  }
  add_action( 'redux/metaboxes/' . $redux_opt_name . '/boxes', 'ghostpool_add_metaboxes' );
endif;

// The loader will load all of the extensions automatically based on your $redux_opt_name
require_once( dirname( __FILE__ ) . '/loader.php' );