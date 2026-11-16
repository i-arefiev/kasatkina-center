<?php
/**
 * Общие данные сайта, которые повторяются на многих страницах:
 * адрес, телефоны, почта, лицензия, карта, тексты подвала.
 * Редактируются в «Внешний вид → Настроить → Контакты и общие тексты».
 */

defined( 'ABSPATH' ) || exit;

/**
 * Поля настроек: ключ => [ подпись, значение по умолчанию, тип поля ].
 */
function kasatkina_option_fields(): array {
	return array(
		'address'      => array( 'Адрес', 'г. Калининград, ул. Уральская, д. 20, пом. 4', 'text' ),
		'phone'        => array( 'Основной телефон', '+7 (921) 102-46-86', 'text' ),
		'phone2'       => array( 'Дополнительный телефон (можно оставить пустым)', '+7 (4012) 52-66-99', 'text' ),
		'hours'        => array( 'Часы работы (например: Пн–Пт 9:00–20:00, Сб 10:00–15:00). Пусто — не показывать', '', 'text' ),
		'email'        => array( 'Электронная почта', 'info@kasatkina-center.ru', 'email' ),
		'license'      => array( 'Текст о лицензии (подвал, формы записи)', 'Медицинская лицензия Л041-01157-39/00638809 от 25.01.2023 г. Имеются противопоказания, необходима консультация специалиста.', 'textarea' ),
		'map_url'      => array( 'Ссылка для карты (Яндекс.Карты → Поделиться → Встроить карту → адрес из src="…")', 'https://yandex.ru/map-widget/v1/?ll=20.556%2C54.708&z=15&pt=20.556,54.708,pm2rdm', 'url' ),
		'notify_email' => array( 'Куда отправлять заявки с сайта (если пусто — на почту администратора WordPress)', '', 'email' ),
		'cta_text'     => array( 'Кнопка в шапке: текст', 'Записаться на прием', 'text' ),
		'cta_url'      => array( 'Кнопка в шапке: ссылка', '/#contacts', 'text' ),
		'footer_about' => array( 'Подвал: описание под логотипом', 'Центр физиолечения и психоконсультирования доктора Касаткиной в Калининграде.', 'textarea' ),
		'copyright'    => array( 'Подвал: строка копирайта (год подставляется автоматически)', 'Центр доктора Касаткиной. При использовании материалов ссылка на ресурс kasatkina-center.ru обязательна.', 'textarea' ),
		'author_name'  => array( 'Статьи: автор по умолчанию', 'Наталия Николаевна Касаткина', 'text' ),
		'author_bio'   => array( 'Статьи: текст «Об авторе» (если в профиле пользователя пусто)', 'Врач-физиотерапевт, психолог-консультант. Основатель Центра физиолечения и психоконсультирования в Калининграде.', 'textarea' ),
		'author_url'   => array( 'Статьи: ссылка «Подробнее об авторе»', '/leader/', 'text' ),
	);
}

/**
 * Значение настройки (или значение по умолчанию).
 */
function kasatkina_opt( string $key ): string {
	$fields  = kasatkina_option_fields() + kasatkina_seo_fields() + kasatkina_operator_fields();
	$default = $fields[ $key ][1] ?? '';
	return (string) get_theme_mod( 'ks_' . $key, $default );
}

/**
 * Ссылка tel: из телефона в любом формате.
 */
function kasatkina_tel( string $phone ): string {
	return 'tel:' . preg_replace( '/[^\d+]/', '', $phone );
}

/**
 * Ссылка из настройки: относительные пути («/#contacts») превращаются в полный адрес сайта.
 */
function kasatkina_link( string $url ): string {
	if ( str_starts_with( $url, '/' ) ) {
		return home_url( $url );
	}
	return $url;
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'kasatkina_contacts', array(
		'title'       => 'Контакты и общие тексты',
		'description' => 'Эти данные выводятся сразу в нескольких местах: в шапке, подвале, блоке «Контакты» и формах записи.',
		'priority'    => 30,
	) );

	$wp_customize->add_section( 'kasatkina_seo', array(
		'title'       => 'Аналитика и вебмастера',
		'description' => 'Счётчики и коды подтверждения. Файлы подтверждения Яндекса и Google со старого сайта уже подключены темой (папка verification/).',
		'priority'    => 31,
	) );

	$wp_customize->add_section( 'kasatkina_operator', array(
		'title'       => 'Реквизиты (оператор персональных данных)',
		'description' => 'Выводятся в политике обработки персональных данных, согласии и на странице «Правовая информация». Данные — из реестра операторов Роскомнадзора; пустые поля на сайте не показываются.',
		'priority'    => 32,
	) );

	$all = array_map( fn( $f ) => $f + array( 3 => 'kasatkina_contacts' ), kasatkina_option_fields() )
		+ array_map( fn( $f ) => $f + array( 3 => 'kasatkina_seo' ), kasatkina_seo_fields() )
		+ array_map( fn( $f ) => $f + array( 3 => 'kasatkina_operator' ), kasatkina_operator_fields() );

	foreach ( $all as $key => [ $label, $default, $type, $section ] ) {
		$sanitize = match ( $type ) {
			'email'    => 'sanitize_email',
			'url'      => 'esc_url_raw',
			'textarea' => 'sanitize_textarea_field',
			default    => 'sanitize_text_field',
		};
		$wp_customize->add_setting( 'ks_' . $key, array(
			'default'           => $default,
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( 'ks_' . $key, array(
			'label'   => $label,
			'section' => $section,
			'type'    => $type,
		) );
	}

	// Картинка для превью ссылок в соцсетях (Open Graph).
	$wp_customize->add_setting( 'ks_og_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ks_og_image', array(
		'label'       => 'Картинка для превью ссылки в соцсетях и мессенджерах',
		'description' => 'Размер 1200×630. Показывается, когда ссылку на сайт отправляют в Telegram, VK, WhatsApp и т. п. У статей и услуг с обложкой — их обложка. Пусто — картинка темы по умолчанию.',
		'section'     => 'kasatkina_seo',
		'mime_type'   => 'image',
	) ) );

	// Отдельный логотип для тёмного подвала.
	$wp_customize->add_setting( 'footer_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
		'label'    => 'Логотип для подвала (светлый, PNG)',
		'section'  => 'title_tagline',
		'settings' => 'footer_logo',
	) ) );
} );
