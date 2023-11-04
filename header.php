<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-11-01 11:18:20
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
  <script data-swup-ignore-script data-domain="rollemaa.fi" src="https://analytics.dude.fi/js/plausible.js"></script>

  <?php wp_head(); ?>
</head>

<body <?php body_class( 'no-js' ); ?>>
<div class="loading-animation" aria-hidden="true"><div class="ripple" aria-hidden="true"></div></div>

<script data-swup-ignore-script data-swup-reload-script>
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

function themeSetup() {
  if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && localStorage.getItem('theme') !== 'theme-light') {
    setTheme('theme-dark');
  }

  if (localStorage.getItem('theme') === 'theme-dark') {
    setTheme('theme-dark');
    document.getElementById('color-scheme-toggle-dark').checked = true;
    document.getElementById('color-scheme-toggle-light').checked = false;
    document.getElementById('color-scheme-toggle-auto').checked = false;
  } else {
    setTheme('theme-light');
    document.getElementById('color-scheme-toggle-dark').checked = false;
    document.getElementById('color-scheme-toggle-light').checked = true;
    document.getElementById('color-scheme-toggle-auto').checked = false;
  }

  document.querySelectorAll('#dark-mode-footer-toggle input').forEach(function(el) {
    el.addEventListener('change', function() {
      if (this.value === 'light') {
        setTheme('theme-light');
      } else if (this.value === 'dark') {
        setTheme('theme-dark');
      } else {
        localStorage.removeItem('theme');

        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          setTheme('theme-dark');
        } else {
          setTheme('theme-light');
        }
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', function() {
  themeSetup();
});

document.addEventListener('swup:contentReplaced', function() {
  themeSetup();
});
</script>

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
          <button class="search-trigger" type="button"><?php include get_theme_file_path( 'svg/search.svg' ); // phpcs:ignore ?><span>Haku</span></button>
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

        <input id="search-input" aria-label="Hae kirjoituksia" type="search" name="search" class="search search-input" placeholder="Hae kirjoituksia">

        <button class="button button-close"><?php include get_theme_file_path( '/svg/window-close.svg' ); // phpcs:ignore ?> <span>Sulje</span></button>
      </div>

      <ul id="search-results" class="search-results"></ul>
    </div>
  </div>

  <div class="site-content">
