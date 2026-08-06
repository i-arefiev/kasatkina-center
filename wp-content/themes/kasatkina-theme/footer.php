<footer class="bg-[#0F172A] py-14 text-white/70 border-t border-white/10">
    <div class="mx-auto grid max-w-7xl gap-10 px-6 md:grid-cols-3">
        <div>
            <div class="flex items-center gap-3">
                <?php
                // Получаем ссылку на загруженный логотип подвала
                $footer_logo = get_theme_mod( 'footer_logo' );

                if ( $footer_logo ) :
                    ?>
                    <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" class="h-11 w-auto" />
                <?php else : ?>
                    <span class="text-xl font-bold text-white"><?php echo get_bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </div>
            <p class="mt-5 text-sm leading-relaxed">
                Центр физиолечения и психоконсультирования доктора Касаткиной в Калининграде.
            </p>
        </div>

        <div>
            <div class="text-sm font-semibold text-white">Навигация</div>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a href="<?php echo home_url('/'); ?>" class="hover:text-brand transition">Главная</a></li>
                <li><a href="<?php echo home_url('/about'); ?>" class="hover:text-brand transition">О медцентре</a></li>
                <li><a href="<?php echo home_url('/services'); ?>" class="hover:text-brand transition">Услуги</a></li>
                <li><a href="<?php echo home_url('/articles'); ?>" class="hover:text-brand transition">Статьи</a></li>
                <li><a href="<?php echo home_url('/#contacts'); ?>" class="hover:text-brand transition">Контакты</a></li>
            </ul>
        </div>

        <div>
            <div class="text-sm font-semibold text-white">Контакты</div>
            <ul class="mt-4 space-y-2 text-sm">
                <li>г. Калининград, ул. Уральская, 20, пом. 4</li>
                <li><a href="tel:+79211024686" class="hover:text-brand transition">+7 (921) 102-46-86</a></li>
                <li><a href="mailto:info@kasatkina-center.ru" class="hover:text-brand transition">info@kasatkina-center.ru</a></li>
            </ul>
        </div>
    </div>

    <div class="mx-auto mt-10 max-w-7xl border-t border-white/10 px-6 pt-6 text-xs leading-relaxed">
        <p>
            Медицинская лицензия Л041-01157-39/00638809 от 25.01.2023 г. Имеются противопоказания, необходима консультация специалиста.
        </p>
        <p class="mt-2">
            © <?php echo date('Y'); ?> Центр доктора Касаткиной. При использовании материалов ссылка на ресурс kasatkina-center.ru обязательна.
        </p>
        <p class="mt-3">
            Разработка сайта — <a href="https://arefiev.dev" target="_blank" rel="noopener" class="text-white/80 font-medium transition hover:text-[#3BC68B]">Студия Ильи Арефьева</a>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>