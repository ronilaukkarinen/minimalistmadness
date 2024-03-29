<?php
/**
 * Rest API hooks.
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-05-22 11:32:10
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
  * Vue excerpt
*/
register_rest_field( array( 'post' ), 'excerpt', array(
  'get_callback'    => 'air_get_excerpt_for_rest_api',
  'schema'          => null,
) );

function air_get_excerpt_for_rest_api( $object ) {
  $post_id = $object['id'];

    if ( has_excerpt( $post_id ) ) :
      $excerpt = get_the_excerpt( $post_id ); // phpcs:ignore
    else :
      $sentence = preg_match( '/^([^.!?]*[\.!?]+){0,2}/', strip_tags( get_the_content( $post_id ) ), $summary );
      $excerpt = strip_shortcodes( $summary[0] ); // phpcs:ignore
    endif;

  return $excerpt;
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

// Search
function rollemaa_rest_api_init() {
  register_rest_route( 'rollemaa/v1', '/search', array(
    'methods'   => 'GET',
    'callback'  => 'rollemaa_rest_api_search',
  ) );
}
add_action( 'rest_api_init', 'rollemaa_rest_api_init' );

function rollemaa_rest_api_search( $request ) {
  $data = array();

  if ( ! isset( $_GET['s'] ) ) {
    return $data;
  }

  $rest_controller = new WP_REST_Post_Types_Controller();

  $args = array(
    's'                       => $_GET['s'],
    'no_found_rows'           => true,
    'cache_results'           => true,
    'update_post_term_cache'  => false,
    'posts_per_page'          => 15,
    'relevanssi'              => true,
  );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      $item = $rest_controller->prepare_response_for_collection( $query->post );

      // Add custom "link" endpoint for permalink
      $item->link = get_the_permalink( $item->ID );

      // Create post type name label
      if ( 'post' === get_post_type( $item->ID ) ) {
        $post_type_name = 'Artikkeli';
      } elseif ( 'diary' === get_post_type( $item->ID ) ) {
        $post_type_name = 'Lokikirja';
      }

      // Add custom "post_type_name" endpoint for readable post type names
      if ( ! empty( $post_type_name ) ) $item->post_type_name = $post_type_name;

      // Create readable date
      $post_date_readable = 'Kirjoitettu ' . get_the_time( 'l', $item->ID ) . 'na, ' . get_the_time( 'j.', $item->ID ) . ' ' . get_the_time( 'F', $item->ID ) . 'ta ' . get_the_time( 'Y', $item->ID );

      // Add "post_date_readable" endpoint
      if ( ! empty( $post_date_readable ) ) $item->post_date_readable = $post_date_readable;

      // Wrap up data array for items
      $data[] = $item;
    }
  }

  return $data;
}
