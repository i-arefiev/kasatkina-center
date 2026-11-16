<?php
/**
 * Template Name: Страница всех услуг
 *
 * Заголовок — название страницы, подзаголовок — «Отрывок», вводный текст — содержимое страницы.
 * Ниже автоматически выводятся услуги, сгруппированные по категориям.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="ks-glow-tr relative overflow-hidden bg-gradient-to-b from-brand-soft/60 to-white">
			<div class="mx-auto max-w-7xl px-6 pb-16 pt-10 md:pb-20 md:pt-14">
				<?php echo kasatkina_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<h1 class="mt-6 max-w-3xl text-4xl font-extrabold tracking-tight text-ink md:text-5xl lg:text-6xl"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="mt-5 max-w-2xl text-base leading-relaxed text-ink/70 md:text-lg"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</section>

		<?php if ( get_the_content() ) : ?>
			<section class="mx-auto max-w-4xl px-6 py-14 md:py-16">
				<div class="ks-prose md:text-lg"><?php the_content(); ?></div>
			</section>
		<?php endif; ?>
	<?php endwhile; ?>

	<?php
	$categories = get_terms( array( 'taxonomy' => 'service_category', 'hide_empty' => true ) );
	$groups     = array();

	if ( ! is_wp_error( $categories ) && $categories ) {
		foreach ( $categories as $category ) {
			$groups[] = array(
				'title' => $category->name,
				'posts' => kasatkina_services_query( array( 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $category->term_id ) ) ) )->posts,
			);
		}
		// Услуги без категории — отдельной группой в конце.
		$uncategorized = kasatkina_services_query( array( 'tax_query' => array( array( 'taxonomy' => 'service_category', 'operator' => 'NOT EXISTS' ) ) ) )->posts;
		if ( $uncategorized ) {
			$groups[] = array( 'title' => 'Другие услуги', 'posts' => $uncategorized );
		}
	} else {
		$groups[] = array( 'title' => '', 'posts' => kasatkina_services_query()->posts );
	}

	foreach ( $groups as $group ) :
		if ( ! $group['posts'] ) {
			continue;
		}
		?>
		<section class="border-t border-line/30 py-16 md:py-20">
			<div class="mx-auto max-w-7xl px-6">
				<?php if ( $group['title'] ) : ?>
					<h2 class="text-3xl font-extrabold tracking-tight text-ink md:text-4xl"><?php echo esc_html( $group['title'] ); ?></h2>
				<?php endif; ?>
				<div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
					<?php
					foreach ( $group['posts'] as $service ) {
						echo kasatkina_service_card( $service->ID, 'photo' ); // phpcs:ignore WordPress.Security.EscapeOutput
					}
					?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<?php get_template_part( 'template-parts/booking-section' ); ?>
</main>
<?php
get_footer();
