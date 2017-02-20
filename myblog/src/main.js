
import Vue from 'vue';

// 配置路由处理
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// 配置全局material组件
import VueMaterial from 'vue-material';
Vue.use(VueMaterial);

// 配置http请求处理
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

import App from './App.vue';

import Content from './PageContent.vue';
Vue.component('my-content', Content);

// 注册主题
Vue.material.registerTheme('default', {
  accent: 'black',
})


import routes from './routes.js';
let router = new VueRouter({
  mode: 'hash',
  base: window.location.pathname,
  routes
});

let Docs = Vue.component('app', App);

Docs = new Docs({
  el: '#app',
  router
});

// 每次路由跳转之前把侧栏关闭
router.beforeEach((to, from, next) => {
  Vue.nextTick(() => {
    Docs.closeSidenav();
    next();
  });
});

