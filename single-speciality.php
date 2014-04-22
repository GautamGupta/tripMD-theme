<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header();

$args = array (
	'post_parent'            => get_the_ID(),
	'post_type'              => 'procedure',
	'post_status'            => 'publish',
	'pagination'             => false,
	'orderby'                => 'title',
	'order'                  => 'asc',
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

// The Query
$query = new WP_Query( $args );
$push = 0;

?>

		<?php if ( $query->have_posts() ) : ?>

			<h2 class="animated fadeIn">Procedures for <?php the_title(); ?></h2>
			<h3 class="animated fadeIn">Select a procedure that suits your time and budget.</h3>


			<div style="margin: 15px 0 120px 0">
				<div class="grid-30" style="padding-top: 30px">Sort by <b>Price</b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
				<div class="grid-40"><input type="search" placeholder="Search&hellip;" x-webkit-speech></input></div>
				<div class="grid-30" style="padding-top: 30px"><a href="#help">Need help?</a></div>
			</div>

			<div class="options grid-100 grid-parent">

				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<a href="<?php the_permalink(); ?>" <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>
						<h3><?php the_title(); ?></h3>
						<h6 class="subtitle"><?php the_content(); ?></h6>
						<?php if ( get_post_meta( get_the_ID(), 'price', true ) ) : ?>
							<div class="grid-100 duration"><span>Price</span>: <?php echo get_post_meta( get_the_ID(), 'price', true ); ?> USD</div>
						<?php endif; ?>
						<?php if ( get_post_meta( get_the_ID(), 'duration', true ) ) : ?>
							<div class="grid-100 duration"><span>Duration</span>: <?php echo get_post_meta( get_the_ID(), 'duration', true ); ?></div>
						<?php endif; ?>
					</a>

				<?php
					if ( $push == 10 ) $push = 0;
					else $push += 5;
				endwhile; ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

<?php
// Restore original Post Data
wp_reset_postdata();
?>

<?php get_footer(); ?>
