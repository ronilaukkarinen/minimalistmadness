<?php
/**
 * @Author: Roni Laukkarinen
 * @Date: 2021-12-27 19:51:07
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-01-03 18:46:38
 *
 * @package minimalistmadness
 */

namespace Air_Light;

// if ( ! empty( $args ) ) {
//  $title        = $args['title'];
//  $content      = $args['content'];
//  $image        = $args['image'];
// } else {
//  $title        = get_field( 'title' );
//  $content      = get_field( 'content' );
//  $image        = get_field( 'image' );
// }

// if ( empty( $title ) ) {
//  maybe_show_error_block( 'Otsikko on pakollinen' );
//  return;
// }
?>

<h2 class="title-with-icon">
  <span class="icon" aria-hidden="true">
    <?php require get_theme_file_path( '/svg/block-icons/on-hold.svg' ); ?>
  </span>

  <span class="sub-title">
    Tekemiset, jotka ovat toistaiseksi vähemmällä huomiolla
  </span>
</h2>
