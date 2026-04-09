/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./components/**/*.php", "./pages/**/*.php"],
  theme: {
    extend: {
      colors: {
        brand: {
          light: '#3f83f8',
          DEFAULT: '#1c64f2',
          dark: '#1e42af',
        }
      },
    },
  },
  plugins: [],
}