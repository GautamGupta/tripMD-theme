<?php
/**
 * The template for displaying the consultations.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="content">

	<?php $args = array(
		'author_email' => '',
		'ID' => '',
		'karma' => '',
		'number' => '',
		'offset' => '',
		'orderby' => '',
		'order' => 'DESC',
		'parent' => '',
		'post_id' => get_the_ID(),
		'post_author' => '',
		'post_name' => '',
		'post_parent' => '',
		'post_status' => '',
		'post_type' => '',
		'status' => '',
		'type' => '',
		'user_id' => '',
		'search' => '',
		'count' => false,
		'meta_key' => '',
		'meta_value' => '',
		'meta_query' => '',
	);
	$date_wise_comments = Array();
	$comments = get_comments($args);
	foreach ($comments as $comment) {
		$date = split(" ", $comment->comment_date)[0];
		if (array_key_exists($date, $date_wise_comments)) {
			array_push($date_wise_comments[$date], $comment);
		} else {
			$date_wise_comments[$date] = [$comment];
		}
	}
	ksort($date_wise_comments);
	?>
	<div class="container">
			<div class="main">
				<ul class="cbp_tmtimeline">
						<li>
							<time class="cbp_tmtime" datetime="<?php get_the_date(); ?>"><span><?php echo get_the_date(); ?></span></time>
							<div class="cbp_tmicon"></div>
							<div class="cbp_tmlabel">
								<h2>Patient requests the appointment dates</h2>
								<p><b>Notes from the patient:</b> <?php the_content(); ?></p>
								<p><b>Appointment dates requested:</b></p>
								<ul>
									<?php
										$dates = unserialize(get_post_meta(get_the_ID(), 'dates', true));
										foreach ($dates as $date) {
											echo "<li>" . $date . "</li>";
										}
									?>
								</ul>
							</div>
						</li>
				<?php
					foreach ($date_wise_comments as $date => $comments) {
						$d1 = DateTime::createFromFormat("Y-m-d", $date);
						?>
						<li>
						<time class="cbp_tmtime" datetime="<?php $d1->format("Y-m-j") ?>"><span><?php echo $d1->format("M j"); ?></span></time>
						<div class="cbp_tmicon"></div>
						<div class="cbp_tmlabel">
							<?php
								foreach ($comments as $comment) {
									?>
									<div class="commment">
									<?php if ($comment->comment_author == "tripmd_doctor") : ?>
										<span class="doctor"><?php echo $comment->comment_content; ?></span>
									</div>
									<?php elseif ($comment->comment_author == "tripmd") : ?>
										<span class="tripmd"><?php echo $comment->comment_content; ?></span>
									<?php else : ?>
										<span class="patient"><?php echo $comment->comment_content; ?></span>
									<?php endif; ?>
									<?php
								}
							?>
						</div>
						</li>
				<?php
					}
				?>
				</ul>
		</div>
	</div>
	<?php comment_form(); ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>