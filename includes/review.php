<?php

/**
 * TripMD Hospital/Doctor Rating/Reviews
 *
 * @package TripMD
 * @subpackage Review
 */

/**
 * Return the array of rating_keys => rating_texts
 * for reviews
 */
function tmd_get_review_ratings_mapping() {
    return apply_filters( 'tmd_get_review_ratings_mapping', array(
        'quality' => __( 'Quality of Care', 'tripmd' ),
        'etiquette' => __( 'Doctor Etiquette', 'tripmd' ),
        'facility' => __( 'Quality of Facility', 'tripmd' )
    ) );
}

/**
 * Doctor review submission handler
 */
function tmd_review_doctor_handler() {
    global $wpdb;

    if ( !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_review_doctor_nonce' ) )
        tmd_add_error( 'nonce', __( 'Are you sure you\'re doing that?', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_name'] ) )
        tmd_add_error( 'required-name', __( 'Please provide your full name.', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_email'] ) || !is_email( $_POST['tmd_review_email'] ) )
        tmd_add_error( 'required-email', __( 'Please provide a valid email id.', 'tripmd' ) );
    // elseif ( $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}tmd_beta_users WHERE email = %s LIMIT 1", $_POST['tmd_review_email'] ) ) )
    //    tmd_add_error( 'exists-email', __( 'You\'ve already registered with this email id.', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_parent_id'] ) )
        tmd_add_error( 'required-parent', __( 'Sorry but what are you reviewing?', 'tripmd' ) );
    else {
        $parent = get_post( isset( $_POST['tmd_review_parent_id'] ) ? (int) $_POST['tmd_review_parent_id'] : 0 );
        if ( empty( $parent->comment_status ) || ! comments_open( $parent->ID ) || ! in_array( $parent->post_type, array( 'hospital', 'doctor' ) ) )
            tmd_add_error( 'required-parent', __( 'Sorry but what are you reviewing?', 'tripmd' ) );
    }

    if ( tmd_has_errors() )
        return;

    $comment_data = array(
        'comment_post_ID' => $parent->ID,
        'comment_author' => trim( strip_tags( $_POST['tmd_review_name'] ) ),
        'comment_author_email' => trim( $_POST['tmd_review_email'] ),
        'comment_author_url' => null,
        'comment_content' => trim( $_POST['tmd_review_comment'] ),
        'comment_type' => 'review',
        'comment_parent' => 0
    );

    $comment_id = wp_new_comment( $comment_data );
    if ( empty ( $comment_id ) ) {
        tmd_add_error( 'error-registration', __( 'There was a problem adding the review. Please try again or contact us at support@tripmd.com.', 'tripmd' ) );
    } else {

        // Sanitize ratings
        $rating = array();
        foreach ( array_keys( tmd_get_review_ratings_mapping() ) as $rating_key ) {
            $rating[$rating_key] = intval( !empty( $_POST['tmd_review_rating'][$rating_key] ) ? $_POST['tmd_review_rating'][$rating_key] : 0 );
        }

        // Add review meta
        add_comment_meta( $comment_id, 'tmd_review_nationality', trim( $_POST['tmd_review_nationality'] ), true );
        add_comment_meta( $comment_id, 'tmd_review_subscribe', !empty( $_POST['tmd_review_subscribe'] ) ? 1 : 0, true );
        add_comment_meta( $comment_id, 'tmd_review_rating', $rating, true );
    }
}

/**
 * Handle reviews listing
 */
function tmd_list_reviews( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    $ratings = get_comment_meta( get_comment_ID(), 'tmd_review_rating', true ); 
    $nationality = get_comment_meta( get_comment_ID(), 'tmd_review_nationality', true ); ?>

    <div <?php comment_class( 'grid-100' ); ?> id="comment-<?php comment_ID(); ?>" style="margin-left: 145px; padding-top: 30px;">
        
        <div class="grid-100">
            <h2><span class="user-img" style="background-image:url('http://0.gravatar.com/avatar/<?php echo md5( strtolower( trim( get_comment_author_email() ) ) ); ?>?s=50&amp;d=<?php echo urlencode( 'http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=50' ); ?>');"></span>
            <b><?php echo get_comment_author_link(); ?></b>
            <span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px"><?php if ( !empty( $nationality ) ) echo '(' . $nationality . ')'; ?></span>
            <span style="margin-left: 157px; opacity: 0.25"><?php echo comment_date(); ?></span></h2>
        </div>

        <?php foreach ( tmd_get_review_ratings_mapping() as $rating => $rating_text ) :
            if ( !isset( $ratings[$rating] ) ) continue; ?>

            <div class="grid-20">
                <div class="subtitle"><p><?php echo $rating_text; ?></p></div>
                <?php tmd_rating( $ratings[$rating] ); ?>
            </div>

        <?php endforeach; ?>

        <p class="grid-70"><?php echo get_comment_text(); ?></p>
    </div>

<?php }
