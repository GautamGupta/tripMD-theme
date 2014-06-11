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

		<!-- Favicons -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon.ico">
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-152x152.png">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-196x196.png" sizes="196x196">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-160x160.png" sizes="160x160">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png" sizes="32x32">

		<meta name="msapplication-TileColor" content="#fcfcfc">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-144x144.png">
		<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/img/favicons/browserconfig.xml">

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimal-ui">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class( 'beta' ); ?>>

		<div class="block">

			<div class="card">

				<div class="welcome">

					<div class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image" /></a>
					</div>

					<p>tripMD helps patients connect with trusted world-class healthcare overseas at affordable prices.<br />
					<a href="http://tripmd.com" class="green-t">Learn more</a>.</p>

					<p class="sub">In case you have any questions, please feel free to contact us at help@tripmd.com.</p>

				</div>

				<div class="form">

					<form action="">
						
						<div class="name fld">
							
							<input type="text" placeholder="Name" class="name field" required data-icon="\f007">
							<i class="fa fa-user"></i>
						
						</div>
						
						<div class="email fld">
							
							<input type="email" placeholder="Email" class="email field" required data-icon="\f007">
							<i class="fa fa-envelope-o"></i>
						
						</div>
						
						<div class="phone fld">
							
							<input type="phone" placeholder="Phone" class="phone field" required data-icon="\f007">
							<i class="fa fa-phone"></i>
						
						</div>
						
						<div class="treatment fld">
							
							<input type="text" class="treatment field" placeholder="Diagnosed Condition" required data-icon="\f007">
							<i class="fa fa-stethoscope"></i>
						
						</div>

						<a href="#" class="big fat green button submit">Get Exclusive Access</a>
						<p class="ohho">Just <b>86</b> spots remaining!</p>

					</form>

				</div>

			</div>

		</div>

		<?php wp_footer(); ?>

		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	</body>

</html>