<?php
/**
 * Title: Атмосфера центра (галерея)
 * Slug: kasatkina/gallery
 * Categories: kasatkina
 * Keywords: галерея, фото
 * Description: Галерея фото с подписями; по клику фото открывается на весь экран.
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
?>
<!-- wp:group {"tagName":"section","anchor":"gallery","className":"scroll-mt-24 bg-surface py-20","layout":{"type":"default"}} -->
<section id="gallery" class="wp-block-group scroll-mt-24 bg-surface py-20">
	<!-- wp:group {"className":"mx-auto max-w-7xl px-6","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto max-w-7xl px-6">
		<!-- wp:group {"className":"max-w-2xl","layout":{"type":"default"}} -->
		<div class="wp-block-group max-w-2xl">
			<!-- wp:paragraph {"className":"ks-eyebrow"} -->
			<p class="ks-eyebrow">Атмосфера центра</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"className":"mt-3 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl lg:text-5xl"} -->
			<h2 class="wp-block-heading mt-3 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl lg:text-5xl">Пространство, в котором приятно лечиться</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"mt-4 text-ink/70"} -->
			<p class="mt-4 text-ink/70">Светлые кабинеты, современное оборудование и располагающая обстановка для консультаций. Нажмите на фото, чтобы увеличить.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"mt-12 grid grid-cols-6 gap-4","layout":{"type":"default"}} -->
		<div class="wp-block-group mt-12 grid grid-cols-6 gap-4">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","lightbox":{"enabled":true},"className":"is-style-ks-tile col-span-6 m-0 h-64 md:col-span-4"} -->
			<figure class="wp-block-image size-full is-style-ks-tile col-span-6 m-0 h-64 md:col-span-4"><img src="<?php echo esc_url( $img ); ?>reception.jpg" alt="Ресепшн центра"/><figcaption class="wp-element-caption">Ресепшн центра</figcaption></figure>
			<!-- /wp:image -->
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","lightbox":{"enabled":true},"className":"is-style-ks-tile col-span-6 m-0 h-64 md:col-span-2"} -->
			<figure class="wp-block-image size-full is-style-ks-tile col-span-6 m-0 h-64 md:col-span-2"><img src="<?php echo esc_url( $img ); ?>procedure.jpg" alt="Процедура в кабинете"/><figcaption class="wp-element-caption">Процедура в кабинете</figcaption></figure>
			<!-- /wp:image -->
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","lightbox":{"enabled":true},"className":"is-style-ks-tile col-span-6 m-0 h-64 md:col-span-2"} -->
			<figure class="wp-block-image size-full is-style-ks-tile col-span-6 m-0 h-64 md:col-span-2"><img src="<?php echo esc_url( $img ); ?>center-inside.jpg" alt="Кабинет физиотерапии"/><figcaption class="wp-element-caption">Кабинет физиотерапии</figcaption></figure>
			<!-- /wp:image -->
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","lightbox":{"enabled":true},"className":"is-style-ks-tile col-span-6 m-0 h-64 md:col-span-4"} -->
			<figure class="wp-block-image size-full is-style-ks-tile col-span-6 m-0 h-64 md:col-span-4"><img src="<?php echo esc_url( $img ); ?>entrance.jpg" alt="Вход в центр"/><figcaption class="wp-element-caption">Вход в центр</figcaption></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
