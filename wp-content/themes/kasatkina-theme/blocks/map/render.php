<?php
/**
 * Блок «Карта».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$url = kasatkina_opt( 'map_url' );
if ( ! $url ) {
	return;
}

printf(
	'<div %s><iframe title="Карта проезда" src="%s" style="height:%dpx" class="block w-full" loading="lazy" allowfullscreen></iframe></div>',
	get_block_wrapper_attributes( array( 'class' => 'overflow-hidden rounded-2xl border border-line/60 bg-white' ) ),
	esc_url( $url ),
	max( 250, (int) $attributes['height'] )
);
