<?php
/**
 * Add additional custom field
 */

add_action ( 'show_user_profile', 'show_extra_profile_fields' );
add_action ( 'edit_user_profile', 'show_extra_profile_fields' );
function add_media_upload_scripts() {
    wp_enqueue_media();
}
add_action('wp_enqueue_scripts', 'add_media_upload_scripts');
function show_extra_profile_fields ( $user )
{
?>
    <h2 class="entry-title">Personal Details</h2>
    <fieldset class="bbp-form">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo esc_attr( get_the_author_meta( 'name', $user->ID ) ); ?>" class="regular-text" /><br />
        </div>
        <div>
            <label for="dob">Date of birth</label>
            <input type="date" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" /><br />
        </div>
        <div>
            <label for="gender">Gender</label>
            <select name="gender">
              <option value="male" <?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'male') echo "selected";  ?>>Male</option>
              <option value="female"<?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'female') echo "selected";  ?>>Female</option>
            </select>
        </div>
    </fieldset>
    <h2 class="entry-title">Medical Details</h2>
    <fieldset class="bbp-form"> 
        <div>
            <label for="weight">Weight (in KGs)</label>
            <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" /><br />
        </div>
        <div>
            <label for="weight">Height (in CMs)</label>
            <input type="number" name="height" id="height" value="<?php echo esc_attr( get_the_author_meta( 'height', $user->ID ) ); ?>" class="regular-text" /><br />
        </div>

        <div>
            <label for="gobs">General Observations</label>
            <textarea name="gobs" id="gobs" value="<?php echo esc_attr( get_the_author_meta( 'gobs', $user->ID ) ); ?>" class="regular-text" /></textarea><br/>
        </div>

        <div>
            <label for="allergies">Allergies</label><br/>
            <textarea name="allergies" id="allergies" value="<?php echo esc_attr( get_the_author_meta( 'allergies', $user->ID ) ); ?>" class="regular-text" ></textarea><br/>
        </div>
    </fieldset>
    <h2 class="entry-title">Medical Records uploaded</h2>
    <fieldset class="bbp-form"> 
        <ul>
            <?php
                $medicals = esc_attr(get_the_author_meta('medical_records', $user->ID));
                $medicals = json_decode(htmlspecialchars_decode($medicals), true);
                foreach ($medicals['mystuff'] as $medical_record) {
                    echo "<li>".$medical_record."</li>";
                }
            ?>
        </ul>

    <div class="uploader">        
        <button name="medical_records_button" id="medical_records_button" value="Upload">Upload medical records</button>
    </div>

    <input name="medical_records" id="medical_records_files" value="" type="hidden">
    </fieldset> 

<?php
}

add_action ( 'personal_options_update', 'save_extra_profile_fields' );
add_action ( 'edit_user_profile_update', 'save_extra_profile_fields' );

function save_extra_profile_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_user_meta( $user_id, 'name', $_POST['name'] );
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

/**
 * Add cutom field to registration form
 */

add_action('register_form','show_extra_fields');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');

function show_extra_fields()
{
?>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo esc_attr( get_the_author_meta( 'name', $user->ID ) ); ?>" class="regular-text" /><br />
    
    <label for="dob">Date of birth</label>
    <input type="date" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" /><br />
   
    <label for="gender">Gender</label>
    <select name="gender">
      <option value="male" <?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'male') echo "selected";  ?>>Male</option>
      <option value="female"<?php if (esc_attr( get_the_author_meta( 'gender', $user->ID )) == 'female') echo "selected";  ?>>Female</option>
    </select>
    
    <label for="weight">Weight (in KGs)</label>
    <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" /><br />
    
    <label for="weight">Height (in CMs)</label>
    <input type="number" name="height" id="height" value="<?php echo esc_attr( get_the_author_meta( 'height', $user->ID ) ); ?>" class="regular-text" /><br />

    <label for="gobs">General Observations</label>
    <textarea name="gobs" id="gobs" value="<?php echo esc_attr( get_the_author_meta( 'gobs', $user->ID ) ); ?>" class="regular-text" /></textarea><br/>
    
    <label for="allergies">Allergies</label><br/>
    <textarea name="allergies" id="allergies" value="<?php echo esc_attr( get_the_author_meta( 'allergies', $user->ID ) ); ?>" class="regular-text" ></textarea><br/>

<?php

}

function check_fields ( $login, $email, $errors )
{
    if ( $_POST['name'] == '' )
    {
        $errors->add( 'empty_realname', "<strong>ERROR</strong>: Please Enter your name." );
    }
    if ( $_POST['dob'] == '' )
    {
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Date of Birth." );
    }
    if ( $_POST['gender'] == '' )
    {
        $errors->add( 'empty_gender', "<strong>ERROR</strong>: Please Enter your gender." );
    }
    /*
    if ( $_POST['weight'] == '' )
    {
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Weight." );
    }
    if ( $_POST['height'] == '' )
    {
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your Height." );
    }
    if ( $_POST['gobs'] == '' )
    {
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your General Observations about your condition." );
    }
    if ( $_POST['allergies'] == '' )
    {
        $errors->add( 'empty_dob', "<strong>ERROR</strong>: Please Enter your past allergies." );
    }
    */
}

function register_extra_fields ( $user_id, $password = "", $meta = array() )
{
    update_user_meta( $user_id, 'name', $_POST['name'] );
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

    if (array_key_exists('speciality_id', $wp_session))
        update_user_meta( $user_id, 'speciality_id', $wp_session['speciality_id'] );
    if (array_key_exists('procedure_id', $wp_session))
        update_user_meta( $user_id, 'procedure_id', $wp_session['procedure_id'] );
    if (array_key_exists('hospital_id', $wp_session))
        update_user_meta( $user_id, 'hospital_id', $wp_session['hospital_id'] );
    if (array_key_exists('doctor_id', $wp_session))
        update_user_meta( $user_id, 'doctor_id', $wp_session['doctor_id'] );
}