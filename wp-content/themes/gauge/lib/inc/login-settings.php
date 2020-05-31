<?php 

global $wpdb;

/**
 * Redirect wp-login.php to login form
 *
 */
if ( ! function_exists( 'ghostpool_login_redirect' ) ) {
	function ghostpool_login_redirect() {
		global $pagenow;
		if ( 'wp-login.php' == $pagenow ) {	
			if ( isset( $_GET['action'] ) && $_GET['action'] == 'register' ) {
				wp_redirect( esc_url( home_url( '#register/' ) ) ); // Open registration modal window
			} elseif ( isset( $_GET['action'] ) && $_GET['action'] == 'lostpassword' ) {
				wp_redirect( esc_url( home_url( '#lost-password/' ) ) ); // Open lost password modal window
			} elseif ( isset( $_GET['action'] ) && $_GET['action'] == 'bpnoaccess' ) {
 				wp_redirect( esc_url( home_url( '#login/' ) ) ); // If there are specific actions open login modal window
			} elseif ( ! isset( $_POST['wp-submit'] ) && ! isset( $_GET['checkemail'] ) && ! isset( $_GET['action'] ) && ! isset( $_GET['reauth'] ) && ! isset( $_GET['interim-login'] ) ) {
				wp_redirect( esc_url( home_url( '#login/' ) ) ); // If there are no actions open login modal window
			} else {
				return;
			}
			exit;
		}
	}
}
add_action( 'init', 'ghostpool_login_redirect' );

/**
 * Set user ID to 0 for logged out users do to WooCommerce conflict
 *
 */
if ( ! function_exists( 'ghostpool_wc_nonce_fix' ) ) {
	function ghostpool_wc_nonce_fix( $uid = 0, $action = '' ) {
		if ( $action == 'ghostpool_login_action' OR $action == 'ghostpool_register_action' OR $action == 'ghostpool_lost_password_action' ) {
			return 0;
		} else {	
			return $uid;
		}
	}
}
add_filter( 'nonce_user_logged_out', 'ghostpool_wc_nonce_fix', 100, 2 );

/**
 * Send login data
 *
 */
if ( ! function_exists( 'ghostpool_login' ) ) {
	function ghostpool_login() {
	
		global $wpdb;
		
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'ghostpool_login' ) {

			if ( ! wp_verify_nonce( $_REQUEST['ghostpool_login_nonce'], 'ghostpool_login_action' ) ) {
				exit;
			}
	
			// Clean up username and password
			$username = esc_sql( $_REQUEST['log'] );
			$password = $_REQUEST['pwd'];
			if ( isset( $_REQUEST['rememberme'] ) ) {
				$remember = true; 
			} else {
				$remember = false;
			}

			// Get captcha data
			$captcha = ghostpool_captcha();

			// Validate fields
			if ( $captcha && $captcha['reason'] != '' ) {
		
				http_response_code( 422 );
				$user_verify = '';
				echo "<span class='gp-error'>" . esc_html__( 'Incorrect captcha.', 'gauge' ) . "</span>";
				exit;
				
			} else {	
				
				// Get user data from username
				$user_data = get_user_by( 'login', $username );

				// If username does not exist, look for email login instead
				if ( empty( $user_data ) ) { 
					$user_data = get_user_by( 'email', $username ); 
				}
		
				// Attempt login
				$login_data = array();
				$login_data['user_login'] = $username;
				$login_data['user_password'] = $password;
				$login_data['remember'] = $remember;
				if ( ! empty( $user_data ) ) { 
					if ( function_exists( 'bp_is_active' ) && BP_Signup::check_user_status( $user_data->ID ) ) {
						$login_data['user_login'] = '';
						$login_data['user_password'] = '';
					}
				}
				
				$user_verify = wp_signon( $login_data, false ); 
				
			}
		
			// Error checking	
			if ( is_wp_error( $user_verify ) ) {	
				$error = $user_verify->get_error_codes();
				if ( in_array( 'gglcptch_error', $error ) ) {	
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'Incorrect captcha.', 'gauge' ) . "</span>";
				} elseif ( in_array( 'invalid_username', $error ) ) {		
					http_response_code( 422 );
					echo '<span class="gp-error">' . esc_html__( 'Invalid username.', 'gauge' ) . '</span>';	
				} elseif ( in_array( 'invalid_email', $error ) ) {		
					http_response_code( 422 );	
					echo '<span class="gp-error">' . esc_html__( 'Invalid email.', 'gauge' ) . '</span>';			
				} elseif ( in_array( 'incorrect_password', $error ) ) {
					http_response_code( 422 );
					echo '<span class="gp-error">' . esc_html__( 'Invalid password.', 'gauge' ) . '</span>';	
				}
				exit;
				
			} else {
				
				//wp_set_current_user( $user_verify->ID, $username ); 
				//do_action( 'set_current_user' );
				
				echo '<script data-cfasync="false" type="text/javascript">';
					if ( has_filter( 'ghostpool_login_redirect' ) ) {		
						echo apply_filters( 'ghostpool_login_redirect', '', $user_data );
					} else {	
						echo 'window.location.reload();';
					}
				echo '</script>';	
				
				exit;	
					
			}

		}

	}
}
add_action( 'template_redirect', 'ghostpool_login' );

/**
 * Send registration data
 *
 */
if ( ! function_exists( 'ghostpool_registration' ) ) {
	function ghostpool_registration() {

		if ( isset( $_POST['action'] ) && $_POST['action'] == 'ghostpool_register' ) {

			if ( ! wp_verify_nonce( $_REQUEST['ghostpool_register_nonce'], 'ghostpool_register_action' ) ) {
				exit;
			}

			// Get captcha data
			$captcha = ghostpool_captcha();
	
			// Validate fields
			if ( $captcha && $captcha['reason'] != '' ) {
				http_response_code( 422 );
				$user_register = '';
				echo "<span class='gp-error'>" . esc_html__( 'Incorrect captcha.', 'gauge' ) . "</span>";
				exit;
			} elseif ( $_POST['user_pass'] !== $_POST['user_confirm_pass'] ) {
				http_response_code( 422 );
				$user_register = '';
				echo "<span class='gp-error'>" . esc_html__( 'Your passwords do not match.', 'gauge' ) . "</span>";
				exit;				
			} else {	
	
				// Attempt registration
				$info = array();
				$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user( $_POST['user_login'] );
				$info['user_pass'] = sanitize_text_field( $_POST['user_pass'] );
				$info['user_email'] = sanitize_email( $_POST['user_email'] );
				$user_register = wp_insert_user( $info );
		
			}

			// Error checking
			if ( is_wp_error( $user_register ) ) {	
				$error = $user_register->get_error_codes();
				if ( in_array( 'gglcptch_error', $error ) ) {	
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'Incorrect captcha.', 'gauge' ) . "</span>";
				} elseif ( in_array( 'empty_user_login', $error ) ) {
					http_response_code( 422 );
					echo "<span class='gp-error'>" . $user_register->get_error_message( 'empty_user_login' ) . "</span>";	
					exit;
				} elseif ( in_array( 'existing_user_login', $error ) ) {
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'This username is already registered.', 'gauge' ) . "</span>";	
					exit;
				} elseif ( in_array( 'existing_user_email', $error ) ) {
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'This email address is already registered.', 'gauge' ) . "</span>";	
					exit; 
				}
			} else {
				wp_new_user_notification( $user_register, null, 'both' );
				echo "<span class='gp-success'>" . esc_html__( 'An email has been sent with your details.', 'gauge' ) . "</span>";	
				exit; 
			}

		}
		
	}
}
add_action( 'template_redirect', 'ghostpool_registration' );
		
/**
 * Send lost password data
 *
 */
if ( ! function_exists( 'ghostpool_lost_password' ) ) {
	function ghostpool_lost_password() { 
	
		global $wpdb;

		if ( isset( $_POST['action'] ) && $_POST['action'] == 'ghostpool_lost_password' ) {

			if ( ! wp_verify_nonce( $_REQUEST['ghostpool_lost_password_nonce'], 'ghostpool_lost_password_action' ) ) {
				exit;
			}

			// Determine whether URL uses ? or &	
			function ghostpool_validate_url() {
				global $post;
				$page_url = esc_url( home_url() );
				$urlget = strpos( $page_url, '?' );
				if ( $urlget === false ) {
					$concate = "?";
				} else {
					$concate = "&";
				}
				return $page_url . $concate;
			}

			$user_input = esc_sql( trim( $_POST['user_login'] ) );

			if ( strpos( $user_input, '@' ) ) {
				$user_data = get_user_by( 'email', $user_input );
				if ( empty( $user_data ) ) {
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'Invalid email address.', 'gauge' ) . "</span>";
					exit;
				}
			} else {
				$user_data = get_user_by( 'login', $user_input );
				if ( empty( $user_data ) ) {
					http_response_code( 422 );
					echo "<span class='gp-error'>" . esc_html__( 'Invalid username.', 'gauge' )."</span>";
					exit;
				}
			}

			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;

			// Generate reset key
			$key = $wpdb->get_var( $wpdb->prepare( "SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login ) );
			if ( empty( $key ) ) {
				$key = wp_generate_password( 20, false );
				$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user_login ) );	
			}

			// Send reset pasword email to the user
			$message = esc_html__( 'Someone requested that the password be reset for the following account:', 'gauge' ) . "\r\n\r\n";
			$message .= get_option( 'siteurl' ) . "\r\n\r\n";
			$message .= sprintf( esc_html__( 'Username: %s', 'gauge' ), $user_login ) . "\r\n\r\n";
			$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.', 'gauge' ) . "\r\n\r\n";
			$message .= esc_html__( 'To reset your password, visit the following address:', 'gauge' ) . "\r\n\r\n";
			$message .= ghostpool_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode( $user_login ) . "\r\n\r\n";
			$message .= esc_html__( 'You will receive another email with your new password.', 'gauge' ) . "\r\n"; 
			$message = apply_filters( 'gp_retrieve_password_message', $message, $key, $user_login, $user_data );
		
			// Email sent or not sent notice	
			if ( $message && ! ghostpool_wp_mail( $user_email, esc_html__( 'Password reset request', 'gauge' ), $message ) ) {
				echo "<span class='gp-error'>" . esc_html__( 'Email failed to send for some unknown reason.', 'gauge' ) . "</span>";
				exit;
			} else {
				echo "<span class='gp-success'>" . esc_html__( 'We have just sent you an email with instructions to reset your password.', 'gauge' ) . "</span>";
				exit;
			}

		}

		/**
		 * Redirect to success page when password has been changed 
		 *
		 */
		if ( isset( $_GET['key'] ) && isset( $_GET['action'] ) && $_GET['action'] == 'reset_pwd' ) {

			$reset_key = $_GET['key'];
			$user_login = $_GET['login'];
			$user_data = $wpdb->get_row( $wpdb->prepare( "SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login ) );

			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;

			if ( ! empty( $reset_key ) && ! empty( $user_data ) ) {
	
				$new_password = wp_generate_password( 12, true );
				wp_set_password( $new_password, $user_data->ID );
				$message = esc_html__( 'Your new password for the account at:', 'gauge' ) . "\r\n\r\n";
				$message .= get_option( 'siteurl' ) . "\r\n\r\n";
				$message .= sprintf( esc_html__( 'Username: %s', 'gauge' ), $user_login ) . "\r\n\r\n";
				$message .= sprintf( esc_html__( 'Password: %s', 'gauge' ), $new_password ) . "\r\n\r\n";
	
				if ( $message && ! ghostpool_wp_mail( $user_email, esc_html__( 'Your new password', 'gauge' ), $message ) ) {
					echo "<span class='gp-error'>" . esc_html__( 'Email failed to send for some unknown reason.', 'gauge' ) . "</span>";
					exit;
				} else {
					$redirect_to = apply_filters( 'ghostpool_reset_success_redirect', home_url( '/' ) . '?action=reset_success' );
					wp_safe_redirect( $redirect_to );
					exit;
				}
		
			} else {
	
				exit( 'Not a valid key.' );
		
			}
	
		}

	}
}
add_action( 'template_redirect', 'ghostpool_lost_password' );

/**
 * Add reset password success message to home page 
 *
 */
if ( ! function_exists( 'ghostpool_reset_password_success' ) ) {
	function ghostpool_reset_password_success() {		
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'reset_success' ) {
			echo '<div id="gp-reset-message"><p>' . esc_html__( "You will receive an email with your new password.", "gauge" ) . '<span id="gp-close-reset-message"></span></p></div>';
		}
	}
}	
add_action( 'wp_footer', 'ghostpool_reset_password_success' );