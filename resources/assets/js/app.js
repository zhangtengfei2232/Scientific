
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
/**
 * app.js 是构建 Vue 项目的主文件，
 * 最后所有的组件都会被引入到这个文件，在引入所有组件之前，bootstrap.js 文件做了一些初始化的操作。
 * 同时，因为有了 window.Vue = require(‘vue’)
 * 这句话，就不再需要使用 import Vue from ‘vue’ 重复导入 Vue 了。
 */
require('./bootstrap');

window.Vue = require('vue');
require("babel-polyfill");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    import '../css/element-color/index.css'
    import App from './App.vue';
    import router from "./router/index.js"
    import axios from 'axios';
    import echarts from 'echarts' //引入echarts
    import $ from 'jquery';
    Vue.prototype.$echarts = echarts //引入组件
    Vue.prototype.$axios = axios;
    Vue.use(ElementUI);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});

// const router = new VueRouter({
//   mode: 'history',
//   routes: [
//     { path: '*', component: NotFoundComponent }
//   ]
// })
