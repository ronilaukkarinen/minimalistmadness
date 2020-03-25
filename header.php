<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 18:14:32
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
</head>

<body <?php body_class( 'no-js' ); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site">

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

        <nav id="swup" class="site-head-left" role="navigation" data-swup="0">
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
          <div class="social-links">
            <a href="https://www.facebook.com/ghost" title="Facebook" target="_blank" rel="noopener">Facebook</a>
            <a href="https://twitter.com/tryghost" title="Twitter" target="_blank" rel="noopener">Twitter</a>
            <a href="https://feedly.com/i/subscription/feed/https://london.ghost.io/rss/" title="RSS" target="_blank" rel="noopener">RSS</a>
          </div>
        </div>
      </div>
    </header>

    <div class="site-content">
