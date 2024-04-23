/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
          fontFamily: {
            'sans': ['Roboto', 'sans-serif'],
          },
          colors: {
            'coklat': '#2B1511',
            'abu': 'rgba(217, 217, 217, 0.50);',
            'hijau': '#00FF1A',
            'bgutama': '#D7CCC8',
            'hijau_muda': '#00FF1A',
          },
        },
    },
    plugins: [
      require('flowbite/plugin')
    ],
};
