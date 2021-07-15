<?php
/**
 * The current version of the theme.
 *
 * @package minimalistmadness
 */

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

add_shortcode( 'youtube_audio', 'youtube_audio_func' );

function youtube_video_func( $atts, $content = null ) {
  return '<iframe class="youtube_video" width="853" height="480" src="https://www.youtube.com/embed/' . $content . '?vq=hd720&modestbranding=1&iv_load_policy=3&rel=0&showinfo=0&theme=light&color=white&cc_load_policy=1" frameborder="0"></iframe>';
}

add_shortcode( 'youtube_video', 'youtube_video_func' );

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

add_shortcode( 'facebook_embedded_post', 'facebook_embed_func' );

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
