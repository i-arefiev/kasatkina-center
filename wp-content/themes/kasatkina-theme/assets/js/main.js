/**
 * Скрипты сайта: мобильное меню и защита формы от двойной отправки.
 */
( function () {
	// Мобильное меню.
	const btn = document.getElementById( 'ks-menu-btn' );
	const menu = document.getElementById( 'ks-mobile-menu' );
	if ( btn && menu ) {
		const toggle = ( open ) => {
			menu.hidden = ! open;
			btn.setAttribute( 'aria-expanded', String( open ) );
		};
		btn.addEventListener( 'click', () => toggle( menu.hidden ) );
		// Закрываем меню после перехода по якорю (#contacts и т. п.).
		menu.addEventListener( 'click', ( e ) => {
			if ( e.target.closest( 'a' ) ) {
				toggle( false );
			}
		} );
	}

	// Блокируем кнопку после отправки, чтобы заявка не ушла дважды.
	document.querySelectorAll( '.ks-form' ).forEach( ( form ) => {
		form.addEventListener( 'submit', () => {
			const submit = form.querySelector( '[type="submit"]' );
			if ( submit ) {
				submit.disabled = true;
				submit.classList.add( 'opacity-60' );
			}
		} );
	} );
} )();
