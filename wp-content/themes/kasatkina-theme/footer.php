<?php
/**
 * Подвал сайта.
 */

defined( 'ABSPATH' ) || exit;

$phones = array_filter( array( kasatkina_opt( 'phone' ), kasatkina_opt( 'phone2' ) ) );
$email  = kasatkina_opt( 'email' );
?>
<footer class="border-t border-white/10 bg-navy py-14 text-white/70">
	<div class="mx-auto grid max-w-7xl gap-10 px-6 md:grid-cols-3">
		<div>
			<?php $footer_logo = get_theme_mod( 'footer_logo' ); ?>
			<?php if ( $footer_logo ) : ?>
				<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-11 w-auto" loading="lazy" />
			<?php else : ?>
				<span class="text-lg font-bold text-white"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
			<p class="mt-5 text-sm leading-relaxed"><?php echo esc_html( kasatkina_opt( 'footer_about' ) ); ?></p>
		</div>

		<div>
			<?php if ( has_nav_menu( 'footer' ) || has_nav_menu( 'primary' ) ) : ?>
				<div class="text-sm font-semibold text-white">Навигация</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => has_nav_menu( 'footer' ) ? 'footer' : 'primary',
					'container'      => false,
					'menu_class'     => 'mt-4 space-y-2 text-sm',
					'fallback_cb'    => false,
					'depth'          => 1,
					'link_class'     => 'transition hover:text-brand',
				) );
				?>
			<?php endif; ?>
		</div>

		<div>
			<div class="text-sm font-semibold text-white">Контакты</div>
			<ul class="mt-4 space-y-2 text-sm">
				<?php if ( kasatkina_opt( 'address' ) ) : ?>
					<li><?php echo esc_html( kasatkina_opt( 'address' ) ); ?></li>
				<?php endif; ?>
				<?php foreach ( $phones as $phone ) : ?>
					<li><a href="<?php echo esc_attr( kasatkina_tel( $phone ) ); ?>" class="transition hover:text-brand"><?php echo esc_html( $phone ); ?></a></li>
				<?php endforeach; ?>
				<?php if ( $email ) : ?>
					<li><a href="mailto:<?php echo esc_attr( $email ); ?>" class="transition hover:text-brand"><?php echo esc_html( $email ); ?></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="mx-auto mt-10 max-w-7xl border-t border-white/10 px-6 pt-6 text-xs leading-relaxed">
		<?php if ( kasatkina_opt( 'license' ) ) : ?>
			<p><?php echo esc_html( kasatkina_opt( 'license' ) ); ?></p>
		<?php endif; ?>
		<p class="mt-2">© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( kasatkina_opt( 'copyright' ) ); ?></p>
		<?php if ( kasatkina_legal_links() ) : ?>
			<p class="mt-2 flex flex-wrap gap-x-5 gap-y-1">
				<?php foreach ( kasatkina_legal_links() as $label => $url ) : ?>
					<a href="<?php echo esc_url( $url ); ?>" class="underline decoration-white/30 underline-offset-2 transition hover:text-brand"><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
			</p>
		<?php endif; ?>
		<p class="mt-3">
			Разработка сайта — <a href="https://arefiev.dev" target="_blank" rel="noopener" class="font-medium text-white/80 transition hover:text-brand">Студия Ильи Арефьева</a>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
