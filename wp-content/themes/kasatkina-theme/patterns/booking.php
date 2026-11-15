<?php
/**
 * Title: Форма записи (баннер)
 * Slug: kasatkina/booking
 * Categories: kasatkina
 * Keywords: запись, форма, заявка
 * Description: Карточка «Готовы начать путь к здоровью?» с формой записи.
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
$vid = get_theme_file_uri( 'assets/video/' );
?>
<!-- wp:group {"tagName":"section","anchor":"booking","className":"scroll-mt-24 bg-white py-20","layout":{"type":"default"}} -->
<section id="booking" class="wp-block-group scroll-mt-24 bg-white py-20">
	<!-- wp:group {"className":"mx-auto max-w-6xl px-6","layout":{"type":"default"}} -->
	<div class="wp-block-group mx-auto max-w-6xl px-6">
		<!-- wp:group {"className":"overflow-hidden rounded-3xl border border-line/60 bg-white shadow-sm","layout":{"type":"default"}} -->
		<div class="wp-block-group overflow-hidden rounded-3xl border border-line/60 bg-white shadow-sm">
			<!-- wp:group {"className":"grid lg:grid-cols-[1fr_1.1fr]","layout":{"type":"default"}} -->
			<div class="wp-block-group grid lg:grid-cols-[1fr_1.1fr]">
				<!-- wp:group {"className":"flex flex-col justify-between gap-8 bg-gradient-to-br from-brand-soft/70 via-white to-white p-8 sm:p-10","layout":{"type":"default"}} -->
				<div class="wp-block-group flex flex-col justify-between gap-8 bg-gradient-to-br from-brand-soft/70 via-white to-white p-8 sm:p-10">
					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:group {"className":"ks-badge bg-white","layout":{"type":"default"}} -->
						<div class="wp-block-group ks-badge bg-white">
							<!-- wp:kasatkina/icon {"icon":"calendar","size":14} /-->
							<!-- wp:paragraph {"className":"m-0"} -->
							<p class="m-0">Запись на прием</p>
							<!-- /wp:paragraph -->
						</div>
						<!-- /wp:group -->
						<!-- wp:heading {"className":"mt-5 text-3xl font-extrabold leading-tight tracking-tight text-ink sm:text-4xl"} -->
						<h2 class="wp-block-heading mt-5 text-3xl font-extrabold leading-tight tracking-tight text-ink sm:text-4xl">Готовы начать путь к <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-brand-color">здоровью?</mark></h2>
						<!-- /wp:heading -->
						<!-- wp:paragraph {"className":"mt-4 text-ink/70"} -->
						<p class="mt-4 text-ink/70">Оставьте заявку — администратор свяжется с Вами в течение рабочего дня и поможет подобрать удобное время для консультации.</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
					<!-- wp:kasatkina/license-note /-->
				</div>
				<!-- /wp:group -->
				<!-- wp:group {"className":"border-t border-line/50 p-8 sm:p-10 lg:border-l lg:border-t-0","layout":{"type":"default"}} -->
				<div class="wp-block-group border-t border-line/50 p-8 sm:p-10 lg:border-l lg:border-t-0">
					<!-- wp:kasatkina/booking-form {"variant":"plain","title":"","subtitle":"","buttonText":"Записаться на консультацию"} /-->
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
