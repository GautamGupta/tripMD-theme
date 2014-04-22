<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

		<?php if ( have_posts() ) : ?>

			<h2 class="animated fadeIn"><?php _e( 'What kind of treatment are you looking for?', 'tripmd' ); ?></h2>

			<div class="specialities options">

				<?php while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink(); ?>" id="<?php echo get_post_type(); ?>-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> rel="bookmark">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
						<h3><?php the_title(); ?></h3>
					</a>

				<?php endwhile; ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

<?php get_footer(); ?>
