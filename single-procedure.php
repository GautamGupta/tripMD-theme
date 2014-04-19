<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header();

$querystr = $wpdb->prepare( "
SELECT $wpdb->posts.*
FROM $wpdb->posts
WHERE $wpdb->posts.ID IN (
	SELECT $wpdb->posts.post_parent
	FROM $wpdb->posts
	WHERE $wpdb->posts.ID IN (
		SELECT $wpdb->posts.post_id
		FROM $wpdb->postmeta
		WHERE FIND_IN_SET(%d, $wpdb->postmeta.meta_value)
	)
)", get_the_ID() );

$procedures = $wpdb->get_results( $querystr, OBJECT );

?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( $procedures ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Hospitals', 'tripmd' ); ?></h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php foreach ( $procedures as $procedure ) : setup_postdata( $procedure ); ?>

				<?php
					get_template_part( 'content', get_post_type() );
				?>

			<?php endforeach; ?>

			<?php tripmd_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
// Restore original Post Data
wp_reset_postdata();
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
