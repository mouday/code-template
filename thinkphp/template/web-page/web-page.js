/**
 * page
 * {{name}}.js
 */
import './{{name}}.less'

import Vue from '../../utils/vue.js';
import App from './components/App.vue';

$(function () {
    new Vue({
        el: '#app',
        render: (h) => h(App),
    });
})