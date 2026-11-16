<?php
/**
 * Блок «Сетка услуг» — карточки из раздела «Услуги».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$args = array( 'posts_per_page' => max( 1, (int) $attributes['limit'] ) );
if ( ! empty( $attributes['category'] ) ) {
	$args['tax_query'] = array( array( 'taxonomy' => 'service_category', 'field' => 'slug', 'terms' => $attributes['category'] ) );
}
$query = kasatkina_services_query( $args );

if ( ! $query->have_posts() ) {
	// На сайте пустой блок не показываем, в редакторе — подсказка.
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		echo '<div class="rounded-2xl border border-dashed border-brand/50 bg-brand-soft/40 p-8 text-center text-sm text-ink/70">Услуг пока нет. Добавьте их в разделе «Услуги» — карточки появятся здесь автоматически.</div>';
	}
	return;
}

$style = 'photo' === $attributes['cardStyle'] ? 'photo' : 'icon';
$html  = '';
foreach ( $query->posts as $service ) {
	$html .= kasatkina_service_card( $service->ID, $style );
}

if ( ! empty( $attributes['showMore'] ) ) {
	$html .= sprintf(
		'<a href="%s" class="group flex items-center justify-between gap-4 rounded-2xl bg-ink p-7 text-white transition hover:bg-brand">
			<span><span class="block text-lg font-bold">%s</span><span class="mt-1 block text-sm text-white/70">%s</span></span>
			%s
		</a>',
		esc_url( kasatkina_services_page_url() ),
		esc_html( $attributes['moreTitle'] ),
		esc_html( $attributes['moreText'] ),
		kasatkina_icon( 'arrow-right', 24, 'transition group-hover:translate-x-1' )
	);
}

printf(
	'<div %s>%s</div>',
	get_block_wrapper_attributes( array( 'class' => 'grid gap-5 sm:grid-cols-2 lg:grid-cols-3' ) ),
	$html // phpcs:ignore WordPress.Security.EscapeOutput -- собрано из экранированных частей выше.
);
