<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-28 19:24:42
 * @package minimalistmadness
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

namespace Air_Light;

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <section class="block block-page">

      <div class="container container-article" id="swup">
        <div class="transition-fade">

          <div class="container container-article">

            <article>
              <h1>Sivua ei löydy</h1>
              <p>Vaikuttaisi siltä, että sivu on siirretty tai poistettu. <a href="<?php echo esc_url( get_home_url() ); ?>">Tästä takaisin etusivulle</a>.</p>
            </article>
          </div>

        </div>
      </div>

   </section><!-- .error-404 -->

 </div><!-- .container -->
</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
