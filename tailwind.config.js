/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./public/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          light: '#e0f2fe',  // sky-100
          DEFAULT: '#0ea5e9', // sky-500
          dark: '#0369a1',    // sky-700
        },
        surface: {
          light: '#ffffff',
          dark: '#f8fafc',    // slate-50
        }
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
