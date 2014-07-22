<?php
/**
 * The TripMD Theme
 * 
 * Code/strategy heavily borrowed from bbPress
 *
 * @package TripMD
 * @subpackage Main
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Set the content width based on the theme's design and stylesheet
 * for gallery etc.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Main TripMD Class
 */
final class TripMD {

    /** Magic *****************************************************************/

    /**
     * TripMD uses many variables, several of which can be filtered to
     * customize the way it operates. Most of these variables are stored in a
     * private array that gets updated with the help of PHP magic methods.
     *
     * This is a precautionary measure, to avoid potential errors produced by
     * unanticipated direct manipulation of TripMD's run-time data.
     *
     * @see TripMD::setup_globals()
     * @var array
     */
    private $data;

    /** Not Magic *************************************************************/

    /**
     * @var mixed False when not logged in; WP_User object when logged in
     */
    public $current_user = false;

    /**
     * @var object Add-ons append to this
     */
    public $extend;

    /** Singleton *************************************************************/

    /**
     * Main TripMD Instance
     *
     * TripMD is fun
     * Please load it only one time
     * For this, we thank you
     *
     * Insures that only one instance of TripMD exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @staticvar object $instance
     * @uses TripMD::setup_globals() Setup the globals needed
     * @uses TripMD::includes() Include the required files
     * @uses TripMD::setup_actions() Setup the hooks and actions
     * @see tripmd()
     * @return The one true TripMD
     */
    public static function instance() {
        // Store the instance locally to avoid private static replication
        static $instance = null;

        // Only run these methods if they haven't been ran previously
        if ( null === $instance ) {
            $instance = new TripMD;
            $instance->setup_globals();
            $instance->includes();
            $instance->setup_theme();
            $instance->setup_actions();
        }

        // Always return the instance
        return $instance;
    }

    /** Magic Methods *********************************************************/

    /**
     * A dummy constructor to prevent TripMD from being loaded more than once.
     *
     * @see TripMD::instance()
     * @see tripmd();
     */
    private function __construct() { /* Do nothing here */ }

    /**
     * A dummy magic method to prevent TripMD from being cloned
     */
    public function __clone() { _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'tripmd' ), '0.1' ); }

    /**
     * A dummy magic method to prevent TripMD from being unserialized
     */
    public function __wakeup() { _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'tripmd' ), '0.1' ); }

    /**
     * Magic method for checking the existence of a certain custom field
     */
    public function __isset( $key ) { return isset( $this->data[$key] ); }

    /**
     * Magic method for getting variables
     */
    public function __get( $key ) { return isset( $this->data[$key] ) ? $this->data[$key] : null; }

    /**
     * Magic method for setting variables
     */
    public function __set( $key, $value ) { $this->data[$key] = $value; }

    /**
     * Magic method for unsetting variables
     */
    public function __unset( $key ) { if ( isset( $this->data[$key] ) ) unset( $this->data[$key] ); }

    /**
     * Magic method to prevent notices and errors from invalid method calls
     */
    public function __call( $name = '', $args = array() ) { unset( $name, $args ); return null; }

    /** Private Methods *******************************************************/

    /**
     * Set some smart defaults to class variables. Allow some of them to be
     * filtered to allow for early overriding.
     *
     * @access private
     */
    private function setup_globals() {

        /** Versions **********************************************************/

        $this->version    = '0.1-a3';
        $this->db_version = '10';

        /** Paths *************************************************************/

        // Base name
        $this->file         = __FILE__;
        $this->basename     = 'tripmd'; // @todo Remove if not required

        // Path and URL
        $this->base_dir     = trailingslashit( get_template_directory()      );
        $this->base_url     = trailingslashit( get_template_directory_uri()  );

        // Includes
        $this->includes_dir = trailingslashit( $this->base_dir . 'includes'  );
        $this->includes_url = trailingslashit( $this->base_url . 'includes'  );

        // Languages
        $this->lang_dir     = trailingslashit( $this->base_dir . 'languages' );

        /** Identifiers *******************************************************/

        // Post type identifiers
        $this->speciality_post_type   = 'speciality';
        $this->procedure_post_type    = 'procedure';
        $this->hospital_post_type     = 'hospital';
        $this->doctor_post_type       = 'doctor';
        $this->room_post_type         = 'room';
        $this->consultation_post_type = 'consultation';

        // Consultation Status identifiers
        
        $this->closed_status_id  = 'closed';
        $this->public_status_id  = 'publish';
        $this->pending_status_id = 'pending';
        $this->private_status_id = 'private';
        $this->trash_status_id   = 'trash';

        // Other identifiers
        $this->consultation_video_id = 'tmd_video';
        $this->reviews_id            = 'reviews';

        /** Queries ***********************************************************/

        $this->current_speciality_id   = 0; // Current speciality id
        $this->current_procedure_id    = 0; // Current procedure id
        $this->current_hospital_id     = 0; // Current hospital id
        $this->current_doctor_id       = 0; // Current doctor id
        $this->current_room_id         = 0; // Current room id
        $this->current_consultation_id = 0; // Current speciality id

        $this->speciality_query   = new WP_Query(); // Main speciality query
        $this->procedure_query    = new WP_Query(); // Main procedure query
        $this->hospital_query     = new WP_Query(); // Main hospital query
        $this->doctor_query       = new WP_Query(); // Main doctor query
        $this->room_query         = new WP_Query(); // Main room query
        $this->consultation_query = new WP_Query(); // Main speciality query

        /** Users *************************************************************/

        $this->current_user   = new WP_User(); // Currently logged in user
        $this->displayed_user = new WP_User(); // Currently displayed user

        /** Misc **************************************************************/

        $this->domain     = 'tripmd';       // Unique identifier for retrieving translated strings
        $this->extend     = new stdClass(); // Plugins add data here
        $this->errors     = new WP_Error(); // Errors
        $this->tab_index  = 100;            // Tabindex for better UX
        $this->session    = class_exists( 'WP_Session' ) ? WP_Session::get_instance() : new stdClass(); // Sessions, requires WP Session plugin
        $this->template   = '';             // Loaded template if custom
    }

    /**
     * Include required files
     *
     * @access private
     */
    private function includes() {
        /**
         * Core
         */
        require $this->includes_dir . 'core.php';

        /**
         * Hooks
         */
        require $this->includes_dir . 'hooks.php';

        /**
         * Custom template tags for this theme.
         */
        require $this->includes_dir . 'template.php';

        /**
         * API for Mobile/Web
         */
        require $this->includes_dir . 'api.php';

        /**
         * Registration + Consultation stuff
         */
        require $this->includes_dir . 'user.php';

        /**
         * Review system
         */
        require $this->includes_dir . 'review.php';

        /**
         * Search Functionality
         */
        require $this->includes_dir . 'search.php';

        /**
         * Customizer additions.
         */
        require $this->includes_dir . 'customizer.php';

        /**
         * Load Jetpack compatibility file.
         */
        require $this->includes_dir . 'jetpack.php';

        /**
         * Load Admin functions if we're inside the dashboard
         */
        if ( is_admin() )
            require $this->includes_dir . 'admin.php';
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    public function setup_theme() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );

        // Enable support for Post Formats.
        add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

        // Enable support for HTML5 markup.
        add_theme_support( 'html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
        ) );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'tripmd' ),
        ) );

        /**
         * Register widget area.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_sidebar
         */
        register_sidebar( array(
            'name'          => __( 'Sidebar', 'tripmd' ),
            'id'            => 'sidebar-1',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ) );
    }

    /**
     * Setup the default hooks and actions
     *
     * @access private
     */
    private function setup_actions() {
        /*
        // Add actions to theme activation and deactivation hooks
        add_action( 'activate_'   . $this->basename, 'tmd_activation'   );
        add_action( 'deactivate_' . $this->basename, 'tmd_deactivation' );

        // If TripMD is being deactivated, do not add any actions
        if ( tmd_is_deactivation( $this->basename ) ) {
            return;
        }
        */

        // Array of core actions
        $actions = array(
            'load_textdomain',          // Load textdomain (tripmd)
            'setup_current_user',       // Setup currently logged in user
            'register_post_types',      // Register post types
            'register_post_fields',     // Register post fields
            'register_post_statuses',   // Register post statuses
            'register_taxonomies',      // Register taxonomies
            'add_rewrite_tags',         // Add rewrite tags
            'add_rewrite_rules',        // Generate rewrite rules
            'add_permastructs',         // Add permalink structures
            'enqueue_scripts',          // Enqueue necessary styles and scripts
            'setup_session',            // Setup session
        );

        // Add the actions
        foreach ( $actions as $class_action ) {
            add_action( 'tmd_' . $class_action, array( $this, $class_action ), 5 );
        }

        // All TripMD actions are setup (includes hooks.php)
        do_action_ref_array( 'tmd_after_setup_actions', array( &$this ) );
    }

    /** Public Methods ********************************************************/

    /**
     * Load the translation file for current language.
     * 
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    public function load_textdomain() {
        load_theme_textdomain( $this->domain, $this->lang_dir );
    }

    /**
     * Setup the currently logged-in user
     *
     * Do not to call this prematurely, I.E. before the 'init' action has
     * started. This function is naturally hooked into 'init' to ensure proper
     * execution. get_currentuserinfo() is used to check for XMLRPC_REQUEST to
     * avoid xmlrpc errors.
     *
     * @uses wp_get_current_user()
     */
    public function setup_current_user() {
        $this->current_user = wp_get_current_user();
    }

    /**
     * Setup the post types for specialityes, procedures, hospitals, doctors,
     * rooms, consultations
     *
     * @uses register_post_type() To register the post types
     */
    public static function register_post_types() {
        $labels = array(
            'name'                => _x( 'Specialities', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Speciality', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Speciality', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Specialities', 'tripmd' ),
            'view_item'           => __( 'View Speciality', 'tripmd' ),
            'add_new_item'        => __( 'Add New Speciality', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => 'specialities',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'speciality', 'tripmd' ),
            'description'         => __( 'Speciality Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->speciality_post_type, $args );

        $labels = array(
            'name'                => _x( 'Procedures', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Procedure', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Procedure', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Procedures', 'tripmd' ),
            'view_item'           => __( 'View Procedure', 'tripmd' ),
            'add_new_item'        => __( 'Add New Procedure', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => 'procedure',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'procedure', 'tripmd' ),
            'description'         => __( 'Procedure Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'excerpt', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->procedure_post_type, $args );

        $labels = array(
            'name'                => _x( 'Hospitals', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Hospital', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Hospital', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Hospitals', 'tripmd' ),
            'view_item'           => __( 'View Hospital', 'tripmd' ),
            'add_new_item'        => __( 'Add New Hospital', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => '',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'hospital', 'tripmd' ),
            'description'         => __( 'Hospital Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'comments', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->hospital_post_type, $args );

        $labels = array(
            'name'                => _x( 'Doctors', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Doctor', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Doctor', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Doctors', 'tripmd' ),
            'view_item'           => __( 'View Doctor', 'tripmd' ),
            'add_new_item'        => __( 'Add New Doctor', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => 'doctor',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'doctor', 'tripmd' ),
            'description'         => __( 'Doctor Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'comments', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->doctor_post_type, $args );

        $labels = array(
            'name'                => _x( 'Rooms', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Room', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Room', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Rooms', 'tripmd' ),
            'view_item'           => __( 'View Room', 'tripmd' ),
            'add_new_item'        => __( 'Add New Room', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => 'room',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'room', 'tripmd' ),
            'description'         => __( 'Room Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->room_post_type, $args );

        $labels = array(
            'name'                => _x( 'Consultation', 'Post Type General Name', 'tripmd' ),
            'singular_name'       => _x( 'Consultation', 'Post Type Singular Name', 'tripmd' ),
            'menu_name'           => __( 'Consultation', 'tripmd' ),
            'parent_item_colon'   => __( 'Parent:', 'tripmd' ),
            'all_items'           => __( 'All Consultations', 'tripmd' ),
            'view_item'           => __( 'View Consultation', 'tripmd' ),
            'add_new_item'        => __( 'Add New Consultation', 'tripmd' ),
            'add_new'             => __( 'Add New', 'tripmd' ),
            'edit_item'           => __( 'Edit', 'tripmd' ),
            'update_item'         => __( 'Update', 'tripmd' ),
            'search_items'        => __( 'Search', 'tripmd' ),
            'not_found'           => __( 'Not found', 'tripmd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tripmd' ),
        );
        $rewrite = array(
            'slug'                => 'consultation',
            'with_front'          => false,
            'pages'               => false,
            'feeds'               => false,
        );
        $args = array(
            'label'               => __( 'consultation', 'tripmd' ),
            'description'         => __( 'Consultation Listings', 'tripmd' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'comments' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'page',
        );
        register_post_type( tripmd()->consultation_post_type, $args );
    }

    /**
     * Register custom meta fields for various post types that we have
     *
     * @see https://github.com/wordpress-metadata/metadata-ui-api
     * 
     * @uses register_post_field() To register the post fields
     */
    public static function register_post_fields() {
        if ( !function_exists( 'register_post_field' ) )
            return;

        /* register_post_field( 'intl_treated', tripmd()->doctor_post_type,  array(
            'label'     =>  __( 'International Patients Treated Annually',  'tripmd' ),
            'html_size' =>  5
        ) ); */
    }

    /**
     * Register the taxonomies
     *
     * @uses register_taxonomy() To register the taxonomy
     */
    public static function register_taxonomies() {

        $labels = array(
            'name'                       => _x( 'Degrees', 'Taxonomy General Name', 'tripmd' ),
            'singular_name'              => _x( 'Degree', 'Taxonomy Singular Name', 'tripmd' ),
            'menu_name'                  => __( 'Degrees', 'tripmd' ),
            'all_items'                  => __( 'All Degrees', 'tripmd' ),
            'parent_item'                => __( 'Parent Degree', 'tripmd' ),
            'parent_item_colon'          => __( 'Parent Degree:', 'tripmd' ),
            'new_item_name'              => __( 'New Degree Name', 'tripmd' ),
            'add_new_item'               => __( 'Add New Degree', 'tripmd' ),
            'edit_item'                  => __( 'Edit Degree', 'tripmd' ),
            'update_item'                => __( 'Update Degree', 'tripmd' ),
            'separate_items_with_commas' => __( 'Separate degrees with commas', 'tripmd' ),
            'search_items'               => __( 'Search Degrees', 'tripmd' ),
            'add_or_remove_items'        => __( 'Add or remove degrees', 'tripmd' ),
            'choose_from_most_used'      => __( 'Choose from the most used degrees', 'tripmd' ),
            'not_found'                  => __( 'Not Found', 'tripmd' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
            'rewrite'                    => false,
        );
        register_taxonomy( 'doctor_degree', array( 'doctor' ), $args );

    }

    /**
     * Register the post statuses used by TripMD
     *
     * @uses register_post_status() To register post statuses
     */
    public static function register_post_statuses() {

    }

    /** Custom Rewrite Rules **************************************************/

    /**
     * Add the rewrite tags
     *
     * @uses add_rewrite_tag() To add the rewrite tags
     */
    public static function add_rewrite_tags() {
        add_rewrite_tag( '%' . tripmd()->consultation_video_id . '%', '([^/]+)'   ); // View Page tag
        add_rewrite_tag( '%' . tripmd()->reviews_id            . '%', '([1]{1,})' ); // Reviews Page tag
    }

    /**
     * Add rewrite rules for uri's that are not setup for us by way of custom
     * post types or taxonomies. This includes:
     * - Front-end editing
     * - Consultation/video pages
     *
     * @todo Extract into an API
     */
    public static function add_rewrite_rules() {

        /** Setup *************************************************************/
        
        // Add rules to top or bottom?
        $priority           = 'top';

        // Rewrite rule matches used repeatedly below
        $root_rule    = '/([^/]+)/?$';
        
        // Video consultation
        add_rewrite_rule( 'video' . $root_rule,  'index.php?' . tripmd()->consultation_video_id . '=$matches[1]', $priority );

        // Doctor reviews page
        add_rewrite_rule( 'doctor/([^/]+)/' . tripmd()->reviews_id . '/?$', 'index.php?' . tripmd()->doctor_post_type . '=$matches[1]&' . tripmd()->reviews_id . '=1', $priority );

        // Add rules to top or bottom?
        $priority           = 'bottom';

        // Hospital links should be with root
        add_rewrite_rule( '([^/]+)$', 'index.php?' . tripmd()->hospital_post_type . '=$matches[1]', $priority );
    }

    /**
     * Add permalink structures for new archive-style destinations.
     *
     * - Users
     * - Topic Views
     * - Search
     */
    public static function add_permastructs() {

        $video_id = tripmd()->consultation_video_id;

        // Video Consultation Permastruct
        add_permastruct( $video_id, 'video/%' . $video_id . '%', array(
            'with_front'  => false,
            'ep_mask'     => EP_NONE,
            'paged'       => false,
            'feed'        => false,
            'forcomments' => false,
            'walk_dirs'   => true,
            'endpoints'   => false,
        ) );

        /*
        // Get unique ID's
        $user_id     = tmd_get_user_rewrite_id();
        $view_id     = tmd_get_view_rewrite_id();
        $search_id   = tmd_get_search_rewrite_id();

        // Get root slugs
        $user_slug   = tmd_get_user_slug();
        $view_slug   = tmd_get_view_slug();
        $search_slug = tmd_get_search_slug();

        // User Permastruct
        add_permastruct( $user_id, $user_slug . '/%' . $user_id . '%', array(
            'with_front'  => false,
            'ep_mask'     => EP_NONE,
            'paged'       => false,
            'feed'        => false,
            'forcomments' => false,
            'walk_dirs'   => true,
            'endpoints'   => false,
        ) );

        // Search Permastruct
        add_permastruct( $user_id, $search_slug . '/%' . $search_id . '%', array(
            'with_front'  => false,
            'ep_mask'     => EP_NONE,
            'paged'       => true,
            'feed'        => false,
            'forcomments' => false,
            'walk_dirs'   => true,
            'endpoints'   => false,
        ) );
        */
    }

    /**
     * Enqueue scripts and styles.
     */
    public static function enqueue_scripts() {
        wp_enqueue_style( 'tripmd', get_template_directory_uri() . '/css/style.css' );
        wp_enqueue_style( 'unsemantic', get_template_directory_uri() . '/css/unsemantic.css' );
        wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
        wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
        wp_enqueue_script( 'tmd_media_upload', get_template_directory_uri() . '/js/upload.js', array( 'jquery' ), '0.0.1', false );
        if ( is_front_page() )  {
            // Royal slider
            wp_enqueue_style( 'royalslider', get_template_directory_uri() . '/css/royalslider/royalslider.css', array(), '9.5.4' );
            wp_enqueue_style( 'royalslider-skins-default', get_template_directory_uri() . '/css/royalslider/skins/default/rs-default.css', array( 'royalslider' ), '9.5.4' );
            wp_enqueue_style( 'royalslider-skins-minimal-white', get_template_directory_uri() . '/css/royalslider/skins/minimal-white/rs-minimal-white.css', array( 'royalslider' ), '9.5.4' );

            // Select box
            wp_enqueue_style( 'select', get_template_directory_uri() . '/css/select/select-theme-default.css', array(), '0.5.2' );
            wp_enqueue_script( 'select', get_template_directory_uri() . '/js/select.min.js', array( 'jquery' ), '0.5.2', true );

            // Homepage styling
            wp_enqueue_style( 'tripmd-home', get_template_directory_uri() . '/css/home.css', array( 'tripmd' ) );
        }

        // Consultation page
        if ( get_post_type() == 'consultation' ) {
            $postVariables = array(
                'post_id' => get_the_ID(),
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            );
            wp_enqueue_style( 'timeline_default', get_template_directory_uri() . '/css/timeline_default.css', array(), '0.1' );
            wp_enqueue_style( 'timeline_component', get_template_directory_uri() . '/css/timeline_component.css', array(), '0.1' );
            wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '0.1', true );
            wp_localize_script( 'tmd_media_upload', 'MediaUpload', $postVariables );
        }
        /*
        if ( is_front_page() )
            wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox/jquery.fancybox.css', array(), '2.1.5' );
        */
        wp_enqueue_script( 'tripmd', get_template_directory_uri() . '/js/js.js', array( 'jquery' ), '0.1', true );
        wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/royalslider/jquery.easing-1.3.js', array( 'jquery' ), '1.3', true );
        wp_enqueue_script( 'royalslider', get_template_directory_uri() . '/js/royalslider/jquery.royalslider.min.js', array( 'jquery', 'easing' ), '9.5.4', true );
        wp_enqueue_script( 'tripmd-typekit', '//use.typekit.net/jlx8kbu.js', array(), '0.1', true );

        // We currently use Easy Fancybox plugin as this is not working
        /*
        if ( is_front_page() ) {
             wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.5', false );
             add_action( 'wp_footer', 'tmd_fancybox_footjs', 500 );
        } */

        /*
        wp_enqueue_script( 'tripmd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
        wp_enqueue_script( 'tripmd-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        wp_enqueue_script( 'tripmd-ss-min', get_template_directory_uri() . '/js/ss-min.js', array(), '0.1', true );
        wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), '0.1', true );
        wp_enqueue_script( 'sidebar-effects', get_template_directory_uri() . '/js/sidebarEffects.js', array(), '0.1', true );
        wp_enqueue_script( 'ligature', get_template_directory_uri() . '/js/ligature.js', array(), '0.1', true );
        */

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Embed script in the footer
     */
    public static function footer() {

        // Fancybox jQuery script for clinic signup/login
        echo '<script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery(".fancybox").fancybox({
                    maxWidth    : 800,
                    maxHeight   : 600,
                    fitToView   : false,
                    width       : \'70%\',
                    height      : \'70%\',
                    autoSize    : false,
                    closeClick  : false,
                    openEffect  : \'none\',
                    closeEffect : \'none\'
                });
            });
        </script>';
    }

    /**
     * Handle the session to store the spec, proc etc id's
     * 
     * @uses WP_Session WP Session plugin
     */
    public static function setup_session() {
        if ( !is_a( tripmd()->session, 'WP_Session' ) )
            return;

        // Increase WP_Session time
        add_filter( 'wp_session_expiration', function() { return 60 * 60 * 5; } ); // Set expiration to 5 hours

        // Do we need session -- only on single pages of reqd types
        if ( !is_single() || ( is_single() && !in_array( get_post_type(), array( 'speciality', 'procedure', 'hospital', 'doctor' ) ) ) )
            return;

        switch ( get_post_type() ) {
            case 'speciality' :
                tripmd()->session['speciality_id'] = get_the_ID();
                break;

            case 'procedure' :
                tripmd()->session['speciality_id'] = get_post_ancestors( get_the_ID() )[0];
                tripmd()->session['procedure_id']  = get_the_ID();
                break;

            case 'hospital' :
                tripmd()->session['hospital_id'] = get_the_ID();
                break;

            case 'doctor' :
                tripmd()->session['doctor_id'] = get_the_ID();
                break;
        }
    }

    /**
     * Get the id of the supplied key from the session
     * Used in single-*.php files
     * 
     * @param string $key
     * @return int ID
     */
    public function get_session( $key = '' ) {
        if ( !is_a( tripmd()->session, 'WP_Session' ) || !in_array( $key, array( 'speciality', 'procedure', 'hospital', 'doctor' ) ) )
            return -1;

        return tripmd()->session[$key . '_id'];
    }
}

/**
 * The main function responsible for returning the one true TripMD Instance
 * to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $tmd = tripmd(); ?>
 *
 * @return The one true TripMD Instance
 */
function tripmd() {
    return TripMD::instance();
}

// "And now here's something we hope you'll really like!"

/**
 * Hook TripMD onto the 'after_setup_theme' action.
 * 
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action( 'after_setup_theme', 'tripmd' );

