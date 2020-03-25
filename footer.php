<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @Date:   2019-10-15 12:30:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-25 22:07:46
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
      animateHistoryBrowsing: false
    });

  // The page scrolls down too much on click if not for this
  window.onload = function() {
    swup.on('contentReplaced', function() {
     "use strict";var MoveTo=function(){var e={tolerance:0,duration:800,easing:"easeOutQuart",container:window,callback:function(){}};function o(t,n,e,o){return t/=o,-e*(--t*t*t*t-1)+n}function v(n,e){var o={};return Object.keys(n).forEach(function(t){o[t]=n[t]}),Object.keys(e).forEach(function(t){o[t]=e[t]}),o}function d(t){return t instanceof HTMLElement?t.scrollTop:t.pageYOffset}function t(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{},n=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};this.options=v(e,t),this.easeFunctions=v({easeOutQuart:o},n)}return t.prototype.registerTrigger=function(t,n){var e=this;if(t){var o=t.getAttribute("href")||t.getAttribute("data-target"),r=o&&"#"!==o?document.getElementById(o.substring(1)):document.body,i=v(this.options,function(e,t){var o={};return Object.keys(t).forEach(function(t){var n=e.getAttribute("data-mt-".concat(function(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}(t)));n&&(o[t]=isNaN(n)?n:parseInt(n,10))}),o}(t,this.options));"function"==typeof n&&(i.callback=n);var a=function(t){t.preventDefault(),e.move(r,i)};return t.addEventListener("click",a,!1),function(){return t.removeEventListener("click",a,!1)}}},t.prototype.move=function(i){var a=this,c=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};if(0===i||i){c=v(this.options,c);var u,s="number"==typeof i?i:i.getBoundingClientRect().top,f=d(c.container),l=null;s-=c.tolerance;window.requestAnimationFrame(function t(n){var e=d(a.options.container);l||(l=n-1);var o=n-l;if(u&&(0<s&&e<u||s<0&&u<e))return c.callback(i);u=e;var r=a.easeFunctions[c.easing](o,f,s,c.duration);c.container.scroll(0,r),o<c.duration?window.requestAnimationFrame(t):(c.container.scroll(0,s+f),c.callback(i))})}},t.prototype.addEaseFunction=function(t,n){this.easeFunctions[t]=n},t}();"undefined"!=typeof module?module.exports=MoveTo:window.MoveTo=MoveTo;
     var moveTo = new MoveTo({
      tolerance: 0,
      duration: 10,
      easing: 'easeOutQuart',
      container: window
    });
     var target = document.getElementById('page');
     moveTo.move(target);
   });
  }

</script>

</body>
</html>
