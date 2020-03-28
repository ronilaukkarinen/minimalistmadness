<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package minimalistmadness
 */

namespace Air_Light;

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <?php while ( have_posts() ) :
    the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php get_template_part( 'template-parts/hero-single' ); ?>

      <div class="container container-article" id="article-text-content">
        <div class="entry-content">

          <?php
          $post_year = get_the_time( 'Y' );
          $now_year = date( 'Y' );
          ?>

          <?php if ( $post_year <= $now_year - 2 ) : ?>
            <div class="notification-box old">
              <h3>Arkistomatskua</h3>
              <p>Otathan huomioon, että tämä on yli <b><?php echo esc_attr( $now_year ) - esc_attr( $post_year ); ?> vuotta vanha</b> artikkeli, joten sisältö ei ole välttämättä ihan ajan tasalla. Olin artikkelin kirjoittamishetkellä <?php $post_year = get_the_time( 'Y' ); $age = $post_year - 1988; echo esc_attr( $age ); ?>-vuotias.</p>
            </div>
          <?php endif; ?>

          <?php
          the_content( sprintf(
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'minimalistmadness' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
          ) );

          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimalistmadness' ),
            'after'  => '</div>',
          ) );
          ?>

          <?php if ( get_edit_post_link() ) { ?>
            <footer class="entry-footer">
              <?php edit_post_link(
                sprintf(
                  /* translators: %s: Name of current post. Only visible to screen readers */
                  wp_kses(
                    __( 'Muokkaa <span class="screen-reader-text">%s</span>', 'minimalistmadness' ),
                    array(
                      'span' => array(
                        'class' => array(),
                      ),
                    )
                  ),
                  get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
              ); ?>
            </footer><!-- .entry-footer -->
          <?php } ?>

          <div class="author-info">
            <div class="author-col author-col-avatar">
              <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/author-info.jpg" alt="Kuva Roni Laukkarisesta" />
            </div>

            <div class="author-col author-col-info">
              <h3>Roni Laukkarinen</h3>
              <p class="description">Kirjoittaja on <?php echo esc_attr( khonsu_calculate_age( '1988/11/01' ) ); ?>-vuotias elämäntapanörtti, ammatiltaan yrittäjä ja teknologiajohtaja perustamassaan <a href="https://www.dude.fi">digitoimistossa</a>, verkkosivujen tekijä, koukussa kirjoittamiseen 5-vuotiaasta. Päivät kuluu <a href="https://twitter.com/streetlazer">monipuolisen</a> <a href="https://www.last.fm/user/rolle-">musiikkiharrastuksen</a>, retropelien ja koodaamisen parissa, mutta arkea piristyttää myös vaimo ja kaksi lasta. <a href="http://twitter.com/rolle" target="_blank">Twitter</a>, <a href="http://www.rollemaa.fi/leffat">leffat</a> ja <a href="http://www.huurteinen.fi" target="_blank">erikoisoluet</a> lähellä sydäntä.</p>

              <p class="button-paragraph"><a class="button" href="<?php echo esc_url( get_page_link( 2768 ) ); ?>">Lue Rollesta lisää</a></p>
            </div>
          </div>

        </div><!-- .entry-content -->

      </div><!-- .container-article -->

      <?php if ( function_exists( 'related_entries' ) ) : ?>

      <div class="related">
        <div class="container container-related-posts">

          <header class="block-header block-header-smaller">
            <h2 class="block-title"><span>Lisää aiheeseen liittyvää luettavaa</span></h2>
          </header>

          <?php related_entries( array( 'use_template' => true, 'template_file' => 'yarpp-template-dude.php' ) ); ?>
        </div>
      </div>

      <?php endif;

        // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
        endif; ?>

      </article><!-- #post-## -->

    <?php endwhile; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
