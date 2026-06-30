/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./template-parts/*.php", "./src/**/*.php"],
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
        vazir: ['Vazirmatn', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}