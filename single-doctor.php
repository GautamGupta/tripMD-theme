<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="heading grid-100"><h2 class="animated fadeIn">Dr. <?php the_title(); ?></h2></div>
	<div class="content">

		<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'full', array( 'class' => 'alignright' ) ); ?>
		
		<?php if ( get_post_meta( get_the_ID(), 'location', true ) ) : ?>
			<p><strong>Location</strong>: <?php echo get_post_meta( get_the_ID(), 'location', true ); ?></p>
		<?php endif; ?>

		<?php if ( get_post_meta( get_the_ID(), 'specialization', true ) ) : ?>
			<p><strong>Specialization</strong>: <?php echo get_post_meta( get_the_ID(), 'specialization', true ); ?></p>
		<?php endif; ?>

		<?php if ( get_post_meta( get_the_ID(), 'experience', true ) ) : ?>
			<p><strong>Experience</strong>: <?php echo get_post_meta( get_the_ID(), 'experience', true ); ?></p>
		<?php endif; ?>
		<?php if ( get_post_meta( get_the_ID(), 'qualifications', true ) ) : ?>
			<p><strong>Qualifications</strong>: <?php echo get_post_meta( get_the_ID(), 'qualifications', true ); ?></p>
		<?php endif; ?>

		<?php the_content(); ?>

        <?php
            // If comments are open or we have at least one comment, load up the comment template
            /* if ( comments_open() || '0' != get_comments_number() ) :
                comments_template( '/testimonials.php' );
            endif; */
        ?>

	</div>

    <small class="animated fadeIn">You&rsquo;re nearly done.</small>
    &nbsp;
    <a class="big fat dark-gray button" href="<?php echo site_url( 'register' ); ?>">Book Consultation</a>
    &nbsp;
    <small class="animated fadeIn">or</small>
    &nbsp;
    <a class="big fat light-gray button" href="<?php echo get_permalink( $post->post_parent ); ?>">Go Back</a>
    &nbsp;
    <small class="animated fadeIn">to select another doctor.</small>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
