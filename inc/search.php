<?php
/**
 * tripMD Homepage autocomplete search functionality
 * 
 * Fork of Search Autocomplete plugin
 * http://wordpress.org/extend/plugins/search-autocomplete/
 *
 * @package tripMD
 * @subpackage Typeahead
 */

class tMDTypeaheadSearch {
	var $options = array(
		'fieldName'          => '#s',
		'minimum'            => 1,
		'numrows'            => 10,
		'hotlinks'			 => array( 'posts', 'taxonomies' ),
		'posttypes'          => array( 'speciality', 'procedure', 'hospital' ),
		'taxonomies'         => array(),
		'sortorder'          => 'posts',
	);

	public function __construct() {
		$this->initAjax();
		add_action( 'wp_enqueue_scripts', array( $this, 'initScripts' ) );
	}

	public function initScripts() {
		if ( !is_front_page() && !is_single() && 'speciality' != get_post_type() ) return;

		$localVars = array(
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
			'fieldName' => $this->options['fieldName'],
			'minLength' => $this->options['minimum']
		);
		
		wp_enqueue_script ( 'typeahead',    get_template_directory_uri() . '/js/typeahead/typeahead.bundle.js',  array( 'jquery' ),                            '0.10.2', true );
		wp_enqueue_script ( 'handlebars',   get_template_directory_uri() . '/js/typeahead/handlebars-v1.3.0.js', array( 'jquery', 'typeahead' ),               '1.3.0',  true );
		wp_enqueue_script ( 'typeahead-wp', get_template_directory_uri() . '/js/typeahead/typeahead.wp.js',      array( 'jquery', 'typeahead', 'handlebars' ), '0.1',    true );
		wp_localize_script( 'typeahead-wp', 'TypeaheadSearch', $localVars );
	}

	public function initAjax() {
		add_action( 'wp_ajax_typeaheadCallback',        array( $this, 'acCallback' ) );
		add_action( 'wp_ajax_nopriv_typeaheadCallback', array( $this, 'acCallback' ) );
	}

	public function acCallback() {
		global $wpdb;
		$resultsPosts = array();
		$resultsTerms = array();
		$term         = sanitize_text_field( $_GET['term'] );
		if ( count( $this->options['posttypes'] ) > 0 ) {
			$type      = sanitize_text_field( $_GET['type'] );
			$tempPosts = get_posts( array(
				's'           => $term,
				'numberposts' => -1, $this->options['numrows'],
				'post_type'   => ! empty( $type ) ? $type : $this->options['posttypes'],
			) );
			foreach ( $tempPosts as $post ) {
				$tempObject = array(
					'id' => $post->ID,
					'type' => 'post',
					'taxonomy' => null,
					'postType' => $post->post_type
				);
				$linkTitle = apply_filters( 'the_title', $post->post_title );
				$linkTitle = html_entity_decode( $linkTitle, ENT_NOQUOTES, 'UTF-8' );
				if ( ! in_array( 'posts', $this->options['hotlinks'] ) ) {
					$linkURL = '#';
				} else {
					$linkURL = get_permalink( $post->ID );
					// $linkURL = apply_filters( 'search_modify_url', $linkURL, $tempObject );
				}
				$result = array(
					'title' => $linkTitle,
					'url'   => $linkURL,
					'tokens' => explode( ' ', $linkTitle ),
				);
				$resultsPosts[] = $result;
			}
		}
		if ( count( $this->options['taxonomies'] ) > 0 ) {
			$taxonomyTypes = "AND ( tax.taxonomy = '" . implode( "' OR tax.taxonomy = '", $this->options['taxonomies'] ) . "') ";
			$queryStringTaxonomies = 'SELECT term.term_id as id, term.name as post_title, term.slug as guid, tax.taxonomy, 0 AS content_frequency, 0 AS title_frequency FROM ' . $wpdb->term_taxonomy . ' tax ' .
					'LEFT JOIN ' . $wpdb->terms . ' term ON term.term_id = tax.term_id WHERE 1 = 1 ' .
					'AND term.name LIKE "%' . $term . '%" ' .
					$taxonomyTypes .
					'ORDER BY tax.count DESC ' .
					'LIMIT 0, ' . $this->options['numrows'];
			$tempTerms             = $wpdb->get_results( $queryStringTaxonomies );
			foreach ( $tempTerms as $term ) {
				$tempObject = array(
					'id' => $term->id,
					'type' => 'taxonomy',
					'taxonomy' => $term->taxonomy,
					'postType' => null
				);
				$linkTitle = apply_filters( 'the_title', $term->post_title );
				$linkTitle = html_entity_decode( $linkTitle );
				if ( ! in_array( 'taxonomies', $this->options['hotlinks'] ) ) {
					$linkURL = '#';
				} else {
					$linkURL = get_term_link( $term->guid, $term->taxonomy );
					// $linkURL = apply_filters( 'search_modify_url', $linkURL, $tempObject );
				}
				$resultsTerms[] = array(
					'title' => $linkTitle,
					'url'   => $linkURL,
				);
			}
		}
		if ( $this->options['sortorder'] == 'posts' ) {
			$results = array_merge( $resultsPosts, $resultsTerms );
			$results = array_merge( $resultsTerms, $resultsPosts );
		}
		// $results = apply_filters( 'tmd_search_modify_results', $results );
		// $results = array_slice( $results, 0, $this->options['numrows'] );
		echo json_encode( $results );
		die();
	}
}

$tmd_typeahead_search = new tMDTypeaheadSearch();
