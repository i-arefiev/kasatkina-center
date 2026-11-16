<?php
/**
 * Заявки с форм сайта.
 * Каждая заявка сохраняется в админке (раздел «Заявки») и дублируется письмом,
 * поэтому даже если почта на хостинге не настроена — заявка не потеряется.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'ks_request', array(
		'labels'              => array(
			'name'          => 'Заявки',
			'singular_name' => 'Заявка',
			'menu_name'     => 'Заявки',
			'edit_item'     => 'Заявка',
			'search_items'  => 'Искать заявки',
			'not_found'     => 'Заявок пока нет',
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-email-alt',
		'supports'            => array( 'title' ),
		'capability_type'     => 'post',
		'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'        => true,
		'exclude_from_search' => true,
	) );
} );

/**
 * Поля заявки: ключ в базе => подпись.
 */
function kasatkina_request_fields(): array {
	return array(
		'_ks_name'    => 'Имя',
		'_ks_phone'   => 'Телефон',
		'_ks_service' => 'Услуга',
		'_ks_comment' => 'Комментарий',
		'_ks_page'    => 'Страница',
	);
}

/**
 * Обработка отправки формы (admin-post.php?action=kasatkina_booking).
 */
function kasatkina_handle_booking(): void {
	$back = wp_get_referer() ?: home_url( '/' );
	$back = remove_query_arg( array( 'ks_sent', 'ks_error' ), $back );
	$form = isset( $_POST['ks_form'] ) ? sanitize_html_class( wp_unslash( $_POST['ks_form'] ) ) : 'zapis';

	// Скрытое поле-ловушка: люди его не видят и не заполняют, спам-боты — заполняют.
	if ( ! empty( $_POST['ks_website'] ) ) {
		kasatkina_booking_respond( true, $back, $form );
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['ks_name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['ks_phone'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['ks_service'] ?? '' ) );
	$comment = sanitize_textarea_field( wp_unslash( $_POST['ks_comment'] ?? '' ) );
	$digits  = preg_replace( '/\D/', '', $phone );

	if ( '' === $name || strlen( $digits ) < 10 || ( isset( $_POST['ks_consent_required'] ) && empty( $_POST['ks_consent'] ) ) ) {
		kasatkina_booking_respond( false, $back, $form );
	}

	// Не чаще одной заявки в 20 секунд с одного адреса — защита от двойного нажатия и флуда.
	$ip_key = 'ks_req_' . md5( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	if ( get_transient( $ip_key ) ) {
		kasatkina_booking_respond( true, $back, $form );
	}
	set_transient( $ip_key, 1, 20 );

	$page = esc_url_raw( $back );
	$id   = wp_insert_post( array(
		'post_type'   => 'ks_request',
		'post_status' => 'publish',
		'post_title'  => $name . ' — ' . $phone,
	) );

	if ( $id && ! is_wp_error( $id ) ) {
		$values = array(
			'_ks_name'    => $name,
			'_ks_phone'   => $phone,
			'_ks_service' => $service,
			'_ks_comment' => $comment,
			'_ks_page'    => $page,
		);
		foreach ( $values as $key => $value ) {
			update_post_meta( $id, $key, $value );
		}

		$to   = kasatkina_opt( 'notify_email' ) ?: get_option( 'admin_email' );
		$body = "Новая заявка с сайта\n\n";
		foreach ( kasatkina_request_fields() as $key => $label ) {
			if ( '' !== $values[ $key ] ) {
				$body .= $label . ': ' . $values[ $key ] . "\n";
			}
		}
		$body .= "\nВсе заявки: " . admin_url( 'edit.php?post_type=ks_request' );
		wp_mail( $to, 'Заявка с сайта: ' . $name, $body );
	}

	kasatkina_booking_respond( true, $back, $form );
}

/**
 * Ответ на отправку формы: JSON, если форма отправлена скриптом без перезагрузки страницы,
 * иначе — возврат на страницу с ?ks_sent / ?ks_error (запасной вариант без JavaScript).
 */
function kasatkina_booking_respond( bool $ok, string $back, string $form ): void {
	if ( ! empty( $_POST['ks_ajax'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		wp_send_json( array( 'ok' => $ok ), $ok ? 200 : 422 );
	}
	wp_safe_redirect( add_query_arg( $ok ? 'ks_sent' : 'ks_error', $form, $back ) . '#' . $form );
	exit;
}
add_action( 'admin_post_nopriv_kasatkina_booking', 'kasatkina_handle_booking' );
add_action( 'admin_post_kasatkina_booking', 'kasatkina_handle_booking' );

// Колонки в списке заявок.
add_filter( 'manage_ks_request_posts_columns', function () {
	return array(
		'cb'          => '<input type="checkbox" />',
		'title'       => 'Заявка',
		'_ks_service' => 'Услуга',
		'_ks_comment' => 'Комментарий',
		'date'        => 'Дата',
	);
} );
add_action( 'manage_ks_request_posts_custom_column', function ( $column, $post_id ) {
	echo esc_html( (string) get_post_meta( $post_id, $column, true ) );
}, 10, 2 );

// Карточка заявки: просмотр полей.
add_action( 'add_meta_boxes_ks_request', function () {
	add_meta_box( 'ks_request_data', 'Данные заявки', function ( WP_Post $post ) {
		echo '<table class="form-table"><tbody>';
		foreach ( kasatkina_request_fields() as $key => $label ) {
			$value = (string) get_post_meta( $post->ID, $key, true );
			if ( '_ks_phone' === $key ) {
				$value = sprintf( '<a href="%s">%s</a>', esc_attr( kasatkina_tel( $value ) ), esc_html( $value ) );
			} elseif ( '_ks_page' === $key ) {
				$value = sprintf( '<a href="%1$s" target="_blank">%1$s</a>', esc_url( $value ) );
			} else {
				$value = nl2br( esc_html( $value ) );
			}
			printf( '<tr><th>%s</th><td>%s</td></tr>', esc_html( $label ), $value ); // phpcs:ignore WordPress.Security.EscapeOutput
		}
		echo '</tbody></table>';
	}, 'ks_request', 'normal', 'high' );
} );

// Счётчик заявок за последние сутки в меню.
add_action( 'admin_menu', function () {
	global $menu;
	$count = count( get_posts( array(
		'post_type'      => 'ks_request',
		'date_query'     => array( array( 'after' => '1 day ago' ) ),
		'fields'         => 'ids',
		'posts_per_page' => 99,
	) ) );
	if ( ! $count ) {
		return;
	}
	foreach ( $menu as $i => $item ) {
		if ( 'edit.php?post_type=ks_request' === ( $item[2] ?? '' ) ) {
			$menu[ $i ][0] .= ' <span class="awaiting-mod">' . $count . '</span>';
		}
	}
} );
