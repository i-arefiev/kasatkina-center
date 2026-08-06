<?php
/**
 * Template Name: Шаблон отдельной статьи
 * Template Post Type: post
 */
get_header();
?>

    <main class="min-h-screen bg-white font-sans text-[#1E293B] antialiased">

        <?php while ( have_posts() ) : the_post();
            // Получаем данные автора (если заполнено имя в профиле)
            $author_name = get_the_author_meta( 'display_name' ) ? get_the_author_meta( 'display_name' ) : 'Доктор Н. Н. Касаткина';
            ?>

            <!-- Article header -->
            <section class="relative overflow-hidden border-b border-[rgb(192,192,192)]/30">
                <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--brand-soft),_transparent_60%)]"></div>
                <div class="mx-auto max-w-4xl px-6 py-12 lg:py-16">

                    <!-- Хлебные крошки -->
                    <nav class="flex items-center gap-1.5 text-sm text-[#1E293B]/60">
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-brand">Главная</a>
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                        <a href="<?php echo esc_url( home_url('/articles/') ); ?>" class="hover:text-brand">Статьи</a>
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                        <span class="font-medium text-[#1E293B] truncate max-w-xs"><?php the_title(); ?></span>
                    </nav>

                    <!-- Рубрика -->
                    <div class="mt-8 inline-flex items-center gap-2 rounded-full border border-brand/30 bg-brand-soft px-4 py-1.5 text-xs font-semibold text-brand-hover">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo esc_html( $categories[0]->name );
                        } else {
                            echo 'Медицина и здоровье';
                        }
                        ?>
                    </div>

                    <!-- Заголовок -->
                    <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-[#1E293B] sm:text-5xl">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Мета-информация (Автор, дата) -->
                    <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-[#1E293B]/65">
                        <div class="flex items-center gap-2">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full border border-brand/40 bg-brand-soft text-brand font-bold text-xs">
                                НК
                            </div>
                            <div class="flex flex-col leading-tight">
                                <span class="text-xs uppercase tracking-wide text-[#1E293B]/50">Автор</span>
                                <span class="font-semibold text-[#1E293B]"><?php echo esc_html( $author_name ); ?></span>
                            </div>
                        </div>
                        <span class="hidden h-8 w-px bg-[rgb(192,192,192)]/60 sm:block"></span>
                        <div class="flex items-center gap-2">
                            <svg style="width:16px;height:16px;" class="text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span><?php echo get_the_date('j F Y'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Обложка статьи -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mx-auto max-w-5xl px-6 pb-12">
                        <div class="overflow-hidden rounded-3xl border border-[rgb(192,192,192)]/50 shadow-xl shadow-brand/5">
                            <img
                                src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>"
                                alt="<?php the_title_attribute(); ?>"
                                class="h-[280px] w-full object-cover sm:h-[420px]"
                            />
                        </div>
                    </div>
                <?php endif; ?>
            </section>

            <!-- Article content -->
            <article class="mx-auto max-w-3xl px-6 py-14">
                <div class="prose prose-slate max-w-none text-lg leading-relaxed text-[#1E293B]/80 space-y-6">
                    <?php the_content(); ?>
                </div>
            </article>

            <!-- Author bio -->
            <section class="mx-auto max-w-3xl px-6 pb-16">
                <div class="rounded-3xl border border-[rgb(192,192,192)]/50 bg-brand-soft/40 p-6 sm:p-8">
                    <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl border-2 border-brand/40 bg-white text-brand text-2xl font-bold shadow-inner">
                            НК
                        </div>
                        <div class="flex-1">
                            <div class="text-xs font-semibold uppercase tracking-wide text-brand-hover">
                                Об авторе
                            </div>
                            <div class="mt-1 flex items-center gap-2 text-xl font-bold text-[#1E293B]">
                                Доктор Наталья Николаевна Касаткина
                            </div>
                            <p class="mt-2 text-sm leading-relaxed text-[#1E293B]/75">
                                Врач-реабилитолог, физиотерапевт, психолог-консультант. Более 20 лет клинической практики. Основатель Центра физиолечения и психоконсультирования в Калининграде[cite: 2].
                            </p>
                            <a
                                href="<?php echo esc_url( home_url('/#contacts') ); ?>"
                                class="mt-4 inline-flex items-center gap-2 rounded-full bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-hover"
                            >
                                Записаться на консультацию
                                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Related articles / Другие статьи -->
            <section class="border-t border-[rgb(192,192,192)]/40 bg-[#FAFBFC] py-16">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="flex items-end justify-between gap-6">
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-brand-hover">
                                Читайте также
                            </div>
                            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-[#1E293B] sm:text-4xl">
                                Другие статьи
                            </h2>
                        </div>
                        <a
                            href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
                            class="hidden shrink-0 items-center gap-1.5 text-sm font-semibold text-brand hover:text-brand-hover sm:inline-flex"
                        >
                            Все статьи <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>

                    <div class="mt-10 grid gap-6 md:grid-cols-3">
                        <?php
                        $related_query = new WP_Query( array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'post__not_in'   => array( get_the_ID() ),
                            'orderby'        => 'rand',
                        ) );

                        if ( $related_query->have_posts() ) :
                            while ( $related_query->have_posts() ) : $related_query->the_post();
                                ?>
                                <article class="group flex flex-col overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/50 bg-white transition hover:border-brand/50 hover:shadow-xl hover:shadow-brand/5">
                                    <div class="relative h-48 overflow-hidden bg-slate-100">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <img
                                                src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ); ?>"
                                                alt="<?php the_title_attribute(); ?>"
                                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                            />
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex flex-1 flex-col p-6">
                                        <div class="flex items-center gap-4 text-xs text-[#1E293B]/55">
                                            <span><?php echo get_the_date('j F Y'); ?></span>
                                        </div>
                                        <h3 class="mt-3 text-lg font-bold leading-snug text-[#1E293B] transition group-hover:text-brand-hover">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <p class="mt-2 flex-1 text-sm leading-relaxed text-[#1E293B]/70">
                                            <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                                        </p>
                                        <a
                                            href="<?php the_permalink(); ?>"
                                            class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand hover:text-brand-hover"
                                        >
                                            Читать статью <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </section>

        <?php endwhile; ?>

    </main>

<?php get_footer(); ?>