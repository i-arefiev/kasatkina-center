<?php
/**
 * Поисковики и аналитика:
 *  — файлы подтверждения прав Яндекс.Вебмастера и Google Search Console (папка verification/);
 *  — Яндекс.Метрика (тот же счётчик, что на старом сайте) и, по желанию, Google Analytics;
 *  — разметка организации schema.org (MedicalClinic) из настроек контактов;
 *  — meta description и Open Graph, если не установлен SEO-плагин (Yoast, Rank Math и т. п.);
 *  — статьи по адресу /articles/<ярлык>/, как на старом сайте.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Настройки раздела «Аналитика и вебмастера».
 */
function kasatkina_seo_fields(): array {
	return array(
		'metrika_id'          => array( 'Номер счётчика Яндекс.Метрики', '94136155', 'text' ),
		'ga_id'               => array( 'Google Analytics 4 (G-XXXXXXX), можно оставить пустым', '', 'text' ),
		'yandex_verification' => array( 'Яндекс.Вебмастер: код из мета-тега yandex-verification (если подтверждали мета-тегом)', '', 'text' ),
		'google_verification' => array( 'Google Search Console: код из мета-тега google-site-verification', '', 'text' ),
		'seo_description'     => array( 'Описание сайта для поисковиков (главная и страницы без отрывка)', 'Центр физиолечения и психоконсультирования доктора Касаткиной в Калининграде: лазеро-, магнито- и электротерапия, психологическая помощь, выезд на дом.', 'textarea' ),
	);
}

/**
 * Файлы подтверждения: /yandex_….html и /google….html отдаются из папки verification/ темы.
 * Так они работают при любой настройке сервера и переезжают вместе с темой.
 */
add_action( 'parse_request', function () {
	$path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );

	// Файлы старого сайта по прежним адресам (выписка из реестра лицензий и т. п.).
	$legacy_files = array( 'public/documents/Doc.pdf' => 'Doc.pdf' );
	if ( isset( $legacy_files[ $path ] ) && is_readable( KASATKINA_DIR . '/data/legacy-files/' . $legacy_files[ $path ] ) ) {
		status_header( 200 );
		header( 'Content-Type: application/pdf' );
		header( 'Content-Disposition: inline; filename="' . $legacy_files[ $path ] . '"' );
		readfile( KASATKINA_DIR . '/data/legacy-files/' . $legacy_files[ $path ] ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		exit;
	}

	if ( ! preg_match( '/^(yandex_[a-f0-9]+|google[a-f0-9]+)\.html$/', $path ) ) {
		return;
	}
	$file = KASATKINA_DIR . '/verification/' . $path;
	if ( is_readable( $file ) ) {
		status_header( 200 );
		header( 'Content-Type: text/html; charset=UTF-8' );
		readfile( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		exit;
	}
}, 0 );

/**
 * Есть ли SEO-плагин, который сам выводит описание и Open Graph.
 */
function kasatkina_has_seo_plugin(): bool {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'AIOSEO_VERSION' ) || defined( 'THE_SEO_FRAMEWORK_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

/**
 * Описание текущей страницы для поисковиков.
 */
function kasatkina_meta_description(): string {
	$text = '';
	if ( is_singular() && ! is_front_page() ) {
		$text = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( strip_shortcodes( (string) get_post_field( 'post_content' ) ) ), 30, '…' );
		if ( 'service' === get_post_type() && get_post_meta( get_the_ID(), '_service_description', true ) && ! has_excerpt() ) {
			$text = wp_trim_words( (string) get_post_meta( get_the_ID(), '_service_description', true ), 30, '…' );
		}
	} elseif ( is_home() && get_option( 'page_for_posts' ) ) {
		$text = get_the_excerpt( (int) get_option( 'page_for_posts' ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$text = wp_strip_all_tags( term_description() );
	}
	$text = trim( preg_replace( '/\s+/u', ' ', (string) $text ) );
	return $text ?: kasatkina_opt( 'seo_description' );
}

add_action( 'wp_head', function () {
	// Коды подтверждения мета-тегами (если используются вместо файлов).
	if ( kasatkina_opt( 'yandex_verification' ) ) {
		printf( '<meta name="yandex-verification" content="%s" />' . "\n", esc_attr( kasatkina_opt( 'yandex_verification' ) ) );
	}
	if ( kasatkina_opt( 'google_verification' ) ) {
		printf( '<meta name="google-site-verification" content="%s" />' . "\n", esc_attr( kasatkina_opt( 'google_verification' ) ) );
	}

	if ( ! kasatkina_has_seo_plugin() ) {
		$description = kasatkina_meta_description();
		$image       = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : ( get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( (int) get_theme_mod( 'custom_logo' ), 'full' ) : '' );
		printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $description ) );
		printf( '<meta property="og:type" content="%s" />' . "\n", is_singular( 'post' ) ? 'article' : 'website' );
		printf( '<meta property="og:title" content="%s" />' . "\n", esc_attr( wp_get_document_title() ) );
		printf( '<meta property="og:description" content="%s" />' . "\n", esc_attr( $description ) );
		printf( '<meta property="og:url" content="%s" />' . "\n", esc_url( is_singular() ? get_permalink() : home_url( add_query_arg( array() ) ) ) );
		printf( '<meta property="og:site_name" content="%s" />' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
		echo '<meta property="og:locale" content="ru_RU" />' . "\n";
		if ( $image ) {
			printf( '<meta property="og:image" content="%s" />' . "\n", esc_url( $image ) );
		}
	}

	// Разметка организации — на главной.
	if ( is_front_page() ) {
		$phones = array_values( array_filter( array( kasatkina_opt( 'phone' ), kasatkina_opt( 'phone2' ) ) ) );
		$data   = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'MedicalClinic',
			'name'        => get_bloginfo( 'name' ),
			'description' => kasatkina_opt( 'seo_description' ),
			'url'         => home_url( '/' ),
			'telephone'   => $phones[0] ?? '',
			'email'       => kasatkina_opt( 'email' ),
			'address'     => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => trim( preg_replace( '/^г\.\s*Калининград,?\s*/u', '', kasatkina_opt( 'address' ) ) ),
				'addressLocality' => 'Калининград',
				'addressCountry'  => 'RU',
			),
		);
		if ( get_theme_mod( 'custom_logo' ) ) {
			$data['logo'] = wp_get_attachment_image_url( (int) get_theme_mod( 'custom_logo' ), 'full' );
		}
		if ( kasatkina_opt( 'hours' ) ) {
			$data['openingHours'] = kasatkina_opt( 'hours' );
		}
		echo '<script type="application/ld+json">' . wp_json_encode( array_filter( $data ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "</script>\n";
	}

	// Счётчики не выводим для вошедших в админку и на локальных копиях сайта (не портим статистику).
	$host     = (string) wp_parse_url( home_url(), PHP_URL_HOST );
	$is_local = in_array( $host, array( 'localhost', '127.0.0.1' ), true ) || preg_match( '/\.(local|test|localhost)$/', $host ) || 'local' === wp_get_environment_type();
	if ( $is_local || is_user_logged_in() ) {
		return;
	}

	// Яндекс.Метрика — настройки как на старом сайте.
	$metrika = preg_replace( '/\D/', '', kasatkina_opt( 'metrika_id' ) );
	if ( $metrika ) {
		?>
<script>(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};m[i].l=1*new Date();for(var j=0;j<document.scripts.length;j++){if(document.scripts[j].src===r){return;}}k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})(window,document,"script","https://mc.yandex.ru/metrika/tag.js","ym");ym(<?php echo (int) $metrika; ?>,"init",{clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true});window.kasatkinaMetrika=<?php echo (int) $metrika; ?>;</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?php echo (int) $metrika; ?>" style="position:absolute;left:-9999px" alt="" /></div></noscript>
		<?php
	}

	$ga = kasatkina_opt( 'ga_id' );
	if ( $ga && preg_match( '/^G-[A-Z0-9]+$/', $ga ) ) {
		printf( '<script async src="https://www.googletagmanager.com/gtag/js?id=%1$s"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag("js",new Date());gtag("config","%1$s");</script>' . "\n", esc_attr( $ga ) );
	}
}, 5 );

/**
 * Статьи: /articles/<ярлык>/ и страница статей /articles/ с постраничной навигацией.
 * WordPress путает /articles/page/2/ со статьёй «page», поэтому добавляем правило явно.
 */
add_action( 'init', function () {
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( $posts_page ) {
		$slug = get_page_uri( $posts_page );
		add_rewrite_rule( '^' . preg_quote( $slug, '/' ) . '/page/([0-9]+)/?$', 'index.php?page_id=' . $posts_page . '&paged=$matches[1]', 'top' );
	}
} );

/**
 * Старые адреса, которых нет на новом сайте, — постоянный редирект (301).
 * Остальные редиректы удобнее вести плагином Redirection (там же журнал 404).
 */
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$path = '/' . trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
	$map  = array(
		'/about/leader' => '/leader/',
		'/smi-o-nas'    => '/#media',
	);
	if ( isset( $map[ $path ] ) ) {
		wp_safe_redirect( home_url( $map[ $path ] ), 301 );
		exit;
	}
	// Страховка: неизвестная услуга или статья со старого сайта — на список, а не на 404.
	if ( preg_match( '#^/services/[^/]+$#', $path ) ) {
		wp_safe_redirect( kasatkina_services_page_url(), 301 );
		exit;
	}
	if ( preg_match( '#^/articles/[^/]+$#', $path ) && ! preg_match( '#^/articles/page$#', $path ) ) {
		wp_safe_redirect( kasatkina_posts_page_url(), 301 );
		exit;
	}
} );
