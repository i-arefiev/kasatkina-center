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

	// Видео в окне: кнопки со стилем «Видео»/«Круглая play» и ссылки .ks-video-link.
	const modal = document.getElementById( 'ks-video-modal' );
	const frame = modal && modal.querySelector( '[data-ks-video-frame]' );
	const embedUrl = ( href ) => {
		let m;
		if ( ( m = href.match( /(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([\w-]{11})/ ) ) ) {
			return 'https://www.youtube.com/embed/' + m[ 1 ] + '?autoplay=1&rel=0';
		}
		if ( ( m = href.match( /rutube\.ru\/(?:video|play\/embed)\/([a-f0-9]{32})/ ) ) ) {
			return 'https://rutube.ru/play/embed/' + m[ 1 ] + '?autoplay=1';
		}
		if ( ( m = href.match( /vk(?:video)?\.(?:com|ru)\/video(-?\d+)_(\d+)/ ) ) ) {
			return 'https://vk.com/video_ext.php?oid=' + m[ 1 ] + '&id=' + m[ 2 ] + '&autoplay=1';
		}
		return null;
	};
	const closeVideo = () => {
		if ( modal.open ) {
			modal.close();
		}
	};
	if ( modal && frame && typeof modal.showModal === 'function' ) {
		document.addEventListener( 'click', ( e ) => {
			const link = e.target.closest( '.is-style-ks-video a, .is-style-ks-play a, a.ks-video-link' );
			if ( ! link || ! link.href ) {
				return;
			}
			const href = link.getAttribute( 'href' );
			const isFile = /\.(mp4|webm|mov)(\?|#|$)/i.test( href );
			const embed = isFile ? null : embedUrl( href );
			if ( ! isFile && ! embed ) {
				return; // обычная ссылка — пусть открывается как есть
			}
			e.preventDefault();
			frame.innerHTML = '';
			if ( isFile ) {
				const video = document.createElement( 'video' );
				video.src = link.href;
				video.controls = true;
				video.autoplay = true;
				video.playsInline = true;
				frame.appendChild( video );
				video.play().catch( () => {} );
			} else {
				const iframe = document.createElement( 'iframe' );
				iframe.src = embed;
				iframe.allow = 'autoplay; fullscreen; picture-in-picture; encrypted-media';
				iframe.allowFullscreen = true;
				iframe.title = link.textContent.trim() || 'Видео';
				frame.appendChild( iframe );
			}
			modal.showModal();
			if ( window.ym && window.kasatkinaMetrika ) {
				window.ym( window.kasatkinaMetrika, 'reachGoal', 'video_play' );
			}
		} );
		// Закрытие: кнопка, клик по фону, Esc. Видео останавливается.
		modal.addEventListener( 'click', ( e ) => {
			if ( e.target === modal || e.target.closest( '[data-ks-video-close]' ) ) {
				closeVideo();
			}
		} );
		modal.addEventListener( 'close', () => {
			frame.innerHTML = '';
		} );
	}

	// Заявки отправляются без перезагрузки страницы: форма заменяется сообщением на том же месте.
	// Если скрипт не сработал — форма уйдёт обычным способом (с возвратом на страницу).
	document.querySelectorAll( '.ks-form' ).forEach( ( form ) => {
		form.addEventListener( 'submit', async ( e ) => {
			const box = form.parentElement;
			const submit = form.querySelector( '[type="submit"]' );
			const success = box.querySelector( '[data-ks-success]' );
			const error = box.querySelector( '[data-ks-error]' );
			if ( ! window.fetch || ! success ) {
				return;
			}
			e.preventDefault();
			if ( submit ) {
				submit.disabled = true;
				submit.classList.add( 'opacity-60' );
			}
			const data = new FormData( form );
			data.append( 'ks_ajax', '1' );
			try {
				// form.action не годится: его перекрывает скрытое поле name="action".
				const res = await fetch( form.getAttribute( 'action' ), { method: 'POST', body: data, credentials: 'same-origin' } );
				const json = await res.json();
				if ( json && json.ok ) {
					form.hidden = true;
					if ( error ) {
						error.hidden = true;
					}
					const subtitle = box.querySelector( '[data-ks-subtitle]' );
					if ( subtitle ) {
						subtitle.hidden = true;
					}
					success.hidden = false;
					if ( window.ym && window.kasatkinaMetrika ) {
						window.ym( window.kasatkinaMetrika, 'reachGoal', 'booking_sent' );
					}
				} else if ( error ) {
					error.hidden = false;
				}
			} catch ( err ) {
				form.submit(); // сеть/сервер ответили не так — отправляем обычным способом
				return;
			}
			if ( submit ) {
				submit.disabled = false;
				submit.classList.remove( 'opacity-60' );
			}
		} );
	} );

	// Плашка о cookies: показываем, пока посетитель не нажал «Понятно».
	const cookie = document.getElementById( 'ks-cookie' );
	if ( cookie ) {
		let accepted = false;
		try {
			accepted = window.localStorage.getItem( 'ks_cookie_ok' ) === '1';
		} catch ( e ) {}
		if ( ! accepted ) {
			cookie.hidden = false;
		}
		cookie.querySelector( '[data-ks-cookie-ok]' ).addEventListener( 'click', () => {
			cookie.hidden = true;
			try {
				window.localStorage.setItem( 'ks_cookie_ok', '1' );
			} catch ( e ) {}
		} );
	}

	// Плавная прокрутка — только для кликов по якорям на странице, но не при открытии
	// страницы по ссылке с #якорем (иначе страница сначала уезжает вверх, потом едет вниз).
	window.addEventListener( 'load', () => {
		requestAnimationFrame( () => document.documentElement.classList.add( 'ks-smooth' ) );
	} );
} )();
