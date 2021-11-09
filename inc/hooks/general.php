<?php
/**
 * General hooks.
 *
 * @package minimalistmadness
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-11-09 08:11:47
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
 */
function get_word_count_from_posts() {

	$count = 0;
	$posts = get_posts( array(
			'numberposts' => -1,
			'post_type' => 'any',
	));

	foreach ( $posts as $post ) {
		$count += str_word_count( strip_tags( get_post_field( 'post_content', $post->ID ) ) ); // phpcs:ignore
	}

	$num = number_format_i18n( $count );

	return $num;
}

/**
 * Count the number of words in post content
 * @param string $content The post content
 * @return integer $count Number of words in the content
 */
function post_word_count( $content ) {
  $decode_content = html_entity_decode( $content );
  $filter_shortcode = do_shortcode( $decode_content );
  $strip_tags = wp_strip_all_tags( $filter_shortcode, true );
  $count = str_word_count( $strip_tags );
  return $count;
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

function khonsu_get_random_image_id() {
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
      $return = $attachment->ID;
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
  $words = str_word_count( strip_tags( $post->post_content ) ); // phpcs:ignore
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

/**
 * Image lazyload helpers.
 *
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-08-07 14:38:34
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-05-12 16:17:30
 *
 * @package air-helper
 */

/**
 * Echo image in lazyloading divs.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @since  1.11.0
 */
if ( ! function_exists( 'image_lazyload_div' ) ) {
  function image_lazyload_div( $image_id = 0, $sizes = [], $fallback = false ) {
    echo get_image_lazyload_div( $image_id, $sizes, $fallback ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  } // end image_lazyload_div
} // end if

/**
 * Get image lazyloading divs.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @return string            String containing lazyloading divs.
 * @since  1.11.0
 */
if ( ! function_exists( 'get_image_lazyload_div' ) ) {
  function get_image_lazyload_div( $image_id = 0, $sizes = [], $fallback = false ) {
    // Get image
    $image_urls = air_helper_get_image_lazyload_sizes( $image_id, $sizes );

    // Check if we have image
    if ( ! $image_urls || ! is_array( $image_urls ) ) {
      if ( $fallback ) {
        return get_image_lazyload_div_fallback( $fallback );
      }

      return;
    }

    // Do preg match and check if we need to do browser hack
    $browser_hack = false;
    if ( ! empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
      if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) ) ) {
        $browser_hack = true;
      }
    }

    ob_start();

// Div for preview image and data for js to use ?>
<div aria-hidden="true" class="background-image preview lazyload" style="background-image: url('<?php echo esc_url( $image_urls['tiny'] ); ?>');" data-src="<?php echo esc_url( $image_urls['big'] ); ?>" data-src-mobile="<?php echo esc_url( $image_urls['mobile'] ); ?>"></div>

<?php // Div for full image, hack for browsers that don't support our js well ?>
<div aria-hidden="true" class="background-image full-image" <?php if ( $browser_hack ) : ?> style="background-image: url('<?php echo esc_url( $image_urls['big'] ); ?>');" <?php endif; ?>></div>

<?php // Div with full image for browsers without js ?>
<noscript>
  <div aria-hidden="true" class="background-image full-image" style="background-image: url('<?php echo esc_url( $image_urls['big'] ); ?>');"></div>
</noscript>

<?php

    return ob_get_clean();
  } // end get_image_lazyload_div
} // end if

if ( ! function_exists( 'get_image_lazyload_div_fallback' ) ) {
  function get_image_lazyload_div_fallback( $fallback = false ) {
    if ( empty( $fallback ) ) {
      return;
    }

    // Do preg match and check if we need to do browser hack
    $browser_hack = false;
    if ( ! empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
      if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) ) ) {
        $browser_hack = true;
      }
    }

    ob_start();

// Div for preview image and data for js to use ?>
<div aria-hidden="true" class="background-image preview lazyload" style="background-image: url('<?php echo esc_url( $fallback ); ?>');" data-src="<?php echo esc_url( $fallback ); ?>" data-src-mobile="<?php echo esc_url( $fallback ); ?>"></div>

<?php // Div for full image, hack for browsers that don't support our js well ?>
<div aria-hidden="true" class="background-image full-image" <?php if ( $browser_hack ) : ?> style="background-image: url('<?php echo esc_url( $fallback ); ?>');" <?php endif; ?>></div>

<?php // Div with full image for browsers without js ?>
<noscript>
  <div aria-hidden="true" class="background-image full-image" style="background-image: url('<?php echo esc_url( $fallback ); ?>');"></div>
</noscript>

<?php

    return ob_get_clean();
  } // end get_image_lazyload_div_fallback
} // end if



/**
 * Echo image in lazyloading tag.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @since  1.11.0
 */
if ( ! function_exists( 'image_lazyload_tag' ) ) {
  function image_lazyload_tag( $image_id = 0, $sizes = [], $fallback = false ) {
    echo get_image_lazyload_tag( $image_id, $sizes, $fallback ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  } // end image_lazyload_tag
} // end if

/**
 * Get image lazyloading tag.
 *
 * @param  integer $image_id Image attachment id to lazyload.
 * @param  array   $sizes    Custom sizes for lazyloading. Optional.
 * @return string            String containing lazyloading divs.
 * @since  1.11.0
 */
if ( ! function_exists( 'get_image_lazyload_tag' ) ) {
  function get_image_lazyload_tag( $image_id = 0, $sizes = [], $fallback = false ) {
    // Get image
    $image_urls = air_helper_get_image_lazyload_sizes( $image_id, $sizes );

    // Check if we have image
    if ( ! $image_urls || ! is_array( $image_urls ) ) {
      if ( $fallback ) {
        return get_image_lazyload_tag_fallback( $fallback );
      }

      return;
    }

    // Get dimensions
    $dimensions = air_helper_get_image_lazyload_dimensions( $image_id, $sizes );

    if ( ! $dimensions ) {
      return;
    }

    // Get the img tag
    ob_start(); ?>
<img aria-hidden="true" class="lazyload" src="<?php echo esc_url( $image_urls['tiny'] ); ?>" data-src="<?php echo esc_url( $image_urls['big'] ); ?>" data-src-mobile="<?php echo esc_url( $image_urls['mobile'] ); ?>" width="<?php echo esc_attr( $dimensions['width'] ); ?>" height="<?php echo esc_attr( $dimensions['height'] ); ?>" alt="" />
<?php

    return ob_get_clean();
  } // end get_image_lazyload_tag
} // end if

if ( ! function_exists( 'get_image_lazyload_tag_fallback' ) ) {
  function get_image_lazyload_tag_fallback( $fallback = false ) {
    if ( empty( $fallback ) ) {
      return;
    }

    // Get the img tag
    ob_start(); ?>
<img aria-hidden="true" class="lazyload" src="<?php echo esc_url( $fallback ); ?>" data-src="<?php echo esc_url( $fallback ); ?>" data-src-mobile="<?php echo esc_url( $fallback ); ?>" alt="" />
<?php

    return ob_get_clean();
  } // end get_image_lazyload_tag_fallback
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
  if ( 'attachment' !== get_post_type( $image_id ) ) {
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
    if ( ! in_array( $size, $intermediate_sizes ) ) { // phpcs:ignore
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
  if ( 'attachment' !== get_post_type( $image_id ) ) {
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
} // end air_helper_get_image_lazyload_dimension

/**
 * Custom pagination
 */
function khonsu_pagination() {
  global $wp_query;

  $big = 999999999; // Need an unlikely integer

  $paginate_links = paginate_links(
    array(
      'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'      => '?paged=%#%',
      'current'     => max( 1, get_query_var( 'paged' ) ),
      'total'       => $wp_query->max_num_pages,
      'prev_text'   => __( '&larr; uudempia' ),
      'next_text'   => __( 'vanhempia &rarr;' ),
    )
  );

  echo '<p class="custom-pagination">' . $paginate_links . '</p>'; // phpcs:ignore
}

/**
 * Enable theme support for essential features.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
  acf_add_options_page(
    array(
      'page_title'  => 'Nostot',
      'menu_title'  => 'Nostot',
      'menu_slug'   => 'khonsu-settings',
      'capability'  => 'edit_posts',
      'redirect'    => false,
      'icon_url'    => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 24 24" fill="#9ea4aa"><path d="M12.89,3L14.85,3.4L11.11,21L9.15,20.6L12.89,3M19.59,12L16,8.41V5.58L22.42,12L16,18.41V15.58L19.59,12M1.58,12L8,5.58V8.41L4.41,12L8,15.58V18.41L1.58,12Z"/></svg>' ), // phpcs:ignore
      'position' => 5,
    )
  );
}

/**
 * Calculate age function
 *
 * @param birthdate $birthdate Birthdate.
 */
function khonsu_calculate_age( $birthdate ) {
  list( $year, $month, $day ) = explode( '/', $birthdate );
  $yeardiff = date( 'Y' ) - $year;

  if ( date( 'm' ) < $month || ( date( 'm' ) === $month && date( 'd' ) < $day ) ) {
    $yeardiff--;
  }

  return $yeardiff;
}
