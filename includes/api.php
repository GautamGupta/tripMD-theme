<?php
/**
 * TripMD API for Mobile app and other ajax callbacks
 * 
 * @see https://github.com/lionaneesh/tripMD-iOS/wiki/JSON-API-Reference
 * 
 * @package TripMD
 * @subpackage API
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

final class TMD_API {

	/**
	 * Construct something buoy
	 */
	public function __construct() {
		$this->setup_actions();
	}

	/**
	 * Setup our actions
	 */
	public function setup_actions() {
		add_action( 'wp_ajax_tmd_api',        array( $this, 'ajax_callback' ) );
		add_action( 'wp_ajax_nopriv_tmd_api', array( $this, 'ajax_callback' ) );
	}

	/**
	 * Get the version and call the related function
	 */
	public function ajax_callback() {
		define( 'DOING_TMD_API', true );

		$output = array( 'status' => 'failure' );

		if ( empty( $_GET['ver'] ) )
			tripmd()->api->output( $output );

		switch ( $_GET['ver'] ) {
			case '0.1' :

				$output = tripmd()->api->v_0_1( $output );
				break;

			default :
				break;
		}
		
		tripmd()->api->output( $output );
	}

	/**
	 * Output JSON encoded output and exit
	 * 
	 * @param mixed $output Output
	 */
	private function output( $output = array() ) {
		echo json_encode( $output );
		die(); // This is required to return a proper result
	}

	/**
	 * Return data based on supplied parameters
	 * 
	 * @param mixed $output Default error output
	 */
	private function v_0_1( $output = array() ) {
		if ( empty( $_GET['method'] ) )
			return $output;

		switch ( $_GET['method'] ) {
			case 'login' :

				// Authenticate user
				if ( empty( $_REQUEST['email'] ) || empty( $_REQUEST['password'] ) )
					return $output;

				$user = wp_authenticate_username_password( null, $_REQUEST['email'], $_REQUEST['password'] );
				if ( is_wp_error( $user ) ) // Wrong credentials
					return $output;

				// Successfully authenticated
				$output['status'] = 'success';

				// Profile items
				$profile = new stdClass();
				$profile->id = $user->ID;
				$profile->email = $user->data->user_email;
				$profile->name = $user->data->display_name;
				$profile->dob = $user->data->user_registered;
				$profile->consultations = tripmd()->api->get_user_consultations( $user->ID );
				$profile->medical_docs = array();
				$output['profile'] = $profile;

				$output['timeline'] = array();
				
				break;

			case 'registered_users' :
				$output['status'] = 'success';

				// Count registered users and put it in output
				$result = count_users();
				$output['registered'] = $result['total_users'];

				break;

			case 'procedures_costs' :
				$output['status'] = 'success';

				// @todo Make dynamic
				$output['specialities'] = array(
					'dental' => array(
						'title' => __( 'Dental', 'tripmd' ),
						'link' => site_url( '/doctor/poonam-batra' ), //site_url( '/specialities/dental' ),
						'procedures' => array(
							'crown' => array(
								'title' => __( 'Crowning', 'tripmd' ),
								'costs' => array(
									'IN' => 250,
									'AU' => 1500,
									'US' => 1000,
									'GB' => 890,
									'SG' => 1300,
									)
								),
							'implant' => array(
								'title' => __( 'Implant (single)', 'tripmd' ),
								'costs' => array(
									'IN' => 660,
									'AU' => 2100,
									'US' => 2800,
									'GB' => 2500,
									'SG' => 1600,
									)
								),
							'dentures' => array(
								'title' => __( 'Dentures', 'tripmd' ),
								'costs' => array(
									'IN' => 350,
									'AU' => 2000,
									'US' => 5000,
									'GB' => 1000,
									'SG' => 1200,
									)
								),
							),
						),
					'orthopaedic' => array(
						'title' => __( 'Orthopaedic', 'tripmd' ),
						'link' => site_url( '/inquiry?tmd_bs_inquiry_for=orthopaedic' ),
						'procedures' => array(
							'hip-replacement' => array(
								'title' => __( 'Hip Replacement', 'tripmd' ),
								'costs' => array(
									'IN' => 4300,
									'AU' => 10000,
									'US' => 38000,
									'GB' => 17100,
									'SG' => 15000,
									)
								),
							'knee-replacement' => array(
								'title' => __( 'Knee Replacement', 'tripmd' ),
								'costs' => array(
									'IN' => 6000,
									'AU' => 12000,
									'US' => 49000,
									'GB' => 18800,
									'SG' => 16800,
									)
								),
							)
						),
					'ophthalmology' => array(
						'title' => __( 'Ophthalmology (eye)', 'tripmd' ),
						'link' => site_url( '/inquiry?tmd_bs_inquiry_for=ophthalmology' ),
						'procedures' => array(
							'lasik' => array(
								'title' => __( 'Lasik (single eye)', 'tripmd' ),
								'costs' => array(
									'IN' => 800,
									'AU' => 2500,
									'US' => 2000,
									'GB' => 3000,
									'SG' => 1500,
									)
								),
							'cataract' => array(
								'title' => __( 'Cataract (single eye)', 'tripmd' ),
								'costs' => array(
									'IN' => 885,
									'AU' => 2500,
									'US' => 3800,
									'GB' => 2900,
									'SG' => 3000,
									)
								),
							)
						),
					'cardiac' => array(
						'title' => __( 'Cardiac (heart)', 'tripmd' ),
						'link' => site_url( '/inquiry?tmd_bs_inquiry_for=cardiac' ),
						'procedures' => array(
							'cornorary-artery-bypass' => array(
								'title' => __( 'Cornorary Artery Bypass', 'tripmd' ),
								'costs' => array(
									'IN' => 10400,
									'AU' => 0, // @todo get correct info
									'US' => 20600,
									'GB' => 37700,
									'SG' => 16700,
									)
								),
							'angioplasty' => array(
								'title' => __( 'Angioplasty', 'tripmd' ),
								'costs' => array(
									'IN' => 6900,
									'AU' => 0, // @todo get correct info
									'US' => 26000,
									'GB' => 20500,
									'SG' => 19100,
									)
								),
							)
						),
					);

				$output['countries'] = array(
					'IN' => __( 'India',          'tripmd' ),
					'AU' => __( 'Australia',      'tripmd' ),
					'US' => __( 'United States',  'tripmd' ),
					'GB' => __( 'United Kingdom', 'tripmd' ),
					'SG' => __( 'Singapore',      'tripmd' ),
				);

				// Get current country
				require_once( 'external/geoiploc.php' );
				$ip = $_SERVER['REMOTE_ADDR']; // eg. 122.161.53.53 for India
				$output['current_country'] = getCountryFromIP( $ip );

				break;

			default :
				break;
		}

		return $output;
	}

	/**
	 * Return selection of the user
	 * 
	 * @todo Move to user.php
	 * 
	 * @param int $user_id User id
	 * @return array Array of consultations
	 */
	private function get_user_consultations( $user_id = 0 ) {
		if ( empty( $user_id ) )
			return array();

		$selections = array( 
			'speciality' => 5,
			'procedure' => 92,
			'hospital' => 94,
			'doctor' => 148,
		);

		/*
		$speciality->id = 5;
		$procedure->id = 92;
		$hospital->id = 94;
		$doctor->id = 148;
		*/

		foreach ( $selections as $type => $id ) {
			$$type = new stdClass();
			$$type->id = $id;
			$$type->name = get_post( $id )->post_title;
			$$type->link = get_permalink( $id );
			$$type->description = trim( strip_shortcodes( strip_tags( get_post( $id )->post_content ) ) );
			$$type->link = get_permalink( $id );
			if ( 'procedure' == $type )
				$$type->short_description = get_post( $id )->post_excerpt;
			else
				$$type->image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' )[0];
		}

		$appointment_dates = array(
			array(
				'date' => date( 'Y-m-d H:i:s', strtotime( '+1 day' ) ),
				'confirmed' => false,
			),
			array(
				'date' => date( 'Y-m-d H:i:s', strtotime( '+1 week' ) ),
				'confirmed' => true,
			),
			array(
				'date' => date( 'Y-m-d H:i:s', strtotime( '+1 week 2 days' ) ),
				'confirmed' => false,
			),
		);

		$consultations[0] = array(
			'paid'              => false,
			'speciality'        => $speciality,
			'procedure'         => $procedure,
			'hospital'          => $hospital,
			'doctor'            => $doctor,
			'appointment_dates' => $appointment_dates,
		);

		return $consultations;
	}
}

tripmd()->api = new TMD_API();
