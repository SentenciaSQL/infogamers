<?php if ( ! is_user_logged_in() ) { ?>

	<div id="login">

		<div id="gp-login-box">		
		
			<a href="#" id="gp-login-close" class="button"></a>
		
			<div class="gp-login-form-wrapper">

				<h3><?php esc_html_e( 'Sign In' ,'gauge' ); ?></h3>		

				<form name="loginform" class="gp-login-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
		
					<div class="gp-login-content">
	
						<div<?php if ( has_action ( 'oa_social_login' ) ) { ?> class="gp-standard-login"<?php } ?>>
					
							<?php if ( has_action ( 'oa_social_login' ) ) { ?><div class="gp-standard-login-header"><?php esc_html_e( 'Login via your site account', 'gauge' ); ?></div><?php } ?>
					
							<p class="username"><input type="text" name="log" class="user_login" value="<?php if ( ! empty( $user_login ) ) { echo esc_html( stripslashes( $user_login ), 1 ); } ?>" size="20" placeholder="<?php esc_html_e( 'Username or Email', 'gauge' ); ?>" required /></p>
			
							<p class="password"><input type="password" name="pwd" class="user_pass" size="20" placeholder="<?php esc_html_e( 'Password', 'gauge' ); ?>" required /></p>
		
							<p class="rememberme"><input name="rememberme" class="rememberme" type="checkbox" checked="checked" value="forever" /> <?php esc_html_e( 'Remember Me', 'gauge' ); ?></p>
					
							<?php if ( function_exists( 'ghostpool_custom_captcha_display' ) ) {
								echo ghostpool_custom_captcha_display();
							} elseif ( function_exists( 'gglcptch_display' ) ) { 
								echo gglcptch_display(); 
							} elseif ( has_filter( 'hctpc_verify' ) ) {
								echo apply_filters( 'hctpc_display', '' );
							} elseif ( has_filter( 'cptch_verify' ) ) {
								echo apply_filters( 'cptch_display', '' ); 
							} ?>
										
							<?php if ( has_action ( 'oa_social_login' ) ) { ?><p><a href="#" class="gp-social-login-link"><?php esc_html_e( 'Or login via a social network account', 'gauge' ); ?></a></p><?php } ?>
													
						</div>						
					
						<?php if ( has_action ( 'oa_social_login' ) ) { ?>
							<div class="gp-or-divider"><span><?php esc_html_e( 'OR', 'gauge' ); ?></span></div>
							<div class="gp-social-login">
								<?php do_action( 'oa_social_login' ); ?>
							</div>
						<?php } ?>	
					
						<span class="gp-login-results" data-verify="<?php esc_html_e( 'Verifying...', 'gauge' ); ?>"></span>
			
					</div>
			
					<input type="submit" name="wp-submit" class="wp-submit" value="<?php esc_html_e( 'Sign In', 'gauge' ); ?>" />

					<span class="gp-login-links">
						<?php if ( get_option( 'users_can_register' ) ) { ?><a href="<?php if ( function_exists( 'bp_is_active' ) ) { echo esc_url( bp_get_signup_page( false ) ); } else { echo '#register'; } ?>" class="gp-register-link"><?php esc_html_e( 'Register', 'gauge' ); ?></a><?php } ?>
						<a href="#" class="gp-lost-password-link"><?php esc_html_e( 'Lost Password', 'gauge' ); ?></a>
					</span>
		
					<input type="hidden" name="action" value="ghostpool_login" />
								
					<?php wp_nonce_field( 'ghostpool_login_action', 'ghostpool_login_nonce' ); ?>
			
				</form>
			
			</div>
			
					
			<div class="gp-lost-password-form-wrapper">

				<h3><?php esc_html_e( 'Lost Password', 'gauge' ); ?></h3>

				<form name="lostpasswordform" class="gp-lost-password-form" action="#" method="post">
			
					<div class="gp-login-content">
			
						<p><?php esc_html_e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'gauge' ); ?></p>	
					
						<p><input type="text" name="user_login" class="user_login" value="" size="20" placeholder="<?php esc_html_e( 'Username or Email', 'gauge' ); ?>" required /></p>
				
						<span class="gp-login-results" data-verify="<?php esc_html_e( 'Verifying...', 'gauge' ); ?>"></span>
				
					</div>
		
					<input type="submit" name="wp-submit" class="wp-submit" value="<?php esc_html_e( 'Reset Password', 'gauge' ); ?>" />
								
					<span class="gp-login-links">
						<?php if ( get_option( 'users_can_register' ) ) { ?><a href="<?php if ( function_exists( 'bp_is_active' ) ) { echo esc_url( bp_get_signup_page( false ) ); } else { echo '#register'; } ?>" class="gp-register-link"><?php esc_html_e( 'Register', 'gauge' ); ?></a><?php } ?>
						<a href="#" class="gp-login-link"><?php esc_html_e( 'Sign In', 'gauge' ); ?></a>
					</span>
		
					<input type="hidden" name="action" value="ghostpool_lost_password" />
						
					<?php wp_nonce_field( 'ghostpool_lost_password_action', 'ghostpool_lost_password_nonce' ); ?>
							
				</form>

			</div>

			<?php if ( has_action ( 'oa_social_login' ) ) { ?>
		
				<div class="gp-social-login-form-wrapper">

					<h3><?php esc_html_e( 'Sign In', 'gauge' ); ?></h3>

					<form class="gp-social-login-form" action="#" method="post">	
			
						<div class="gp-login-content">
							<?php do_action( 'oa_social_login' ); ?>
						</div>
							
						<span class="gp-login-links">
							<?php if ( get_option( 'users_can_register' ) ) { ?><a href="<?php if ( function_exists( 'bp_is_active' ) ) { echo esc_url( bp_get_signup_page( false ) ); } else { echo '#register'; } ?>" class="gp-register-link"><?php esc_html_e( 'Register', 'gauge' ); ?></a><?php } ?>
							<a href="#" class="gp-lost-password-link"><?php esc_html_e( 'Lost Password', 'gauge' ); ?></a>
						</span>
						
					</form>

				</div>
			
			<?php } ?>
			
						
			<?php if ( get_option( 'users_can_register' ) && ! function_exists( 'bp_is_active' ) ) { ?>
			
				<div class="gp-register-form-wrapper">

					<h3><?php esc_html_e( 'Sign Up' ,'gauge' ); ?></h3>		

					<form name="registerform" class="gp-register-form" action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post">
			
						<div class="gp-login-content">
  
							<p class="user_login"><input type="text" name="user_login" class="user_login" value="<?php if ( ! empty( $user_login ) ) { echo esc_html( stripslashes( $user_login ), 1 ); } ?>" size="20" placeholder="<?php esc_html_e( 'Username', 'gauge' ); ?>" required /></p>
			
							<p class="user_email"><input type="email" name="user_email" class="user_email" size="25" placeholder="<?php esc_html_e( 'Email', 'gauge' ); ?>" required /></p>
							
							<p class="user_confirm_pass"><span class="gp-password-icon"></span><input type="password" name="user_confirm_pass" class="user_confirm_pass" size="25" placeholder="<?php esc_attr_e( 'Password', 'gauge' ); ?>" /></p>
							
							<p class="user_pass"><span class="gp-password-icon"></span><input type="password" name="user_pass" class="user_pass" size="25" placeholder="<?php esc_attr_e( 'Confirm Password', 'gauge' ); ?>" /></p>

							<?php if ( function_exists( 'ghostpool_custom_captcha_display' ) ) {
								echo ghostpool_custom_captcha_display();
							} elseif ( function_exists( 'gglcptch_display' ) ) { 
								echo gglcptch_display(); 
							} elseif ( has_filter( 'hctpc_verify' ) ) {
								echo apply_filters( 'hctpc_display', '' );
							} elseif ( has_filter( 'cptch_verify' ) ) {
								echo apply_filters( 'cptch_display', '' ); 
							} ?>
							
							<span class="gp-login-results" data-verify="<?php esc_html_e( 'Verifying...', 'gauge' ); ?>"></span>
				
						</div>
									
						<input type="submit" name="wp-submit" class="wp-submit" value="<?php esc_html_e( 'Sign Up', 'gauge' ); ?>" />

						<?php if ( ghostpool_option( 'registration_gdpr' ) == 'enabled' ) { ?>
							<p class="gp-gdpr"><input name="gdpr" class="gdpr" type="checkbox" value="1" required /> <label><?php echo wp_kses_post( ghostpool_option( 'registration_gdpr_text' ) ); ?></label></p>
						<?php } ?>
					
						<span class="gp-login-links">
							<a href="#" class="gp-login-link"><?php esc_html_e( 'Sign In', 'gauge' ); ?></a>
						</span>
					
						<input type="hidden" name="action" value="ghostpool_register" />
							
						<?php wp_nonce_field( 'ghostpool_register_action', 'ghostpool_register_nonce' ); ?>
				
					</form>
				
				</div>
			
			<?php } ?>
								
		</div>
				
	</div>
	
<?php } ?>