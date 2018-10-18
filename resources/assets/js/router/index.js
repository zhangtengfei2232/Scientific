import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

export default new VueRouter({
      saveScrollPosition: true,
      routes: [
            /*个人信息*/
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
             /*论文信息*/
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
                path: '/selfInfor/:art_id',
                component: resolve => void(require(['../components/article/selfInfor.vue'], resolve))
            },
             /*项目信息*/
            {
                name: 'project',
                path: '/project',
                component: resolve => void(require(['../components/project/project.vue'], resolve))
            },
            {
                name: 'addProject',
                path: '/addProject',
                component: resolve => void(require(['../components/project/addProject.vue'], resolve))
            },
            {
                name: 'selfProject',
                path: '/selfProject/:',
                component: resolve => void(require(['../components/project/selfProject.vue'], resolve))
            },
            /*著作信息*/
            {
                name: 'book',
                path: '/book',
                component: resolve => void(require(['../components/book/book.vue'], resolve))
            },
            {
                name: 'addBook',
                path: '/addBook',
                component: resolve => void(require(['../components/book/addBook.vue'], resolve))
            },
            {
                name: 'selfBook',
                path: '/selfBook',
                component: resolve => void(require(['../components/book/selfBook.vue'], resolve))
            },
      ]

})