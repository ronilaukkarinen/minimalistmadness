<?php
/**
 * Image native lazyload.
 *
 * @Author:		Elias Kautto
 * @Date:   		2022-01-28 12:33:30
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2022-11-22 11:25:47
 *
 * @package air-helper
 */

/**
 * Echo image in lazyloading tag for native-lazyload.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  string  $args['fallback'] Url for fallback image. Defaults to theme settings default featured image.
 * @param  array   $args['sizes']    Custom sizes for lazyloading. Optional.
 * @param  string  $args['class']    Class name to give for img tag. Optional.
 * @since  2.3.1
 */
if ( ! function_exists( 'native_lazyload_tag' ) ) {
  function native_lazyload_tag( $image_id = 0, $args = [] ) {
    echo get_native_lazyload_tag( $image_id, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  } // end native_lazyload_tag
} // end if

/**
 * Get image lazyloading tag for native-lazyload.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  string  $args['fallback'] Url for fallback image. Defaults to theme settings default featured image.
 * @param  array   $args['sizes']    Custom sizes for lazyloading. Optional.
 * @param  string  $args['class']    Class name to give for img tag. Optional.
 * @return string            String containing lazyloading tag.
 * @since  2.3.1
 */
if ( ! function_exists( 'get_native_lazyload_tag' ) ) {
  function get_native_lazyload_tag( $image_id = 0, $args = [] ) {
    $args = wp_parse_args( $args, [
      'fallback' => false,
      'sizes' => [],
      'class' => null,
    ] );

  // Get image
    $image_urls = air_helper_get_image_lazyload_sizes( $image_id, $args['sizes'] );

    // Check if we have image
    if ( ! $image_urls || ! is_array( $image_urls ) ) {
      return get_native_lazyload_tag_fallback( $args );
    }

    // Possibility to add optional styles for the image
    $styles = '';
    $styles_array = apply_filters( 'air_helper_lazyload_tag_styles', [], $image_id );
    $styles_array = apply_filters( 'air_helper_native_lazyload_tag_styles', $styles_array, $image_id );
    foreach ( $styles_array as $key => $value ) {
      $styles .= ' ' . $key . ': ' . $value . ';';
    }

    // Get alt
    $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

    // Get the img tag
    ob_start(); ?>
    <img loading="lazy"
      alt="<?php echo esc_attr( $alt ); ?>"
      src="<?php echo esc_url( $image_urls['big'] ); ?>"
      <?php if ( ! empty( $styles ) ) : ?>
        style="<?php echo esc_attr( $styles ); ?>"
      <?php endif; ?>
      <?php if ( ! empty( $args['class'] ) ) : ?>
        class="<?php echo esc_attr( $args['class'] ); ?>"
      <?php endif; ?>
    />
    <?php

    return ob_get_clean();
  } // end get_native_lazyload_tag
} // end if

/**
 * Fallback for lazyload tag.
 *
 * @param string $args['fallback'] Url for fallback image. Defaults to theme settings default featured image.
 * @param  string  $args['class']    Class name to give for img tag. Optional.
 * @return string            String containing lazyloading tag.
 * @since 2.4.0
 */
if ( ! function_exists( 'get_native_lazyload_tag_fallback' ) ) {
  function get_native_lazyload_tag_fallback( $args ) {
    // Default to theme default featured image if no fallback specified
    if ( empty( $args['fallback'] ) ) {
      if ( apply_filters( 'air_helper_image_lazyload_fallback_from_theme_settings', true ) && defined( 'THEME_SETTINGS' ) ) {
        $args['fallback'] = THEME_SETTINGS['default_featured_image'];
      }
    }

    // No fallback, bail
    if ( empty( $args['fallback'] ) ) {
      return;
    }

    // Get the img tag
    ob_start(); ?>
    <img loading="lazy"
      alt=""
      src="<?php echo esc_url( $args['fallback'] ); ?>"
      <?php if ( ! empty( $args['class'] ) ) : ?>
        class="<?php echo esc_attr( $args['class'] ); ?>"
      <?php endif; ?>
    />
    <?php

    return ob_get_clean();
  } // end get_native_lazyload_tag_fallback
} // end if

/**
 * Get image urls for each size needed on lazyloading.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @return mixed             Boolean false if image or sizes do not exist, otherwise array size=>image url
 * @since  1.11.0
 */
function air_helper_get_image_lazyload_sizes( $image_id = 0, $sizes = [] ) {
  $image_id = intval( $image_id );

  if ( ! $image_id ) {
    return false;
  }

  // Bail if ID is not attachment
  if ( 'attachment' !== get_post_type( $image_id ) && apply_filters( 'air_helper_lazyload_do_post_type_check', true ) ) {
    return false;
  }

  // Default image sizes for use cases
  $default_sizes = [
    'tiny'    => 'tiny-lazyload-thumbnail',
    'mobile'  => 'large',
    'big'     => 'full',
  ];

  $sizes = wp_parse_args( $sizes, $default_sizes );
  $intermediate_sizes = get_intermediate_image_sizes();

  // Loop sizes to get corresponding image url
  foreach ( $sizes as $size_for => $size ) {
    // Check that asked image size exists and fallback to full size
    if ( ! in_array( $size, $intermediate_sizes ) ) {
      $size = 'full';
    }

    // Get image url
    $url = wp_get_attachment_image_url( $image_id, $size );

    // Thumbnail fallback
    if ( ! $url && 'tiny-lazyload-thumbnail' === $size ) {
      $url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
    }

    // For some reason, we don't have image so unset the size
    if ( ! $url ) {
      unset( $sizes[ $size_for ] );
    }

    // Replace the image size name with url to image
    $sizes[ $size_for ] = esc_url( $url );
  }

  // Check that all required default images exists
  if ( ! array_key_exists( 'tiny', $sizes ) ) {
    return false;
  }

  if ( ! array_key_exists( 'mobile', $sizes ) ) {
    return false;
  }

  if ( ! array_key_exists( 'big', $sizes ) ) {
    return false;
  }

  // Fallback to thumbnail if tiny is same as big
  if ( $sizes['tiny'] === $sizes['big'] ) {
    $url = wp_get_attachment_image_url( $image_id, 'thumbnail' );

    if ( $url ) {
      $sizes['tiny'] = esc_url( $url );
    }
  }

  return $sizes;
} // end function air_helper_get_image_lazyload_sizes

/**
 * Get dimensions of attachment image.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @return mixed             Boolean false if image do not exist, otherwise array with width and height.
 * @since  1.11.0
 */
function air_helper_get_image_lazyload_dimensions( $image_id = 0, $sizes = [] ) {
  $image_id = intval( $image_id );

  if ( ! $image_id ) {
    return false;
  }

  // Bail if ID is not attachment
  if ( 'attachment' !== get_post_type( $image_id ) && apply_filters( 'air_helper_lazyload_do_post_type_check', true ) ) {
    return false;
  }

  // Default image sizes for use cases
  $default_sizes = [
    'tiny'    => 'tiny-lazyload-thumbnail',
    'mobile'  => 'large',
    'big'     => 'full',
  ];

  $sizes = wp_parse_args( $sizes, $default_sizes );

  // Get image data
  $dimensions = wp_get_attachment_image_src( $image_id, $sizes['big'] );

  if ( ! $dimensions ) {
    return false;
  }

  return [
    'width'   => $dimensions[1],
    'height'  => $dimensions[2],
  ];
} // end air_helper_get_image_lazyload_dimensions
