/**
 * Air theme JavaScript.
 */

// Regular scripts
require('./jquery.js');
require('./fitvids.js');
require('./lazyload.js');
require('./prism.js');

// Import modules (comment to disable)
import './skip-link-focus-fix';
import 'what-input';
import MoveTo from 'moveto';
import Swup from 'swup';
import SwupScriptsPlugin from '@swup/scripts-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';
import SwupGaPlugin from '@swup/ga-plugin';

// Get Vue.js
const Vue = require('vue/dist/vue.min');

// Debounce
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

// Initiate Swup transitions
const swup = new Swup({
  plugins: [
    new SwupScriptsPlugin({
      head: true,
      body: true
    }),
    new SwupBodyClassPlugin()
  ]
});

// Define Javascript is active by changing the body class
document.body.classList.remove('no-js');
document.body.classList.add('js');

// Init lazyload
// Usage example on template side when air-helper enabled:
// <?php image_lazyload_tag( get_post_thumbnail_id( $post->ID ) ); ?>
let images = document.querySelectorAll('.lazyload');
lazyload(images, {
 root: null,
 rootMargin: "0px",
 threshold: 0
});

// Swup starts
swup.on('contentReplaced', function() {

    // Most read posts
    jQuery(document).ready(function($) {
      var d = new Date();
      var time_current = d.getTime();
      var time_saved = sessionStorage.getItem('dmrpreadcookie_' + dmrp.id);

      if( (time_current - time_saved ) > dmrp.cookie_timeout ) {
        sessionStorage.setItem('dmrpreadcookie_'+dmrp.id, time_current);
        dmrp_count();
      }
    });

    function dmrp_count() {
      var data = {
        'action': 'dmrp_count',
        'nonce': dmrp.nonce,
        'id': dmrp.id
      };

      jQuery.post(dmrp.ajax_url, data, function(response) {});
    }

    // Load Instagram API script
    const loadInstagramAPI = () => {
      const tag = document.createElement('script');
      tag.src = "https://www.instagram.com/embed.js";
      const firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      window.isInstagramIframeAPILoaded = true;
    }

    loadInstagramAPI();

    // Always move scroll position to up when clicking a link
    var moveTo = new MoveTo({
      tolerance: 0,
      duration: 0,
      easing: 'easeOutQuart',
      container: window
    });

    var target = document.getElementById('swup');
    moveTo.move(target);

});
// Swup ends

// jQuery start
( function( $ ) {

  // Document ready start
  $(function() {

    // Most read posts
    jQuery(document).ready(function($) {
      var d = new Date();
      var time_current = d.getTime();
      var time_saved = sessionStorage.getItem('dmrpreadcookie_' + dmrp.id);

      if( (time_current - time_saved ) > dmrp.cookie_timeout ) {
        sessionStorage.setItem('dmrpreadcookie_'+dmrp.id, time_current);
        dmrp_count();
      }
    });

    function dmrp_count() {
      var data = {
        'action': 'dmrp_count',
        'nonce': dmrp.nonce,
        'id': dmrp.id
      };

      jQuery.post(dmrp.ajax_url, data, function(response) {});
    }

    // My own ads
    const adContent = '<p class="promotion-info">-- Sori häiriö, tämä on härski oman firmani mainos, teksti jatkuu alapuolella --</p><a href="https://www.dude.fi/yhteystiedot" class="global-link"></a><div class="spans"><div class="span span-first"><div class="inner"><span class="screen-reader-text">Digitoimisto Dude Oy</span><svg width="110" height="21.98" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 2267.72 453.54" xml:space="preserve"><path fill="currentColor" d="M950.26 211.64c0 37.66-12.7 111.12-97.79 111.12-85.61 0-98.4-73.47-98.4-111.12V5.23H590.91v217.92c0 138.73 97.78 221.55 261.55 221.55 163.39 0 260.93-82.82 260.93-221.55V5.23H950.26v206.41zM2264.41 127.17V5.23h-505.2v439.48h505.2V322.76h-345.08v-48.71h286.91v-98.17h-286.91v-48.71zM317.21 5.23H3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53H166.14v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79zM1485.51 5.23H1171.3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53h-111.23v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79z"/></svg></div></div><div class="span span-second"><h3 class="title">Haluatko hyvin tehdyt WordPress-sivut sinulle tai yrityksellesi?</h3><p>Nämäkin sivut joita juuri nyt katselet ovat käsintehtyä, kotimaista laatua. Tekemämme verkkosivut latautuvat supernopeasti ja ovat naurettavan hyvännäköisiä. Yrityksemme on ollut toiminnasta vuodesta 2013 ja meillä on Jyväskylässä kaksi maailmanluokan suunnittelijaa. <a href="https://www.dude.fi/yhteystiedot">Ota yhteyttä!</a></p></div>';

    if ( document.getElementById('article-text-content') ) {
      var ownAd = document.createElement("div");
      ownAd.innerHTML = adContent;
      ownAd.classList.add('ownad-unblockable');
      var articleElement = document.querySelector('.container-article').children[0];
      if ( articleElement.children.length ) {
        var childCount = articleElement.children.length;
        var referenceElement = articleElement.children[parseInt(childCount / 3)];
        referenceElement.parentNode.insertBefore(ownAd, referenceElement.nextSibling);
      }
    }

    if ( document.getElementById('spawn-slot') ) {
      var ownAdSlot = document.createElement("div");
      ownAdSlot.innerHTML = adContent;
      ownAdSlot.classList.add('ownad-unblockable');
      var referenceElementSlot = document.getElementById('spawn-slot');
      referenceElementSlot.parentNode.insertBefore(ownAdSlot, referenceElementSlot.nextSibling);
    }

    // Fitvids
    $('.entry-content, .wp-block-embed__wrapper').fitVids();

    // Load random posts dynamically
    $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
    $('.load-more-random').on('click', function(event) {
      event.preventDefault();
      $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
    });

    // Close search on document ready
    $('.overlay-search').removeClass('overlay-open');
    $('body').removeClass('overlay-open');
    $('body').removeClass('search-open');

    // Empty search on close
    $('.search-results > div').remove();
    jQuery('.search-mobile input').val(null);
    jQuery('.overlay-search input').val(null);

    // Show other fields only when starting typing comment
    $('textarea#comment').keyup(function(){
      $('.hidden-by-default').addClass('show');
    });

    // Smooth scroll to ID on any anchor link
    $('a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash;

      if (target.length) {
        var $target = $(target);

        $('html, body').stop().animate({
          'scrollTop': $target.offset().top
        }, 500, 'swing', function () {
          window.location.hash = target;
        });
      }
    });

    // Vue construct
    var blog = new Vue({
      el: '.block-loadable .items-vue',
      data: {
        posts: []
      }
    });

    function air_do_ajax_load() {
      $('.block-loadable .load-more-spinner').show();
      $('.block-loadable .no-posts').hide();

      var button_container = $('.block-loadable button.load-more').closest('.load-more-container');
      var query_name = $('.block-loadable .load-more-container').attr('data-use-query');
      var query = window[query_name];

      // Where the page is currently:
      var firstPost = jQuery('.items-vue .post:first');
      var curOffset = firstPost.offset().top - $(document).scrollTop();

      // Alter query
      query.paged = query.paged+1;
      query._embed = true;

      // Do query
      jQuery.ajax({
        url: air.baseurl + 'wp_query/args/?' + jQuery.param( query ),
      }).done(function( response ) {

      // Offset to previous first message minus original offset/scroll
      $(document).scrollTop(firstPost.offset().top-curOffset);

      if( response.length !== 0 && response !== false ) {
        $.each( response, function() {
          var self = this;
          blog.posts.push(this);
          $('.block-loadable .load-more-spinner').hide();
        } );

        if( response.length < air.posts_per_page ) {
          button_container.hide();
        } else {
          button_container.show();
        }

      } else if( response == false ) {
        button_container.hide();
        $('.block-loadable .load-more-spinner').hide();
      }});
      }

    // Load more ajax call
    $('.block-loadable button.load-more').on( 'click', function(e) {
      e.preventDefault();
      air_do_ajax_load();
    } );

    // Window scroll
    $(window).scroll(function() {

      // Hide scroll indicator after certain amount
      if ( '.scroll-indicator' != undefined) {
        var scroll = $(window).scrollTop();
        if (scroll >= 200) {
          $('.scroll-indicator').addClass('fadeout');

          setTimeout( function(){
            $('.scroll-indicator').hide();
          }, 500 );

        } else {
          $('.scroll-indicator').removeClass('fadeout');

          setTimeout( function(){
            $('.scroll-indicator').show();
          }, 500 );
        }
      }
    });

    // Add class to old images without class
    $(window).ready(function() {
      $('.container-article img').each(function() {
        if ( $(this).width() > 350 ) {
          $(this).addClass('size-large');
        }
      });
    });

    // Mobile Menu Trigger
    $('.nav-burger').click(function () {
      $('body').toggleClass('site-head-open');
    });

    // Close mobile navigation when link is clicked
    // Mobile Menu Trigger
    $('.menu-item a').click(function () {
      $('body').removeClass('site-head-open');
    });

    // Rain
    var makeItRain = function() {

    // Clear out everything
    $('.rain').empty();

    var increment = 0;
    var drops = "";
    var backDrops = "";

    while (increment < 100) {
      // Couple random numbers to use for various randomizations
      // Random number between 98 and 1
      var randoHundo = (Math.floor(Math.random() * (98 - 1 + 1) + 1));
      // Random number between 5 and 2
      var randoFiver = (Math.floor(Math.random() * (5 - 2 + 1) + 2));
      // Increment
      increment += randoFiver;
      // Add in a new raindrop with various randomizations to certain CSS properties
      drops += '<div class="drop" style="left: ' + increment + '%; bottom: ' + (randoFiver + randoFiver - 1 + 100) + '%; animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"><div class="stem" style="animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"></div><div class="splat" style="animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"></div></div>';
      backDrops += '<div class="drop" style="right: ' + increment + '%; bottom: ' + (randoFiver + randoFiver - 1 + 100) + '%; animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"><div class="stem" style="animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"></div><div class="splat" style="animation-delay: 0.' + randoHundo + 's; animation-duration: 0.5' + randoHundo + 's;"></div></div>';
    }

    $('.rain.front-row').append(drops);
    $('.rain.back-row').append(backDrops);
  }

  $('.site-head-logo').hover(function(){
    $('body').addClass('splat-toggle');
  }, function() {
    $('body').removeClass('splat-toggle');
  });

  makeItRain();

    // Overlay-search
    $('.search-trigger').on( 'click', function(e) {
      e.preventDefault();
      $('body').removeClass('main-navigation-open');
      $('body').removeClass('is-scrolling-prevented');
      $('.main-navigation').fadeOut(600);
      $('.main-navigation').removeClass('is-open');
      $('.overlay-search, body').addClass('overlay-open');
      $('body').addClass('search-open');

      // Move focus to search-input
      $('.search-input').focus();
    } );

    $('.button-close, .article--link').on( 'click', function() {
      $(this).parent().parent().parent('.overlay').removeClass('overlay-open');
      $('body').removeClass('overlay-open');
      $('body').removeClass('search-open');

      // Empty search on close
      $('.search-results > div').remove();
      jQuery('.search-mobile input').val(null);
      jQuery('.overlay-search input').val(null);
    } );

    // Close search if esc is pressed
    $('.search-input').keyup(function(e) {
      if (e.keyCode === 27) {
        $(this).parent().parent().parent('.overlay').removeClass('overlay-open');
        $('body').removeClass('overlay-open');
        $('body').removeClass('search-open');

        // Empty search on close
        $('.search-results > div').remove();
        jQuery('.search-mobile input').val(null);
        jQuery('.overlay-search input').val(null);
      }
    });

  // Search
  $('.search-form input').on( 'keyup input paste', debounce(function() {
    var search = $('.search-form input').val();

    if ( ! search.trim() ) {
      $('.search-results').empty();
      return;
    }

    $.getJSON( air.baseurl + 'rollemaa/v1/search?s=' + search, function(results) {
      $('.search-results').empty();

      if ( results.length === 0 ) {
        $('.search-results').append( '<li class="no-results"><h2>Ei hakutuloksia.</h2></li>' );

      } else {
        $.each( results, function( i, result ) {
          $('.search-results').append( '<li><h2><a class="article--link" href="' + result.link + '">' + result.post_title + '</a></h2></li>' );
        } );
      }
    } );
  }, 250) );

});

} )( jQuery );
