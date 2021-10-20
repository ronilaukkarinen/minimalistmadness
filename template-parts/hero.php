<?php
/**
 * Hero
 *
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-28 15:38:00
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-09-07 13:34:34
 * @package minimalistmadness
 */

namespace Air_Light;

?>

<section class="block block-hero">
  <div class="page-head">
    <h1>Rollemaa on Rollen blogi, joka sisältää <?php echo esc_attr( wp_count_posts()->publish ); ?> kirjoitusta, eli <?php echo esc_html( get_word_count_from_posts() ); ?> sanaa.</h1>
  </div>
</section>
