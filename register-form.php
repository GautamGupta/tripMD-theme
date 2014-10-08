<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'register' ); ?>
	<?php $template->the_errors(); ?>
	<form name="template-form registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">

		<p>
			<label for="name<?php $template->the_instance(); ?>"><?php _e( 'Full Name', 'tripmd' ); ?></label>
			<input type="text" name="name" id="name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'name' ); ?>" size="20" tabindex="<?php tmd_tab_index(); ?>" required="required" />
	    </p>

		<p>
			<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'Email', 'tripmd' ); ?></label>
			<input type="email" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" tabindex="<?php tmd_tab_index(); ?>" required="required" />
		</p>

		<?php do_action( 'register_form' ); ?>

		<p id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'A password will be e-mailed to you.' ) ); ?></p>

		<p class="submit">
			<a class="big fat green form submit button" href="#" onclick="document.getElementById('registerform<?php $template->the_instance(); ?>').submit();" id="wp-submit<?php $template->the_instance(); ?>" tabindex="<?php tmd_tab_index(); ?>"><?php _e( 'Register', 'tripmd' ); ?></a>
			<?php $redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '/login'; ?>
			<input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="register" />
			<input type="submit" hidden="hidden" />
		</p>
	</form>
	<?php $template->the_action_links( array( 'register' => false ) ); ?>
</div>
