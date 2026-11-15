<?php
/**
 * Title: Атмосфера центра (Галерея)
 * Slug: kasatkina/gallery
 * Categories: featured
 */
?>
<!-- wp:group {"tagName":"section","className":"bg-[#FAFBFC] py-20","layout":{"type":"default"}} -->
<section class="wp-block-group bg-[#FAFBFC] py-20">
    <!-- wp:group {"className":"mx-auto max-w-7xl px-6","layout":{"type":"default"}} -->
    <div class="wp-block-group mx-auto max-w-7xl px-6">

        <!-- wp:group {"className":"flex flex-wrap items-end justify-between gap-6","layout":{"type":"default"}} -->
        <div class="wp-block-group flex flex-wrap items-end justify-between gap-6">
            <!-- wp:group {"className":"max-w-2xl","layout":{"type":"default"}} -->
            <div class="wp-block-group max-w-2xl">
                <!-- wp:paragraph {"className":"text-xs font-semibold uppercase tracking-wider text-[#3BC68B] m-0"} -->
                <p class="text-xs font-semibold uppercase tracking-wider text-[#3BC68B] m-0">Атмосфера центра</p>
                <!-- /wp:paragraph -->
                <!-- wp:heading {"className":"mt-2 text-3xl font-extrabold tracking-tight text-[#1E293B] sm:text-4xl"} -->
                <h2 class="wp-block-heading mt-2 text-3xl font-extrabold tracking-tight text-[#1E293B] sm:text-4xl">Пространство, в котором приятно лечиться</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph {"className":"mt-4 text-[#1E293B]/70"} -->
                <p class="mt-4 text-[#1E293B]/70">Светлые кабинеты, современное оборудование и располагающая обстановка для консультаций.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"mt-12 grid grid-cols-6 gap-4","layout":{"type":"default"}} -->
        <div class="wp-block-group mt-12 grid grid-cols-6 gap-4">

            <!-- Фото 1 -->
            <!-- wp:cover {"url":"<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg","dimRatio":0,"isDark":false,"className":"js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4 h-64"} -->
            <div class="wp-block-cover is-light js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4 h-64">
                <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
                <img class="wp-block-cover__image-background transition duration-500 group-hover:scale-105" alt="Кабинет физиотерапии" src="<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:group {"className":"absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4","layout":{"type":"default"}} -->
                    <div class="wp-block-group absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                        <!-- wp:paragraph {"className":"gallery-caption text-sm font-semibold text-white m-0"} -->
                        <p class="gallery-caption text-sm font-semibold text-white m-0">Кабинет физиотерапии</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"className":"inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0"} -->
                        <p class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0">Открыть</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- Фото 2 -->
            <!-- wp:cover {"url":"<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg","dimRatio":0,"isDark":false,"className":"js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2 h-64"} -->
            <div class="wp-block-cover is-light js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2 h-64">
                <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
                <img class="wp-block-cover__image-background transition duration-500 group-hover:scale-105" alt="Пространство для консультаций" src="<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:group {"className":"absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4","layout":{"type":"default"}} -->
                    <div class="wp-block-group absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                        <!-- wp:paragraph {"className":"gallery-caption text-sm font-semibold text-white m-0"} -->
                        <p class="gallery-caption text-sm font-semibold text-white m-0">Пространство для консультаций</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"className":"inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0"} -->
                        <p class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0">Открыть</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- Фото 3 -->
            <!-- wp:cover {"url":"<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg","dimRatio":0,"isDark":false,"className":"js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2 h-64"} -->
            <div class="wp-block-cover is-light js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-2 h-64">
                <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
                <img class="wp-block-cover__image-background transition duration-500 group-hover:scale-105" alt="Уютная зона ожидания" src="<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:group {"className":"absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4","layout":{"type":"default"}} -->
                    <div class="wp-block-group absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                        <!-- wp:paragraph {"className":"gallery-caption text-sm font-semibold text-white m-0"} -->
                        <p class="gallery-caption text-sm font-semibold text-white m-0">Уютная зона ожидания</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"className":"inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0"} -->
                        <p class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0">Открыть</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- Фото 4 -->
            <!-- wp:cover {"url":"<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg","dimRatio":0,"isDark":false,"className":"js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4 h-64"} -->
            <div class="wp-block-cover is-light js-gallery-trigger cursor-pointer group relative col-span-6 overflow-hidden rounded-2xl border border-[rgb(192,192,192)]/60 md:col-span-4 h-64">
                <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
                <img class="wp-block-cover__image-background transition duration-500 group-hover:scale-105" alt="Общий вид центра" src="<?php echo get_template_directory_uri(); ?>/assets/images/center-inside.jpg" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:group {"className":"absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4","layout":{"type":"default"}} -->
                    <div class="wp-block-group absolute inset-x-0 bottom-0 flex items-center justify-between gap-3 bg-gradient-to-t from-[#0F172A]/80 to-transparent p-4">
                        <!-- wp:paragraph {"className":"gallery-caption text-sm font-semibold text-white m-0"} -->
                        <p class="gallery-caption text-sm font-semibold text-white m-0">Общий вид центра</p>
                        <!-- /wp:paragraph -->
                        <!-- wp:paragraph {"className":"inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0"} -->
                        <p class="inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-semibold text-[#1E293B] m-0">Открыть</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
            </div>
            <!-- /wp:cover -->

        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:html -->
<!-- Lightbox для галереи и скрипт скрыты от парсера Gutenberg -->
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
                    // Ищем картинку и текст прямо внутри кликнутого блока
                    const innerImage = this.querySelector('img.wp-block-cover__image-background');
                    const innerCaption = this.querySelector('.gallery-caption');

                    // Подставляем динамические данные в модальное окно
                    img.src = innerImage ? innerImage.src : '';
                    caption.textContent = innerCaption ? innerCaption.textContent : '';

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
<!-- /wp:html -->