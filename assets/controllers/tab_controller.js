import { Controller } from 'stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        const urlParams = new URLSearchParams(window.location.search);
        let tabTarget = this.element.dataset.target;
        this.element.onclick = () => {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab='+tabTarget;
            window.history.pushState({path:newurl},newtitle,newurl);
            var newtitle = this.element.innerHTML + " - Benjamin Alerte";
            document.title = newtitle
        }
    }
}
