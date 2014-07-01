<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package tripmd
 */

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
     * @uses bbp_get_tab_index If bbPress is active
     * @param int $auto_increment Optional. Default true. Set to false to
     *                             prevent the increment
     * @return int The global tab index
     */
    function tmd_get_tab_index( $auto_increment = true ) {
        if ( function_exists( 'bbp_get_tab_index' ) )
            $tab_index = bbp_get_tab_index( $auto_increment );
        else {
            global $tmd_tab_index;

            if ( true === $auto_increment )
                ++$tmd_tab_index;

            $tab_index = $tmd_tab_index;
        }

        return apply_filters( 'tmd_get_tab_index', (int) $tab_index );
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
     * Borrowed from bbPress bbp_get_sanitize_val()
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

if ( ! function_exists( 'tripmd_paging_nav' ) ) :
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
endif;

if ( ! function_exists( 'tripmd_post_nav' ) ) :
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
endif;

if ( ! function_exists( 'tripmd_posted_on' ) ) :
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
endif;

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