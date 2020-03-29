<?php
/**
 * The template for displaying archive pages
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-29 15:32:59
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

namespace Air_Light;

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main block block-page">

    <div class="container container-archive container-article">
      <div class="article">

      <?php if ( have_posts() ) :
        $count = 0; ?>

        <div class="notification-box">
          <?php if ( is_tag() ) : ?>
            <h3>Arkisto avainsanalle &quot;<?php echo single_tag_title( '', false ); ?>&quot;</h3>

            <p>Avainsanalla &quot;<?php echo single_tag_title( '', false ); ?>&quot; tägättyjä artikkeleja Rollemaassa on tällä hetkellä yhteensä huimat <?php $tag = $wp_query->get_queried_object();
            echo esc_attr( $tag->count ); ?> kpl.</strong></p>
          <?php endif; ?>

          <?php if ( is_category() ) : ?>

            <h3>Kirjoitukset kategoriassa &quot;<?php echo single_cat_title(); ?>&quot;</h3>
            <p>Aihealueeseen &quot;<?php echo single_cat_title(); ?>&quot; liittyvää on kirjoiteltu yhteensä <?php $cat = get_the_category();
            $cat = $cat[0];
            echo esc_attr( $cat->category_count ); ?> kpl.</p>

            <?php elseif ( is_day() ) : ?>

              <?php
              $current_month = get_the_time( 'm' );
              $current_year = get_the_time( 'Y' );
              $current_day = get_the_time( 'j' );
              $countposts = get_posts( 'year=$current_year&monthnum=$current_month&day=$current_day' );
              ?>

              <h3><?php echo esc_attr( ucfirst( get_the_time( 'l' ) ) ); ?>, <?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></h3>
              <p>Kaikki <?php echo esc_attr( ucfirst( get_the_time( 'l' ) ) ); ?>na, <?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?> julkaisemani kirjoitukset näet tällä sivulla. Kirjoituksia kertyi yhteensä <?php echo count( $countposts ); ?>.</p>

              <?php elseif ( is_month() ) : ?>

                <?php
                $current_month = get_the_time( 'm' );
                $current_year = get_the_time( 'Y' );
                $countposts = get_posts( 'year=$current_year&monthnum=$current_month' );
                ?>

                <h3><?php echo esc_attr( ucfirst( get_the_time( 'F' ) ) ); ?>, <?php the_time( 'Y' ); ?></h3>
                <p><?php echo esc_attr( ucfirst( get_the_time( 'F' ) ) ); ?>ssa vuonna <?php the_time( 'Y' ); ?> naputtelin kirjoituksia yhteensä huimat <?php echo count( $countposts ); ?> kpl. Tällä sivulla näet ne kaikki kätevästi listattuna.</p>

                <?php elseif ( is_year() ) : ?>

                  <h3>Anno domini <?php the_time( 'Y' ); ?></h3>
                  <p>Herran vuonna <?php the_time( 'Y' ); ?> kirjoitetut artikkelit.</p>

                  <?php elseif ( is_search() ) : ?>

                    <h1>Hakutulokset</h1>
                    <h3><?php $cat = get_the_category();
                    $cat = $cat[0];
                    echo esc_attr( $cat->category_count ); ?> löytyi!</h3>

                    <?php elseif ( is_author() ) : ?>

                      <h1><?php echo esc_attr( $curauth->nickname ); ?>n kirjoittamat</h1>
                      <h3><?php $cat = get_the_category();
                      $cat = $cat[0];
                      echo esc_attr( $cat->category_count ); ?> kpl</h3>

                    <?php endif; ?>
                  </div><!-- .notification-box -->

                  <?php while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content' );
                  endwhile;

                  khonsu_pagination();

                else :
                  get_template_part( 'template-parts/content', 'none' );
                endif; ?>

              </div>
            </div><!-- .container -->

            </main><!-- #main -->
          </div><!-- #primary -->

          <?php get_footer();
