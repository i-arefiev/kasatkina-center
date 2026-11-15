<?php
/**
 * Короткая памятка для администратора на главной странице консоли.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_dashboard_setup', function () {
	wp_add_dashboard_widget( 'kasatkina_help', 'Как редактировать сайт', function () {
		$links = array(
			array( 'Тексты и фото на страницах', admin_url( 'edit.php?post_type=page' ), 'Откройте страницу и кликните по нужному тексту или картинке. Картинку можно заменить кнопкой «Заменить» на панели над ней.' ),
			array( 'Добавить секцию', admin_url( 'edit.php?post_type=page' ), 'В редакторе страницы: «+» → вкладка «Паттерны» → «Касаткина: блоки сайта».' ),
			array( 'Услуги', admin_url( 'edit.php?post_type=service' ), 'Цены, показания, вопросы-ответы. Новые услуги сами появляются на главной и в списке услуг.' ),
			array( 'Статьи', admin_url( 'edit.php' ), 'Обычные записи WordPress. Обложка — «Изображение записи».' ),
			array( 'Контакты, лицензия, карта', admin_url( 'customize.php?autofocus[section]=kasatkina_contacts' ), 'Меняются в одном месте — и сразу везде на сайте.' ),
			array( 'Меню', admin_url( 'nav-menus.php' ), 'Пункты меню в шапке и подвале.' ),
			array( 'Заявки с сайта', admin_url( 'edit.php?post_type=ks_request' ), 'Все заявки с форм. Они также приходят на почту.' ),
		);
		echo '<ul>';
		foreach ( $links as [ $title, $url, $text ] ) {
			printf( '<li style="margin-bottom:10px"><a href="%s"><strong>%s</strong></a><br><span style="color:#50575e">%s</span></li>', esc_url( $url ), esc_html( $title ), esc_html( $text ) );
		}
		echo '</ul>';
	} );
} );
