<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimalistmadness
 */

/**
 *  Custom comments function.
 */
function khonsu_comments( $comment, $args, $depth ) {
    // $GLOBALS['comment'] = $comment; ?>

    <li id="li-comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
      <div id="comment-<?php comment_ID(); ?>">
        <h4 class="comment-author"><?php echo get_comment_author_link() ?></h4>

        <?php if ( 0 === $comment->comment_approved ) : ?>
          <p><em>Kommenttisi odottaa ylläpidon moderointia.</em></p>
        <?php endif; ?>

        <p class="comment-time">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); // WPCS: XSS OK. ?>">
            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1520 1216q0-40-28-68l-208-208q-28-28-68-28-42 0-72 32 3 3 19 18.5t21.5 21.5 15 19 13 25.5 3.5 27.5q0 40-28 68t-68 28q-15 0-27.5-3.5t-25.5-13-19-15-21.5-21.5-18.5-19q-33 31-33 73 0 40 28 68l206 207q27 27 68 27 40 0 68-26l147-146q28-28 28-67zm-703-705q0-40-28-68l-206-207q-28-28-68-28-39 0-68 27l-147 146q-28 28-28 67 0 40 28 68l208 208q27 27 68 27 42 0 72-31-3-3-19-18.5t-21.5-21.5-15-19-13-25.5-3.5-27.5q0-40 28-68t68-28q15 0 27.5 3.5t25.5 13 19 15 21.5 21.5 18.5 19q33-31 33-73zm895 705q0 120-85 203l-147 146q-83 83-203 83-121 0-204-85l-206-207q-83-83-83-203 0-123 88-209l-88-88q-86 88-208 88-120 0-204-84l-208-208q-84-84-84-204t85-203l147-146q83-83 203-83 121 0 204 85l206 207q83 83 83 203 0 123-88 209l88 88q86-88 208-88 120 0 204 84l208 208q84 84 84 204z"/></svg>
            <time><?php echo esc_attr( get_comment_date( 'j.', $comment_ID ) ); ?> <?php echo esc_attr( get_comment_date( 'F', $comment_ID ) ); ?>ta, <?php echo esc_attr( get_comment_date( 'Y', $comment_ID ) ); ?></time> <?php edit_comment_link( __( '&mdash; Muokkaa' ), ' ', '' ); ?>
          </a>
        </p>

        <?php
          comment_text();
          comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
        ?>

        <?php if ( '0' === $comment->comment_approved ) : ?>
          <p class="comments-no-comments-text">Kiitos kommentoinnista, arvostan! Kommenttisi on moderointijonossa, eikä vielä näy julkisesti. Pidätän oikeuden julkaista kommentin blogissani.</p>
        <?php endif; ?>

      </div>
    </li>
  <?php }

 /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
 if ( post_password_required() ) {
  return;
} ?>

<div class="comments-wrap">
  <div id="comments" class="comments-area">

  <?php

  // Custom comment form
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $args = array(
      'title_reply'          => '<a name="kommentoi" id="kommentoi"></a><span class="responses">' . __( 'Reaktiot', 'minimalistmadness' ) . '</span>',
      'label_submit'         => __( 'Lähetä kommentti', 'minimalistmadness' ),
      'comment_notes_before' => '' . __( '', 'minimalistmadness' ) . '',
      'comment_field'        => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . _x( 'Kommentti', 'noun' ) . '</label><textarea id="comment" placeholder="' . __( 'Kirjoita kommenttisi tähän.', 'minimalistmadness' ) . '" name="comment" cols="45" rows="3" aria-required="true"></textarea></p><div class="hidden-by-default">',
      'fields'               => apply_filters( 'comment_form_default_fields', array(
        'author'  => '<p class="comment-form-author">' . '<label class="screen-reader-text" for="author">' . __( 'Nimesi', 'minimalistmadness' ) . '</label> ' . ( $req ? '<span class="required screen-reader-text">Vaadittu kenttä</span>' : '' ) . '<input id="author" name="author" placeholder="' . __( 'Nimesi', 'minimalistmadness' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
        'email'   => '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . __( 'Sähköpostiosoite (vaaditaan, mutta ei julkaista)', 'minimalistmadness' ) . '</label> ' . ( $req ? '<span class="required screen-reader-text">Vaadittu kenttä</span>' : '' ) . '<input id="email" name="email" placeholder="' . __( 'Sähköpostiosoite (vaaditaan, mutta ei julkaista)', 'minimalistmadness' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
        'url'     => '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . __( 'Verkkosivusi (jos haluat)', 'minimalistmadness' ) . '</label>' . '<input id="url" name="url" placeholder="' . __( 'http://', 'minimalistmadness' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
      ) ),
    );

    comment_form( $args ); ?>

    <?php if ( have_comments() ) : ?>
      <h2 class="comments-title screen-reader-text">
        <?php
        printf( // phpcs:ignore
          esc_html( _nx( '%1$s kommentti', '%1$s kommenttia', get_comments_number(), 'comments title', 'minimalistmadness' ) ),
          number_format_i18n( get_comments_number() ), // phpcs:ignore
          '<span class="screen-reader-text">on article "' . get_the_title() . '"</span>' // phpcs:ignore
        );
        ?>
      </h2>

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
      <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'minimalistmadness' ); ?></h2>
        <div class="nav-links">

          <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'minimalistmadness' ) ); ?></div>
          <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'minimalistmadness' ) ); ?></div>

        </div><!-- .nav-links -->
      </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>

    <ol class="comment-list">
      <?php
      wp_list_comments( array(
        'style'      => 'ol',
        'short_ping' => true,
        'callback'   => 'khonsu_comments',
      ) );
      ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'minimalistmadness' ); ?></h2>
      <div class="nav-links">

        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'minimalistmadness' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'minimalistmadness' ) ); ?></div>

      </div><!-- .nav-links -->
    </nav><!-- #comment-nav-below -->
    <?php
    endif; // Check for comment navigation.

  endif; // Check for have_comments().
  ?>

  <?php
  // If comments are closed and there are comments, let's leave a little note, shall we?
  if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p class="comments-no-comments-text">Kommentointi on suljettu.</p>
  <?php
endif;
?>

</div><!-- #comments -->
</div>
