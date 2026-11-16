<?php
/**
 * Title: Контакты: данные, форма и карта
 * Slug: kasatkina/contacts
 * Categories: kasatkina
 * Keywords: контакты, карта, форма
 * Description: Контактные данные, форма записи и Яндекс.Карта.
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
$vid = get_theme_file_uri( 'assets/video/' );
?>
<!-- wp:group {"tagName":"section","anchor":"contacts","className":"scroll-mt-24 border-t border-line/30 bg-white py-20","layout":{"type":"default"}} -->
<section id="contacts" class="wp-block-group scroll-mt-24 border-t border-line/30 bg-white py-20">
	<!-- wp:group {"className":"mx-auto max-w-7xl px-6","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto max-w-7xl px-6">
		<!-- wp:group {"className":"max-w-2xl","layout":{"type":"default"}} -->
		<div class="wp-block-group max-w-2xl">
			<!-- wp:paragraph {"className":"ks-eyebrow"} -->
			<p class="ks-eyebrow">Контакты</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"className":"mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl"} -->
			<h2 class="wp-block-heading mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Как нас найти</h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"mt-12 grid gap-8 lg:grid-cols-2","layout":{"type":"default"}} -->
		<div class="wp-block-group mt-12 grid gap-8 lg:grid-cols-2">
			<!-- wp:group {"className":"space-y-6","layout":{"type":"default"}} -->
			<div class="wp-block-group space-y-6">
				<!-- wp:kasatkina/contact-info /-->
				<!-- wp:kasatkina/booking-form {"showComment":true} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:kasatkina/map {"height":640,"className":"min-h-full"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
