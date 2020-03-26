<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-26 09:53:25
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">
    <div id="swup" class="transition-fade">

    <?php
      include get_theme_file_path( 'template-parts/hero.php' );
      include get_theme_file_path( 'template-parts/upsell-carousel.php' );
      include get_theme_file_path( 'template-parts/four-posts.php' );
    ?>

    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
