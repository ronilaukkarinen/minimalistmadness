<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-05-27 20:02:12
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

?>

	</div><!-- #content -->

	<footer role="contentinfo" id="colophon" class="site-footer">

    <div class="container">
      <div class="footer-space">
        <ul class="social-media">
          <li><a class="no-external-link-indicator" href="https://twitter.com/rolle"><span class="screen-reader-text">Twitter</span><?php include get_theme_file_path( '/svg/twitter.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://github.com/ronilaukkarinen"><span class="screen-reader-text">GitHub</span><?php include get_theme_file_path( '/svg/github.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://www.instagram.com/rolle_"><span class="screen-reader-text">Twitter</span><?php include get_theme_file_path( '/svg/instagram.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://www.last.fm/user/rolle-"><span class="screen-reader-text">Last.fm</span><?php include get_theme_file_path( '/svg/lastfm.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://untappd.com/user/rolle"><span class="screen-reader-text">Untappd</span><?php include get_theme_file_path( '/svg/untappd.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://retroachievements.org/user/rolle"><span class="screen-reader-text">Retro Achievements</span><?php include get_theme_file_path( '/svg/joystick.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://www.overbuff.com/players/pc/Qllervo-2545"><span class="screen-reader-text">Overwatch</span><?php include get_theme_file_path( '/svg/overwatch.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://rawg.io/@rolle"><span class="screen-reader-text">Rawg.io</span><?php include get_theme_file_path( '/svg/rawg.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="http://trakt.tv/users/rolle"><span class="screen-reader-text">Trakt</span><?php include get_theme_file_path( '/svg/trakt.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://keybase.io/ronilaukkarinen"><span class="screen-reader-text">Keybase</span><?php include get_theme_file_path( '/svg/keybase.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://profiles.wordpress.org/rolle"><span class="screen-reader-text">WordPress</span><?php include get_theme_file_path( '/svg/wordpress.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://www.linkedin.com/in/rolaukka/"><span class="screen-reader-text">WordPress</span><?php include get_theme_file_path( '/svg/linkedin.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://www.strava.com/athletes/16582440"><span class="screen-reader-text">Strava</span><?php include get_theme_file_path( '/svg/strava.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" href="https://goodreads.com/rolle"><span class="screen-reader-text">Goodreads</span><?php include get_theme_file_path( '/svg/goodreads.svg' ); ?></a></li>
          <li><a class="no-external-link-indicator" rel="me" href="https://mstdn.social/@rolle"><span class="screen-reader-text">Mastodon</span><?php include get_theme_file_path( '/svg/mastodon.svg' ); ?></a></li>
        </ul>

        <p>Oikeudet omistaa Roni Laukkarinen, 1999-<?php echo esc_attr( date( 'Y' ) ); ?>.</p>
      </div>
    </div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
