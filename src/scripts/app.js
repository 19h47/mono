import { load } from "piecesjs";

import.meta.glob("../img/**/*");

document.documentElement.classList.add('is-ready');

load("c-navigation-link", () => import(`/src/scripts/components/NavigationLink.js`));
