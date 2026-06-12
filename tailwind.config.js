/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./template-parts/*.php"],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: { DEFAULT: '#6366f1', light: '#818cf8', dark: '#4f46e5' },
        accent: { DEFAULT: '#10b981', light: '#34d399', dark: '#059669' },
        zinc: { 950: '#09090b' }
      },
      fontFamily: {
        vazir: ['Vazirmatn', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
