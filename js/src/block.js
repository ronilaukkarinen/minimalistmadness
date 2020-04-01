jQuery( window ).on( 'load', function() {

  // Get post ID
  const getpostID = document.getElementById('post_ID').getAttribute('value');

  // Get featured image from WP REST API
  jQuery.get('https://www.rollemaa.fi/wp-json/wp/v2/posts/' + getpostID, function(data) {
    const featuredimageUrl = data.featured_image_custom;
    jQuery('.editor-post-title').css('background-image', 'url(' + featuredimageUrl + ')');
  }, 'json');
});
