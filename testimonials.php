<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package tripmd
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One testimonial', '%1$s testimonials', get_comments_number(), 'testimonials title', 'tripmd' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Testimonial navigation', 'tripmd' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Testimonials', 'tripmd' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Testimonials &rarr;', 'tripmd' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
                    'avatar_size' => 64
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Testimonial navigation', 'tripmd' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Testimonials', 'tripmd' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Testimonials &rarr;', 'tripmd' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		/* if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'tripmd' ); ?></p>
	<?php endif; */ ?>

    <div class="grid-50">
        <?php
        $req = get_option( 'require_name_email' );
        $aria_req = $req == true ? ' required="required"' : '';
        $commenter = wp_get_current_commenter();

        comment_form( array(
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Testimonial (required)', 'noun' ) . '"></textarea></p>',
            'title_reply' => __( 'Please give your feedback', 'tripmd' ),
            'label_submit' => __( 'Submit Testimonial', 'tripmd' ),
            'fields' => array(
                'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . __( 'Name (required)', 'tripmd' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
                'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="' . __( 'Email (required, will not be published)', 'tripmd' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
                'url'    => '<p class="comment-form-url"><input id="url" name="url" type="url"  placeholder="' . __( 'Website', 'tripmd' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
            )
        ) ); ?>
    </div>

        <div style="clear:both"></div>

</div><!-- #comments -->
