<?php
/**
 * Тип записей «Услуги»: регистрация, категории, поля карточки и вывод карточек.
 * Ключи полей (_service_price и т. д.) совпадают с бета-версией — уже заполненные данные сохраняются.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'service', array(
		'labels'       => array(
			'name'          => 'Услуги',
			'singular_name' => 'Услуга',
			'add_new'       => 'Добавить услугу',
			'add_new_item'  => 'Добавить новую услугу',
			'edit_item'     => 'Редактировать услугу',
			'new_item'      => 'Новая услуга',
			'view_item'     => 'Просмотреть услугу',
			'search_items'  => 'Искать услуги',
			'not_found'     => 'Услуг не найдено',
			'menu_name'     => 'Услуги',
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-heart',
		'menu_position'=> 5,
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'services', 'with_front' => false ),
		// В редакторе услуги заранее стоит блок «Галерея» — сюда добавляются фото процедуры.
		'template'     => array( array( 'core/gallery', array( 'linkTo' => 'none' ) ) ),
	) );

	register_taxonomy( 'service_category', 'service', array(
		'label'             => 'Категории услуг',
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'service-category' ),
	) );
} );

/**
 * Поля карточки услуги: имя поля формы => [ ключ в базе, подпись, тип, подсказка ].
 */
function kasatkina_service_fields(): array {
	return array(
		'service_price'             => array( '_service_price', 'Стоимость', 'text', 'Например: от 1 200 ₽ / сеанс' ),
		'service_duration'          => array( '_service_duration', 'Длительность сеанса, мин', 'text', 'Например: 15–30' ),
		'service_course'            => array( '_service_course', 'Курс, процедур', 'text', 'Например: 8–12' ),
		'service_pain'              => array( '_service_pain', 'Боль и швы', 'text', 'Например: 0' ),
		'service_description'       => array( '_service_description', 'Описание процедуры (блок «О процедуре»)', 'textarea', 'Лазеротерапия — это современный метод…' ),
		'service_advantages'        => array( '_service_advantages', 'Преимущества метода — каждое с новой строки', 'textarea', "Безболезненная процедура\nУскоряет регенерацию тканей" ),
		'service_indications'       => array( '_service_indications', 'Показания — каждое с новой строки', 'textarea', '' ),
		'service_contraindications' => array( '_service_contraindications', 'Противопоказания — каждое с новой строки', 'textarea', '' ),
		'service_faq'               => array( '_service_faq', 'Вопросы и ответы — каждая пара с новой строки, вопрос и ответ через «|»', 'textarea', "Сколько длится сеанс? | От 15 до 30 минут.\nБольно ли это? | Нет, процедура безболезненна." ),
	);
}

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'service_data_fields', 'Данные услуги', 'kasatkina_render_service_fields', 'service', 'normal', 'high' );
	add_meta_box( 'service_icon', 'Иконка в карточке', 'kasatkina_render_service_icon_field', 'service', 'side' );
} );

function kasatkina_render_service_fields( WP_Post $post ): void {
	wp_nonce_field( 'kasatkina_save_service_data', 'kasatkina_service_nonce' );
	?>
	<style>
		.ks-fields { display: grid; gap: 14px; }
		.ks-fields .ks-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; }
		.ks-fields label { display: block; font-weight: 600; margin-bottom: 4px; }
		.ks-fields input, .ks-fields textarea { width: 100%; }
	</style>
	<p class="description" style="margin-bottom:12px">
		Короткое описание для карточки и первого экрана — поле «Отрывок» (справа или ниже). Фото для обложки — «Изображение записи». Фото процедуры — в блок «Галерея» в основном редакторе выше.
	</p>
	<div class="ks-fields">
		<div class="ks-row">
		<?php
		$fields = kasatkina_service_fields();
		foreach ( array_slice( $fields, 0, 4, true ) as $name => [ $key, $label, , $hint ] ) :
			?>
			<div>
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="text" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $key, true ) ); ?>" placeholder="<?php echo esc_attr( $hint ); ?>" />
			</div>
		<?php endforeach; ?>
		</div>
		<?php foreach ( array_slice( $fields, 4, null, true ) as $name => [ $key, $label, , $hint ] ) : ?>
			<div>
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<textarea id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="5" placeholder="<?php echo esc_attr( $hint ); ?>"><?php echo esc_textarea( get_post_meta( $post->ID, $key, true ) ); ?></textarea>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function kasatkina_render_service_icon_field( WP_Post $post ): void {
	$current = get_post_meta( $post->ID, '_service_icon', true ) ?: 'sparkles';
	echo '<select name="service_icon" style="width:100%">';
	foreach ( kasatkina_icons() as $key => $icon ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $key ), selected( $current, $key, false ), esc_html( $icon['label'] ) );
	}
	echo '</select><p class="description">Показывается в карточке услуги на главной.</p>';
}

add_action( 'save_post_service', function ( int $post_id ) {
	if ( ! isset( $_POST['kasatkina_service_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['kasatkina_service_nonce'] ), 'kasatkina_save_service_data' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( kasatkina_service_fields() as $name => [ $key ] ) {
		if ( isset( $_POST[ $name ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $name ] ) ) );
		}
	}
	if ( isset( $_POST['service_icon'] ) && array_key_exists( $_POST['service_icon'], kasatkina_icons() ) ) {
		update_post_meta( $post_id, '_service_icon', sanitize_key( $_POST['service_icon'] ) );
	}
} );

// Подсказка над списком услуг в админке.
add_action( 'admin_notices', function () {
	$screen = get_current_screen();
	if ( $screen && 'service' === $screen->post_type && 'edit' === $screen->base ) {
		echo '<div class="notice notice-info"><p><strong>Услуги</strong> автоматически появляются на главной (блок «Наши услуги») и на странице всех услуг. Порядок задаётся полем «Порядок» в карточке услуги (меньше — выше).</p></div>';
	}
} );

/**
 * Строки из многострочного поля услуги.
 */
function kasatkina_service_lines( int $post_id, string $key ): array {
	return array_values( array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $post_id, $key, true ) ) ) ) );
}

/**
 * Запрос услуг в порядке, заданном в админке.
 */
function kasatkina_services_query( array $args = array() ): WP_Query {
	return new WP_Query( array_merge( array(
		'post_type'      => 'service',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		'no_found_rows'  => true,
	), $args ) );
}

/**
 * Карточка услуги.
 *
 * @param string $style 'icon' — компактная карточка с иконкой (главная), 'photo' — с фото и ценой (страница услуг).
 */
function kasatkina_service_card( int $post_id, string $style = 'icon' ): string {
	$title   = get_the_title( $post_id );
	$url     = get_permalink( $post_id );
	$excerpt = wp_trim_words( get_the_excerpt( $post_id ), 18, '…' );
	$price   = (string) get_post_meta( $post_id, '_service_price', true );

	if ( 'photo' === $style ) {
		$thumb = has_post_thumbnail( $post_id )
			? get_the_post_thumbnail( $post_id, 'medium_large', array( 'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105', 'loading' => 'lazy' ) )
			: '<div class="grid h-full w-full place-items-center text-brand">' . kasatkina_icon( get_post_meta( $post_id, '_service_icon', true ) ?: 'sparkles', 40 ) . '</div>';

		return sprintf(
			'<a href="%1$s" class="group flex flex-col overflow-hidden rounded-2xl border border-line/60 bg-white transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
				<div class="aspect-[4/3] overflow-hidden bg-brand-soft">%2$s</div>
				<div class="flex flex-1 flex-col p-6">
					<h3 class="text-lg font-bold text-ink">%3$s</h3>
					<p class="mb-6 mt-2 text-sm leading-relaxed text-ink/65">%4$s</p>
					<div class="mt-auto flex items-center justify-between gap-3 border-t border-line/40 pt-4">
						<span class="text-base font-bold text-brand">%5$s</span>
						<span class="inline-flex items-center gap-1 text-sm font-semibold text-ink/60 transition group-hover:text-brand">Подробнее %6$s</span>
					</div>
				</div>
			</a>',
			esc_url( $url ),
			$thumb,
			esc_html( $title ),
			esc_html( $excerpt ),
			esc_html( $price ),
			kasatkina_icon( 'arrow-right', 16, 'transition group-hover:translate-x-1' )
		);
	}

	return sprintf(
		'<a href="%1$s" class="group relative flex flex-col rounded-2xl border border-line/60 bg-white p-6 sm:p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
			<span class="ks-icon-tile">%2$s</span>
			<span class="mt-5 text-base sm:text-lg font-bold text-ink">%3$s</span>
			<span class="mt-2 text-sm leading-relaxed text-ink/65">%4$s</span>
		</a>',
		esc_url( $url ),
		kasatkina_icon( get_post_meta( $post_id, '_service_icon', true ) ?: 'sparkles', 24 ),
		esc_html( $title ),
		esc_html( $excerpt )
	);
}
