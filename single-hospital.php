<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header();
setup_postdata( $post ); ?>

<div class="heading grid-100"><h2 class="animated fadeIn"><?php the_title(); ?></h2></div>

<div class="content">
	<?php the_content(); ?>

    <?php if ( get_post_meta( get_the_ID(), 'amenities', true ) ) : ?>
        <strong>Amenities</strong><br />
        <?php tmd_amenities( get_post_meta( get_the_ID(), 'amenities', true ) ); ?>
    <?php endif; ?>

    <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() ) :
            comments_template( '/testimonials.php' );
        endif;
    ?>
    
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
	'posts_per_page'         => -1,
	'meta_key'               => 'specialities',
	'meta_value'             => tripmd_session_get_id( 'speciality' ),
	/* @todo Change to find in set (like single procedure page query) when we support multiple specialities per doctor */
);

// The Query
$query = new WP_Query( $args );
$push = 0;
?>

	<?php if ( $query->have_posts() ) : ?>

		<h3 class="animated fadeIn">Doctors</h3>
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
					<p></p>

					<?php if ( get_post_meta( get_the_ID(), 'rating', true ) ) : ?>
						<div class="grid-100 experience"><span class="title">Trust Rating</span><?php tmd_rating( get_post_meta( get_the_ID(), 'rating', true ) ); ?></div>
					<?php endif; ?>
					<?php if ( get_post_meta( get_the_ID(), 'intl_treated', true ) ) : ?>
						<div class="grid-100 qualifications"><span class="title">Intl Patients</span><?php echo number_format_i18n( get_post_meta( get_the_ID(), 'intl_treated', true ) ); ?>+</div>
					<?php endif; ?>

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

				<a <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>

					<?php if ( has_post_thumbnail() ) :
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
						<div class="image" style="background: url(<?php echo $thumbnail['0']; ?>); background-size: cover"></div>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<h6 class="subtitle"><?php the_excerpt(); ?></h6>

					<?php if ( get_post_meta( get_the_ID(), 'price', true ) ) : ?>
						<div class="grid-100 price"><span>Price</span>$<?php echo get_post_meta( get_the_ID(), 'price', true ); ?> per night</div>
					<?php endif; ?>
					<?php if ( get_post_meta( get_the_ID(), 'amenities', true ) ) : ?>
						<div class="grid-100 duration"><span>Amenities</span><?php echo get_post_meta( get_the_ID(), 'amenities', true ); ?></div>
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
