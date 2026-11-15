<?php
/**
 * Запасной шаблон: рубрики, метки, поиск и прочие списки записей.
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_search() ) {
	/* translators: поисковый запрос */
	$title = sprintf( 'Поиск: «%s»', get_search_query() );
} elseif ( is_archive() ) {
	$title = wp_strip_all_tags( get_the_archive_title() );
} else {
	$title = 'Статьи';
}
?>
<main id="main">
	<section class="ks-glow-tr relative overflow-hidden bg-gradient-to-b from-brand-soft/60 to-white">
		<div class="mx-auto max-w-7xl px-6 pb-14 pt-10 md:pt-14">
			<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<h1 class="mt-6 text-4xl font-extrabold tracking-tight text-ink md:text-5xl"><?php echo esc_html( $title ); ?></h1>
		</div>
	</section>

	<section class="pb-20 pt-4">
		<div class="mx-auto max-w-7xl px-6">
			<?php if ( have_posts() ) : ?>
				<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/post-card' );
					endwhile;
					?>
				</div>
				<div class="ks-pagination mt-12">
					<?php the_posts_pagination( array( 'prev_text' => '← Назад', 'next_text' => 'Дальше →', 'mid_size' => 1 ) ); ?>
				</div>
			<?php else : ?>
				<p class="text-ink/60">Ничего не найдено.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
