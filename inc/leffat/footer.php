<?php
/**
 * Movie page footer
 *
 * @package khonsu
 */

?>

<div class="somesetti">
	<div class="container">

		<h3 id="bottom">Seuraa <span>&amp;</span> keskustele</h3>

		<p>Rollen leffaprofiilit löytyvät lähes jokaisesta netin leffapalvelusta, mutta saadaksesi ensimmäisenä tiedon uusista arvosteluista voit pistää seurantaan esimerkiksi <a href="http://www.facebook.com/rollenleffat">Facebookissa</a>, <a href="http://feeds.feedburner.com/rollenleffasivu" class="rss">RSS:n</a> tai Twitterin <a href="https://twitter.com/search?q=%23leffat&amp;src=typd">#leffat</a> -hashtagin avulla. Alla olevista palveluista löydät kätevästi leffasuosituksia. Enkkuarviot löytyy <a href="http://letterboxd.com/rolle/">Letterboxd:stä</a>.</p>

		<div class="footer-extra">
			<ul class="sosiaaliset-mediat">
				<li><a class="imdblista" href="http://www.imdb.com/mymovies/list?l=27761618" title="Rollen leffalista IMDb:ssä"><span>Rollen leffalista IMDb:ssä</span></a></li>
				<li><a target="_blank" class="facebook" href="http://www.facebook.com/rollenleffat" title="Rollen leffasivu Facebookissa"><span>Rollen leffasivu Facebookissa</span></a></li>
				<li><a target="_blank" class="listal" href="http://rolle.listal.com/" title="Profiilini Listalissa"><span>Profiilini Listalissa</span></a></li>
				<li><a target="_blank" class="flixster" href="http://www.flixster.com/user/804926173/" title="Profiilini Flixsterissä"><span>Profiilini Flixsterissä</span></a></li>
				<li><a target="_blank" class="letterboxd" href="http://letterboxd.com/rolle/" title="Profiilini Letterboxd:ssä"><span>Profiilini Letterboxd:ssä</span></a></li>
				<li><a target="_blank" class="goodfilms" href="http://goodfil.ms/rolle/" title="Profiilini Goodfilmsissä"><span>Profiilini Goodfilmsissä</span></a></li>
				<li><a target="_blank" class="leffatykki" href="http://www.leffatykki.com/profiili/Rolle/julkinen" title="Profiilini Leffatykissä"><span>Profiilini Leffatykissä</span></a></li>
				<li><a target="_blank" class="trakt" href="http://trakt.tv/user/rolle" title="Profiilini Trakt.tv:ssä"><span>Profiilini Trakt.tv:ssä</span></a></li>
				<li><a target="_blank" class="netflix" href="http://www.netflix.fi" title="Käytän Netflixiä!"><span>Käytän Netflixiä!</span></a></li>
				<li><a target="_blank" class="rottentomatoes" href="http://www.rottentomatoes.com/user/id/804926173/" title="Rotten Tomatoes -profiilini!"><span>Rotten Tomatoes -profiilini!</span></a></li>
				<li><a target="_blank" class="leanflix" href="http://www.leanflix.com/" title="Leanflix"><span>Leanflix</span></a></li>
				<li><a target="_blank" class="movielens" href="https://movielens.org/" title="Movielens"><span>Movielens</span></a></li>
				<li><a target="_blank" class="criticker" href="http://www.criticker.com/profile/rolle/" title="Criticker"><span>Criticker</span></a></li>
				<li><a target="_blank" class="bestmoviesbyfarr" href="http://www.bestmoviesbyfarr.com/" title="Best Movies by Farr"><span>Best Movies by Farr</span></a></li>
				<li><a target="_blank" class="movieo" href="https://movieo.me/users/rolle-rdvhg?lists_sort=trending&amp;item_type=lists" title="Movieo"><span>Movieo</span></a></li>
				<li><a target="_blank" class="nextqueue" href="https://nextqueue.com/u/rolle/" title="NextQueue"><span>NextQueue</span></a></li>
				<li><a target="_blank" class="tmdb" href="https://www.themoviedb.org/u/rolle" title="The Movie Database"><span>The Movie Database</span></a></li>
				<li><a target="_blank" class="tasteio" href="https://www.taste.io/users/rolle" title="Taste.io"><span>Taste.io</span></a></li>
				<li><a target="_blank" class="movix" href="https://movix.ai" title="Movix.ai"><span>Movix.ai</span></a></li>
			</ul>
		</div>

	</div>
</div>

</div>

<a class="adminlinkki" href="<?php echo admin_url(); ?>/tools.php?page=wp_movie_ratings_management">Admin</a>
<a href="<?php echo get_home_url(); ?>" id="rollemaa">rollemaa.fi</a>

<?php if ( getenv( 'WP_ENV' ) === 'production' ) : ?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-787859-1', 'auto');
		ga('send', 'pageview');

	</script>

<!-- Matomo -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.dude.fi/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '3']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
<?php endif; ?>

</body>
</html>
