<?php

function kasatkina_enqueue_scripts() {
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);
}
add_action('wp_enqueue_scripts', 'kasatkina_enqueue_scripts');

add_theme_support( 'post-thumbnails' );
function kasatkina_tailwind_config() {
    ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#3BC68B',
                            hover: '#2EB078',
                            dark: '#2EB078',
                            soft: '#EBF9F3', // Мягкий мятный фон для градиентов
                        },
                    }
                }
            }
        }
    </script>
    <?php
}
add_action('wp_head', 'kasatkina_tailwind_config');

// Регистрируем родной паттерн для Главного экрана
function kasatkina_register_hero_pattern() {
$template_path = get_template_directory() . '/blocks/hero/hero.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );

        // Автоматически подставляем правильный URL папки вашей темы
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/hero-pattern',
            array(
                'title'       => 'Главный экран (Hero Kasatkina)',
                'description' => 'Первый экран сайта доктора Касаткиной',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_hero_pattern');

// Регистрируем паттерн Услуги
function kasatkina_register_services_pattern() {
    $template_path = get_template_directory() . '/blocks/services/services.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/services-pattern',
            array(
                'title'       => 'Наши услуги (Services Kasatkina)',
                'description' => 'Блок с карточками услуг и видео-экскурсией',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_services_pattern');


// Регистрируем паттерн Показания
function kasatkina_register_indications_pattern() {
    $template_path = get_template_directory() . '/blocks/indications/indications.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/indications-pattern',
            array(
                'title'       => 'Показания (Indications Kasatkina)',
                'description' => 'Блок с показаниями к применению процедур',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_indications_pattern');

// Регистрируем паттерн СМИ о нас
function kasatkina_register_media_pattern() {
    $template_path = get_template_directory() . '/blocks/media/media.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/media-pattern',
            array(
                'title'       => 'СМИ о нас (Media Kasatkina)',
                'description' => 'Блок с публикациями в СМИ',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_media_pattern');


// Регистрируем паттерн О медцентре
function kasatkina_register_about_pattern() {
    $template_path = get_template_directory() . '/blocks/about/about.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/about-pattern',
            array(
                'title'       => 'О медцентре (About Kasatkina)',
                'description' => 'Блок с преимуществами центра доктора Касаткиной',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_about_pattern');

// Регистрируем паттерн Выезд на дом
function kasatkina_register_house_calls_pattern() {
    $template_path = get_template_directory() . '/blocks/house-calls/house-calls.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/house-calls-pattern',
            array(
                'title'       => 'Выезд на дом (House Calls Kasatkina)',
                'description' => 'Блок про выездное оборудование и услугу помощи на дому',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_house_calls_pattern');


// Регистрируем паттерн Контакты
function kasatkina_register_contacts_pattern() {
    $template_path = get_template_directory() . '/blocks/contacts/contacts.php';

    if ( file_exists( $template_path ) ) {
        $content = file_get_contents( $template_path );
        $theme_uri = get_template_directory_uri();
        $content   = str_replace( '{{THEME_URI}}', $theme_uri, $content );

        register_block_pattern(
            'kasatkina/contacts-pattern',
            array(
                'title'       => 'Контакты (Contacts Kasatkina)',
                'description' => 'Блок контактов с формой заявки и картой',
                'categories'  => array('featured', 'design'),
                'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
            )
        );
    }
}
add_action('init', 'kasatkina_register_contacts_pattern');

// Единая типографика для всех внутренних страниц
function kasatkina_custom_typography_styles() {
    ?>
    <style>
        article h2 { font-size: 1.875rem; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; color: #1E293B; }
        article h3 { font-size: 1.5rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #1E293B; }
        article p { margin-bottom: 1.25rem; line-height: 1.7; color: rgba(30, 41, 59, 0.8); }
        article ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.25rem; }
    </style>
    <?php
}
add_action('wp_head', 'kasatkina_custom_typography_styles');



// Регистрируем область меню темы
function kasatkina_register_menus() {
    register_nav_menus( array(
            'primary' => 'Главное меню (Header)',
    ) );
}
add_action( 'after_setup_theme', 'kasatkina_register_menus' );


// Фильтр для добавления кастомных классов к ссылкам меню
function kasatkina_nav_menu_css_class( $classes, $item, $args ) {
    if ( isset( $args->add_li_class ) ) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'kasatkina_nav_menu_css_class', 10, 3 );


// Включаем поддержку кастомного логотипа
function kasatkina_setup_theme() {
    add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
    ) );

    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'kasatkina_setup_theme' );

/// Регистрируем паттерн Hero для страницы "О медцентре"
function kasatkina_register_hero_aboutcenter_pattern() {
    $file_path = get_template_directory() . '/blocks/hero-aboutcenter/hero-aboutcenter.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );

        // Заменяем динамические переменные
        $content = str_replace( '{{THEME_URI}}', get_template_directory_uri(), $content );
        $content = str_replace( '{{HOME_URL}}', esc_url( home_url('/') ), $content );

        register_block_pattern(
                'kasatkina/hero-aboutcenter-pattern',
                array(
                        'title'       => 'Hero: О медцентре (Hero About Center)',
                        'description' => 'Первый экран для страницы О медцентре',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_hero_aboutcenter_pattern');


// Регистрируем паттерн "Миссия и Преимущества"
function kasatkina_register_mission_pattern() {
    $file_path = get_template_directory() . '/blocks/mission/mission.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );
        $content = str_replace( '{{THEME_URI}}', get_template_directory_uri(), $content );

        register_block_pattern(
                'kasatkina/mission-pattern',
                array(
                        'title'       => 'Миссия и Преимущества (Mission)',
                        'description' => 'Блок с миссией клиники, преимуществами и сеткой фотографий',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_mission_pattern');

// Регистрируем паттерн "Комплексный подход (Approach)"
function kasatkina_register_approach_pattern() {
    $file_path = get_template_directory() . '/blocks/approach/approach.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );

        register_block_pattern(
                'kasatkina/approach-pattern',
                array(
                        'title'       => 'Баннер: Комплексный подход (Approach Banner)',
                        'description' => 'Баннер с описанием синтеза физиотерапии и психологии',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_approach_pattern');

// Регистрируем паттерн "Оборудование и стандарты"
function kasatkina_register_equipment_pattern() {
    $file_path = get_template_directory() . '/blocks/equipment/equipment.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );

        register_block_pattern(
                'kasatkina/equipment-pattern',
                array(
                        'title'       => 'Оборудование и стандарты (Equipment)',
                        'description' => 'Блок с карточками используемого медоборудования',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_equipment_pattern');


// Регистрируем паттерн "Лицензии и документы"
function kasatkina_register_licenses_pattern() {
    $file_path = get_template_directory() . '/blocks/licenses/licenses.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );

        register_block_pattern(
                'kasatkina/licenses-pattern',
                array(
                        'title'       => 'Лицензии и правовая информация (Licenses)',
                        'description' => 'Интерактивный блок с документами и всплывающим окном',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_licenses_pattern');


// Регистрируем паттерн "Галерея"
function kasatkina_register_gallery_pattern() {
    $file_path = get_template_directory() . '/blocks/gallery/gallery.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );
        $content = str_replace( '{{THEME_URI}}', get_template_directory_uri(), $content );

        register_block_pattern(
                'kasatkina/gallery-pattern',
                array(
                        'title'       => 'Галерея клиники (Gallery)',
                        'description' => 'Асимметричная галерея фото с просмотром во весь экран',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_gallery_pattern');

// Регистрируем паттерн "Форма записи"
function kasatkina_register_booking_pattern() {
    $file_path = get_template_directory() . '/blocks/booking/booking.php';

    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );

        register_block_pattern(
                'kasatkina/booking-pattern',
                array(
                        'title'       => 'Форма записи на прием (Booking Form)',
                        'description' => 'Блок с формой записи и правовой информацией',
                        'categories'  => array('featured', 'design'),
                        'content'     => '<!-- wp:html -->' . $content . '<!-- /wp:html -->',
                )
        );
    }
}
add_action('init', 'kasatkina_register_booking_pattern');


// Пробрасываем кастомные цвета Tailwind (brand, brand-soft) в шапку админки
function kasatkina_admin_editor_styles() {
    ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#3BC68B',
                            hover: '#2EB078',
                            dark: '#2EB078',
                            soft: '#EBF9F3',
                        },
                    }
                }
            }
        }
    </script>
    <?php
}
add_action('admin_head', 'kasatkina_admin_editor_styles');




// Добавляем описание-подсказку на страницу списка Услуг в админке
function kasatkina_add_services_admin_description() {
    $screen = get_current_screen();

    // Проверяем, что находимся именно в разделе "Услуги"
    if ( $screen && $screen->post_type === 'service' && $screen->base === 'edit' ) {
        echo '<div class="notice notice-info inline my-4" style="margin-top: 15px; padding: 12px 15px; border-left-color: #3BC68B;">
            <p style="margin: 0; font-size: 13px; color: #1E293B;">
                <strong>💡 Раздел «Услуги»:</strong> Здесь вы можете управлять списком медицинских процедур и направлений. Все созданные услуги автоматически отображаются на сайте в соответствующем блоке.
            </p>
        </div>';
    }
}
add_action( 'admin_notices', 'kasatkina_add_services_admin_description' );


// 1. Регистрируем Custom Post Type "Услуги"
function kasatkina_register_services_cpt() {
    $labels = array(
            'name'               => 'Услуги',
            'singular_name'      => 'Услуга',
            'add_new'            => 'Добавить услугу',
            'add_new_item'       => 'Добавить новую услугу',
            'edit_item'          => 'Редактировать услугу',
            'new_item'           => 'Новая услуга',
            'view_item'          => 'Просмотреть услугу',
            'search_items'       => 'Искать услуги',
            'not_found'          => 'Услуг не найдено',
            'menu_name'          => 'Услуги',
    );

    $args = array(
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => false,
            'menu_icon'          => 'dashicons-plus-alt2',
            'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'show_in_rest'       => true,
            'rewrite'      => array( 'slug' => 'services', 'with_front' => false ),
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'kasatkina_register_services_cpt' );

// 2. Регистрируем блок с полями для Услуг
function kasatkina_add_service_metaboxes() {
    add_meta_box(
            'service_data_fields',
            'Информация об услуге (Данные для карточки)',
            'kasatkina_render_service_fields',
            'service',
            'normal',
            'high'
    );
}
add_action( 'add_meta_boxes', 'kasatkina_add_service_metaboxes' );


// 3. Верстка полей в админке
function kasatkina_render_service_fields( $post ) {
    wp_nonce_field( 'kasatkina_save_service_data', 'kasatkina_service_nonce' );

    $price    = get_post_meta( $post->ID, '_service_price', true );
    $duration = get_post_meta( $post->ID, '_service_duration', true );
    $course   = get_post_meta( $post->ID, '_service_course', true );
    $pain     = get_post_meta( $post->ID, '_service_pain', true );
    $desc     = get_post_meta( $post->ID, '_service_description', true );
    $adv      = get_post_meta( $post->ID, '_service_advantages', true );
    $ind      = get_post_meta( $post->ID, '_service_indications', true );
    $contra   = get_post_meta( $post->ID, '_service_contraindications', true );
    $faq      = get_post_meta( $post->ID, '_service_faq', true ); // <-- Новое поле ЧАВо
    ?>
    <style>
        .ks-field-group { margin-bottom: 15px; }
        .ks-field-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .ks-field-group input, .ks-field-group textarea { width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 6px 10px; }
        .ks-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; }
    </style>

    <div class="ks-grid">
        <div class="ks-field-group">
            <label>Стоимость:</label>
            <input type="text" name="service_price" value="<?php echo esc_attr( $price ); ?>" placeholder="Например: от 1 200 ₽ / сеанс" />
        </div>
        <div class="ks-field-group">
            <label>Длительность сеанса (мин):</label>
            <input type="text" name="service_duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="Например: 15–30" />
        </div>
        <div class="ks-field-group">
            <label>Курс процедур:</label>
            <input type="text" name="service_course" value="<?php echo esc_attr( $course ); ?>" placeholder="Например: 8–12" />
        </div>
        <div class="ks-field-group">
            <label>Уровень боли (или текст):</label>
            <input type="text" name="service_pain" value="<?php echo esc_attr( $pain ); ?>" placeholder="Например: 0" />
        </div>
    </div>

    <div class="ks-field-group">
        <label>Главное описание процедуры (выводится под заголовком):</label>
        <textarea name="service_description" rows="5" placeholder="Лазеротерапия — это современный метод..."><?php echo esc_textarea( $desc ); ?></textarea>
    </div>

    <div class="ks-field-group">
        <label>Преимущества метода (каждое с новой строки):</label>
        <textarea name="service_advantages" rows="4" placeholder="Безболезненная процедура...&#10;Ускоряет регенерацию..."><?php echo esc_textarea( $adv ); ?></textarea>
    </div>

    <div class="ks-field-group">
        <label>Показания (каждое с новой строки):</label>
        <textarea name="service_indications" rows="5"><?php echo esc_textarea( $ind ); ?></textarea>
    </div>

    <div class="ks-field-group">
        <label>Противопоказания (каждое с новой строки):</label>
        <textarea name="service_contraindications" rows="5"><?php echo esc_textarea( $contra ); ?></textarea>
    </div>

    <!-- БЛОК ЧАВо -->
    <div class="ks-field-group">
        <label style="color: #007cba;">Вопросы и ответы (ЧАВо).<br>Разделяйте вопрос и ответ знаком вертикальной черты <b>|</b> , каждую новую пару пишите с новой строки:</label>
        <textarea name="service_faq" rows="6" placeholder="Сколько длится сеанс? | От 15 до 30 минут.&#10;Больно ли это? | Нет, процедура абсолютно безболезненна."><?php echo esc_textarea( $faq ); ?></textarea>
    </div>

    <p class="description">В главный стандартный редактор сверху вставляйте <strong>только блок «Галерея»</strong> с фотографиями.</p>
    <?php
}

// 4. Сохранение данных в базу
function kasatkina_save_service_data( $post_id ) {
    if ( ! isset( $_POST['kasatkina_service_nonce'] ) || ! wp_verify_nonce( $_POST['kasatkina_service_nonce'], 'kasatkina_save_service_data' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
            'service_price'           => '_service_price',
            'service_duration'        => '_service_duration',
            'service_course'          => '_service_course',
            'service_pain'            => '_service_pain',
            'service_description'     => '_service_description',
            'service_advantages'      => '_service_advantages',
            'service_indications'     => '_service_indications',
            'service_contraindications'=> '_service_contraindications',
            'service_faq'             => '_service_faq', // <-- Сохраняем ЧАВо в базу
    ];

    foreach ( $fields as $post_key => $meta_key ) {
        if ( isset( $_POST[ $post_key ] ) ) {
            $value = sanitize_textarea_field( $_POST[ $post_key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
}
add_action( 'save_post_service', 'kasatkina_save_service_data' );


// Регистрируем категории для услуг
function kasatkina_register_service_categories() {
    register_taxonomy( 'service_category', 'service', array(
            'label'             => 'Категории услуг',
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
    ) );
}
add_action( 'init', 'kasatkina_register_service_categories' );


// Добавляем отдельный загрузчик логотипа для подвала
function kasatkina_footer_logo_customizer( $wp_customize ) {
    $wp_customize->add_setting( 'footer_logo' );

    // Добавляем контрол в стандартный раздел "Свойства сайта" (title_tagline)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
            'label'    => 'Логотип для подвала (белый PNG)',
            'section'  => 'title_tagline',
            'settings' => 'footer_logo',
    ) ) );
}
add_action( 'customize_register', 'kasatkina_footer_logo_customizer' );