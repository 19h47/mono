const { fontFamily } = require("tailwindcss/defaultTheme");
const colors = require('./colors.json');

const borderRadius = {};
const fontSize = {};
const maxWidth = {};
const spacing = {};
const transitionDuration = {};

const zIndex = {
	1: "1",
	2: "2",
	3: "3",
	4: "4",
	5: "5",
	9: "9",
};

module.exports = {
	content: ["./views/**/*.twig", "./src/**/*.{html,js}", "./includes/**/*.{php,json}"],
	theme: {
		container: false,
		extend: {
			screens: {
				'prototype': '1440px',
			},
			gridTemplateColumns: {},
			gridColumn: {},
			borderRadius,
			colors,
			fontSize,
			maxWidth,
			spacing,
			transitionDuration,
			zIndex,
		},
		fontFamily: {
			heading: ['stadio-now-variable', ...fontFamily.sans],
			body: ['obviously-variable', ...fontFamily.sans],
		},
		animation: {
			floating: 'floating 10s ease-in-out infinite',
		},
		keyframes: {
			floating: {
				'0%, 100%': { transform: 'rotate(0)' },
				'50%': { transform: 'translatey(-1.25rem)' },
			},
		}
	},
};
