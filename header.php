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

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

		<meta name="msapplication-TileColor" content="#fcfcfc">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-144x144.png">

		<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/img/favicons/browserconfig.xml">

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
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/jquery.jqplot.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/select/select-theme-default.css" />
		<script src="<?php echo get_template_directory_uri(); ?>/js/select.min.js"></script>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header>

			<nav id="site-navigation" class="main-navigation<?php if ( is_front_page() ) : ?> home<?php else : ?> sticky topo<?php endif; ?>" role="navigation">

				<div class="grid-container">

					<div class="logo grid-10 mobile-grid-50">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-<?php echo is_front_page() ? 'white' : 'black'; ?>.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image" /></a>
					</div>

                    <!-- <h1 class="menu-toggle"><?php _e( 'Menu', 'tripmd' ); ?></h1>
                    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tripmd' ); ?></a> -->
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu grid-90 mobile-grid-50' ) ); ?>

                </div>

			</nav>

		</header>

        <?php if ( !is_front_page() ) : ?>

		<section id="main" class="site-main" role="main">

			<div class="grid-container">

        <?php endif; ?>