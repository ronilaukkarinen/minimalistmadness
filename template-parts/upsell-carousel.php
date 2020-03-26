<?php
/**
 * Selected posts.
 *
 * @package minimalistmadness
 */

namespace Air_Light;

// Fields
$selected_posts = get_field( 'selected_posts', 'option' );
?>

<?php if ( $selected_posts ) : ?>

  <div class="block block-latest block-selected">

    <header class="block-header block-header-smaller block-header-cols">
      <div class="block-header-col-content">
        <h2 class="block-title"><span><?php _e( 'Valitsemiani juttuja juuri sinulle', 'minimalistmadness' ); ?></span></h2>
      </div>
    </header>

    <div class="content">

      <?php
      foreach ( $selected_posts as $selected_post ) :

          $post = get_post( $selected_post->ID );
          $words = str_word_count( strip_tags( $selected_post->post_content ) );
          $minutes = floor( $words / 120 );
          $seconds = floor( $words % 120 / ( 120 / 60 ) );

          if ( 1 <= $minutes ) :
            if ( 1 === $minutes ) :
              $estimated_time = $minutes . ' min';
            else :
              $estimated_time = $minutes . ' min';
            endif;
          else :
            $estimated_time = 'Alle 1 min';
          endif;

          $minimalistmadness_estimated_reading_time_selected = '<span class="time-to-read">' . $estimated_time . ' lukukokemus</span>';

        // Featured image.
        $featured_image = '';
        if ( has_post_thumbnail( $selected_post->ID ) ) :
          $featured_image = esc_url( wp_get_attachment_url( get_post_thumbnail_id( $selected_post->ID ) ) );
        else :
          $featured_image = esc_url( get_template_directory_uri() . '/images/default.jpg' );
        endif;
        ?>

        <div class="entry">
          <div class="entry-featured-image" style="background-image:url('<?php if ( has_post_thumbnail() ) : echo wp_get_attachment_image_src( get_post_thumbnail_id( $selected_post->ID ), 'large' )[0]; else : echo minimalistmadness_get_random_image_url(); endif; ?>');"><a href="<?php echo get_the_permalink(); ?>" class="absolute-link"><span class="screen-reader-text"><?php _e( 'Linkki artikkeliin', 'minimalistmadness' ); ?> "<?php echo get_the_title( $selected_post->ID ); ?>"</span></a></div>

          <div class="entry-details">
            <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title( $selected_post->ID ); ?></a></h3>
            <?php if ( has_excerpt( $selected_post->ID ) ) : ?>
              <p><?php echo get_the_excerpt( $selected_post->ID ); ?></p>
              <?php else : ?>
                <p>
                  <?php
                  $sentence = preg_match( '/^([^.!?]*[\.!?]+){0,2}/', strip_tags( get_post_field('post_content', $selected_post->ID ) ), $summary );
                  echo strip_shortcodes( $summary[0] );
                  ?>
                </p>
              <?php endif; ?>

              <div class="entry-details-footer">
                <p><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time> <span class="dot-divider"></span> <?php echo $minimalistmadness_estimated_reading_time_selected; ?></p>
              </div><!-- .entry-footer -->

            </div><!-- .entry-details -->
          </div><!-- .entry -->

          <?php
        endforeach;
        ?>

      </div>
    </div>

<?php endif; ?>
