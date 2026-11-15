<?php
/**
 * Title: Первый экран «О медцентре»
 * Slug: kasatkina/about-hero
 * Categories: kasatkina
 * Keywords: о центре, hero
 * Description: Хлебные крошки, заголовок страницы и фото центра.
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
?>
<!-- wp:group {"tagName":"section","className":"ks-glow-tr relative overflow-hidden border-b border-line/30 bg-white py-12 lg:py-20","layout":{"type":"default"}} -->
<section class="wp-block-group ks-glow-tr relative overflow-hidden border-b border-line/30 bg-white py-12 lg:py-20">
	<!-- wp:group {"className":"mx-auto max-w-7xl px-6","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto max-w-7xl px-6">
		<!-- wp:kasatkina/breadcrumbs /-->
		<!-- wp:group {"className":"mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]","layout":{"type":"default"}} -->
		<div class="wp-block-group mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]">
			<!-- wp:group {"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"className":"ks-badge","layout":{"type":"default"}} -->
				<div class="wp-block-group ks-badge">
					<!-- wp:kasatkina/icon {"icon":"sparkles","size":14} /-->
					<!-- wp:paragraph {"className":"m-0"} -->
					<p class="m-0">Безопасное восстановление здоровья</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<!-- wp:heading {"level":1,"className":"mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-ink sm:text-5xl lg:text-6xl"} -->
				<h1 class="wp-block-heading mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-ink sm:text-5xl lg:text-6xl">Центр физиолечения и <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-brand-color">психоконсультирования</mark> в Калининграде</h1>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"className":"mt-6 max-w-xl text-lg leading-relaxed text-ink/70"} -->
				<p class="mt-6 max-w-xl text-lg leading-relaxed text-ink/70">Профессиональная физиотерапевтическая помощь и психологическая поддержка в уютной атмосфере без стресса и очередей.</p>
				<!-- /wp:paragraph -->
				<!-- wp:buttons {"className":"mt-8"} -->
				<div class="wp-block-buttons mt-8">
					<!-- wp:button {"className":"is-style-ks-primary"} -->
					<div class="wp-block-button is-style-ks-primary"><a class="wp-block-button__link wp-element-button" href="#booking">Записаться на консультацию</a></div>
					<!-- /wp:button -->
					<!-- wp:button {"className":"is-style-ks-outline"} -->
					<div class="wp-block-button is-style-ks-outline"><a class="wp-block-button__link wp-element-button" href="#mission">О нашей миссии</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"className":"relative","layout":{"type":"default"}} -->
			<div class="wp-block-group relative">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ks-img-fill m-0 h-[420px] overflow-hidden rounded-[2rem] border border-line/60 shadow-xl shadow-brand/10 sm:h-[520px]"} -->
				<figure class="wp-block-image size-full ks-img-fill m-0 h-[420px] overflow-hidden rounded-[2rem] border border-line/60 shadow-xl shadow-brand/10 sm:h-[520px]"><img src="<?php echo esc_url( $img ); ?>center-inside.jpg" alt="Кабинет центра доктора Касаткиной"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"flex items-center gap-3 rounded-2xl border border-line/60 bg-white/95 px-4 py-3 shadow-xl shadow-brand/10 backdrop-blur absolute -left-4 bottom-8 sm:-left-6","layout":{"type":"default"}} -->
				<div class="wp-block-group flex items-center gap-3 rounded-2xl border border-line/60 bg-white/95 px-4 py-3 shadow-xl shadow-brand/10 backdrop-blur absolute -left-4 bottom-8 sm:-left-6">
					<!-- wp:kasatkina/icon {"icon":"badge-check","className":"ks-icon-tile ks-icon-tile\u002d\u002dsm"} /-->
					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"className":"m-0 text-sm font-extrabold leading-tight text-ink"} -->
						<p class="m-0 text-sm font-extrabold leading-tight text-ink">Лицензия Минздрава</p>
						<!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"m-0 mt-1 text-xs text-ink/60"} -->
						<p class="m-0 mt-1 text-xs text-ink/60">с 2023 года</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
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
