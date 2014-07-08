<?php

/**
 * Custom template tags for this theme.
 *
 * @package TripMD
 * @subpackage Template
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/** URLs **********************************************************************/

/**
 * Correct any custom post type link outputs
 * 
 * Eg. hospital name is directly with root
 */
function tmd_custom_post_type_link( $permalink, $post, $leavename ) {
    if ( !gettype( $post ) == 'post' ) {
        return $permalink;
    }
    switch ( $post->post_type ) {
        case 'hospital' :
            $permalink = get_home_url() . '/' . $post->post_name . '/';
            break;
    }
 
    return $permalink;
}
add_filter( 'post_type_link', 'tmd_custom_post_type_link', 10, 3 );

/** Add-on Actions ************************************************************/

/**
 * Add our custom head action to wp_head
 *
 * @uses do_action() Calls 'tmd_head'
*/
function tmd_head() {
    do_action( 'tmd_head' );
}

/**
 * Add our custom head action to wp_head
 *
 * @uses do_action() Calls 'tmd_footer'
 */
function tmd_footer() {
    do_action( 'tmd_footer' );
}

/** is_ ***********************************************************************/

/**
 * Check if the current post type is one of TripMD's
 *
 * @param mixed $the_post Optional. Post object or post ID.
 * @uses get_post_type()
 * @uses tmd_get_post_types()
 *
 * @return bool
 */
function tmd_is_custom_post_type( $the_post = false ) {

    // Assume false
    $retval = false;

    // Viewing one of the bbPress post types
    if ( in_array( get_post_type( $the_post ), tmd_get_post_types() ) )
        $retval = true;

    return $retval;
}

    /**
     * Get TripMD post types
     * 
     * @return array
     */
    function tmd_get_post_types() {
        return array( 'speciality', 'procedure', 'hospital', 'doctor', 'room', 'consultation' );
    }

/**
 * Use the above is_() functions to output a body class for each scenario
 *
 * @todo Make it work
 * 
 * @return array Body Classes
 */
function tmd_body_class( $wp_classes, $custom_classes = false ) {

    $tmd_classes = array();

    /** Archives **************************************************************/
    /*
    if ( tmd_is_forum_archive() ) {
        $tmd_classes[] = tmd_get_forum_post_type() . '-archive';

    } elseif ( tmd_is_topic_archive() ) {
        $tmd_classes[] = tmd_get_topic_post_type() . '-archive';
        
    }

    /** Clean up **************************************************************/

    // Add TripMD class if we are within a TripMD page
    if ( !empty( $tmd_classes ) ) {
        $tmd_classes[] = 'tripmd';
    }

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $tmd_classes[] = 'group-blog';
    }

    // Merge WP classes with TripMD classes and remove any duplicates
    $classes = array_unique( array_merge( (array) $tmd_classes, (array) $wp_classes ) );

    return apply_filters( 'tmd_body_class', $classes, $tmd_classes, $wp_classes, $custom_classes );
}

/**
 * Use the above is_() functions to return if in any TripMD page
 * 
 * @todo Make it work
 *
 * @return bool
 */
function is_tripmd() {

    // Defalt to false
    $retval = false;

    /** Archives **************************************************************/
    /*
    if ( tmd_is_forum_archive() ) {
        $retval = true;

    } elseif ( tmd_is_topic_archive() ) {
        $retval = true;

    /** User ******************************************************************/
    /*

    } elseif ( tmd_is_single_user_edit() ) {
        $retval = true;

    } elseif ( tmd_is_single_user() ) {
        $retval = true;

    /** Search ****************************************************************/
    /*

    } elseif ( tmd_is_search() ) {
        $retval = true;

    } elseif ( tmd_is_search_results() ) {
        $retval = true;
    }

    /** Done ******************************************************************/

    return (bool) $retval;
}

/** Forms *********************************************************************/

/**
 * Output hidden request URI field for user forms.
 *
 * The referer link is the current Request URI from the server super global. To
 * output the field manually, use tmd_get_redirect_to().
 *
 * @param string $redirect_to Pass a URL to redirect to
 *
 * @uses wp_get_referer() To get the referer
 * @uses esc_attr() To escape the url
 */
function tmd_redirect_to_field( $redirect_to = '' ) {

    // Make sure we are directing somewhere
    if ( empty( $redirect_to ) ) {
        if ( isset( $_SERVER['REQUEST_URI'] ) ) {
            $redirect_to = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        } else {
            $redirect_to = wp_get_referer();
        }
    }

    // Remove loggedout query arg if it's there
    $redirect_to    = (string) esc_attr( remove_query_arg( 'loggedout', $redirect_to ) );
    $redirect_field = '<input type="hidden" id="tmd_redirect_to" name="redirect_to" value="' . $redirect_to . '" />';

    echo $redirect_field;
}

/**
 * Echo sanitized $_REQUEST value.
 *
 * Use the $input_type parameter to properly process the value. This
 * ensures correct sanitization of the value for the receiving input.
 *
 * @param string $request Name of $_REQUEST to look for
 * @param string $input_type Type of input. Default: text. Accepts:
 *                            textarea|password|select|radio|checkbox
 * @uses tmd_get_sanitize_val() To sanitize the value.
 */
function tmd_sanitize_val( $request = '', $input_type = 'text' ) {
    echo tmd_get_sanitize_val( $request, $input_type );
}
    /**
     * Return sanitized $_REQUEST value.
     *
     * Use the $input_type parameter to properly process the value. This
     * ensures correct sanitization of the value for the receiving input.
     * 
     * Borrowed from bbPress tmd_get_sanitize_val()
     *
     * @param string $request Name of $_REQUEST to look for
     * @param string $input_type Type of input. Default: text. Accepts:
     *                            textarea|password|select|radio|checkbox
     * @uses esc_attr() To escape the string
     * @uses apply_filters() Calls 'tmd_get_sanitize_val' with the sanitized
     *                        value, request and input type
     * @return string Sanitized value ready for screen display
     */
    function tmd_get_sanitize_val( $request = '', $input_type = 'text' ) {

        // Check that requested
        if ( empty( $_REQUEST[$request] ) )
            return false;

        // Set request varaible
        $pre_ret_val = $_REQUEST[$request];

        // Treat different kinds of fields in different ways
        switch ( $input_type ) {
            case 'text'     :
            case 'textarea' :
                $retval = esc_attr( stripslashes( $pre_ret_val ) );
                break;

            case 'password' :
            case 'select'   :
            case 'radio'    :
            case 'checkbox' :
            default :
                $retval = esc_attr( $pre_ret_val );
                break;
        }

        return apply_filters( 'tmd_get_sanitize_val', $retval, $request, $input_type );
    }

/**
 * Output the current tab index of a given form
 *
 * Use this function to handle the tab indexing of user facing forms within a
 * template file. Calling this function will automatically increment the global
 * tab index by default.
 *
 * @param int $auto_increment Optional. Default true. Set to false to prevent
 *                             increment
 */
function tmd_tab_index( $auto_increment = true ) {
    echo tmd_get_tab_index( $auto_increment );
}

    /**
     * Output the current tab index of a given form
     *
     * Use this function to handle the tab indexing of user facing forms
     * within a template file. Calling this function will automatically
     * increment the global tab index by default.
     *
     * @uses apply_filters Allows return value to be filtered
     * @uses tmd_get_tab_index If bbPress is active
     * @param int $auto_increment Optional. Default true. Set to false to
     *                             prevent the increment
     * @return int The global tab index
     */
    function tmd_get_tab_index( $auto_increment = true ) {
        if ( function_exists( 'tmd_get_tab_index' ) ) {
            $tab_index = tmd_get_tab_index( $auto_increment );
        } else {
            global $tmd_tab_index;

            if ( true === $auto_increment )
                ++$tmd_tab_index;

            $tab_index = $tmd_tab_index;
        }

        return apply_filters( 'tmd_get_tab_index', (int) $tab_index );
    }

/** Errors & Messages *********************************************************/

/**
 * Display possible errors & messages inside a template file
 *
 * @uses WP_Error bbPress::errors::get_error_codes() To get the error codes
 * @uses WP_Error bbPress::errors::get_error_data() To get the error data
 * @uses WP_Error bbPress::errors::get_error_messages() To get the error
 *                                                       messages
 * @uses is_wp_error() To check if it's a {@link WP_Error}
 */
function tmd_template_notices() {

    // Bail if no notices or errors
    if ( !tmd_has_errors() )
        return;

    // Define local variable(s)
    $errors = $messages = array();

    // Get TripMD
    $tmd = tripmd();

    // Loop through notices
    foreach ( $tmd->errors->get_error_codes() as $code ) {

        // Get notice severity
        $severity = $tmd->errors->get_error_data( $code );

        // Loop through notices and separate errors from messages
        foreach ( $tmd->errors->get_error_messages( $code ) as $error ) {
            if ( 'message' === $severity ) {
                $messages[] = $error;
            } else {
                $errors[]   = $error;
            }
        }
    }

    // Display errors first...
    if ( !empty( $errors ) ) : ?>

        <div class="tmd-template-notice error">
            <p>
                <?php echo implode( "</p>\n<p>", $errors ); ?>
            </p>
        </div>

    <?php endif;

    // ...and messages last
    if ( !empty( $messages ) ) : ?>

        <div class="tmd-template-notice">
            <p>
                <?php echo implode( "</p>\n<p>", $messages ); ?>
            </p>
        </div>

    <?php endif;
}

/** Title *********************************************************************/

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tmd_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        $title .= " $sep " . sprintf( __( 'Page %s', 'tripmd' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'tmd_wp_title', 10, 2 );

/** _s ************************************************************************/

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function tmd_setup_author() {
    global $wp_query;

    if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
        $GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
    }
}
add_action( 'wp', 'tmd_setup_author' );

/**
 * Display navigation to next/previous set of posts when applicable.
 */
function tripmd_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'tripmd' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'tripmd' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'tripmd' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Display navigation to next/previous post when applicable.
 */
function tripmd_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'tripmd' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'tripmd' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'tripmd' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tripmd_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	/* if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	} */

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'tripmd' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tripmd_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tripmd_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tripmd_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tripmd_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tripmd_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in tripmd_categorized_blog.
 */
function tripmd_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'tripmd_categories' );
}
add_action( 'edit_category', 'tripmd_category_transient_flusher' );
add_action( 'save_post',     'tripmd_category_transient_flusher' );

/** TripMD ********************************************************************/

function tmd_price( $price = 0 ) {
	echo '$' . join( ' - ', array_map( 'number_format_i18n', explode( '-', $price ) ) );
}

function tmd_rating( $rating = 3.5 ) {
	for ( $i = 0; $i < $rating; $i += 1 ) {
		if ( ( $rating - $i ) < 1 )
			echo '<i class="fa fa-star-half-full"></i>';
		else
			echo '<i class="fa fa-star"></i>';
	}
}

function tmd_amenities( $amenities = array() ) {
    if ( !is_array( $amenities ) && !empty( $amenities ) )
        $amenities = array_map( 'trim', (array) explode( ',', $amenities ) );
    elseif ( empty ($amenities ) )
        return;
    
    $amenities_names = array(
        'helper-staff' => __( 'Helper Staff', 'tripmd' ),
        'companion' => __( 'Companion Lounge', 'tripmd' ),
        'cafe' => __( 'Cafeteria', 'tripmd' ),
        'ambulance' => __( 'Ambulance Services', 'tripmd' ),
        'internet' => __( 'Internet', 'tripmd' ),
        'air-condition' => __( 'Air Conditioning', 'tripmd' ),
        'parking' => __( 'Free Parking', 'tripmd' ),
        /* 'heating' => 'Heating',
        'smoking' => 'Smoking',
        'tv' => 'Television',
        'elevator' => 'Elevators', */
    );
    $amenities_not = array(); ?>

    <div class="grid-50">
        <div class="et-custom-list">
            <ul>
                <?php foreach( $amenities_names as $key => $name ) {
                    if ( in_array( $key, $amenities ) )
                        echo "<li>{$name}</li>";
                    else
                        $amenities_not[$key] = $name;
                } ?>
            </ul>
        </div> <!-- .et-custom-list -->
    </div>

    <div class="grid-50">
        <div class="et-custom-list etlist-x">
            <ul>
                <?php foreach( $amenities_not as $key => $name )
                        echo "<li>{$name}</li>"; ?>
            </ul>
        </div> <!-- .et-custom-list -->
    </div>
<?php }

/**
 * Registered users count. Used on beta signup.
 */
function tmd_user_count() {
	global $wpdb;
	$result1 = count_users();
	$result2 = $wpdb->get_var( "SELECT COUNT(id) FROM {$wpdb->prefix}tmd_beta_users" );
	return $result1['total_users'] + $result2;
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