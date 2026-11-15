<?php
/**
 * Title: Наши услуги (сетка карточек)
 * Slug: kasatkina/services
 * Categories: kasatkina
 * Keywords: услуги, карточки
 * Description: Заголовок и карточки услуг — карточки берутся из раздела «Услуги».
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
$vid = get_theme_file_uri( 'assets/video/' );
?>
<!-- wp:group {"tagName":"section","anchor":"services","className":"scroll-mt-24 border-t border-line/30 bg-white py-20","layout":{"type":"default"}} -->
<section id="services" class="wp-block-group scroll-mt-24 border-t border-line/30 bg-white py-20">
	<!-- wp:group {"className":"mx-auto max-w-7xl px-6","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto max-w-7xl px-6">
		<!-- wp:group {"className":"grid gap-6 lg:grid-cols-[1fr_1.2fr] lg:items-end lg:gap-10","layout":{"type":"default"}} -->
		<div class="wp-block-group grid gap-6 lg:grid-cols-[1fr_1.2fr] lg:items-end lg:gap-10">
			<!-- wp:group {"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"ks-eyebrow"} -->
				<p class="ks-eyebrow">Услуги</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"className":"mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl"} -->
				<h2 class="wp-block-heading mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Наши услуги</h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
			<!-- wp:paragraph {"className":"m-0 text-base leading-relaxed text-ink/70"} -->
			<p class="m-0 text-base leading-relaxed text-ink/70">В нашем центре Вы можете записаться на процедуры, направленные на лечение и профилактику различных заболеваний: физиотерапевтическое воздействие теплом, электрическим током, магнитными полями, лазером и другими физическими факторами.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"mt-12 grid gap-6 overflow-hidden rounded-3xl border border-line/60 bg-gradient-to-br from-brand-soft via-white to-brand-soft p-8 sm:grid-cols-[1fr_auto] sm:items-center sm:p-12","layout":{"type":"default"}} -->
		<div class="wp-block-group mt-12 grid gap-6 overflow-hidden rounded-3xl border border-line/60 bg-gradient-to-br from-brand-soft via-white to-brand-soft p-8 sm:grid-cols-[1fr_auto] sm:items-center sm:p-12">
			<!-- wp:group {"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"ks-eyebrow text-xs"} -->
				<p class="ks-eyebrow text-xs">Видео о центре</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"mt-2 text-2xl font-bold text-ink sm:text-3xl"} -->
				<p class="mt-2 text-2xl font-bold text-ink sm:text-3xl">Экскурсия по центру доктора Касаткиной</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"mt-3 max-w-lg text-sm text-ink/70"} -->
				<p class="mt-3 max-w-lg text-sm text-ink/70">Познакомьтесь с оборудованием, командой и атмосферой нашего центра.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-ks-play"} -->
				<div class="wp-block-button is-style-ks-play"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $vid ); ?>promo.mp4">Смотреть видео о центре</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
		<!-- wp:kasatkina/services-grid {"className":"mt-10"} /-->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
