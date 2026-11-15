<?php
/**
 * Обычная текстовая страница (политика конфиденциальности, оферта и т. п.):
 * хлебные крошки, заголовок и текст из редактора.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="ks-glow-tr border-b border-line/30">
			<div class="mx-auto max-w-4xl px-6 py-12 lg:py-16">
				<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<h1 class="mt-6 text-4xl font-extrabold leading-tight tracking-tight text-ink sm:text-5xl"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="mt-5 max-w-2xl text-lg leading-relaxed text-ink/70"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</section>
		<article class="mx-auto max-w-4xl px-6 py-14">
			<div class="ks-prose">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
