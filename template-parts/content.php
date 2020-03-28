<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimalistmadness
 */

namespace Air_Light;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="content">
    <div class="entry-stack">

      <div class="entry-stack-header">
        <p><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time> <span class="dot-divider"></span> <?php echo khonsu_estimated_reading_time(); ?></p>
      </div><!-- .entry-footer -->

      <div class="entry-stack-details">
        <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>
        <?php if ( has_excerpt() ) : ?>
          <p><?php echo get_the_excerpt(); ?></p>
        <?php else : ?>
          <p>
            <?php
            $sentence = preg_match( '/^([^.!?]*[\.!?]+){0,2}/', strip_tags( get_the_content() ), $summary );
            echo strip_shortcodes( $summary[0] );
            ?>
          </p>
        <?php endif; ?>

        <div class="entry-stack-details-read-more">

          <?php if ( 0 === get_comments_number() || empty( get_comments_number() ) ) : ?>
            <p><?php _e( 'Teksti jatkuu vielä.', 'minimalistmadness' ); ?> <a href="<?php the_permalink(); ?>"><?php _e( 'Lue loppuun.', 'minimalistmadness' ); ?></a></p>
          <?php else :

          $args_comments = array(
            'number' => '1',
            'post_id' => $post->ID,
          );

          $comments = get_comments( $args_comments );

          foreach ( $comments as $comment ) : ?>

          <?php if ( ! empty( $comment->comment_author_email ) ) : ?>
            <div class="mini-avatar"><?php echo( get_avatar( $comment->comment_author_email, 42 ) ); ?></div>

            <p><?php echo $comment->comment_author; ?> <?php _e( 'kommentoi viimeksi ', 'minimalistmadness' ); echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' sitten'; if ( get_comments_number() > 1 ) : ?> <?php echo get_comments_number() - 1; _e( ' muun lisäksi', 'minimalistmadness' ); endif; ?>. <a href="<?php the_permalink(); ?>"><?php _e( 'Katso mistä puhutaan.', 'minimalistmadness' ); ?></a></p>

          <?php else : ?>

            <p><?php _e( 'Tekstiä on linkitetty, mutta ei vielä kommentoitu.', 'minimalistmadness' ); ?> <a href="<?php the_permalink(); ?>"><?php _e( 'Lue loppuun.', 'minimalistmadness' ); ?></a></p>

          <?php endif; ?>

        <?php endforeach;
        ?>
      <?php endif; ?>
    </div>

  </div><!-- .entry-stack -->
</div><!-- .entry -->
</div><!-- .content -->

</article><!-- #post-## -->
