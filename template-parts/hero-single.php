<?php
/**
 * Template part for displaying the article hheader for single post.
 *
 * @package minimalistmadness
 */

namespace Air_Light;

?>

<header class="hero-single" itemscope itemtype="http://schema.org/WPHeader" style="background-image:url('<?php if ( has_post_thumbnail() ) : echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ); else : echo khonsu_get_random_image_url(); endif; ?>');"><div class="shade"></div>

  <div class="site-branding screen-reader-text">
    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?></a></p>
  </div><!-- .site-branding -->

  <div class="article-title-area transition-fade">
    <h1 itemprop="headline"><?php echo get_the_title(); ?></h1>
    <p itemprop="about" class="article-description"><?php _e( 'Kirjoittanut', 'newera' ); ?> <span rel="author"><?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('last_name'); ?></span> <time datetime="<?php the_time('c'); ?>"><?php the_time('l') ?>na, <?php the_time('j.') ?> <?php the_time('F') ?>ta <?php the_time('Y') ?></time>. <?php _e( 'Liittyy aiheisiin', 'newera' ); ?> <?php the_tags('',', ','.'); ?></p>
  </div>

<aside class="scroll-indicator">
  <a class="animated-mouse" href="#article-text-content" title="<?php echo esc_html_e( 'Hyppää sisältöön', 'khonsu' ); ?>">
    <div class="animated-mouse-pointer"><p class="screen-reader-text"><?php echo esc_html_e( 'Hyppää sisältöön klikkaamalla tästä tai rullaa alaspäin', 'khonsu' ); ?></p></div>
  </a>
  <a class="swiping-hand" href="#article-text-content" title="<?php echo esc_html_e( 'Hyppää sisältöön', 'khonsu' ); ?>">
    <div class="hand-icon"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/swipe.svg' ) ) ); ?><p class="screen-reader-text"><?php echo esc_html_e( 'Hyppää sisältöön pyyhkimällä näyttöä sormella ylöspäin tai klikkaamalla tästä', 'khonsu' ); ?></p></div>
  </a>
</aside>

</header>

<div class="nav-article-wrapper">
  <div class="container container-nav-article">
    <nav id="nav" class="nav-article">

      <?php wp_nav_menu( array(
        'theme_location'    => 'primary',
        'container'         => false,
        'depth'             => 4,
        'menu_class'        => 'menu-items',
        'menu_id'           => 'menu',
        'echo'              => true,
        'fallback_cb'       => 'wp_page_menu',
        'items_wrap'        => '<ul class="%2$s" id="%1$s">%3$s</ul>',
        'walker'            => new Nav_Walker(),
        ) ); ?>

    </nav><!-- #site-navigation -->
  </div>
</div>
