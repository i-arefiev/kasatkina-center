<?php
/**
 * Блок «Реквизиты оператора».
 */

defined( 'ABSPATH' ) || exit;

$html = '';
foreach ( kasatkina_operator_rows() as [ $label, $value ] ) {
	$value = is_email( $value ) ? sprintf( '<a href="mailto:%1$s">%1$s</a>', esc_html( $value ) ) : esc_html( $value );
	$html .= sprintf( '<div class="grid gap-1 border-b border-line/40 py-3 last:border-0 sm:grid-cols-[18rem_1fr] sm:gap-6"><dt class="text-sm text-ink/60">%s</dt><dd class="m-0 text-sm font-medium text-ink">%s</dd></div>', esc_html( $label ), $value );
}

printf(
	'<dl %s>%s</dl>',
	get_block_wrapper_attributes( array( 'class' => 'my-6 rounded-2xl border border-line/60 bg-white px-6 py-2' ) ),
	$html // phpcs:ignore WordPress.Security.EscapeOutput -- экранировано выше.
);
