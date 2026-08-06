<?php
get_header(); // Подключает header.php
?>

    <main class="min-h-screen bg-white py-10 lg:py-16">
        <div class="mx-auto max-w-7xl px-6">

            <!-- 1. Хлебные крошки (Breadcrumbs) -->
            <nav class="mb-6 flex items-center gap-2 text-xs text-[#1E293B]/60" aria-label="Breadcrumb">
                <?php
                if ( function_exists( 'bcn_display' ) ) {
                    bcn_display();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="transition hover:text-[#3BC68B]">Главная</a>
                    <span>/</span>
                    <span class="font-medium text-[#1E293B]"><?php the_title(); ?></span>
                <?php } ?>
            </nav>

            <!-- 2. Стандартный заголовок внутренней страницы (H1) -->
            <header class="mb-10 border-b border-[rgb(192,192,192)]/40 pb-6">
                <h1 class="text-3xl font-extrabold tracking-tight text-[#1E293B] sm:text-4xl lg:text-5xl">
                    <?php the_title(); ?>
                </h1>
            </header>

            <!-- 3. Контент страницы (собирается из любых Паттернов или обычного текста) -->
            <article class="prose max-w-none text-[#1E293B]">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </article>

        </div>
    </main>

<?php
get_footer(); // Подключает footer.php
?>