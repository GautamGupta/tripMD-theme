<?php
/**
 * Location API for contextual output
 * 
 * @see external/geoiploc.php
 * 
 * @package TripMD
 * @subpackage Location
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Where does our monsieur reside?
 */
final class TMD_Location {

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

    }

    /**
     * Get the version and call the related function
     */
    public function get_location() {
        require_once( 'external/geoiploc.php' );
        
        $ip = $_SERVER['REMOTE_ADDR']; // eg. 122.161.53.53 for India
        $country = getCountryFromIP( $ip );

        if ( empty( $country ) )
            $country = 'US';
        
        return $country;
    }

}

tripmd()->location = new TMD_Location();