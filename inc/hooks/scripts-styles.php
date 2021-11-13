<?php
/**
 * Enqueue and localize theme scripts and styles
 *
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-11-13 12:58:19
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * Heatmap stuff
 */
function heatmap_data() {

  global $post;

  $heatmap_args = array(
    'post_type' => 'any',
    'posts_per_page' => 380, // phpcs:ignore
    'no_found_rows' => true,
    'post_status' => 'publish',
  );

  $heatmap_query = get_posts( $heatmap_args );
  $heatmap_array = array();

  foreach ( $heatmap_query as $key => $heatmap_post ) {
    setup_postdata( $heatmap_post );

    // Word count
    $post_id = $heatmap_post->ID;
    $post_object = get_post( $post_id );
    $content = $post_object->post_content;
    $word_count = post_word_count( $content );

    // Unix timestamp
    $timestamp = get_the_time( 'Y-m-d', $post_id );
    $day = get_the_time( 'd', $post_id );
    $unix_timestamp = get_post_timestamp( $heatmap_post );

    // Form an array
    $heatmap_post_array[ $timestamp ] = $word_count;

    // If same day has multiple posts, combine word counts and show total count for one day
    $post_date = strtotime( get_the_time( 'Y-m-d 00:00:00', $post_id ) );
    if ( array_key_exists( $post_date, $heatmap_post_array ) ) {
      $heatmap_post_array[ $post_date ] = $heatmap_post_array[ $post_date ] + $word_count;
    } else {
      $heatmap_post_array[ $post_date ] = $word_count;
    }
  }

  // echo '<pre>';
  // var_dump( $heatmap_post_array );
  // echo '<pre>';

  return $heatmap_post_array;

}
/**
 * Enqueue scripts and styles.
 */
function enqueue_theme_scripts() {
  if ( 'development' === getenv( 'WP_ENV' ) ) {
    $minimalistmadness_template = 'global';
  } else {
    $minimalistmadness_template = 'global.min';
  }

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
    'posts_per_page'  => 2,
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

