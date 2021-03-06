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
$push = 0; ?>

		<?php if ( $query->have_posts() ) : ?>

			<div class="heading grid-100"><h2 class="animated fadeIn">Procedures for <?php the_title(); ?></h2></div>
			<h4 class="animated fadeIn aligncenter">Select a procedure that suits your time and budget. <a href="#help">Skip to doctors</a>.</h4>

			<?php /* <div style="margin: 15px 0 120px 0">
				<div class="grid-30" style="padding-top: 30px">Sort by <b>Price</b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
				<div class="grid-40"><input class="tmd-search" id="proc-search" type="search" placeholder="Search&hellip;" x-webkit-speech></input></div>
				<div class="grid-30" style="padding-top: 30px"><a href="#help">Need help?</a></div>
			</div> */ ?>

			<div class="content cards grid-100 grid-parent">

				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<a href="<?php the_permalink(); ?>" id="<?php echo get_post_type(); ?>-<?php the_ID(); ?>" <?php post_class( 'card grid-30' . ( !empty( $push ) ? ' push-' . $push : '' ) ); ?>>
						<h3><?php the_title(); ?></h3>
						<h6 class="subtitle"><?php the_excerpt(); ?></h6>
						<?php if ( get_post_meta( get_the_ID(), 'duration', true ) ) : ?>
							<div class="grid-100 duration"><span class="title">Duration</span><?php printf( __( '%d days', 'tripmd' ), get_post_meta( get_the_ID(), 'duration', true ) ); ?></div>
						<?php endif; ?>
						<?php if ( get_post_meta( get_the_ID(), 'price', true ) ) : ?>
							<div class="grid-100 price">
                                <span class="title">Price</span><?php tmd_price( get_post_meta( get_the_ID(), 'price', true ) ); ?>
                                <?php if ( get_post_meta( get_the_ID(), 'price_original', true ) ) : ?>
                                    <br />
                                    <span class="strike"><?php tmd_price( get_post_meta( get_the_ID(), 'price_original', true ) ); ?></span>
                                <?php endif; ?>
                            </div>
						<?php endif; ?>
					</a>

					<?php /* Fanxybox disabled for time being 
					<div style="display:none">
						<div id="<?php echo get_post_type(); ?>-data-<?php the_ID(); ?>">
							<?php the_content(); ?>
						</div>
					</div> */ ?>

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
