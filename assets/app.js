/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

window.onpopstate = function() {
    let switcher = document.getElementById("page-nav");
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('tab');
    let indexToShow = document.querySelector("[data-target='"+ myParam +"']").parentElement.dataset.index
    UIkit.switcher(switcher).show(indexToShow)
}