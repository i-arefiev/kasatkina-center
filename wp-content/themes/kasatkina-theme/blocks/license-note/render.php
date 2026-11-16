<?php
/**
 * Блок «Лицензия» — текст из настроек сайта.
 */

defined( 'ABSPATH' ) || exit;

$text = kasatkina_opt( 'license' );
if ( ! $text ) {
	return;
}

printf(
	'<div %s>%s<p class="text-xs leading-relaxed text-ink/75">%s</p></div>',
	get_block_wrapper_attributes( array( 'class' => 'flex items-start gap-3 rounded-2xl border border-brand/30 bg-white p-5' ) ),
	kasatkina_icon( 'shield-check', 20, 'mt-0.5 text-brand' ),
	esc_html( $text )
);
