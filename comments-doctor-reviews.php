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
if ( post_password_required() ) {
	return;
}
?>

<header class="reviews" id="reviews">
    
    <div class="grid-container">

    <?php if ( have_comments() ) : ?>

        <h1 style="margin-bottom: 0">
        	<?php /* printf( _nx( 'One testimonial for &ldquo;%2$s&rdquo;', '%1$s testimonials for &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'tripmd' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); */ ?>
                Reviews
		</h1>

		<?php /*
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		*/ ?>

        <div class="grid-100" style="margin-left: 145px; padding-top: 30px;">
            
            <div class="grid-100"><h2><span class="user-img" style="background-image:url('http://api.randomuser.me/portraits/med/women/40.jpg');"></span><b>Brenda A.</b><span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px">(verified patient)</span><span style="margin-left: 157px; opacity: 0.25">July 4, 2014</span></h2></div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Overall</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>

            </div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Communication</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>

            </div>

            <div class="grid-20 push-5">
                
                <div class="subtitle"><p>Friendliness</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>

            </div>

            <p class="grid-70">I was extremely happy with my dental surgery experience with TripMD. Dr. Batra’s had an amazing clinic and she made me feel comfortable throughout the entire duration of my surgery. The folks at TripMD also helped me throughout the duration of my surgery and took care of everything from my local transportation around Delhi, my accommodations at a beautiful guesthouse and my flights. I’m still in touch with Dr. Batra and will be referring more friends to her and TripMD!</p>

        </div>

        <div class="grid-100" style="margin-left: 145px; padding-top: 30px;">
            
            <div class="grid-100"><h2><span class="user-img" style="background-image:url('http://api.randomuser.me/portraits/med/men/1.jpg');"></span><b>Sean T.</b><span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px">(verified patient)</span><span style="margin-left: 190px; opacity: 0.25">July 7, 2014</span></h2></div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Overall</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>

            </div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Communication</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>

            </div>

            <div class="grid-20 push-5">
                
                <div class="subtitle"><p>Friendliness</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>

            </div>

            <p class="grid-70">Dr. Batra has done a reassuringly superb job as our dentist. She has always been prompt and attentive, and has often worked us into her schedule at the last minute. She has a light, gentle touch and is well versed in the most up-to-date Western dental techniques. We have been pleased with the quality of dental care received.</p>

        </div>

        <div class="grid-100" style="margin-left: 145px; padding-top: 30px;">
            
            <div class="grid-100"><h2 id="graham"><span class="user-img" style="background-image:url('http://api.randomuser.me/portraits/med/men/9.jpg');"></span><b>Graham B.</b><span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px">(verified patient)</span><span style="margin-left: 150px; opacity: 0.25">July 3, 2014</span></h2></div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Overall</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>

            </div>

            <div class="grid-20">
                
                <div class="subtitle"><p>Communication</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>

            </div>

            <div class="grid-20 push-5">
                
                <div class="subtitle"><p>Friendliness</p></div>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>

            </div>

            <p class="grid-70">While her professional skills are commendable, we certainly did not expect to find a dentist who would offer such warmth, affection and personal touches, sentiments that we have tried to reciprocate. We have truly appreciated that pre-appointment reminder call, but more important the followup calls from you and your team. Even if sometimes things got a little uncomfortable, your hand on the shoulder provided the reassurance and even the courage to get through the treatment. And of course, the results were always worth it.</p>

        </div>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'tripmd' ); ?></p>

	<?php endif; ?>

    </div>

</header>