<?php
/**
 * The template for displaying doctor reviews.
 *
 * @package TripMD
 */

/*
 * If the current is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() || !have_comments() )
	return;
?>

<header class="reviews" id="reviews">
    
    <div class="grid-container">

        <h1 style="margin-bottom: 0"><?php _e( 'Reviews', 'tripmd' ); ?></h1>

        <?php
            wp_list_comments( array(
                'type'     => tripmd()->review_id,
                'callback' => 'tmd_list_reviews'
            ) );
        ?>

    </div>

</header>