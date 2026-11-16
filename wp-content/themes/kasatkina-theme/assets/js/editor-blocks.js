/**
 * Интерфейс собственных блоков темы в редакторе.
 * Сами блоки (название, атрибуты) описаны в blocks/<имя>/block.json, вывод — в render.php.
 * Здесь только настройки в боковой панели и предпросмотр. Сборка не нужна.
 */
( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el, Fragment } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, SelectControl, RangeControl, TextControl, ToggleControl, Notice } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { useSelect } = wp.data;

	const icons = window.kasatkinaIcons || {};
	const iconOptions = Object.keys( icons ).map( ( key ) => ( { value: key, label: icons[ key ].label } ) );

	/** Поле настройки по описанию { key, type, label, help, options }. */
	function control( field, attributes, setAttributes ) {
		const value = attributes[ field.key ];
		const onChange = ( v ) => setAttributes( { [ field.key ]: v } );
		const common = { key: field.key, label: field.label, help: field.help, __nextHasNoMarginBottom: true };
		switch ( field.type ) {
			case 'toggle':
				return el( ToggleControl, Object.assign( {}, common, { checked: !! value, onChange } ) );
			case 'select':
				return el( SelectControl, Object.assign( {}, common, { value, options: field.options, onChange } ) );
			case 'number':
				return el( RangeControl, Object.assign( {}, common, { value, min: field.min, max: field.max, onChange } ) );
			default:
				return el( TextControl, Object.assign( {}, common, { value: value || '', onChange } ) );
		}
	}

	/** Блок с серверным предпросмотром и панелью настроек. */
	function ssrBlock( name, fields, note ) {
		registerBlockType( name, {
			edit( { attributes, setAttributes } ) {
				const postId = useSelect( ( select ) => select( 'core/editor' ) && select( 'core/editor' ).getCurrentPostId(), [] );
				const blockProps = useBlockProps();
				const panel = ( fields.length || note ) && el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: 'Настройки', initialOpen: true },
						note && el( Notice, { status: 'info', isDismissible: false }, note ),
						fields.map( ( f ) => control( f, attributes, setAttributes ) )
					)
				);
				return el(
					Fragment,
					null,
					panel,
					el(
						'div',
						blockProps,
						el( ServerSideRender, {
							block: name,
							attributes,
							urlQueryArgs: postId ? { post_id: postId } : {},
							skipBlockSupportAttributes: true,
						} )
					)
				);
			},
			save: () => null,
		} );
	}

	// «Иконка» рисуется прямо в редакторе, без запроса на сервер.
	registerBlockType( 'kasatkina/icon', {
		edit( { attributes, setAttributes } ) {
			const icon = icons[ attributes.icon ] || icons.sparkles || { svg: '' };
			const svg = icon.svg.replace( /width="24" height="24"/, 'width="' + attributes.size + '" height="' + attributes.size + '"' );
			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: 'Иконка', initialOpen: true },
						el( SelectControl, { label: 'Картинка', value: attributes.icon, options: iconOptions, onChange: ( v ) => setAttributes( { icon: v } ), __nextHasNoMarginBottom: true } ),
						el( RangeControl, { label: 'Размер, px', value: attributes.size, min: 12, max: 64, onChange: ( v ) => setAttributes( { size: v } ), __nextHasNoMarginBottom: true } )
					)
				),
				el( 'span', Object.assign( {}, useBlockProps(), { dangerouslySetInnerHTML: { __html: svg } } ) )
			);
		},
		save: () => null,
	} );

	ssrBlock( 'kasatkina/breadcrumbs', [], 'Путь строится автоматически по структуре страниц.' );

	ssrBlock( 'kasatkina/services-grid', [
		{ key: 'limit', type: 'number', label: 'Сколько услуг показать', min: 1, max: 30 },
		{ key: 'cardStyle', type: 'select', label: 'Вид карточек', options: [ { value: 'icon', label: 'С иконкой' }, { value: 'photo', label: 'С фото и ценой' } ] },
		{ key: 'category', type: 'text', label: 'Только категория (ярлык)', help: 'Оставьте пустым, чтобы показать все услуги. Ярлык — в «Услуги → Категории услуг».' },
		{ key: 'showMore', type: 'toggle', label: 'Тёмная карточка «Подробнее об услугах»' },
		{ key: 'moreTitle', type: 'text', label: 'Текст тёмной карточки' },
		{ key: 'moreText', type: 'text', label: 'Подпись тёмной карточки' },
	], 'Карточки берутся из раздела «Услуги». Порядок — поле «Порядок» в услуге.' );

	ssrBlock( 'kasatkina/contact-info', [], 'Адрес, телефоны и почта меняются в «Внешний вид → Настроить → Контакты и общие тексты».' );

	ssrBlock( 'kasatkina/booking-form', [
		{ key: 'title', type: 'text', label: 'Заголовок формы' },
		{ key: 'subtitle', type: 'text', label: 'Подзаголовок' },
		{ key: 'buttonText', type: 'text', label: 'Текст кнопки' },
		{ key: 'showService', type: 'toggle', label: 'Выбор услуги' },
		{ key: 'showComment', type: 'toggle', label: 'Поле для комментария' },
		{ key: 'variant', type: 'select', label: 'Оформление', options: [ { value: 'card', label: 'В рамке' }, { value: 'plain', label: 'Без рамки' } ] },
	], 'Заявки сохраняются в разделе «Заявки» и приходят на почту из настроек сайта.' );

	ssrBlock( 'kasatkina/map', [
		{ key: 'height', type: 'number', label: 'Высота, px', min: 250, max: 800 },
	], 'Ссылка на карту меняется в «Внешний вид → Настроить → Контакты и общие тексты».' );

	ssrBlock( 'kasatkina/license-note', [], 'Текст меняется в «Внешний вид → Настроить → Контакты и общие тексты».' );

	ssrBlock( 'kasatkina/operator-details', [], 'Реквизиты меняются в «Внешний вид → Настроить → Реквизиты (оператор персональных данных)».' );
} )( window.wp );
