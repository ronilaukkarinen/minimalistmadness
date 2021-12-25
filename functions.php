<?php
/**
 * Gather all bits and pieces together.
 * If you end up having multiple post types, taxonomies,
 * hooks and functions - please split those to their
 * own files under /inc and just require here.
 *
 * @Date: 2019-10-15 12:30:02
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2021-05-20 18:19:49
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * The current version of the theme.
 */
define( 'AIR_LIGHT_VERSION', '5.0.7' );

// We need to have some defaults as comments or empties so let's allow this:
// phpcs:disable Squiz.Commenting.InlineComment.SpacingBefore, WordPress.Arrays.ArrayDeclarationSpacing.SpaceInEmptyArray

/**
 * Theme settings
 */
add_action( 'after_setup_theme', function() {
  $theme_settings = [
    /**
     * Theme textdomain
     */
    'textdomain' => 'minimalistmadness',

    /**
     * Image and content sizes
     */
    'image_sizes' => [
      'small'   => 300,
      'medium'  => 700,
      'large'   => 1200,
    ],
    'content_width' => 800,

    /**
     * Logo and featured image
     */
    'default_featured_image'  => null,
    'logo'                    => '/svg/logo.svg',

    /**
     * Custom setting group post ids when using Air Helper's custom setting
     * feature and settings CPT. On multilingual sites using Polylang,
     * translations are handled automatically.
     */
    'custom_settings_post_ids' => [
      // 'setting-group' => 0,
    ],

    'social_media_accounts'  => [
      // 'twitter' => [
      //   'title' => 'Twitter',
      //   'url'   => 'https://twitter.com/digitoimistodude',
      // ],
    ],

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
     * https://github.com/digitoimistodude/air-light#custom-taxonomies
     */
    'taxonomies' => [
      // 'example' => [
      //    'name' => 'Example',
      //    'post_types' => [ 'diary' ],
      // ],
    ],

    /**
     * Post types
     *
     * See the instructions:
     * https://github.com/digitoimistodude/air-light#custom-post-types
     */
    'post_types' => [
      'diary' => 'Diary',
    ],

    /**
     * Gutenberg -related settings
     */
    // Register custom ACF Blocks
    'acf_blocks' => [
      [
        // Add SVG file to: svg/block-icons/hero-image.svg
        'name'  => 'would-be-nice',
        'title' => 'Aamu: Olisi kiva, jos tänään...',
        'post_types' => [
          'diary',
        ],
      ],
    ],

    // Custom ACF block default settings
    'acf_block_defaults' => [
      'category'          => 'minimalistmadness',
      'mode'              => 'auto',
      'align'             => 'full',
      'post_types'        => [
        // 'page',
      ],
      'supports'          => [
        'align' => false,
      ],
      'render_callback'   => __NAMESPACE__ . '\render_acf_block',
    ],

    // Restrict to only selected blocks
    // Set the value to 'all' to allow all blocks everywhere
   'allowed_blocks' => [
      'default' => [
        'all',
      ],
      'page' => [
        'all',
      ],
      'post' => [
        'all',
      ],
      'diary' => [
        'all',
      ],
    ],

    // If you want to use classic editor somewhere, define it here
    'use_classic_editor' => [],

    // Add your own settings and use them wherever you need, for example THEME_SETTINGS['my_custom_setting']
    'my_custom_setting' => true,
  ];

  $theme_settings = apply_filters( 'minimalistmadness_theme_settings', $theme_settings );

  define( 'THEME_SETTINGS', $theme_settings );
} ); // end action after_setup_theme

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
