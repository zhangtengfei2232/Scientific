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
              component: resolve => void(require(['../components/article/paper.vue'], resolve))
          },
          {
              name: 'addPaper',
              path: '/addPaper',
              component: resolve => void(require(['../components/article/addPaper.vue'], resolve))
          },
          {
            name: 'selfInfor',
            path: '/selfInfor/:paper_id',
            component: resolve => void(require(['../components/article/selfInfor.vue'], resolve))
          },
          {
              name: 'project',
              path: '/project',
              component: resolve => void(require(['../components/project/project.vue'], resolve))
          },
      ]

})