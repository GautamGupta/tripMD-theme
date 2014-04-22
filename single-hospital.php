<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header();
setup_postdata($post); ?>

<h2 class="animated fadeIn"><?php the_title(); ?></h2>

<div class="content">
	<?php the_content(); ?>
</div>

<?php
$args = array (
	'post_parent'            => get_the_ID(),
	'post_type'              => 'doctor',
	'post_status'            => 'publish',
	'pagination'             => false,
	'orderby'                => 'title',
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

// The Query
$query = new WP_Query( $args );
$push = 0;
?>

	<?php if ( $query->have_posts() ) : ?>

		<h3 class="animated fadeIn">Doctors</h2>
		<h4 class="animated fadeIn">Our experienced doctors will ensure your safe treatment.</h4>

		<div style="margin: 15px 0 120px 0">
			<div class="grid-30" style="padding-top: 30px">Sort by <b>Experience</b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
			<div class="grid-40"><input type="search" placeholder="Search&hellip;" x-webkit-speech></input></div>
			<div class="grid-30" style="padding-top: 30px"><a href="#help">Need help?</a></div>
		</div>

		<div class="options grid-100 grid-parent">

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<a href="<?php the_permalink(); ?>" <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>

					<?php if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
						<div class="image" style="background: url(<?php echo $thumbnail['0']; ?>); background-size: cover"></div>
					<?php endif; ?>
					<h3>Dr. <?php the_title(); ?></h3>
					<h6 class="subtitle"><?php the_excerpt(); ?></h6>

					<?php //if ( get_post_meta( get_the_ID(), 'accreditations', true ) ) : ?>
						<div class="grid-100 duration"><span>Qualifications</span>MD, MAMS &hellip;</div>
					<?php //endif; ?>
					<?php //if ( get_post_meta( get_the_ID(), 'accommodation', true ) ) : ?>
						<div class="grid-100 price"><span>Experience</span>20+ years</div>
					<?php //endif; ?>

				</a>

			<?php
				if ( $push == 10 ) $push = 0;
				else $push += 5;
			endwhile; ?>

		</div>

	<?php endif;

// Restore original Post Data
wp_reset_postdata();

$args = array (
	'post_parent'            => get_the_ID(),
	'post_type'              => 'room',
	'post_status'            => 'publish',
	'pagination'             => false,
	'orderby'                => 'title',
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

// The Query
$query = new WP_Query( $args );
$push = 0; ?>

	<?php if ( $query->have_posts() ) : ?>

		<h3 class="animated fadeIn">Available Rooms</h2>
		<h4 class="animated fadeIn">Perfect rooms that suit everyone's lifestyle.</h4>

		<div class="options grid-100 grid-parent">

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<a href="<?php the_permalink(); ?>" <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>

					<?php if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
						<div class="image" style="background: url(<?php echo $thumbnail['0']; ?>); background-size: cover"></div>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<h6 class="subtitle"><?php the_excerpt(); ?></h6>

					<?php if ( get_post_meta( get_the_ID(), 'price', true ) ) : ?>
						<strong>Price</strong>$<?php echo get_post_meta( get_the_ID(), 'price', true ); ?> per night<br />
					<?php endif; ?>
					<?php if ( get_post_meta( get_the_ID(), 'amenities', true ) ) : ?>
						<strong>Amenities</strong><?php echo get_post_meta( get_the_ID(), 'amenities', true ); ?>
					<?php endif; ?>

				</a>

			<?php
				if ( $push == 10 ) $push = 0;
				else $push += 5;
			endwhile; ?>

		</div>

	<?php endif;

// Restore original Post Data
wp_reset_postdata(); ?>

<?php get_footer(); ?>
