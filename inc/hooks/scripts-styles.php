<?php
/**
 * Enqueue and localize theme scripts and styles
 *
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-02-09 11:04:24
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * Heatmap stuff
 */
function heatmap_data() {
  global $post;

  // Start local array settings
  $heatmap_args = array(
    'post_type' => 'any',
    'posts_per_page' => 380, // phpcs:ignore
    'no_found_rows' => true,
    'post_status' => 'publish',
  );

  $heatmap_query = get_posts( $heatmap_args );

  // Get words from Rollekino
	// First check if data exists
  $rollekino_query = get_transient( 'rollekino_query' );

	if ( false === $rollekino_query ) {
		$response = wp_remote_get( 'https://www.rollekino.fi/wp-json/words/v1/getposts' );

		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return;
		}

		// Get body of the response
		$rollekino_query = json_decode( wp_remote_retrieve_body( $response ), true );

		// Put the results in a transient. Expire after 24 hours.
		set_transient( 'rollekino_words_response', $rollekino_query, 24 * 60 * 60 );
	}

  // Get words from Dude
	// First check if data exists
  $dude_query = get_transient( 'dude_query' );

	if ( false === $dude_query ) {
		$response_dude = wp_remote_get( 'https://www.dude.fi/wp-json/words/v1/getposts' );

		if ( 200 !== wp_remote_retrieve_response_code( $response_dude ) ) {
			return;
		}

		// Get body of the response
		$dude_query = json_decode( wp_remote_retrieve_body( $response_dude ), true );

		// Put the results in a transient. Expire after 24 hours.
		set_transient( 'dude_words_response', $dude_query, 24 * 60 * 60 );
	}

  // Get words from Rolle.design
	// First check if data exists
  $rolledesign_query = get_transient( 'rolledesign_query' );

	if ( false === $rolledesign_query ) {
		$response_rolledesign = wp_remote_get( 'https://rolle.design/wp-json/words/v1/getposts' );

		if ( 200 !== wp_remote_retrieve_response_code( $response_rolledesign ) ) {
			return;
		}

		// Get body of the response
		$rolledesign_query = json_decode( wp_remote_retrieve_body( $response_rolledesign ), true );

		// Put the results in a transient. Expire after 24 hours.
		set_transient( 'dude_words_response', $rolledesign_query, 24 * 60 * 60 );
	}

  $merged = array_merge( $heatmap_query, $rollekino_query, $dude_query, $rolledesign_query );

  // $heatmap_post_array = array();
  foreach ( $merged as $key => $heatmap_post ) {
		setup_postdata( $heatmap_post );

		// Word count
    if ( null !== $heatmap_post->ID ) {
      $post_id = $heatmap_post->ID;
      $post_object = get_post( $post_id );
      $content = $post_object->post_content;
      $word_count = post_word_count( $content );
    } else {
      $word_count = post_word_count( $heatmap_post['post_content'] );
    }

    // Timestamps
    if ( null !== $heatmap_post->ID ) {
      $unix_timestamp = get_post_timestamp( $heatmap_post );
      $day = get_the_time( 'Y-m-d', $post_id );
      $day_in_unix_format = strtotime( get_the_time( 'Y-m-d', $post_id ) );
    } else {
      $unix_timestamp = strtotime( $heatmap_post['post_date_gmt'] );
      $day = gmdate( 'Y-m-d', strtotime( $heatmap_post['post_date_gmt'] ) );
      $day_in_unix_format = strtotime( gmdate( 'Y-m-d', strtotime( $heatmap_post['post_date_gmt'] ) ) );
    }

    // Form an array
    $heatmap_post_array[ $day ] = $word_count;

    // If same day has multiple posts, combine word counts and show total count for one day
    if ( array_key_exists( $day, $heatmap_post_array ) ) {
      $heatmap_post_array[ $day_in_unix_format ] = $heatmap_post_array[ $day_in_unix_format ] + $word_count;
    } else {
      $heatmap_post_array[ $day_in_unix_format ] = $word_count;
    }
  }

  // Rollemaa data
  return $heatmap_post_array;
}

/**
 * Vue feed queries for Swup.
 */
function paged_query_for_swup() {
  global $post;

  // Query for SWUP for each page
  $selected_posts = get_field( 'selected_posts', 'option', false, false );
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 6, // NB! When you change this, change also posts_per_page option
    'cache_results' => true,
    'update_post_term_cache' => true,
    'update_post_meta_cache' => true,
    'no_found_rows' => true,
    'post_status' => 'publish',
    'post__not_in' => $selected_posts,
  );

  $query = new \WP_Query( $args );

  // Check if we should event show load more button
  // in the first place and save query to js variable for later use.
  if ( $query->found_posts !== $query->post_count ) {
    $query->query['paged'] = 1;
    $posts_query_original = $query->query; // phpcs:ignore
    $posts_query = $query->query; // phpcs:ignore

    $queries = array(
      'posts_query_original' => $posts_query_original,
      'posts_query' => $posts_query,
    );

    return $queries;
  }
}

/**
 * Enqueue scripts and styles.
 */
function enqueue_theme_scripts() {
  // Disable jQuery (included in all.js and normally on wp-admin)
  if ( ! is_admin() ) wp_deregister_script( 'jquery' );
  if ( ! is_admin() ) wp_deregister_script( 'jquery-core' );
  if ( ! is_admin() ) wp_deregister_script( 'jquery-migrate' );

  // Enqueue global.css
  wp_enqueue_style( 'styles',
    get_theme_file_uri( get_asset_file( 'global.css' ) ),
    [],
    filemtime( get_theme_file_path( get_asset_file( 'global.css' ) ) )
  );

  // Enqueue jquery and front-end.js
  wp_enqueue_script( 'jquery-core' );
  wp_enqueue_script( 'scripts',
    get_theme_file_uri( get_asset_file( 'front-end.js' ) ),
    [],
    filemtime( get_theme_file_path( get_asset_file( 'front-end.js' ) ) ),
    true
  );

  // Required comment-reply script
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
  }

  wp_localize_script( 'scripts', 'minimalistmadness_screenReaderText', array(
    'expand'   => esc_html__( 'Open child menu', 'minimalistmadness' ),
    'collapse' => esc_html__( 'Close child menu', 'minimalistmadness' ),
  ) );

  wp_localize_script( 'scripts', 'heatmapdata', heatmap_data() );
  wp_localize_script( 'scripts', 'paged_query', paged_query_for_swup() );

  wp_localize_script( 'scripts', 'minimalistmadness_screenReaderText', [
    'expand'          => get_default_localization( 'Open child menu' ),
    'collapse'        => get_default_localization( 'Close child menu' ),
    'expand_for'      => get_default_localization( 'Open child menu for' ),
    'collapse_for'    => get_default_localization( 'Close child menu for' ),
    'expand_toggle'   => get_default_localization( 'Open main menu' ),
    'collapse_toggle' => get_default_localization( 'Close main menu' ),
    'external_link'   => get_default_localization( 'External site:' ),
    'target_blank'    => get_default_localization( 'opens in a new window' ),
  ] );

  // Add domains/hosts to disable external link indicators
  wp_localize_script( 'scripts', 'minimalistmadness_externalLinkDomains', [
      'localhost:3000',
      'rollemaa.test',
      'rollemaa.fi',
      'www.rollemaa.fi',
      'rollemaa.org',
      'www.rollemaa.org',
  ] );

  wp_localize_script( 'scripts', 'air', array(
    'nonce'           => wp_create_nonce( 'wp_rest' ),
    'posts_per_page'  => 6,
    'baseurl'         => get_rest_url(),
  ) );

  wp_localize_script( 'scripts', 'dmrp', array(
    'id'              => get_the_id(),
    'nonce'           => wp_create_nonce( 'dmrp' . get_the_id() ),
    'ajax_url'        => admin_url( 'admin-ajax.php' ),
    'cookie_timeout'  => apply_filters( 'dmrp_cookie_timeout', 3600000 ),
  ) );

  // Remove dude-most-read-posts script (included in scripts.js for optimization)
  wp_dequeue_script( 'dmrp' );

}

/**
 * Returns the built asset filename and path depending on
 * current environment.
 *
 * @param string $filename File name with the extension
 * @return string file and path of the asset file
 */
function get_asset_file( $filename ) {

  $env = 'development' === wp_get_environment_type() && ! isset( $_GET['load_production_builds'] ) ? 'dev' : 'prod'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

  $filetype = pathinfo( $filename )['extension'];

  return "${filetype}/${env}/${filename}";
} // end get_asset_file

