<?php
/**
 * Страница «Не найдено».
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<section class="ks-glow-tr relative overflow-hidden">
		<div class="mx-auto flex max-w-3xl flex-col items-center px-6 py-24 text-center lg:py-32">
			<div class="text-7xl font-extrabold text-brand sm:text-8xl">404</div>
			<h1 class="mt-6 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Страница не найдена</h1>
			<p class="mt-4 max-w-xl text-lg leading-relaxed text-ink/70">Возможно, страница была перемещена или адрес набран с ошибкой. Начните с главной или посмотрите наши услуги.</p>
			<div class="mt-8 flex flex-wrap justify-center gap-3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ks-btn">На главную</a>
				<a href="<?php echo esc_url( kasatkina_services_page_url() ); ?>" class="ks-btn ks-btn--outline">Все услуги</a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
