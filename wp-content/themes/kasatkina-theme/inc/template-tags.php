<?php
/**
 * Вспомогательные функции для шаблонов.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Страница со списком всех услуг (шаблон «Страница всех услуг»), если есть.
 */
function kasatkina_services_page_url(): string {
	$pages = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'meta_key'       => '_wp_page_template',
		'meta_value'     => 'page-services.php',
		'posts_per_page' => 1,
		'fields'         => 'ids',
	) );
	return $pages ? get_permalink( $pages[0] ) : home_url( '/#services' );
}

/**
 * Страница «Статьи» (страница записей) или главная, если не задана.
 */
function kasatkina_posts_page_url(): string {
	$id = (int) get_option( 'page_for_posts' );
	return $id ? get_permalink( $id ) : home_url( '/' );
}

/**
 * Цепочка хлебных крошек для текущей страницы: массив [ 'title' => …, 'url' => … ].
 * Последний элемент — текущая страница (без ссылки).
 */
function kasatkina_breadcrumb_items( ?int $post_id = null ): array {
	$items = array( array( 'title' => 'Главная', 'url' => home_url( '/' ) ) );

	if ( is_front_page() && ! is_page() ) {
		return array( array( 'title' => 'Главная', 'url' => '' ) );
	}
	if ( is_home() ) {
		$posts_page = (int) get_option( 'page_for_posts' );
		$items[]    = array( 'title' => $posts_page ? get_the_title( $posts_page ) : 'Статьи', 'url' => '' );
		return $items;
	}
	if ( is_404() ) {
		$items[] = array( 'title' => 'Страница не найдена', 'url' => '' );
		return $items;
	}
	if ( is_search() ) {
		$items[] = array( 'title' => 'Поиск', 'url' => '' );
		return $items;
	}
	if ( is_archive() && ! $post_id ) {
		$items[] = array( 'title' => wp_strip_all_tags( get_the_archive_title() ), 'url' => '' );
		return $items;
	}

	$post_id = $post_id ?: get_the_ID();
	if ( ! $post_id ) {
		return $items;
	}

	$type = get_post_type( $post_id );
	if ( 'post' === $type && get_option( 'page_for_posts' ) ) {
		$items[] = array( 'title' => get_the_title( (int) get_option( 'page_for_posts' ) ), 'url' => kasatkina_posts_page_url() );
	} elseif ( 'service' === $type ) {
		$items[] = array( 'title' => 'Услуги', 'url' => kasatkina_services_page_url() );
	}

	foreach ( array_reverse( get_post_ancestors( $post_id ) ) as $ancestor ) {
		$items[] = array( 'title' => get_the_title( $ancestor ), 'url' => get_permalink( $ancestor ) );
	}
	$items[] = array( 'title' => get_the_title( $post_id ), 'url' => '' );

	return $items;
}

/**
 * HTML хлебных крошек (с микроразметкой schema.org).
 */
function kasatkina_breadcrumbs( string $class = '', ?int $post_id = null ): string {
	$items = kasatkina_breadcrumb_items( $post_id );
	$html  = '<nav aria-label="Хлебные крошки" class="' . esc_attr( $class ) . '"><ol class="flex flex-wrap items-center gap-2 text-sm text-ink/60" itemscope itemtype="https://schema.org/BreadcrumbList">';
	$last  = count( $items ) - 1;

	foreach ( $items as $i => $item ) {
		$html .= '<li class="flex items-center gap-2" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		if ( $i < $last && $item['url'] ) {
			$html .= '<a href="' . esc_url( $item['url'] ) . '" class="transition hover:text-brand" itemprop="item"><span itemprop="name">' . esc_html( $item['title'] ) . '</span></a>';
		} else {
			$html .= '<span class="font-medium text-ink" aria-current="page" itemprop="name">' . esc_html( $item['title'] ) . '</span>';
		}
		$html .= '<meta itemprop="position" content="' . ( $i + 1 ) . '"/>';
		if ( $i < $last ) {
			$html .= kasatkina_icon( 'chevron-right', 14, 'text-ink/40' );
		}
		$html .= '</li>';
	}

	return $html . '</ol></nav>';
}

/**
 * Инициалы для аватара-заглушки («Наталия Касаткина» → «НК»).
 */
function kasatkina_initials( string $name ): string {
	$words = preg_split( '/\s+/u', trim( $name ) );
	$first = mb_substr( $words[0] ?? '', 0, 1 );
	$last  = count( $words ) > 1 ? mb_substr( end( $words ), 0, 1 ) : '';
	// «Наталия Николаевна Касаткина» → «НК» (имя + фамилия).
	if ( count( $words ) === 3 ) {
		$last = mb_substr( $words[2], 0, 1 );
	}
	return mb_strtoupper( $first . $last );
}

/**
 * Первая буква — строчная, если это не аббревиатура:
 * «Лазеротерапия» → «лазеротерапия», «ПТСР у взрослых» → «ПТСР у взрослых».
 */
function kasatkina_lcfirst( string $text ): string {
	$first_word = strtok( $text, ' ' );
	if ( mb_strlen( $first_word ) > 1 && mb_strtoupper( $first_word ) === $first_word ) {
		return $text;
	}
	return mb_strtolower( mb_substr( $text, 0, 1 ) ) . mb_substr( $text, 1 );
}
