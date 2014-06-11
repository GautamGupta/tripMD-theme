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