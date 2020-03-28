<?php
/**
 * Template Name: Pelkkä elokuvasivu
 *
 * @package khonsu
 */

include get_theme_file_path( 'inc/leffat/header.php' );
?>

<?php wp_movie_ratings_show( 20, array( 'page_mode' => 'yes' ) );

include get_theme_file_path( 'inc/leffat/footer.php' );
