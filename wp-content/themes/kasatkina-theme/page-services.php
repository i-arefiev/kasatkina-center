<?php
/**
 * Template Name: Страница всех услуг
 */
get_header();
?>

    <main class="min-h-screen bg-white font-sans text-[#1E293B] antialiased">

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-b from-[#EBF9F3]/60 to-white pt-10 pb-16 md:pt-14 md:pb-24">
            <div class="pointer-events-none absolute -top-20 right-1/4 h-80 w-80 rounded-full bg-[#3BC68B]/10 blur-3xl md:h-96 md:w-96"></div>
            <div class="pointer-events-none absolute bottom-0 left-1/4 h-64 w-64 rounded-full bg-[#3BC68B]/10 blur-3xl md:h-80 md:w-80"></div>

            <div class="relative mx-auto max-w-7xl px-6">
                <nav aria-label="Хлебные крошки" class="mb-6 md:mb-8">
                    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                        <li><a href="<?php echo esc_url( home_url('/') ); ?>" class="transition hover:text-[#3BC68B]">Главная</a></li>
                        <li><svg style="width:16px; height:16px;" class="text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li aria-current="page" class="font-medium text-slate-900">Услуги</li>
                    </ol>
                </nav>

                <div class="max-w-3xl">
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 md:text-5xl lg:text-6xl">
                        Услуги нашего <span class="text-[#3BC68B]">центра</span>
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 md:text-lg">
                        Современные физиотерапевтические методики и психологическая помощь, подобранные индивидуально под ваш диагноз, возраст и цели восстановления.
                    </p>
                </div>
            </div>
        </section>

        <!-- Intro Text -->
        <section class="mx-auto max-w-4xl px-6 py-16 md:py-20">
            <p class="text-base leading-relaxed text-slate-700 md:text-lg">
                В Центре физиолечения и психоконсультирования доктора Касаткиной мы применяем современные физиотерапевтические методики, которые помогают организму восстановиться после болезней, травм и операций. Каждая процедура подбирается индивидуально, с учётом диагноза, возраста и общего состояния пациента.
            </p>
            <p class="mt-4 text-base leading-relaxed text-slate-700 md:text-lg">
                Мы не используем универсальные протоколы: сначала врач проводит консультацию, оценивает показания и только после этого составляет персональный курс лечения. Такой подход позволяет достичь устойчивого результата при минимальной нагрузке на организм.
            </p>
        </section>

        <!-- Вывод услуг по категориям -->
        <?php
        // Получаем все категории услуг
        $categories = get_terms( array(
                'taxonomy'   => 'service_category',
                'hide_empty' => true, // Скрываем пустые категории
        ) );

        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
            foreach ( $categories as $category ) :
                ?>
                <section class="border-t border-slate-100 bg-white py-16 md:py-20">
                    <div class="mx-auto max-w-7xl px-6">
                        <!-- Заголовок категории (например: Физиотерапия, Психоконсультирование) -->
                        <h2 class="text-left text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">
                            <?php echo esc_html( $category->name ); ?>
                        </h2>

                        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <?php
                            // Запрашиваем услуги, которые принадлежат текущей категории
                            $services_query = new WP_Query( array(
                                    'post_type'      => 'service',
                                    'posts_per_page' => -1,
                                    'tax_query'      => array(
                                            array(
                                                    'taxonomy' => 'service_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $category->term_id,
                                            ),
                                    ),
                            ) );

                            if ( $services_query->have_posts() ) :
                                while ( $services_query->have_posts() ) : $services_query->the_post();
                                    $price = get_post_meta( get_the_ID(), '_service_price', true );
                                    ?>
                                    <a
                                            href="<?php the_permalink(); ?>"
                                            class="group flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white transition-all hover:-translate-y-1 hover:shadow-xl"
                                    >
                                        <div class="overflow-hidden bg-slate-100 aspect-[4/3]">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <img
                                                        src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>"
                                                        alt="<?php the_title_attribute(); ?>"
                                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                />
                                            <?php else : ?>
                                                <div class="flex h-full w-full items-center justify-center text-slate-400 text-sm">Нет фото</div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex flex-1 flex-col p-6">
                                            <h3 class="text-lg font-bold text-slate-900"><?php the_title(); ?></h3>
                                            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-500">
                                                <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                                            </p>

                                            <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-4">
                                                <span class="text-lg font-bold text-[#3BC68B]"><?php echo esc_html( $price ); ?></span>
                                                <span class="inline-flex items-center gap-1 text-sm font-semibold text-slate-500 transition group-hover:text-[#3BC68B]">
                                Подробнее
                                <svg style="width:16px;height:16px;" class="transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </section>
            <?php
            endforeach;
        else :
            ?>
            <div class="mx-auto max-w-7xl px-6 py-20 text-center text-slate-500">
                Создайте категории услуг в админке и привяжите к ним карточки.
            </div>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>