<?php
/**
 * Gutenberg related settings
 *
 * @Author: Niku Hietanen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-29 17:17:10
 *
 * @package minimalistmadness
 */

namespace Air_Light;

/**
 * Restrict blocks to only allowed blocks in the settings
 */
function allowed_block_types( $allowed_blocks, $post ) {
  if ( 'all' === THEME_SETTINGS['allowed_blocks'] ) {
    return $allowed_blocks;
  }

  // Add the default allowed blocks
  $allowed_blocks = THEME_SETTINGS['allowed_blocks']['default'];

  // If there is post type specific blocks, add them to the allowed blocks list
  if ( null !== THEME_SETTINGS['allowed_blocks'][ get_post_type( $post->post_type ) ] ) {
    $allowed_blocks = array_merge( $allowed_blocks, THEME_SETTINGS['allowed_blocks'][ get_post_type( $post->post_type ) ] );
  }

  return $allowed_blocks;
}

/**
 * Check whether to use classic or block editor for a certain post type as defined in the settings
 */
function use_block_editor_for_post_type( $use_block_editor, $post_type ) {
  if ( in_array( $post_type, THEME_SETTINGS['use_classic_editor'], true ) ) {
    return false;
  }
  return true;
}

/**
 * Enable Gutenberg extra features.
 */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );

/**
 * Custom shortcodes
 */
function thumbs_up() {
  return file_get_contents( esc_url( get_theme_file_path( '/svg/thumbs-up.svg' ) ) );
}
add_shortcode( 'thumbs_up', 'thumbs_up' );

function thumbs_down() {
  return file_get_contents( esc_url( get_theme_file_path( '/svg/thumbs-down.svg' ) ) );
}
add_shortcode( 'thumbs_down', 'thumbs_down' );

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
        'width' => '500px',
        'height' => '580px',
        'theme' => 'black',
      ), $atts
    )
  );
  return '<iframe src="https://embed.spotify.com/?uri=' . $src . '" width="500" height="580" style="width:' . $width . 'px;height:' . $height . ';" frameborder="0" allowtransparency="true"></iframe>';
}
add_shortcode( 'spotify-play', 'spotifyplay_func' );

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
