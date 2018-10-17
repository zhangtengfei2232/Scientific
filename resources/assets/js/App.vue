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
                    <img src="/dist/img/my.png" alt="未加载">
                    <span style="margin-right: 15px;">{{ teacherDate.name }}</span>
                    <!--<span class="house">-->
                    <span style="margin-left: 10px;">退出系统</span>
                    <!--<img src="/dist/img/home.png" alt="未加载">-->
                    <!--</span>-->
                </div>
            </div>
        </div>
        <div class="aside">
            <!--<p class="signIn is-active"><router-link to="/"><img src="/dist/img/wang_light.png" alt=""><span>{{ teacherDate.name }}</span></router-link></p>-->
            <el-col :span="12">
                <el-menu
                        default-active="1"
                        class="el-menu-vertical-demo"
                        @open="handleOpen"
                        @close="handleClose"
                        background-color="rgb(34,45,50)"
                        text-color="#fff"
                        active-text-color="#ffd04b">
                    <el-menu-item index="1" class="signIn" style="height: 70px;">
                        <router-link to="/" exact><img src="/dist/img/wang_light.png" alt="未加载">
                        <span>{{ teacherDate.name }}</span></router-link>
                    </el-menu-item>
                    <el-menu-item index="2">
                       <i class="el-icon-menu"></i>
                        <span slot="title"><router-link to="/paper">论文</router-link></span>
                    </el-menu-item>
                    <el-menu-item index="3">
                        <i class="el-icon-menu"></i>
                       <span slot="title">项目</span>
                    </el-menu-item>
                    <el-menu-item index="4">
                        <i class="el-icon-document"></i>
                        <span slot="title">著作</span>
                    </el-menu-item>
                    <el-menu-item index="5">
                        <i class="el-icon-setting"></i>
                        <span slot="title">获奖</span>
                    </el-menu-item>
                    <el-menu-item index="6">
                        <i class="el-icon-menu"></i>
                        <span slot="title">专利</span>
                    </el-menu-item>
                    <el-menu-item index="7">
                        <i class="el-icon-menu"></i>
                        <span slot="title">成果鉴定</span>
                    </el-menu-item>
                    <el-menu-item index="8">
                        <i class="el-icon-document"></i>
                        <span slot="title">举办会议</span>
                    </el-menu-item>
                    <el-menu-item index="9">
                        <i class="el-icon-setting"></i>
                        <span slot="title">参加会议</span>
                    </el-menu-item>
                    <el-menu-item index="10">
                        <i class="el-icon-menu"></i>
                        <span slot="title">专家讲学</span>
                    </el-menu-item>
                    <el-menu-item index="11">
                        <i class="el-icon-menu"></i>
                        <span slot="title">担任学术团体职务</span>
                    </el-menu-item>
                </el-menu>
            </el-col>
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
            }
        },
        methods: {
            handleOpen() {

            },
            handleClose () {

            },
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
            menu() {
                var nav = document.getElementsByClassName("aside")[0].getElementsByTagName("li");
                for(var i = 0;i <nav.length; i++){
                    nav[i].onclick = function () {
                        nav[i].style.backgroundColor = "red";
                    }
                }
            }
        },
        mounted() {
            this.getTeacherData();
        }

    }


//    var urlstr = location.href;
//    //alert(urlstr);
//    var urlstatus=false;
//    $("#menu a").each(function () {
//        if ((urlstr + '/').indexOf($(this).attr('href')) > -1&&$(this).attr('href')!='') {
//            $(this).addClass('cur'); urlstatus = true;
//        } else {
//            $(this).removeClass('cur');
//        }
//    });
//    if (!urlstatus) {$("#menu a").eq(0).addClass('cur'); }



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
        background-color: plum;
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
        height: 100%;
        float: right;
    }
    .loginName img{
        width:8%;
        vertical-align:middle;
    }
    .aside{
        width: 12%;
        /*height:100%;*/
        padding-bottom:107%;
        color: white;
        float: left;
        background-color:rgb(34,45,50);
        /*display: inline-block;*/
    }
    /*.aside li:first-child{*/
        /*!*position: absolute;*!*/
        /*height: 70px;*/
        /*background-color: black;*/
        /*!*vertical-align:middle;*!*/
    /*}*/
    /*.signIn{*/
        /*!*margin-left: 20px;*!*/
        /*background-color: black;*/
        /*height: 80px;*/
        /*text-align: center;*/
        /*line-height: 70px;*/
        /*!*margin-top: 5px;*!*/
    /*}*/
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
    .el-menu-item.is-active {
        background-color:#000 !important;
    }
    .router-link-active {
        /*text-color:#ffd04b;*/
        color:#ffd04b !important;
    }
</style>