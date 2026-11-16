<?php
/**
 * Страница «Сервер на больничном» (500) — для случаев, когда WordPress сам не может показать страницу.
 *
 * Тема кладёт в wp-content три файла (WordPress ищет их именно там, а не в теме):
 *  — php-error.php — фатальная ошибка PHP (код 500);
 *  — db-error.php  — нет связи с базой данных (код 503, «зайдите через пару минут»);
 *  — 500.html      — та же страница без PHP, для настройки веб-сервера (ErrorDocument / error_page).
 *
 * Файлы самодостаточны: стили встроены, телефон подставляется при создании.
 * Обновляются сами после обновления темы и при сохранении контактов. Чужие файлы с такими
 * именами (без отметки темы) не перезаписываются.
 */

defined( 'ABSPATH' ) || exit;

const KASATKINA_ERROR_MARK = 'kasatkina-theme:error-page';

/**
 * HTML страницы ошибки. Только статичная разметка — без функций WordPress.
 */
function kasatkina_error_page_html(): string {
	$phone      = (string) kasatkina_opt( 'phone' );
	$phone_href = preg_replace( '/[^\d+]/', '', $phone );
	$name       = get_bloginfo( 'name' );

	$e = static fn( $s ) => htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' );

	$phone_btn = $phone ? sprintf( '<a class="btn btn--ghost" href="tel:%s">%s</a>', $e( $phone_href ), $e( $phone ) ) : '';

	return <<<HTML
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>Сервер на больничном — {$e( $name )}</title>
<style>
:root{--brand:#3BC68B;--brand-dark:#2EB078;--ink:#1E293B;--muted:#64748B;--line:#E2E8F0;--bg:#FFFFFF}
*{box-sizing:border-box;margin:0}
body{min-height:100vh;display:grid;place-items:center;padding:4rem 1.5rem;font-family:ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;color:var(--ink);
background:radial-gradient(60% 50% at 85% 0%,rgba(59,198,139,.14),transparent),var(--bg)}
.wrap{max-width:40rem;text-align:center}
.code{font-weight:800;font-size:clamp(6rem,18vw,10rem);line-height:1;color:var(--brand);letter-spacing:-.04em;animation:shiver 3s infinite}
.ecg{display:block;width:100%;max-width:30rem;margin:1rem auto 0}
.ecg path{fill:none;stroke:var(--brand);stroke-width:3;stroke-linejoin:round;stroke-linecap:round;stroke-dasharray:900;stroke-dashoffset:900;animation:ecg 2.6s linear infinite}
h1{margin-top:1.25rem;font-size:clamp(1.75rem,4vw,2.25rem);font-weight:800;letter-spacing:-.02em}
.text{margin-top:1rem;font-size:1.1rem;line-height:1.6;color:var(--muted)}
.actions{margin-top:2rem;display:flex;gap:.75rem;justify-content:center;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;padding:.9rem 1.6rem;border-radius:999px;font:inherit;font-weight:700;font-size:.95rem;text-decoration:none;cursor:pointer;border:0;transition:transform .2s}
.btn:hover{transform:translateY(-2px)}
.btn--primary{background:var(--brand);color:#fff;box-shadow:0 10px 24px -10px rgba(59,198,139,.7)}
.btn--primary:hover{background:var(--brand-dark)}
.btn--ghost{border:1px solid var(--line);color:var(--ink);background:#fff}
@keyframes shiver{0%,90%,100%{transform:none}92%{transform:translateX(-4px) rotate(-1deg)}94%{transform:translateX(4px) rotate(1deg)}96%{transform:translateX(-2px)}}
@keyframes ecg{to{stroke-dashoffset:0}}
@media (prefers-reduced-motion:reduce){.code,.ecg path{animation:none;stroke-dashoffset:0}}
</style>
</head>
<body>
<main>
<div class="wrap">
<div class="code">500</div>
<svg class="ecg" viewBox="0 0 600 80" aria-hidden="true"><path d="M0 40 H200 L220 40 L235 10 L255 70 L270 40 H330 L345 25 L360 55 L372 40 H600"/></svg>
<h1>Сервер на больничном</h1>
<p class="text">Пульс есть, но сайт немного приболел. Мы уже назначили ему лечение — попробуйте обновить страницу через минуту или позвоните нам.</p>
<div class="actions">
<button class="btn btn--primary" type="button" onclick="location.reload()">Обновить страницу</button>
{$phone_btn}
</div>
</div>
</main>
</body>
</html>
HTML;
}

/**
 * Создаёт или обновляет файлы страниц ошибок в wp-content. Возвращает строки для журнала.
 */
function kasatkina_install_error_pages(): array {
	$html  = kasatkina_error_page_html();
	$files = array(
		'php-error.php' => array( 500, '' ),
		'db-error.php'  => array( 503, "header( 'Retry-After: 120' );" ),
		'500.html'      => null,
	);

	$log = array();
	foreach ( $files as $name => $status ) {
		$path = WP_CONTENT_DIR . '/' . $name;
		if ( file_exists( $path ) && ! str_contains( (string) file_get_contents( $path ), KASATKINA_ERROR_MARK ) ) {
			$log[] = sprintf( 'wp-content/%s уже есть и создан не темой — оставлен как есть.', $name );
			continue;
		}

		if ( null === $status ) {
			$body = '<!-- ' . KASATKINA_ERROR_MARK . ' -->' . "\n" . $html;
		} else {
			[ $code, $extra ] = $status;
			$body = "<?php\n// " . KASATKINA_ERROR_MARK . " — создано темой kasatkina-theme, обновляется автоматически.\n"
				. "// Чтобы поставить свою страницу, удалите эту строку с отметкой — тема перестанет трогать файл.\n"
				. "if ( ! headers_sent() ) {\n"
				. "\thttp_response_code( {$code} );\n"
				. "\theader( 'Content-Type: text/html; charset=utf-8' );\n"
				. "\theader( 'Cache-Control: no-store' );\n"
				. ( $extra ? "\t{$extra}\n" : '' )
				. "}\n?>\n" . $html;
		}

		if ( false === @file_put_contents( $path, $body ) ) { // phpcs:ignore WordPress.PHP.NoSilencedErrors, WordPress.WP.AlternativeFunctions
			$log[] = sprintf( 'Не удалось записать wp-content/%s — нет прав на запись.', $name );
			continue;
		}
		$log[] = sprintf( 'Страница ошибки wp-content/%s — обновлена.', $name );
	}

	update_option( 'kasatkina_error_pages', KASATKINA_VERSION, false );
	return $log;
}

// После обновления темы — пересоздать (в файлах могли поменяться тексты или стили).
add_action( 'admin_init', function () {
	if ( get_option( 'kasatkina_error_pages' ) !== KASATKINA_VERSION && current_user_can( 'edit_theme_options' ) ) {
		kasatkina_install_error_pages();
	}
} );

// Поменяли телефон — страница ошибки должна это показывать.
add_action( 'customize_save_after', function () {
	kasatkina_install_error_pages();
} );
add_action( 'after_switch_theme', function () {
	kasatkina_install_error_pages();
} );
