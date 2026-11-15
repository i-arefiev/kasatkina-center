<?php
/**
 * Собственные блоки темы, стили для стандартных блоков и категория паттернов.
 *
 * Все блоки темы — серверные (render.php в папке blocks/<имя>/), поэтому сборка JS не нужна:
 * интерфейс в редакторе описан в assets/js/editor-blocks.js на «чистом» wp.element.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	$editor_js = KASATKINA_DIR . '/assets/js/editor-blocks.js';
	wp_register_script(
		'kasatkina-editor-blocks',
		KASATKINA_URI . '/assets/js/editor-blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-data' ),
		(string) filemtime( $editor_js ),
		true
	);

	// Иконки для блока «Иконка» в редакторе — тот же набор, что и на сайте.
	$icons = array();
	foreach ( kasatkina_icons() as $key => $icon ) {
		$icons[ $key ] = array( 'label' => $icon['label'], 'svg' => kasatkina_icon( $key, 24 ) );
	}
	wp_add_inline_script( 'kasatkina-editor-blocks', 'window.kasatkinaIcons = ' . wp_json_encode( $icons ) . ';', 'before' );

	foreach ( glob( KASATKINA_DIR . '/blocks/*/block.json' ) as $block_json ) {
		register_block_type( dirname( $block_json ) );
	}

	// Стили кнопок — выбираются в боковой панели блока «Кнопка».
	register_block_style( 'core/button', array( 'name' => 'ks-primary', 'label' => 'Зелёная со стрелкой' ) );
	register_block_style( 'core/button', array( 'name' => 'ks-solid', 'label' => 'Зелёная' ) );
	register_block_style( 'core/button', array( 'name' => 'ks-outline', 'label' => 'Контурная' ) );
	register_block_style( 'core/button', array( 'name' => 'ks-video', 'label' => 'Видео (со значком play)' ) );

	// Стили списков.
	register_block_style( 'core/list', array( 'name' => 'ks-checklist', 'label' => 'Галочки в карточках' ) );
	register_block_style( 'core/list', array( 'name' => 'ks-checks', 'label' => 'Галочки' ) );

	// Подписи к фото поверх изображения (галерея «Атмосфера центра»).
	register_block_style( 'core/image', array( 'name' => 'ks-tile', 'label' => 'Плитка с подписью' ) );

	register_block_pattern_category( 'kasatkina', array(
		'label'       => 'Касаткина: блоки сайта',
		'description' => 'Готовые секции сайта центра доктора Касаткиной.',
	) );
	register_block_pattern_category( 'kasatkina-leader', array(
		'label'       => 'Касаткина: страница руководителя',
		'description' => 'Секции для страницы о руководителе центра.',
	) );
}, 9 );

// Своя группа блоков в списке блоков редактора.
add_filter( 'block_categories_all', function ( array $categories ) {
	array_unshift( $categories, array( 'slug' => 'kasatkina', 'title' => 'Касаткина', 'icon' => null ) );
	return $categories;
} );

/**
 * Номер очередной формы на странице: первая — «zapis», дальше «zapis-2», «zapis-3»…
 * Номер стабилен между загрузками страницы, поэтому после отправки можно вернуться к нужной форме.
 */
function kasatkina_next_form_id(): string {
	static $n = 0;
	++$n;
	return 1 === $n ? 'zapis' : 'zapis-' . $n;
}
