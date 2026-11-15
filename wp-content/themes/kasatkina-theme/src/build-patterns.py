"""Генератор паттернов темы: описывает секции на Python и пишет корректную разметку блоков WordPress."""
import html
import json
import sys
from pathlib import Path

OUT = Path(sys.argv[1])
IMG = '<?php echo esc_url( $img ); ?>'
HOME = '<?php echo esc_url( home_url( "/" ) ); ?>'


def attrs_json(a):
    if not a:
        return ''
    s = json.dumps(a, ensure_ascii=False, separators=(',', ':'))
    for ch, rep in (('--', '\\u002d\\u002d'), ('<', '\\u003c'), ('>', '\\u003e'), ('&', '\\u0026'), ('"', '\\u0022')):
        if ch == '"':
            continue
        s = s.replace(ch, rep)
    return ' ' + s


def cls(*parts):
    return ' '.join(p for p in parts if p)


def ind(text, n=1):
    pad = '\t' * n
    return '\n'.join(pad + line if line.strip() else line for line in text.split('\n'))


def esc_attr(v):
    return html.escape(v, quote=True)


MARK = '<mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-brand-color">{}</mark>'


def m(text):
    return MARK.format(text)


def group(children, c='', tag='div', anchor=None):
    a = {}
    if tag != 'div':
        a['tagName'] = tag
    if anchor:
        a['anchor'] = anchor
    if c:
        a['className'] = c
    a['layout'] = {'type': 'default'}
    idattr = f' id="{anchor}"' if anchor else ''
    inner = '\n'.join(children)
    return (f'<!-- wp:group{attrs_json(a)} -->\n'
            f'<{tag}{idattr} class="{esc_attr(cls("wp-block-group", c))}">\n{ind(inner)}\n</{tag}>\n'
            f'<!-- /wp:group -->')


def p(text, c=''):
    a = {'className': c} if c else {}
    ca = f' class="{esc_attr(c)}"' if c else ''
    return f'<!-- wp:paragraph{attrs_json(a)} -->\n<p{ca}>{text}</p>\n<!-- /wp:paragraph -->'


def h(text, level=2, c=''):
    a = {}
    if level != 2:
        a['level'] = level
    if c:
        a['className'] = c
    return (f'<!-- wp:heading{attrs_json(a)} -->\n'
            f'<h{level} class="{esc_attr(cls("wp-block-heading", c))}">{text}</h{level}>\n'
            f'<!-- /wp:heading -->')


def img(src, alt, c='', lightbox=False, caption=None):
    a = {'sizeSlug': 'full', 'linkDestination': 'none'}
    if lightbox:
        a['lightbox'] = {'enabled': True}
    if c:
        a['className'] = c
    cap = f'<figcaption class="wp-element-caption">{caption}</figcaption>' if caption else ''
    return (f'<!-- wp:image{attrs_json(a)} -->\n'
            f'<figure class="{esc_attr(cls("wp-block-image size-full", c))}"><img src="{IMG}{src}" alt="{esc_attr(alt)}"/>{cap}</figure>\n'
            f'<!-- /wp:image -->')


def button(text, href, style='ks-primary'):
    c = f'is-style-{style}'
    return (f'<!-- wp:button{attrs_json({"className": c})} -->\n'
            f'<div class="wp-block-button {c}"><a class="wp-block-button__link wp-element-button" href="{href}">{text}</a></div>\n'
            f'<!-- /wp:button -->')


def buttons(items, c=''):
    a = {'className': c} if c else {}
    return (f'<!-- wp:buttons{attrs_json(a)} -->\n'
            f'<div class="{esc_attr(cls("wp-block-buttons", c))}">' + '\n' + ind('\n'.join(items)) + '\n</div>\n'
            f'<!-- /wp:buttons -->')


def ul(items, c=''):
    a = {'className': c} if c else {}
    lis = ''.join(f'<!-- wp:list-item -->\n<li>{i}</li>\n<!-- /wp:list-item -->' for i in items)
    return (f'<!-- wp:list{attrs_json(a)} -->\n'
            f'<ul class="{esc_attr(cls("wp-block-list", c))}">{lis}</ul>\n'
            f'<!-- /wp:list -->')


def block(name, a=None):
    return f'<!-- wp:kasatkina/{name}{attrs_json(a or {})} /-->'


def icon(name, c='ks-icon-tile', size=None):
    a = {'icon': name}
    if size:
        a['size'] = size
    if c:
        a['className'] = c
    return block('icon', a)


def badge(icon_name, text, c='ks-badge'):
    return group([icon(icon_name, '', 14), p(text, 'm-0')], c)


def eyebrow(text, c=''):
    return p(text, cls('ks-eyebrow', c))


def section_head(eb, title, text=None, c='max-w-2xl', h_cls='mt-3 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl lg:text-5xl'):
    kids = [eyebrow(eb), h(title, 2, h_cls)]
    if text:
        kids.append(p(text, 'mt-4 text-ink/70'))
    return group(kids, c)


def container(children, c='mx-auto max-w-7xl px-6'):
    return group(children, c)


def float_badge(icon_name, title, sub, c):
    return group([icon(icon_name, 'ks-icon-tile ks-icon-tile--sm'),
                  group([p(title, 'm-0 text-sm font-extrabold leading-tight text-ink'), p(sub, 'm-0 mt-1 text-xs text-ink/60')])],
                 cls('flex items-center gap-3 rounded-2xl border border-line/60 bg-white/95 px-4 py-3 shadow-xl shadow-brand/10 backdrop-blur', c))


def card(icon_name, title, text, c='ks-card', icon_cls='ks-icon-tile', h_cls='mt-5 text-lg font-bold text-ink', t_cls='mt-2 text-sm leading-relaxed text-ink/65'):
    return group([icon(icon_name, icon_cls), h(title, 3, h_cls), p(text, t_cls)], c)


PATTERNS = {}


def pattern(slug, title, category='kasatkina', keywords='', description=''):
    def deco(fn):
        PATTERNS[slug] = (title, category, keywords, description, fn)
        return fn
    return deco


# ───────────────────────────── Главная ─────────────────────────────

@pattern('home-hero', 'Главный экран (главная)', keywords='главный, hero, первый экран', description='Первый экран: заголовок, кнопка записи, цифры и фото врача.')
def home_hero():
    stats = group([group([p(n, 'm-0 text-2xl font-bold text-brand'), p(t, 'm-0 text-xs text-ink/60')]) for n, t in
                   (('15+', 'лет опыта'), ('250+', 'пациентов'), ('100%', 'инд. подход'))],
                  'mt-10 grid max-w-md grid-cols-3 gap-4 border-t border-line/50 pt-6')
    left = group([
        badge('shield-check', 'Лицензия Л041‑01157‑39/00638809'),
        h('Центр физиолечения и ' + m('психоконсультирования') + ' доктора Касаткиной', 1, 'ks-hero-title mt-6 font-extrabold tracking-tight text-ink'),
        p('Поддерживающие процедуры для комплексного безопасного лечения и восстановления организма после болезней и травм.', 'mt-6 max-w-xl text-lg leading-relaxed text-ink/70'),
        buttons([button('Записаться на консультацию', '#contacts')], 'mt-8'),
        stats,
    ], 'ks-hero-text')
    right = group([
        img('doctor.png', 'Доктор Наталия Николаевна Касаткина', 'ks-img-contain relative z-10 m-0 drop-shadow-2xl'),
        float_badge('academic', 'Индивидуальный подход', 'к каждому пациенту', 'absolute -left-4 bottom-6 z-20'),
    ], 'ks-blob relative mx-auto w-full max-w-[17rem] sm:max-w-sm lg:max-w-lg')
    return group([container([left, right], 'mx-auto grid max-w-7xl items-center gap-10 px-6 pb-12 pt-10 sm:py-16 lg:grid-cols-[1.3fr_1fr] lg:gap-12 lg:py-24')],
                 'ks-glow-tr relative overflow-hidden bg-white', 'section', 'home')


@pattern('services', 'Наши услуги (сетка карточек)', keywords='услуги, карточки', description='Заголовок и карточки услуг — карточки берутся из раздела «Услуги».')
def services():
    head = group([
        group([eyebrow('Услуги'), h('Наши услуги', 2, 'mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl')]),
        p('В нашем центре Вы можете записаться на процедуры, направленные на лечение и профилактику различных заболеваний: физиотерапевтическое воздействие теплом, электрическим током, магнитными полями, лазером и другими физическими факторами.', 'm-0 text-base leading-relaxed text-ink/70'),
    ], 'grid gap-6 lg:grid-cols-[1fr_1.2fr] lg:items-end lg:gap-10')
    return group([container([head, block('services-grid', {'className': 'mt-12'})])],
                 'scroll-mt-24 border-t border-line/30 bg-white py-20', 'section', 'services')


@pattern('indications', 'Показания к применению', keywords='показания, список', description='Иллюстрация и список показаний в карточках.')
def indications():
    left = group([img('bubbles.png', 'Показания к применению', 'ks-img-contain m-0 mx-auto max-w-md')], 'relative')
    right = group([
        eyebrow('Показания'),
        h('Показания к применению', 2, 'mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl'),
        p('Наши процедуры помогают при широком спектре состояний и заболеваний.', 'mt-4 text-ink/70'),
        ul(['После оперативного лечения по поводу острых воспалительных процессов', 'Остеохондроз', 'Артрит и артроз',
            'Позвоночные грыжи', 'Хронический бронхит', 'Гинекологические заболевания (после консультации с гинекологом)'],
           'is-style-ks-checklist mt-8'),
    ])
    return group([container([left, right], 'mx-auto grid max-w-7xl gap-12 px-6 lg:grid-cols-2 lg:items-center')],
                 'scroll-mt-24 border-t border-line/30 bg-brand-soft/40 py-20', 'section', 'indications')


@pattern('about', 'Почему нам доверяют (тёмный блок)', keywords='о центре, преимущества', description='Тёмная секция с тремя преимуществами центра.')
def about():
    dark_card = dict(c='rounded-2xl border border-white/10 bg-white/[0.04] p-8 transition hover:border-brand/60 hover:bg-white/[0.06]',
                     icon_cls='ks-icon-tile ks-icon-tile--solid ks-icon-tile--lg', h_cls='mt-6 text-xl font-bold text-white',
                     t_cls='mt-3 text-sm leading-relaxed text-white/70')
    cards = group([
        card('heart', 'Гармония', 'Особенность нашего подхода в том, что мы сочетаем физио- и психотерапию, что позволяет добиться гораздо большего в рамках лечения.', **dark_card),
        card('shield-check', 'Забота', 'Специалисты нашего центра помогают пациентам в атмосфере полного понимания и принятия, где ничего не вызывает беспокойства.', **dark_card),
        card('academic', 'Профессионализм', 'Наш основатель, Наталия Касаткина-Бочарова, постоянно совершенствуется, в том числе помогает пациентам в самых трудных ситуациях (работа с ПТСР).', **dark_card),
    ], 'mt-12 grid gap-6 md:grid-cols-3')
    head = group([eyebrow('О медцентре'), h('Почему нам можно доверять?', 2, 'mt-3 text-4xl font-extrabold tracking-tight text-white sm:text-5xl')], 'max-w-2xl')
    return group([container([head, cards])], 'scroll-mt-24 bg-ink py-20 text-white', 'section', 'about')


@pattern('house-calls', 'Выезд на дом', keywords='выезд, на дом', description='Баннер про выезд специалиста с оборудованием на дом.')
def house_calls():
    left = group([
        badge('lightning', 'Уникальная услуга в Калининграде', 'ks-badge ks-badge--solid'),
        h('Мы единственные в городе, кто выезжает к больным на дом', 2, 'mt-5 text-3xl font-extrabold leading-tight tracking-tight text-ink sm:text-4xl lg:text-5xl'),
        p('Для пациентов, которые в силу своего состояния не могут самостоятельно добраться до нашего Центра, мы предлагаем услуги на дому. Специальный набор оборудования предназначен для проведения электро-, лазеро- и магнитотерапии на дому.', 'mt-5 text-base leading-relaxed text-ink/70'),
        buttons([button('Вызвать специалиста на дом', '#contacts')], 'mt-8'),
    ])
    right = group([img('home-kit.png', 'Портативное оборудование для процедур на дому', 'ks-img-contain m-0 mx-auto max-w-md')], 'ks-blob relative')
    inner = group([left, right], 'grid gap-10 p-8 sm:p-12 lg:grid-cols-2 lg:items-center lg:p-16')
    box = group([inner], 'relative overflow-hidden rounded-3xl border border-line/60 bg-gradient-to-br from-brand-soft via-white to-brand-soft')
    return group([container([box])], 'scroll-mt-24 bg-white py-20', 'section', 'home-visit')


@pattern('media', 'СМИ о нас', keywords='сми, публикации, пресса', description='Логотипы изданий, где выходили публикации о центре.')
def media():
    def item(src, name):
        return group([img(src, name, 'ks-img-logo m-0'), p(name, 'm-0 mt-6 text-center text-base font-semibold text-ink')],
                     'flex flex-col items-center rounded-2xl border border-line/60 bg-white p-8 transition hover:-translate-y-1 hover:border-brand hover:shadow-xl hover:shadow-brand/10')
    head = group([eyebrow('СМИ о нас'), h('Публикации в СМИ', 2, 'mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl'),
                  p('Статьи про нас опубликованы в ведущих изданиях:', 'mt-3 text-ink/70')], 'text-center')
    grid = group([item('korolevskiye.png', 'Королевские ворота'), item('nov-kgd.png', 'Новый Калининград'), item('first-persons.png', 'Журнал First Persons')],
                 'mt-12 grid gap-6 md:grid-cols-3')
    return group([container([head, grid])], 'scroll-mt-24 border-t border-line/30 bg-white py-20', 'section', 'media')


@pattern('contacts', 'Контакты: данные, форма и карта', keywords='контакты, карта, форма', description='Контактные данные, форма записи и Яндекс.Карта.')
def contacts():
    head = group([eyebrow('Контакты'), h('Как нас найти', 2, 'mt-3 text-4xl font-extrabold tracking-tight text-ink sm:text-5xl')], 'max-w-2xl')
    left = group([block('contact-info'), block('booking-form', {'showComment': True})], 'space-y-6')
    grid = group([left, block('map', {'height': 640, 'className': 'min-h-full'})], 'mt-12 grid gap-8 lg:grid-cols-2')
    return group([container([head, grid])], 'scroll-mt-24 border-t border-line/30 bg-white py-20', 'section', 'contacts')


# ───────────────────────────── О медцентре ─────────────────────────────

@pattern('about-hero', 'Первый экран «О медцентре»', keywords='о центре, hero', description='Хлебные крошки, заголовок страницы и фото центра.')
def about_hero():
    left = group([
        badge('sparkles', 'Безопасное восстановление здоровья'),
        h('Центр физиолечения и ' + m('психоконсультирования') + ' в Калининграде', 1, 'ks-hero-title mt-6 font-extrabold tracking-tight text-ink'),
        p('Профессиональная физиотерапевтическая помощь и психологическая поддержка в уютной атмосфере без стресса и очередей.', 'mt-6 max-w-xl text-lg leading-relaxed text-ink/70'),
        buttons([button('Записаться на консультацию', '#booking'), button('О нашей миссии', '#mission', 'ks-outline')], 'mt-8'),
    ], 'ks-hero-text')
    right = group([
        img('center-inside.jpg', 'Кабинет центра доктора Касаткиной', 'ks-img-fill m-0 h-72 overflow-hidden rounded-[2rem] border border-line/60 shadow-xl shadow-brand/10 sm:h-[420px] lg:h-[520px]'),
        float_badge('badge-check', 'Лицензия Минздрава', 'с 2023 года', 'absolute -left-4 bottom-8 sm:-left-6'),
    ], 'relative')
    grid = group([left, right], 'mt-8 grid items-center gap-10 lg:grid-cols-[1.25fr_1fr] lg:gap-12')
    return group([container([block('breadcrumbs'), grid])], 'ks-glow-tr relative overflow-hidden border-b border-line/30 bg-white py-10 lg:py-20', 'section')


@pattern('mission', 'Наша миссия (фото и преимущества)', keywords='миссия, преимущества, фото', description='Сетка из 4 фото, текст о миссии и 4 карточки преимуществ.')
def mission():
    photos = group([
        img('equipment.jpg', 'Оборудование центра', 'ks-img-fill col-span-4 m-0 h-64 overflow-hidden rounded-2xl border border-line/60'),
        img('procedure.jpg', 'Процедура в кабинете физиотерапии', 'ks-img-fill col-span-2 m-0 h-64 overflow-hidden rounded-2xl border border-line/60'),
        img('reception.jpg', 'Ресепшн центра', 'ks-img-fill col-span-2 m-0 h-56 overflow-hidden rounded-2xl border border-line/60'),
        img('center-inside.jpg', 'Кабинет физиотерапии', 'ks-img-fill col-span-4 m-0 h-56 overflow-hidden rounded-2xl border border-line/60'),
    ], 'grid grid-cols-6 gap-4')
    small = dict(c='ks-card p-5', icon_cls='ks-icon-tile ks-icon-tile--sm', h_cls='mt-4 text-sm font-bold text-ink', t_cls='mt-1.5 text-xs leading-relaxed text-ink/65')
    cards = group([
        card('badge-check', 'Медицинская лицензия', 'Официальная лицензия Л041-01157-39/00638809.', **small),
        card('chip', 'Современное оборудование', 'Сертифицированные аппараты для лазеро-, электро- и магнитотерапии.', **small),
        card('home', 'Выезд на дом', 'Единственный центр в городе с портативным комплексом для лежачих пациентов.', **small),
        card('smile', 'Безболезненность', 'Все процедуры неинвазивны, безопасны и подбираются строго индивидуально.', **small),
    ], 'mt-8 grid gap-4 sm:grid-cols-2')
    text = group([
        eyebrow('Наша миссия'),
        h('Комплексное восстановление — ' + m('бережно и профессионально'), 2, 'mt-2 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl'),
        p('Наш Центр создан для людей, которым необходимо бережное, эффективное и комплексное восстановление. Мы объединили физиотерапию и психоконсультирование, чтобы воздействовать на причину заболевания, а не только на его симптомы.', 'mt-5 text-lg leading-relaxed text-ink/75'),
        cards,
    ])
    return group([container([group([photos, text], 'grid gap-12 lg:grid-cols-2 lg:items-center')])],
                 'scroll-mt-24 border-b border-line/30 bg-white py-20', 'section', 'mission')


@pattern('approach', 'Баннер: физиотерапия + психология', keywords='подход, баннер', description='Мятный баннер о комплексном подходе со списком.')
def approach():
    left = group([
        badge('users', 'Синтез физиотерапии и психологии', 'ks-badge bg-white'),
        h('Почему сочетание физиотерапии и ' + m('психологии') + ' работает лучше?', 2, 'mt-5 text-3xl font-extrabold leading-tight tracking-tight text-ink sm:text-4xl'),
        p('Многие физические симптомы — боли в спине, мышечные зажимы, хроническая усталость — тесно связаны со стрессом и неврологическими состояниями. Наш подход позволяет снять физическую боль и одновременно восстановить эмоциональный баланс.', 'mt-5 text-lg leading-relaxed text-ink/80'),
    ])
    right = ul(['Снятие физической боли и мышечного напряжения', 'Проработка психоэмоциональных причин недомогания', 'Устойчивый результат вместо временного облегчения'],
               'is-style-ks-checklist')
    box = group([group([left, right], 'relative grid gap-8 lg:grid-cols-[1.1fr_1fr] lg:items-center')],
                'ks-glow-card relative overflow-hidden rounded-3xl border border-brand/30 bg-brand-soft/60 p-8 sm:p-12')
    return group([container([box], 'mx-auto max-w-6xl px-6')], 'bg-white py-20', 'section')


@pattern('equipment', 'Оборудование и стандарты', keywords='оборудование, аппараты', description='Три карточки с видами оборудования.')
def equipment():
    def eq(n, icon_name, title, text):
        return group([
            group([icon(icon_name, 'ks-icon-tile ks-icon-tile--lg'), p(n, 'm-0 text-xs font-bold text-brand')], 'flex items-center justify-between'),
            h(title, 3, 'mt-6 text-lg font-bold leading-snug text-ink'),
            p(text, 'mt-2 text-sm leading-relaxed text-ink/70'),
        ], 'ks-card')
    cards = group([
        eq('01', 'lightning', 'Аппараты магнито- и электротерапии', 'Для глубокого снятия воспалений и отёков в тканях.'),
        eq('02', 'sun', 'Лазерные системы', 'Для биостимуляции и ускоренной регенерации тканей на клеточном уровне.'),
        eq('03', 'briefcase', 'Портативные комплексы', 'Специальные мобильные версии приборов для оказания помощи на дому.'),
    ], 'mt-12 grid gap-6 md:grid-cols-3')
    head = section_head('Оборудование и стандарты', 'Наше оборудование и безопасность', 'Мы используем только апробированную медтехнику, прошедшую государственную регистрацию.')
    return group([container([head, cards])], 'scroll-mt-24 border-y border-line/30 bg-surface py-20', 'section', 'equipment')


@pattern('licenses', 'Лицензии и руководитель', keywords='лицензия, документы, руководитель', description='Карточки документов и ссылка на страницу руководителя.')
def licenses():
    def doc(title, date, org_short, icon_name):
        top = group([group([
            icon(icon_name, 'text-brand', 36),
            p('Официальный документ', 'm-0 text-[10px] font-semibold uppercase tracking-widest text-ink/60'),
            p(title, 'm-0 text-sm font-bold leading-tight text-ink'),
            p(date, 'm-0 text-[10px] text-ink/60'),
        ], 'ks-doc__paper')], 'ks-doc')
        bottom = group([p(title, 'm-0 text-sm font-bold text-ink'), p(org_short, 'm-0 text-xs text-ink/60')], 'border-t border-line/60 px-5 py-4')
        return group([top, bottom], 'flex flex-col overflow-hidden rounded-2xl border border-line bg-white')
    leader = group([
        group([
            p('Руководитель центра', 'ks-pill m-0'),
            h('Наталия Николаевна ' + m('Касаткина'), 3, 'mt-4 text-2xl font-extrabold leading-tight text-white'),
            p('Врач-физиотерапевт, психолог. Опыт практики более 15 лет.', 'mt-3 text-sm leading-relaxed text-white/70'),
        ]),
        buttons([button('Подробнее о руководителе', HOME + 'about/leader/', 'ks-solid')], 'mt-8 border-t border-white/10 pt-5'),
    ], 'flex flex-col justify-between rounded-2xl bg-navy p-7 text-white')
    grid = group([
        doc('Лицензия Л041-01157-39/00638809', 'от 25.01.2023 г.', 'Минздрав Калининградской области', 'academic'),
        doc('Аккредитация специалиста', '2022 г.', 'Врач высшей категории', 'badge-check'),
        leader,
    ], 'mt-12 grid gap-6 md:grid-cols-3')
    head = section_head('Лицензии и документы', 'Лицензии и правовая информация', 'Официальные документы подтверждают соответствие нашей деятельности требованиям Минздрава РФ.')
    return group([container([head, grid])], 'scroll-mt-24 border-b border-line/30 bg-white py-20', 'section', 'licenses')


@pattern('gallery', 'Атмосфера центра (галерея)', keywords='галерея, фото', description='Галерея фото с подписями; по клику фото открывается на весь экран.')
def gallery():
    def tile(src, alt, span):
        return img(src, alt, f'is-style-ks-tile col-span-6 m-0 h-64 {span}', lightbox=True, caption=alt)
    grid = group([
        tile('reception.jpg', 'Ресепшн центра', 'md:col-span-4'),
        tile('procedure.jpg', 'Процедура в кабинете', 'md:col-span-2'),
        tile('center-inside.jpg', 'Кабинет физиотерапии', 'md:col-span-2'),
        tile('entrance.jpg', 'Вход в центр', 'md:col-span-4'),
    ], 'mt-12 grid grid-cols-6 gap-4')
    head = section_head('Атмосфера центра', 'Пространство, в котором приятно лечиться', 'Светлые кабинеты, современное оборудование и располагающая обстановка для консультаций. Нажмите на фото, чтобы увеличить.')
    return group([container([head, grid])], 'scroll-mt-24 bg-surface py-20', 'section', 'gallery')


@pattern('booking', 'Форма записи (баннер)', keywords='запись, форма, заявка', description='Карточка «Готовы начать путь к здоровью?» с формой записи.')
def booking():
    left = group([
        group([
            badge('calendar', 'Запись на прием', 'ks-badge bg-white'),
            h('Готовы начать путь к ' + m('здоровью?'), 2, 'mt-5 text-3xl font-extrabold leading-tight tracking-tight text-ink sm:text-4xl'),
            p('Оставьте заявку — администратор свяжется с Вами в течение рабочего дня и поможет подобрать удобное время для консультации.', 'mt-4 text-ink/70'),
        ]),
        block('license-note'),
    ], 'flex flex-col justify-between gap-8 bg-gradient-to-br from-brand-soft/70 via-white to-white p-8 sm:p-10')
    right = group([block('booking-form', {'variant': 'plain', 'title': '', 'subtitle': '', 'buttonText': 'Записаться на консультацию'})],
                  'border-t border-line/50 p-8 sm:p-10 lg:border-l lg:border-t-0')
    box = group([group([left, right], 'grid lg:grid-cols-[1fr_1.1fr]')], 'overflow-hidden rounded-3xl border border-line/60 bg-white shadow-sm')
    return group([container([box], 'mx-auto max-w-6xl px-6')], 'scroll-mt-24 bg-white py-20', 'section', 'booking')


# ───────────────────────────── Руководитель ─────────────────────────────

@pattern('leader-hero', 'Руководитель: первый экран', 'kasatkina-leader', 'руководитель, врач, hero', 'Фото, имя, цитата и кнопки записи.')
def leader_hero():
    left = group([
        badge('sparkles', 'Основатель и главный специалист центра'),
        h('Наталия Николаевна ' + m('Касаткина') + ' (Бочарова)', 1, 'mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-ink sm:text-5xl lg:text-6xl'),
        p('Врач, психолог, специалист по физиотерапевтической реабилитации и работе с посттравматическим стрессовым расстройством.', 'mt-6 max-w-xl text-lg leading-relaxed text-ink/70'),
        group([p('«Моя цель — помочь человеку восстановить не только физическое здоровье, но и эмоциональную гармонию, создавая безопасные условия для лечения».', 'm-0 text-base font-medium italic leading-relaxed text-ink/90')],
              'mt-8 rounded-2xl border-l-4 border-brand bg-brand-soft/60 p-6'),
        buttons([button('Записаться на личный прием', '#booking'), button('Образование и опыт', '#education', 'ks-outline')], 'mt-8'),
    ])
    right = group([
        img('doctor.png', 'Наталия Николаевна Касаткина', 'ks-img-portrait m-0 overflow-hidden rounded-[2rem] border border-line/60 bg-gradient-to-br from-brand-soft/60 to-white shadow-xl'),
        float_badge('academic', '15+ лет', 'клинической практики', 'absolute -left-4 top-10 sm:-left-6'),
        float_badge('office', '2 высших', 'образования', 'absolute -right-4 bottom-10 sm:-right-6'),
    ], 'relative')
    grid = group([left, right], 'mt-8 grid items-center gap-12 lg:grid-cols-[1.1fr_1fr]')
    return group([container([block('breadcrumbs'), grid])], 'ks-glow-tr relative overflow-hidden border-b border-line/60 bg-gradient-to-b from-brand-soft/40 to-white pb-16 pt-8 lg:pb-20 lg:pt-12', 'section')


@pattern('leader-education', 'Руководитель: образование', 'kasatkina-leader', 'образование', 'Четыре карточки с образованием и квалификацией.')
def leader_education():
    def edu(n, tag, title, text):
        return group([group([
            icon('academic', 'ks-icon-tile ks-icon-tile--lg'),
            group([p(f'{n} · {tag}', 'm-0 text-xs font-semibold uppercase tracking-wide text-brand'),
                   h(title, 3, 'mt-2 text-lg font-bold leading-snug text-ink'),
                   p(text, 'mt-2 text-sm leading-relaxed text-ink/65')]),
        ], 'flex items-start gap-5')], 'ks-card')
    grid = group([
        edu('01', 'Высшее образование', 'Врач — Астраханский государственный медицинский университет', 'Фундаментальная подготовка по клинической медицине и физиотерапевтической реабилитации.'),
        edu('02', 'Второе высшее', 'Психолог — Астраханский государственный технический университет', 'Специализация: клиническая психология, психологическое консультирование и психокоррекция.'),
        edu('03', 'Повышение квалификации', 'Физиотерапия, лазеро- и магнитотерапия', 'Специализированные программы по современным аппаратным методикам физиолечения.'),
        edu('04', 'Работа с ПТСР', 'Реабилитация при посттравматическом стрессовом расстройстве', 'Подготовка по психологической помощи и работе с комплексными психотравмами.'),
    ], 'mt-12 grid gap-6 md:grid-cols-2')
    head = section_head('Образование и квалификация', 'Образование и экспертность', 'Фундаментальная медицинская подготовка, психологическое образование и постоянное повышение квалификации по современным методикам реабилитации.')
    return group([container([head, grid])], 'scroll-mt-24 border-b border-line/60 py-16 lg:py-20', 'section', 'education')


@pattern('leader-diplomas', 'Руководитель: дипломы и сертификаты', 'kasatkina-leader', 'дипломы, сертификаты, документы', 'Сканы документов; по клику открываются на весь экран.')
def leader_diplomas():
    files = ['fizio.jpg'] + [f'cert-{i}.jpg' for i in range(1, 11)]
    grid = group([img('diplomas/' + f, f'Диплом или сертификат {i}', 'ks-doc-img m-0', lightbox=True) for i, f in enumerate(files, 1)],
                 'mt-12 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4')
    head = section_head('Дипломы и сертификаты', 'Подтверждённая квалификация', 'Все методики и процедуры в нашем центре лицензированы и соответствуют стандартам Минздрава РФ. Нажмите на документ, чтобы рассмотреть его.')
    return group([container([head, grid])], 'scroll-mt-24 border-b border-line/60 bg-surface py-16 lg:py-20', 'section', 'diplomas')


@pattern('leader-approach', 'Руководитель: подход и философия', 'kasatkina-leader', 'принципы, подход', 'Четыре принципа работы.')
def leader_approach():
    def item(n, title, text):
        return group([icon('check', 'ks-icon-tile ks-icon-tile--lg'), p(n, 'm-0 mt-5 text-xs font-semibold text-brand'),
                      h(title, 3, 'mt-2 text-lg font-bold text-ink'), p(text, 'mt-2 text-sm leading-relaxed text-ink/65')], 'ks-card')
    grid = group([
        item('01', 'Комплексный подход', 'Синергия физиотерапии и психологии для быстрой и устойчивой реабилитации пациента.'),
        item('02', 'Безболезненность и безопасность', 'Использование только сертифицированного низкоинтенсивного медицинского оборудования.'),
        item('03', 'Индивидуальный протокол', 'Подбор программы с учётом возраста, анамнеза и всех противопоказаний пациента.'),
        item('04', 'Доступность', 'Личный выезд с портативным оборудованием к тяжелобольным пациентам на дом.'),
    ], 'mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4')
    return group([container([section_head('Принципы работы', 'Подход и философия'), grid])], 'border-b border-line/60 py-16 lg:py-20', 'section')


@pattern('leader-specialization', 'Руководитель: с чем можно обратиться', 'kasatkina-leader', 'специализация, показания', 'Текст, кнопка записи и список направлений.')
def leader_specialization():
    left = group([
        eyebrow('Специализация'),
        h('С чем можно обратиться', 2, 'mt-3 text-3xl font-extrabold tracking-tight text-ink sm:text-4xl lg:text-5xl'),
        p('Наталия Николаевна принимает пациентов с широким спектром физических и психоэмоциональных состояний. Каждая программа подбирается индивидуально.', 'mt-4 text-ink/70'),
        buttons([button('Записаться на консультацию', '#booking')], 'mt-6'),
    ])
    right = ul(['Лечение остеохондроза, артритов, артрозов и межпозвоночных грыж', 'Реабилитация после операций и острых воспалительных процессов',
                'Психологическая поддержка, работа со стрессом, тревожностью и ПТСР', 'Восстановление подвижности и снятие болевых синдромов на дому'],
               'is-style-ks-checklist sm:grid-cols-2')
    return group([container([group([left, right], 'grid gap-12 lg:grid-cols-[1fr_1.2fr] lg:items-center')])],
                 'border-b border-line/60 bg-surface py-16 lg:py-20', 'section')


HEADER = '''<?php
/**
 * Title: {title}
 * Slug: kasatkina/{slug}
 * Categories: {category}
 * Keywords: {keywords}
 * Description: {description}
 * Viewport Width: 1400
 *
 * Файл сгенерирован из описания секций; правьте разметку здесь или пересоберите (см. README темы).
 */

defined( 'ABSPATH' ) || exit;

$img = get_theme_file_uri( 'assets/images/' );
?>
'''

OUT.mkdir(parents=True, exist_ok=True)
for slug, (title, category, keywords, description, fn) in PATTERNS.items():
    body = fn()
    (OUT / f'{slug}.php').write_text(HEADER.format(title=title, slug=slug, category=category, keywords=keywords, description=description) + body + '\n')
print(len(PATTERNS), 'patterns')
