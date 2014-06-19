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
	<?php if ( !post_password_required( get_the_ID() ) ) : ?>

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
									if ($comment->comment_type == "document_upload") {
										// comment is actually an attachment
										$post = get_post($comment->comment_content);
										?>
										<div class="att">
											<hr/>
											<a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a> uploaded.
											<hr/>
										</div>
										<?php
										continue;
									}
									?>
									<div class="commment">
									<?php if ( $comment->user_id == "0" ) : // if we have a comment using the comment form (not-signed-in) we assume the user to be the doctor ?>
										<span class="doctor">Doctor: <?php echo $comment->comment_content; ?></span>
									<?php elseif ($comment->comment_author == "tripmd_doctor") : ?>
										<span class="doctor">Doctor: <?php echo $comment->comment_content; ?></span>
									<?php elseif ( get_the_author_meta('ID') == $comment->user_id ) : ?>
										<span class="patient">Patient: <?php echo $comment->comment_content; ?></span>
									<?php else : ?>
										<span class="tripmd">TripMD: <?php echo $comment->comment_content; ?></span>
									<?php endif; ?>
									</div>

									<?php
								}
							?>
						</div>
						</li>
				<?php
					}
				?>
				</ul>
			    <div class="uploader">
			    	<?php wp_nonce_field('document_upload', 'document_nonce'); ?>
    				<button name="medical_records_button" id="medical_records_button" value="Upload">Upload medical records</button>
				</div>
		</div>
	</div>
	<?php comment_form(); ?>
	<?php else : ?>
		<?php echo get_the_password_form(); ?>
	<?php endif; ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>