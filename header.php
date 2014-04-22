<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tripmd
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<title><?php wp_title( '|', true, 'right' ); ?></title>

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
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header<?php if ( is_home() ) : ?>  class="hero"<?php endif; ?>>

			<div class="grid-container">
				
				<?php if ( !is_home() ) : ?>

					<div class="logo grid-30">

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image"></a>

					</div>

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<!-- <h1 class="menu-toggle"><?php _e( 'Menu', 'tripmd' ); ?></h1>
						<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tripmd' ); ?></a> -->

						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu grid-70' ) ); ?>
					</nav><!-- #site-navigation -->
					
				<?php else : ?>

					<nav>

						<div class="logo grid-60">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" alt="Logo" class="logo image"></a>

						</div>

						<ul class="menu grid-40">

							<li><a href="#"><?php _e( 'Login', 'tripmd' ); ?> <i class="fa fa-angle-down"></i></a></li>

						</ul>

					</nav>

					<div class="grid-container block hero-text grid-100">

						<div class="centered">

							<h1><?php _e( 'Medical tourism, <i>simplified</i>.', 'tripmd' ); ?></h1>
							<a class="big fat dark-gray button" href="<?php echo site_url( 'specialities' ); ?>"><?php _e( 'Learn More', 'tripmd' ); ?></a>

						</div>

					</div>

				<?php endif; ?>

		</header>

		<section class="content specialities vcen">

			<main id="main" class="site-main" role="main">

				<div class="grid-container block">

					<div class="centered grid-container">

						<div class="grid-100 grid-parent">

						