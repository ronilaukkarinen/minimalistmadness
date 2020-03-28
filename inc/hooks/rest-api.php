<?php
/**
 * Rest API hooks.
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-28 13:37:02
 */

/**
  * Vue times
*/
register_rest_field( array( 'post' ), 'time_custom', array(
  'get_callback'    => 'air_get_custom_time_for_rest_api',
  'schema'          => null,
) );

function air_get_custom_time_for_rest_api( $object ) {
  $post_id = $object['id'];

  $post_time = '<time datetime="' . get_the_time( 'c' ) . '">' . get_the_time( 'j.' ) . ' ' . get_the_time( 'F' ) . 'ta ' . get_the_time( 'Y' ) . '</time>';

  return $post_time;
}

/**
  * Vue reading times
*/
register_rest_field( array( 'post' ), 'reading_time_custom', array(
  'get_callback'    => 'air_get_custom_reading_time_for_rest_api',
  'schema'          => null,
) );

function air_get_custom_reading_time_for_rest_api( $object ) {
  $post_id = $object['id'];

    // Reading time
    $post = get_post( $object['id'] );
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

  return $estimated_time;
}

/**
  * Vue bg image
*/
register_rest_field( array( 'post' ), 'featured_image_custom', array(
  'get_callback'    => 'air_get_featured_image_custom_for_rest_api',
  'schema'          => null,
) );

function air_get_featured_image_custom_for_rest_api( $object ) {
  $post_id = $object['id'];

  // Random image
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
    $random_image = '';

    foreach ( $query as $attachment ) {
      $random_image = wp_get_attachment_url( $attachment->ID );
    }
  }

  if ( has_post_thumbnail( $post_id ) ) {
    $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
  } else {
    $featured_image_url = $random_image;
  }

  return $featured_image_url;
}
