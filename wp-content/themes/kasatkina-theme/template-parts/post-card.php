<?php
/**
 * Карточка статьи в списках.
 */

defined( 'ABSPATH' ) || exit;
?>
<article class="group flex flex-col overflow-hidden rounded-2xl border border-line/50 bg-white transition hover:-translate-y-1 hover:border-brand/50 hover:shadow-xl hover:shadow-brand/5">
	<a href="<?php the_permalink(); ?>" class="block aspect-[16/9] overflow-hidden bg-brand-soft" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105', 'loading' => 'lazy', 'alt' => '' ) ); ?>
		<?php else : ?>
			<span class="grid h-full w-full place-items-center text-brand"><?php echo kasatkina_icon( 'document', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<?php endif; ?>
	</a>
	<div class="flex flex-1 flex-col p-6">
		<time class="text-xs font-semibold text-brand" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
		<h2 class="mt-2 text-lg font-bold leading-snug text-ink transition group-hover:text-brand-dark">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="mb-5 mt-2 text-sm leading-relaxed text-ink/65"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '…' ) ); ?></p>
		<a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center gap-1.5 text-sm font-semibold text-brand hover:text-brand-dark">
			Читать статью <?php echo kasatkina_icon( 'arrow-right', 16, 'transition group-hover:translate-x-1' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</a>
	</div>
</article>
