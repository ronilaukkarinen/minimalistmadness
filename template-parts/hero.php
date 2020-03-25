<?php
/**
 * Hero
 *
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-28 15:38:00
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 18:47:13
 * @package minimalistmadness
 */

namespace Air_Light;
?>

<section class="block block-hero">
  <div class="container">
    <h1>Hei, olen Rolle ja tämä on blogini. Rollemaa sisältää yhteensä <?php echo esc_attr( wp_count_posts()->publish ); ?> kirjoitusta, jotka pitävät sisällään <?php echo post_word_count_by_author(); ?> sanaa.</h1>
  </div>
</section>
