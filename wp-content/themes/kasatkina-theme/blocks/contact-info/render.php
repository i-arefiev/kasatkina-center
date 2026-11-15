<?php
/**
 * Блок «Контактные данные» — из настроек сайта.
 */

defined( 'ABSPATH' ) || exit;

$address = kasatkina_opt( 'address' );
$phones  = array_filter( array( kasatkina_opt( 'phone' ), kasatkina_opt( 'phone2' ) ) );
$email   = kasatkina_opt( 'email' );

$item = static function ( string $icon, string $label, string $content, string $extra = '' ): string {
	return sprintf(
		'<div class="flex items-start gap-3 %s"><span class="ks-icon-tile ks-icon-tile--sm">%s</span><div><div class="text-xs font-semibold uppercase text-ink/50">%s</div>%s</div></div>',
		esc_attr( $extra ),
		kasatkina_icon( $icon, 20 ),
		esc_html( $label ),
		$content
	);
};

$html = '';
if ( $address ) {
	$html .= $item( 'location', 'Адрес', '<div class="mt-1 text-sm font-medium text-ink">' . esc_html( $address ) . '</div>' );
}
if ( $phones ) {
	$links = '';
	foreach ( $phones as $i => $phone ) {
		$links .= sprintf( '<a href="%s" class="%s block text-sm font-medium text-ink hover:text-brand">%s</a>', esc_attr( kasatkina_tel( $phone ) ), 0 === $i ? 'mt-1' : '', esc_html( $phone ) );
	}
	$html .= $item( 'phone', count( $phones ) > 1 ? 'Телефоны' : 'Телефон', $links );
}
if ( $email ) {
	$html .= $item( 'mail', 'Email', sprintf( '<a href="mailto:%1$s" class="mt-1 block text-sm font-medium text-ink hover:text-brand">%1$s</a>', esc_html( $email ) ), 'sm:col-span-2' );
}

printf(
	'<div %s>%s</div>',
	get_block_wrapper_attributes( array( 'class' => 'grid gap-4 rounded-2xl border border-line/60 bg-white p-6 sm:grid-cols-2' ) ),
	$html // phpcs:ignore WordPress.Security.EscapeOutput
);
