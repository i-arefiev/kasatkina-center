<section class="relative overflow-hidden border-b border-[rgb(192,192,192)]/30 bg-white py-12 lg:py-20">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_rgba(59,198,139,0.15),_transparent_60%)]"></div>

    <div class="mx-auto max-w-7xl px-6">

        <!-- Хлебные крошки -->
        <nav class="flex items-center gap-1.5 text-sm text-[#1E293B]/60" aria-label="Breadcrumb">
            <a href="{{HOME_URL}}" class="transition hover:text-[#3BC68B]">Главная</a>
            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-[#1E293B]">О медцентре</span>
        </nav>

        <!-- Сетка Hero -->
        <div class="mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]">

            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#3BC68B]/30 bg-[#EBF9F3] px-4 py-1.5 text-xs font-semibold text-[#3BC68B]">
                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    <span>Безопасное восстановление здоровья</span>
                </div>

                <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-[#1E293B] sm:text-5xl lg:text-6xl">
                    Центр физиолечения и <span class="text-[#3BC68B]">психоконсультирования</span> в Калининграде
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-relaxed text-[#1E293B]/70">
                    Профессиональная физиотерапевтическая помощь и психологическая поддержка в уютной атмосфере без стресса и очередей.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="#contacts" class="inline-flex items-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EB078]">
                        <span>Записаться на консультацию</span>
                        <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                    <a href="#mission" class="inline-flex items-center gap-2 rounded-full border border-[rgb(192,192,192)] px-6 py-3.5 text-sm font-semibold text-[#1E293B] transition hover:border-[#3BC68B] hover:text-[#3BC68B]">
                        <span>О нашей миссии</span>
                    </a>
                </div>
            </div>

            <!-- Картинка center-inside.jpg -->
            <div class="relative">
                <div class="absolute inset-0 -z-10 translate-x-6 translate-y-6 rounded-[2rem] bg-[#EBF9F3] blur-2xl"></div>
                <div class="overflow-hidden rounded-[2rem] border border-[rgb(192,192,192)]/60 shadow-xl shadow-[#3BC68B]/10">
                    <img src="{{THEME_URI}}/assets/images/center-inside.jpg" alt="Атмосфера центра доктора Касаткиной" class="h-[420px] w-full object-cover sm:h-[520px]" />
                </div>

                <div class="absolute -left-4 bottom-8 flex items-center gap-3 rounded-2xl border border-[rgb(192,192,192)]/60 bg-white px-4 py-3 shadow-xl shadow-[#3BC68B]/10 sm:-left-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                        <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold leading-none text-[#1E293B]">
                            Лицензия Минздрава
                        </div>
                        <div class="mt-1 text-xs text-[#1E293B]/60">с 2023 года</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>