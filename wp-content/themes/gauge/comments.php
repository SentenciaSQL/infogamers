<?php if ( post_password_required() ) {
	return;
}
	

/////////////////////////////////////// Comment Lists Template ///////////////////////////////////////

function ghostpool_comment_template( $comment, $args, $depth ) {
	
	$GLOBALS['ghostpool_comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
		
	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment">

		<div id="comment-<?php comment_ID(); ?>" class="comment_container">
			<p><?php esc_html_e( 'Pingback:', 'gauge' ); ?> <?php comment_author_link(); ?></p>
		</div>
	
	<?php break; default :
	
	// Login link
	if ( ghostpool_option( 'popup_box' ) == 'enabled' ) {
		$login_link = '#login';
	} else {
		$login_link = wp_login_url( apply_filters( 'the_permalink', get_permalink() ) );
	}
		
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment_container">

			<?php echo get_avatar( $comment, 60 ); ?>
		
			<div class="gp-comment-content">
			
				<?php if ( $comment->comment_approved == '0' ) { ?>
				
					<p class="gp-comment-meta"><em><?php esc_html_e( 'Your comment is awaiting approval.', 'gauge' ); ?></em></p>
				
				<?php } else { ?>
											
					<p class="gp-comment-meta">
				
						<strong itemprop="author">	
							<?php printf( esc_html__( '%s', 'gauge' ), comment_author_link() ); ?>
						</strong>
			
						<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">
							<?php comment_time( get_option( 'date_format' ) ); ?>, <?php comment_time( get_option( 'time_format' ) ); ?>
						</time>

					</p>				

				<?php } ?>
				
				<div itemprop="description" class="description"><?php comment_text(); ?></div>
				
				<?php if ( ! is_user_logged_in() && get_option( 'comment_registration' ) == 1 ) { ?>
					<a href="<?php echo $login_link; ?>" rel="nofollow" class="comment-reply-login"><?php esc_html_e( 'Log in to reply', 'gauge' ); ?></a>
				<?php } else { 
					comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'gauge' ), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
				} ?>

			</div>	

		</div>

<?php break; endswitch;

} ?>

<?php if ( comments_open() OR have_comments() ) { ?>
 
	<div id="comments">

		<?php if ( have_comments() ) { ?>

			<div class="gp-post-section-header">		
				<h3><?php comments_number( esc_html__( 'No Comments', 'gauge' ), esc_html__( '1 Comment', 'gauge' ), esc_html__( '% Comments', 'gauge' ) ); ?></h3>
				<span class="gp-post-section-header-line"></span>
			</div>
				
			<ol class="commentlist">
				<?php wp_list_comments( 'callback=ghostpool_comment_template' ); ?>
			</ol>
						
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<?php paginate_comments_links( array( 'type' => 'list', 'next_text' => '&raquo;', 'prev_text' => '&laquo;' ) ); ?>
			<?php } ?>	

			<?php if ( ! comments_open() && get_comments_number() ) { ?>
				<h4><?php esc_html_e( 'Comments are now closed for this post.', 'gauge' ); ?></h4>
			<?php } ?>
	
		<?php } ?>

		<?php
		
		// Login link
		if ( ghostpool_option( 'popup_box' ) == 'enabled' ) {
			$login_link = '#login';
		} else {
			$login_link = wp_login_url( apply_filters( 'the_permalink', get_permalink() ) );
		}
		
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$required_text = sprintf( '' . esc_html__('Required fields are marked %s', 'gauge' ), '<span class="required">*</span>');
		
		$comment_args = array(

			'title_reply'       => esc_html__( 'Leave a Reply', 'gauge' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'gauge' ),
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'gauge' ),
			'label_submit'      => esc_html__( 'Post Comment', 'gauge' ),

			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'gauge' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

			'must_log_in' => '<span class="gp-post-section-header-line"></span><p class="must-log-in">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'gauge' ), array( 'a' => array( 'href' => array() ) ) ), $login_link ) . '</p>',

			'logged_in_as' => '<span class="gp-post-section-header-line"></span><p class="logged-in-as">' .  sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'gauge' ), array( 'a' => array( 'href' => array() ) ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

			'comment_notes_before' => '<span class="gp-post-section-header-line"></span><p class="comment-notes">' . esc_html__( 'Your email address will not be published. ', 'gauge') . ( $req ? $required_text : '' ) . '</p>',

			'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( wp_kses( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'gauge' ), array( 'abbr' => array( 'title' => array() ) ) ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',

			'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'gauge' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',

				'email' => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'gauge' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',

				'url' => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'gauge' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'

			) ),
	
		);
			
		comment_form( $comment_args );

		?>

	</div>
	
<?php } ?>