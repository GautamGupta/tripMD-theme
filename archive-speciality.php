<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>



			<h2 class="animated fadeIn"><?php _e( 'What kind of treatment are you looking for?', 'tripmd' ); ?></h2>

			<div class="options">

				<?php while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink(); ?>" id="<?php echo get_post_type(); ?>-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> rel="bookmark"><img src="<?php echo get_template_directory_uri(); ?>/img/cardiac.png" alt=""><h3><?php the_title(); ?></h3></a>

				<?php endwhile; ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
