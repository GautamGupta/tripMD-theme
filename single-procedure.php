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
		SELECT $wpdb->postmeta.post_id
		FROM $wpdb->postmeta
		WHERE FIND_IN_SET(%d, $wpdb->postmeta.meta_value)
			 AND meta_key = 'specialities'
	)
)", $post->post_parent );

$hospitals = $wpdb->get_results( $querystr, OBJECT );

?>

<?php if ( $hospitals ) : ?>

	<h2 class="animated fadeIn">Hospitals for <?php the_title(); ?></h2>
	<h4 class="animated fadeIn">Select a procedure that suits your time and budget.</h4>

	<div style="margin: 15px 0 120px 0">
		<div class="grid-30" style="padding-top: 30px">Sort by <b>Rating</b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
		<div class="grid-40"><input type="search" placeholder="Search&hellip;" x-webkit-speech></input></div>
		<div class="grid-30" style="padding-top: 30px"><a href="#help">Skip to Doctor Selection</a></div>
	</div>

	<div class="options grid-100 grid-parent">

		<?php foreach ( $hospitals as $hospital ) : setup_postdata( $GLOBALS['post'] =& $hospital ); ?>

			<a href="<?php the_permalink(); ?>" <?php post_class( 'card grid-30' ); ?>>

				<?php if ( has_post_thumbnail() ) :
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
					<div class="image" style="background: url(<?php echo $thumbnail['0']; ?>); background-size: cover"></div>
				<?php endif; ?>
				<h3><?php the_title(); ?></h3>
				<h6 class="subtitle">New Delhi, India</h6>

				<?php //if ( get_post_meta( get_the_ID(), 'rating', true ) ) : ?>
					<div class="grid-100 duration"><span>Trust Rating</span><?php tmd_rating( /*get_post_meta( get_the_ID(), 'rating', true )*/ ); ?></div>
				<?php //endif; ?>
				<?php //if ( get_post_meta( get_the_ID(), 'accreditations', true ) ) : ?>
					<div class="grid-100 duration"><span>Accreditations</span>JCI, ISO 9002</div>
				<?php //endif; ?>
				<?php //if ( get_post_meta( get_the_ID(), 'accommodation', true ) ) : ?>
					<div class="grid-100 price"><span>Rooms</span>500+ rooms</div>
				<?php //endif; ?>

			</a>

		<?php endforeach; ?>

	</div>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
