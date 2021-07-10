<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-27 18:11:58
 * @package minimalistmadness
 */

namespace Air_Light;

get_header(); ?>

<div class="content-area">
	<main role="main" id="main" class="site-main">
    <div class="container">

      <?php if ( have_posts() ) : ?>

        <header class="entry-header">
          <h1 class="entry-title" id="content">
            <?php printf( esc_html__( 'Search Results for: %s', 'minimalistmadness' ), '<span>' . get_search_query() . '</span>' ); ?>
          </h1>
        </header><!-- .entry-header -->

        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'template-parts/content', 'search' ); ?>

        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

        <?php else : ?>

          <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

      </div><!-- .container -->
    </main><!-- #main -->
  </div><!-- #primary -->

  <?php get_footer();
