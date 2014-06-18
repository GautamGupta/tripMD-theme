<?php
/**
 * tripmd functions and definitions
 *
 * @package tripmd
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/** Errors ********************************************************************/

/**
 * Adds an error message to later be output in the theme
 *
 * @see WP_Error()
 * @uses WP_Error::add();
 *
 * @param string $code Unique code for the error message
 * @param string $message Translated error message
 * @param string $data Any additional data passed with the error message
 */
function tmd_add_error( $code = '', $message = '', $data = '' ) {
	global $tmd_errors;
	$tmd_errors->add( 'tmd-' . $code, $message, $data );
}

/**
 * Check if error messages exist in queue
 *
 * @see WP_Error()
 * @uses WP_Error::get_error_codes()
 * 
 * @return bool
 */
function tmd_has_errors() {
	global $tmd_errors;
	return $tmd_errors->get_error_codes() ? true : false;
}

/**
 * Return error messages in queue
 *
 * @see WP_Error()
 * @uses WP_Error::get_error_codes()
 * 
 * @return array Messages
 */
function tmd_get_errors() {
	global $tmd_errors;
	return $tmd_errors->get_error_messages();
}

if ( ! function_exists( 'tripmd_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tripmd_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on tripmd, use a find and replace
	 * to change 'tripmd' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tripmd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tripmd' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	/* add_theme_support( 'custom-background', apply_filters( 'tripmd_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) ); */

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	/**
	 * Error API
	 * 
	 * @uses WP_Error
	 */
	global $tmd_errors;
	$tmd_errors = new WP_Error();
}
endif; // tripmd_setup
add_action( 'after_setup_theme', 'tripmd_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tripmd_widgets_init() {
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
add_action( 'widgets_init', 'tripmd_widgets_init' );

add_action( 'wp_ajax_documentUploadCB', 'my_action_cb' );
add_action( 'wp_ajax_nopriv_documentUploadCB', 'my_action_cb' );

function my_action_cb() {
	if (!wp_verify_nonce ( $_GET['nonce'], 'document_upload' )) {
		die('CSRF attack detected');	
	}
	$my_attachment = array(
      'ID'           => $_GET['aid'],
  	);
  	$my_attachment['post_parent'] = $_GET['pid'];
	wp_update_post( $my_attachment );
	die();
}

/**
 * Enqueue scripts and styles.
 */
function tripmd_scripts() {

	wp_enqueue_style( 'tripmd', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'unsemantic', get_template_directory_uri() . '/css/unsemantic.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
    wp_enqueue_script( 'tmd_media_upload', get_template_directory_uri() . '/js/upload.js', array( 'jquery' ), '0.0.1', false );
    if ( is_front_page() )  {
        wp_enqueue_style( 'royalslider', get_template_directory_uri() . '/css/royalslider/royalslider.css', array(), '9.5.4' );
        wp_enqueue_style( 'royalslider-skins-default', get_template_directory_uri() . '/css/royalslider/skins/default/rs-default.css', array( 'royalslider' ), '9.5.4' );
        wp_enqueue_style( 'royalslider-skins-minimal-white', get_template_directory_uri() . '/css/royalslider/skins/minimal-white/rs-minimal-white.css', array( 'royalslider' ), '9.5.4' );
        wp_enqueue_style( 'tripmd-home', get_template_directory_uri() . '/css/home.css', array( 'tripmd' ) );
    } if (get_post_type() == "consultation") {
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
add_action( 'wp_enqueue_scripts', 'tripmd_scripts' );

/* Not using fancybox for the time being */

function tmd_fancybox_footjs() {

	echo '<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".fancybox").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: false,
				width		: \'70%\',
				height		: \'70%\',
				autoSize	: false,
				closeClick	: false,
				openEffect	: \'none\',
				closeEffect	: \'none\'
			});
		});
	</script>';

}

/**
 * Handle the session to store the spec, proc etc id's
 * 
 * @uses WP_Session WP Session plugin
 */
function tripmd_session_handler() {
	if ( !class_exists( 'WP_Session' ) ) // Requires WP Session plugin
		return;

	global $wp_session;
	$wp_session = WP_Session::get_instance();

	// Do we need session -- only on single pages of reqd types
	if ( !is_single() || ( is_single() && !in_array( get_post_type(), array( 'speciality', 'procedure', 'hospital', 'doctor' ) ) ) )
		return;

	switch ( get_post_type() ) {
		case 'speciality' :
			$wp_session['speciality_id'] = get_the_ID();
			break;

		case 'procedure' :
			$wp_session['procedure_id'] = get_the_ID();
			break;

		case 'hospital' :
			$wp_session['hospital_id'] = get_the_ID();
			break;

		case 'doctor' :
			$wp_session['doctor_id'] = get_the_ID();
			break;
	}
}
add_action( 'wp', 'tripmd_session_handler' );

/**
 * Get the id of the supplied key from the session
 * Used in single-*.php files
 * 
 * @param string $key
 * @return int ID
 */
function tripmd_session_get_id( $key = '' ) {
	if ( !in_array( $key, array( 'speciality', 'procedure', 'hospital', 'doctor' ) ) )
		return -1;

	global $wp_session;
	$wp_session = WP_Session::get_instance();
	
	return $wp_session[$key . '_id'];
}

/**
 * Fix specialities order on archive page
 */
function tmd_specialities_order( $query ) {
    if ( is_post_type_archive( 'speciality' ) ) {
        $query->set( 'posts_per_page', -1 );
        $query->set( 'order', 'ASC' );
        $query->set( 'orderby', 'menu_order title' );
    }
}
add_action( 'pre_get_posts', 'tmd_specialities_order' );

/**
 * Handle homepage signups
 */
function tmd_register_home_handler() {
    if ( empty( $_POST['tmd_home_register'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_home_register' ) || empty( $_POST['user_email'] ) )
    	return false;

    add_filter( 'pre_user_first_name', 'tmd_register_home_handler_fn' );
    add_filter( 'pre_user_last_name', 'tmd_register_home_handler_ln' );

    $_POST['user_login'] = $_POST['user_email'];
}
add_action( 'login_init', 'tmd_register_home_handler' );

function tmd_register_home_handler_login( $username = '' ) {
	return !empty( $_POST['user_email'] ) && !is_admin() ? sanitize_user( trim( $_POST['user_email'] ) ) : $username;
}
add_filter( 'pre_user_login', 'tmd_register_home_handler_login' ); // Always force

function tmd_register_home_handler_fn( $firstname = '' ) {
	return !empty( $_POST['first_name'] ) ? sanitize_user( trim( $_POST['first_name'] ) ) : $firstname;
}

function tmd_register_home_handler_ln( $lastname = '' ) {
	return !empty( $_POST['last_name'] ) ? sanitize_user( trim( $_POST['last_name'] ) ) : $lastname;
}

function tmd_register_hospital_handler() {
	if ( empty( $_POST['hsign'] ) )
		return false;

    if ( empty( $_POST['medical_centre'] ) ||  empty($_POST['country']) ||  empty($_POST['poc']) || empty($_POST['email']) ||!wp_verify_nonce( $_POST['_wpnonce'], 'tmd_home_register' ) ) {
    	wp_redirect( home_url( '?hsign=error#hs' ) );
    	exit;
    }

	$new_post = array(
		'post_title' => $_POST['medical_centre'],
		'post_status' => 'draft',
		'post_type' => 'hospital'
	);
	$post_id = wp_insert_post($new_post);
	add_post_meta($post_id, 'country', trim($_POST['country']));
	add_post_meta($post_id, 'poc', trim($_POST['poc']));
	add_post_meta($post_id, 'email', trim($_POST['email']));
	wp_redirect( home_url( '?hsign=success#hs' ) );
	exit;

}
add_action( 'init', 'tmd_register_hospital_handler' );

/**
 * Beta signup handler for /beta
 */
function tmd_register_beta_handler() {
	if ( empty( $_POST['tmd_beta_register'] ) )
		return;

    global $wpdb;

	if ( !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_beta_register_nonce' ) )
		tmd_add_error( 'nonce', __( 'Are you sure that you\'re doing that?', 'tripmd' ) );

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
			'condition' => !empty( $_POST['tmd_bs_condition'] ) ? $_POST['tmd_bs_condition'] : '', 
			'registered' => date('Y-m-d H:i:s')
		), 
		'%s'
	);

	if ( empty( $registered ) )
		tmd_add_error( 'error-registration', __( 'There was a problem registering you. Please try again or contact us at help@tripmd.com.', 'tripmd' ) );
}
add_action( 'pre_get_posts', 'tmd_register_beta_handler' );

// Increase WP_Session time
add_filter( 'wp_session_expiration', function() { return 60 * 60 * 5; } ); // Set expiration to 5 hours

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Registration + Consultation stuff
 */
require get_template_directory() . '/inc/signup.php';

/**
 * Post types for tripMD
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Typeahead Search for front page
 */
require get_template_directory() . '/inc/typeahead-search.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
