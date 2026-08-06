<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-white font-sans text-[#1E293B] antialiased'); ?>>
<?php wp_body_open(); ?>

<!-- Top bar -->
<div class="hidden border-b border-[rgb(192,192,192)]/40 bg-white md:block">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-2 text-xs text-[#1E293B]/70">
        <div class="flex items-center gap-2">
            <svg class="h-3.5 w-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>г. Калининград, ул. Уральская, 20, пом. 4</span>
        </div>
        <div class="flex items-center gap-6">
            <a href="tel:+79211024686" class="flex items-center gap-2 hover:text-brand">
                <svg class="h-3.5 w-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                +7 (921) 102-46-86
            </a>
            <a href="mailto:info@kasatkina-center.ru" class="flex items-center gap-2 hover:text-brand">
                <svg class="h-3.5 w-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                info@kasatkina-center.ru
            </a>
        </div>
    </div>
</div>

<!-- Header -->
<!-- Header -->
<header class="sticky top-0 z-50 border-b border-[rgb(192,192,192)]/40 bg-white/90 backdrop-blur-lg">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">

        <!-- Логотип -->
        <div class="flex shrink-0 items-center gap-3 [&_img]:h-11 [&_img]:w-auto">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2.5 group">
                    <div class="grid h-10 w-10 place-items-center rounded-xl bg-amber-100 text-amber-600 transition group-hover:bg-amber-200" title="Загрузите логотип в настройках темы">
                        <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[#1E293B]/70 transition group-hover:text-[#3BC68B]">
                        <?php bloginfo( 'name' ); ?>
                    </span>
                </a>
            <?php } ?>
        </div>

        <!-- Десктопное меню -->
        <nav class="hidden items-center gap-7 lg:flex">
            <?php
            wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-7',
                    'fallback_cb'    => false,
                    'add_li_class'   => 'text-sm font-medium text-[#1E293B]/80 transition hover:text-[#3BC68B]',
            ) );
            ?>
        </nav>

        <!-- Кнопка и гамбургер -->
        <div class="flex items-center gap-2">
            <a href="<?php echo esc_url( home_url( '/#contacts' ) ); ?>" class="hidden rounded-full bg-[#3BC68B] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-[#3BC68B]/25 transition hover:bg-[#2EB078] md:inline-flex">
                Записаться на прием
            </a>
            <button id="mobile-menu-btn" type="button" class="relative z-50 rounded-full border border-[rgb(192,192,192)] p-2.5 lg:hidden" aria-label="Открыть меню">
                <svg class="h-5 w-5 text-[#1E293B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div id="mobile-menu" class="hidden border-t border-[rgb(192,192,192)]/40 bg-white lg:hidden">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 px-6 py-4">
            <?php
            wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-1',
                    'fallback_cb'    => false,
                    'add_li_class'   => 'rounded-xl px-3 py-2.5 text-sm font-medium text-[#1E293B] hover:bg-[#EBF9F3]',
            ) );
            ?>
            <a href="<?php echo esc_url( home_url( '/#contacts' ) ); ?>" class="mt-2 rounded-full bg-[#3BC68B] px-5 py-3 text-center text-sm font-semibold text-white">
                Записаться на прием
            </a>
        </div>
    </div>
</header>

<!-- Скрипт клика -->
<script>
    (function() {
        function initMobileMenu() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    menu.classList.toggle('hidden');
                };
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileMenu);
        } else {
            initMobileMenu();
        }
    })();
</script>

<!-- Скрипт переключения мобильного меню -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-menu')?.classList.toggle('hidden');
    });
</script>