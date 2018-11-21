import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

export default new VueRouter({
      saveScrollPosition: true,
      routes: [
            {
                path: "/404",
                name: "notFound",
                component: resolve => void(require(['../components/notFound.vue'], resolve))
            },
            {
                path: "*", // 此处需特别注意置于最底部
                redirect: "/404"
            },
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
                path: '/selfPatent/:pa_id',
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
                path: '/selfAppraisal/:ap_id',
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
                path: '/selfHoldmeet/:ho_id',
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
                path: '/selfJoinmeet/:jo_id',
                component: resolve => void(require(['../components/joinmeet/selfJoinmeet.vue'], resolve))
            },
           // 专家讲学
            {
                name: 'lecture',
                path: '/lecture',
                component: resolve => void(require(['../components/lecture/lecture.vue'], resolve))
            },
            {
                name: 'addLecture',
                path: '/addLecture/',
                component: resolve => void(require(['../components/lecture/addLecture.vue'], resolve))
            },
            {
                name: 'editLecture',
                path: '/editLecture/:le_id',
                component: resolve => void(require(['../components/lecture/editLecture.vue'], resolve))
            },
            // 担任学术团体职务
            {
                name: 'duties',
                path: '/duties',
                component: resolve => void(require(['../components/duties/duties.vue'], resolve))
            },
            {
                name: 'addDuties',
                path: '/addDuties',
                component: resolve => void(require(['../components/duties/addDuties.vue'], resolve))
            },
            {
                name: 'editDuties',
                path: '/editDuties/:du_id',
                component: resolve => void(require(['../components/duties/editDuties.vue'], resolve))
            },
            // 校发文件
            {
                name: 'schoolfile',
                path: '/schoolFile',
                component: resolve => void(require(['../components/schoolfile/schoolFile.vue'], resolve))
            },
            {
                name: 'addSchoolFile',
                path: '/addSchoolFile',
                component: resolve => void(require(['../components/schoolfile/addSchoolFile.vue'], resolve))
            },
            {
                name: 'selfSchoolFile',
                path: '/selfSchoolFile/:schfile_id',
                component: resolve => void(require(['../components/schoolfile/selfSchoolFile.vue'], resolve))
            },
            // 教学科研等合作协议
            {
                name: 'agreement',
                path: '/agreement',
                component: resolve => void(require(['../components/agreement/agreement.vue'], resolve))
            },
            {
                name: 'addAgreement',
                path: '/addAgreement',
                component: resolve => void(require(['../components/agreement/addAgreement.vue'], resolve))
            },
            {
                name: 'editAgreement',
                path: '/editAgreement/:agree_id',
                component: resolve => void(require(['../components/agreement/editAgreement.vue'], resolve))
            },
            //添加老师
            {
                name: 'addTeacher',
                path: '/addTeacher',
                component: resolve => void(require(['../components/addteacher/addTeacher.vue'], resolve))
            },
            /*全局总览*/
            {
                name: 'Glverview',
                path: '/Glverview',
                component: resolve => void(require(['../components/globalOverview/Glverview.vue'], resolve))
            },
            // 所有老师信息
            {
                name: 'teachers',
                path: '/loaderList/teacher',
                component: resolve => void(require(['../components/loaderList/teacher.vue'], resolve))
            },
            //所有论文信息
            {
                name: 'articles',
                path: '/loaderList/article',
                component: resolve => void(require(['../components/loaderList/article.vue'], resolve))
            },
            //所有项目信息
            {
                name: 'projects',
                path: '/loaderList/project',
                component: resolve => void(require(['../components/loaderList/project.vue'], resolve))
            },
            //所有著作信息
            {
                name: 'apus',
                path: '/loaderList/apus',
                component: resolve => void(require(['../components/loaderList/apus.vue'], resolve))
            },
            //所有获奖信息
            {
                name: 'awards',
                path: '/loaderList/award',
                component: resolve => void(require(['../components/loaderList/award.vue'], resolve))
            },
            //所有专利信息
            {
                name: 'patents',
                path: '/loaderList/patent',
                component: resolve => void(require(['../components/loaderList/patent.vue'], resolve))
            },
             //所有成果鉴定信息
             {
                name: 'appraisals',
                path: '/loaderList/appraisal',
                component: resolve => void(require(['../components/loaderList/appraisal.vue'], resolve))
            },
            //所有举办会议信息
            {
                name: 'holdmeets',
                path: '/loaderList/holdmeet',
                component: resolve => void(require(['../components/loaderList/holdmeet.vue'], resolve))
            },
            //所有参加会议信息
            {
                name: 'joinmeets',
                path: '/loaderList/joinmeet',
                component: resolve => void(require(['../components/loaderList/joinmeet.vue'], resolve))
            },
            //所有专家讲学信息
            {
                name: 'lectures',
                path: '/loaderList/lecture',
                component: resolve => void(require(['../components/loaderList/lecture.vue'], resolve))
            },
            //所有担任学术团体职务信息
            {
                name: 'dutiess',
                path: '/loaderList/duties',
                component: resolve => void(require(['../components/loaderList/duties.vue'], resolve))
            },
            //所有校发文件信息
            {
                name: 'schoolfiles',
                path: '/loaderList/schoolfile',
                component: resolve => void(require(['../components/loaderList/schoolfile.vue'], resolve))
            },
            //所有教学科研等合作协议信息
            {
                name: 'agreements',
                path: '/loaderList/agreement',
                component: resolve => void(require(['../components/loaderList/agreement.vue'], resolve))
            },
      ]

})
