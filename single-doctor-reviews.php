<?php 
/**
 * Invitation Page
 *
 * @package TripMD
 * @subpackage Template
 */
?><!DOCTYPE html>
<html class="beta" <?php language_attributes(); ?>>
    <head>

        <title><?php wp_title( '&middot;', true, 'right' ); ?></title>

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/unsemantic.css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/home.css">

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/js.js"></script>

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon.ico">

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimal-ui">

    </head>

    <body <?php body_class( 'beta' ); ?>>

        <div class="block full-width-form review">

            <div class="card info grid-container">

                <div class="logo grid-100">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image" /></a>
                </div>

                <div class="welcome">

                    <?php
                    if ( did_action( 'tmd_post_request_review_doctor' ) ) :
                        if ( tmd_has_errors() ) :
                            foreach ( tmd_get_errors() as $tmd_error ) : ?>
                                <p class="error"><?php _e( '<i class="fa warn fa-exclamation-triangle"></i>', 'tripmd' ); ?> <?php echo $tmd_error; ?></p>
                            <?php endforeach;
                        else : $dont_display_form = 1; ?>
                            <p class="success">
                                <?php _e( 'Thank you for submitting your review. Your feedback is valuable to us.', 'tripmd' ); ?><br />
                                <?php printf( __( 'You can call us 24x7 at +91-83770-12073 or email us at <a href="mailto:support@tripmd.com" class="green-t">support@tripmd.com</a> to know more about <a href="%1$s" class="green-t">TripMD</a>.', 'tripmd' ), site_url() ); ?>
                            </p>
                        <?php endif;
                    endif; ?>

                </div>

                <div class="intro grid-50">

                <?php while ( have_posts() ) : the_post(); ?>

                <?php if ( empty( $dont_display_form ) ) : ?>

                    <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar' ) ); ?>

                    <h2><?php printf( __( 'Write a review for %s', 'tripmd' ), '<br /><a href="' . get_permalink() . '"><span class="doc-name">' . get_the_title() .'</span></a>' ); ?></h2>
                    
                    <?php @list( $salutation, $first_name, $last_name ) = explode( ' ', get_the_title() ); ?>
                    <p class="yeh-vala"><?php printf( __( 'Your physician, %1$s, has been selected to be featured on %3$s, a highly curated platform aimed at helping expats access high quality healthcare in foreign cities. Recognized as one of New Delhi’s best doctors by the local expatriate and diplomatic communities, we are looking to spread the word of Dr. %2$s’s great practice.' ), get_the_title(), !empty( $last_name ) ? $last_name : $first_name, get_bloginfo( 'blogname' ) ); ?></p>

                    <p><?php printf( __( 'We put emphasis on transparency at %3$s, and receiving your feedback on your treatment experience with Dr. %2$s will go a long way towards informing other prospective patients. Dr. %2$s and %3$s kindly ask for you to fill out the following review form. If you have any questions about the review process or want to learn more about what we are building at %3$s, please reach out to <a href="mailto:support@tripmd.com">support@tripmd.com</a> and we will get back to you as soon as possible!' ), $first_name . ' ' . $last_name, !empty( $last_name ) ? $last_name : $first_name, get_bloginfo( 'blogname' ) ); ?></p>

                </div>

                <div class="form grid-45 push-5">

                    <form method="post" id="review-form">
                        
                        <div class="name fld">
                            <input type="text" name="tmd_review_name" placeholder="<?php _e( 'Full Name', 'tripmd' ); ?>" class="name field" required="required" data-icon="\f007" value="<?php tmd_sanitize_val( 'tmd_review_name', 'text', wp_get_current_user()->display_name ); ?>" tabindex="<?php tmd_tab_index(); ?>" />
                            <i class="fa fa-user"></i>
                        </div>
                        
                        <div class="email fld">
                            <input type="email" name="tmd_review_email" placeholder="<?php _e( 'Email', 'tripmd' ); ?>" class="email field" required="required" data-icon="\f007" value="<?php tmd_sanitize_val( 'tmd_review_email', 'text', wp_get_current_user()->user_email ); ?>" tabindex="<?php tmd_tab_index(); ?>" />
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        
                        <div class="nationality fld">
                            <input type="text" name="tmd_review_nationality" placeholder="<?php _e( 'Nationality', 'tripmd' ); ?>" class="nationality field" data-icon="\f007" value="<?php tmd_sanitize_val( 'tmd_review_nationality' ); ?>" tabindex="<?php tmd_tab_index(); ?>" />
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        
                        <div class="comment fld">
                            <textarea name="tmd_review_comment" placeholder="<?php _e( 'Write a review...', 'tripmd' ); ?>" class="treatment field" data-icon="\f007" onkeyup="expandtext(this);" rows="2" tabindex="<?php tmd_tab_index(); ?>"><?php tmd_sanitize_val( 'tmd_review_comment', 'textarea' ); ?></textarea>
                            <i class="fa fa-comment-o"></i>
                        </div>
                        
                        <div class="rating fld">
                            <i class="fa fa-star-o"></i>
                            <strong id="rat-text"><?php _e( 'Rating', 'tripmd' ); ?></strong><br />
                            <fieldset class="rat-star">
                                <?php foreach ( tmd_get_review_ratings_mapping() as $key => $display_text ) : ?>
                                    <span class="rat-title"><?php echo $display_text; ?></span>
                                    <fieldset class="rat-star <?php echo $key; ?>">
                                        <legend><?php _e( 'Please rate:', 'tripmd' ); ?></legend>
                                        <?php 
                                        foreach ( array_reverse( array( 1 => __( 'Bad experience', 'tripmd' ), 2 => __( 'Not upto the mark', 'tripmd' ), 3 => __( 'Fair', 'tripmd' ), 4 => __( 'Good!', 'tripmd' ), 5 => __( 'Would definitely recommend!', 'tripmd' ) ), true /* preserve keys in reverse */ ) as $rad_val => $label_text ) : ?>
                                            <input type="radio" id="<?php echo 'tmd_review_rating_' . $key . '_' . $rad_val; ?>" name="tmd_review_rating[<?php echo $key; ?>]" tabindex="<?php tmd_tab_index(); ?>" value="<?php echo $rad_val; ?>"<?php checked( ( !empty( $_POST['tmd_review_rating'][$key] ) ? $_POST['tmd_review_rating'][$key] : '' ), $rad_val ); ?> />
                                            <label for="<?php echo 'tmd_review_rating_' . $key . '_' . $rad_val; ?>" title="<?php echo $label_text; ?>"><?php echo $label_text; ?></label>
                                        <?php endforeach; ?>
                                    </fieldset>
                                    <br />
                                <?php endforeach; ?>
                            </fieldset>
                        </div>

                        <input type="hidden" name="action" value="review_doctor" />
                        <input type="hidden" name="tmd_review_parent_id" value="<?php the_ID(); ?>" />
                        <?php wp_nonce_field( 'tmd_review_doctor_nonce' ); ?>

                        <a href="#" class="big fat green button submit" onclick="document.getElementById('review-form').submit();" tabindex="<?php tmd_tab_index(); ?>"><?php _e( 'Submit Review', 'tripmd' ); ?></a>

                        <div class="t-center t-small t-gray"><input checked type="checkbox" name="tmd_review_subscribe" id="tmd_review_subscribe" tabindex="<?php tmd_tab_index(); ?>" value="1"<?php checked( tmd_get_sanitize_val( 'tmd_review_subscribe', 'checkbox' ), 1 ); ?> /><label for="tmd_review_subscribe"><?php printf( __( 'I would like TripMD to keep me updated on their launch. I know they will not spam me. <a href="%1$s" class="green-t">Learn more</a>.', 'tripmd' ), site_url() ); ?></label></div>

                        <input type="submit" hidden>

                    </form>

                </div>

                <?php endif; ?>

                <?php endwhile; // end of the loop. ?>

            </div>
        
         </div>

        <?php wp_footer(); ?>

        <script type="text/javascript" src="//use.typekit.net/jlx8kbu.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    </body>

</html>
