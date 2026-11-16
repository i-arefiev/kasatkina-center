<?php
/**
 * Блок «Иконка».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

printf(
	'<span %s>%s</span>',
	get_block_wrapper_attributes(),
	kasatkina_icon( (string) $attributes['icon'], max( 8, (int) $attributes['size'] ) )
);
