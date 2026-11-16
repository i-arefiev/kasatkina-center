<?php
/**
 * Набор иконок темы (Heroicons outline, MIT).
 * Используется блоком «Иконка» (kasatkina/icon), карточками услуг и шаблонами.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Список иконок: ключ => [ 'label' => подпись в редакторе, 'paths' => контуры SVG, 'fill' => заливка вместо обводки ].
 */
function kasatkina_icons(): array {
	return array(
		'sparkles'     => array( 'label' => 'Звёздочки', 'paths' => array( 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z' ) ),
		'lightning'    => array( 'label' => 'Молния (ток)', 'paths' => array( 'M13 10V3L4 14h7v7l9-11h-7z' ) ),
		'light-bulb'   => array( 'label' => 'Лампочка', 'paths' => array( 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z' ) ),
		'sun'          => array( 'label' => 'Солнце (свет)', 'paths' => array( 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z' ) ),
		'heart'        => array( 'label' => 'Сердце', 'paths' => array( 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z' ) ),
		'smile'        => array( 'label' => 'Улыбка', 'paths' => array( 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' ) ),
		'users'        => array( 'label' => 'Люди', 'paths' => array( 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z' ) ),
		'shield-check' => array( 'label' => 'Щит с галочкой', 'paths' => array( 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' ) ),
		'badge-check'  => array( 'label' => 'Печать с галочкой', 'paths' => array( 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' ) ),
		'academic'     => array( 'label' => 'Академическая шапка', 'paths' => array( 'M12 14l9-5-9-5-9 5 9 5z', 'M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z' ) ),
		'document'     => array( 'label' => 'Документ', 'paths' => array( 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' ) ),
		'clipboard'    => array( 'label' => 'Планшет', 'paths' => array( 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' ) ),
		'chip'         => array( 'label' => 'Прибор', 'paths' => array( 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z' ) ),
		'briefcase'    => array( 'label' => 'Чемоданчик', 'paths' => array( 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' ) ),
		'home'         => array( 'label' => 'Дом', 'paths' => array( 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' ) ),
		'office'       => array( 'label' => 'Здание', 'paths' => array( 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4' ) ),
		'pulse'        => array( 'label' => 'Пульс', 'paths' => array( 'M21 12h-4l-3 8-4-16-3 8H3' ) ),
		'clock'        => array( 'label' => 'Часы', 'paths' => array( 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' ) ),
		'calendar'     => array( 'label' => 'Календарь', 'paths' => array( 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' ) ),
		'location'     => array( 'label' => 'Метка на карте', 'paths' => array( 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'M15 11a3 3 0 11-6 0 3 3 0 016 0z' ) ),
		'phone'        => array( 'label' => 'Телефон', 'paths' => array( 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z' ) ),
		'mail'         => array( 'label' => 'Конверт', 'paths' => array( 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' ) ),
		'warning'      => array( 'label' => 'Предупреждение', 'paths' => array( 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z' ) ),
		'check'        => array( 'label' => 'Галочка', 'paths' => array( 'M5 13l4 4L19 7' ) ),
		'arrow-right'  => array( 'label' => 'Стрелка вправо', 'paths' => array( 'M14 5l7 7m0 0l-7 7m7-7H3' ) ),
		'chevron-right'=> array( 'label' => 'Уголок вправо', 'paths' => array( 'M9 5l7 7-7 7' ) ),
		'chevron-down' => array( 'label' => 'Уголок вниз', 'paths' => array( 'M19 9l-7 7-7-7' ) ),
		'play'         => array( 'label' => 'Видео (play)', 'paths' => array( 'M8 5v14l11-7z' ), 'fill' => true ),
		'menu'         => array( 'label' => 'Меню', 'paths' => array( 'M4 6h16M4 12h16M4 18h16' ) ),
		'close'        => array( 'label' => 'Крестик', 'paths' => array( 'M6 18L18 6M6 6l12 12' ) ),
	);
}

/**
 * HTML иконки.
 *
 * @param string $name  Ключ из kasatkina_icons().
 * @param int    $size  Размер в пикселях.
 * @param string $class Дополнительные классы для <svg>.
 */
function kasatkina_icon( string $name, int $size = 24, string $class = '' ): string {
	$icons = kasatkina_icons();
	$icon  = $icons[ $name ] ?? $icons['sparkles'];
	$fill  = ! empty( $icon['fill'] );

	$paths = '';
	foreach ( $icon['paths'] as $d ) {
		$paths .= $fill
			? sprintf( '<path d="%s"/>', esc_attr( $d ) )
			: sprintf( '<path stroke-linecap="round" stroke-linejoin="round" d="%s"/>', esc_attr( $d ) );
	}

	return sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="%3$s" stroke-width="2" class="%4$s" aria-hidden="true" focusable="false">%5$s</svg>',
		$size,
		$fill ? 'currentColor' : 'none',
		$fill ? 'none' : 'currentColor',
		esc_attr( trim( 'shrink-0 ' . $class ) ),
		$paths
	);
}
