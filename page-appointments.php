<?php
/**
* The template for displaying the home page.
*
* @package GSF
* @since GSF 1.0
*/
get_header();
?>

<?php if ( is_user_logged_in() ) : ?>

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

<?php
	// handle the post request
	if ( ( !empty( $_POST['date1'] ) ||
		   !empty( $_POST['date2'] ) ||
		   !empty($_POST['date3'] ) )    && 
	     !empty($_POST['notes'])) {	
		
		$doc = get_post(get_user_meta( bbp_get_current_user_id(), 'doctor_id', true ));


		$user = new WP_User( bbp_get_current_user_id() );
		$new_post = array(
			'post_title' => "Mr. " . $user->first_name . " ". $user->last_name " & Dr. ". $doc->post_title,
			'post_status' => 'draft',
			'post_content' => $_POST['notes'],
			'post_type' => 'consultation',
			'author' => bbp_get_current_user_id(),
		);
		$post_id = wp_insert_post($new_post);
		$dates = [$_POST['date1'], $_POST['date2'], $_POST['date3']];
		echo $dates;
		$dates_s = serialize($dates);
		add_post_meta($post_id, 'dates', $dates_s);
	    if ( get_user_meta( bbp_get_current_user_id(), 'speciality_id', true ) ) {
			add_post_meta($post_id, 'speciality_id', get_user_meta( bbp_get_current_user_id(), 'speciality_id', true ));
	    }
	    if ( get_user_meta( bbp_get_current_user_id(), 'procedure_id', true ) ) {
			add_post_meta($post_id, 'procedure_id', get_user_meta( bbp_get_current_user_id(), 'procedure_id', true ));
	    }
	    if ( get_user_meta( bbp_get_current_user_id(), 'hospital_id', true ) ) {
			add_post_meta($post_id, 'hospital_id', get_user_meta( bbp_get_current_user_id(), 'hospital_id', true ));
	    }
	    if ( get_user_meta( bbp_get_current_user_id(), 'doctor_id', true ) ) {
			add_post_meta($post_id, 'doctor_id', get_user_meta( bbp_get_current_user_id(), 'doctor_id', true ));
	    }
	}
?>

<h2>Register an Appointment</h2>

<?php if ( get_user_meta( bbp_get_current_user_id(), 'speciality_id', true) ) : ?>
    <?php if ( get_user_meta( bbp_get_current_user_id(), 'procedure_id', true ) ) : ?>
        <?php if ( get_user_meta( bbp_get_current_user_id(), 'hospital_id', true ) ) : ?>
			<div>
			<form method="POST">
				<h2 class="entry-title">Requested Dates</h2>
		    	<fieldset class="bbp-form"> 
			    	<div>
			            <label for="date1">Date 1</label>
			            <input type="date" name="date1"/><br />
			        </div> 
			    	<div>
			            <label for="date1">Date 2</label>
			            <input type="date" name="date2"/><br />
			        </div> 
			    	<div>
			            <label for="date1">Date 3</label>
			            <input type="date" name="date3"/><br />
			        </div>
		    	</fieldset>
		    	<div>
		            <label for="notes">Notes for the doctor</label>
		            <textarea name="notes"/></textarea>
		        </div>
		    	<input type="submit" value="submit"/>
			</form>
		</div>
        <?php else : ?>
            <p>Please select a hospital and a doctor (optional).
        <?php endif; ?>
    <?php else : ?>
        <p>Please select a procedure, hospital and a doctor (optional).
    <?php endif; ?>
<?php else : ?>
    <p>Please select a <a href="http://tripmd.com/specialities/">speciality</a>, procedure, hospital and a doctor (optional).
<?php endif; ?>

<?php else : ?>
<h2>Please <a href="http://tripmd.com/login">login</a>.</h2>
<?php endif; ?>
<?php get_footer(); ?>