<?php
/**
 * Список статей (страница, назначенная «Страницей записей» в «Настройки → Чтение»).
 * Заголовок и подзаголовок берутся из этой страницы: название и «Отрывок».
 */

defined( 'ABSPATH' ) || exit;

get_header();

$posts_page = (int) get_option( 'page_for_posts' );
$title      = $posts_page ? get_the_title( $posts_page ) : 'Статьи';
$subtitle   = $posts_page ? get_the_excerpt( $posts_page ) : '';
?>
<main id="main">
	<section class="ks-glow-tr relative overflow-hidden bg-gradient-to-b from-brand-soft/60 to-white">
		<div class="mx-auto max-w-7xl px-6 pb-16 pt-10 md:pt-14">
			<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<h1 class="mt-6 text-4xl font-extrabold tracking-tight text-ink md:text-5xl lg:text-6xl"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $subtitle ) : ?>
				<p class="mt-5 max-w-2xl text-base leading-relaxed text-ink/70 md:text-lg"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
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
				<p class="text-ink/60">Статей пока нет.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
