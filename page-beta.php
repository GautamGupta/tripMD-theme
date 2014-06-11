<?php 
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tripmd
 */
?><!DOCTYPE html>
<html class="beta" <?php language_attributes(); ?>>
	<head>

		<title><?php wp_title( '&middot;', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/unsemantic.css">
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/home.css">

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>

		<!-- Favicons -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon.ico">

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimal-ui">

	</head>

	<body <?php body_class( 'beta' ); ?>>

		<div class="block">

			<div class="card">

				<div class="welcome">

					<div class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image" /></a>
					</div>

					<?php
					if ( !empty( $_POST['tmd_beta_register'] ) ) :
						if ( tmd_has_errors() ) :
							foreach ( tmd_get_errors() as $tmd_error ) : ?>
        						<p class="error"><?php _e( '<strong>Error</strong>:', 'tripmd' ); ?> <?php echo $tmd_error; ?></p>
        					<?php endforeach;
        				else : $dont_display_form = 1; ?>
							<p class="success"><?php _e( 'You\'ve secured a spot in our exclusive early access! You\'ll shortly receive an email with further information.' ); ?></p>
						<?php endif;
					endif; ?>

					<p>tripMD helps patients connect with trusted world-class healthcare overseas at affordable prices.<br />
					<a href="http://tripmd.com" class="green-t">Learn more</a>.</p>

					<p class="sub">In case you have any questions, please feel free to contact us at help@tripmd.com.</p>

				</div>

				<?php if ( empty( $dont_display_form ) ) : ?>

					<div class="form">

						<form method="post" id="beta-form">
							
							<div class="name fld">
								<input type="text" name="tmd_bs_name" placeholder="Name" class="name field" required="required" data-icon="\f007" value="<?php echo !empty( $_POST['tmd_bs_name'] ) ? $_POST['tmd_bs_name'] : ''; ?>" />
								<i class="fa fa-user"></i>
							</div>
							
							<div class="email fld">
								<input type="email" name="tmd_bs_email" placeholder="Email" class="email field" required="required" data-icon="\f007" value="<?php echo !empty( $_POST['tmd_bs_email'] ) ? $_POST['tmd_bs_email'] : ''; ?>" />
								<i class="fa fa-envelope-o"></i>
							</div>
							
							<div class="phone fld">
								<input type="phone" name="tmd_bs_phone" placeholder="Phone" class="phone field" data-icon="\f007" value="<?php echo !empty( $_POST['tmd_bs_phone'] ) ? $_POST['tmd_bs_phone'] : ''; ?>" />
								<i class="fa fa-phone"></i>
							</div>
							
							<div class="treatment fld">
								<input type="text" name="tmd_bs_condition" placeholder="Diagnosed Condition" class="treatment field" data-icon="\f007" value="<?php echo !empty( $_POST['tmd_bs_condition'] ) ? $_POST['tmd_bs_condition'] : ''; ?>" />
								<i class="fa fa-stethoscope"></i>
							</div>

	                        <input type="hidden" name="tmd_beta_register" value="1" />
	                        <?php wp_nonce_field( 'tmd_beta_register_nonce' ); ?>

							<a href="#" class="big fat green button submit" onclick="document.getElementById('beta-form').submit();">Get Exclusive Access</a>
							<p class="ohho">Just <b><?php echo max( 14, 100 - tmd_user_count() ); ?></b> spots remaining!</p>

						</form>

					</div>

				<?php endif; ?>

			</div>

		</div>

		<?php wp_footer(); ?>

		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	</body>

</html>