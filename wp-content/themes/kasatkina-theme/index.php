<?php
get_header();
?>

    <main class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            else :
                echo '<p class="text-slate-500">Контент не найден.</p>';
            endif;
            ?>
        </div>
    </main>

<?php
get_footer();