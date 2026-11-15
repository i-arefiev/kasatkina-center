<?php
/**
 * Блок «Форма записи». Отправка обрабатывается в inc/requests.php.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$form_id  = kasatkina_next_form_id();
$sent     = isset( $_GET['ks_sent'] ) && sanitize_html_class( wp_unslash( $_GET['ks_sent'] ) ) === $form_id; // phpcs:ignore WordPress.Security.NonceVerification
$error    = isset( $_GET['ks_error'] ) && sanitize_html_class( wp_unslash( $_GET['ks_error'] ) ) === $form_id; // phpcs:ignore WordPress.Security.NonceVerification
$is_card  = 'plain' !== $attributes['variant'];
$field    = 'w-full rounded-xl border border-line bg-white px-4 py-3 text-sm text-ink outline-none transition placeholder:text-ink/40 focus:border-brand focus:ring-2 focus:ring-brand/20';
$wrapper  = get_block_wrapper_attributes( array(
	'id'    => $form_id,
	'class' => 'scroll-mt-28 ' . ( $is_card ? 'rounded-2xl border border-line/60 bg-white p-6 sm:p-8' : '' ),
) );

// Список услуг для выпадающего меню: из раздела «Услуги» + выезд на дом.
$services = array();
if ( $attributes['showService'] ) {
	foreach ( kasatkina_services_query( array( 'fields' => 'ids' ) )->posts as $service_id ) {
		$services[] = get_the_title( $service_id );
	}
	$services[] = 'Выезд специалиста на дом';
	$services[] = 'Нужна консультация, не знаю что выбрать';
}
?>
<div <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( $attributes['title'] ) : ?>
		<div class="text-lg font-bold text-ink"><?php echo esc_html( $attributes['title'] ); ?></div>
	<?php endif; ?>
	<?php if ( $attributes['subtitle'] ) : ?>
		<p class="mt-1 text-sm text-ink/60"><?php echo esc_html( $attributes['subtitle'] ); ?></p>
	<?php endif; ?>

	<?php if ( $sent ) : ?>
		<div class="mt-5 flex items-start gap-3 rounded-xl border border-brand/40 bg-brand-soft p-4 text-sm text-ink" role="status">
			<?php echo kasatkina_icon( 'check', 20, 'text-brand' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span><strong>Заявка отправлена.</strong> Мы свяжемся с Вами в течение рабочего дня.</span>
		</div>
	<?php else : ?>
		<?php if ( $error ) : ?>
			<div class="mt-5 rounded-xl border border-red-300 bg-red-50 p-4 text-sm text-red-800" role="alert">
				Проверьте, пожалуйста, имя и номер телефона (не меньше 10 цифр).
			</div>
		<?php endif; ?>
		<form class="ks-form mt-5 grid gap-3" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="kasatkina_booking" />
			<input type="hidden" name="ks_form" value="<?php echo esc_attr( $form_id ); ?>" />
			<input type="hidden" name="ks_consent_required" value="1" />
			<div class="ks-hp" aria-hidden="true">
				<label>Ваш сайт <input type="text" name="ks_website" tabindex="-1" autocomplete="off" /></label>
			</div>

			<label class="sr-only" for="<?php echo esc_attr( $form_id ); ?>-name">Ваше имя</label>
			<input id="<?php echo esc_attr( $form_id ); ?>-name" type="text" name="ks_name" placeholder="Ваше имя" required autocomplete="name" class="<?php echo esc_attr( $field ); ?>" />

			<label class="sr-only" for="<?php echo esc_attr( $form_id ); ?>-phone">Телефон</label>
			<input id="<?php echo esc_attr( $form_id ); ?>-phone" type="tel" name="ks_phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel" inputmode="tel" class="<?php echo esc_attr( $field ); ?>" />

			<?php if ( $services ) : ?>
				<label class="sr-only" for="<?php echo esc_attr( $form_id ); ?>-service">Услуга</label>
				<select id="<?php echo esc_attr( $form_id ); ?>-service" name="ks_service" class="<?php echo esc_attr( $field ); ?>">
					<option value="">Выберите услугу (необязательно)</option>
					<?php foreach ( $services as $service ) : ?>
						<option value="<?php echo esc_attr( $service ); ?>"><?php echo esc_html( $service ); ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>

			<?php if ( $attributes['showComment'] ) : ?>
				<label class="sr-only" for="<?php echo esc_attr( $form_id ); ?>-comment">Комментарий</label>
				<textarea id="<?php echo esc_attr( $form_id ); ?>-comment" name="ks_comment" rows="3" placeholder="Комментарий (по желанию)" class="<?php echo esc_attr( $field ); ?> resize-none"></textarea>
			<?php endif; ?>

			<label class="flex cursor-pointer items-start gap-3 pt-1 text-xs text-ink/70">
				<input type="checkbox" name="ks_consent" value="1" required class="mt-0.5 h-4 w-4 shrink-0 accent-brand" />
				<span>Я согласен(-на) на обработку персональных данных<?php
					$privacy = get_privacy_policy_url();
					if ( $privacy ) {
						printf( ' в соответствии с <a href="%s" class="underline hover:text-brand" target="_blank">политикой конфиденциальности</a>', esc_url( $privacy ) );
					}
				?>.</span>
			</label>

			<button type="submit" class="ks-btn mt-2 w-full justify-center">
				<span><?php echo esc_html( $attributes['buttonText'] ); ?></span>
				<?php echo kasatkina_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</button>
		</form>
	<?php endif; ?>
</div>
