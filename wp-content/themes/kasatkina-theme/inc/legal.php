<?php
/**
 * Персональные данные и правовая информация (152-ФЗ):
 *  — реквизиты оператора (Настроить → «Реквизиты (оператор персональных данных)») и блок «Реквизиты оператора»;
 *  — ссылки на политику, согласие и правовую информацию (формы, подвал);
 *  — плашка о cookies и Яндекс.Метрике.
 * Тексты страниц — паттерны kasatkina/legal-* (создаются мастером «Настройка сайта»).
 */

defined( 'ABSPATH' ) || exit;

/**
 * Реквизиты оператора: ключ => [ подпись, значение по умолчанию, тип ].
 * Значения по умолчанию — из реестра операторов ПДн Роскомнадзора (рег. № 39-25-012889).
 */
function kasatkina_operator_fields(): array {
	return array(
		'org_name'       => array( 'Полное наименование', 'Общество с ограниченной ответственностью «Гармония»', 'text' ),
		'org_short'      => array( 'Краткое наименование', 'ООО «Гармония»', 'text' ),
		'org_inn'        => array( 'ИНН', '3906413796', 'text' ),
		'org_ogrn'       => array( 'ОГРН', '', 'text' ),
		'org_address'    => array( 'Юридический адрес', '236022, Калининградская область, г. Калининград, ул. Уральская, д. 20, помещ. 4', 'textarea' ),
		'rkn_number'     => array( 'Регистрационный номер в реестре операторов ПДн', '39-25-012889', 'text' ),
		'pd_responsible' => array( 'Ответственный за организацию обработки ПДн', 'Бочарова Наталия Николаевна', 'text' ),
		'pd_email'       => array( 'Почта для обращений по персональным данным (пусто — основная почта сайта)', '', 'email' ),
		'pd_retention'   => array( 'Срок хранения заявок с сайта', 'не более 1 (одного) года с момента получения заявки, если с пациентом не заключён договор', 'text' ),
	);
}

/**
 * Почта для обращений по персональным данным.
 */
function kasatkina_pd_email(): string {
	return kasatkina_opt( 'pd_email' ) ?: kasatkina_opt( 'email' );
}

/**
 * Строки реквизитов для вывода: [ подпись, значение ].
 */
function kasatkina_operator_rows(): array {
	$rows = array(
		array( 'Оператор', kasatkina_opt( 'org_name' ) ),
		array( 'ИНН', kasatkina_opt( 'org_inn' ) ),
		array( 'ОГРН', kasatkina_opt( 'org_ogrn' ) ),
		array( 'Адрес', kasatkina_opt( 'org_address' ) ),
		array( 'Номер в реестре операторов персональных данных', kasatkina_opt( 'rkn_number' ) ),
		array( 'Ответственный за организацию обработки персональных данных', kasatkina_opt( 'pd_responsible' ) ),
		array( 'Электронная почта для обращений', kasatkina_pd_email() ),
		array( 'Телефон', kasatkina_opt( 'phone' ) ),
	);
	return array_values( array_filter( $rows, fn( $r ) => '' !== trim( $r[1] ) ) );
}

/**
 * Адрес страницы по ярлыку (или пустая строка, если её нет).
 */
function kasatkina_page_link( string $path ): string {
	$page = get_page_by_path( $path );
	return $page && 'publish' === $page->post_status ? get_permalink( $page ) : '';
}

/**
 * Ссылки на юридические страницы: [ текст => адрес ].
 */
function kasatkina_legal_links(): array {
	return array_filter( array(
		'Политика обработки персональных данных'    => get_privacy_policy_url(),
		'Согласие на обработку персональных данных' => kasatkina_page_link( 'soglasie' ),
		'Правовая информация'                       => kasatkina_page_link( 'pravovaya-informaciya' ),
	) );
}

/**
 * Плашка о cookies: показывается, пока посетитель не нажмёт «Понятно».
 */
add_action( 'wp_footer', function () {
	$policy = get_privacy_policy_url();
	?>
	<div id="ks-cookie" class="ks-cookie" role="region" aria-label="Уведомление о cookies" hidden>
		<p>
			Мы используем файлы cookie и сервис Яндекс.Метрика, чтобы сайт работал корректно и становился удобнее.
			Продолжая пользоваться сайтом, вы соглашаетесь с этим<?php if ( $policy ) : ?> и с <a href="<?php echo esc_url( $policy ); ?>">политикой обработки персональных данных</a><?php endif; ?>.
		</p>
		<button type="button" class="ks-btn" data-ks-cookie-ok>Понятно</button>
	</div>
	<?php
} );
