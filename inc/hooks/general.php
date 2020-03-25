<?php
/**
 * General hooks.
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 19:50:56
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

  return str_replace(',', ' ', number_format( $totalcount ) );
}

/**
 * Random image url function
 */
function khonsu_get_random_image_url() {
  $query = get_posts(
    array(
      'post_status'     => 'inherit',
      'post_type'       => 'attachment',
      'post_mime_type'  => 'image/jpeg,image/gif,image/jpg,image/png',
      'posts_per_page'  => 1,
      'category_name'   => 'kuvituskuva',
      'no_found_rows'   => true,
      'orderby'         => 'rand',
    )
  );

  if ( ! empty( $query ) ) {
    $return = '';

    foreach ( $query as $attachment ) {
      $return = wp_get_attachment_url( $attachment->ID );
    }
  }
  return $return;
}

/**
 * Estimate time required to read the article
 *
 * @return string
 */
function khonsu_estimated_reading_time() {

  $post = get_post();
  $words = str_word_count( strip_tags( $post->post_content ) );
  $minutes = floor( $words / 120 );
  $seconds = floor( $words % 120 / ( 120 / 60 ) );

  if ( 1 <= $minutes ) :
    if ( 1 === $minutes ) :
      $estimated_time = $minutes . ' min';
    else :
      $estimated_time = $minutes . ' min';
    endif;
  else :
    $estimated_time = 'Alle 1 min';
  endif;

  return '<span class="time-to-read">' . $estimated_time . ' lukukokemus</span>';
}
