<section id="contacts" class="border-t border-[rgb(192,192,192)]/30 bg-white py-20">
    <div class="mx-auto max-w-7xl px-6">

        <!-- Заголовок -->
        <div class="max-w-2xl">
            <div class="text-sm font-semibold uppercase tracking-widest text-[#3BC68B]">
                Контакты
            </div>
            <h2 class="mt-3 text-4xl font-extrabold tracking-tight text-[#1E293B] sm:text-5xl">
                Как нас найти
            </h2>
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-2">

            <!-- Левая колонка: Инфо-карточки + Форма -->
            <div class="space-y-6">

                <!-- Контактные данные -->
                <div class="grid gap-4 rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-6 sm:grid-cols-2">

                    <div class="flex items-start gap-3">
                        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                            <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Адрес</div>
                            <div class="mt-1 text-sm font-medium text-[#1E293B]">
                                г. Калининград, ул. Уральская, д. 20, пом. 4
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                            <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Телефоны</div>
                            <a href="tel:+79211024686" class="mt-1 block text-sm font-medium text-[#1E293B] hover:text-[#3BC68B]">
                                +7 (921) 102-46-86
                            </a>
                            <a href="tel:+74012526699" class="block text-sm font-medium text-[#1E293B] hover:text-[#3BC68B]">
                                +7 (4012) 52-66-99
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 sm:col-span-2">
                        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-[#EBF9F3] text-[#3BC68B]">
                            <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold uppercase text-[#1E293B]/50">Email</div>
                            <a href="mailto:info@kasatkina-center.ru" class="mt-1 block text-sm font-medium text-[#1E293B] hover:text-[#3BC68B]">
                                info@kasatkina-center.ru
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Форма записи -->
                <form action="#" method="post" class="rounded-2xl border border-[rgb(192,192,192)]/60 bg-white p-6">
                    <div class="text-lg font-bold text-[#1E293B]">Записаться на прием</div>
                    <p class="mt-1 text-sm text-[#1E293B]/60">
                        Мы свяжемся с Вами в течение рабочего дня.
                    </p>

                    <div class="mt-5 grid gap-3">
                        <input type="text" name="user_name" placeholder="Ваше имя" required class="rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-[#3BC68B] focus:ring-2 focus:ring-[#3BC68B]/20" />
                        <input type="tel" name="user_phone" placeholder="Телефон" required class="rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-[#3BC68B] focus:ring-2 focus:ring-[#3BC68B]/20" />

                        <select name="user_service" class="rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#3BC68B] focus:ring-2 focus:ring-[#3BC68B]/20">
                            <option value="" disabled selected>Выберите услугу</option>
                            <option value="Транскраниальная терапия">Транскраниальная терапия</option>
                            <option value="Магнитотерапия">Магнитотерапия</option>
                            <option value="Лазеротерапия">Лазеротерапия</option>
                            <option value="Электролечение">Электролечение</option>
                            <option value="Психоконсультирование и ПТСР">Психоконсультирование и помощь при ПТСР</option>
                            <option value="Выезд на дом">Выезд на дом</option>
                        </select>

                        <button type="submit" class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EB078]">
                            <span>Отправить заявку</span>
                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </form>

            </div>

            <!-- Правая колонка: Яндекс.Карта -->
            <div class="overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 bg-white">
                <iframe title="Карта — Центр доктора Касаткиной" src="https://yandex.ru/map-widget/v1/?ll=20.556%2C54.708&z=15&pt=20.556,54.708,pm2rdm" class="h-full min-h-[500px] w-full" loading="lazy"></iframe>
            </div>

        </div>

    </div>
</section>