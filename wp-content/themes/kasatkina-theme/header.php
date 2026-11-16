<?php
/**
 * Шапка сайта. Контакты — из «Внешний вид → Настроить → Контакты и общие тексты».
 */

defined( 'ABSPATH' ) || exit;

$address = kasatkina_opt( 'address' );
$phone   = kasatkina_opt( 'phone' );
$email   = kasatkina_opt( 'email' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-screen bg-white font-sans text-ink antialiased' ); ?>>
<?php wp_body_open(); ?>
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:shadow-lg">Перейти к содержимому</a>

<div class="hidden border-b border-line/40 bg-white md:block">
	<div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-2 text-xs text-ink/70">
		<div class="flex items-center gap-2">
			<?php if ( $address ) : ?>
				<?php echo kasatkina_icon( 'location', 14, 'text-brand' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<span><?php echo esc_html( $address ); ?></span>
			<?php endif; ?>
		</div>
		<div class="flex items-center gap-6">
			<?php if ( $phone ) : ?>
				<a href="<?php echo esc_attr( kasatkina_tel( $phone ) ); ?>" class="flex items-center gap-2 hover:text-brand">
					<?php echo kasatkina_icon( 'phone', 14, 'text-brand' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php echo esc_html( $phone ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="flex items-center gap-2 hover:text-brand">
					<?php echo kasatkina_icon( 'mail', 14, 'text-brand' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php echo esc_html( $email ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<header class="ks-header sticky top-0 z-50 border-b border-line/40 bg-white/90 backdrop-blur-lg">
	<div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
		<div class="flex shrink-0 items-center [&_img]:h-11 [&_img]:w-auto">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-base font-extrabold leading-tight text-ink transition hover:text-brand" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<nav class="hidden lg:block" aria-label="Главное меню">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'flex items-center gap-7',
				'fallback_cb'    => false,
				'depth'          => 1,
				'link_class'     => 'text-sm font-medium text-ink/80 transition hover:text-brand',
			) );
			?>
		</nav>

		<div class="flex items-center gap-2">
			<?php if ( kasatkina_opt( 'cta_text' ) ) : ?>
				<a href="<?php echo esc_url( kasatkina_link( kasatkina_opt( 'cta_url' ) ) ); ?>" class="ks-btn hidden md:inline-flex">
					<?php echo esc_html( kasatkina_opt( 'cta_text' ) ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $phone ) : ?>
				<a href="<?php echo esc_attr( kasatkina_tel( $phone ) ); ?>" class="rounded-full border border-line p-2.5 text-ink md:hidden" aria-label="Позвонить">
					<?php echo kasatkina_icon( 'phone', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</a>
			<?php endif; ?>
			<button id="ks-menu-btn" type="button" class="rounded-full border border-line p-2.5 text-ink lg:hidden" aria-label="Меню" aria-expanded="false" aria-controls="ks-mobile-menu">
				<?php echo kasatkina_icon( 'menu', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</button>
		</div>
	</div>

	<div id="ks-mobile-menu" class="border-t border-line/40 bg-white lg:hidden" hidden>
		<div class="mx-auto flex max-w-7xl flex-col gap-1 px-6 py-4">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'flex flex-col gap-1',
				'fallback_cb'    => false,
				'depth'          => 1,
				'link_class'     => 'block rounded-xl px-3 py-2.5 text-sm font-medium text-ink hover:bg-brand-soft',
			) );
			?>
			<?php if ( kasatkina_opt( 'cta_text' ) ) : ?>
				<a href="<?php echo esc_url( kasatkina_link( kasatkina_opt( 'cta_url' ) ) ); ?>" class="ks-btn mt-2 justify-center">
					<?php echo esc_html( kasatkina_opt( 'cta_text' ) ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>
