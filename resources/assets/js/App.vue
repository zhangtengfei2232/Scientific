<template>
    <div>
        <div class="nav">
            <div class="navLeft">
                <img src="/dist/img/hist.png" alt="未加载">
            </div>
            <div class="navRight">
                <span>生命科技学院科研管理系统</span>
                <div class="loginName">
                    <i class="el-icon-view"></i>
                    <span style="margin-right: 15px;">{{ teacherDate.name }}</span>
                    <span style="margin-left: 10px;">退出系统</span><i class="el-icon-caret-right"></i>
                </div>
            </div>
        </div>
        <div class="aside">
            <el-row class="tac">
                <el-col :span="12">
                    <el-menu
                            :default-active="this.$router.path"
                            background-color="rgb(34,45,50)"
                            text-color="#fff"
                            active-text-color="#ffd04b"
                            default-active="1"
                            class="el-menu-vertical-demo"
                            @open="handleOpen"
                            @close="handleClose"
                            router>
                        <el-menu-item index="/" class="signIn" style="height:70px;border-bottom:1px solid gray;font-size:17px;text-align: center">
                        <img src="/dist/img/wang_light.png" alt="未加载">
                        <span>{{teacherDate.name}}</span>
                        </el-menu-item>

                        <el-menu-item v-for="(item,i) in navList" :key="i" :index="item.name">
                            <i :class="item.icon"></i>
                            <span slot="title">{{ item.navItem }}</span>
                        </el-menu-item>

                        <el-menu-item index="/duties" style="border-bottom:1px solid gray;">
                            <i class="el-icon-message"></i>
                            <span slot="title">担任学术团体职务</span>
                        </el-menu-item>

                        <el-submenu index="1">
                            <template slot="title">
                                <i class="el-icon-menu"></i>
                                <span>特殊功能</span>
                            </template>
                            <el-menu-item-group>
                                <el-menu-item index="/schoolfile" style="padding-left: 30px;">校发文件</el-menu-item>
                                <el-menu-item index="/addteacher" style="padding-left: 30px;">添加老师</el-menu-item>
                                <el-menu-item index="/agreement" style="padding-left: 30px;">教学科研等合作协议</el-menu-item>
                            </el-menu-item-group>
                        </el-submenu>


                        <el-submenu index="2">
                            <template slot="title">
                                <i class="el-icon-setting"></i>
                                <span>成果汇总</span>
                            </template>
                            <el-menu-item-group style="background-color: plum !important;">
                                <el-menu-item index="/allArticle">所有论文</el-menu-item>
                                <el-menu-item index="2-2">所有项目</el-menu-item>
                                <el-menu-item index="2-3">所有著作</el-menu-item>
                                <el-menu-item index="2-4">所有成果</el-menu-item>
                                <el-menu-item index="2-5">所有专利</el-menu-item>
                            </el-menu-item-group>
                        </el-submenu>

                    </el-menu>
                </el-col>
            </el-row>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                teacherDate:[] ,
                show: false,
                navList:[
//                    {icon:'el-icon-picture',name:'/',navItem:'ft'},
                    {icon:'el-icon-bell',name:'/paper',navItem:'学术论文'},
                    {icon:'el-icon-tickets',name:'/project',navItem:'科研项目'},
                    {icon:'el-icon-edit',name:'/book',navItem:'学术著作'},
                    {icon:'el-icon-star-off',name:'/award',navItem:'获奖成果'},
                    {icon:'el-icon-edit-outline',name:'/patent',navItem:'学术专利'},
                    {icon:'el-icon-view',name:'/appraisal',navItem:'成果鉴定'},
                    {icon:'el-icon-time',name:'/holdmeet',navItem:'举办会议'},
                    {icon:'el-icon-edit-outline',name:'/joinmeet',navItem:'参加会议'},
                    {icon:'el-icon-date',name:'/lecture',navItem:'专家讲学'},

                ]
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
                        self.teacherDate = data.datas.information;
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
        },
        mounted() {
            this.getTeacherData();
        }

    }

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
    }

    .navLeft{
        width: 11%;
        height: 100%;
        float: left;
        text-align: center;
        background-color:rgb(0,125,113) ;
    }
    @media screen and (max-width: 1400px){
        body{
            font-size: 12px;
        }
        .navLeft{
            width: 12%;
        }
        .navRight{
            width: 88% !important;
        }
        .aside{
            width: 12% !important;
        }
        .el-menu-item{
            font-size: 12px !important;
        }
        .el-submenu .el-menu-item{
            min-width: 160px !important;
        }
    }
        .navRight{
        width: 89%;
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
        float: right;
    }
    .loginName img{
        width:8%;
        vertical-align:middle;
    }
    .aside{
        width: 11%;
        color: white;
        float: left;
        background-color:rgb(34,45,50);
    }
    .aside li{
        width: 100%;
    }
    .signIn img{
        width:22%;
        vertical-align:middle;
    }
    .signIn a{
        color: white;
    }
    .aside li{
        text-align :left;
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
   .aside .is-active{
      background-color: black !important;
   }
    .el-menu-item-group__title{
        display: none;
    }
    .el-submenu__icon-arrow {
        font-size: 16px;
    }
    .el-icon-arrow-down:before{
        font-weight: 800;
    }
    .el-menu-item-group>ul{
        overflow: hidden;
    }
    .el-submenu .el-menu-item{
        min-width: 160px;
    }
</style>