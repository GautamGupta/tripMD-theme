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

        <div class="block">

            <div class="card">

                <?php while ( have_posts() ) : the_post(); ?>

                <div class="welcome">

                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" class="logo image" /></a>
                    </div>

                    <?php
                    if ( did_action( 'tmd_post_request_review_doctor' ) ) :
                        if ( tmd_has_errors() ) :
                            foreach ( tmd_get_errors() as $tmd_error ) : ?>
                                <p class="error"><?php _e( '<i class="fa warn fa-exclamation-triangle"></i>', 'tripmd' ); ?> <?php echo $tmd_error; ?></p>
                            <?php endforeach;
                        else : $dont_display_form = 1; ?>
                            <p class="success">
                                <?php _e( 'Thank you for submitting your review. Your feedback is valuable to us.', 'tripmd' ); ?><br /><br />
                                <?php printf( __( 'You can call us 24x7 at +1-415-528-8650 or email us at <a href="mailto:support@tripmd.com" class="green-t">support@tripmd.com</a> to know more about <a href="%1$s" class="green-t">TripMD</a>.', 'tripmd' ), site_url() ); ?>
                            </p>
                        <?php endif;
                    endif; ?>

                </div>

                <?php if ( empty( $dont_display_form ) ) : ?>

                    <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar' ) ); ?>

                    <h2><?php printf( __( 'Write a review for %s', 'tripmd' ), get_the_title() ); ?></h2>

                    <div class="form">

                        <form method="post" id="review-form">
                            
                            <div class="name fld">
                                <input type="text" name="tmd_review_name" placeholder="<?php _e( 'Full Name', 'tripmd' ); ?>" class="name field" required="required" data-icon="\f007" value="<?php tmd_sanitize_val( 'tmd_review_name' ); ?>" tabindex="<?php tmd_tab_index(); ?>" />
                                <i class="fa fa-user"></i>
                            </div>
                            
                            <div class="email fld">
                                <input type="email" name="tmd_review_email" placeholder="<?php _e( 'Email', 'tripmd' ); ?>" class="email field" required="required" data-icon="\f007" value="<?php tmd_sanitize_val( 'tmd_review_email' ); ?>" tabindex="<?php tmd_tab_index(); ?>" />
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
                                <strong><?php _e( 'Rating', 'tripmd' ); ?></strong><br />
                                <?php foreach ( array( 'communication' => __( 'Communication', 'tripmd' ), 'friendliness' => __( 'Friendliness', 'tripmd' ), 'overall' => __( 'Overall', 'tripmd' ) ) as $key => $display_text ) : ?>
                                    <?php echo $display_text; ?>
                                    1
                                    <?php for ( $rad_val = 1; $rad_val <= 5; $rad_val++ ) : ?>
                                        <input type="radio" name="tmd_review_rating[<?php echo $key; ?>]" tabindex="<?php tmd_tab_index(); ?>" value="<?php echo $rad_val; ?>"<?php checked( ( !empty( $_POST['tmd_review_rating'][$key] ) ? $_POST['tmd_review_rating'][$key] : '' ), $rad_val ); ?> />
                                    <?php endfor; ?>
                                    5<br />
                                <?php endforeach; ?>
                            </div>
                            
                            <input type="checkbox" name="tmd_review_subscribe" id="tmd_review_subscribe" tabindex="<?php tmd_tab_index(); ?>" value="1"<?php checked( tmd_get_sanitize_val( 'tmd_review_subscribe', 'checkbox' ), 1 ); ?> /><label for="tmd_review_subscribe"><?php printf( __( 'Also subscribe me to <a href="%1$s" class="green-t">TripMD</a> updates, a startup with a mission to simplify medical travel. <a href="%1$s" class="green-t">Learn more</a>.', 'tripmd' ), site_url() ); ?></label>

                            <input type="hidden" name="action" value="review_doctor" />
                            <input type="hidden" name="tmd_review_parent_id" value="<?php the_ID(); ?>" />
                            <?php wp_nonce_field( 'tmd_review_doctor_nonce' ); ?>

                            <a href="#" class="big fat green button submit" onclick="document.getElementById('review-form').submit();" tabindex="<?php tmd_tab_index(); ?>"><?php _e( 'Submit Review', 'tripmd' ); ?></a>

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
