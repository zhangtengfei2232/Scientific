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
                path: '/selfProject/:pro_id',
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
                path: '/selfBook/:op_id',
                component: resolve => void(require(['../components/book/selfBook.vue'], resolve))
            },
             /*获奖信息*/
             {
                name: 'award',
                path: '/award',
                component: resolve => void(require(['../components/award/award.vue'], resolve))
            },
            {
                name: 'addAward',
                path: '/addAward',
                component: resolve => void(require(['../components/award/addAward.vue'], resolve))
            },
            {
                name: 'selfAward',
                path: '/selfAward/:aw_id',
                component: resolve => void(require(['../components/award/selfAward.vue'], resolve))
            },
            /*专利信息*/
            {
                name: 'patent',
                path: '/patent',
                component: resolve => void(require(['../components/patent/patent.vue'], resolve))
            },
            {
                name: 'addPatent',
                path: '/addPatent',
                component: resolve => void(require(['../components/patent/addPatent.vue'], resolve))
            },
            {
                name: 'selfPatent',
                path: '/selfPatent',
                component: resolve => void(require(['../components/patent/selfPatent.vue'], resolve))
            },
            /*成果鉴定信息*/
            {
                name: 'appraisal',
                path: '/appraisal',
                component: resolve => void(require(['../components/appraisal/appraisal.vue'], resolve))
            },
            {
                name: 'addAppraisal',
                path: '/addAppraisal',
                component: resolve => void(require(['../components/appraisal/addAppraisal.vue'], resolve))
            },
            {
                name: 'selfAppraisal',
                path: '/selfAppraisal',
                component: resolve => void(require(['../components/appraisal/selfAppraisal.vue'], resolve))
            },
            /*举办会议信息*/
            {
                name: 'holdmeet',
                path: '/holdmeet',
                component: resolve => void(require(['../components/holdmeet/holdmeet.vue'], resolve))
            },
            {
                name: 'addHoldmeet',
                path: '/addHoldmeet',
                component: resolve => void(require(['../components/holdmeet/addHoldmeet.vue'], resolve))
            },
            {
                name: 'selfHoldmeet',
                path: '/selfHoldmeet',
                component: resolve => void(require(['../components/holdmeet/selfHoldmeet.vue'], resolve))
            },
            /*参加会议信息*/
            {
                name: 'joinmeet',
                path: '/joinmeet',
                component: resolve => void(require(['../components/joinmeet/joinmeet.vue'], resolve))
            },
            {
                name: 'addJoinmeet',
                path: '/addJoinmeet',
                component: resolve => void(require(['../components/joinmeet/addJoinmeet.vue'], resolve))
            },
            {
                name: 'selfJoinmeet',
                path: '/selfJoinmeet',
                component: resolve => void(require(['../components/joinmeet/selfJoinmeet.vue'], resolve))
            },
            /*全局总览*/
            {
                name: 'Glverview',
                path: '/Glverview',
                component: resolve => void(require(['../components/globalOverview/Glverview.vue'], resolve))
            },
            
      ]

})