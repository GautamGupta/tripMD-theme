<?php
/**
 * @package tripMD
 * @version 0.1
 */
function tmd_register_post_types() {

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
	register_post_type( 'speciality', $args );

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
	register_post_type( 'procedure', $args );

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
		'slug'                => 'hospital',
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
	register_post_type( 'hospital', $args );

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
	register_post_type( 'doctor', $args );

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
	register_post_type( 'room', $args );


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
		'slug'                => 'consultations',
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
	register_post_type( 'consultation', $args );


}
add_action( 'init', 'tmd_register_post_types', 2 );

function tmd_post_types() {
	return array ( 'speciality', 'procedure', 'hospital', 'doctor', 'room', 'consultation' );
}

//Add the meta box callback function
function tmd_admin_init(){
	foreach ( tmd_post_types() as $post_type )
		add_meta_box( 'tmd_listing_parent_id', __( 'Listing Parent ID', 'tripmd' ), 'tmd_set_listing_parent_id', $post_type, 'normal', 'low' );
}
add_action( 'admin_init', 'tmd_admin_init' );

//Meta box for setting the parent ID
function tmd_set_listing_parent_id() {
	global $post;
	$custom = get_post_custom( $post->ID );
	$parent_id = $custom['parent_id'][0];
	$specialities = get_post_meta( $post->ID, 'specialities', true );
	?>
	<p>Please specify the ID of the listing to be a parent to this listing.</p>
	<p>Leave blank for no hierarchy. Listings will appear from the server root with no associated parent.</p>
	<input type="text" id="parent_id" name="parent_id" value="<?php echo $post->post_parent; ?>" />
	<?php if ( 'doctor' == $post->post_type ) : ?>
		<p>Specialities</p>
		<input type="text" id="specialities" name="specialities" value="<?php echo $specialities; ?>" />
	<?php
	endif;
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="parent_id_noncename" value="' . wp_create_nonce( __FILE__ ) . '" />';
}

// Save the meta data
function tmd_save_listing_parent_id( $post_id ) {
	global $post;

	// make sure data came from our meta box
	if ( !isset( $_POST['parent_id'] ) || !in_array( $_POST['post_type'], tmd_post_types() )
		|| empty( $_POST['parent_id_noncename'] ) || !wp_verify_nonce( $_POST['parent_id_noncename'], __FILE__ ) ) return $post_id;
	
	update_post_meta( $post_id, 'parent_id', $_POST['parent_id'] );
	if ( 'doctor' == $_POST['post_type'] )
		update_post_meta( $post_id, 'specialities', $_POST['specialities'] );
}
add_action( 'save_post', 'tmd_save_listing_parent_id' );

?>