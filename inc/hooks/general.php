<?php
/**
 * General hooks.
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 18:46:36
 */

namespace Air_Light;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'minimalistmadness' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'minimalistmadness' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
} // end widgets_init

/**
 * Count all words
 *
 * @param author $author Author.
 */
function post_word_count_by_author( $author = false ) {
  global $wpdb;
  $now = gmdate( 'Y-m-d H:i:s', time() );

  if ( $author ) {
    $query = "SELECT post_content FROM $wpdb->posts WHERE post_author = '$author' AND post_status= 'publish' AND post_date < '$now'";
  } else {
    $query = "SELECT post_content FROM $wpdb->posts WHERE post_status = 'publish' AND post_date < '$now'";
  }

  $words = $wpdb->get_results( $query );
  if ( $words ) {
    foreach ( $words as $word ) {
      $post = strip_tags( $word->post_content );
      $post = explode( ' ', $post );
      $count = count( $post );
      $totalcount = $count + $oldcount;
      $oldcount = $totalcount;
    }
  } else {
    $totalcount = 0;
  }

  return number_format( $totalcount );
}
