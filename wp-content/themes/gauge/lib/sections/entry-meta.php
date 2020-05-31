<?php

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<?php if ( get_post_format() != 'quote' && ( ( isset( $GLOBALS['ghostpool_meta_author'] ) && $GLOBALS['ghostpool_meta_author'] == '1' ) OR ( isset( $GLOBALS['ghostpool_meta_date'] ) && $GLOBALS['ghostpool_meta_date'] == '1' ) OR ( isset( $GLOBALS['ghostpool_meta_comment_count'] ) && $GLOBALS['ghostpool_meta_comment_count'] == '1' ) OR ( isset( $GLOBALS['ghostpool_meta_views'] ) && $GLOBALS['ghostpool_meta_views'] == '1' ) OR ( isset( $GLOBALS['ghostpool_meta_followers'] ) && $GLOBALS['ghostpool_meta_followers'] == '1' ) OR ( isset( $GLOBALS['ghostpool_meta_cats'] ) && $GLOBALS['ghostpool_meta_cats'] == '1' ) ) ) { ?>

	<div class="gp-entry-meta">
	
		<?php if ( isset( $GLOBALS['ghostpool_meta_author'] ) && $GLOBALS['ghostpool_meta_author'] == '1' ) { ?><span class="gp-post-meta gp-meta-author"><?php ghostpool_author_name( get_the_ID() ); ?></span><?php } ?>

		<?php if ( isset( $GLOBALS['ghostpool_meta_date'] ) && $GLOBALS['ghostpool_meta_date'] == '1' ) { ?><time class="gp-post-meta gp-meta-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time><?php } ?>

		<?php if ( isset( $GLOBALS['ghostpool_meta_comment_count'] ) && $GLOBALS['ghostpool_meta_comment_count'] == '1' ) { ?><span class="gp-post-meta gp-meta-comments"><?php comments_popup_link( esc_html__( 'No Comments', 'gauge' ), esc_html__( '1 Comment', 'gauge' ), esc_html__( '% Comments', 'gauge' ), 'comments-link', esc_html__( 'Comments Closed', 'gauge' ) ); ?></span><?php } ?>
	
		<?php if ( function_exists( 'pvc_get_post_views' ) && ( isset( $GLOBALS['ghostpool_meta_views'] ) && $GLOBALS['ghostpool_meta_views'] == '1' ) ) { ?><span class="gp-post-meta gp-meta-views"><?php echo pvc_get_post_views(); ?> <?php esc_html_e( 'views', 'gauge' ); ?></span><?php } ?>

		<?php if ( isset( $GLOBALS['ghostpool_meta_followers'] ) && $GLOBALS['ghostpool_meta_followers'] == '1' ) { ?>
			<span class="gp-post-meta gp-meta-followers"><?php echo get_post_meta( $post_id, '_gp_followers', true ); ?> <?php esc_html_e( 'followers', 'gauge' ); ?></span>
		<?php } ?>
	
		<?php if ( isset( $GLOBALS['ghostpool_meta_cats'] ) && $GLOBALS['ghostpool_meta_cats'] == '1' && $post->post_type == 'post' ) { $video_cats = wp_get_object_terms( get_the_ID(), 'gp_videos' ); ?><span class="gp-post-meta gp-meta-cats"><?php if ( ! empty( $video_cats ) && ! is_wp_error( $video_cats ) ) { echo get_the_term_list( get_the_ID(), 'gp_videos', '', ', ' ); } else { the_category( ', ' ); } ?></span><?php } ?>
		
	</div>

<?php } ?>