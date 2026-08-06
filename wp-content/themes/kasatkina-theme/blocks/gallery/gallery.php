<section class="bg-[#FAFBFC] py-20">
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div class="max-w-2xl">
                <div class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B]">
                    Атмосфера центра
                </div>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-[#1E293B] sm:text-4xl">
                    Пространство, в котором приятно лечиться
                </h2>
                <p class="mt-4 text-[#1E293B]/70">
                    Светлые кабинеты, современное оборудование и располагающая обстановка для консультаций.
                </p>
            </div>
        </div>

        <!-- Сетка фотографий -->
        <div class="mt-12 grid grid-cols-6 gap-4">

            <!-- Фото 1 -->
            <button type="button" class="js-gallery-trigger group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4"
                    data-src="{{THEME_URI}}/assets/images/center-inside.jpg" data-caption="Кабинет физиотерапии">
                <img src="{{THEME_URI}}/assets/images/center-inside.jpg" alt="Кабинет физиотерапии" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                    <span class="text-sm font-semibold text-white">Кабинет физиотерапии</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B]">Открыть</span>
                </div>
            </button>

            <!-- Фото 2 -->
            <button type="button" class="js-gallery-trigger group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2"
                    data-src="{{THEME_URI}}/assets/images/center-inside.jpg" data-caption="Пространство для консультаций">
                <img src="{{THEME_URI}}/assets/images/center-inside.jpg" alt="Пространство для консультаций" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                    <span class="text-sm font-semibold text-white">Пространство для консультаций</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B]">Открыть</span>
                </div>
            </button>

            <!-- Фото 3 -->
            <button type="button" class="js-gallery-trigger group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2"
                    data-src="{{THEME_URI}}/assets/images/center-inside.jpg" data-caption="Уютная зона ожидания">
                <img src="{{THEME_URI}}/assets/images/center-inside.jpg" alt="Уютная зона ожидания" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                    <span class="text-sm font-semibold text-white">Уютная зона ожидания</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B]">Открыть</span>
                </div>
            </button>

            <!-- Фото 4 -->
            <button type="button" class="js-gallery-trigger group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4"
                    data-src="{{THEME_URI}}/assets/images/center-inside.jpg" data-caption="Общий вид центра">
                <img src="{{THEME_URI}}/assets/images/center-inside.jpg" alt="Общий вид центра" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                    <span class="text-sm font-semibold text-white">Общий вид центра</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B]">Открыть</span>
                </div>
            </button>

        </div>
    </div>
</section>

<!-- Lightbox для галереи -->
<div id="gallery-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#0F172A]/85 p-6 backdrop-blur-sm">
    <div class="relative w-full max-w-4xl overflow-hidden rounded-3xl border border-white/10 bg-black">
        <img id="gallery-modal-img" src="" alt="" class="max-h-[80vh] w-full object-contain" />
        <div id="gallery-modal-caption" class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#0F172A]/85 to-transparent px-6 py-4 text-sm font-semibold text-white"></div>
        <button id="gallery-modal-close" type="button" class="absolute right-4 top-4 rounded-full bg-white/95 px-4 py-2 text-xs font-semibold shadow-lg hover:bg-white">
            Закрыть
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('.js-gallery-trigger');
        const modal = document.getElementById('gallery-modal');
        const closeBtn = document.getElementById('gallery-modal-close');
        const img = document.getElementById('gallery-modal-img');
        const caption = document.getElementById('gallery-modal-caption');

        if (modal && triggers.length) {
            triggers.forEach(btn => {
                btn.addEventListener('click', function() {
                    img.src = this.dataset.src;
                    caption.textContent = this.dataset.caption;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            function closeModal() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
        }
    });
</script>