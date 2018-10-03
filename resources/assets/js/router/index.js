import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);



export default new VueRouter({
      saveScrollPosition: true,
      routes: [
          {
              name: 'infor',
              path: '/',
              component: resolve => void(require(['../components/teacher/infor.vue'], resolve))
          },
          {
              name: 'teacher',
              path: '/teacher',
              component: resolve => void(require(['../components/teacher/teacher.vue'], resolve))
          },
          {
              name: 'paper',
              path: '/paper',
              component: resolve => void(require(['../components/teacher/paper.vue'], resolve))
          },

      ]

})