<?php
/**
 * The template for content-diary
 *
 * Description of the file called
 * content-diary.
 *
 * @Author:		Roni Laukkarinen
 * @Date:   		2021-11-11 08:59:06
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-11-11 12:59:35
 *
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

// Fields
$location = get_field( 'location' );
$highlight = get_field( 'highlight' );
$np = get_field( 'np' );
$np_link = get_field( 'np_link' );
$temperature = get_field( 'temperature' );
$weather_text = get_field( 'weather_text' );
$weather_icon = get_field( 'weather_icon' );
$device = get_field( 'device' );
$drink_icon = get_field( 'drink_icon' );
$drink_text = get_field( 'drink_text' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h1 class="prefix"><?php the_title(); ?></h1>
  <p class="diary-title">
    <?php if ( ! is_singular( 'diary' ) ) echo '<a href="' . esc_url( get_the_permalink() ) . '">'; ?>
      <time datetime="<?php the_time( 'c' ); ?>"><?php echo esc_html( ucfirst( get_the_time( 'l' ) ) ); ?>na, <?php the_time( 'j.' ) ?> <?php the_time( 'F' ) ?>ta <?php the_time( 'Y' ) ?><br><span class="time">Kello on <?php the_time( 'H:i' ) ?></span></time>
      <?php if ( ! is_singular( 'diary' ) ) echo '</a>'; ?>
  </p>
  <div class="container container-article">
    <div class="entry-content">
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

      <?php if ( is_singular() ) :
        $post_id = get_the_ID();
        $post_object = get_post( $post_id );
        $content = $post_object->post_content;
        $word_count = post_word_count( $content );
      ?>
        <p class="word-count">Tässä kirjoituksessa on <?php echo esc_html( $word_count ); ?> sanaa.</p>
      <?php endif; ?>

      <?php if ( ! empty( $location ) || ! empty( $highlight ) || ! empty( $temperature ) || ! empty( $weather_text ) || ! empty( $device ) || ! empty( $drink_text ) ) : ?>
        <ul class="metadata">

          <?php if ( ! empty( $device ) ) : ?>
            <li>
              <?php include get_theme_file_path( "/svg/{$device['value']}.svg" ); ?>
              <?php echo esc_html( $device['label'] ); ?>
            </li>
          <?php endif; ?>

          <?php if ( ! empty( $weather_text ) ) : ?>
            <li>
              <?php include get_theme_file_path( "/svg/{$weather_icon}.svg" ); ?>
              <?php echo esc_html( $temperature ); ?> &deg; C, <?php echo esc_html( $weather_text ); ?>
            </li>
          <?php endif; ?>

          <?php if ( ! empty( $location ) ) : ?>
            <li>
              <?php include get_theme_file_path( '/svg/location.svg' ); ?>
              <?php echo esc_html( $location ); ?>
            </li>
          <?php endif; ?>
          <?php if ( ! empty( $highlight ) ) : ?>
            <li>
              <?php include get_theme_file_path( '/svg/highlight.svg' ); ?>
              Päivän kohokohta: <?php echo esc_html( $highlight ); ?>
            </li>
          <?php endif; ?>

          <?php if ( ! empty( $drink_text ) ) : ?>
            <li>
              <?php include get_theme_file_path( "/svg/{$drink_icon}.svg" ); ?>
              <?php echo esc_html( $drink_text ); ?>
            </li>
          <?php endif; ?>

          <?php if ( ! empty( $np ) ) : ?>
            <li>
              <?php include get_theme_file_path( '/svg/np.svg' ); ?>
              <?php if ( ! empty( $np_link ) ) : ?>
                <a href="<?php echo esc_url( $np_link ); ?>">
              <?php endif; ?>
                Nyt soi <?php echo esc_html( $np ); ?>
              <?php if ( ! empty( $np_link ) ) : ?>
                </a>
              <?php endif; ?>
            </li>
          <?php endif; ?>

        </ul>
      <?php endif; ?>

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

      <?php if ( is_singular( 'diary' ) ) : ?>
        <div class="author-info">
          <div class="author-col author-col-avatar">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/author-info.jpg" alt="Kuva Roni Laukkarisesta" />
          </div>

          <div class="author-col author-col-info">
            <h3>Roni Laukkarinen</h3>
            <p class="description">Kirjoittaja on <?php echo esc_attr( khonsu_calculate_age( '1988/11/01' ) ); ?>-vuotias elämäntapanörtti, ammatiltaan yrittäjä ja teknologiajohtaja perustamassaan <a href="https://www.dude.fi" class="author-link no-external-link-indicator">digitoimistossa</a>, verkkosivujen tekijä, koukussa kirjoittamiseen 5-vuotiaasta. Päivät kuluu <a href="https://twitter.com/streetlazer" class="author-link no-external-link-indicator">monipuolisen</a> <a href="https://www.last.fm/user/rolle-" class="author-link no-external-link-indicator">musiikkiharrastuksen</a>, retropelien ja koodaamisen parissa, mutta arkea piristyttää myös vaimo ja kaksi lasta. <a href="http://twitter.com/rolle" target="_blank" class="author-link no-external-link-indicator">Twitter</a> ja <a href="https://www.rollekino.fi" class="author-link no-external-link-indicator">leffat</a> lähellä sydäntä.</p>
            <p class="button-paragraph"><a class="button" href="<?php echo esc_url( get_page_link( 2768 ) ); ?>">Lue Rollesta lisää</a></p>
          </div>
        </div>
      <?php endif; ?>
    </div><!-- .entry-content -->
  </div><!-- .container-article -->

</article><!-- #post-## -->
