<?php
/**
 * «Четыре шага к результату» на странице услуги.
 *
 * Если в «Паттерны → Мои паттерны» создать синхронизированный паттерн с названием
 * «Шаги процедуры», на всех страницах услуг будет выводиться он — так шаги можно
 * поменять без программиста. Иначе выводятся шаги по умолчанию ниже.
 * Для консультаций психолога — свой паттерн «Шаги консультации» и свои шаги по умолчанию.
 *
 * @var array $args [ 'consult' => bool ]
 */

defined( 'ABSPATH' ) || exit;

$consult = ! empty( $args['consult'] );

$custom = get_posts( array(
	'post_type'      => 'wp_block',
	'title'          => $consult ? 'Шаги консультации' : 'Шаги процедуры',
	'post_status'    => 'publish',
	'posts_per_page' => 1,
) );
if ( $custom ) {
	echo do_blocks( $custom[0]->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput
	return;
}

$steps = $consult ? array(
	array( 'phone', 'Запись', 'Оставьте заявку на сайте или позвоните — подберём удобное время встречи.' ),
	array( 'smile', 'Знакомство', 'На первой встрече вы рассказываете, что вас беспокоит, а психолог помогает сформулировать запрос.' ),
	array( 'heart', 'Работа с запросом', 'Вместе ищем причины трудностей и способы с ними справляться. Всё сказанное остаётся конфиденциальным.' ),
	array( 'calendar', 'Дальнейший план', 'Обсуждаем, сколько встреч понадобится и как поддерживать результат, — решение всегда за вами.' ),
) : array(
	array( 'clipboard', 'Консультация', 'Врач оценивает состояние, изучает историю болезни и определяет показания к процедуре.' ),
	array( 'calendar', 'Подготовка', 'Составляем индивидуальный план курса: количество сеансов, зоны воздействия, интенсивность.' ),
	array( 'pulse', 'Проведение сеанса', 'Процедура проходит под контролем специалиста. Длительность и интенсивность — по схеме лечения.' ),
	array( 'clock', 'Наблюдение и результат', 'Контроль динамики после каждого сеанса и корректировка курса по необходимости.' ),
);
?>
<section class="border-b border-line/30 py-20">
	<div class="mx-auto max-w-7xl px-6">
		<p class="ks-eyebrow"><?php echo $consult ? 'Как проходит работа' : 'Как проходит процедура'; ?></p>
		<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Четыре шага к результату</h2>
		<div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
			<?php foreach ( $steps as $i => [ $icon, $title, $text ] ) : ?>
				<div class="rounded-2xl border border-line/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
					<div class="flex items-center justify-between">
						<span class="ks-icon-tile ks-icon-tile--solid"><?php echo kasatkina_icon( $icon, 24 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<span class="text-3xl font-black text-brand/20">0<?php echo (int) $i + 1; ?></span>
					</div>
					<div class="mt-5 text-lg font-bold text-ink"><?php echo esc_html( $title ); ?></div>
					<p class="mt-2 text-sm leading-relaxed text-ink/65"><?php echo esc_html( $text ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
