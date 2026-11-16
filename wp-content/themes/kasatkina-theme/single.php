<?php
/**
 * Отдельная статья.
 * Блок «Об авторе»: если у автора заполнено поле «Биографическая информация» в профиле —
 * выводится его имя и текст, иначе — данные из «Настроить → Контакты и общие тексты».
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		$bio         = get_the_author_meta( 'description' );
		$author_name = $bio ? get_the_author() : kasatkina_opt( 'author_name' );
		$author_bio  = $bio ?: kasatkina_opt( 'author_bio' );
		// Рубрику «Без рубрики» (по умолчанию) не показываем.
		$category    = array_values( array_filter( get_the_category(), fn( $c ) => (int) $c->term_id !== (int) get_option( 'default_category' ) ) );
		?>
		<section class="ks-glow-tr relative overflow-hidden border-b border-line/30">
			<div class="mx-auto max-w-4xl px-6 py-12 lg:py-16">
				<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

				<?php if ( $category ) : ?>
					<a href="<?php echo esc_url( get_category_link( $category[0] ) ); ?>" class="ks-badge mt-8"><?php echo esc_html( $category[0]->name ); ?></a>
				<?php endif; ?>

				<h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-ink sm:text-5xl"><?php the_title(); ?></h1>

				<div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-ink/65">
					<div class="flex items-center gap-2">
						<span class="grid h-9 w-9 place-items-center rounded-full border border-brand/40 bg-brand-soft text-xs font-bold text-brand"><?php echo esc_html( kasatkina_initials( $author_name ) ); ?></span>
						<span class="flex flex-col leading-tight">
							<span class="text-xs uppercase tracking-wide text-ink/50">Автор</span>
							<span class="font-semibold text-ink"><?php echo esc_html( $author_name ); ?></span>
						</span>
					</div>
					<span class="hidden h-8 w-px bg-line/60 sm:block"></span>
					<div class="flex items-center gap-2">
						<?php echo kasatkina_icon( 'calendar', 16, 'text-brand' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
					</div>
				</div>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mx-auto max-w-5xl px-6 pb-12">
					<div class="overflow-hidden rounded-3xl border border-line/50 shadow-xl shadow-brand/5">
						<?php the_post_thumbnail( 'large', array( 'class' => 'h-[280px] w-full object-cover sm:h-[420px]' ) ); ?>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<article class="mx-auto max-w-3xl px-6 py-14">
			<div class="ks-prose text-lg"><?php the_content(); ?></div>
		</article>

		<section class="mx-auto max-w-3xl px-6 pb-16">
			<div class="rounded-3xl border border-line/50 bg-brand-soft/40 p-6 sm:p-8">
				<div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
					<span class="grid h-24 w-24 shrink-0 place-items-center rounded-2xl border-2 border-brand/40 bg-white text-2xl font-bold text-brand"><?php echo esc_html( kasatkina_initials( $author_name ) ); ?></span>
					<div class="flex-1">
						<div class="text-xs font-semibold uppercase tracking-wide text-brand-dark">Об авторе</div>
						<div class="mt-1 text-xl font-bold text-ink"><?php echo esc_html( $author_name ); ?></div>
						<p class="mt-2 text-sm leading-relaxed text-ink/75"><?php echo esc_html( $author_bio ); ?></p>
						<div class="mt-4 flex flex-wrap gap-3">
							<a href="#booking" class="ks-btn">Записаться на консультацию</a>
							<?php if ( kasatkina_opt( 'author_url' ) ) : ?>
								<a href="<?php echo esc_url( kasatkina_link( kasatkina_opt( 'author_url' ) ) ); ?>" class="ks-btn ks-btn--outline">Подробнее об авторе</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		$related = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		) );
		if ( $related->have_posts() ) :
			?>
			<section class="border-t border-line/40 bg-surface py-16">
				<div class="mx-auto max-w-7xl px-6">
					<div class="flex items-end justify-between gap-6">
						<div>
							<p class="ks-eyebrow">Читайте также</p>
							<h2 class="mt-2 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Другие статьи</h2>
						</div>
						<a href="<?php echo esc_url( kasatkina_posts_page_url() ); ?>" class="hidden shrink-0 items-center gap-1.5 text-sm font-semibold text-brand hover:text-brand-dark sm:inline-flex">
							Все статьи <?php echo kasatkina_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</a>
					</div>
					<div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							get_template_part( 'template-parts/post-card' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/booking-section' ); ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
