require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

import CoreuiVue from '@coreui/vue';
Vue.use(CoreuiVue);

import store from './store'

import {library} from '@fortawesome/fontawesome-svg-core';
import {
    faAngleDown,
    faMinus,
    faPlus,
    faSearch,
    faUserShield,
    faSync,
    faTimes,
    faQuestionCircle,
    faCamera,
    faAddressCard,
    faExclamationTriangle,
    faCar,
    faUser,
    faIdCard,
    faLaptop,
    faTrafficLight,
    faHandHoldingUsd,
    faWarehouse,
    faEye,
    faBalanceScale,
    faDatabase,
    faTrash,
} from '@fortawesome/free-solid-svg-icons';

import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

library.add(
    faSearch,
    faMinus,
    faPlus,
    faUserShield,
    faAngleDown,
    faSync,
    faTimes,
    faQuestionCircle,
    faCamera,
    faAddressCard,
    faExclamationTriangle,
    faCar,
    faUser,
    faIdCard,
    faLaptop,
    faTrafficLight,
    faHandHoldingUsd,
    faWarehouse,
    faEye,
    faBalanceScale,
    faDatabase,
    faTrash,
);

Vue.component('font-awesome-icon', FontAwesomeIcon);

import {iconsSet as icons} from './../assets/icons/icons'

import _ from 'lodash';
Object.defineProperty(Vue.prototype, '$_', { value: _ });

import VueAlertify from 'vue-alertify';
Vue.use(VueAlertify);

Vue.use(require('vue-moment'));


import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import money from 'v-money'
// register directive v-money and component <money>
Vue.use(money, {
    decimal: ',',
    thousands: '.',
    prefix: 'R$ ',
    suffix: '',
    precision: 2,
    masked: false
})

const app = document.getElementById('app');

new Vue({
    store,
    icons,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
