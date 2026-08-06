<section id="contacts" class="py-20 bg-white">
    <div class="mx-auto max-w-6xl px-6">
        <div class="overflow-hidden rounded-3xl border border-[rgb(192,192,192)]/60 bg-white shadow-sm">
            <div class="grid gap-0 lg:grid-cols-[1fr_1.1fr]">

                <!-- Левая часть: Инфо -->
                <div class="relative flex flex-col justify-between bg-gradient-to-br from-[#EBF9F3]/70 via-white to-white p-8 sm:p-10">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-[#3BC68B]/30 bg-white px-3 py-1 text-xs font-semibold text-[#3BC68B]">
                            <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            <span>Запись на прием</span>
                        </div>
                        <h2 class="mt-5 text-3xl font-extrabold leading-tight tracking-tight text-[#1E293B] sm:text-4xl">
                            Готовы начать путь к <span class="text-[#3BC68B]">здоровью?</span>
                        </h2>
                        <p class="mt-4 text-[#1E293B]/70">
                            Оставьте заявку — администратор свяжется с Вами в течение рабочего дня и поможет подобрать удобное время для консультации.
                        </p>
                    </div>

                    <div class="mt-8 flex items-start gap-3 rounded-2xl border border-[#3BC68B]/30 bg-white p-5">
                        <svg style="width:20px; height:20px;" class="mt-0.5 shrink-0 text-[#3BC68B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <p class="text-xs leading-relaxed text-[#1E293B]/75">
                            Медицинская лицензия Л041-01157-39/00638809 от 25.01.2023 г. Имеются противопоказания, необходима консультация специалиста.
                        </p>
                    </div>
                </div>

                <!-- Правая часть: Форма -->
                <form action="#" method="post" onsubmit="event.preventDefault();" class="border-t border-[rgb(192,192,192)]/50 p-8 sm:p-10 lg:border-l lg:border-t-0">
                    <div class="grid gap-4">
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-[#1E293B]/60">Имя</label>
                            <input type="text" name="user_name" placeholder="Ваше имя" required class="mt-2 w-full rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-[#3BC68B] focus:ring-2 focus:ring-[#3BC68B]/20" />
                        </div>

                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-[#1E293B]/60">Телефон</label>
                            <input type="tel" name="user_phone" placeholder="+7 (___) ___-__-__" required class="mt-2 w-full rounded-xl border border-[rgb(192,192,192)] bg-white px-4 py-3 text-sm outline-none transition placeholder:text-[#1E293B]/40 focus:border-[#3BC68B] focus:ring-2 focus:ring-[#3BC68B]/20" />
                        </div>

                        <label class="flex cursor-pointer items-start gap-3 pt-2 text-xs text-[#1E293B]/70">
                            <input type="checkbox" checked required class="mt-0.5 h-4 w-4 shrink-0 accent-[#3BC68B]" />
                            <span>Я согласен(-на) на обработку персональных данных в соответствии с политикой конфиденциальности.</span>
                        </label>

                        <button type="submit" class="mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-[#3BC68B] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EB078]">
                            <span>Записаться на консультацию</span>
                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>