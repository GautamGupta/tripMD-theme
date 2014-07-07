<?php
/**
 * @package TripMD
 * @subpackage Admin
 */

// Add the meta box callback function
function tmd_admin_init(){
    foreach ( tmd_get_post_types() as $post_type )
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
    if ( !isset( $_POST['parent_id'] ) || !in_array( $_POST['post_type'], tmd_get_post_types() )
        || empty( $_POST['parent_id_noncename'] ) || !wp_verify_nonce( $_POST['parent_id_noncename'], __FILE__ ) ) return $post_id;
    
    update_post_meta( $post_id, 'parent_id', $_POST['parent_id'] );
    if ( 'doctor' == $_POST['post_type'] )
        update_post_meta( $post_id, 'specialities', $_POST['specialities'] );
}
add_action( 'save_post', 'tmd_save_listing_parent_id' );
