<?php
/**
 * Telegram group
 *
 * Telegram group "notification".
 *
 * @Author: Roni Laukkarinen
 * @Date: 2021-11-25 10:05:52
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-05-28 12:39:53
 *
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

?>

<div class="telegram-group dismissed" id="tg-banner">
  <p>
    <span class="tg">
      <?php include get_theme_file_path( '/svg/icon-telegram.svg' ); ?> Kiinnostaako saada reaaliaikainen ilmoitus uudesta tekstistä? Liity Rollen tekstit Telegram-ryhmään!
    </span>
  </p>

  <div class="buttons">
    <p>
      <a href="https://t.me/rollemaa" class="button-yes no-external-link-indicator">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><path d="M20 6L9 17l-5-5"/></svg>
        Tottakai!
      </a>
    </p>
    <button class="hide-forever-tg hide-forever">
      <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="13" height="13"><path d="M11.559 1.042L1.042 11.912m0-10.87l10.517 10.87" stroke="currentColor" stroke-width="2" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Ei kiinnosta<span class="hide-on-mobile">, piilota pysyvästi</span></button>
  </div>
</div>
