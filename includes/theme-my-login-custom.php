<?php
/**
 * To login the user after registration
 * TML Custom Passwords custom class
 * 
 * Has TripMD Modifications
 *
 * @package TripMD
 * @subpackage Theme_My_Login_Custom
 */

/**
 * Returns template message for requested action
 *
 * @param string $action Action to retrieve
 * @return string The requested template message
 */
function tmd_tml_action_template_message( $message = '', $action = '' ) {
	switch ( $action ) {
		case 'register':
			$message = sprintf( __( 'Register to view %s\'s featured doctors.' ), get_bloginfo( 'blog' ) );
			break;
		case 'lostpassword':
			$message = __( 'Please enter your email address. You will receive a link to create a new password via email.' );
			break;
		case 'resetpass':
			$message = __( 'Enter your new password below.' );
			break;
		default:
			$message = '';
	}

	return $message;
}
add_filter( 'tml_action_template_message', 'tmd_tml_action_template_message', 1, 2 );

function tmd_registration_name_split_hooks() {
    if ( !empty( $_REQUEST['name'] ) ) { // /register page has single 'name' field, this splits it into fn and ln
        $name = tmd_split_name( $_REQUEST['name'] );
        $_REQUEST['first_name'] = $name['first'];
        $_REQUEST['last_name']  = $name['last'];
        $_REQUEST['nickname']   = $name['first'] . ' ' . $name['last'];
    }

    add_filter( 'pre_user_first_name', 'tmd_registration_handler_fn' );
    add_filter( 'pre_user_last_name',  'tmd_registration_handler_ln' );
    add_filter( 'pre_user_nickname',   'tmd_registration_handler_nn' );
    // Above functions are located in user.php
}
add_action( 'register_post', 'tmd_registration_name_split_hooks' );

/**
 * Fix empty username error 404
 */
function tmd_tml_registration_errors( $errors ) {
	$check = $errors->get_error_codes();
	if ( count( $check ) == 1 && $check[0] == 'empty_username' )
		$errors = new WP_Error();

	return $errors;
}
add_filter( 'registration_errors', 'tmd_tml_registration_errors' );

if ( class_exists( 'Theme_My_Login_User_Moderation' ) ) : 
	function tmd_tmd_action_messages( &$theme_my_login ) {
		if ( 'approval' == tmd_get_sanitize_val( 'pending' ) )
			$theme_my_login->errors->add( 'pending_approval', sprintf( __( 'Thank you for signing up for %1$s - a curated platform to help expats access high quality healthcare in foreign cities. %1$s Beta is invitation only, and we are sending out invites in the order they are received. You will be notified by e-mail once your account has been reviewed.', 'theme-my-login' ), get_bloginfo( 'name' ) ), 'message' );
	}
	add_action( 'tml_request', 'tmd_tmd_action_messages', 10 );

	$custom_user_mod = Theme_My_Login_User_Moderation::get_object();
	remove_action( 'tml_request', array( &$custom_user_mod, 'action_messages' ) );
endif;

/**
 * Login the user after registration
 */
function tmd_tml_new_user_registered( $user_id ) {
    wp_set_auth_cookie( $user_id, false, is_ssl() );
    $redirect_to = tmd_get_sanitize_val( 'redirect_to' );
    $redirect_to = !empty( $redirect_to ) ? $redirect_to : site_url( 'wp-login.php?registration=complete' );
    wp_safe_redirect( $redirect_to );
    exit;
}
// add_action( 'tml_new_user_registered', 'tmd_tml_new_user_registered' );

/**
 * Set default role as contributor on approval by admin
 */
add_action( 'tml_approval_role', function() { return 'contributor'; } );

/**
 * Re-add email on user reg (before approval)
 */
if ( class_exists( 'Theme_My_Login_Custom_Email' ) ) {
	$custom_email = Theme_My_Login_Custom_Email::get_object();
	add_action( 'tml_new_user_registered', array( &$custom_email, 'new_user_notification' ), 10, 2 );
}

if ( class_exists( 'Theme_My_Login_Abstract' ) ) :
/**
 * Theme My Login Custom Passwords module class
 *
 * @since 6.0
 */
class Theme_My_Login_Custom_Passwords_TMD extends Theme_My_Login_Abstract {
	/**
	 * Returns singleton instance
	 *
	 * @since 6.3
	 * @access public
	 * @return object
	 */
	public static function get_object( $class = null ) {
		return parent::get_object( __CLASS__ );
	}

	/**
	 * Loads the module
	 *
	 * @since 6.0
	 * @access protected
	 */
	protected function load() {
		add_action( 'register_form',       array( &$this, 'password_fields' ), 1 );
		add_filter( 'registration_errors', array( &$this, 'password_errors' ) );
		add_filter( 'random_password',     array( &$this, 'set_password'    ) );

		add_action( 'signup_extra_fields',       array( &$this, 'ms_password_fields'       ) );
		add_action( 'signup_hidden_fields',      array( &$this, 'ms_hidden_password_field' ) );
		add_filter( 'wpmu_validate_user_signup', array( &$this, 'ms_password_errors'       ) );
		add_filter( 'add_signup_meta',           array( &$this, 'ms_save_password'         ) );

		add_action( 'tml_new_user_registered', array( &$this, 'remove_default_password_nag' ) );
		add_action( 'approve_user',            array( &$this, 'remove_default_password_nag' ) );

		add_filter( 'tml_register_passmail_template_message', array( &$this, 'register_passmail_template_message' ) );
		add_action( 'tml_request',                            array( &$this, 'action_messages'                    ) );

		add_filter( 'registration_redirect', array( &$this, 'registration_redirect' ) );
	}

	/**
	 * Outputs password fields to registration form
	 *
	 * Callback for "register_form" hook in file "register-form.php", included by Theme_My_Login_Template::display()
	 *
	 * @see Theme_My_Login::display()
	 * @since 6.0
	 * @access public
	 */
	public function password_fields() {
		$template = Theme_My_Login::get_object()->get_active_instance();
		?>
		<p><label for="pass1<?php $template->the_instance(); ?>"><?php _e( 'Password' ); ?></label>
		<input tabindex="<?php tmd_tab_index(); ?>" required="required" autocomplete="off" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" /></p>
		<p><label for="pass2<?php $template->the_instance(); ?>"><?php _e( 'Confirm Password', 'theme-my-login' ); ?></label>
		<input tabindex="<?php tmd_tab_index(); ?>" required="required" autocomplete="off" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" /></p>
		<?php
	}

	/**
	 * Outputs password fields to multisite signup user form
	 *
	 * Callback for "signup_extra_fields" hook in file "ms-signup-user-form.php", included by Theme_My_Login_Template::display()
	 *
	 * @see Theme_My_Login::display()
	 * @since 6.1
	 * @access public
	 */
	public function ms_password_fields() {
		$theme_my_login = Theme_My_Login::get_object();

		$template =& $theme_my_login->get_active_instance();

		$errors = array();
		foreach ( $theme_my_login->errors->get_error_codes() as $code ) {
			if ( in_array( $code, array( 'empty_password', 'password_mismatch', 'password_length' ) ) )
				$errors[] = $theme_my_login->errors->get_error_message( $code );
		}
		?>
		<label for="pass1<?php $template->the_instance(); ?>"><?php _e( 'Password:', 'theme-my-login' ); ?></label>
		<?php if ( ! empty( $errors ) ) { ?>
			<p class="error"><?php echo implode( '<br />', $errors ); ?></p>
		<?php } ?>
		<input autocomplete="off" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" /><br />
		<span class="hint"><?php echo apply_filters( 'tml_password_hint', __( '(Must be at least 6 characters.)', 'theme-my-login' ) ); ?></span>

		<label for="pass2<?php $template->the_instance(); ?>"><?php _e( 'Confirm Password:', 'theme-my-login' ); ?></label>
		<input autocomplete="off" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" /><br />
		<span class="hint"><?php echo apply_filters( 'tml_password_confirm_hint', __( 'Confirm that you\'ve typed your password correctly.', 'theme-my-login' ) ); ?></span>
		<?php
	}

	/**
	 * Outputs password field to multisite signup blog form
	 *
	 * Callback for "signup_hidden_fields" hook in file "ms-signup-blog-form.php", included by Theme_My_Login_Template::display()
	 *
	 * @see Theme_My_Login::display()
	 * @since 6.1
	 * @access public
	 */
	public function ms_hidden_password_field() {
		if ( isset( $_POST['user_pass'] ) )
			echo '<input type="hidden" name="user_pass" value="' . $_POST['user_pass'] . '" />' . "\n";
	}

	/**
	 * Handles password errors for registration form
	 *
	 * Callback for "registration_errors" hook in Theme_My_Login::register_new_user()
	 *
	 * @see Theme_My_Login::register_new_user()
	 * @since 6.0
	 * @access public
	 *
	 * @param WP_Error $errors WP_Error object
	 * @return WP_Error WP_Error object
	 */
	public function password_errors( $errors = '' ) {
		// Make sure $errors is a WP_Error object
		if ( empty( $errors ) )
			$errors = new WP_Error();

		// Make sure passwords aren't empty
		if ( empty( $_POST['pass1'] ) || empty( $_POST['pass2'] ) ) {
			$errors->add( 'empty_password', __( '<strong>ERROR</strong>: Please enter your password twice.' ) );

		// Make sure there's no "\" in the password
		} elseif ( false !== strpos( stripslashes( $_POST['pass1'] ), "\\" ) ) {
			$errors->add( 'password_backslash', __( '<strong>ERROR</strong>: Passwords may not contain the character "\\".' ) );

		// Make sure passwords match
		} elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
			$errors->add( 'password_mismatch', __( '<strong>ERROR</strong>: Please enter the same password in the two password fields.' ) );

		// Make sure password is long enough
		} elseif ( strlen( $_POST['pass1'] ) < 6 ) {
			$errors->add( 'password_length', __( '<strong>ERROR</strong>: Your password must be at least 6 characters in length.', 'theme-my-login' ) );

		// All is good, assign password to a friendlier key
		} else {
			$_POST['user_pass'] = $_POST['pass1'];
		}

		return $errors;
	}

	/**
	 * Handles password errors for multisite signup form
	 *
	 * Callback for "registration_errors" hook in Theme_My_Login::register_new_user()
	 *
	 * @see Theme_My_Login::register_new_user()
	 * @since 6.1
	 * @access public
	 *
	 * @param WP_Error $errors WP_Error object
	 * @return WP_Error WP_Error object
	 */
	public function ms_password_errors( $result ) {
		if ( isset( $_POST['stage'] ) && 'validate-user-signup' == $_POST['stage'] ) {
			$errors = $this->password_errors();
			foreach ( $errors->get_error_codes() as $code ) {
				foreach ( $errors->get_error_messages( $code ) as $error ) {
					$result['errors']->add( $code, preg_replace( '/<strong>([^<]+)<\/strong>: /', '', $error ) );
				}
			}
		}
		return $result;
	}

	/**
	 * Adds password to signup meta array
	 *
	 * Callback for "add_signup_meta" hook
	 *
	 * @since 6.1
	 * @access public
	 *
	 * @param array $meta Signup meta
	 * @return array $meta Signup meta
	 */
	public function ms_save_password( $meta ) {
		if ( isset( $_POST['user_pass'] ) )
			$meta['user_pass'] = $_POST['user_pass'];
		return $meta;
	}

	/**
	 * Sets the user password
	 *
	 * Callback for "random_password" hook in wp_generate_password()
	 *
	 * @see wp_generate_password()
	 * @since 6.0
	 * @access public
	 *
	 * @param string $password Auto-generated password passed in from filter
	 * @return string Password chosen by user
	 */
	public function set_password( $password ) {
		global $wpdb;

		// Remove filter as not to filter User Moderation activation key
		remove_filter( 'random_password', array( &$this, 'set_password' ) );

		if ( is_multisite() && isset( $_REQUEST['key'] ) ) {
			if ( $meta = $wpdb->get_var( $wpdb->prepare( "SELECT meta FROM $wpdb->signups WHERE activation_key = %s", $_REQUEST['key'] ) ) ) {
				$meta = unserialize( $meta );
				if ( isset( $meta['user_pass'] ) ) {
					$password = $meta['user_pass'];
					unset( $meta['user_pass'] );
					$wpdb->update( $wpdb->signups, array( 'meta' => serialize( $meta ) ), array( 'activation_key' => $_REQUEST['key'] ) );
				}
			}
		} else {
			// Make sure password isn't empty
			if ( ! empty( $_POST['user_pass'] ) )
				$password = $_POST['user_pass'];
		}
		return $password;
	}

	/**
	 * Removes the default password nag
	 *
	 * Callback for "tml_new_user_registered" hook in Theme_My_Login::register_new_user()
	 *
	 * @see Theme_My_Login::register_new_user()
	 * @since 6.0
	 * @access public
	 *
	 * @param int $user_id The user's ID
	 */
	public function remove_default_password_nag( $user_id ) {
		update_user_meta( $user_id, 'default_password_nag', false );
	}

	/**
	 * Changes the register template message
	 *
	 * Callback for "tml_register_passmail_template_message" hook
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return string The new register message
	 */
	public function register_passmail_template_message() {
		// Removes "A password will be e-mailed to you." from register form
		return;
	}

	/**
	 * Handles display of various action/status messages
	 *
	 * Callback for "tml_request" hook in Theme_My_Login::the_request()
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @param object $theme_my_login Reference to global $theme_my_login object
	 */
	public function action_messages( &$theme_my_login ) {
		// Change "Registration complete. Please check your e-mail." to reflect the fact that they already set a password
		if ( isset( $_GET['registration'] ) && 'complete' == $_GET['registration'] )
			$theme_my_login->errors->add( 'registration_complete', __( 'Registration complete. You may now log in.', 'theme-my-login' ), 'message' );
	}

	/**
	 * Changes where the user is redirected upon successful registration
	 *
	 * Callback for "registration_redirect" hook in Theme_My_Login_Template::get_redirect_url()
	 *
	 * @see Theme_My_Login_Template::get_redirect_url()
	 * @since 6.0
	 * @access public
	 *
	 * @return string $redirect_to Default redirect
	 * @return string URL to redirect to
	 */
	public function registration_redirect( $redirect_to ) {
		// Redirect to login page with "registration=complete" added to the query
		$redirect_to = site_url( 'wp-login.php?registration=complete' );
		// Add instance to the query if specified
		if ( ! empty( $_REQUEST['instance'] ) )
			$redirect_to = add_query_arg( 'instance', $_REQUEST['instance'], $redirect_to );
		return $redirect_to;
	}
}

Theme_My_Login_Custom_Passwords_TMD::get_object();

endif;

