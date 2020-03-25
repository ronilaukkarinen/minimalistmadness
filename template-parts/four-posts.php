<?php
/**
 * Four posts.
 *
 * @package khonsu
 */

namespace Air_Light;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => 4,
  'no_found_rows' => true,
  'post_status' => 'publish',
);

$loop = new \WP_Query( $args );
if ( $loop->have_posts() ) : ?>

<section class="block block-four-posts">

  <div class="container">

    <div class="post-feed">
      <?php while ( $loop->have_posts() ) :
        $loop->the_post();

        $duotones = array(
          'duotone-1',
          'duotone-2',
          'duotone-3',
          'duotone-4',
          // 'duotone-5',
          'duotone-6',
          // 'duotone-7',
          'duotone-8',
          // 'duotone-9',
          'duotone-10',
          // 'duotone-11',
          'duotone-12',
          'duotone-13',
          'duotone-14',
          'duotone-15',
        );
        $key = array_rand($duotones);
        ?>

      <article class="entry post-card post">
        <div class="post-card-content">
          <a href="<?php echo get_the_permalink(); ?>" class="global-link"><span class="screen-reader-text"><?php echo get_the_title(); ?></span></a>

          <h2 class="post-card-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

          <div class="post-card-image <?php echo $duotones[$key]; ?>"><div class="img" style="background-image: url('<?php if ( has_post_thumbnail() ) : echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0]; else : echo khonsu_get_random_image_url(); endif; ?>')"><p class="post-card-details"><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time><br /><?php echo khonsu_estimated_reading_time(); ?></p></div></div>
        </div>
      </article>

    <?php endwhile; ?>
    </div>

  </div>

</section>
<?php endif;
wp_reset_postdata();
