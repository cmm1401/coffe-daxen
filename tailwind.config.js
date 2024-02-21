/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./modules/**/*.{php,js}",
    "./public/**/*.{php,js}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
