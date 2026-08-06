<?php
get_header();

// Выводит все блоки (Hero, Услуги и т.д.), добавленные на Главную страницу в админке
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
endif;

get_footer();