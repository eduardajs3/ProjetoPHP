/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.jsx'],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
      colors: {
        primary: '#A855F7',
        secondary: '#EC4899',
        button: '#EC4899',
        background: '#FAF5FF',
        border: '#E2E8F0',
        placeholder: '#94A3B8',
        inputText: '#1E293B',
        title: '#1E293B',
        text: '#9CA3AF',
        link: '#EC4899',
        borderError: '#F87171',
        textError: '#F87171',
        outline: '#EC4899',
        buttonOutline: '#FDF2F8',
        box: '#F3E8FF',
        online: '#4ADE80',
      },
      boxShadow: {
        'inner-outline': 'inset 0 4px 6px rgba(236, 72, 153, 0.5), inset 0 -1px 3px rgba(236, 72, 153, 0.3)',
      },
      borderRadius: {
        'custom': '0 32px 32px 0',
        'tfoot': '0 0 8px 8px',
      },
    },
  },
  plugins: [],
};
