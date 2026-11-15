<?php
/**
 * Template Name: Конструктор (страница из блоков)
 * Template Post Type: page
 *
 * Страница целиком собирается из блоков: без автоматического заголовка и полей.
 * Подходит для страниц «О медцентре», «Руководитель» и любых посадочных страниц.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
