module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      backgroundImage: {
        'garden-img': "url('./public/images/garden.webp')",
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
