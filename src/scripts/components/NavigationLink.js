import { Piece } from "piecesjs";

class NavigationLink extends Piece {
	constructor() {
		super("NavigationLink");

		document.body.classList.add("transition-colors");
		document.body.classList.add("duration-700");
		document.body.classList.add("ease-in-out");
	}

	mount() {
		this.addEventListener("mouseenter", () => {
			document.body.style.setProperty("background-color", this.getAttribute("data-color"));
		});

		this.addEventListener("mouseleave", () => {
			document.body.style.removeProperty("background-color");
		});
	}
}

customElements.define("c-navigation-link", NavigationLink);
