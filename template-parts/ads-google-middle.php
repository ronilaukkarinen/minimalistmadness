<?php
/**
 * Ads for the middle section of the page
 *
 * @package minimalistmadness
 */

if ( ! is_logged_in() ) :
if ( 2 === $count || is_page() || is_single() ) : ?>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-format="fluid"
     data-ad-layout="in-article"
     data-ad-client="ca-pub-8523880252818258"
     data-ad-slot="6978444070"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<?php
endif;
endif;
