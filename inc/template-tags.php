<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package tripmd
 */

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
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

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
        'helper-staff' => __( 'Heler Staff', 'tripmd' ),
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