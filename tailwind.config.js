const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    presets: [require('./vendor/filament/filament/tailwind.config.js')],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            // Siagan Bedas Admin — diturunkan dari DESIGN.md (seed teal aplikasi mobile #00686C)
            colors: {
                primary: {
                    50: '#EDFDFE',
                    100: '#C0FBFD',
                    200: '#82F6FB',
                    300: '#3AE9F0',
                    400: '#1CB5BA',
                    500: '#088C91',
                    600: '#047175',
                    700: '#075A5D',
                    800: '#09474A',
                    900: '#0C3B3D',
                },
                danger: {
                    50: '#FCF2F1',
                    100: '#F8D2CF',
                    200: '#F1A4A0',
                    300: '#E36F68',
                    400: '#CB423A',
                    500: '#B3261E',
                    600: '#901C15',
                    700: '#731A15',
                    800: '#5C1A16',
                    900: '#4C1A17',
                },
                success: {
                    50: '#F1FAF2',
                    100: '#D2EFD3',
                    200: '#A4DFA7',
                    300: '#6EC772',
                    400: '#479E4C',
                    500: '#2E7D32',
                    600: '#236426',
                    700: '#1F5121',
                    800: '#1C411E',
                    900: '#1A371C',
                },
                warning: {
                    50: '#FFFBF2',
                    100: '#FFF4D2',
                    200: '#FFE9A5',
                    300: '#FCD96F',
                    400: '#EDC344',
                    500: '#FFC107',
                    600: '#CF9B00',
                    700: '#A87F03',
                    800: '#85660A',
                    900: '#6D560F',
                },
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },
}
