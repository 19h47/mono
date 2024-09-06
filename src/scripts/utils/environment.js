const html = document.documentElement;
const { body } = document;
const isDebug = html.hasAttribute("data-debug");

const scroll = {
	y: 0,
	x: 0,
};

const breakpoints = {
	lg: window.matchMedia("(min-width: 1024px)"),
	xl: window.matchMedia("(min-width: 1280px)"),
	"2xl": window.matchMedia("(min-width: 1440px)"),
	"3xl": window.matchMedia("(min-width: 1920px)"),
};

const production = "production" === process.env.NODE_ENV;

export { html, body, isDebug, scroll, breakpoints, production };
