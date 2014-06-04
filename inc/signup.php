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
    <table class="form-table">
        <tr>
            <th><label for="twitter">Personal Details</label></th>
            <td>
                <input type="text" name="name" id="name" value="<?php echo esc_attr( get_the_author_meta( 'name', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your name.</span>
            </td>
            <td>
                <input type="date" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your date of birth.</span>
            </td>
            <td>
                <input type="email" name="email" id="email" value="<?php echo esc_attr( get_the_author_meta( 'email', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your email.</span>
            </td>
            <td>
                <input type="text" name="gender" id="gender" value="<?php echo esc_attr( get_the_author_meta( 'gender', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your gender.</span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter">Medical Details</label></th>
            <td>
                <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your weight.</span>
            </td>
            <td>
                <input type="number" name="height" id="name" value="<?php echo esc_attr( get_the_author_meta( 'height', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your height.</span>
            </td>
            <td>
                <textarea name="gobs" id="gobs" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'gobs', $user->ID ) ); ?></textarea><br />
                <span class="description">General Observations.</span>
            </td>
            <td>
                <textarea name="allergies" id="allergies" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'allergies', $user->ID ) ); ?></textarea><br />
                <span class="description">Allergies.</span>
            </td>
        </tr>
    </table>

    <div class="uploader">        
        <button class="button" name="medical_records_button" id="medical_records_button" value="Upload">Upload medical records</button>
    </div>

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
    <input type="text" name="gender" id="gender" value="<?php echo esc_attr( get_the_author_meta( 'gender', $user->ID ) ); ?>" class="regular-text" /><br />


    <label for="weight">Weight</label>
    <input type="number" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'weight', $user->ID ) ); ?>" class="regular-text" /><br />
    
    <label for="weight">Height</label>
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
}