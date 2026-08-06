<?php
/*
Template Name: Страница-конструктор (Без H1 и контейнеров)
Template Post Type: page
*/

get_header(); // Подключаем шапку
?>

    <main class="min-h-screen bg-white">
        <?php
        while ( have_posts() ) :
            the_post();
            // Выводит только паттерны/блоки, без системных H1 и хлебных крошек
            the_content();
        endwhile;
        ?>
    </main>

<?php
get_footer(); // Подключаем подвал
?>