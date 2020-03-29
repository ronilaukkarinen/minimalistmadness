jQuery( window ).on( 'load', function() {
  var featuredimageUrl = jQuery('.editor-post-featured-image').find('img').prop('src');
  jQuery('.editor-post-title').css('background-image', 'url(' + featuredimageUrl + ')');
});
