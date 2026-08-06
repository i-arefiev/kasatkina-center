<?php
/**
 * Шаблон для вывода одной услуги
 */
get_header();
?>

    <main class="min-h-screen bg-white font-sans text-[#1E293B] antialiased">
        <?php
        while ( have_posts() ) :
            the_post();

            // Получаем кастомные поля
            $price       = get_post_meta( get_the_ID(), '_service_price', true );
            $duration    = get_post_meta( get_the_ID(), '_service_duration', true );
            $course      = get_post_meta( get_the_ID(), '_service_course', true );
            $pain        = get_post_meta( get_the_ID(), '_service_pain', true );
            $description = get_post_meta( get_the_ID(), '_service_description', true );

            $advantages        = array_filter( array_map( 'trim', explode( "\n", get_post_meta( get_the_ID(), '_service_advantages', true ) ) ) );
            $indications       = array_filter( array_map( 'trim', explode( "\n", get_post_meta( get_the_ID(), '_service_indications', true ) ) ) );
            $contraindications = array_filter( array_map( 'trim', explode( "\n", get_post_meta( get_the_ID(), '_service_contraindications', true ) ) ) );

            // Получаем ЧАВо
            $faq_raw = get_post_meta( get_the_ID(), '_service_faq', true );
            $faqs    = array_filter( array_map( 'trim', explode( "\n", $faq_raw ) ) );
            ?>

            <!-- HERO (ПЕРВЫЙ ЭКРАН) -->
            <section class="relative overflow-hidden border-b border-[rgb(192,192,192)]/30">
                <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_#EBF9F3,_transparent_60%)]"></div>
                <div class="mx-auto max-w-7xl px-6 py-12 lg:py-20">

                    <!-- Хлебные крошки -->
                    <nav class="flex items-center gap-2 text-sm text-[#1E293B]/60">
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-brand">Главная</a>
                        <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?php echo esc_url( home_url('/#services') ); ?>" class="hover:text-brand">Услуги</a>
                        <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-medium text-[#1E293B]"><?php the_title(); ?></span>
                    </nav>

                    <div class="mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]">
                        <!-- Левая колонка Hero -->
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full border border-brand/30 bg-brand-soft px-4 py-1.5 text-xs font-semibold text-brand-hover">
                                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                Физиотерапевтическая процедура
                            </div>

                            <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-[#1E293B] sm:text-5xl lg:text-6xl">
                                <?php the_title(); ?> <span class="text-brand">в Калининграде</span>
                            </h1>

                            <div class="mt-6 max-w-xl text-lg leading-relaxed text-[#1E293B]/70">
                                <?php the_excerpt(); ?>
                            </div>

                            <div class="mt-8 flex flex-wrap items-center gap-3">
                                <a href="#booking" class="inline-flex items-center gap-2 rounded-full bg-brand px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand/30 transition hover:bg-brand-hover">
                                    Записаться на процедуру
                                    <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>

                                <?php if ( $price ) : ?>
                                    <div class="inline-flex items-center gap-2 rounded-full border border-brand bg-white px-5 py-3 text-sm font-bold text-brand">
                                        <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                        <?php echo esc_html( $price ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-[rgb(192,192,192)]/50 pt-6">
                                <?php if ( $duration ) : ?>
                                    <div>
                                        <div class="text-2xl font-bold text-brand"><?php echo esc_html( $duration ); ?></div>
                                        <div class="text-xs text-[#1E293B]/60">минут сеанс</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $course ) : ?>
                                    <div>
                                        <div class="text-2xl font-bold text-brand"><?php echo esc_html( $course ); ?></div>
                                        <div class="text-xs text-[#1E293B]/60">процедур курс</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $pain !== '' ) : ?>
                                    <div>
                                        <div class="text-2xl font-bold text-brand"><?php echo esc_html( $pain ); ?></div>
                                        <div class="text-xs text-[#1E293B]/60">боли и швов</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Правая колонка Hero (Миниатюра записи) -->
                        <div class="relative">
                            <div class="absolute inset-0 -z-10 mx-auto h-[420px] w-[420px] rounded-full bg-brand/20 blur-3xl"></div>
                            <div class="relative overflow-hidden rounded-3xl border border-[rgb(192,192,192)]/60 shadow-2xl shadow-brand/10 bg-white min-h-[300px]">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="<?php the_title_attribute(); ?>" class="h-full w-full object-cover aspect-[4/3] sm:aspect-auto" />
                                <?php else : ?>
                                    <div class="flex h-full w-full items-center justify-center p-10 text-center text-sm text-gray-400">
                                        Установите "Изображение записи" в админке справа, чтобы оно появилось здесь.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- БЛОК "О ПРОЦЕДУРЕ" -->
            <section class="border-b border-[rgb(192,192,192)]/30 bg-white py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="grid gap-12 lg:grid-cols-[1fr_1.2fr] lg:items-start">

                        <!-- Левая часть: Заголовок и Галерея из редактора -->
                        <div>
                            <div class="text-sm font-semibold uppercase tracking-widest text-brand">О процедуре</div>
                            <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">
                                Что такое <?php echo esc_html( mb_strtolower( get_the_title() ) ); ?>
                            </h2>

                            <div class="mt-8 overflow-hidden rounded-3xl border border-[rgb(192,192,192)]/60 bg-white [&_img]:w-full [&_img]:object-cover [&_figure]:m-0">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- Правая часть: Описание и Преимущества -->
                        <div>
                            <?php if ( $description ) : ?>
                                <div class="text-base leading-relaxed text-[#1E293B]/75 space-y-4">
                                    <?php echo wpautop( esc_html( $description ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $advantages ) ) : ?>
                                <div class="mt-8 text-lg font-bold">Преимущества метода</div>
                                <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                                    <?php foreach ( $advantages as $adv ) : ?>
                                        <li class="flex items-start gap-3 rounded-xl border border-[rgb(192,192,192)]/60 bg-white p-4 transition hover:border-brand">
                            <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-brand text-white">
                                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                                            <span class="text-sm font-medium text-[#1E293B]"><?php echo esc_html( $adv ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ПОКАЗАНИЯ И ПРОТИВОПОКАЗАНИЯ -->
            <?php if ( ! empty( $indications ) || ! empty( $contraindications ) ) : ?>
            <section class="border-b border-[rgb(192,192,192)]/30 bg-brand-soft/40 py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="max-w-2xl">
                        <div class="text-sm font-semibold uppercase tracking-widest text-brand">Показания и противопоказания</div>
                        <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">Когда назначают процедуру</h2>
                    </div>

                    <div class="mt-12 grid gap-6 lg:grid-cols-2">
                        <!-- Показания -->
                        <?php if ( ! empty( $indications ) ) : ?>
                            <div class="rounded-3xl border border-brand/30 bg-white p-8 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-brand text-white">
                                        <svg style="width:24px; height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold uppercase tracking-widest text-brand">Показания</div>
                                        <div class="text-xl font-bold">Когда рекомендуется</div>
                                    </div>
                                </div>
                                <ul class="mt-6 space-y-3">
                                    <?php foreach ( $indications as $item ) : ?>
                                        <li class="flex items-start gap-3">
                            <span class="mt-1 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-brand-soft text-brand">
                                <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                                            <span class="text-sm text-[#1E293B]/85"><?php echo esc_html( $item ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Противопоказания -->
                        <?php if ( ! empty( $contraindications ) ) : ?>
                            <div class="rounded-3xl border border-[rgb(192,192,192)]/70 bg-white p-8 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-[#1E293B] text-white">
                                        <svg style="width:24px; height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold uppercase tracking-widest text-[#1E293B]/60">Противопоказания</div>
                                        <div class="text-xl font-bold">Когда не рекомендуется</div>
                                    </div>
                                </div>
                                <ul class="mt-6 space-y-3">
                                    <?php foreach ( $contraindications as $item ) : ?>
                                        <li class="flex items-start gap-3">
                            <span class="mt-1 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-[#1E293B]/10 text-[#1E293B]">
                                <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </span>
                                            <span class="text-sm text-[#1E293B]/85"><?php echo esc_html( $item ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <p class="mt-6 rounded-xl bg-[#1E293B]/[0.04] p-4 text-xs leading-relaxed text-[#1E293B]/70">
                                    Имеются противопоказания. Перед процедурой необходима консультация специалиста.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

            <!-- 4 ШАГА (Статичный блок) -->
            <section class="border-b border-[rgb(192,192,192)]/30 bg-white py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="max-w-2xl">
                        <div class="text-sm font-semibold uppercase tracking-widest text-brand">Как проходит процедура</div>
                        <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">Четыре шага к результату</h2>
                    </div>

                    <div class="relative mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                        <div class="absolute left-0 right-0 top-6 hidden h-px bg-gradient-to-r from-transparent via-brand/40 to-transparent lg:block"></div>

                        <!-- Шаг 1 -->
                        <div class="relative rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
                            <div class="flex items-center justify-between">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand text-white shadow-lg shadow-brand/30">
                                    <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <div class="text-3xl font-black text-brand/20">01</div>
                            </div>
                            <div class="mt-5 text-lg font-bold">Консультация</div>
                            <p class="mt-2 text-sm leading-relaxed text-[#1E293B]/65">Врач оценивает состояние, изучает историю болезни и определяет показания к процедуре.</p>
                        </div>

                        <!-- Шаг 2 -->
                        <div class="relative rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
                            <div class="flex items-center justify-between">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand text-white shadow-lg shadow-brand/30">
                                    <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="text-3xl font-black text-brand/20">02</div>
                            </div>
                            <div class="mt-5 text-lg font-bold">Подготовка</div>
                            <p class="mt-2 text-sm leading-relaxed text-[#1E293B]/65">Составляем индивидуальный план курса: количество сеансов, зоны воздействия, интенсивность.</p>
                        </div>

                        <!-- Шаг 3 -->
                        <div class="relative rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
                            <div class="flex items-center justify-between">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand text-white shadow-lg shadow-brand/30">
                                    <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12h-4l-3 8-4-16-3 8H3"/></svg>
                                </div>
                                <div class="text-3xl font-black text-brand/20">03</div>
                            </div>
                            <div class="mt-5 text-lg font-bold">Проведение сеанса</div>
                            <p class="mt-2 text-sm leading-relaxed text-[#1E293B]/65">Комфортная процедура длительностью 15–30 минут. Пациент не чувствует боли.</p>
                        </div>

                        <!-- Шаг 4 -->
                        <div class="relative rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
                            <div class="flex items-center justify-between">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand text-white shadow-lg shadow-brand/30">
                                    <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="text-3xl font-black text-brand/20">04</div>
                            </div>
                            <div class="mt-5 text-lg font-bold">Наблюдение и результат</div>
                            <p class="mt-2 text-sm leading-relaxed text-[#1E293B]/65">Контроль динамики после каждого сеанса и корректировка курса по необходимости.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ЧАВО (Аккордеон на чистом HTML) -->
            <?php if ( ! empty( $faqs ) ) : ?>
            <section class="border-b border-[rgb(192,192,192)]/30 bg-brand-soft/40 py-20">
                <div class="mx-auto max-w-4xl px-6">
                    <div class="text-center">
                        <div class="text-sm font-semibold uppercase tracking-widest text-brand">Вопросы и ответы</div>
                        <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">Часто задаваемые вопросы</h2>
                    </div>

                    <div class="mt-12 space-y-3">
                        <?php
                        foreach ( $faqs as $faq_line ) :
                            $parts = explode( '|', $faq_line );
                            // Проверяем, что в строке есть и вопрос, и ответ
                            if ( count( $parts ) >= 2 ) :
                                $question = trim( $parts[0] );
                                $answer = trim( $parts[1] );
                                ?>
                                <details class="group overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 bg-white transition hover:border-brand [&_summary::-webkit-details-marker]:hidden open:border-brand open:shadow-lg open:shadow-brand/10">
                                    <summary class="flex w-full cursor-pointer items-center justify-between gap-4 px-6 py-5 text-left outline-none">
                                        <span class="text-base font-semibold text-[#1E293B]"><?php echo esc_html( $question ); ?></span>
                                        <svg class="h-5 w-5 shrink-0 text-brand transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </summary>
                                    <div class="border-t border-[rgb(192,192,192)]/40 px-6 py-5 text-sm leading-relaxed text-[#1E293B]/75">
                                        <?php echo wpautop( esc_html( $answer ) ); ?>
                                    </div>
                                </details>
                            <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

            <!-- ДРУГИЕ УСЛУГИ (Связанные процедуры) -->
            <section class="border-b border-[rgb(192,192,192)]/30 bg-white py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="flex flex-wrap items-end justify-between gap-6">
                        <div>
                            <div class="text-sm font-semibold uppercase tracking-widest text-brand">Другие услуги</div>
                            <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">Также вас может заинтересовать</h2>
                        </div>
                        <a href="<?php echo esc_url( home_url('/#services') ); ?>" class="inline-flex items-center gap-2 rounded-full border border-brand px-5 py-2.5 text-sm font-semibold text-brand transition hover:bg-brand hover:text-white">
                            Все услуги
                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>

                    <div class="mt-12 grid gap-5 md:grid-cols-3">
                        <?php
                        // Запрашиваем 3 случайные другие услуги из базы
                        $related_services = new WP_Query( array(
                            'post_type'      => 'service',
                            'posts_per_page' => 3,
                            'post__not_in'   => array( get_the_ID() ), // Исключаем текущую
                            'orderby'        => 'rand',
                        ) );

                        if ( $related_services->have_posts() ) :
                            while ( $related_services->have_posts() ) : $related_services->the_post();
                                $rel_price = get_post_meta( get_the_ID(), '_service_price', true );
                                ?>
                                <div class="group flex flex-col rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-7 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10">
                                    <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand-soft text-brand transition group-hover:bg-brand group-hover:text-white overflow-hidden">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="" class="h-6 w-6 object-contain" />
                                        <?php else : ?>
                                            <svg style="width:24px; height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-5 text-lg font-bold"><?php the_title(); ?></div>
                                    <div class="mt-2 flex-1 text-sm leading-relaxed text-[#1E293B]/65">
                                        <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                                    </div>
                                    <div class="mt-6 flex items-center justify-between border-t border-[rgb(192,192,192)]/40 pt-4">
                                        <span class="text-sm font-bold text-brand"><?php echo esc_html( $rel_price ); ?></span>
                                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-[#1E293B] transition hover:text-brand">
                                            Записаться
                                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else:
                            ?>
                            <p class="text-sm text-gray-400">Добавьте больше услуг в админке, чтобы они появились здесь.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- БЛОК ЗАПИСИ НА КОНСУЛЬТАЦИЮ -->
            <section id="booking" class="border-b border-[rgb(192,192,192)]/30 bg-white py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="max-w-2xl">
                        <div class="text-sm font-semibold uppercase tracking-widest text-brand">Запись</div>
                        <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">Запишитесь на консультацию</h2>
                        <p class="mt-4 text-[#1E293B]/70">Оставьте заявку — мы свяжемся с вами в течение рабочего дня, ответим на вопросы и подберём удобное время.</p>
                    </div>

                    <div class="mt-12 grid gap-8 lg:grid-cols-2">
                        <!-- Левая часть: Контакты и лицензия -->
                        <div class="space-y-6">
                            <div class="grid gap-4 rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-6 sm:grid-cols-2">
                                <div class="flex items-start gap-3">
                                    <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-soft text-brand">
                                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Адрес</div>
                                        <div class="mt-1 text-sm font-medium">г. Калининград, ул. Уральская, д. 20, пом. 4</div>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-soft text-brand">
                                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Телефоны</div>
                                        <a href="tel:+79211024686" class="mt-1 block text-sm font-medium hover:text-brand">+7 (921) 102-46-86</a>
                                        <a href="tel:+74012526699" class="block text-sm font-medium hover:text-brand">+7 (4012) 52-66-99</a>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 sm:col-span-2">
                                    <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-soft text-brand">
                                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Email</div>
                                        <a href="mailto:info@kasatkina-center.ru" class="mt-1 block text-sm font-medium hover:text-brand">info@kasatkina-center.ru</a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-2xl border border-brand/30 bg-brand-soft/60 p-5">
                                <svg style="width:20px;height:20px;" class="mt-0.5 shrink-0 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <p class="text-xs leading-relaxed text-[#1E293B]/75">
                                    Медицинская лицензия Л041-01157-39/00638809 от 25.01.2023 г. Имеются противопоказания, необходима консультация специалиста.
                                </p>
                            </div>
                        </div>

                        <!-- Правая часть: Форма -->
                        <form action="#" method="post" onsubmit="event.preventDefault();" class="rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-6">
                            <div class="text-lg font-bold">Записаться на <?php echo esc_html( mb_strtolower( get_the_title() ) ); ?></div>
                            <p class="mt-1 text-sm text-[#1E293B]/60">Мы свяжемся с Вами в течение рабочего дня.</p>

                            <div class="mt-5 grid gap-3">
                                <input type="text" placeholder="Ваше имя" required class="rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-brand focus:ring-2 focus:ring-brand/20" />
                                <input type="tel" placeholder="Телефон" required class="rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-brand focus:ring-2 focus:ring-brand/20" />
                                <textarea placeholder="Комментарий (по желанию)" rows="3" class="resize-none rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-brand focus:ring-2 focus:ring-brand/20"></textarea>

                                <button type="submit" class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-brand px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-hover">
                                    Отправить заявку
                                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>

                                <p class="text-xs text-[#1E293B]/50 text-center mt-2">
                                    Нажимая «Отправить», вы соглашаетесь на обработку персональных данных.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        <?php endwhile; ?>
    </main>

<?php get_footer(); ?>