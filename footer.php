<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 18:34:34
 * @package minimalistmadness
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

namespace Air_Light;

?>

	</div><!-- #content -->

	<footer role="contentinfo" id="colophon" class="site-footer">



    <a href="#page" class="js-trigger top" data-mt-duration="300"><span class="screen-reader-text"><?php echo esc_html_e( 'Back to top', 'minimalistmadness' ); ?></span><?php include get_theme_file_path( '/svg/chevron-up.svg' ); ?></a>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<div id="swup">
</div>

<script data-swup-ignore-script>
  jQuery(document).ready(function () {
      // Mobile Menu Trigger
      jQuery('.nav-burger').click(function () {
          jQuery('body').toggleClass('site-head-open');
      });
  });

  // Initiate Swup transitions
  var swup = new Swup({
      plugins: [new SwupHeadPlugin(), new SwupScriptsPlugin()],
  });
</script>

</body>
</html>
