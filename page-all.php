<?php
/**
 * Kaikki artikkelit.
 *
 * Template Name: Kaikki kirjoitukset
 *
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

namespace Air_Light;

the_post();

get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <section class="block block-page block-archive-all">
    <div class="container container-article" id="swup">
      <div class="transition-fade">

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="post-head inverted archive-all">
          <h2><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path fill="currentColor" d="M11 2.206l-6.235 7.528-.765-.645 7.521-9 7.479 9-.764.646-6.236-7.53v21.884h-1v-21.883z"/></svg>Kaikki Rollemaan <?php echo esc_attr( wp_count_posts()->publish ); ?> kirjoitusta</h2>
        </header>

        <div class="posts-feed-all">
          <ul class="post-feed-simplified">
          <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'cache_results' => true,
            'no_found_rows' => true,
            'post_status' => 'publish',
          );

          $query = new \WP_Query( $args );
          while ( $query->have_posts() ) :
            $query->the_post();
            ?>

            <li>
              <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="global-link"><span class="screen-reader-text"><?php echo esc_attr( get_the_title() ); ?></span></a>
              <p class="post-card-details"><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time></p>
              <h3 class="post-card-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h3>
            </li>

          <?php endwhile; ?>
          </ul>
        </div>

        <?php if ( get_edit_post_link() ) : ?>
          <footer class="entry-footer">
            <?php edit_post_link(
              sprintf(
                /* translators: %s: Name of current post. Only visible to screen readers */
                wp_kses(
                  __( 'Muokkaa <span class="screen-reader-text">%s</span>', 'minimalistmadness' ),
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

      </div>
      </article><!-- #post-## -->
    </div><!-- .container -->
    </section>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
