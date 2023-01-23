/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ImageFormPreview from './components/ImageFormPreview.vue';
app.component('image-form-preview', ImageFormPreview);

import WindowAlert from './components/layouts/WindowAlert.vue';
app.component('window-alert', WindowAlert);

import SideBarMenuAdmin from './components/layouts/SideBarMenuAdmin.vue';
app.component('side-bar-menu-admin', SideBarMenuAdmin);

import ScarvesListAdmin from './components/admin/ScarvesListAdmin.vue';
app.component('scarves-list-admin', ScarvesListAdmin);

import ScarvesItemAdmin from './components/admin/ScarvesItemAdmin.vue';
app.component('scarves-item-admin', ScarvesItemAdmin);

import VueperSlidesInit from './components/layouts/VueperSlidesInit.vue';
app.component('slides-init', VueperSlidesInit);

/**
 * Font awesome
 */
import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faTableColumns, faVest, faBars, faEarthEurope} from '@fortawesome/free-solid-svg-icons'

library.add(faTableColumns)
library.add(faVest)
library.add(faBars)
library.add(faEarthEurope)

app.component('font-awesome-icon', FontAwesomeIcon);

/**
 * Sweet alert
 */
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
app.use(VueSweetalert2)

/**
 * vueper sildes
 */
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
app.component('vueper-slides', VueperSlides)
app.component('vueper-slide', VueperSlide)
/**
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
