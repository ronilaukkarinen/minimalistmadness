<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-04-23 12:14:13
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>

  <?php if ( ! is_user_logged_in() ) : ?>
    <?php if ( is_singular() && ! has_tag( 'raha' ) ) : ?>
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8523880252818258",
        enable_page_level_ads: true
      });
      </script>
    <?php endif; ?>
  <?php endif; ?>
</head>

<body <?php body_class( 'no-js' ); ?>>
<script data-swup-ignore-script>
function setTheme(themeName) {
  localStorage.setItem('theme', themeName);
  document.documentElement.className = themeName;
}

function toggleTheme() {
  if (localStorage.getItem('theme') === 'theme-dark') {
    setTheme('theme-light');
  } else {
    setTheme('theme-dark');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  checkBox = document.getElementById('toggle-dark-mode');

  if (localStorage.getItem('theme') === 'theme-dark') {
    setTheme('theme-dark');
    checkBox.checked = true;
  } else {
    setTheme('theme-light');
    checkBox.checked = false;
  }
});
</script>

  <form class="dark-mode-controls" onclick="toggleTheme()">
    <label>
      <input onclick="toggleTheme()" id="toggle-dark-mode" class="toggle-checkbox" type="checkbox"></input>
      <div class="toggle-slot">
        <div class="sun-icon-wrapper">
          <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </div>

        <div class="toggle-button"></div>
        <div class="moon-icon-wrapper">
          <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </div>
      </div>
    </label>
  </form>

  <a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( get_default_localization( 'Skip to content' ) ); ?></a>
  <?php wp_body_open(); ?>
  <div class="site<?php if ( ! is_singular() || has_tag( 'raha' ) ) : ?> disable-google-ads<?php endif; ?>" id="swup">

    <div class="rain-wrapper">
      <div class="rain front-row"></div>
      <div class="rain back-row"></div>
    </div>

    <header class="site-head">
      <div class="site-head-container">
        <a class="nav-burger" href="#">
          <div class="hamburger hamburger--collapse" aria-label="Menu" role="button" aria-controls="navigation">
            <div class="hamburger-box">
              <div class="hamburger-inner"></div>
            </div>
          </div>
        </a>

        <nav class="site-head-left" role="navigation">
          <?php wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'depth'          => 4,
            'menu_class'     => 'nav menu-items',
            'menu_id'        => 'main-menu',
            'echo'           => true,
            'fallback_cb'    => __NAMESPACE__ . '\Nav_Walker::fallback',
            'items_wrap'     => '<ul class="%2$s" role="menu">%3$s</ul>',
            'walker'         => new Nav_Walker(),
          ) ); ?>
        </nav><!-- #nav -->

        <div class="site-head-center">
          <a class="site-head-logo" href="<?php echo esc_url( get_home_url() ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="umbrella"><rect width="24" height="24" opacity="0"/><path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a1 1 0 0 0 1 1h8v6a3 3 0 0 0 6 0 1 1 0 0 0-2 0 1 1 0 0 1-2 0v-6h8a1 1 0 0 0 1-1A10 10 0 0 0 12 2zm-7.94 9a8 8 0 0 1 15.88 0z"/></g></g></svg>Rollemaa</a>
        </div>
        <div class="site-head-right">
          <button class="search-trigger"><?php include get_theme_file_path( 'svg/search.svg' ); // phpcs:ignore ?><span>Haku</span></button>
        </div>
      </div>
    </header>

  <div class="overlay overlay-search">
    <div class="container">

      <div class="search-form">
        <button type="button" class="search-icon" aria-label="toggle search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="375.045 607.885 30.959 30.33"><path fill="currentColor" d="M405.047 633.805l-7.007-6.542a3.041 3.041 0 0 0-.408-.319 12.236 12.236 0 0 0 2.025-6.753c0-6.796-5.51-12.306-12.307-12.306s-12.306 5.51-12.306 12.306 5.509 12.306 12.306 12.306c2.565 0 4.945-.786 6.916-2.128.122.172.257.337.418.488l7.006 6.542c1.122 1.048 2.783 1.093 3.709.101.928-.993.77-2.647-.352-3.695zm-17.696-4.754a8.86 8.86 0 1 1 0-17.72 8.86 8.86 0 0 1 0 17.72z"></path></svg>
          <span class="tcon-visuallyhidden">Toggle search</span>
        </button>

        <input aria-label="Hae kirjoituksia" type="search" name="search" class="search search-input" placeholder="Hae kirjoituksia">

        <button class="button button-close"><?php include get_theme_file_path( '/svg/window-close.svg' ); // phpcs:ignore ?> <span>Sulje</span></button>
      </div>

      <ul id="search-results" class="search-results"></ul>
    </div>
  </div>

  <div class="site-content">
