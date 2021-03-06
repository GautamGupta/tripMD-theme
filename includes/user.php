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
function tmd_profile_extra_fields( $user ) {
    global $wpdb;

    $inquiries = $wpdb->get_results(
        $wpdb->prepare(
            "
            SELECT id, speciality_id, doctor_id, description, appt_date, registered
            FROM {$wpdb->prefix}tmd_beta_users
            WHERE user_id = %d
            ",
            $user->ID
        )
    );

    if ( !empty( $inquiries )  ) : ?>
 
        <h2 class="entry-title"><?php _e( 'Appointments', 'tripmd' ); ?></h2>

        <table id="inquiries">
            <tr>
                <th><?php _e( 'Doctor', 'tripmd' ); ?></th>
                <th><?php _e( 'Appointment Date', 'tripmd' ); ?></th>
            </tr>
            <?php foreach ( $inquiries as $inquiry ) : ?>
                <tr>
                    <td>
                        <?php if ( empty( $inquiry->doctor_id ) ) : ?>
                            <?php _e( 'General Inquiry', 'tripmd' ); ?>
                        <?php else : ?>
                            <a href="<?php echo get_permalink( $inquiry->doctor_id ); ?>"><?php echo get_the_title( $inquiry->doctor_id ); ?></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( empty( $inquiry->appt_date ) || '0000-00-00' == $inquiry->appt_date ) : ?>
                            <?php _e( 'No specific date', 'tripmd' ); ?>
                        <?php else : ?>
                            <?php echo date( 'F j, Y', strtotime( $inquiry->appt_date ) ); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endif; ?>
 
    <h2 class="entry-title"><?php _e( 'Personal Details', 'tripmd' ); ?></h2>
    <fieldset class="bbp-form">
        <div>
            <label for="dob"><?php _e( 'Date of Birth', 'tripmd' ); ?></label>
            <input type="date" name="tmd_profile_dob" id="dob" max="<?php echo date( 'Y-m-d', strtotime( '-13 years' ) ); ?>" min="1900-01-01" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />
        </div>
        <div>
            <label for="gender"><?php _e( 'Gender', 'tripmd' ); ?></label>
            <select name="tmd_profile_gender" tabindex="<?php tmd_tab_index(); ?>">
                <option value="male" <?php selected( get_the_author_meta( 'gender', $user->ID ), 'male' ); ?>><?php _e( 'Male' ); ?></option>
                <option value="female" <?php selected( get_the_author_meta( 'gender', $user->ID ), 'female' ); ?>><?php _e( 'Female' ); ?></option>
            </select>
        </div>
    </fieldset>

    <?php /*
 
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

            if ( !get_user_meta( get_current_user_id(), 'speciality_id', true ) && 
                 !empty( $wp_session['speciality_id'] ) ) {
                update_user_meta( get_current_user_id(), 'speciality_id', $wp_session['speciality_id'] );
            }
            if ( !get_user_meta( get_current_user_id(), 'procedure_id', true ) &&
                 !empty( $wp_session['procedure_id'] ) )
                update_user_meta( get_current_user_id(), 'procedure_id', $wp_session['procedure_id'] );
            if ( !get_user_meta( get_current_user_id(), 'hospital_id', true) &&
                 !empty( $wp_session['hospital_id'] ) )
                update_user_meta( get_current_user_id(), 'hospital_id', $wp_session['hospital_id'] );
            if ( !get_user_meta( get_current_user_id(), 'doctor_id', true) &&
                 !empty( $wp_session['doctor_id'] ) )
                update_user_meta( get_current_user_id(), 'doctor_id', $wp_session['doctor_id'] );
        ?>
        <?php if ( get_user_meta( get_current_user_id(), 'speciality_id', true) ) : ?>
            <?php if ( get_user_meta( get_current_user_id(), 'procedure_id', true ) ) : ?>
                <?php if ( get_user_meta( get_current_user_id(), 'hospital_id', true ) ) : ?>
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
            'author'           => get_current_user_id(),
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

    */ ?>

<?php
}
add_action ( 'show_user_profile', 'tmd_profile_extra_fields' );
add_action ( 'edit_user_profile', 'tmd_profile_extra_fields' );

function tmd_profile_save_extra_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    if ( empty( $_POST['tmd_profile_dob'] ) )
        delete_user_meta( $user_id, 'dob' );
    elseif ( date( 'Y-m-d', strtotime( tmd_get_sanitize_val( 'tmd_profile_dob' ) ) ) == tmd_get_sanitize_val( 'tmd_profile_dob' ) && tmd_get_sanitize_val( 'tmd_profile_dob' ) <= date( 'Y-m-d', strtotime( '-13 years' ) ) )
        update_user_meta( $user_id, 'dob', tmd_get_sanitize_val( 'tmd_profile_dob' ) );
    else
        tmd_add_error( 'profile-invalid-dob', __( 'Please provide a valid date of birth. You must be at least 13 years old to register.', 'tripmd' ) );

    if ( empty( $_POST['tmd_profile_gender'] ) )
        delete_user_meta( $user_id, 'gender' );
    elseif ( in_array( tmd_get_sanitize_val( 'tmd_profile_gender' ), array( 'male', 'female' ) ) )
        update_user_meta( $user_id, 'gender', tmd_get_sanitize_val( 'tmd_profile_gender' ) );
    else
        tmd_add_error( 'profile-invalid-gender', __( 'Please provide a valid gender.', 'tripmd' ) );

    /* update_user_meta( $user_id, 'weight', $_POST['weight'] );
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
    } */
}
add_action ( 'personal_options_update', 'tmd_profile_save_extra_fields' );
add_action ( 'edit_user_profile_update', 'tmd_profile_save_extra_fields' );

/**
 * Add cutom fields to registration form
 */
function tmd_registration_extra_fields() {
    $user = get_current_user(); ?>
    <?php /* <a id="step1" href="javascript:void(0);">Step 1</a> | <a id="step2" href="javascript:void(0);">Step 2</a> */ ?>

    <div id="step1_container">

        <label for="dob"><?php _e( 'Date of Birth', 'tripmd' ); ?></label>
            <input type="date" name="tmd_profile_dob" id="dob" max="<?php echo date( 'Y-m-d', strtotime( '-13 years' ) ); ?>" min="1900-01-01" value="<?php tmd_sanitize_val( 'tmd_profile_dob' ); ?>" class="regular-text" tabindex="<?php tmd_tab_index(); ?>" /><br />

        <label for="gender"><?php _e( 'Gender', 'tripmd' ); ?></label>
        <select name="tmd_profile_gender" tabindex="<?php tmd_tab_index(); ?>">
              <option value="male" <?php selected( tmd_get_sanitize_val( 'tmd_profile_gender' ), 'male' ); ?>><?php _e( 'Male' ); ?></option>
              <option value="female" <?php selected( tmd_get_sanitize_val( 'tmd_profile_gender' ), 'female' ); ?>><?php _e( 'Female' ); ?></option>
        </select>
    </div>
    
    <?php /*

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
    </script> */ ?>

<?php
}
add_action( 'register_form', 'tmd_registration_extra_fields' );

function tmd_registration_validate_extra_fields( $login, $email, $errors ) {
    if ( !empty( $_POST['tmd_profile_dob'] ) && ( date( 'Y-m-d', strtotime( tmd_get_sanitize_val( 'tmd_profile_dob' ) ) ) != tmd_get_sanitize_val( 'tmd_profile_dob' ) || tmd_get_sanitize_val( 'tmd_profile_dob' ) > date( 'Y-m-d', strtotime( '-13 years' ) ) ) )
        $errors->add( 'profile-invalid-dob', __( 'Please provide a valid date of birth. You must be at least 13 years old to register.', 'tripmd' ) );

    if ( !empty( $_POST['tmd_profile_gender'] ) && !in_array( tmd_get_sanitize_val( 'tmd_profile_gender' ), array( 'male', 'female' ) ) )
        $errors->add( 'profile-invalid-gender', __( 'Please provide a valid gender.', 'tripmd' ) );

    /* if ( $_POST['name'] == '' )
        $errors->add( 'empty_fullname', "<strong>ERROR</strong>: Please enter your full name." );

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
add_action( 'register_post', 'tmd_registration_validate_extra_fields', 10, 3 );

function tmd_registration_save_extra_fields( $user_id, $password = '', $meta = array() ) {
    if ( empty( $_POST['tmd_profile_dob'] ) )
        delete_user_meta( $user_id, 'dob' );
    elseif ( date( 'Y-m-d', strtotime( tmd_get_sanitize_val( 'tmd_profile_dob' ) ) ) == tmd_get_sanitize_val( 'tmd_profile_dob' ) && tmd_get_sanitize_val( 'tmd_profile_dob' ) <= date( 'Y-m-d', strtotime( '-13 years' ) ) )
        update_user_meta( $user_id, 'dob', tmd_get_sanitize_val( 'tmd_profile_dob' ) );
    
    if ( empty( $_POST['tmd_profile_gender'] ) )
        delete_user_meta( $user_id, 'gender' );
    elseif ( in_array( tmd_get_sanitize_val( 'tmd_profile_gender' ), array( 'male', 'female' ) ) )
        update_user_meta( $user_id, 'gender', tmd_get_sanitize_val( 'tmd_profile_gender' ) );

    /* update_user_meta( $user_id, 'weight', $_POST['weight'] );
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
        update_user_meta( $user_id, 'doctor_id',     $wp_session['doctor_id']     ); */
}
add_action( 'user_register', 'tmd_registration_save_extra_fields', 1, 3 );

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

    tmd_registration_name_split_hooks();
}
// add_action( 'template_redirect', 'tmd_registration_handler', -10 );

    /**
     * Set the username to email id unless we're in the admin section
     */
    function tmd_registration_handler_login( $username = '' ) {
        return !empty( $_POST['user_email'] ) && !is_admin() ? sanitize_user( trim( tmd_get_sanitize_val( 'user_email' ) ) ) : $username;
    }
    add_filter( 'pre_user_login', 'tmd_registration_handler_login' ); // Always force

/**
 * Return the first name in the post paramater
 */
function tmd_registration_handler_fn( $firstname = '' ) {
    return sanitize_user( trim( tmd_get_sanitize_val( 'first_name', 'text', $firstname ) ) );
}

/**
 * Return the last name in the post paramater
 */
function tmd_registration_handler_ln( $lastname = '' ) {
    return sanitize_user( trim( tmd_get_sanitize_val( 'last_name', 'text', $lastname ) ) );
}

/**
 * Return the nickname in the post paramater
 */
function tmd_registration_handler_nn( $nickname = '' ) {
    return sanitize_user( trim( tmd_get_sanitize_val( 'nickname', 'text', $nickname ) ) );
}

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
    /* elseif ( $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}tmd_beta_users WHERE email = %s LIMIT 1", $_POST['tmd_bs_email'] ) ) )
        tmd_add_error( 'exists-email', __( 'You\'ve already registered with this email id.', 'tripmd' ) );
    */

    if ( !empty( $_POST['tmd_bs_date'] ) && ( date( 'Y-m-d', strtotime( tmd_get_sanitize_val( 'tmd_bs_date' ) ) ) != tmd_get_sanitize_val( 'tmd_bs_date' ) || tmd_get_sanitize_val( 'tmd_bs_date' ) < date( 'Y-m-d', time() + 3600 * 24 ) || tmd_get_sanitize_val( 'tmd_bs_date' ) > date( 'Y-m-d', strtotime( '+1 year' ) ) ) )
        tmd_add_error( 'invalid-appt-date', __( 'Please provide an appointment date starting tomorrow and within an year.', 'tripmd' ) );

    if ( tmd_has_errors() )
        return;

    $data = array(
        'user_id' => get_current_user_id(),
        'speciality_id' => tmd_get_sanitize_val( 'tmd_bs_speciality_id' ), 
        'doctor_id' => tmd_get_sanitize_val( 'tmd_bs_doctor_id' ), 
        'name' => tmd_get_sanitize_val( 'tmd_bs_name' ), 
        'phone' => tmd_get_sanitize_val( 'tmd_bs_phone' ), 
        'email' => tmd_get_sanitize_val( 'tmd_bs_email' ),
        'description' => tmd_get_sanitize_val( 'tmd_bs_condition' ),
        'appt_date' => tmd_get_sanitize_val( 'tmd_bs_date' ),
        'registered' => date( 'Y-m-d H:i:s' ),
    );

    $registered = $wpdb->insert( 
        "{$wpdb->prefix}tmd_beta_users",
        $data, 
        array( '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s' )
    );

    if ( empty( $registered ) ) {
        tmd_add_error( 'error-registration', __( 'There was a problem registering you. Please try again or contact us at support@tripmd.com.', 'tripmd' ) );
    } else {

        // Notify admin
        wp_mail(
            get_option( 'admin_email' ), // To
            __( '[TripMD] New Patient Inquiry', 'tripmd' ), // Subject
            sprintf(
                __(
                    'User ID: %1$d' . "\r\n" .
                    'Speciality: %2$s (%3$d)' . "\r\n" .
                    'Doctor: %4$s (%5$d)' . "\r\n" .
                    'Name: %6$s' . "\r\n" .
                    'Email: %7$s' . "\r\n" .
                    'Phone: %8$s' . "\r\n" .
                    'Condition: %9$s' . "\r\n" .
                    'Appointment Date: %10$s' . "\r\n" .
                    'Registered: %11$s' . "\r\n" .
                    '', 'tripmd' ), // Message
                strip_tags( $data['user_id'] ),
                strip_tags( get_the_title( $data['speciality_id'] ) ), strip_tags( $data['speciality_id'] ),
                strip_tags( get_the_title( $data['doctor_id'] ) ), strip_tags( $data['doctor_id'] ),
                strip_tags( $data['name'] ),
                strip_tags( $data['email'] ),
                strip_tags( $data['phone'] ),
                strip_tags( $data['description'] ),
                strip_tags( $data['appt_date'] ),
                strip_tags( $data['registered'] )
            ),
            'From: TripMD <support@tripmd.com>' . "\r\n" // Headers
        );
        
    }
}

/**
 * Clinic registration handler
 */
function tmd_clinic_register_handler() {
    // Redirect on fault
    if ( empty( $_POST['tmd_cr_name'] ) ||  empty( $_POST['tmd_cr_location'] ) ||  empty( $_POST['tmd_cr_phone'] ) || empty( $_POST['tmd_cr_email'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_clinic_register_nonce' ) ) {
        wp_redirect( home_url( '?clin_reg=error#clinic-signup' ) );
        exit;
    }

    // Register new
    $new_clinic = array(
        'post_title'  => $_POST['tmd_cr_name'],
        'post_status' => 'pending',
        'post_type'   => tripmd()->hospital_post_type
    );
    $post_id = wp_insert_post( $new_clinic );
    
    // Add data
    add_post_meta( $post_id, 'location', trim( $_POST['tmd_cr_location'] ) );
    add_post_meta( $post_id, 'phone',    trim( $_POST['tmd_cr_phone']    ) );
    add_post_meta( $post_id, 'email',    trim( $_POST['tmd_cr_email']    ) );

    // Notify admin
    wp_mail(
        get_option( 'admin_email' ), // To
        __( 'New Clinic Registeration', 'tripmd' ), // Subject
        sprintf(
            __( 'Clinic name: %1$s' . "\r\n" .
                'Location: %2$s' . "\r\n" .
                'Email: %3$s' . "\r\n" .
                'Phone: %4$s', 'tripmd' ), // Message
            strip_tags( $_POST['tmd_cr_name'] ), strip_tags( $_POST['tmd_cr_location'] ), strip_tags( $_POST['tmd_cr_email'] ), strip_tags( $_POST['tmd_cr_phone'] )
        ),
        'From: TripMD <support@tripmd.com>' . "\r\n" // Headers
    );
    
    // Redirect to show success message
    wp_redirect( site_url( '?clin_reg=success#clin-reg-msg' ) );
    exit;
}
