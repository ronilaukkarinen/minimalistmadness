<?php
/**
 * Most popular posts on current week.
 *
 * @package khonsu
 */

namespace Air_Light;

if ( function_exists( 'get_most_popular_posts' ) ) :
  $query = get_most_popular_posts( 'week', array(
    'posts_per_page' => 4,
  ) );

if ( ! empty( $query ) ) :
  if ( $query->have_posts() ) : ?>

  <section class="block block-four-posts block-most-popular">
    <div class="container">

    <header class="post-head inverted">
      <h2><span><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path fill="currentColor" d="M11 2.206l-6.235 7.528-.765-.645 7.521-9 7.479 9-.764.646-6.236-7.53v21.884h-1v-21.883z"/></svg>Viikon luetuimmat</span></h2>
    </header>

      <div class="post-feed">
        <?php
        while ( $query->have_posts() ) :
          $query->the_post();
          ?>

          <article class="entry post-card post">
            <div class="post-card-content">
              <a data-swup-preload href="<?php echo esc_url( get_the_permalink() ); ?>" class="global-link" aria-hidden="true" tabindex="-1"><span class="screen-reader-text"><?php echo esc_attr( get_the_title() ); ?></span></a>

            <h2 class="post-card-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>
            <div class="post-card-image"><div class="img"><p class="post-card-details"><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time><br /><?php echo khonsu_estimated_reading_time(); // phpcs:ignore ?></p>
            <div class="image image-background image-background-layer"><?php if ( has_post_thumbnail( $post->ID ) ) { ?>

            <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) ); ?>" loading="eager" />

            <?php } else { native_lazyload_tag( khonsu_get_random_image_id() ); } ?></div></div></div>
            </div>
          </article>

        <?php endwhile; ?>
      </div>

    </div>
  </section>
  <?php
endif;
endif;
endif;
wp_reset_postdata();
