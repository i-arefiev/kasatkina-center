<?php
/**
 * Title: Главный экран (главная)
 * Slug: kasatkina/home-hero
 * Categories: kasatkina
 * Keywords: главный, hero, первый экран
 * Description: Первый экран: заголовок, кнопка записи, цифры и фото врача.
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
$vid = get_theme_file_uri( 'assets/video/' );
?>
<!-- wp:group {"tagName":"section","anchor":"home","className":"ks-glow-tr relative overflow-hidden bg-white","layout":{"type":"default"}} -->
<section id="home" class="wp-block-group ks-glow-tr relative overflow-hidden bg-white">
	<!-- wp:group {"className":"mx-auto grid max-w-7xl items-center gap-10 px-6 pb-12 pt-10 sm:py-16 lg:grid-cols-[1.3fr_1fr] lg:gap-12 lg:py-24","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto grid max-w-7xl items-center gap-10 px-6 pb-12 pt-10 sm:py-16 lg:grid-cols-[1.3fr_1fr] lg:gap-12 lg:py-24">
		<!-- wp:group {"className":"ks-hero-text","layout":{"type":"default"}} -->
		<div class="wp-block-group ks-hero-text">
			<!-- wp:group {"className":"ks-badge","layout":{"type":"default"}} -->
			<div class="wp-block-group ks-badge">
				<!-- wp:kasatkina/icon {"icon":"shield-check","size":14} /-->
				<!-- wp:paragraph {"className":"m-0"} -->
				<p class="m-0">Лицензия Л041‑01157‑39/00638809</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:heading {"level":1,"className":"ks-hero-title mt-6 font-extrabold tracking-tight text-ink"} -->
			<h1 class="wp-block-heading ks-hero-title mt-6 font-extrabold tracking-tight text-ink">Центр физиолечения и <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-brand-color">психоконсультирования</mark> доктора Касаткиной</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"mt-6 max-w-xl text-lg leading-relaxed text-ink/70"} -->
			<p class="mt-6 max-w-xl text-lg leading-relaxed text-ink/70">Поддерживающие процедуры для комплексного безопасного лечения и восстановления организма после болезней и травм.</p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons {"className":"mt-8"} -->
			<div class="wp-block-buttons mt-8">
				<!-- wp:button {"className":"is-style-ks-primary"} -->
				<div class="wp-block-button is-style-ks-primary"><a class="wp-block-button__link wp-element-button" href="#contacts">Записаться на консультацию</a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"is-style-ks-video"} -->
				<div class="wp-block-button is-style-ks-video"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $vid ); ?>promo.mp4">Смотреть видео о центре</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
			<!-- wp:group {"className":"mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-line/50 pt-6","layout":{"type":"default"}} -->
			<div class="wp-block-group mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-line/50 pt-6">
				<!-- wp:group {"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"className":"m-0 text-2xl font-bold text-brand"} -->
					<p class="m-0 text-2xl font-bold text-brand">15+</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"m-0 text-xs text-ink/60"} -->
					<p class="m-0 text-xs text-ink/60">лет опыта</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<!-- wp:group {"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"className":"m-0 text-2xl font-bold text-brand"} -->
					<p class="m-0 text-2xl font-bold text-brand">250+</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"m-0 text-xs text-ink/60"} -->
					<p class="m-0 text-xs text-ink/60">пациентов</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<!-- wp:group {"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"className":"m-0 text-2xl font-bold text-brand"} -->
					<p class="m-0 text-2xl font-bold text-brand">100%</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"m-0 text-xs text-ink/60"} -->
					<p class="m-0 text-xs text-ink/60">инд. подход</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"ks-blob relative mx-auto w-full max-w-[17rem] sm:max-w-sm lg:max-w-lg","layout":{"type":"default"}} -->
		<div class="wp-block-group ks-blob relative mx-auto w-full max-w-[17rem] sm:max-w-sm lg:max-w-lg">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ks-img-contain relative z-10 m-0 drop-shadow-2xl"} -->
			<figure class="wp-block-image size-full ks-img-contain relative z-10 m-0 drop-shadow-2xl"><img src="<?php echo esc_url( $img ); ?>doctor.png" alt="Доктор Наталия Николаевна Касаткина"/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"flex items-center gap-3 rounded-2xl border border-line/60 bg-white/95 px-4 py-3 shadow-xl shadow-brand/10 backdrop-blur absolute -left-4 bottom-6 z-20","layout":{"type":"default"}} -->
			<div class="wp-block-group flex items-center gap-3 rounded-2xl border border-line/60 bg-white/95 px-4 py-3 shadow-xl shadow-brand/10 backdrop-blur absolute -left-4 bottom-6 z-20">
				<!-- wp:kasatkina/icon {"icon":"academic","className":"ks-icon-tile ks-icon-tile\u002d\u002dsm"} /-->
				<!-- wp:group {"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"className":"m-0 text-sm font-extrabold leading-tight text-ink"} -->
					<p class="m-0 text-sm font-extrabold leading-tight text-ink">Индивидуальный подход</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"m-0 mt-1 text-xs text-ink/60"} -->
					<p class="m-0 mt-1 text-xs text-ink/60">к каждому пациенту</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
