<template>
    <div>
        <div class="nav">
            <div class="navLeft">
                <img src="/dist/img/hist.png" alt="未加载">
            </div>
            <div class="navRight">
                <!--<span><img src="/dist/img/sort.png" alt="未加载"></span>-->
                <span>生命科技学院科研管理系统</span>
                <div class="loginName">
                    <!--<img src="/dist/img/my.png" alt="未加载">-->
                    <i class="el-icon-view"></i>
                    <span style="margin-right: 15px;">{{ teacherDate.name }}</span>
                    <!--<span class="house">-->
                    <span style="margin-left: 10px;">退出系统</span><i class="el-icon-caret-right"></i>
                    <!--<img src="/dist/img/home.png" alt="未加载">-->
                    <!--</span>-->
                </div>
            </div>
        </div>
        <div class="aside">
            <!--<p class="signIn is-active"><router-link to="/"><img src="/dist/img/wang_light.png" alt=""><span>{{ teacherDate.name }}</span></router-link></p>-->
            <el-menu
                    :default-active="this.$router.path"
                    background-color="rgb(34,45,50)"
                    text-color="#fff"
                    active-text-color="#ffd04b"
                    mode="horizontal"
                    class="el-menu-vertical-demo"
                    router>
                <el-menu-item index="/" class="signIn" style="height: 70px;border-bottom: 1px solid gray">
                <img src="/dist/img/wang_light.png" alt="未加载">
                <span>{{ teacherDate.name }}</span>
                </el-menu-item>
                <el-menu-item v-for="(item,i) in navList" :key="i" :index="item.name" style="width: 100%;border-bottom: 1px gray solid">
                    <i :class="item.icon"></i>
                    <span slot="title">{{ item.navItem }}</span>
                </el-menu-item>
            </el-menu>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                teacherDate: {},
                show: false,
//                icon:[
//                    {el-icon-picture},
//
//                ],
                navList:[
//                    {icon:'el-icon-picture',name:'/',navItem:'ft'},
                    {icon:'el-icon-bell',name:'/paper',navItem:'论文'},
                    {icon:'el-icon-tickets',name:'/project',navItem:'项目'},
                    {icon:'el-icon-edit',name:'/book',navItem:'著作'},
                    {icon:'el-icon-star-off',name:'/award',navItem:'获奖'},
                    {icon:'el-icon-setting',name:'/patent',navItem:'专利'},
                    {icon:'el-icon-view',name:'/appraisal',navItem:'成果鉴定'},
                    {icon:'el-icon-time',name:'/holdmeet',navItem:'举办会议'},
                    {icon:'el-icon-edit-outline',name:'/joinmeet',navItem:'参加会议'},
                    {icon:'el-icon-date',name:'/experteach',navItem:'专家讲学'},
                    {icon:'el-icon-news',name:'/bearstudyjob',navItem:'担任学术团体职务'},

                ]
            }
        },
        methods: {
            handleOpen() {

            },
            handleClose () {

            },
//            $(document).ready(function(){
//            var he=$(window).height();          //获取窗口需要的高度
//            var el=$(".content").height();      //获取当前右边内容的高度
//            console.log(he);
//            alert(he);
//            if(he>el)                           //如果右边的内容高度并没有超过窗口的高度，也就是说并没有产生滚动条的话
//            {
//                $(".aside").height(he);         //填充左边导航条的高度至整个屏幕的高度
//            }
//            else{
//                $(".aside").height(el);         //否则的话把右边的内容高度设置成左边导航条的高度，也就是设为同高
////            $("#all").height(el);         //这句话是我为了让整个页面缩小比列后不会造成变形，这是后面讨论的第二个问题
//            }
//        }),

            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    if(data.code == 0){
                        self.teacherDate = data.datas;
                    }else{
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            },
//            menu() {
//                var nav = document.getElementsByClassName("aside")[0].getElementsByTagName("li");
//                for(var i = 0;i <nav.length; i++){
//                    nav[i].onclick = function () {
//                        nav[i].style.backgroundColor = "red";
//                    }
//                }
//            }
        },
        mounted() {
            this.getTeacherData();
        }

    }

    $(document).ready(function(){
        var he=$(window).height();          //获取窗口需要的高度
        var el=$(".content").height();      //获取当前右边内容的高度
        console.log(el);
//        alert(he);
        if(he>el)                           //如果右边的内容高度并没有超过窗口的高度，也就是说并没有产生滚动条的话
        {
            $(".aside").height(he);         //填充左边导航条的高度至整个屏幕的高度
        }
        else{
            $(".aside").height(el);         //否则的话把右边的内容高度设置成左边导航条的高度，也就是设为同高
//            $("#all").height(el);         //这句话是我为了让整个页面缩小比列后不会造成变形，这是后面讨论的第二个问题
        }
    });

</script>

<style>
    *,ul,li,a{
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
    }
    body, html{
        width: 100%;
        height: 100%;
    }
    .nav{
        width: 100%;
        height:35px;
        /*background-color: plum;*/
    }

    .navLeft{
        width: 12%;
        height: 100%;
        float: left;
        text-align: center;
        background-color:rgb(0,125,113) ;
    }
    .navRight{
        width: 88%;
        height: 100%;
        float: right;
        color: white;
        text-align: center;
        line-height:31px;
        background-color: rgb(0,150,136);
    }
    .navLeft img{
        width: 11%;
        margin-top: 5px;
    }
    .loginName{
        width:17%;
        /*height: 100%;*/
        float: right;
    }
    .loginName img{
        width:8%;
        vertical-align:middle;
    }
    .aside{
        width: 12%;
        height: auto;
        /*padding-bottom:107%;*/
        color: white;
        float: left;
        background-color:rgb(34,45,50);
    }
    .signIn img{
        width:22%;
        vertical-align:middle;
        /*margin-top: 10px;*/
    }
    .signIn a{
        color: white;
    }
    .aside li{
        /*height:55px;*/
        text-align :center;
        /*line-height: 60px;*/
        /*background-color:rgb(34,45,50);*/
        /*background-color: plum;*/
        border-bottom: 0.5px solid gray;
    }
    .aside li a{
        list-style: none;
        color: white;
        text-decoration: none;
    }
    /*组件*/
    .el-col-12 {
        width: 100%;
    }
    .aside .is-active {
        background-color:#000 !important;
    }
    /*.router-link-active {*/
        /*!*text-color:#ffd04b;*!*/
        /*color:#ffd04b !important;*/
    /*}*/
</style>