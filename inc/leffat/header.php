<?php header( 'HTTP/1.0 200 OK', true );
/**
 *  Movie page header
 *
 *  @package khonsu
 */

?><!doctype html>
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="@rolle" />
	<meta name="twitter:creator" content="@rolle" />
	<meta property="og:type" content="article" />
	<meta property="article:section" content="Arvostelut" />
	<meta property="article:publisher" content="https://www.facebook.com/rollenleffat">
	<meta property="og:locale" content="fi_FI" />
	<meta property="og:site_name" content="Rollen leffablogi" />
	<meta property="og:url" content="<?php if ( true === $hakusivu ) : ?>https://www.rollemaa.fi/leffat<?php else : echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; endif; ?>" />

	<?php if ( true === $hakusivu ) :
	$host = getenv( 'DB_HOST' );
  $user = getenv( 'DB_USER' );
  $password = getenv( 'DB_PASSWORD' );
  $database_name = getenv( 'DB_NAME' );
  $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));

  // Remove the pesky slashes from magic quotes if it's turned on
  function clean_string( $value, $DB ) {
    if ( get_magic_quotes_gpc() ) {
     $value = stripslashes( $value );
    }
    // Escape things properly
   return mysqli_real_escape_string( $value, $DB );
 }

// Quote variable to make safe
 function quote_smart( $value ) {

  // Stripslashes
  if ( get_magic_quotes_gpc() ) {
   $value = stripslashes( $value );
 }
    // Quote if not a number or a numeric string
 if ( ! is_numeric( $value ) ) {
   $value = "'" . mysqli_real_escape_string( $value ) . "'";
 }

 return $value;
}

  // Get the search variable from URL
  $searchvar = @$_GET['elokuva'] ;
  $trimmed = trim($searchvar); // Trim whitespace from the stored variable
  $trimmed = stripslashes($trimmed);
  if ( preg_match("/'/i", $trimmed) ) {
  	$trimmed = explode("'", $trimmed);
  	$trimmed = $trimmed[1];
  	$trimmed = quote_smart( $trimmed );
  }

  // Pretty URL:
  $trimmed = preg_replace( '/-/', ' ', $trimmed );
  $trimmed = explode( ':',$trimmed );
  $trimmed = $trimmed[0];

  // Rows to return
  $limit = 1;

  // Check for an empty string and display a message.
  if ( '' === $trimmed ) {
    $trimmed = 'Et tarjonnut hakusanaa';
  }

  if ( isset( $_GET['kuvauksesta'] ) ) {

  	$query = $pdo->prepare("SELECT * FROM wp_movie_ratings WHERE title LIKE '%$trimmed%' OR review LIKE '%$trimmed%'
  		ORDER BY watched_on DESC");
  	$query->bindValue( 1, "%$trimmed%", PDO::PARAM_STR );
  	$query->execute();

  } else {

  	$query = $pdo->prepare("SELECT * FROM wp_movie_ratings WHERE title LIKE '%$trimmed%'
  		ORDER BY watched_on DESC");
  	$query->bindValue( 1, "%$trimmed%", PDO::PARAM_STR );
  	$query->execute();

  }

  $data = $query->fetchAll();

  foreach ( $data as $row ) {

  	$imdb_url_short = $row['imdb_url_short'];
  	$leffaid = explode( '/', $imdb_url_short );
  	$backdrop_image = 'https://www.rollemaa.fi/leffa/poster-image-db/' .$leffaid[0]. '-backdrop.jpg';
  	$poster_image = 'https://www.rollemaa.fi/leffa/poster-image-db/' .$leffaid[0]. '.jpg';
  	$title = $row['title'];
  	$review = $row['review'];
    preg_match( '/^([^.!?]*[\.!?]+){0,2}/', strip_tags( $text ), $abstract );
    $two_sentences_review = $abstract[0];
    ?>
    <meta property="og:image" content="<?php echo $backdrop_image; ?>" />
    <meta property="og:image" content="<?php echo $poster_image; ?>" />
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $two_sentences_review; ?>" />
    <?php }
  endif;
  ?>
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.6,width=device-width"/>

  <?php if ( true === $hakusivu ) : ?>
   <title><?php $searchword = @$_GET['elokuva']; if ( ! empty( $searchword ) ) { echo ucwords( preg_replace( '/-/', ' ', stripslashes( @$_GET['elokuva'] ) ) ).' - '; } ?>Elokuva-arvio</title>
 <?php else : ?>
   <title>Rollen leffablogi - Elokuvat, elokuva-arviot</title>
 <?php endif; ?>

 <?php if ( true === $hakusivu ) : ?>
   <meta property="og:image" content="https://www.rollemaa.fi/leffat.jpg" />
   <meta property="og:title" content="Rollen leffablogi - Elokuvat, elokuva-arviot" />
   <meta name="description" content="Kepeät elokuva-arviot leffoista, joita Rolle tykkää katsoa. Jokainen elokuva arvioidaan lopputekstien jälkeen. Jo yli 2000 arvioitua elokuvaa." />
   <meta property="og:description" content="Kepeät elokuva-arviot leffoista, joita Rolle tykkää katsoa. Jokainen elokuva arvioidaan lopputekstien jälkeen. Jo yli 2000 arvioitua elokuvaa." />
 <?php endif; ?>

 <style type="text/css">html { overflow-x: hidden; }</style>

 <script src="<?php echo get_home_url(); ?>/leffa/jquery.min.js"></script>
 <script src="<?php echo get_home_url(); ?>/leffa/js/movies.js"></script>
 <script src="<?php echo get_home_url(); ?>/content/plugins/gravityforms/js/jquery.json.js"></script>
 <script src="<?php echo get_home_url(); ?>/content/plugins/gravityforms/js/gravityforms.min.js"></script>
 <script src="<?php echo get_home_url(); ?>/content/plugins/gravityforms/js/placeholders.jquery.min.js"></script>
 <script src="<?php echo get_home_url(); ?>/content/plugins/gravityforms/js/jquery.maskedinput.min.js"></script>

 <link rel="icon" href="<?php echo get_home_url(); ?>/favicon-leffat.gif" type="image/gif" />
 <link rel="shortcut icon" href="<?php echo get_home_url(); ?>/favicon-leffat.ico" type="image/x-icon" />
 <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700italic" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/leffat.css" type="text/css" />
 <link rel="alternate" type="application/rss+xml" title="Rollen leffasivun RSS 2.0 -syöte" href="https://feeds.feedburner.com/rollenleffasivu" />

</head>
<body>
