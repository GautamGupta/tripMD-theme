<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile">
		<h2 class="entry-title"><?php _e( 'Profile', 'bbpress' ); ?></h2>
		<div class="bbp-user-section">


		<h2 class="entry-title">Personal Details</h2>
		<fieldset class="bbp-form">
		    <?php if ( bbp_get_displayed_user_field( 'name' ) ) : ?>
		    <div>
		        <label for="name">Name: </label>
		        <?php echo bbp_get_displayed_user_field( 'name' ); ?>
		    </div>
			<?php endif; ?>
		    <?php if ( bbp_get_displayed_user_field( 'name' ) ) : ?>
		    <div>
		        <label for="name">DOB: </label>
		        <?php echo bbp_get_displayed_user_field( 'dob' ); ?>
		    </div>
			<?php endif; ?>
			<?php if ( bbp_get_displayed_user_field( 'gender' ) ) : ?>
		    <div>
		        <label for="name">Gender: </label>
		        <?php echo bbp_get_displayed_user_field( 'gender' ); ?>
		    </div>
			<?php endif; ?>

		</fieldset>
		<?php if ( current_user_can( 'edit_user', bbp_get_user_id() ) ) : ?>
			<h2 class="entry-title">Medical Details</h2>
			    
			<fieldset class="bbp-form"> 
			    <?php if ( bbp_get_displayed_user_field( 'weight' ) ) : ?>
			    <div>
			        <label>Weight: </label>
			        <?php echo bbp_get_displayed_user_field( 'weight' ); ?>Kgs
			    </div>
				<?php endif; ?>
				<?php if ( bbp_get_displayed_user_field( 'height' ) ) : ?>
				    <div>
				        <label for="name">Height: </label>
				        <?php echo bbp_get_displayed_user_field( 'height' ); ?>cms
				    </div>
				<?php endif; ?>

				<?php if ( bbp_get_displayed_user_field( 'gobs' ) ) : ?>
				    <div>
				        <label for="name">GObs: </label>
				        <?php echo bbp_get_displayed_user_field( 'gobs' ); ?>
				    </div>
				<?php endif; ?>

				<?php if ( bbp_get_displayed_user_field( 'allergies' ) ) : ?>
				    <div>
				        <label>Allergies: </label>
				        <?php echo bbp_get_displayed_user_field( 'allergies' ); ?>
				    </div>
				<?php endif; ?>
			</fieldset>
			<?php if ( bbp_get_displayed_user_field('medical_records', $user->ID) ) : ?>
			<h2 class="entry-title">Medical Records uploaded</h2>
			<fieldset class="bbp-form"> 
			    <ul>
			        <?php
			            $medicals = esc_attr(bbp_get_displayed_user_field('medical_records', $user->ID));
			            $medicals = json_decode(htmlspecialchars_decode($medicals), true);
			            foreach ($medicals['mystuff'] as $medical_record) {
			                echo "<li>".$medical_record."</li>";
			            }
			        ?>
			    </ul>
			</fieldset>
			<?php endif; ?>
		<?php endif; ?>

			<!-- XXX: Do we even need this? -->
			<h2>Forum Roles</h2>
			<fieldset>
			<p class="bbp-user-forum-role"><?php  printf( __( 'Forum Role: %s',      'bbpress' ), bbp_get_user_display_role()    ); ?></p>
			<p class="bbp-user-topic-count"><?php printf( __( 'Topics Started: %s',  'bbpress' ), bbp_get_user_topic_count_raw() ); ?></p>
			<p class="bbp-user-reply-count"><?php printf( __( 'Replies Created: %s', 'bbpress' ), bbp_get_user_reply_count_raw() ); ?></p>
			</fieldset>
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
