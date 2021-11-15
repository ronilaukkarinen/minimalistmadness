<?php
/**
 * The template for displaying archive pages
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-30 08:33:36
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

namespace Air_Light;

get_header(); ?>

<div class="content-area">
	<main role="main" id="main" class="site-main block block-page">

    <header class="log-header">
      <h1>Kapteenin lokikirja</h1>
      <p>Laiva jatkaa kulkuaan Rollemaan elämän vesillä. Kapteenin lokikirja on päivittäinen päiväkirja, jossa painopiste kirjoittamisen säännöllisyydessä ja raportoinnissa, ei niinkään asiapitoisuudessa. <a href="<?php echo esc_url( get_the_permalink( 26429 ) ); ?>">Ensimmäinen sivu</a> avattu 2021/11/08. Alla merkinnät graafissa.</p>
    </header>

    <?php get_template_part( 'template-parts/heatmap' ); ?>

    <?php if ( have_posts() ) :
      $count = 0; ?>

      <?php while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content-diary' );
      endwhile;

      khonsu_pagination();

    else :
      get_template_part( 'template-parts/content', 'none' );
    endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
