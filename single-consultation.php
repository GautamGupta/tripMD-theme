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

	foreach ($date_wise_comments as $date => $comments) {
		$d1 = DateTime::createFromFormat("Y-m-d", $date);
		?>
		<div>
		<h1><?php echo $d1->format("M j"); ?></h1>
		<div id="comments">
			<?php
				foreach ($comments as $comment) {
					?>
					<p class="commment"><?php echo $comment->comment_content ?></p>
					<?php
				}
			?>
		</div>
		</div>
		<?php
	}
	?>
	</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
