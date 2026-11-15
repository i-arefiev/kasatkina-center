<?php
/**
 * Секция «Запись на консультацию» для шаблонов (страница услуг, страница услуги, статьи).
 * Использует те же блоки, что и паттерн «Форма записи», поэтому оформление совпадает.
 *
 * @var array $args [ 'title' => заголовок формы ]
 */

defined( 'ABSPATH' ) || exit;

$form_title = $args['title'] ?? 'Записаться на прием';
?>
<section id="booking" class="scroll-mt-24 border-t border-line/30 bg-white py-20">
	<div class="mx-auto max-w-7xl px-6">
		<div class="max-w-2xl">
			<p class="ks-eyebrow">Запись</p>
			<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Запишитесь на консультацию</h2>
			<p class="mt-4 text-ink/70">Оставьте заявку — мы свяжемся с вами в течение рабочего дня, ответим на вопросы и подберём удобное время.</p>
		</div>
		<div class="mt-12 grid gap-8 lg:grid-cols-2">
			<div class="space-y-6">
				<?php
				echo do_blocks( '<!-- wp:kasatkina/contact-info /--><!-- wp:kasatkina/license-note /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput
				?>
			</div>
			<?php
			echo do_blocks( sprintf( // phpcs:ignore WordPress.Security.EscapeOutput
				'<!-- wp:kasatkina/booking-form %s /-->',
				wp_json_encode( array( 'title' => $form_title, 'showComment' => true ), JSON_UNESCAPED_UNICODE )
			) );
			?>
		</div>
	</div>
</section>
