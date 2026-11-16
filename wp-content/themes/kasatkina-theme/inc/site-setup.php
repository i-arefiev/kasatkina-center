<?php
/**
 * «Внешний вид → Настройка сайта»: первичное наполнение сайта.
 *
 * — переносит картинки темы в медиатеку (чтобы их было видно и можно было заменить);
 * — создаёт страницы и собирает их из паттернов темы;
 * — назначает главную страницу и страницу статей, создаёт меню.
 *
 * Существующие страницы перезаписываются только если поставить галочку,
 * при этом прежний вариант остаётся в «Редакциях» страницы.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Страницы сайта и паттерны, из которых они собираются.
 */
function kasatkina_site_pages(): array {
	return array(
		'home'     => array(
			'title'    => 'Главная',
			'path'     => 'glavnaya',
			'template' => '',
			'front'    => true,
			'patterns' => array( 'kasatkina/home-hero', 'kasatkina/services', 'kasatkina/indications', 'kasatkina/about', 'kasatkina/house-calls', 'kasatkina/media', 'kasatkina/contacts' ),
		),
		'about'    => array(
			'title'    => 'О медцентре',
			'path'     => 'about',
			'template' => 'template-builder.php',
			'patterns' => array( 'kasatkina/about-hero', 'kasatkina/mission', 'kasatkina/approach', 'kasatkina/equipment', 'kasatkina/licenses', 'kasatkina/gallery', 'kasatkina/booking' ),
		),
		'leader'   => array(
			'title'    => 'Наталия Николаевна Касаткина',
			'path'     => 'leader',
			'legacy'   => 'about/leader', // так страница называлась в бета-версии — переносим на /leader/, как на старом сайте
			'template' => 'template-builder.php',
			'patterns' => array( 'kasatkina/leader-hero', 'kasatkina/leader-education', 'kasatkina/leader-diplomas', 'kasatkina/leader-approach', 'kasatkina/leader-specialization', 'kasatkina/booking' ),
		),
		'services' => array(
			'title'    => 'Услуги',
			'path'     => 'services',
			'template' => 'page-services.php',
			'excerpt'  => 'Современные физиотерапевтические методики и психологическая помощь, подобранные индивидуально под ваш диагноз, возраст и цели восстановления.',
			'content'  => "<!-- wp:paragraph -->\n<p>В Центре физиолечения и психоконсультирования доктора Касаткиной мы применяем современные физиотерапевтические методики, которые помогают организму восстановиться после болезней, травм и операций. Каждая процедура подбирается индивидуально, с учётом диагноза, возраста и общего состояния пациента.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Мы не используем универсальные протоколы: сначала врач проводит консультацию, оценивает показания и только после этого составляет персональный курс лечения. Такой подход позволяет достичь устойчивого результата при минимальной нагрузке на организм.</p>\n<!-- /wp:paragraph -->",
		),
		'privacy'  => array(
			'title'    => 'Политика обработки персональных данных',
			'path'     => 'privacy-policy',
			'template' => '',
			'patterns' => array( 'kasatkina/legal-privacy' ),
		),
		'consent'  => array(
			'title'    => 'Согласие на обработку персональных данных',
			'path'     => 'soglasie',
			'template' => '',
			'patterns' => array( 'kasatkina/legal-consent' ),
		),
		'legal'    => array(
			'title'    => 'Правовая информация',
			'path'     => 'pravovaya-informaciya',
			'template' => '',
			'patterns' => array( 'kasatkina/legal-info' ),
		),
		'articles' => array(
			'title'      => 'Статьи',
			'path'       => 'articles',
			'template'   => '',
			'posts_page' => true,
			'excerpt'    => 'Материалы о здоровье, физиотерапии, методах восстановления и психологической поддержке от специалистов нашего центра.',
			'content'    => '',
		),
	);
}

// Пока мастер не запускали — напоминание на всех страницах админки.
add_action( 'admin_notices', function () {
	if ( get_option( 'kasatkina_setup_done' ) || ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_kasatkina-setup' === $screen->id ) {
		return;
	}
	printf(
		'<div class="notice notice-warning"><p><strong>Тема «Центр доктора Касаткиной» установлена, но сайт ещё не настроен.</strong> Откройте <a href="%s">Внешний вид → Настройка сайта</a> и нажмите «Выполнить» — будут созданы страницы, меню, логотипы и перенесены статьи.</p></div>',
		esc_url( admin_url( 'themes.php?page=kasatkina-setup' ) )
	);
} );

add_action( 'admin_menu', function () {
	add_theme_page( 'Настройка сайта', 'Настройка сайта', 'edit_theme_options', 'kasatkina-setup', 'kasatkina_render_setup_page' );
} );

/**
 * Перенос картинок темы в медиатеку. Возвращает карту «адрес в теме» => «адрес в медиатеке».
 */
function kasatkina_import_theme_images(): array {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$imported = get_option( 'kasatkina_imported_images', array() );
	$map      = array();

	foreach ( array( 'images' => '', 'video' => 'video/' ) as $dir => $prefix ) {
	$base  = KASATKINA_DIR . '/assets/' . $dir . '/';
	if ( ! is_dir( $base ) ) {
		continue;
	}
	$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $base, FilesystemIterator::SKIP_DOTS ) );
	foreach ( $files as $file ) {
		$rel = $prefix . str_replace( $base, '', $file->getPathname() );
		if ( ! preg_match( '/\.(png|jpe?g|webp|svg|mp4|webm|pdf)$/i', $rel ) ) {
			continue;
		}

		$id = (int) ( $imported[ $rel ] ?? 0 );
		if ( ! $id || ! get_post( $id ) ) {
			$tmp = wp_tempnam( basename( $rel ) );
			copy( $file->getPathname(), $tmp );
			$id = media_handle_sideload( array( 'name' => basename( $rel ), 'tmp_name' => $tmp ), 0 );
			if ( is_wp_error( $id ) ) {
				@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
				continue;
			}
			$imported[ $rel ] = $id;
		}
		$map[ KASATKINA_URI . '/assets/' . ( $prefix ? $dir . '/' . substr( $rel, strlen( $prefix ) ) : 'images/' . $rel ) ] = wp_get_attachment_url( $id );
	}
	}

	update_option( 'kasatkina_imported_images', $imported, false );
	return $map;
}

/**
 * Разметка страницы из паттернов темы.
 */
function kasatkina_build_content( array $patterns, array $image_map ): string {
	$registry = WP_Block_Patterns_Registry::get_instance();
	$parts    = array();
	foreach ( $patterns as $name ) {
		$pattern = $registry->get_registered( $name );
		if ( $pattern ) {
			$parts[] = trim( $pattern['content'] );
			continue;
		}
		// WordPress кэширует список паттернов темы по номеру версии: новый файл может быть ещё
		// не зарегистрирован. Тогда берём разметку прямо из файла паттерна.
		$file = KASATKINA_DIR . '/patterns/' . str_replace( 'kasatkina/', '', $name ) . '.php';
		if ( is_readable( $file ) ) {
			ob_start();
			include $file;
			$parts[] = trim( (string) ob_get_clean() );
		}
	}
	return strtr( implode( "\n\n", $parts ), $image_map );
}

/**
 * Выполнение настройки. Возвращает список строк-отчёта.
 */
function kasatkina_run_site_setup( array $opts ): array {
	$log       = array();
	$image_map = array();

	if ( ! empty( $opts['images'] ) ) {
		$image_map = kasatkina_import_theme_images();
		$log[]     = 'Картинки темы в медиатеке: ' . count( $image_map ) . ' шт.';

		// Логотипы — только если ещё не заданы (не перетираем выбранные администратором).
		$imported = get_option( 'kasatkina_imported_images', array() );
		if ( ! get_theme_mod( 'custom_logo' ) && ! empty( $imported['logo.png'] ) ) {
			set_theme_mod( 'custom_logo', (int) $imported['logo.png'] );
			$log[] = 'Логотип в шапке установлен.';
		}
		if ( ! get_theme_mod( 'footer_logo' ) && ! empty( $imported['logo-white.png'] ) ) {
			set_theme_mod( 'footer_logo', wp_get_attachment_url( (int) $imported['logo-white.png'] ) );
			$log[] = 'Светлый логотип в подвале установлен.';
		}
		if ( ! get_option( 'site_icon' ) && ! empty( $imported['site-icon.png'] ) ) {
			update_option( 'site_icon', (int) $imported['site-icon.png'] );
			$log[] = 'Иконка сайта (favicon) установлена — как на старом сайте.';
		}
	}

	// Чистая установка: стандартные «Привет, мир!» и «Пример страницы» — в корзину.
	if ( ! empty( $opts['pages'] ) ) {
		foreach ( array( 1 => array( 'Привет, мир!', 'Hello world!' ), 2 => array( 'Пример страницы', 'Sample Page' ) ) as $default_id => $titles ) {
			$default = get_post( $default_id );
			if ( $default && 'trash' !== $default->post_status && in_array( $default->post_title, $titles, true ) && $default->post_date === $default->post_modified ) {
				wp_trash_post( $default_id );
				$log[] = sprintf( '«%s» (стандартная запись WordPress) — в корзине.', $default->post_title );
			}
		}
	}

	$ids = array();
	foreach ( kasatkina_site_pages() as $key => $page ) {
		$existing = null;
		if ( ! empty( $page['front'] ) && get_option( 'page_on_front' ) ) {
			$existing = get_post( (int) get_option( 'page_on_front' ) );
		}
		$existing = $existing ?: get_page_by_path( $page['path'] );

		// Политика: черновик «Политика конфиденциальности», который WordPress создаёт сам при установке,
		// заменяется нашим текстом (он не опубликован и не редактировался — терять нечего).
		$replace_draft = false;
		if ( 'privacy' === $key ) {
			$candidate = $existing ?: get_post( (int) get_option( 'wp_page_for_privacy_policy' ) );
			if ( $candidate && 'page' === $candidate->post_type && 'draft' === $candidate->post_status ) {
				$existing      = $candidate;
				$replace_draft = true;
			}
		}

		// Страница из бета-версии по старому адресу — переносим на новый.
		if ( ! $existing && ! empty( $page['legacy'] ) ) {
			$legacy = get_page_by_path( $page['legacy'] );
			if ( $legacy ) {
				wp_update_post( array( 'ID' => $legacy->ID, 'post_parent' => 0, 'post_name' => basename( $page['path'] ) ) );
				$existing = get_post( $legacy->ID );
				$log[]    = sprintf( '«%s» — перенесена с /%s/ на /%s/.', $legacy->post_title, $page['legacy'], $page['path'] );
			}
		}

		$content = isset( $page['patterns'] ) ? kasatkina_build_content( $page['patterns'], $image_map ) : ( $page['content'] ?? '' );
		$data    = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $page['title'],
			'post_name'    => basename( $page['path'] ),
			'post_content' => $content,
			'post_excerpt' => $page['excerpt'] ?? '',
			'post_parent'  => isset( $page['parent'] ) ? (int) ( $ids[ $page['parent'] ] ?? 0 ) : 0,
		);

		if ( $existing ) {
			$ids[ $key ] = $existing->ID;
			// Пустая страница (например, созданная раньше без текста) заполняется и без перезаписи.
			$replace_draft = $replace_draft || ( '' === trim( $existing->post_content ) && '' !== trim( $content ) );
			if ( ! empty( $opts['overwrite'] ) || $replace_draft ) {
				// Явно сохраняем текущее содержимое в «Редакции» — WordPress сам этого не делает,
				// если у страницы ещё не было ни одной редакции.
				_wp_put_post_revision( $existing );
				$data['ID'] = $existing->ID;
				if ( ! $replace_draft ) {
					$data['post_title'] = $existing->post_title;
					$data['post_name']  = $existing->post_name;
				}
				wp_update_post( wp_slash( $data ) );
				$log[] = sprintf( '«%s» — содержимое обновлено (прежнее сохранено в «Редакциях»).', $existing->post_title );
			} else {
				$log[] = sprintf( '«%s» — уже есть, не изменялась.', $existing->post_title );
			}
		} elseif ( ! empty( $opts['pages'] ) ) {
			$ids[ $key ] = wp_insert_post( wp_slash( $data ) );
			$log[]       = sprintf( '«%s» — создана.', $page['title'] );
		}

		if ( ! empty( $ids[ $key ] ) && ( ! $existing || ! empty( $opts['overwrite'] ) || $replace_draft ) ) {
			update_post_meta( $ids[ $key ], '_wp_page_template', $page['template'] ?: 'default' );
		}
		if ( 'privacy' === $key && ! empty( $ids[ $key ] ) ) {
			update_option( 'wp_page_for_privacy_policy', (int) $ids[ $key ] );
		}
	}

	if ( ! empty( $opts['reading'] ) ) {
		if ( ! empty( $ids['home'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $ids['home'] );
		}
		if ( ! empty( $ids['articles'] ) ) {
			update_option( 'page_for_posts', $ids['articles'] );
		}
		// Статьи — по адресу /articles/<ярлык>/, как на старом сайте.
		// set_permalink_structure() обновляет и настройку, и правила в памяти — иначе flush пересоберёт старые.
		global $wp_rewrite;
		if ( in_array( get_option( 'permalink_structure' ), array( '', '/%postname%/' ), true ) ) {
			$wp_rewrite->set_permalink_structure( '/articles/%postname%/' );
		}
		flush_rewrite_rules();
		$log[] = 'Главная страница, страница статей и постоянные ссылки (/articles/…/) настроены.';
	}

	if ( ! empty( $opts['menu'] ) ) {
		$locations = get_theme_mod( 'nav_menu_locations', array() );
		if ( empty( $locations['primary'] ) || ! wp_get_nav_menu_object( $locations['primary'] ) ) {
			$menu_id = wp_create_nav_menu( 'Главное меню' );
			if ( is_wp_error( $menu_id ) ) {
				$menu_id = wp_get_nav_menu_object( 'Главное меню' )->term_id;
			}
			$position = 0;
			foreach ( array( 'home', 'about', 'services', 'articles' ) as $key ) {
				if ( ! empty( $ids[ $key ] ) ) {
					wp_update_nav_menu_item( $menu_id, 0, array(
						'menu-item-title'     => 'home' === $key ? 'Главная' : get_the_title( $ids[ $key ] ),
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ids[ $key ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => ++$position,
					) );
				}
			}
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'    => 'Контакты',
				'menu-item-url'      => home_url( '/#contacts' ),
				'menu-item-type'     => 'custom',
				'menu-item-status'   => 'publish',
				'menu-item-position' => ++$position,
			) );
			$locations['primary'] = $menu_id;
			$locations['footer']  = $locations['footer'] ?? $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
			$log[] = 'Создано «Главное меню» (шапка и подвал).';
		} else {
			$log[] = 'Меню уже назначено — не изменялось.';
		}
	}

	if ( ! empty( $opts['services'] ) ) {
		$log = array_merge( $log, kasatkina_create_services() );
	}

	if ( ! empty( $opts['legacy'] ) ) {
		$log = array_merge( $log, kasatkina_apply_legacy() );
	}

	if ( ! empty( $opts['pages'] ) || ! empty( $opts['reading'] ) ) {
		update_option( 'kasatkina_setup_done', time(), false );
	}

	return $log;
}

/**
 * Услуги из data/services.json: создаются только те, которых ещё нет (по ярлыку, в любом статусе,
 * включая корзину), — уже существующие услуги не изменяются. Ярлыки совпадают со старым сайтом.
 */
function kasatkina_create_services(): array {
	$file = KASATKINA_DIR . '/data/services.json';
	$data = is_readable( $file ) ? json_decode( (string) file_get_contents( $file ), true ) : null;
	if ( ! is_array( $data ) ) {
		return array( 'Файл data/services.json не найден — услуги не созданы.' );
	}

	$terms = array();
	foreach ( $data['categories'] ?? array() as $slug => $name ) {
		$term = get_term_by( 'slug', $slug, 'service_category' ) ?: get_term_by( 'name', $name, 'service_category' );
		if ( ! $term ) {
			$created = wp_insert_term( $name, 'service_category', array( 'slug' => $slug ) );
			$term    = is_wp_error( $created ) ? null : get_term( $created['term_id'], 'service_category' );
		}
		if ( $term ) {
			$terms[ $slug ] = (int) $term->term_id;
		}
	}

	$log     = array();
	$created = 0;
	foreach ( $data['services'] ?? array() as $order => $item ) {
		$exists = get_posts( array(
			'post_type'      => 'service',
			'name'           => $item['slug'],
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		) ) ?: get_posts( array(
			'post_type'      => 'service',
			'name'           => $item['slug'] . '__trashed',
			'post_status'    => 'trash',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		) );
		if ( $exists ) {
			continue;
		}

		$meta = array( '_service_icon' => $item['icon'] ?? 'sparkles' );
		foreach ( array( 'price', 'duration', 'course', 'pain', 'description', 'advantages', 'indications', 'contraindications', 'faq' ) as $field ) {
			if ( isset( $item[ $field ] ) && '' !== $item[ $field ] ) {
				$meta[ '_service_' . $field ] = $item[ $field ];
			}
		}

		$id = wp_insert_post( wp_slash( array(
			'post_type'    => 'service',
			'post_status'  => 'publish',
			'post_title'   => $item['title'],
			'post_name'    => $item['slug'],
			'post_excerpt' => $item['excerpt'] ?? '',
			'menu_order'   => $order,
			'meta_input'   => $meta,
		) ), true );
		if ( is_wp_error( $id ) ) {
			$log[] = sprintf( 'Услуга «%s» не создана: %s', $item['title'], $id->get_error_message() );
			continue;
		}
		if ( isset( $terms[ $item['category'] ?? '' ] ) ) {
			wp_set_object_terms( $id, $terms[ $item['category'] ], 'service_category' );
		}
		++$created;
	}

	$log[] = $created
		? sprintf( 'Создано услуг: %d. Проверьте тексты и впишите цены в «Услуги → (услуга) → Данные услуги».', $created )
		: 'Услуги уже есть — новые не создавались.';
	return $log;
}

/**
 * Перенос со старого сайта (data/legacy.json):
 *  — статьи: создаются с теми же ярлыками, текстом, отрывком и обложкой (если такой статьи ещё нет);
 *  — услуги: ярлык найденной услуги меняется на старый (lazeroterapiya и т. п.), чтобы адреса
 *    /services/<ярлык>/ совпали со старыми. Прежний ярлык WordPress запоминает и сам перенаправляет.
 */
function kasatkina_apply_legacy(): array {
	$file = KASATKINA_DIR . '/data/legacy.json';
	if ( ! is_readable( $file ) ) {
		return array( 'Файл data/legacy.json не найден — перенос со старого сайта пропущен.' );
	}
	$data = json_decode( (string) file_get_contents( $file ), true );
	$log  = array();

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	foreach ( $data['articles'] ?? array() as $article ) {
		$existing = get_posts( array( 'post_type' => 'post', 'name' => $article['slug'], 'post_status' => 'any', 'posts_per_page' => 1 ) );
		if ( ! $existing ) {
			$existing = get_posts( array( 'post_type' => 'post', 'title' => $article['title'], 'post_status' => 'any', 'posts_per_page' => 1 ) );
			if ( $existing ) {
				wp_update_post( array( 'ID' => $existing[0]->ID, 'post_name' => $article['slug'] ) );
				$log[] = sprintf( 'Статья «%s» уже была — ярлык изменён на %s.', $article['title'], $article['slug'] );
				continue;
			}
		} else {
			$log[] = sprintf( 'Статья «%s» уже есть.', $article['title'] );
			continue;
		}

		$post_id = wp_insert_post( wp_slash( array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_title'   => $article['title'],
			'post_name'    => $article['slug'],
			'post_excerpt' => $article['excerpt'],
			'post_content' => $article['content'],
			'post_date'    => $article['date'],
		) ) );
		$cover = KASATKINA_DIR . '/data/legacy-articles/' . $article['cover'];
		if ( $post_id && ! is_wp_error( $post_id ) && is_readable( $cover ) ) {
			$tmp = wp_tempnam( $article['cover'] );
			copy( $cover, $tmp );
			$thumb = media_handle_sideload( array( 'name' => $article['cover'], 'tmp_name' => $tmp ), $post_id, $article['title'] );
			if ( ! is_wp_error( $thumb ) ) {
				set_post_thumbnail( $post_id, $thumb );
			}
		}
		$log[] = sprintf( 'Статья «%s» перенесена (/articles/%s/).', $article['title'], $article['slug'] );
	}

	$services = get_posts( array( 'post_type' => 'service', 'post_status' => 'any', 'posts_per_page' => -1 ) );
	$used     = array();
	foreach ( $data['services'] ?? array() as $legacy ) {
		$match = null;
		foreach ( $services as $service ) {
			if ( $service->post_name === $legacy['slug'] ) {
				$match = $service;
				break;
			}
		}
		if ( ! $match ) {
			foreach ( $services as $service ) {
				$title = mb_strtolower( $service->post_title );
				foreach ( $legacy['match'] as $needle ) {
					if ( ! isset( $used[ $service->ID ] ) && str_contains( $title, $needle ) ) {
						$match = $service;
						break 2;
					}
				}
			}
		}
		if ( ! $match ) {
			$log[] = sprintf( 'Услуга «%s» не найдена — /services/%s/ будет вести на список услуг. Создайте услугу с ярлыком %2$s, если нужна отдельная страница.', $legacy['title'], $legacy['slug'] );
			continue;
		}
		$used[ $match->ID ] = true;
		if ( $match->post_name !== $legacy['slug'] ) {
			wp_update_post( array( 'ID' => $match->ID, 'post_name' => $legacy['slug'] ) );
			$log[] = sprintf( 'Услуга «%s» — адрес /services/%s/, как на старом сайте.', $match->post_title, $legacy['slug'] );
		} else {
			$log[] = sprintf( 'Услуга «%s» — адрес уже совпадает со старым.', $match->post_title );
		}
	}

	return $log;
}

function kasatkina_render_setup_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$log = array();
	if ( isset( $_POST['kasatkina_setup'] ) && check_admin_referer( 'kasatkina_setup' ) ) {
		$log = kasatkina_run_site_setup( array(
			'images'    => ! empty( $_POST['images'] ),
			'pages'     => ! empty( $_POST['pages'] ),
			'overwrite' => ! empty( $_POST['overwrite'] ),
			'reading'   => ! empty( $_POST['reading'] ),
			'menu'      => ! empty( $_POST['menu'] ),
			'services'  => ! empty( $_POST['services'] ),
			'legacy'    => ! empty( $_POST['legacy'] ),
		) );
	}
	?>
	<div class="wrap">
		<h1>Настройка сайта</h1>
		<p style="max-width:720px">Создаёт основные страницы сайта из готовых блоков темы. Запускать нужно один раз — после этого всё редактируется как обычно: тексты и картинки прямо на странице, контакты — в «Внешний вид → Настроить → Контакты и общие тексты».</p>

		<?php if ( $log ) : ?>
			<div class="notice notice-success"><p><strong>Готово:</strong></p><ul style="list-style:disc;padding-left:20px">
				<?php foreach ( $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul></div>
		<?php endif; ?>

		<form method="post">
			<?php wp_nonce_field( 'kasatkina_setup' ); ?>
			<table class="form-table" role="presentation"><tbody>
				<tr><th>Страницы</th><td>
					<?php foreach ( kasatkina_site_pages() as $page ) : ?>
						<div>• <?php echo esc_html( $page['title'] ); ?> <code>/<?php echo esc_html( $page['path'] ); ?>/</code></div>
					<?php endforeach; ?>
				</td></tr>
				<tr><th>Что сделать</th><td>
					<label><input type="checkbox" name="images" value="1" checked> Перенести картинки темы в медиатеку</label><br>
					<label><input type="checkbox" name="pages" value="1" checked> Создать недостающие страницы</label><br>
					<label><input type="checkbox" name="reading" value="1" checked> Назначить главную страницу и страницу статей</label><br>
					<label><input type="checkbox" name="menu" value="1" checked> Создать меню, если оно ещё не назначено</label><br>
					<label><input type="checkbox" name="services" value="1" checked> Создать услуги центра, которых ещё нет (7 услуг старого сайта; существующие не изменяются)</label><br>
					<label><input type="checkbox" name="legacy" value="1" checked> Перенести статьи со старого сайта и сделать адреса услуг как на старом сайте</label><br><br>
					<label><input type="checkbox" name="overwrite" value="1"> <strong>Перезаписать содержимое уже существующих страниц</strong></label>
					<p class="description">Нужно при переходе с бета-версии темы. Прежнее содержимое не пропадёт — его можно вернуть через «Редакции» в редакторе страницы.</p>
				</td></tr>
			</tbody></table>
			<?php submit_button( 'Выполнить', 'primary', 'kasatkina_setup' ); ?>
		</form>
	</div>
	<?php
}
