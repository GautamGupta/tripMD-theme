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

        <?php /*if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Review navigation', 'tripmd' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Reviews', 'tripmd' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Reviews &rarr;', 'tripmd' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation */ ?>

    </div>

</header>