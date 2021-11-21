/* eslint-disable radix, no-underscore-dangle, no-use-before-define, no-shadow, func-names, no-var, one-var, prefer-rest-params, no-undef, import/first, import/no-extraneous-dependencies, max-len, no-unused-vars, camelcase, no-plusplus, vars-on-top, no-continue */
/**
 * Air theme JavaScript.
 */

// Regular scripts
require('./modules/jquery');
require('./modules/fitvids');
require('./modules/lazyload');
require('./modules/prism');

// Import modules
import { Chart } from 'frappe-charts';
import * as moment from 'moment';
import './modules/skip-link-focus-fix';
import 'what-input';
import MoveTo from 'moveto';
import Swup from 'swup';
import SwupScriptsPlugin from '@swup/scripts-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';
import SwupGaPlugin from '@swup/ga-plugin';
import getLocalization from './modules/localization';
import styleExternalLinks from './modules/external-link';

// Embeds
// Load Instagram API script
const loadInstagramAPI = () => {
  const tag = document.createElement('script');
  tag.src = 'https://instagram.com/static/bundles/es6/EmbedSDK.js/47c7ec92d91e.js';
  const firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  window.isInstagramIframeAPILoaded = true;
};

loadInstagramAPI();

// Twitter
$.getScript('https://platform.twitter.com/widgets.js');
if (typeof (twttr) !== 'undefined') {
  twttr.widgets.load();
} else {
  $.getScript('https://platform.twitter.com/widgets.js');
}

// GitHub-styled charts
// WordPress post data for heatmaps
const dataPointsArray = heatmapdata;

const chartElement = document.getElementById('heatmap') || false;
if (chartElement) {
  // Construct chart
  const data = {
    dataPoints: dataPointsArray,
    // dataPoints: {
    //   1636489905: 153,
    //   1636397501: 490,
    // },
    start: new Date(moment().subtract(1, 'year').toDate()),
    end: new Date(moment().toDate()),
  };

  const chart = new Chart('#heatmap', { // or a DOM element,
    type: 'heatmap',
    discreteDomains: 0,
    radius: 1,
    colors: ['#ebedf0', '#c0ddf9', '#73b3f3', '#3886e1', '#17459e'],
    data,
  });
}

// Get Vue.js
const Vue = require('vue/dist/vue.min');

// Style external links
styleExternalLinks();

// Debounce
function debounce(func, wait, immediate) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    const later = function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

// Initiate Swup transitions
const swup = new Swup({
  plugins: [
    new SwupBodyClassPlugin(),
  ],
});

// Define Javascript is active by changing the body class
document.body.classList.remove('no-js');
document.body.classList.add('js');

// Init lazyload
// Usage example on template side when air-helper enabled:
// <?php image_lazyload_tag( get_post_thumbnail_id( $post->ID ) ); ?>
const images = document.querySelectorAll('.lazyload');
lazyload(images, {
  root: null,
  rootMargin: '0px',
  threshold: 0,
});

// Front page load more helper
const query = paged_query.posts_query;

// 100vh fix
// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
const vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

// We listen to the resize event
window.addEventListener('resize', () => {
  if (
    window.innerWidth > window.innerHeight
    || Math.abs(this.lastHeight - window.innerHeight) > 100
  ) {
  // We execute the same script as before
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  }
});

// Swup starts
swup.on('contentReplaced', () => {
  // 100vh fix
  // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
  const vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document
  document.documentElement.style.setProperty('--vh', `${vh}px`);

  // We listen to the resize event
  window.addEventListener('resize', () => {
    if (
      window.innerWidth > window.innerHeight
    || Math.abs(this.lastHeight - window.innerHeight) > 100
    ) {
      // We execute the same script as before
      const vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
  });

  // Front page load more helper
  const query = paged_query.posts_query;

  // Embeds
  // Load Instagram API script
  const loadInstagramAPI = () => {
    const tag = document.createElement('script');
    tag.src = 'https://instagram.com/static/bundles/es6/EmbedSDK.js/47c7ec92d91e.js';
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    window.isInstagramIframeAPILoaded = true;
  };

  loadInstagramAPI();

  // Important: This generates the images
  window.instgrm.Embeds.process();

  // Twitter
  $.getScript('https://platform.twitter.com/widgets.js');
  if (typeof (twttr) !== 'undefined') {
    twttr.widgets.load();
  } else {
    $.getScript('https://platform.twitter.com/widgets.js');
  }

  // Always move scroll position to up when clicking a link
  const moveTo = new MoveTo({
    tolerance: 0,
    duration: 0,
    easing: 'easeOutQuart',
    container: window,
  });

  const target = document.getElementById('swup');
  moveTo.move(target);

  // GitHub-styled charts
  // WordPress post data for heatmaps
  const dataPointsArray = heatmapdata;

  const chartElement = document.getElementById('heatmap') || false;
  if (chartElement) {
    // Construct chart
    const data = {
      dataPoints: dataPointsArray,
      // dataPoints: {
      //   1636489905: 153,
      //   1636397501: 490,
      // },
      start: new Date(moment().subtract(1, 'year').toDate()),
      end: new Date(moment().toDate()),
    };

    const chart = new Chart('#heatmap', { // or a DOM element,
      type: 'heatmap',
      discreteDomains: 0,
      radius: 1,
      colors: ['#ebedf0', '#c0ddf9', '#73b3f3', '#3886e1', '#17459e'],
      data,
    });
  }

  // jQuery start
  (function ($) {
  // Document ready start
    $(() => {
    // Most read posts
      jQuery(document).ready(($) => {
        const d = new Date();
        const time_current = d.getTime();
        const time_saved = sessionStorage.getItem(`dmrpreadcookie_${dmrp.id}`);

        if ((time_current - time_saved) > dmrp.cookie_timeout) {
          sessionStorage.setItem(`dmrpreadcookie_${dmrp.id}`, time_current);
          dmrp_count();
        }
      });

      function dmrp_count() {
        const data = {
          action: 'dmrp_count',
          nonce: dmrp.nonce,
          id: dmrp.id,
        };

        jQuery.post(dmrp.ajax_url, data, (response) => {});
      }

      // My own ads
      const adContent = '<p class="promotion-info">Sori häiriö, tämä on härski oman firmani mainos, teksti jatkuu alapuolella...</p><a href="https://www.dude.fi/yhteystiedot" class="global-link" aria-hidden="true" tabindex="-1"></a><div class="spans"><div class="span span-first"><div class="inner"><h2 class="screen-reader-text">Digitoimisto Dude Oy -mainos:</h2><svg aria-hidden="true" width="110" height="21.98" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 2267.72 453.54" xml:space="preserve"><path fill="currentColor" d="M950.26 211.64c0 37.66-12.7 111.12-97.79 111.12-85.61 0-98.4-73.47-98.4-111.12V5.23H590.91v217.92c0 138.73 97.78 221.55 261.55 221.55 163.39 0 260.93-82.82 260.93-221.55V5.23H950.26v206.41zM2264.41 127.17V5.23h-505.2v439.48h505.2V322.76h-345.08v-48.71h286.91v-98.17h-286.91v-48.71zM317.21 5.23H3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53H166.14v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79zM1485.51 5.23H1171.3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53h-111.23v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79z"/></svg></div></div><div class="span span-second"><h3 class="title">Tarvitsetko laadukkaat ja helposti päivitettävät verkkosivut?</h3><p>Nämäkin sivut joita juuri nyt katselet ovat käsintehtyä, kotimaista laatua. Toteuttamamme WordPress-verkkosivut latautuvat supernopeasti ja ovat naurettavan hyvännäköisiä. Emme käytä valmispalikoita, vaan suunnittelemme ja koodaamme kaikki käsin itse. Yrityksemme on ollut toiminnassa vuodesta 2013 ja kasvu on ollut tasaista. Meihin luottaa jo sadat asiakkaat. <a href="https://www.dude.fi/yhteystiedot">Tutustu lisää ja ota yhteyttä!</a> <button class="hide-forever"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="13" height="13"><path d="M11.559 1.042L1.042 11.912m0-10.87l10.517 10.87" stroke="currentColor" stroke-width="2" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"/></svg>Ei kiinnosta, piilota mainos pysyvästi</button></p></div>';

      if (window.localStorage.getItem('hide_dude_ad') === undefined || window.localStorage.getItem('hide_dude_ad') !== '1') {
        if (document.getElementById('article-text-content')) {
          const ownAd = document.createElement('div');
          ownAd.innerHTML = adContent;
          ownAd.classList.add('ownad-unblockable');
          const articleElement = document.querySelector('.container-article').children[0];
          if (articleElement.children.length) {
            const childCount = articleElement.children.length;
            const referenceElement = articleElement.children[parseInt(childCount / 3)];
            referenceElement.parentNode.insertBefore(ownAd, referenceElement.nextSibling);
          }
        }

        if (document.getElementById('spawn-slot')) {
          const ownAdSlot = document.createElement('div');
          ownAdSlot.innerHTML = adContent;
          ownAdSlot.classList.add('ownad-unblockable');
          const referenceElementSlot = document.getElementById('spawn-slot');
          referenceElementSlot.parentNode.insertBefore(ownAdSlot, referenceElementSlot.nextSibling);
        }
      }

      // console.log(window.localStorage.getItem('hide_dude_ad'));

      // Click event for hide forever -button
      document.addEventListener('click', (e) => {
        if (e.target && e.target.classList.contains('hide-forever')) {
        // Dismiss the notification, animate first
          const ownAd = document.querySelector('.ownad-unblockable');

          ownAd.classList.add('closing');
          window.setTimeout(() => {
            ownAd.classList.add('dismissed');
          }, 400);

          // Save closed state to local storage
          window.localStorage.setItem('hide_dude_ad', '1');
        }
      });

      // Fitvids
      $('.entry-content, .wp-block-embed__wrapper').fitVids();

      // Load random posts dynamically
      $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
      $('.load-more-random').on('click', (event) => {
        event.preventDefault();
        $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
      });

      // Close search on document ready
      $('.overlay-search').removeClass('overlay-open');
      $('body').removeClass('overlay-open');
      $('body').removeClass('search-open');

      // Empty search on close
      $('ul.search-results > div').remove();
      jQuery('.search-mobile input').val(null);
      jQuery('.overlay-search input').val(null);

      // Show other fields only when starting typing comment
      $('textarea#comment').keyup(() => {
        $('.hidden-by-default').addClass('show');
      });

      // Smooth scroll to ID on any anchor link
      $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();

        const target = this.hash;

        if (target.length) {
          const $target = $(target);

          $('html, body').stop().animate({
            scrollTop: $target.offset().top,
          }, 500, 'swing', () => {
            window.location.hash = target;
          });
        }
      });

      // Vue construct
      const blog = new Vue({
        el: '.block-loadable .items-vue',
        data: {
          posts: [],
        },
      });

      function air_do_ajax_load_for_swup() {
        $('.block-loadable .load-more-spinner').show();
        $('.block-loadable .no-posts').hide();

        const button_container = $('.block-loadable button.load-more').closest('.load-more-container');
        // const query_name = $('.block-loadable .load-more-container').attr('data-use-query');
        // const query = window[query_name];
        const query = paged_query.posts_query;

        // Where the page is currently:
        const firstPost = jQuery('.items-vue .post:first');
        const curOffset = firstPost.offset().top - $(document).scrollTop();

        // Alter query
        query.paged += 1;
        query._embed = true;

        // Do query
        jQuery.ajax({
          url: `${air.baseurl}wp_query/args/?${jQuery.param(query)}`,
        }).done((response) => {
          // Offset to previous first message minus original offset/scroll
          $(document).scrollTop(firstPost.offset().top - curOffset);

          if (response.length !== 0 && response !== false) {
            $.each(response, function () {
              const self = this;

              // console.log(blog.posts);
              // console.log('Works');

              blog.posts.push(this);
              $('.block-loadable .load-more-spinner').hide();
            });

            if (response.length < air.posts_per_page) {
              button_container.hide();
            } else {
              button_container.show();
            }
          } else if (response === false) {
            button_container.hide();
            $('.block-loadable .load-more-spinner').hide();
          }
        });
      }

      // Load more ajax call
      $('.block-loadable button.load-more').on('click', (e) => {
        e.preventDefault();
        air_do_ajax_load_for_swup();
      });

      // Window scroll
      $(window).scroll(() => {
      // Hide scroll indicator after certain amount
        if (undefined !== '.scroll-indicator') {
          const scroll = $(window).scrollTop();
          if (scroll >= 200) {
            $('.scroll-indicator').addClass('fadeout');

            setTimeout(() => {
              $('.scroll-indicator').hide();
            }, 500);
          } else {
            $('.scroll-indicator').removeClass('fadeout');

            setTimeout(() => {
              $('.scroll-indicator').show();
            }, 500);
          }
        }
      });

      // Add class to old images without class
      $(window).ready(() => {
        $('.container-article img').each(function () {
          if ($(this).width() > 350) {
            $(this).addClass('size-large');
          }
        });
      });

      // Mobile Menu Trigger
      $('.nav-burger').click(() => {
        $('body').toggleClass('site-head-open');
      });

      // Close mobile navigation when link is clicked
      // Mobile Menu Trigger
      $('.menu-item a').click(() => {
        $('body').removeClass('site-head-open');
      });

      // Rain
      const makeItRain = function () {
      // Clear out everything
        $('.rain').empty();

        let increment = 0;
        let drops = '';
        let backDrops = '';

        while (increment < 100) {
        // Couple random numbers to use for various randomizations
        // Random number between 98 and 1
          const randoHundo = (Math.floor(Math.random() * (98 - 1 + 1) + 1));
          // Random number between 5 and 2
          const randoFiver = (Math.floor(Math.random() * (5 - 2 + 1) + 2));
          // Increment
          increment += randoFiver;
          // Add in a new raindrop with various randomizations to certain CSS properties
          drops += `<div class="drop" style="left: ${increment}%; bottom: ${randoFiver + randoFiver - 1 + 100}%; animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"><div class="stem" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div><div class="splat" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div></div>`;
          backDrops += `<div class="drop" style="right: ${increment}%; bottom: ${randoFiver + randoFiver - 1 + 100}%; animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"><div class="stem" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div><div class="splat" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div></div>`;
        }

        $('.rain.front-row').append(drops);
        $('.rain.back-row').append(backDrops);
      };

      $('.site-head-logo').hover(() => {
        $('body').addClass('splat-toggle');
      }, () => {
        $('body').removeClass('splat-toggle');
      });

      makeItRain();

      // Overlay-search
      $('.search-trigger').on('click', (e) => {
        e.preventDefault();
        $('body').removeClass('main-navigation-open');
        $('body').removeClass('is-scrolling-prevented');
        $('.main-navigation').fadeOut(600);
        $('.main-navigation').removeClass('is-open');
        $('.overlay-search, body').addClass('overlay-open');
        $('body').addClass('search-open');

        // Move focus to search-input
        document.getElementById('search-input').focus();
      });

      $('.button-close, .article--link').on('click', function () {
        $(this).parent().parent().parent('.overlay')
          .removeClass('overlay-open');
        $('body').removeClass('overlay-open');
        $('body').removeClass('search-open');

        // Empty search on close
        $('ul.search-results > div').remove();
        jQuery('.search-mobile input').val(null);
        jQuery('.overlay-search input').val(null);
      });

      // Close search if esc is pressed
      $('.search-input').keyup(function (e) {
        if (e.keyCode === 27) {
          $(this).parent().parent().parent('.overlay')
            .removeClass('overlay-open');
          $('body').removeClass('overlay-open');
          $('body').removeClass('search-open');

          // Empty search on close
          $('ul.search-results > div').remove();
          jQuery('.search-mobile input').val(null);
          jQuery('.overlay-search input').val(null);
        }
      });

      // Search
      $('.search-form input').on('keyup input paste', debounce(() => {
        const search = $('.search-form input').val();

        if (!search.trim()) {
          $('ul.search-results').empty();
          return;
        }

        $.getJSON(`${air.baseurl}rollemaa/v1/search?s=${search}`, (results) => {
          $('ul.search-results').empty();

          if (results.length === 0) {
            $('ul.search-results').append('<li class="no-results"><h2>Ei hakutuloksia.</h2></li>');
          } else {
            $.each(results, (i, result) => {
              $('ul.search-results').append(`<li><h2><a class="article--link" href="${result.link}">${result.post_title}</a></h2></li>`);
            });
          }
        });
      }, 250));
    });
  }(jQuery));
});
// Swup ends

// jQuery start
(function ($) {
  // Document ready start
  $(() => {
    // Most read posts
    jQuery(document).ready(($) => {
      const d = new Date();
      const time_current = d.getTime();
      const time_saved = sessionStorage.getItem(`dmrpreadcookie_${dmrp.id}`);

      if ((time_current - time_saved) > dmrp.cookie_timeout) {
        sessionStorage.setItem(`dmrpreadcookie_${dmrp.id}`, time_current);
        dmrp_count();
      }
    });

    function dmrp_count() {
      const data = {
        action: 'dmrp_count',
        nonce: dmrp.nonce,
        id: dmrp.id,
      };

      jQuery.post(dmrp.ajax_url, data, (response) => {});
    }

    // My own ads
    const adContent = '<p class="promotion-info">Sori häiriö, tämä on härski oman firmani mainos, teksti jatkuu alapuolella...</p><a href="https://www.dude.fi/yhteystiedot" class="global-link" aria-hidden="true" tabindex="-1"></a><div class="spans"><div class="span span-first"><div class="inner"><h2 class="screen-reader-text">Digitoimisto Dude Oy -mainos:</h2><svg aria-hidden="true" width="110" height="21.98" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 2267.72 453.54" xml:space="preserve"><path fill="currentColor" d="M950.26 211.64c0 37.66-12.7 111.12-97.79 111.12-85.61 0-98.4-73.47-98.4-111.12V5.23H590.91v217.92c0 138.73 97.78 221.55 261.55 221.55 163.39 0 260.93-82.82 260.93-221.55V5.23H950.26v206.41zM2264.41 127.17V5.23h-505.2v439.48h505.2V322.76h-345.08v-48.71h286.91v-98.17h-286.91v-48.71zM317.21 5.23H3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53H166.14v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79zM1485.51 5.23H1171.3v439.48h314.21c108.81 0 219.87-87.76 219.87-219.74 0-132.83-111.06-219.74-219.87-219.74zm-39.84 317.53h-111.23v-195.4h111.23c57.58 0 97.7 45.79 97.7 97.61 0 52.51-40.12 97.79-97.7 97.79z"/></svg></div></div><div class="span span-second"><h3 class="title">Tarvitsetko laadukkaat ja helposti päivitettävät verkkosivut?</h3><p>Nämäkin sivut joita juuri nyt katselet ovat käsintehtyä, kotimaista laatua. Toteuttamamme WordPress-verkkosivut latautuvat supernopeasti ja ovat naurettavan hyvännäköisiä. Emme käytä valmispalikoita, vaan suunnittelemme ja koodaamme kaikki käsin itse. Yrityksemme on ollut toiminnassa vuodesta 2013 ja kasvu on ollut tasaista. Meihin luottaa jo sadat asiakkaat. <a href="https://www.dude.fi/yhteystiedot">Tutustu lisää ja ota yhteyttä!</a> <button class="hide-forever"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="13" height="13"><path d="M11.559 1.042L1.042 11.912m0-10.87l10.517 10.87" stroke="currentColor" stroke-width="2" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"/></svg>Ei kiinnosta, piilota mainos pysyvästi</button></p></div>';

    if (window.localStorage.getItem('hide_dude_ad') === undefined || window.localStorage.getItem('hide_dude_ad') !== '1') {
      if (document.getElementById('article-text-content')) {
        const ownAd = document.createElement('div');
        ownAd.innerHTML = adContent;
        ownAd.classList.add('ownad-unblockable');
        const articleElement = document.querySelector('.container-article').children[0];
        if (articleElement.children.length) {
          const childCount = articleElement.children.length;
          const referenceElement = articleElement.children[parseInt(childCount / 3)];
          referenceElement.parentNode.insertBefore(ownAd, referenceElement.nextSibling);
        }
      }

      if (document.getElementById('spawn-slot')) {
        const ownAdSlot = document.createElement('div');
        ownAdSlot.innerHTML = adContent;
        ownAdSlot.classList.add('ownad-unblockable');
        const referenceElementSlot = document.getElementById('spawn-slot');
        referenceElementSlot.parentNode.insertBefore(ownAdSlot, referenceElementSlot.nextSibling);
      }
    }

    // console.log(window.localStorage.getItem('hide_dude_ad'));

    // Click event for hide forever -button
    document.addEventListener('click', (e) => {
      if (e.target && e.target.classList.contains('hide-forever')) {
        // Dismiss the notification, animate first
        const ownAd = document.querySelector('.ownad-unblockable');

        ownAd.classList.add('closing');
        window.setTimeout(() => {
          ownAd.classList.add('dismissed');
        }, 400);

        // Save closed state to local storage
        window.localStorage.setItem('hide_dude_ad', '1');
      }
    });

    // Fitvids
    $('.entry-content, .wp-block-embed__wrapper').fitVids();

    // Load random posts dynamically
    $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
    $('.load-more-random').on('click', (event) => {
      event.preventDefault();
      $('.dynamic-content').load('/content/themes/minimalistmadness/template-parts/random-dynamic.php');
    });

    // Close search on document ready
    $('.overlay-search').removeClass('overlay-open');
    $('body').removeClass('overlay-open');
    $('body').removeClass('search-open');

    // Empty search on close
    $('ul.search-results > div').remove();
    jQuery('.search-mobile input').val(null);
    jQuery('.overlay-search input').val(null);

    // Show other fields only when starting typing comment
    $('textarea#comment').keyup(() => {
      $('.hidden-by-default').addClass('show');
    });

    // Smooth scroll to ID on any anchor link
    $('a[href^="#"]').on('click', function (e) {
      e.preventDefault();

      const target = this.hash;

      if (target.length) {
        const $target = $(target);

        $('html, body').stop().animate({
          scrollTop: $target.offset().top,
        }, 500, 'swing', () => {
          window.location.hash = target;
        });
      }
    });

    // Vue construct
    const blog = new Vue({
      el: '.block-loadable .items-vue',
      data: {
        posts: [],
      },
    });

    function air_do_ajax_load() {
      $('.block-loadable .load-more-spinner').show();
      $('.block-loadable .no-posts').hide();

      const button_container = $('.block-loadable button.load-more').closest('.load-more-container');
      // const query_name = $('.block-loadable .load-more-container').attr('data-use-query');
      // const query = window[query_name];
      const query = paged_query.posts_query;

      // Where the page is currently:
      const firstPost = jQuery('.items-vue .post:first');
      const curOffset = firstPost.offset().top - $(document).scrollTop();

      // Alter query
      query.paged += 1;
      query._embed = true;

      // Do query
      jQuery.ajax({
        url: `${air.baseurl}wp_query/args/?${jQuery.param(query)}`,
      }).done((response) => {
        // Offset to previous first message minus original offset/scroll
        $(document).scrollTop(firstPost.offset().top - curOffset);

        if (response.length !== 0 && response !== false) {
          $.each(response, function () {
            const self = this;
            blog.posts.push(this);
            $('.block-loadable .load-more-spinner').hide();

            // console.log(this);
            // console.log('Really');
          });

          if (response.length < air.posts_per_page) {
            button_container.hide();
          } else {
            button_container.show();
          }
        } else if (response === false) {
          button_container.hide();
          $('.block-loadable .load-more-spinner').hide();
        }
      });
    }

    // Load more ajax call
    $('.block-loadable button.load-more').on('click', (e) => {
      e.preventDefault();
      air_do_ajax_load();
    });

    // Window scroll
    $(window).scroll(() => {
      // Hide scroll indicator after certain amount
      if (undefined !== '.scroll-indicator') {
        const scroll = $(window).scrollTop();
        if (scroll >= 200) {
          $('.scroll-indicator').addClass('fadeout');

          setTimeout(() => {
            $('.scroll-indicator').hide();
          }, 500);
        } else {
          $('.scroll-indicator').removeClass('fadeout');

          setTimeout(() => {
            $('.scroll-indicator').show();
          }, 500);
        }
      }
    });

    // Add class to old images without class
    $(window).ready(() => {
      $('.container-article img').each(function () {
        if ($(this).width() > 350) {
          $(this).addClass('size-large');
        }
      });
    });

    // Mobile Menu Trigger
    $('.nav-burger').click(() => {
      $('body').toggleClass('site-head-open');
    });

    // Close mobile navigation when link is clicked
    // Mobile Menu Trigger
    $('.menu-item a').click(() => {
      $('body').removeClass('site-head-open');
    });

    // Rain
    const makeItRain = function () {
      // Clear out everything
      $('.rain').empty();

      let increment = 0;
      let drops = '';
      let backDrops = '';

      while (increment < 100) {
        // Couple random numbers to use for various randomizations
        // Random number between 98 and 1
        const randoHundo = (Math.floor(Math.random() * (98 - 1 + 1) + 1));
        // Random number between 5 and 2
        const randoFiver = (Math.floor(Math.random() * (5 - 2 + 1) + 2));
        // Increment
        increment += randoFiver;
        // Add in a new raindrop with various randomizations to certain CSS properties
        drops += `<div class="drop" style="left: ${increment}%; bottom: ${randoFiver + randoFiver - 1 + 100}%; animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"><div class="stem" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div><div class="splat" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div></div>`;
        backDrops += `<div class="drop" style="right: ${increment}%; bottom: ${randoFiver + randoFiver - 1 + 100}%; animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"><div class="stem" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div><div class="splat" style="animation-delay: 0.${randoHundo}s; animation-duration: 0.5${randoHundo}s;"></div></div>`;
      }

      $('.rain.front-row').append(drops);
      $('.rain.back-row').append(backDrops);
    };

    $('.site-head-logo').hover(() => {
      $('body').addClass('splat-toggle');
    }, () => {
      $('body').removeClass('splat-toggle');
    });

    makeItRain();

    // Overlay-search
    $('.search-trigger').on('click', (e) => {
      e.preventDefault();
      $('body').removeClass('main-navigation-open');
      $('body').removeClass('is-scrolling-prevented');
      $('.main-navigation').fadeOut(600);
      $('.main-navigation').removeClass('is-open');
      $('.overlay-search, body').addClass('overlay-open');
      $('body').addClass('search-open');

      // Move focus to search-input
      document.getElementById('search-input').focus();
    });

    $('.button-close, .article--link').on('click', function () {
      $(this).parent().parent().parent('.overlay')
        .removeClass('overlay-open');
      $('body').removeClass('overlay-open');
      $('body').removeClass('search-open');

      // Empty search on close
      $('ul.search-results > div').remove();
      jQuery('.search-mobile input').val(null);
      jQuery('.overlay-search input').val(null);
    });

    // Close search if esc is pressed
    $('.search-input').keyup(function (e) {
      if (e.keyCode === 27) {
        $(this).parent().parent().parent('.overlay')
          .removeClass('overlay-open');
        $('body').removeClass('overlay-open');
        $('body').removeClass('search-open');

        // Empty search on close
        $('ul.search-results > div').remove();
        jQuery('.search-mobile input').val(null);
        jQuery('.overlay-search input').val(null);
      }
    });

    // Search
    $('.search-form input').on('keyup input paste', debounce(() => {
      const search = $('.search-form input').val();

      if (!search.trim()) {
        $('ul.search-results').empty();
        return;
      }

      $.getJSON(`${air.baseurl}rollemaa/v1/search?s=${search}`, (results) => {
        $('ul.search-results').empty();

        if (results.length === 0) {
          $('ul.search-results').append('<li class="no-results"><h2>Ei hakutuloksia.</h2></li>');
        } else {
          $.each(results, (i, result) => {
            $('ul.search-results').append(`<li><h2><a class="article--link" href="${result.link}">${result.post_title}</a></h2></li>`);
          });
        }
      });
    }, 250));
  });
}(jQuery));
