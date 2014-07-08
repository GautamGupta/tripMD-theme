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
					if ( did_action( 'tmd_post_request_invitation_register' ) ) :
						if ( tmd_has_errors() ) :
							foreach ( tmd_get_errors() as $tmd_error ) : ?>
        						<p class="error"><?php _e( '<i class="fa warn fa-exclamation-triangle"></i>', 'tripmd' ); ?> <?php echo $tmd_error; ?></p>
        					<?php endforeach;
        				else : $dont_display_form = 1; ?>
							<p class="success">
								<?php _e( 'Thank you for submitting your medical enquiry. Our medical expert will get in touch with you within the next 24 hours to discuss your options in more detail.', 'tripmd' ); ?><br /><br />
								<?php _e( 'If you prefer, you can call us 24x7 at +1-415-528-8650 or email us at <a href="mailto:support@tripmd.com" class="green-t">support@tripmd.com</a>.', 'tripmd' ); ?>
							</p>
						<?php endif;
					endif; ?>

				</div>

				<?php if ( empty( $dont_display_form ) ) : ?>

					<p>Find out if our services are right for you by sending an inquiry.<?php /* <a href="http://tripmd.com" class="green-t">Learn more</a>. */ ?></p>

					<?php /* <p class="sub">In case you have any questions, please feel free to contact us at <a href="mailto:support@tripmd.com" class="green-t">support@tripmd.com</a>.</p> */ ?>

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
								<input type="text" name="tmd_bs_condition" placeholder="<?php _e( 'Describe your medical condition', 'tripmd' ); ?>" class="treatment field" data-icon="\f007" value="<?php echo !empty( $_POST['tmd_bs_condition'] ) ? $_POST['tmd_bs_condition'] : ''; ?>" />
								<i class="fa fa-stethoscope"></i>
							</div>

	                        <input type="hidden" name="action" value="invitation_register" />
	                        <?php wp_nonce_field( 'tmd_invitation_register_nonce' ); ?>

							<a href="#" class="big fat green button submit" onclick="document.getElementById('beta-form').submit();"><?php _e( 'Get more info', 'tripmd' ); ?></a>
							<?php /* <p class="ohho">Just <b><?php echo max( 14, 100 - tmd_user_count() ); ?></b> spots remaining!</p> */ ?>
							<p class="ohho"><?php _e( 'Our medical experts are available 24x7 to answer your questions.', 'tripmd' ); ?>
							<?php _e( 'Reach us at +1-415-528-8650 or <a href="mailto:support@tripmd.com" class="green-t">support@tripmd.com</a>.', 'tripmd' ); ?></p>

							<input type="submit" hidden>

						</form>

					</div>

				<?php endif; ?>

			</div>

		</div>

		<?php wp_footer(); ?>

		<script type="text/javascript" src="//use.typekit.net/jlx8kbu.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	</body>

</html>