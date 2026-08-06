
<section id="home" class="relative overflow-hidden bg-white">
    <!-- Градиентный фоновый овал из Lovable -->
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,var(--tw-gradient-stops))] from-[#3BC68B]/15 via-transparent to-transparent"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-16 lg:grid-cols-2 lg:py-24">
        <!-- Левая колонка со свойствами и кнопками -->
        <div>
            <!-- Плашка медицинской лицензии -->
            <div class="inline-flex items-center gap-2 rounded-full border border-[#3BC68B]/30 bg-[#EBF9F3] px-4 py-1.5 text-xs font-semibold text-[#2EB078]">
                <svg style="width:14px; height:14px; min-width:14px;" class="text-[#3BC68B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Медицинская лицензия Л041-01157-39/00638809</span>
            </div>

            <!-- Главный заголовок H1 -->
            <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-[#1E293B] sm:text-5xl lg:text-6xl">
                Центр физиолечения и <span class="text-[#3BC68B]">психоконсультирования</span> доктора Касаткиной
            </h1>

            <!-- Описание -->
            <p class="mt-6 max-w-xl text-lg leading-relaxed text-[#1E293B]/70">
                Поддерживающие процедуры для комплексного безопасного лечения и восстановления организма после болезней и травм.
            </p>

            <!-- Блок с кнопками -->
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#contacts" class="inline-flex items-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/30 transition hover:bg-[#2EB078]">
                    <span>Записаться на консультацию</span>
                    <svg style="width:16px; height:16px; min-width:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <button type="button" class="inline-flex items-center gap-2 rounded-full border border-[rgb(192,192,192)] bg-white px-6 py-3.5 text-sm font-semibold text-[#1E293B] transition hover:border-[#3BC68B] hover:text-[#3BC68B]">
          <span class="grid h-7 w-7 place-items-center rounded-full bg-[#3BC68B] text-white">
            <svg style="width:14px; height:14px; min-width:14px;" class="fill-white" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7z"/>
            </svg>
          </span>
                    <span>Смотреть видео о центре</span>
                </button>
            </div>

            <!-- Статистика -->
            <div class="mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-[rgb(192,192,192)]/50 pt-6">
                <div>
                    <div class="text-2xl font-bold text-[#3BC68B]">15+</div>
                    <div class="text-xs text-[#1E293B]/60">лет опыта</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-[#3BC68B]">5000+</div>
                    <div class="text-xs text-[#1E293B]/60">пациентов</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-[#3BC68B]">100%</div>
                    <div class="text-xs text-[#1E293B]/60">инд. подход</div>
                </div>
            </div>
        </div>

        <!-- Правая колонка с изображением -->
        <div class="relative">
            <div class="absolute inset-0 -z-10 mx-auto h-[500px] w-[500px] rounded-full bg-[#3BC68B]/25 blur-3xl"></div>
            <div class="relative mx-auto max-w-lg">
                <img src="wp-content/themes/kasatkina-theme/assets/images/doctor.png" alt="Доктор Наталия Касаткина-Бочарова" class="relative z-10 mx-auto w-full drop-shadow-2xl" />

                <!-- Всплывающая плашка слева снизу -->
                <div class="absolute bottom-6 -left-4 z-20 max-w-[220px] rounded-2xl border border-[rgb(192,192,192)]/60 bg-white/95 p-4 shadow-xl backdrop-blur">
                    <div class="flex items-center gap-3">
                        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-[#EBF9F3]">
                            <svg style="width:20px; height:20px; min-width:20px;" class="text-[#3BC68B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold leading-tight text-[#1E293B]">
                            Опыт работы и индивидуальный подход
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>