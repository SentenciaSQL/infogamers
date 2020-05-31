<?php

if ( ! function_exists( 'ghostpool_recent_comments' ) ) {
	function ghostpool_recent_comments() {
		register_widget( 'Ghostpool_Recent_Comments' );
	}
}
add_action( 'widgets_init', 'ghostpool_recent_comments' );

if ( ! class_exists( 'Ghostpool_Recent_Comments' ) ) {
	class Ghostpool_Recent_Comments extends WP_Widget {

		function __construct() {
			$gp_widget_ops = array( 'classname' => 'gp-recent-comments', 'description' => esc_html__( 'Your site\'s most recent comments with avatars.', 'gauge' ) );
			parent::__construct( 'gp-recent-comments-widget', esc_html__( 'GP Recent Comments', 'gauge' ), $gp_widget_ops );
		}

		function widget( $gp_args, $gp_instance ) {
	
			extract( $gp_args );
			$gp_title = apply_filters( 'widget_title', empty( $gp_instance['title'] ) ? esc_html__( 'Recent Comments', 'gauge' ) : $gp_instance['title'] );
			$gp_comment_number = empty( $gp_instance['comment_number'] ) ? '5' : $gp_instance['comment_number'];
		
			global $comment;
	
			echo html_entity_decode( $before_widget );
			
			?>

			<?php if ( $gp_title ) { echo html_entity_decode( $before_title . $gp_title . $after_title ); } ?>

			<?php 
		
			$gp_args = array( 
				'number' => $gp_comment_number,
				'status' => 'approve',
				'post_status' => 'publish',
				'post_type' => apply_filters( 'ghostpool_recent_comments_widget_post_type', '' ),
			 );

			$gp_comments = get_comments( $gp_args );

			if ( $gp_comments ) { ?>
	
				<ul>

					<?php foreach ( $gp_comments as $comment ) {
											
						if ( function_exists( 'mb_substr' ) ) { 
							$gp_comment_excerpt = mb_substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, 40 );
						} else {
							$gp_comment_excerpt = substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, 40 );
						}
									
					?>
	 
						<li>
		
							<?php echo get_avatar( $comment->comment_author_email, 32 ); ?> 

							<span>
						
								<strong><?php echo sanitize_user( $comment->comment_author ); ?> <?php esc_html_e( 'said', 'gauge' ); ?></strong> <?php echo strip_tags( $gp_comment_excerpt ); ?>...<span>
							
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ); ?> <?php esc_html_e( 'ago', 'gauge' ); ?></a></span>
							
							</span>
			
						</li>					

					<?php } ?>
		
				</ul>
		
			<?php } else { ?>

				<strong><?php esc_html_e( 'There are no comments to display.', 'gauge' ); ?></strong>

			<?php } ?>	
		
			<?php echo html_entity_decode( $after_widget );

		}

		function update( $gp_new_instance, $gp_old_instance ) {
			$gp_instance = $gp_old_instance;
			$gp_instance['title'] = strip_tags( $gp_new_instance['title'] );
			$gp_instance['comment_number'] = $gp_new_instance['comment_number'];
			return $gp_instance;
		}

		function form( $gp_instance ) {
	
			$gp_defaults = array( 
				'title'          => 'Recent Comments',
				'comment_number' => '5',
			 ); $gp_instance = wp_parse_args( ( array ) $gp_instance, $gp_defaults ); ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gauge' ); ?></label>
				<br/><input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $gp_instance['title'] ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'comment_number' ) ); ?>"><?php esc_html_e( 'Number of comments to show:', 'gauge' ); ?></label>
				<input  type="text" id="<?php echo esc_attr( $this->get_field_id( 'comment_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_number' ) ); ?>" value="<?php echo esc_attr( $gp_instance['comment_number'] ); ?>" size="3" />
			</p>
		
			<input type="hidden" name="widget-options" id="widget-options" value="1" />

			<?php

		}
	}

}

?>