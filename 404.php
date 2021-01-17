<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */

get_header();
?>

	<header class="page-header alignwide">
		<h1 class="page-title"><?php esc_html_e( 'აქ არაფერია', 'unico' ); ?></h1>
	</header>

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<p><?php esc_html_e( 'ბმული, რომელზეც თქვენ გადახვედით, არ არსებობს.', 'unico' ); ?></p>
		</div>
	</div>

<?php
get_footer();
