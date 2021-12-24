<?php
/**
 * Gather all bits and pieces together.
 * If you end up having multiple post types, taxonomies,
 * hooks and functions - please split those to their
 * own files under /inc and just require here.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-04-21 09:21:04
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * The current version of the theme.
 */
define( 'AIR_LIGHT_VERSION', '5.0.7' );

/**
 * Theme settings
 */

$theme_settings = [
  /**
   * Image and content sizes
   */
  'image_sizes' => [
    'small'  => 300,
    'medium' => 700,
    'large'  => 1200,
  ],
  'content_width' => 800,

  /**
   * Logo and featured image
   */
  'default_featured_image' => get_theme_file_uri( 'images/default.jpg' ),

  'logo' => '/svg/logo.svg',

  /**
   * Theme textdomain
   */
  'textdomain' => 'minimalistmadness',

  /**
   * Menu locations
   */
  'menu_locations' => [
    'primary' => __( 'Primary Menu', 'minimalistmadness' ),
  ],

  /**
   * Taxonomies
   *
   * See the instructions:
   * https://github.com/digitoimistodude/minimalistmadness#custom-taxonomies
   */
  'taxonomies' => [
    /**
    'your-taxonomy' => [
      'name'       => 'Your_Taxonomy',
      'post_types' => [ 'post', 'page' ],
    ],
    */
    ],

  /**
   * Post types
   *
   * See the instructions:
   * https://github.com/digitoimistodude/minimalistmadness#custom-post-types
   */
  // TODO Instructions how to add post types

  'post_types' => [
    'diary' => 'Diary',
  ],

  /**
   * Gutenberg -related settings
   */
    // Register custom ACF Blocks
    'acf_blocks' => [
       // Add SVG file to: svg/block-icons/hero-image.svg
       'name'  => 'frappe-graph',
       'title' => 'Statsit graafissa',
       'post_types' => [
         'page',
         'post',
         'diary',
       ],
    ],

    // Custom ACF block default settings
    'acf_block_defaults' => [
      'category'          => 'air-light',
      'mode'              => 'auto',
      'align'             => 'full',
      'post_types'        => [
        'page',
      ],
      'supports'          => [
        'align' => false,
      ],
      'render_callback'   => __NAMESPACE__ . '\render_acf_block',
    ],

  // If you want to use classic editor somewhere, define it here
  'use_classic_editor' => [],

  // Don't restrict blocks
  'allowed_blocks' => 'all',

  // Module caching
  'enable_module_caching' => false,

  // Add your own settings and use them wherever you need, for example THEME_SETTINGS['my_custom_setting']
  'my_custom_setting' => true,
];

$theme_settings = apply_filters( 'air_helper_theme_settings', $theme_settings );

define( 'THEME_SETTINGS', $theme_settings );

/**
 * Required files
 */
require get_theme_file_path( '/inc/hooks.php' );
require get_theme_file_path( '/inc/post-types/ads.php' );
require get_theme_file_path( '/inc/includes.php' );
require get_theme_file_path( '/inc/template-tags.php' );

// Run theme setup
add_action( 'init', __NAMESPACE__ . '\theme_setup' );
add_action( 'after_setup_theme', __NAMESPACE__ . '\build_theme_support' );
