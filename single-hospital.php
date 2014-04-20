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

		<?php
		foreach ( array( 'doctor', 'room' ) as $post_type ) :

		$args = array (
			'post_parent'            => get_the_ID(),
			'post_type'              => $post_type,
			'post_status'            => 'publish',
			'pagination'             => false,
			'orderby'                => 'title',
			'cache_results'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => true,
		);

		// The Query
		$query = new WP_Query( $args );
		?>

			<?php if ( $query->have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php echo $post_type ?></h1>
					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php
						get_template_part( 'content', get_post_type() );
					?>

				<?php endwhile; ?>

				<?php tripmd_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		<?php
		// Restore original Post Data
		wp_reset_postdata();

		endforeach;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>