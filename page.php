<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 21:54:28
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

namespace Air_Light;

the_post();

get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">
    <div id="swup" class="transition-fade">
      <div class="container">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">

            <?php the_content(); ?>

            <?php wp_link_pages( [
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimalistmadness' ),
              'after'  => '</div>',
            ] ); ?>

          </div><!-- .entry-content -->

          <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">
              <?php edit_post_link(
                sprintf(
                  /* translators: %s: Name of current post. Only visible to screen readers */
                  wp_kses(
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'minimalistmadness' ),
                    [
                      'span' => [
                        'class' => [],
                      ],
                    ]
                  ),
                  get_the_title()
                ),
                '<p class="edit-link">',
                '</p>'
              ); ?>
            </footer><!-- .entry-footer -->
          <?php endif; ?>

        </article><!-- #post-## -->

      <?php // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      } ?>

    </div><!-- .container -->
  </div>
</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
