<?php

/**
 * User Registration Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<fieldset class="bbp-form">
		<legend><?php _e( 'Create an Account', 'tripmd' ); ?></legend>

		<?php do_action( 'bbp_template_before_register_fields' ); ?>

		<div class="bbp-template-notice">
			<p><?php _e( 'We use your email address to email you a secure password and verify your account.', 'tripmd' ) ?></p>
		</div>

		<div class="bbp-email">
			<label for="user_email"><?php _e( 'Email', 'tripmd' ); ?>: </label>
			<input type="text" name="user_email" value="<?php tmd_sanitize_val( 'user_email' ); ?>" id="user_email" tabindex="<?php tmd_tab_index(); ?>" />
		</div>

		<div class="bbp-email">
	        <label for="name"><?php _e( 'Full Name', 'tripmd' ); ?>: </label>
	        <input type="text" name="name" value="<?php tmd_sanitize_val( 'name' ); ?>" size="20" id="name" tabindex="<?php tmd_tab_index(); ?>" />
	    </div>

		<?php do_action( 'register_form' ); ?>

		<div class="bbp-submit-wrapper">

			<button type="submit" tabindex="<?php tmd_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Register', 'tripmd' ); ?></button>

			<?php bbp_user_register_fields(); ?>
			<input type="hidden" name="tmd_register" value="1" />

		</div>

		<?php do_action( 'bbp_template_after_register_fields' ); ?>

	</fieldset>
</form>
