<?php
/**
 * Страница одной услуги. Данные — из полей карточки услуги («Данные услуги» в редакторе),
 * фото процедуры — из блока «Галерея» в основном редакторе услуги.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		$id                = get_the_ID();
		$price             = (string) get_post_meta( $id, '_service_price', true );
		$description       = (string) get_post_meta( $id, '_service_description', true );
		$advantages        = kasatkina_service_lines( $id, '_service_advantages' );
		$indications       = kasatkina_service_lines( $id, '_service_indications' );
		$contraindications = kasatkina_service_lines( $id, '_service_contraindications' );
		$faqs              = array();
		foreach ( kasatkina_service_lines( $id, '_service_faq' ) as $line ) {
			$parts = array_map( 'trim', explode( '|', $line, 2 ) );
			if ( 2 === count( $parts ) && $parts[0] && $parts[1] ) {
				$faqs[] = $parts;
			}
		}
		$stats = array_filter( array(
			'минут сеанс'   => (string) get_post_meta( $id, '_service_duration', true ),
			'процедур курс' => (string) get_post_meta( $id, '_service_course', true ),
			'боли и швов'   => (string) get_post_meta( $id, '_service_pain', true ),
		), 'strlen' );
		?>

		<section class="ks-glow-tr relative overflow-hidden border-b border-line/30">
			<div class="mx-auto max-w-7xl px-6 py-12 lg:py-20">
				<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

				<div class="mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]">
					<div>
						<?php $terms = get_the_terms( $id, 'service_category' ); ?>
						<span class="ks-badge"><?php echo kasatkina_icon( 'sparkles', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php echo esc_html( $terms && ! is_wp_error( $terms ) ? $terms[0]->name : 'Услуга центра' ); ?></span>
						<h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-ink sm:text-5xl">
							<?php the_title(); ?> <span class="text-brand">в Калининграде</span>
						</h1>
						<?php if ( has_excerpt() ) : ?>
							<p class="mt-6 max-w-xl text-lg leading-relaxed text-ink/70"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>

						<div class="mt-8 flex flex-wrap items-center gap-3">
							<a href="#booking" class="ks-btn">Записаться на процедуру <?php echo kasatkina_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
							<?php if ( $price ) : ?>
								<span class="inline-flex items-center gap-2 rounded-full border border-brand bg-white px-5 py-3 text-sm font-bold text-brand"><?php echo esc_html( $price ); ?></span>
							<?php endif; ?>
						</div>

						<?php if ( $stats ) : ?>
							<div class="mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-line/50 pt-6">
								<?php foreach ( $stats as $label => $value ) : ?>
									<div>
										<div class="text-2xl font-bold text-brand"><?php echo esc_html( $value ); ?></div>
										<div class="text-xs text-ink/60"><?php echo esc_html( $label ); ?></div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="relative">
						<div class="absolute inset-0 -z-10 mx-auto rounded-full bg-brand/20 blur-3xl"></div>
						<div class="overflow-hidden rounded-3xl border border-line/60 bg-brand-soft shadow-2xl shadow-brand/10">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large', array( 'class' => 'aspect-[4/3] h-full w-full object-cover' ) ); ?>
							<?php else : ?>
								<div class="grid aspect-[4/3] place-items-center text-brand"><?php echo kasatkina_icon( get_post_meta( $id, '_service_icon', true ) ?: 'sparkles', 64 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php if ( $description || $advantages || get_the_content() ) : ?>
			<section class="border-b border-line/30 py-20">
				<div class="mx-auto max-w-7xl px-6">
					<div class="grid gap-12 lg:grid-cols-[1fr_1.2fr] lg:items-start">
						<div>
							<p class="ks-eyebrow">О процедуре</p>
							<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Что такое <?php echo esc_html( mb_strtolower( get_the_title() ) ); ?></h2>
							<?php if ( get_the_content() ) : ?>
								<div class="ks-service-media mt-8"><?php the_content(); ?></div>
							<?php endif; ?>
						</div>
						<div>
							<?php if ( $description ) : ?>
								<div class="ks-prose"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
							<?php endif; ?>
							<?php if ( $advantages ) : ?>
								<h3 class="mt-8 text-lg font-bold text-ink">Преимущества метода</h3>
								<ul class="ks-checklist mt-4 grid gap-3 sm:grid-cols-2">
									<?php foreach ( $advantages as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $indications || $contraindications ) : ?>
			<section class="border-b border-line/30 bg-brand-soft/40 py-20">
				<div class="mx-auto max-w-7xl px-6">
					<p class="ks-eyebrow">Показания и противопоказания</p>
					<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Когда назначают процедуру</h2>
					<div class="mt-12 grid gap-6 lg:grid-cols-2">
						<?php if ( $indications ) : ?>
							<div class="rounded-3xl border border-brand/30 bg-white p-8 shadow-sm">
								<div class="flex items-center gap-3">
									<span class="ks-icon-tile ks-icon-tile--solid"><?php echo kasatkina_icon( 'check', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
									<div>
										<div class="text-xs font-semibold uppercase tracking-widest text-brand">Показания</div>
										<div class="text-xl font-bold text-ink">Когда рекомендуется</div>
									</div>
								</div>
								<ul class="ks-checks mt-6">
									<?php foreach ( $indications as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php if ( $contraindications ) : ?>
							<div class="rounded-3xl border border-line/70 bg-white p-8 shadow-sm">
								<div class="flex items-center gap-3">
									<span class="ks-icon-tile bg-ink text-white"><?php echo kasatkina_icon( 'warning', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
									<div>
										<div class="text-xs font-semibold uppercase tracking-widest text-ink/60">Противопоказания</div>
										<div class="text-xl font-bold text-ink">Когда не рекомендуется</div>
									</div>
								</div>
								<ul class="ks-checks ks-checks--warn mt-6">
									<?php foreach ( $contraindications as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
								<p class="mt-6 rounded-xl bg-ink/[0.04] p-4 text-xs leading-relaxed text-ink/70">Имеются противопоказания. Перед процедурой необходима консультация специалиста.</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/service-steps' ); ?>

		<?php if ( $faqs ) : ?>
			<section class="border-b border-line/30 bg-brand-soft/40 py-20">
				<div class="mx-auto max-w-4xl px-6">
					<div class="text-center">
						<p class="ks-eyebrow">Вопросы и ответы</p>
						<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Часто задаваемые вопросы</h2>
					</div>
					<div class="mt-12 space-y-3">
						<?php foreach ( $faqs as [ $question, $answer ] ) : ?>
							<details class="ks-faq group">
								<summary>
									<span><?php echo esc_html( $question ); ?></span>
									<?php echo kasatkina_icon( 'chevron-down', 20, 'text-brand transition group-open:rotate-180' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</summary>
								<div class="border-t border-line/40 px-6 py-5 text-sm leading-relaxed text-ink/75"><?php echo wp_kses_post( wpautop( $answer ) ); ?></div>
							</details>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php
		$related = kasatkina_services_query( array( 'posts_per_page' => 3, 'post__not_in' => array( $id ), 'orderby' => 'rand' ) );
		if ( $related->have_posts() ) :
			?>
			<section class="border-b border-line/30 py-20">
				<div class="mx-auto max-w-7xl px-6">
					<div class="flex flex-wrap items-end justify-between gap-6">
						<div>
							<p class="ks-eyebrow">Другие услуги</p>
							<h2 class="mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl">Также вас может заинтересовать</h2>
						</div>
						<a href="<?php echo esc_url( kasatkina_services_page_url() ); ?>" class="ks-btn ks-btn--outline">Все услуги</a>
					</div>
					<div class="mt-12 grid gap-5 md:grid-cols-3">
						<?php
						foreach ( $related->posts as $service ) {
							echo kasatkina_service_card( $service->ID, 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput
						}
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/booking-section', null, array( 'title' => 'Записаться: ' . get_the_title() ) ); ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
