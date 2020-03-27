/**
 * Air theme JavaScript.
 */

// Import modules (comment to disable)
import './skip-link-focus-fix';
import 'what-input';
import './lazyload.js';
import Swup from 'swup';

// Initiate Swup transitions
const swup = new Swup({
  doScrollingRightAway: false,
  animateScroll: false,
  scrollFriction: .3,
  scrollAcceleration: .04
});

// Fix scroll position
window.onload = function() {
  swup.on('contentReplaced', function() {

    // Define Javascript is active by changing the body class
    document.body.classList.remove('no-js');
    document.body.classList.add('js');
  });
}

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

// jQuery start
( function( $ ) {

  // Document ready start
  $(function() {

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
        console.log( $(this).width() );
        if ( $(this).width() > 350 ) {
          $(this).addClass('size-large');
        }
      });
    });

    // Mobile Menu Trigger
    $('.nav-burger').click(function () {
      $('body').toggleClass('site-head-open');
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

});

} )( jQuery );
