import { load } from "piecesjs";

document.documentElement.classList.add('is-ready');

load("c-navigation-link", () => import(`/src/scripts/components/NavigationLink.js`));
