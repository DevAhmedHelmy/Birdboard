// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
    },
    fontFamily: {
      display: ['Gilroy', 'sans-serif'],
      body: ['Graphik', 'sans-serif'],
    },
    borderWidth: {
      default: '1px',
      '0': '0',
      '2': '2px',
      '4': '4px',
    },
    extend: {
      colors: {
      transparent: 'transparent',
      black: '#000',
      white: '#fff',
      gray: {
        500: '#000',
        // ...
        900: '#1a202c',
      },

      // ...
    },
      spacing: {
        '96': '24rem',
        '128': '32rem',
      }
    }
  }
}