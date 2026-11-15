/**
 * Сборка стилей темы: `npm run build` (или `npm run watch` во время разработки).
 * Результат — assets/css/main.css, он хранится в репозитории, поэтому на сервере Node.js не нужен.
 *
 * @type {import('tailwindcss').Config}
 */
module.exports = {
	content: [
		'./*.php',
		'./inc/**/*.php',
		'./blocks/**/*.php',
		'./patterns/**/*.php',
		'./template-parts/**/*.php',
		'./assets/js/**/*.js',
	],
	theme: {
		extend: {
			// Крупные размеры ограничены шириной колонки (cqi): длинное слово
			// («психоконсультирование») уменьшает шрифт, а не рвётся. См. src/main.css.
			fontSize: {
				'3xl': [ 'min(1.875rem, 8cqi)', { lineHeight: '1.2' } ],
				'4xl': [ 'min(2.25rem, 8cqi)', { lineHeight: '1.12' } ],
				'5xl': [ 'min(3rem, 8cqi)', { lineHeight: '1.08' } ],
				'6xl': [ 'min(3.75rem, 8cqi)', { lineHeight: '1.05' } ],
			},
			colors: {
				brand: {
					DEFAULT: '#3BC68B',
					dark: '#2EB078',
					soft: '#EBF9F3',
				},
				ink: '#1E293B',
				navy: '#0F172A',
				surface: '#FAFBFC',
				line: 'rgb(192 192 192 / <alpha-value>)',
			},
		},
	},
	plugins: [],
};
