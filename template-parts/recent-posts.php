<?php
/**
 * Recent posts.
 *
 * @package khonsu
 */

namespace Air_Light;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => 10,
  'no_found_rows' => true,
  'post_status' => 'publish',
);

$loop = new \WP_Query( $args );
if ( $loop->have_posts() ) : ?>

<section class="block block-recent-posts">

  <div class="container">

    <header class="post-head">
      <h2><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path fill="currentColor" d="M11 2.206l-6.235 7.528-.765-.645 7.521-9 7.479 9-.764.646-6.236-7.53v21.884h-1v-21.883z"/></svg>Uusimmat kymmenen kirjoitusta</h2>
    </header>

    <ul class="post-feed-simplified">
      <?php while ( $loop->have_posts() ) :
        $loop->the_post();
        ?>

        <li>
          <a href="<?php echo get_the_permalink(); ?>" class="global-link"><span class="screen-reader-text"><?php echo get_the_title(); ?></span></a>
          <p class="post-card-details"><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time></p>
          <h3 class="post-card-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
        </li>

      <?php endwhile; ?>
    </ul>

  </div>

</section>
<?php endif;
wp_reset_postdata();
