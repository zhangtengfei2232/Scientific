import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);



export default new VueRouter({
      saveScrollPosition: true,
      routes: [
          {
              path: '/teacher',
              component: resolve => void(require(['../components/teacher/teacher.vue'], resolve))
          }
      ]

})