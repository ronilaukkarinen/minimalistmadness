<?php
/**
 * Gutenberg related settings
 *
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-07-04 19:21:04
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * Enable Gutenberg extra features.
 */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );

/**
 * Custom WP-Admin CSS
 */
// add_action( 'admin_head', __NAMESPACE__ . '\brand_custom_css_js' );

// function brand_custom_css_js() {
//   echo '<style>
//     .acf-relationship .list {
//       height: 500px !important;
//       overflow: scroll !important;
//     }
//     </style>';

//     $screen = get_current_screen();
//     if ( 'post' == $screen->base ) {
//       $post_id = get_the_ID();

//       if ( has_post_thumbnail( $post_id ) ) {
//         echo '<script>const featuredimageUrl = \'' . esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) ) . '\';
//         jQuery( window ).on( \'load\', function() {
//           jQuery(\'.editor-post-title\').css(\'background-image\', \'url(\' + featuredimageUrl + \')\');
//         });
//         </script>';
//       } else {
//         echo '<script>const featuredimageUrl = null</script>';
//       }
//     }
//   }

/**
 * Register Gutenberg blocks
 */
function brand_register_block_editor_assets() {
  $dependencies = array(
    'wp-blocks',    // Provides useful functions and components for extending the editor
    'wp-i18n',      // Provides localization functions
    'wp-element',   // Provides React.Component
    'wp-components', // Provides many prebuilt components and controls
  );

  // wp_register_script( 'brand-block-editor', get_theme_file_uri( 'js/src/block.js', __FILE__ ), $dependencies, null );
  // wp_register_style( 'brand-block-editor', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null );
}
add_action( 'admin_init',  __NAMESPACE__ . '\brand_register_block_editor_assets' );

// Front end side:
// function brand_register_block_assets() {
//   if ( is_admin() ) {
//     wp_register_script( 'brand-block', get_theme_file_uri( 'js/src/block.js', __FILE__ ), array( 'jquery' ), null, null, null, true );
//     wp_register_style( 'brand-block', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null );
//   }
// }
// add_action( 'init',  __NAMESPACE__ . '\brand_register_block_assets' );

register_block_type( 'brand-plugin-namespace/brand-block', array(
  'editor_script' => 'brand-block-editor',
  'editor_style'  => 'brand-block-editor',
  'script'        => 'brand-block',
  'style'         => 'brand-block',
));

// Only allow certain blocks
// @link https://rudrastyh.com/gutenberg/remove-default-blocks.html
add_filter( 'allowed_block_types',  __NAMESPACE__ . '\brand_allowed_block_types' );

function brand_allowed_block_types( $allowed_blocks ) {

  return array(
    'core/image',
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/heading',
    'core/gallery',
    'core/list',
    'core/pullquote',
    'core/quote',
    'core/file',
    'core/video',
    'core/html',
    'core/spacer',
    'core/table',
    'core/separator',

    // All blocks:
    //
    // core/paragraph
    // core/image
    // core/heading
    // (Deprecated) core/subhead — Subheading
    // core/gallery
    // core/list
    // core/quote
    // core/audio
    // core/cover (previously core/cover-image)
    // core/file
    // core/video
    // core/table
    // core/verse
    // core/code
    // core/freeform — Classic
    // core/html — Custom HTML
    // core/preformatted
    // core/pullquote
    // core/button
    // core/text-columns — Columns
    // core/media-text — Media and Text
    // core/more
    // core/nextpage — Page break
    // core/separator
    // core/spacer
    // core/shortcode
    // core/archives
    // core/categories
    // core/latest-comments
    // core/latest-posts
    // core/calendar
    // core/rss
    // core/search
    // core/tag-cloud
    // core/embed
    // core-embed/twitter
    // core-embed/youtube
    // core-embed/facebook
    // core-embed/instagram
    // core-embed/wordpress
    // core-embed/soundcloud
    // core-embed/spotify
    // core-embed/flickr
    // core-embed/vimeo
    // core-embed/animoto
    // core-embed/cloudup
    // core-embed/collegehumor
    // core-embed/dailymotion
    // core-embed/funnyordie
    // core-embed/hulu
    // core-embed/imgur
    // core-embed/issuu
    // core-embed/kickstarter
    // core-embed/meetup-com
    // core-embed/mixcloud
    // core-embed/photobucket
    // core-embed/polldaddy
    // core-embed/reddit
    // core-embed/reverbnation
    // core-embed/screencast
    // core-embed/scribd
    // core-embed/slideshare
    // core-embed/smugmug
    // core-embed/speaker
    // core-embed/ted
    // core-embed/tumblr
    // core-embed/videopress
    // core-embed/wordpress-tv
  );

}

/**
 * Custom shortcodes
 */
function thumbs_up() {
  return file_get_contents( esc_url( get_theme_file_path( '/svg/thumbs-up.svg' ) ) );
}
add_shortcode( 'thumbs_up',  __NAMESPACE__ . '\thumbs_up' );

function thumbs_down() {
  return file_get_contents( esc_url( get_theme_file_path( '/svg/thumbs-down.svg' ) ) );
}
add_shortcode( 'thumbs_down',  __NAMESPACE__ . '\thumbs_down' );

/**
 * Add shortcodes from New Era theme (legacy)
 *
 * Needed to get old articles to work properly.
 *
 * @package newera
 * @param Atts    $atts Attributes.
 * @param Content $content $atts Content.
 */
function youtube_audio_func( $atts, $content = null ) {
  return '<iframe width="640" height="35" src="//www.youtube.com/embed/' . $content . '?modestbranding=1&fs=0&iv_load_policy=3&rel=0&showinfo=0&theme=light&color=white&autohide=0&disablekb=1" frameborder="0" allowfullscreen></iframe>';
}

add_shortcode( 'youtube_audio', __NAMESPACE__ . '\youtube_audio_func' );

function youtube_video_func( $atts, $content = null ) {
  return '<div class="wp-block-embed__wrapper"><figure class="wp-block-embed is-type-video is-provider-youtube"><iframe class="youtube-video" width="500" height="281"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen src="https://www.youtube.com/embed/' . $content . '?vq=hd720&modestbranding=1&iv_load_policy=3&rel=0&showinfo=0&theme=light&color=white&cc_load_policy=1" frameborder="0"></iframe></div></figure>';
}

add_shortcode( 'youtube_video', __NAMESPACE__ . '\youtube_video_func' );

function facebook_embed_func( $atts ) {
  extract(
    shortcode_atts(
      array(
        'href' => '',
      ), $atts
    )
  );
  return '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&appId=250821831708650&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-post" data-href="' . $href . '" data-width="640"></div>
';
}

add_shortcode( 'facebook_embedded_post', __NAMESPACE__ . '\facebook_embed_func' );

function spotifyplay_func( $atts ) {
  extract(
    shortcode_atts(
      array(
        'src' => '',
        'width' => '100%',
        'height' => '580px',
        'theme' => 'black',
      ), $atts
    )
  );
  return '<iframe src="https://embed.spotify.com/?uri=' . $src . '" width="100%" height="580" style="width: 100% !important;height:' . $height . ';" frameborder="0" allowtransparency="true"></iframe>';
}
add_shortcode( 'spotify-play', __NAMESPACE__ . '\spotifyplay_func' );

/**
 * Wrap every image in post with a div
 *
 * @param Content $content Defines the content.
 * @link http://wordpress.stackexchange.com/questions/36000/wrap-all-post-images-inside-a-div-element
 */
function wrapimageswithdiv( $content ) {

  // A regular expression of what to look for.
  $pattern = '/(<img .*?class="(.*?photoblog.*?)"([^>]*)>)/i';
  // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
  $replacement = '<div class="entry-photo">$1</div>';

  // Run preg_replace() on the $content
  $content = preg_replace( $pattern, $replacement, $content );

  // Return the processed content
  return $content;
}
add_filter( 'the_content', __NAMESPACE__ . '\wrapimageswithdiv' );

/**
 * Restrict blocks to only allowed blocks in the settings
 */
function allowed_block_types( $allowed_blocks, $post ) {
  if ( ! isset( THEME_SETTINGS['allowed_blocks'] ) || 'all' === THEME_SETTINGS['allowed_blocks'] ) {
    return $allowed_blocks;
  }

  // Add the default allowed blocks
  $allowed_blocks = isset( THEME_SETTINGS['allowed_blocks']['default'] ) ? THEME_SETTINGS['allowed_blocks']['default'] : [];

  // If there is post type specific blocks, add them to the allowed blocks list
  if ( isset( THEME_SETTINGS['allowed_blocks'][ $post->post_type ] ) ) {
    $allowed_blocks = array_merge( $allowed_blocks, THEME_SETTINGS['allowed_blocks'][ $post->post_type ] );
  }

  // Add custom blocks
  if ( isset( THEME_SETTINGS['acf_blocks'] ) ) {
    foreach ( THEME_SETTINGS['acf_blocks'] as $custom_block ) {
      $allowed_blocks[] = 'acf/' . $custom_block['name'];
    }
  }

  return $allowed_blocks;
} // end allowed_block_types

/**
 * Check whether to use classic or block editor for a certain post type as defined in the settings
 */
function use_block_editor_for_post_type( $use_block_editor, $post_type ) {
  if ( in_array( $post_type, THEME_SETTINGS['use_classic_editor'], true ) ) {
    return false;
  }

  return true;
} // end use_block_editor_for_post_type

/**
 * Enqueue block editor JavaScript and CSS
 */
function register_block_editor_assets() {

  // Dependencies
  $dependencies = [
    'wp-blocks',    // Provides useful functions and components for extending the editor
    'wp-i18n',      // Provides localization functions
    'wp-element',   // Provides React.Component
    'wp-components', // Provides many prebuilt components and controls
  ];

  // Enqueue the bundled block JS file
  wp_enqueue_script(
    'block-editor-js',
    get_theme_file_uri( get_asset_file( 'gutenberg-editor.js' ) ),
    $dependencies,
    filemtime( get_theme_file_path( get_asset_file( 'gutenberg-editor.js' ) ) ),
    'all'
  );

  // Enqueue optional editor only styles
  wp_enqueue_style(
    'block-editor-styles',
    get_theme_file_uri( get_asset_file( 'gutenberg-editor-styles.css' ) ),
    [],
    filemtime( get_theme_file_path( get_asset_file( 'gutenberg-editor-styles.css' ) ) ),
    'all',
    true
  );
} // end register_block_editor_assets

// Remove Gutenberg inline "Normalization styles" like .editor-styles-wrapper h1
// color: inherit;
// @source https://github.com/WordPress/gutenberg/issues/18595#issuecomment-599588153
function remove_gutenberg_inline_styles( $editor_settings, $post ) {
  unset( $editor_settings['styles'][0] );
  return $editor_settings;
} // end remove_gutenberg_inline_styles

/**
 * Make sure Gutenberg wp-admin editor styles are loaded
 */
function setup_editor_styles() {
  // Add support for editor styles.
  add_theme_support( 'editor-styles' );

  // Enqueue editor styles.
  add_editor_style( get_theme_file_uri( get_asset_file( 'gutenberg-editor-styles.css' ) ) );
}

/**
 * Block editor title input styles for post types that don't show
 * post title in templates
 */
function block_editor_title_input_styles() {
  $post_types = [
    'page',
    'settings',
  ];

  if ( ! in_array( get_post_type(), $post_types, true ) ) {
    return;
  }
  $styles = '
  /* Remove gap between post title wrapper and first block */
  .edit-post-visual-editor__post-title-wrapper + .is-root-container > .wp-block:first-child {
    margin-top: 0;
  }
  /* Remove white border from top */
  .interface-interface-skeleton__header {
    border-bottom: 0;
  }
  .block-editor .editor-styles-wrapper {
    padding-top: 0;
  }
  .block-editor .editor-styles-wrapper .edit-post-visual-editor__post-title-wrapper {
    background-color: #23282e;
    border-bottom: 1px solid #23282e;
    position: relative;
    z-index: 3;
    color: #fff;
  }
  .block-editor .editor-styles-wrapper .edit-post-visual-editor__post-title-wrapper .components-visually-hidden::after {
    /* content: "(näkyy mm. valikossa, selainikkunan nimessä ja murupolussa)"; */
    content: "(is shown for example in navigation, browser window name and in breadcrumbs)";
    color: rgba(255, 255, 255, .5);
    display: inline;
    margin-left: 5px;
  }
  .block-editor .editor-styles-wrapper .editor-post-title {
    padding: 4rem 2rem;
    margin: 0 auto;
  }
  .block-editor .editor-styles-wrapper .editor-post-title .components-visually-hidden {
    border: initial;
    clip: initial;
    -webkit-clip-path: initial;
    clip-path: initial;
    color: rgba(255, 255, 255, .5);
    font-size: var(--font-size-15);
    display: block;
    height: initial;
    margin: initial;
    margin-bottom: 1.2rem;
    overflow: initial;
    padding: initial;
    position: initial;
    width: initial;
    word-wrap: initial;
  }
  .block-editor .editor-styles-wrapper .editor-post-title .editor-post-title__input {
    line-height: 1.3;
    background-color: #2e3338;
    border-color: #2e3338;
    color: rgba(255, 255, 255, .5);
    border-radius: 3px;
    border-style: solid;
    border-width: 2px;
    box-sizing: border-box;
    font-family: inherit;
    font-size: var(--font-size-22);
    font-weight: 400;
    line-height: 24px;
    margin-bottom: 0;
    padding: 15px;
    position: relative;
    text-decoration: none;
    transition: all 0.55s;
  }
  .block-editor .editor-styles-wrapper .editor-post-title .editor-post-title__input:focus {
    background-color: #000;
    border-color: #000;
    color: #fff;
  }
  ';
  wp_add_inline_style( 'block-editor-styles',  $styles );
}
