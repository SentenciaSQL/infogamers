<?php if ( ghostpool_option( 'rss_button' ) == 'enabled' OR ghostpool_option( 'rss' ) != '' OR ghostpool_option( 'twitter' ) != '' OR ghostpool_option( 'facebook' ) != '' OR ghostpool_option( 'youtube' ) != '' OR ghostpool_option( 'googleplus' ) != '' OR ghostpool_option( 'linkedin' ) != '' OR ghostpool_option( 'flickr' ) != '' OR ghostpool_option( 'pinterest' ) != '' OR ghostpool_option( 'additional_social_icons' ) != '' ) { ?>

	<div class="gp-social-icons">
	
		<?php if ( ghostpool_option( 'rss_button' ) == 'enabled' ) { ?><a href="<?php if ( ghostpool_option( 'rss' ) != '' ) { echo esc_url( ghostpool_option( 'rss' ) ); } else { bloginfo( 'rss2_url' ); } ?>" title="<?php esc_html_e( 'RSS Feed', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-rss"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'twitter' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'twitter' ) ); ?>" title="<?php esc_html_e( 'Twitter', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'facebook' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'facebook' ) ); ?>" title="<?php esc_html_e( 'Facebook', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'youtube' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'youtube' ) ); ?>" title="<?php esc_html_e( 'YouTube', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'linkedin' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'linkedin' ) ); ?>" title="<?php esc_html_e( 'LinkedIn', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-linkedin"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'googleplus' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'googleplus' ) ); ?>" title="<?php esc_html_e( 'Google+', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
					
		<?php if ( ghostpool_option( 'flickr' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'flickr' ) ); ?>" title="<?php esc_html_e( 'Flickr', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-flickr"></i></a><?php } ?>

		<?php if ( ghostpool_option( 'pinterest' ) != '' ) { ?><a href="<?php echo esc_url( ghostpool_option( 'pinterest' ) ); ?>" title="<?php esc_html_e( 'Pinterest', 'gauge' ); ?>" rel="me" target="_blank"><i class="fa fa-pinterest"></i></a><?php } ?>
			
		<?php if ( ghostpool_option( 'additional_social_icons' ) != '' ) { echo do_shortcode( ghostpool_option( 'additional_social_icons' ) ); } ?>

	</div>

<?php } ?>