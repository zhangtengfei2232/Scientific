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
        </div>
        <div class="aside">
            <ul>
                <li class="signIn"><img src="/dist/img/wang_light.png" alt=""><span>{{ teacherDate['name'] }}</span></li>
                <li><i class="el-icon-tickets"></i><router-link to="/paper">论文</router-link></li>
                <li><i class="el-icon-edit-outline"></i> &nbsp;项目</li>
                <li><i class="el-icon-edit"></i> &nbsp;著作</li>
                <li><i class="el-icon-setting"></i> &nbsp;获奖</li>
                <li><i class="el-icon-star-on"></i> &nbsp;专利</li>
                <li><i class="el-icon-setting"></i> &nbsp;成果鉴定</li>
                <li><i class="el-icon-setting"></i> &nbsp;举办会议</li>
                <li><i class="el-icon-setting"></i> &nbsp;参加会议</li>
                <li><i class="el-icon-setting" v-show="show"></i> &nbsp;专家讲学</li>
                <li><i class="el-icon-setting" v-show="show"></i> &nbsp;专担任学术团体职务</li>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                teacherDate: [],
                show: false,
            };
        },
        methods: {
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    console.log(data);
                    if(data.code == 0){
                        self.teacherDate = data.msg;
                        console.log(teacherDate);
//                        if (teacherDate['teacher_id'] == 1) {
//                            show = true;
//                        }else if(teacherDate['teacher_id'] == 2) {
//                            show = true;
//                        }
                    }else{
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },

        },
        mounted() {
            this.getTeacherData();
        }
    }
//    export default {
//        methods: {
//            handleOpen(key, keyPath) {
//                console.log(key, keyPath);
//            },
//            handleClose(key, keyPath) {
//                console.log(key, keyPath);
//            }
//        }
//    }
function fun(){
    var val = document.getElementById("val").value;
    var txt = document.getElementById("txt").value;
    var sel = document.getElementById("test");
    var option = new Option(txt, val);
    sel.options.add(option);
}
//    var oLis=document.getElementsByTagName("li");
//    var i,j;
//    var length=oLis.length;
//    for(i=0;i<length;i++){
//        oLis[i].onclick=function(){
//            for(j=0;j<length;j++){
//                oLis[j].className="";
//            }
//            this.className+="clickstyle";
//        }
//    }

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
    .aside{
        width: 12%;
        height:935px;
        color: white;
        float: left;
        background-color:rgb(34,45,50);
        /*display: inline-block;*/
    }
    .aside li:first-child{
        /*position: absolute;*/
        height: 70px;
        background-color: black;
        /*vertical-align:middle;*/
    }
    .aside li:first-child span{
        margin-left: 20px;
        /*margin-top: 5px;*/
    }
    .signIn img{
        width:22%;
        vertical-align:middle;
        /*margin-top: 10px;*/
    }
    .aside li{
        height:55px;
        text-align :center;
        line-height: 55px;
        background-color:rgb(34,45,50);
        /*background-color: plum;*/
        border-bottom: 0.5px solid gray;
    }
    .aside li a{
        list-style: none;
        color: white;
        text-decoration: none;
    }
</style>