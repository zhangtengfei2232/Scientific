<template>
    <div>
        <div class="nav">
            <div class="navLeft">
                <img src="/dist/img/hist.png" alt="未加载">
            </div>
            <div class="navRight">
                <span><img src="/dist/img/sort.png" alt="未加载"></span>
                <span>生命科技学院科研管理系统</span>
                <div class="loginName">
                    <img src="/dist/img/my.png" alt="未加载">
                    <span>金凯杰</span>
                    <!--<span class="house">-->
                        <img src="/dist/img/home.png" alt="未加载">
                    <!--</span>-->
                </div>

            </div>
            <div style="clear: both"></div>
        </div>
        <div class="main">
            <div class="aside">
                <el-container>
                    <el-aside width="100%" style="background-color: rgb(238, 241, 246)">
                        <el-menu :default-openeds="['1', '3']">
                            <el-submenu index="1">
                                <template slot="title"><i class="el-icon-message"></i>导航一</template>
                                <el-menu-item-group>
                                    <template slot="title">分组一</template>
                                    <el-menu-item index="1-1">选项1</el-menu-item>
                                    <el-menu-item index="1-2">选项2</el-menu-item>
                                </el-menu-item-group>
                                <el-menu-item-group title="分组2">
                                    <el-menu-item index="1-3">选项3</el-menu-item>
                                </el-menu-item-group>
                                <el-submenu index="1-4">
                                    <template slot="title">选项4</template>
                                    <el-menu-item index="1-4-1">选项4-1</el-menu-item>
                                </el-submenu>
                            </el-submenu>
                            <el-submenu index="2">
                                <template slot="title"><i class="el-icon-menu"></i>导航二</template>
                                <el-menu-item-group>
                                    <template slot="title">分组一</template>
                                    <el-menu-item index="2-1">选项1</el-menu-item>
                                    <el-menu-item index="2-2">选项2</el-menu-item>
                                </el-menu-item-group>
                                <el-menu-item-group title="分组2">
                                    <el-menu-item index="2-3">选项3</el-menu-item>
                                </el-menu-item-group>
                                <el-submenu index="2-4">
                                    <template slot="title">选项4</template>
                                    <el-menu-item index="2-4-1">选项4-1</el-menu-item>
                                </el-submenu>
                            </el-submenu>
                            <el-submenu index="3">
                                <template slot="title"><i class="el-icon-setting"></i>导航三</template>
                                <el-menu-item-group>
                                    <template slot="title">分组一</template>
                                    <el-menu-item index="3-1">选项1</el-menu-item>
                                    <el-menu-item index="3-2">选项2</el-menu-item>
                                </el-menu-item-group>
                                <el-menu-item-group title="分组2">
                                    <el-menu-item index="3-3">选项3</el-menu-item>
                                </el-menu-item-group>
                                <el-submenu index="3-4">
                                    <template slot="title">选项4</template>
                                    <el-menu-item index="3-4-1">选项4-1</el-menu-item>
                                </el-submenu>
                            </el-submenu>
                        </el-menu>
                    </el-aside>
                </el-container>
            </div>
            <div class="content">

            </div>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
//    export default {
//        data(){
//            return {
//                msg: "Vue"
//            }
//        }
//
//    }
</script>

<style>
    *{
        margin: 0;
        padding: 0;
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
    .navRight span:first-child{
        width: 5%;
        height: 100%;
        float: left;
    }
    .navRight span:first-child img{
        width:42%;
    }
    .loginName{
        width:15%;
        height: 100%;
        float: right;
    }
    .loginName img{
        width:10%;
        vertical-align:middle;
    }
    /*.house{*/
        /*width:15%;*/
        /*float: right;*/
        /*background-color: plum;*/
    /*}*/
    .aside{
        width: 12%;
        height:935px;
        background-color:rgb(34,45,50);
        /*display: inline-block;*/
    }
    .main{
        width: 100%;
        height: 935px;
        background-color: #1b6d85;
        display: inline-block;
    }
    .content{
        width: 84%;
    }
    /*//组件*/
    .el-col{
        width: 100%;
    }
    .el-submenu__title{
        padding-left: 35px;
    }
    .el-menu{
        background-color: rgb(34,45,50);
    }
    .el-submenu__title:hover{
        background-color: black;
    }
</style>