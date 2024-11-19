module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        sky: {
          '500': '#01A6DE',
        },
        blue: {
          '500': '#01A6DE',
        },
      },
    },
    fontFsElliot: {
      'fs-elliot-pro': ['"FS Elliot Pro"', 'sans-serif'],
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}
