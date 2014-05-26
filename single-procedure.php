<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

<div class="heading grid-100">
	<h2 class="animated fadeIn"><?php the_title(); ?></h2>
	<small style="text-align: center"><?php the_excerpt(); ?></small>
</div>

<div class="content">

	<?php if ( get_post_meta( get_the_ID(), 'duration', true ) ) : ?>
		<p><strong>Duration</strong>: <?php printf( __( '%d days', 'tripmd' ), get_post_meta( get_the_ID(), 'duration', true ) ); ?></p>
	<?php endif; ?>
	<?php if ( get_post_meta( get_the_ID(), 'price', true ) ) : ?>
		<p><strong>Price</strong>: <?php tmd_price( get_post_meta( get_the_ID(), 'price', true ) ); ?>
            <?php if ( get_post_meta( get_the_ID(), 'price_original', true ) ) : ?>
                <span class="strike"><?php tmd_price( get_post_meta( get_the_ID(), 'price_original', true ) ); ?></span>
            <?php endif; ?>
        </p>
	<?php endif; ?>
	<?php the_content(); ?>
</div>

<?php

$push = 0;
$querystr = $wpdb->prepare( "
SELECT $wpdb->posts.*
FROM $wpdb->posts
WHERE $wpdb->posts.ID IN (
	SELECT $wpdb->posts.post_parent
	FROM $wpdb->posts
	WHERE $wpdb->posts.ID IN ( /* The doctors who have this speciality */
		SELECT $wpdb->postmeta.post_id
		FROM $wpdb->postmeta
		WHERE FIND_IN_SET(%d, $wpdb->postmeta.meta_value)
			 AND meta_key = 'specialities'
	)
)", $post->post_parent );

$hospitals = $wpdb->get_results( $querystr, OBJECT );

if ( $hospitals ) : ?>

	<div class="heading grid-100"><h2 class="animated fadeIn">Hospitals for <?php the_title(); ?></h2></div>
	<h4 class="animated fadeIn">Select a procedure that suits your time and budget.</h4>

	<div style="margin: 15px 0 120px 0">
		<div class="grid-30" style="padding-top: 30px">Sort by <b>Rating</b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
		<div class="grid-40"><input type="search" placeholder="Search&hellip;" x-webkit-speech></input></div>
		<div class="grid-30" style="padding-top: 30px"><a href="#help">Skip to Doctor Selection</a></div>
	</div>

	<div class="content cards grid-100 grid-parent">

		<?php foreach ( $hospitals as $hospital ) : setup_postdata( $GLOBALS['post'] =& $hospital ); ?>

			<a href="<?php the_permalink(); ?>" id="<?php echo get_post_type(); ?>-<?php the_ID(); ?>" <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>

				<?php if ( has_post_thumbnail() ) :
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
					<div class="image" style="background: url(<?php echo $thumbnail['0']; ?>); background-size: cover"></div>
				<?php endif; ?>
				<h3><?php the_title(); ?></h3>
				<h6 class="subtitle"><?php echo get_post_meta( get_the_ID(), 'location', true ) ? get_post_meta( get_the_ID(), 'location', true ) : '&nbsp;'; ?></h6>

				<?php if ( get_post_meta( get_the_ID(), 'rating', true ) ) : ?>
					<div class="grid-100 duration"><span class="title">Trust Rating</span><?php tmd_rating( get_post_meta( get_the_ID(), 'rating', true ) ); ?></div>
				<?php endif; ?>
                <?php if ( get_post_meta( get_the_ID(), 'intl_treated', true ) ) : ?>
                    <div class="grid-100 price"><span class="title">Intl Patients</span><?php echo number_format_i18n( get_post_meta( get_the_ID(), 'intl_treated', true ) ); ?>+</div>
                <?php endif; ?>

				<?php /* if ( get_post_meta( get_the_ID(), 'accreditations', true ) ) : ?>
					<div class="grid-100 duration"><span class="title">Accreditations</span>JCI, ISO 9002</div>
				<?php endif; ?>
				<?php if ( get_post_meta( get_the_ID(), 'accommodation', true ) ) : ?>
					<div class="grid-100 price"><span class="title">Rooms</span>500+ rooms</div>
				<?php endif; */ ?>

			</a>

		<?php
		if ( $push == 10 ) $push = 0;
			else $push += 5;
		endforeach; ?>

	</div>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
