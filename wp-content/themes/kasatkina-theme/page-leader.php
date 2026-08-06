<?php
/**
 * Template Name: Страница руководителя
 */

get_header();

// Ссылки на медиа
$portrait_url = get_template_directory_uri() . '/assets/images/nata_new.png'; // Или укажи прямую ссылку на фото

$education_list = array(
    array(
        'tag'   => 'Высшее образование',
        'title' => 'Врач — Астраханский государственный медицинский университет',
        'desc'  => 'Фундаментальная подготовка по клинической медицине и физиотерапевтической реабилитации.',
    ),
    array(
        'tag'   => 'Второе высшее',
        'title' => 'Психолог — Астраханский государственный технический университет',
        'desc'  => 'Специализация: клиническая психология, психологическое консультирование и психокоррекция.',
    ),
    array(
        'tag'   => 'Повышение квалификации',
        'title' => 'Физиотерапия, лазеро- и магнитотерапия',
        'desc'  => 'Специализированные программы по современным аппаратным методикам физиолечения.',
    ),
    array(
        'tag'   => 'Работа с ПТСР',
        'title' => 'Реабилитация при посттравматическом стрессовом расстройстве',
        'desc'  => 'Подготовка по психологической помощи и работе с комплексными психотравмами.',
    ),
);

$certificates_list = array(
    array( 'title' => 'Диплом врача', 'org' => 'АГМУ', 'year' => '2005' ),
    array( 'title' => 'Диплом психолога', 'org' => 'АГТУ', 'year' => '2012' ),
    array( 'title' => 'Сертификат: Физиотерапия', 'org' => 'Минздрав РФ', 'year' => '2018' ),
    array( 'title' => 'Лазеротерапия — курс', 'org' => 'НМИЦ реабилитации', 'year' => '2020' ),
    array( 'title' => 'Магнитотерапия — курс', 'org' => 'НМИЦ реабилитации', 'year' => '2021' ),
    array( 'title' => 'Работа с ПТСР', 'org' => 'Клиническая психология', 'year' => '2023' ),
);

$approach_list = array(
    array(
        'title' => 'Комплексный подход',
        'desc'  => 'Синергия физиотерапии и психологии для быстрой и устойчивой реабилитации пациента.',
    ),
    array(
        'title' => 'Безболезненность и безопасность',
        'desc'  => 'Использование только сертифицированного низкоинтенсивного медицинского оборудования.',
    ),
    array(
        'title' => 'Индивидуальный протокол',
        'desc'  => 'Подбор программы с учётом возраста, анамнеза и всех противопоказаний пациента.',
    ),
    array(
        'title' => 'Доступность',
        'desc'  => 'Личный выезд с портативным оборудованием к тяжелобольным пациентам на дом.',
    ),
);

$issues_list = array(
    'Лечение остеохондроза, артритов, артрозов и межпозвоночных грыж',
    'Реабилитация после операций и острых воспалительных процессов',
    'Психологическая поддержка, работа со стрессом, тревожностью и ПТСР',
    'Восстановление подвижности и снятие болевых синдромов на дому',
);
?>

    <main class="min-h-screen bg-white font-sans text-[#1E293B] antialiased">

        <!-- HERO -->
        <section class="relative overflow-hidden border-b border-slate-200/60 bg-gradient-to-b from-[#EBF9F3]/40 to-white pt-8 pb-16 lg:pt-12 lg:pb-20">
            <div class="mx-auto max-w-7xl px-6">

                <!-- Хлебные крошки -->
                <nav aria-label="Хлебные крошки" class="mb-8">
                    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                        <li><a href="<?php echo esc_url( home_url('/') ); ?>" class="transition hover:text-[#3BC68B]">Главная</a></li>
                        <li><svg style="width:14px; height:14px;" class="text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li><a href="<?php echo esc_url( home_url('/about/') ); ?>" class="transition hover:text-[#3BC68B]">О медцентре</a></li>
                        <li><svg style="width:14px; height:14px;" class="text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li aria-current="page" class="font-medium text-slate-900">Наталия Николаевна Касаткина (Бочарова)</li>
                    </ol>
                </nav>

                <div class="grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-[#3BC68B]/30 bg-[#EBF9F3] px-4 py-1.5 text-xs font-semibold text-[#2EA874]">
                            <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            Основатель и главный специалист центра
                        </div>

                        <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                            Наталия Николаевна <span class="text-[#3BC68B]">Касаткина</span> <span class="text-slate-400 font-normal">(Бочарова)</span>
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-600">
                            Врач, психолог, специалист по физиотерапевтической реабилитации и работе с посттравматическим стрессовым расстройством.
                        </p>

                        <div class="relative mt-8 rounded-2xl border-l-4 border-[#3BC68B] bg-[#EBF9F3]/60 p-6">
                            <p class="text-base font-medium leading-relaxed text-slate-800 italic">
                                «Моя цель — помочь человеку восстановить не только физическое здоровье, но и эмоциональную гармонию, создавая безопасные условия для лечения».
                            </p>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="#booking" class="inline-flex items-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EA874]">
                                Записаться на личный прием
                                <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="#education" class="inline-flex items-center gap-2 rounded-full border border-slate-300 px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:border-[#3BC68B] hover:text-[#3BC68B]">
                                Образование и опыт
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 -z-10 translate-x-8 translate-y-8 rounded-[2rem] bg-[#EBF9F3] blur-2xl"></div>
                        <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-gradient-to-br from-[#EBF9F3]/60 to-white shadow-xl">
                            <img src="https://kasatkina-center.ru/media/compressed_media/compressed-nata_new.png" alt="Доктор Наталия Николаевна Касаткина" class="mx-auto h-[520px] w-auto object-contain" />
                        </div>

                        <!-- Бейджи -->
                        <div class="absolute -left-4 top-10 flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-xl sm:-left-6">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                                <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            </div>
                            <div>
                                <div class="text-lg font-extrabold text-slate-900">15+ лет</div>
                                <div class="text-xs text-slate-500">клинической практики</div>
                            </div>
                        </div>

                        <div class="absolute -right-4 bottom-10 flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-xl sm:-right-6">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                                <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <div class="text-lg font-extrabold text-slate-900">2 высших</div>
                                <div class="text-xs text-slate-500">образования</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- EDUCATION -->
        <section id="education" class="border-b border-slate-200/60 py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="max-w-2xl">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B]">Образование и квалификация</div>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Образование и экспертность</h2>
                    <p class="mt-4 text-slate-600">Фундаментальная медицинская подготовка, психологическое образование и постоянное повышение квалификации по современным методикам реабилитации.</p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-2">
                    <?php foreach ( $education_list as $i => $edu ) : ?>
                        <div class="group rounded-2xl border border-slate-200 bg-white p-7 transition hover:border-[#3BC68B]/50 hover:shadow-xl">
                            <div class="flex items-start gap-5">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#EBF9F3] text-[#3BC68B] transition group-hover:bg-[#3BC68B] group-hover:text-white">
                                    <svg style="width:24px; height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-[#3BC68B]">
                                        <span>0<?php echo $i + 1; ?></span>
                                        <span class="h-1 w-1 rounded-full bg-[#3BC68B]"></span>
                                        <span><?php echo esc_html( $edu['tag'] ); ?></span>
                                    </div>
                                    <h3 class="mt-2 text-lg font-bold leading-snug text-slate-900"><?php echo esc_html( $edu['title'] ); ?></h3>
                                    <p class="mt-2 text-sm leading-relaxed text-slate-600"><?php echo esc_html( $edu['desc'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- CERTIFICATES -->
        <section class="border-b border-slate-200/60 bg-slate-50/50 py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="max-w-2xl">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B]">Дипломы и сертификаты</div>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Подтвержденная квалификация</h2>
                    <p class="mt-4 text-slate-600">Все методики и процедуры в нашем центре лицензированы и соответствуют стандартам Минздрава РФ.</p>
                </div>

                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ( $certificates_list as $cert ) : ?>
                        <div class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:border-[#3BC68B]/60 hover:shadow-xl">
                            <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-[#EBF9F3] via-white to-slate-100 p-6 flex flex-col items-center justify-center text-center">
                                <div class="rounded-full bg-white p-3 shadow-sm text-[#3BC68B] mb-2">
                                    <svg style="width:28px; height:28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                </div>
                                <div class="text-[10px] font-semibold uppercase tracking-widest text-slate-400">Свидетельство</div>
                                <div class="text-sm font-bold leading-tight text-slate-900 mt-1"><?php echo esc_html( $cert['title'] ); ?></div>
                                <div class="mt-1 text-xs text-slate-500"><?php echo esc_html( $cert['org'] ); ?> · <?php echo esc_html( $cert['year'] ); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- APPROACH -->
        <section class="border-b border-slate-200/60 py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="max-w-2xl">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B]">Принципы работы</div>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Подход и философия</h2>
                </div>

                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <?php foreach ( $approach_list as $i => $app ) : ?>
                        <div class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-7 transition hover:-translate-y-1 hover:border-[#3BC68B]/50 hover:shadow-xl">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#EBF9F3] text-[#3BC68B] group-hover:bg-[#3BC68B] group-hover:text-white transition">
                                <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="mt-5 text-xs font-semibold text-[#3BC68B]">0<?php echo $i + 1; ?></div>
                            <h3 class="mt-2 text-lg font-bold text-slate-900"><?php echo esc_html( $app['title'] ); ?></h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600"><?php echo esc_html( $app['desc'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- SPECIALIZATION -->
        <section class="border-b border-slate-200/60 bg-slate-50/50 py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid gap-12 lg:grid-cols-[1fr_1.2fr] lg:items-center">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B]">Специализация</div>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">С чем можно обратиться</h2>
                        <p class="mt-4 text-slate-600">Наталия Николаевна принимает пациентов с широким спектром физических и психоэмоциональных состояний. Каждая программа подбирается индивидуально.</p>
                        <a href="#booking" class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EA874]">
                            Записаться на консультацию
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <?php foreach ( $issues_list as $issue ) : ?>
                            <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-[#3BC68B]/50">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#EBF9F3] text-[#3BC68B]">
                            <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </span>
                                <span class="text-sm leading-relaxed text-slate-700"><?php echo esc_html( $issue ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php get_footer(); ?>