<?php
/**
 * Главная страница: целиком собирается из блоков в редакторе.
 * Если в «Настройки → Чтение» главной назначен список записей — выводится home.php.
 */

defined( 'ABSPATH' ) || exit;

if ( 'posts' === get_option( 'show_on_front' ) ) {
	require get_home_template();
	return;
}

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
