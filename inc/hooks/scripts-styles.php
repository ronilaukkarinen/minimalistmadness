<?php
/**
 * Enqueue and localize theme scripts and styles
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-04-09 11:27:26
 */

namespace Air_Light;

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

