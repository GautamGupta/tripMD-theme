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
     * 
     * @return string Two-letter country code
     */
    public function get_location() {

        // External library
        require_once( 'external/geoiploc.php' );

        // Two-letter country codes array
        global $geoipctry;

        // Return the specified country in the url
        $country = tmd_get_sanitize_val( 'tmd_set_country' );
        if ( !empty( $country ) && in_array( $country, $geoipctry ) )
            return $country;
        
        // If nothing is specified, get it from the ip
        $ip = $_SERVER['REMOTE_ADDR']; // eg. 122.161.53.53 for India
        $country = getCountryFromIP( $ip );

        // Return US if the country wasn't determined by the lib
        if ( empty( $country ) )
            $country = 'US';
        
        return $country;
    }

}

tripmd()->location = new TMD_Location();