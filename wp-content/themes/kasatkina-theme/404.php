<?php
/**
 * Страница «Не найдено» (404) — на весь экран, без шапки и подвала: «дышащий» ноль — вдох и выдох.
 * Стили, Метрика и иконка сайта подключаются как обычно (wp_head / wp_footer).
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-white text-ink antialiased' ); ?>>
<?php wp_body_open(); ?>
<main id="main" class="ks-err ks-glow-tr">
	<div class="ks-err__wrap">
		<div class="ks-err__code" role="img" aria-label="404">
			<span aria-hidden="true">4</span>
			<span class="ks-err__zero" aria-hidden="true"><span class="ks-err__breath"></span></span>
			<span aria-hidden="true">4</span>
		</div>
		<p class="ks-err__hint" aria-hidden="true">Сделайте вдох… и выдох</p>
		<h1 class="ks-err__title">Страница не найдена</h1>
		<p class="ks-err__text">Похоже, эта страница ушла на процедуры. Возможно, адрес набран с ошибкой — начните с главной или посмотрите наши услуги.</p>
		<div class="ks-err__actions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ks-btn">На главную</a>
			<a href="<?php echo esc_url( kasatkina_services_page_url() ); ?>" class="ks-btn ks-btn--outline">Все услуги</a>
		</div>
	</div>
</main>
<?php wp_footer(); ?>
</body>
</html>
