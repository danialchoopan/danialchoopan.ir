/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./template-parts/*.php", "./page-*.php"],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#FFD700',
          dark: '#E9C400',
        },
        secondary: {
          DEFAULT: '#39FF14',
        },
        surface: {
          DEFAULT: '#131313',
          container: '#201f1f',
          darkest: '#0e0e0e',
          high: '#2a2a2a',
        },
        border: {
          DEFAULT: '#262626',
          subtle: '#4d4732',
        }
      },
      fontFamily: {
        sora: ['Sora', 'sans-serif'],
        ibm: ['IBM Plex Sans', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
        vazir: ['Vazirmatn', 'sans-serif'],
      },
      borderRadius: {
        'sm': '0.125rem',
        'DEFAULT': '0.25rem',
        'md': '0.375rem',
        'lg': '0.5rem',
        'xl': '0.75rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
