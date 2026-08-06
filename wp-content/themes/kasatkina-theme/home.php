<?php

/**
 * Template Name: Список статей
 */
get_header();
?>

    <main class="min-h-screen bg-white font-sans text-[#1E293B] antialiased">

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-b from-[#EBF9F3]/60 to-white pt-10 pb-16 md:pt-14 md:pb-24">
            <div class="mx-auto max-w-7xl px-6">
                <nav aria-label="Хлебные крошки" class="mb-6 md:mb-8">
                    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                        <li><a href="<?php echo esc_url( home_url('/') ); ?>" class="transition hover:text-[#3BC68B]">Главная</a></li>
                        <li><svg style="width:16px; height:16px;" class="text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li aria-current="page" class="font-medium text-slate-900">Статьи</li>
                    </ol>
                </nav>

                <div class="max-w-3xl">
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 md:text-5xl lg:text-6xl">
                        Полезные <span class="text-[#3BC68B]">статьи</span>
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 md:text-lg">
                        Материалы о здоровье, физиотерапии, методах восстановления и психологической поддержке от специалистов нашего центра.
                    </p>
                </div>
            </div>
        </section>

        <!-- Сетка статей -->
        <section class="py-16 md:py-20 bg-white">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $articles_query = new WP_Query( array(
                        'post_type'      => 'post',
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                    ) );

                    if ( $articles_query->have_posts() ) :
                        while ( $articles_query->have_posts() ) : $articles_query->the_post();
                            ?>
                            <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white transition-all hover:-translate-y-1 hover:shadow-xl">
                                <div class="overflow-hidden bg-slate-100 aspect-[16/9]">
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
                                    <div class="flex items-center gap-2 text-xs font-semibold text-[#3BC68B] mb-2">
                                        <span><?php echo get_the_date('d.m.Y'); ?></span>
                                    </div>

                                    <h2 class="text-lg font-bold text-slate-900 group-hover:text-[#3BC68B] transition">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-500">
                                        <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                                    </p>

                                    <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100">
                                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-slate-700 transition group-hover:text-[#3BC68B]">
                                            Читать далее
                                            <svg style="width:16px;height:16px;" class="transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p class="text-slate-500 col-span-full">Статей пока нет.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </main>

<?php get_footer(); ?>