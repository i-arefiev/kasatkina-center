<?php
/**
 * Базовая настройка темы: поддержка возможностей, меню, стили и скрипты.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Стили сайта подключаются и в редакторе — блоки выглядят так же, как на сайте.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );

	// Встроенные паттерны WordPress не нужны — в библиотеке остаются только блоки сайта.
	remove_theme_support( 'core-block-patterns' );

	register_nav_menus( array(
		'primary' => 'Главное меню (шапка)',
		'footer'  => 'Меню в подвале',
	) );
} );

// У страниц включаем «Отрывок» — он выводится подзаголовком на страницах «Услуги» и «Статьи».
add_action( 'init', function () {
	add_post_type_support( 'page', 'excerpt' );
} );

add_action( 'wp_enqueue_scripts', function () {
	$css = KASATKINA_DIR . '/assets/css/main.css';
	$js  = KASATKINA_DIR . '/assets/js/main.js';

	wp_enqueue_style( 'kasatkina-main', KASATKINA_URI . '/assets/css/main.css', array(), (string) filemtime( $css ) );
	wp_enqueue_script( 'kasatkina-main', KASATKINA_URI . '/assets/js/main.js', array(), (string) filemtime( $js ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 20 );

/**
 * Классы для пунктов меню: в wp_nav_menu() передаём li_class и link_class.
 */
add_filter( 'nav_menu_css_class', function ( $classes, $item, $args ) {
	if ( ! empty( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}
	return $classes;
}, 10, 3 );

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
	if ( ! empty( $args->link_class ) ) {
		$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' ' . $args->link_class );
	}
	return $atts;
}, 10, 3 );

/**
 * Окно для видео. Открывается кнопкой со стилем «Видео» (или любой ссылкой с классом ks-video-link),
 * если ссылка ведёт на файл .mp4/.webm, YouTube, Rutube или VK Видео.
 */
add_action( 'wp_footer', function () {
	?>
	<dialog id="ks-video-modal" class="ks-video-modal" aria-label="Видео">
		<button type="button" class="ks-video-modal__close" data-ks-video-close aria-label="Закрыть видео"><?php echo kasatkina_icon( 'close', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
		<div class="ks-video-modal__frame" data-ks-video-frame></div>
	</dialog>
	<?php
} );

// Отрывок покороче и без «[...]».
add_filter( 'excerpt_length', fn() => 24 );
add_filter( 'excerpt_more', fn() => '…' );
