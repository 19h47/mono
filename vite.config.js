import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import viteSvgSpriteWrapper from "vite-svg-sprite-wrapper";
import viteCompression from "vite-plugin-compression";

export default defineConfig({
	base: "",
	build: {
		manifest: true,
		outDir: "dist",
		assetsDir: "src",
	},
	plugins: [
		laravel({
			publicDirectory: "dist",
			input: ["src/stylesheets/styles.css", "src/scripts/app.js"],
			refresh: ["**.php", "**.twig"],
		}),
		viteSvgSpriteWrapper({
			icons: "src/icons/*.svg",
			outputDir: "public",
		}),
		viteCompression(),
	],
	resolve: {
		alias: [
			{
				find: /~(.+)/,
				replacement: process.cwd() + "/node_modules/$1",
			},
		],
	},
});
