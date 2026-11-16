<?php
/**
 * Тема «Центр физиотерапии доктора Касаткиной».
 *
 * Код разнесён по файлам в папке inc/:
 *   setup.php         — поддержка возможностей WP, меню, подключение стилей и скриптов
 *   icons.php         — набор SVG-иконок (используется блоком «Иконка» и шаблонами)
 *   customizer.php    — контакты, лицензия, карта и прочие общие тексты (Внешний вид → Настроить)
 *   template-tags.php — хлебные крошки и мелкие функции для шаблонов
 *   services.php      — тип записей «Услуги», категории и поля карточки
 *   requests.php      — приём заявок с форм (раздел «Заявки» в админке + письмо на почту)
 *   blocks.php        — собственные блоки темы, стили блоков, категория паттернов
 *   seo.php           — Метрика, вебмастера, разметка организации, мета-описание, адреса статей
 *   legal.php         — реквизиты оператора ПДн, ссылки на политику и согласие, плашка о cookies
 *   site-setup.php    — страница «Внешний вид → Настройка сайта» (создание страниц из паттернов)
 *   admin-help.php    — подсказки для администратора в консоли
 */

defined( 'ABSPATH' ) || exit;

define( 'KASATKINA_VERSION', '2.1.0' );
define( 'KASATKINA_DIR', get_template_directory() );
define( 'KASATKINA_URI', get_template_directory_uri() );

foreach ( array( 'setup', 'icons', 'customizer', 'template-tags', 'services', 'requests', 'blocks', 'seo', 'legal', 'site-setup', 'admin-help' ) as $kasatkina_file ) {
	require_once KASATKINA_DIR . '/inc/' . $kasatkina_file . '.php';
}
