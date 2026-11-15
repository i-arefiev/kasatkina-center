<?php
/**
 * Блок «Хлебные крошки».
 *
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );

printf( '<div %s>%s</div>', get_block_wrapper_attributes(), kasatkina_breadcrumbs( '', $post_id ?: null ) );
