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
