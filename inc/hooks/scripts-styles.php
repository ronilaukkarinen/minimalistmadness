<?php
/**
 * Enqueue and localize theme scripts and styles
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 22:00:38
 */

namespace Air_Light;

/**
 * Move jQuery to footer
 */
function move_jquery_into_footer( $wp_scripts ) {
  if ( ! is_admin() ) {
    $wp_scripts->add_data( 'jquery',         'group', 1 );
    $wp_scripts->add_data( 'jquery-core',    'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
  }
} // end minimalistmadness_move_jquery_into_footer

/**
 * Enqueue scripts and styles.
 */
function enqueue_theme_scripts() {
  if ( 'development' === getenv( 'WP_ENV' ) ) {
    $minimalistmadness_template = 'global';
  } else {
    $minimalistmadness_template = 'global.min';
  }

  // Styles.
  wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$minimalistmadness_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$minimalistmadness_template}.css" ) ) );

  // Scripts.
  wp_enqueue_script( 'jquery-core' );
  wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );

  // Required comment-reply script
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_localize_script( 'scripts', 'minimalistmadness_screenReaderText', array(
    'expand'   => esc_html__( 'Open child menu', 'minimalistmadness' ),
    'collapse' => esc_html__( 'Close child menu', 'minimalistmadness' ),
  ) );
} // end minimalistmadness_scripts
