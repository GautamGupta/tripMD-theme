<?php

/**
 * Enqueue media upload scripts
 * 
 * @todo Only do so on registration pages
 */
function tmd_registration_enqueue_media() {
    wp_enqueue_media();
}
add_action( 'wp_enqueue_scripts', 'tmd_registration_enqueue_media' );

/**
 * Add additional custom field
 */
function tmd_profile_extra_fields( $user ) { ?>
 
    <h2 class="entry-title">Personal Details</h2>
    <fieldset class="bbp-form">
        <div>
            <label for="dob">Date of birth</label>
            <input type="date" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />
        </div>
        <div>
            <label for="gender">Gender</label>
            <select name="gender" tabindex="<?php tmd_tab_index(); ?>">
              <option value="male" <?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'male') echo "selected";  ?>>Male</option>
              <option value="female"<?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'female') echo "selected";  ?>>Female</option>
            </select>
        </div>
    </fieldset>
 
    <h2 class="entry-title">Medical Details</h2>
    <fieldset class="bbp-form"> 
        <div>
            <label for="weight">Weight (in KGs)</label>
            <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />
        </div>
        <div>
            <label for="weight">Height (in CMs)</label>
            <input type="number" name="height" id="height" value="<?php echo esc_attr( get_the_author_meta( 'height', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />
        </div>

        <div>
            <label for="gobs">General Observations</label>
            <textarea name="gobs" id="gobs" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><?php echo esc_attr( get_the_author_meta( 'gobs', $user->ID ) ); ?></textarea><br/>
        </div>

        <div>
            <label for="allergies">Allergies</label><br/>
            <textarea name="allergies" id="allergies" class="regular-text"  tabindex="<?php tmd_tab_index(); ?>"><?php echo esc_attr( get_the_author_meta( 'allergies', $user->ID ) ); ?></textarea><br/>
        </div>
    </fieldset>

    <h2 class="entry-title">Medical Records</h2>
    <fieldset class="bbp-form"> 
        <ul>
            <?php
                $medicals = esc_attr( get_the_author_meta( 'medical_records', $user->ID ) );
                $medicals = json_decode( htmlspecialchars_decode( $medicals ), true );
                foreach ( (array) $medicals['mystuff'] as $medical_record ) {
                    echo '<li>' . $medical_record . '</li>';
                }
            ?>
        </ul>

        <div class="uploader">        
            <button name="medical_records_button" id="medical_records_button_old" value="Upload" tabindex="<?php tmd_tab_index(); ?>">Upload medical records</button>
        </div>

    </fieldset>

    <h2 id="appointments" class="entry-title">Appointments</h2>
    <fieldset class="bbp-form"> 
        <?php
            global $wp_session;
            $wp_session = WP_Session::get_instance();

            if ( !get_user_meta( bbp_get_current_user_id(), 'speciality_id', true ) && 
                 !empty( $wp_session['speciality_id'] ) ) {
                update_user_meta( bbp_get_current_user_id(), 'speciality_id', $wp_session['speciality_id'] );
            }
            if ( !get_user_meta( bbp_get_current_user_id(), 'procedure_id', true ) &&
                 !empty( $wp_session['procedure_id'] ) )
                update_user_meta( bbp_get_current_user_id(), 'procedure_id', $wp_session['procedure_id'] );
            if ( !get_user_meta( bbp_get_current_user_id(), 'hospital_id', true) &&
                 !empty( $wp_session['hospital_id'] ) )
                update_user_meta( bbp_get_current_user_id(), 'hospital_id', $wp_session['hospital_id'] );
            if ( !get_user_meta( bbp_get_current_user_id(), 'doctor_id', true) &&
                 !empty( $wp_session['doctor_id'] ) )
                update_user_meta( bbp_get_current_user_id(), 'doctor_id', $wp_session['doctor_id'] );
        ?>
        <?php if ( get_user_meta( bbp_get_current_user_id(), 'speciality_id', true) ) : ?>
            <?php if ( get_user_meta( bbp_get_current_user_id(), 'procedure_id', true ) ) : ?>
                <?php if ( get_user_meta( bbp_get_current_user_id(), 'hospital_id', true ) ) : ?>
                    <p>Book an <a href="/appointments/">appointment</a>.</p>
                <?php else : ?>
                    <p>Please select a hospital and a doctor (optional).</p>
                <?php endif; ?>
            <?php else : ?>
                <p>Please select a procedure, hospital and a doctor (optional).</p>
            <?php endif; ?>
        <?php else : ?>
            <p>Please select a <a href="http://tripmd.com/specialities/">speciality</a>, procedure, hospital and a doctor (optional).</p>
        <?php endif; ?>
        
        <h3>Past consultations:</h3>

        <?php $args = array(
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'author'          => bbp_get_current_user_id(),
            'post_type'        => 'consultation',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );
            $posts = get_posts($args);
            echo "<ul>";
            foreach($posts as $post) {
                echo "<li><a href=\"" . $post->guid . "\"/>" . $post->post_title . "</a></li>";
            }
            echo "</ul>";
        ?>
        <input name="medical_records" id="medical_records_files" value="" type="hidden">
    </fieldset>

<?php
}
add_action ( 'show_user_profile', 'tmd_profile_extra_fields' );
add_action ( 'edit_user_profile', 'tmd_profile_extra_fields' );

function tmd_profile_save_extra_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    
    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_user_meta( $user_id, 'dob', $_POST['dob'] );
    update_user_meta( $user_id, 'gender', $_POST['gender'] );
    update_user_meta( $user_id, 'weight', $_POST['weight'] );
    update_user_meta( $user_id, 'height', $_POST['height'] );
    update_user_meta( $user_id, 'gobs', $_POST['gobs'] );
    update_user_meta( $user_id, 'allergies', $_POST['allergies'] );
    $medicals = get_user_meta($user_id, 'medical_records', true);
    
    if ( !$medicals ||
         !json_decode(htmlspecialchars_decode($medicals), true)) { 
            update_user_meta( $user_id, 'medical_records', $_POST['medical_records'] );
    } else {
        $medicals = get_user_meta($user_id, 'medical_records', true);
        $medicals = json_decode(htmlspecialchars_decode($medicals), true);

        $new_medicals = $_POST['medical_records'];
        $new_medicals = str_replace('\"', '"', $new_medicals);
        $new_medicals = json_decode(htmlspecialchars_decode($new_medicals), true);

        $medicals['mystuff'] = array_merge($medicals['mystuff'], $new_medicals['mystuff']);
        update_user_meta( $user_id, 'medical_records', htmlspecialchars(json_encode($medicals)) );
    }
}
add_action ( 'personal_options_update', 'tmd_profile_save_extra_fields' );
add_action ( 'edit_user_profile_update', 'tmd_profile_save_extra_fields' );

/**
 * Add cutom fields to registration form
 */
function tmd_registration_extra_fields() {
?>
    <a id="step1" href="javascript:void(0);">Step 1</a> | <a id="step2" href="javascript:void(0);">Step 2</a>

    <div id="step1_container">

        <label for="dob">Date of birth</label>
        <input type="date" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />

        <label for="gender">Gender</label>
        <select name="gender" tabindex="<?php tmd_tab_index(); ?>">
          <option value="male" <?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'male') echo "selected"; ?>>Male</option>
          <option value="female"<?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'female') echo "selected";  ?>>Female</option>
        </select>
    </div>

    <div id="step2_container" style="display:none;">
        <label for="weight">Weight (in kgs)</label>
        <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />
        
        <label for="weight">Height (in cms)</label>
        <input type="number" name="height" id="height" value="<?php echo esc_attr( get_the_author_meta( 'height', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />

        <label for="gobs">General Observations</label>
        <textarea name="gobs" id="gobs" value="<?php echo esc_attr( get_the_author_meta( 'gobs', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /></textarea><br/>
        
        <label for="allergies">Allergies</label><br/>
        <textarea name="allergies" id="allergies" value="<?php echo esc_attr( get_the_author_meta( 'allergies', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" ></textarea><br/>
    </div>

    <script type="text/javascript">
    var current = 1;
    jQuery("#step1").click(function(e) {
        if (current == 1) return;
        else {
            jQuery("#step1_container").css("display", "block");
            jQuery("#step2_container").css("display", "none");
            current = 1;
        }
    });
    jQuery("#step2").click(function(e) {
        if (current == 2) return;
        else {
            jQuery("#step1_container").css("display", "none");
            jQuery("#step2_container").css("display", "block");
            current = 2;
        }
    });
    </script>

<?php
}
add_action( 'register_form', 'tmd_registration_extra_fields' );

function tmd_registration_validate_extra_fields( $login, $email, $errors ) {
    /* if ( $_POST['name'] == '' )
        $errors->add( 'empty_fullname', "<strong>ERROR</strong>: Please enter your full name." ); */

    /* 
    if ( $_POST['dob'] == '' )
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Date of Birth." );

    if ( $_POST['gender'] == '' )
        $errors->add( 'empty_gender', "<strong>ERROR</strong>: Please Enter your gender." );
    
    if ( $_POST['weight'] == '' )
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Weight." );

    if ( $_POST['height'] == '' )
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Height." );

    if ( $_POST['gobs'] == '' )
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your General Observations about your condition." );

    if ( $_POST['allergies'] == '' )
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your past allergies." );
    */
}
// add_action( 'register_post', 'tmd_registration_validate_extra_fields', 10, 3 );

function tmd_registration_save_extra_fields( $user_id, $password = '', $meta = array() ) {
    update_user_meta( $user_id, 'dob', $_POST['dob'] );
    update_user_meta( $user_id, 'gender', $_POST['gender'] );
    update_user_meta( $user_id, 'weight', $_POST['weight'] );
    update_user_meta( $user_id, 'height', $_POST['height'] );
    update_user_meta( $user_id, 'gobs', $_POST['gobs'] );
    update_user_meta( $user_id, 'allergies', $_POST['allergies'] );

    if ( !class_exists( 'WP_Session' ) ) // Requires WP Session plugin
        return;

    $wp_session = WP_Session::get_instance();

    // Do we need session -- only on single pages of reqd types
    if ( !is_single() || ( is_single() && !in_array( get_post_type(), array( 'speciality', 'procedure', 'hospital', 'doctor' ) ) ) )
        return;

    if ( !empty( $wp_session['speciality_id'] ) )
        update_user_meta( $user_id, 'speciality_id', $wp_session['speciality_id'] );
    if ( !empty( $wp_session['procedure_id'] ) )
        update_user_meta( $user_id, 'procedure_id',  $wp_session['procedure_id']  );
    if ( !empty( $wp_session['hospital_id'] ) )
        update_user_meta( $user_id, 'hospital_id',   $wp_session['hospital_id']   );
    if ( !empty( $wp_session['doctor_id'] ) )
        update_user_meta( $user_id, 'doctor_id',     $wp_session['doctor_id']     );
}
add_action( 'user_register', 'tmd_registration_save_extra_fields' );

/**
 * Set the username as the email id on registration form submission
 */
function tmd_registration_handler() {
    if ( empty( $_POST['user_email'] ) ||
        ( ( empty( $_POST['tmd_home_register'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_home_register' ) ) // Homepage reg
        && ( empty( $_POST['action'] ) || 'register' != $_POST['action'] )                                        // /register page
        )
     )
        return false;

    $_POST['user_login'] = $_POST['user_email'];

    if ( !empty( $_POST['name'] ) ) { // /register page has single 'name' field, this splits it into fn and ln
        $name = tmd_split_name( $_POST['name'] );
        $_POST['first_name'] = $name['first'];
        $_POST['last_name']  = $name['last'];
        $_POST['nickname']   = $name['first'];
    }

    add_filter( 'pre_user_first_name', 'tmd_registration_handler_fn' );
    add_filter( 'pre_user_last_name',  'tmd_registration_handler_ln' );
    add_filter( 'pre_user_nickname',   'tmd_registration_handler_nn' );
}
add_action( 'template_redirect', 'tmd_registration_handler', -10 );

    /**
     * Set the username to email id unless we're in the admin section
     */
    function tmd_registration_handler_login( $username = '' ) {
        return !empty( $_POST['user_email'] ) && !is_admin() ? sanitize_user( trim( $_POST['user_email'] ) ) : $username;
    }
    add_filter( 'pre_user_login', 'tmd_registration_handler_login' ); // Always force

    /**
     * Return the first name in the post paramater
     */
    function tmd_registration_handler_fn( $firstname = '' ) {
        return !empty( $_POST['first_name'] ) ? sanitize_user( trim( $_POST['first_name'] ) ) : $firstname;
    }

    /**
     * Return the last name in the post paramater
     */
    function tmd_registration_handler_ln( $lastname = '' ) {
        return !empty( $_POST['last_name'] ) ? sanitize_user( trim( $_POST['last_name'] ) ) : $lastname;
    }

    /**
     * Return the nickname in the post paramater
     */
    function tmd_registration_handler_nn( $nickname = '' ) {
        return !empty( $_POST['nickname'] ) ? sanitize_user( trim( $_POST['nickname'] ) ) : $nickname;
    }

/**
 * Hospital signup handler
 */
function tmd_register_hospital_handler() {
    if ( empty( $_POST['hsign'] ) )
        return false;

    if ( empty( $_POST['medical_centre'] ) ||  empty( $_POST['country'] ) ||  empty( $_POST['poc'] ) || empty( $_POST['email'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_home_register' ) ) {
        wp_redirect( home_url( '?hsign=error#hs' ) );
        exit;
    }

    $new_clinic = array(
        'post_title' => $_POST['medical_centre'],
        'post_status' => 'draft',
        'post_type' => 'hospital'
    );
    $post_id = wp_insert_post( $new_clinic );
    
    add_post_meta( $post_id, 'country', trim( $_POST['country'] ) );
    add_post_meta( $post_id, 'poc', trim( $_POST['poc'] ) );
    add_post_meta( $post_id, 'email', trim( $_POST['email'] ) );
    
    wp_redirect( home_url( '?hsign=success#hs' ) );
    exit;
}
add_action( 'init', 'tmd_register_hospital_handler' );

/**
 * Beta signup handler for /invitation
 */
function tmd_invitation_register_handler() {
    global $wpdb;

    if ( !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_invitation_register_nonce' ) )
        tmd_add_error( 'nonce', __( 'Are you sure you\'re doing that?', 'tripmd' ) );

    if ( empty( $_POST['tmd_bs_name'] ) )
        tmd_add_error( 'required-name', __( 'Please provide your full name.', 'tripmd' ) );

    if ( empty( $_POST['tmd_bs_email'] ) || !is_email( $_POST['tmd_bs_email'] ) )
        tmd_add_error( 'required-email', __( 'Please provide a valid email id.', 'tripmd' ) );
    elseif ( $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}tmd_beta_users WHERE email = %s LIMIT 1", $_POST['tmd_bs_email'] ) ) )
        tmd_add_error( 'exists-email', __( 'You\'ve already registered with this email id.', 'tripmd' ) );

    if ( tmd_has_errors() )
        return;

    $registered = $wpdb->insert( 
        "{$wpdb->prefix}tmd_beta_users", 
        array( 
            'name' => $_POST['tmd_bs_name'], 
            'email' => $_POST['tmd_bs_email'], 
            'phone' => !empty( $_POST['tmd_bs_phone'] ) ? $_POST['tmd_bs_phone'] : '', 
            'condition' => ( !empty( $_POST['tmd_bs_inquiry_for'] ) ? ( $_POST['tmd_bs_inquiry_for'] . ": " ) : '' ) . ( !empty( $_POST['tmd_bs_condition'] ) ? $_POST['tmd_bs_condition'] : '' ), 
            'registered' => date( 'Y-m-d H:i:s' )
        ), 
        '%s'
    );

    if ( empty( $registered ) )
        tmd_add_error( 'error-registration', __( 'There was a problem registering you. Please try again or contact us at support@tripmd.com.', 'tripmd' ) );
}

function tmd_consultation_document_upload() {
    if ( !wp_verify_nonce( $_GET['nonce'], 'document_upload' ) ) {
        die( __( 'Are you sure you\'re doing that?', 'tripmd' ) );  
    }

    $data = array(
        'comment_content' => $_GET['aid'],
        'comment_type' => 'document_upload',
        'comment_post_ID' => intval( $_GET['pid'] ),
        'user_id' => get_current_user_id(),
        'comment_approved' => 1,
    );

    wp_new_comment( $data );

    die();
}
add_action( 'wp_ajax_documentUploadCB', 'tmd_consultation_document_upload' );
add_action( 'wp_ajax_nopriv_documentUploadCB', 'tmd_consultation_document_upload' );

/**
 * Splits single name string into salutation, first, last, suffix
 * 
 * Taken from http://stackoverflow.com/questions/8808902/best-way-to-split-a-first-and-last-name-in-php/14420217#14420217
 * 
 * @param string $name
 * @return array
 */
function tmd_split_name( $name ) {
    $results = array();

    $r    = explode( ' ', $name );
    $size = count( $r );

    // check first for period, assume salutation if so
    if ( mb_strpos( $r[0], '.' ) === false ) {
        $results['salutation'] = '';
        $results['first']      = $r[0];
    } else {
        $results['salutation'] = $r[0];
        $results['first']      = $r[1];
    }

    // check last for period, assume suffix if so
    if ( mb_strpos( $r[$size - 1], '.' ) === false )
        $results['suffix'] = '';
    else
        $results['suffix'] = $r[$size - 1];

    //combine remains into last
    $start = $results['salutation'] ? 2 : 1;
    $end   = $results['suffix'] ? $size - 2 : $size - 1;

    $last = '';
    for ( $i = $start; $i <= $end; $i++ )
        $last .= ' ' . $r[$i];
    
    $results['last'] = trim( $last );

    return $results;
}
