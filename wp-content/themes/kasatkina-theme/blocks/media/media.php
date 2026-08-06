<section id="media" class="border-t border-[rgb(192,192,192)]/30 bg-white py-20">
    <div class="mx-auto max-w-7xl px-6">

        <!-- Заголовок секции -->
        <div class="text-center">
            <div class="text-sm font-semibold uppercase tracking-widest text-[#3BC68B]">
                СМИ о нас
            </div>
            <h2 class="mt-3 text-4xl font-extrabold tracking-tight text-[#1E293B] sm:text-5xl">
                Публикации в СМИ
            </h2>
            <p class="mt-3 text-[#1E293B]/70">
                Статьи про нас опубликованы в ведущих изданиях:
            </p>
        </div>

        <!-- Сетка с логотипами изданий -->
        <div class="mt-12 grid gap-6 md:grid-cols-3">

            <!-- Карточка 1 -->
            <div class="group flex flex-col items-center rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-8 transition hover:-translate-y-1 hover:border-[#3BC68B] hover:shadow-xl hover:shadow-[#3BC68B]/10">
                <div class="grid h-24 w-full place-items-center">
                    <img src="{{THEME_URI}}/assets/images/korolevskiye.png" alt="Королевские ворота" class="max-h-20 w-auto object-contain" />
                </div>
                <div class="mt-6 text-center text-base font-semibold text-[#1E293B]">
                    Королевские ворота
                </div>
            </div>

            <!-- Карточка 2 -->
            <div class="group flex flex-col items-center rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-8 transition hover:-translate-y-1 hover:border-[#3BC68B] hover:shadow-xl hover:shadow-[#3BC68B]/10">
                <div class="grid h-24 w-full place-items-center">
                    <img src="{{THEME_URI}}/assets/images/nov-kgd.png" alt="Новый Калининград" class="max-h-20 w-auto object-contain" />
                </div>
                <div class="mt-6 text-center text-base font-semibold text-[#1E293B]">
                    Новый Калининград
                </div>
            </div>

            <!-- Карточка 3 -->
            <div class="group flex flex-col items-center rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-8 transition hover:-translate-y-1 hover:border-[#3BC68B] hover:shadow-xl hover:shadow-[#3BC68B]/10">
                <div class="grid h-24 w-full place-items-center">
                    <img src="{{THEME_URI}}/assets/images/first-persons.png" alt="Журнал First Persons" class="max-h-20 w-auto object-contain" />
                </div>
                <div class="mt-6 text-center text-base font-semibold text-[#1E293B]">
                    Журнал First Persons
                </div>
            </div>

        </div>

        <!-- Кнопка перехода к публикациям -->
        <div class="mt-10 text-center">
            <a href="#contacts" class="inline-flex items-center gap-2 rounded-full border border-[#3BC68B] px-6 py-3 text-sm font-semibold text-[#3BC68B] transition hover:bg-[#3BC68B] hover:text-white">
                <span>Посмотреть все публикации</span>
                <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>