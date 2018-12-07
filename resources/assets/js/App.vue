<template>
    <div>
        <div class="nav">
            <div class="navLeft">
                <img src="/dist/img/hist.png" alt="未加载">
            </div>
            <div class="navRight">
                <span>生命科技学院信息管理系统</span>
                <div class="loginName">
                    <i class="el-icon-view"></i>
                    <span style="margin-right: 15px;">{{ teacherDate.name }}</span>
                    <el-dropdown>
                      <span class="el-dropdown-link" style="color:rgb(255,152,41)" v-show="changeTeapsw">
                        功能列表<i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item command="a" @click.native="dialogFormVisible  = true">重置密码</el-dropdown-item>
                            <el-dropdown-item command="b" @click.native="dialogdeleVisible  = true">删除老师</el-dropdown-item>
                            <el-dropdown-item command="c" @click.native="dialogWorkVisible  = true">行政职务</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>

                    <el-dialog title="重置密码"
                               :visible.sync="dialogFormVisible"
                               :close-on-click-modal="false"
                               @close="closeDialog"
                               id="resetNumcer"
                               width="500px"
                               center>
                        <el-form :model="changeform" style="padding: 11px 55px;" ref="changeform">
                            <el-form-item label="老师工号">
                                <el-input type="text" v-model="changeform.teacher_id"placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherNum"></el-input>
                            </el-form-item>
                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialogFormVisible = false">取 消</el-button>
                            <el-button type="primary" @click.native="changepsw(changeform)">修 改</el-button>
                        </div>
                    </el-dialog>

                    <el-dialog title="删除老师"
                               :visible.sync="dialogdeleVisible"
                               :close-on-click-modal="false"
                               @close="closeDeleDialog"
                               width="500px"
                               center>
                        <el-form :model="deleTeaform" style="padding: 11px 55px;" ref="deleTeaform">
                            <el-form-item label="老师工号">
                                <el-input type="text" v-model="deleTeaform.teacher_id"minlength="1" placeholder="请输入需重置密码老师工号" maxlength="10" id="deleteacherNum"></el-input>
                                <p id='errorMsg' style="margin-left: 70px;"></p>
                            </el-form-item>
                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialogdeleVisible = false">取 消</el-button>
                            <el-button type="primary" @click.native="deletea(deleTeaform)">删 除</el-button>
                        </div>
                    </el-dialog>

                    <el-dialog title="修改老师行政职务"
                               :visible.sync="dialogWorkVisible"
                               :close-on-click-modal="false"
                               @close="closeWorkDialog"
                               width="500px"
                               center>
                        <el-form :model="changework" style="padding: 11px 55px;" ref="changework">
                            <el-form-item label="老师工号">
                                <el-input type="text" v-model="changework.teacher_id" placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherId" style="width: 80%"></el-input>
                            </el-form-item>
                            <el-form-item label="行政职务" prop="admin_duties">
                                <el-select v-model="changework.admin_duties" placeholder="请选择老师行政职务" id="teaPost">
                                    <el-option label="普通老师" value="0"></el-option>
                                    <el-option label="院长" value="1"></el-option>
                                    <el-option label="副院长" value="2"></el-option>
                                    <el-option label="教学秘书" value="3"></el-option>
                                    <el-option label="科研秘书" value="4"></el-option>
                                    <el-option label="研究生秘书" value="5"></el-option>
                                    <el-option label="小麦中心主任" value="6"></el-option>
                                    <el-option label="系主任" value="7"></el-option>
                                    <el-option label="办公室主任" value="8"></el-option>
                                    <el-option label="教研室主任" value="9"></el-option>
                                    <el-option label="党委书记" value="10"></el-option>
                                    <el-option label="党委副书记" value="11"></el-option>
                                    <el-option label="研究室主任" value="12"></el-option>
                                    <el-option label="实验室主任" value="13"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialogWorkVisible = false">取 消</el-button>
                            <el-button type="primary" @click.native="changeWork(changework)">重 置</el-button>
                        </div>
                    </el-dialog>
                    <a style="margin-left: 10px;color: white"href="leavelogin">退出系统</a><i class="el-icon-caret-right"></i>
                </div>
            </div>
        </div>
        <div class="aside" style="max-height:1000px;z-index:1000;overflow-y:auto;overflow-x: hidden;">
            <el-row id="tac">
                <el-col :span="12">
                    <el-menu
                            :default-active="$route.path"
                            background-color="rgb(34,45,50)"
                            text-color="#fff"
                            activeTextColor="rgb(255, 208, 75)"
                            class="el-menu-vertical-demo"
                            @open="handleOpen"
                            @close="handleClose"
                            router>
                        <el-menu-item index="/" class="signIn" style="height:70px;border-bottom:1px solid gray;font-size:17px;text-align: center;color: white" id="for_id0">
                            <img src="/dist/img/wang_light.png" alt="未加载">
                            <span>{{teacherDate.name}}</span>
                        </el-menu-item>

                        <el-menu-item v-for="(item,i) in navList" :key="i" :index="item.name" :id="forId(i + 1)">
                            <i :class="item.icon"></i>
                            <span slot="title">{{ item.navItem }}</span>
                        </el-menu-item>

                        <el-menu-item index="/duties" style="border-bottom:1px solid gray;" id="for_id10">
                            <i class="el-icon-message"></i>
                            <span slot="title">学术团体</span>
                        </el-menu-item>
                        <div v-if="navGlobleview">
                            <el-menu-item index="/Glverview" style="border-bottom:1px solid gray;">
                                <i class="el-icon-view"></i>
                                <span slot="title">全局总览</span>
                            </el-menu-item>
                        </div>
                        <div v-if="navSpecial">
                            <el-submenu index="1" id="part-function">
                                <template slot="title">
                                    <i class="el-icon-menu"></i>
                                    <span>特殊功能</span>
                                </template>
                                <el-menu-item-group>
                                    <div v-if="navSchoolFile">
                                        <el-menu-item index="/schoolfile" style="padding-left: 30px;" id="for_id11">校发文件</el-menu-item>
                                    </div>
                                    <div v-if="navAddtea">
                                        <el-menu-item index="/addteacher" style="padding-left: 30px;">添加老师</el-menu-item>
                                    </div>
                                    <div v-if="navAgrement">
                                        <el-menu-item index="/agreement" style="padding-left: 30px;" id="for_id12">合作协议</el-menu-item>
                                    </div>
                                </el-menu-item-group>
                            </el-submenu>
                        </div>
                        <div v-if="allResult">
                            <el-submenu index="2">
                                <template slot="title">
                                    <i class="el-icon-setting"></i>
                                    <span>成果汇总</span>
                                </template>
                                <el-menu-item-group style="background-color: plum !important;">
                                    <div v-if="navTeacherInfo">
                                        <el-menu-item index="/loaderList/teacher">老师管理</el-menu-item>
                                    </div>
                                    <div v-if="resultCollect">
                                        <el-menu-item index="/loaderList/article">论文信息</el-menu-item>
                                        <el-menu-item index="/loaderList/project">项目信息</el-menu-item>
                                        <el-menu-item index="/loaderList/apus">著作信息</el-menu-item>
                                        <el-menu-item index="/loaderList/award">获奖信息</el-menu-item>
                                        <el-menu-item index="/loaderList/patent">专利信息</el-menu-item>
                                        <el-menu-item index="/loaderList/appraisal">成果鉴定</el-menu-item>
                                        <el-menu-item index="/loaderList/holdmeet">举办会议</el-menu-item>
                                        <el-menu-item index="/loaderList/joinmeet">参加会议</el-menu-item>
                                        <el-menu-item index="/loaderList/lecture">专家讲学</el-menu-item>
                                        <el-menu-item index="/loaderList/duties">担任学术团体</el-menu-item>
                                        <el-menu-item index="/loaderList/schoolfile">校发文件</el-menu-item>
                                        <el-menu-item index="/loaderList/agreement">科研合作协议</el-menu-item>
                                    </div>
                                </el-menu-item-group>
                            </el-submenu>
                        </div>

                    </el-menu>
                </el-col>
            </el-row>
        </div>
        <div id="main">
            <div id="con">
                <router-view></router-view>
            </div>
        </div>

    </div>
</template>
<script>
    /*使用jQuery来实现*/

//    /****方法一****/
    $('#tac').height($(window).height()-80);


    export default {
        data() {
            return {
                dialogFormVisible: false,
                dialogWorkVisible:false,
                dialogdeleVisible:false,
                changeform:{
                    teacher_id:'',
                },
                changework:{
                    teacher_id:'',
                    admin_duties:'',
                },
                deleTeaform:{
                    teacher_id:'',
                },
                visible: true,
                dataForm: new FormData(),

                teacherDate:[] ,
                show: false,
                navGlobleview:false,//全局总览
                navSchoolFile:false,
                navAddtea:false,
                navAgrement:false,
                navTeacherInfo:false,
                navSpecial:false,
                allResult:false,
                resultCollect:false,
                changeTeapsw:false,//修改老师密码
                status:'',
                navList:[
                    {icon:'el-icon-bell',name:'/paper',navItem:'论文'},
                    {icon:'el-icon-tickets',name:'/project',navItem:'项目'},
                    {icon:'el-icon-edit',name:'/book',navItem:'著作'},
                    {icon:'el-icon-star-off',name:'/award',navItem:'获奖'},
                    {icon:'el-icon-edit-outline',name:'/patent',navItem:'专利'},
                    {icon:'el-icon-document',name:'/appraisal',navItem:'成果鉴定'},
                    {icon:'el-icon-time',name:'/holdmeet',navItem:'举办会议'},
                    {icon:'el-icon-edit-outline',name:'/joinmeet',navItem:'参加会议'},
                    {icon:'el-icon-date',name:'/lecture',navItem:'专家讲学'},

                ]
            }
        },
        methods: {
            forId(i){
              return "for_id" + i;
            },
            closeDialog:function(){
                this.changeform.teacher_id = '';
                this.dialogFormVisible=false;
            },
            closeDeleDialog:function(){
                this.deleTeaform.teacher_id = '';
                this.dialogdeleVisible=false;
            },
            closeWorkDialog:function(){
                this.changework.admin_duties = '';
                this.changeform.teacher_id = '';
                this.dialogWorkVisible=false;
            },
            changepsw(changeform){  // 重置老师密码
                if(changeform.teacher_id == '') {
                    this.$message.error('老师工号不能为空');
                    return;
                }
                this.$refs['changeform'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.changeform,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.restetTeaPsw(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                })
                                this.closeDialog();
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        });
                    }
                    else {
                        console.log('error submit!!');
                        return false
                    }
                })
            },
            deletea(deleTeaform) {
                if(deleTeaform.teacher_id == '') {
                    this.$message.error('老师工号不能为空');
                    return;
                }
                this.$confirm('确定删除该老师吗, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteteacher",{
                        params:{
                            teacher_id:deleTeaform.teacher_id
                        }
                    }).then(function (response) {
                        var data = response.data;
                        if (data.code == 0) {
                            self.$message({
                                showClose: true,
                                message: data.message,
                                type: 'success'
                            });
                            self.closeDeleDialog();
                        } else {
                            self.$notify({
                                type: 'error',
                                message: data.message,
                                duration: 2000,
                            });
                        }
                    });
                }
                ).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            changeWork(changework){  // 修改老师行政职务
                if(changework.teacher_id == '') {
                    this.$message.error('老师工号不能为空');
                    return;
                }else if(changework.admin_duties == '') {
                    this.$message.error('行政职务不能为空');
                    return;
                }
                this.$refs['changework'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.changework,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.changeTeaWork(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
                                this.closeWorkDialog();
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        });
                    }
                    else {
                        console.log('error submit!!');
                        return false
                    }
                })
            },
            restetTeaPsw(data) { //重置密码
                return axios({
                    method: 'post',
                    url: 'initializeteacherpassword',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
            changeTeaWork(data) { //修改行政职务
                return axios({
                    method: 'post',
                    url: 'updateteacherpostcategory',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },

            handleOpen() {

            },
            handleClose () {

            },
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    status = data.datas.role_status;
                    if(status == 1){    //院长
                        self.navGlobleview=true;//全局总览
                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navTeacherInfo=true;//老师管理
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//各项统计
                    }
                    else if(status == 2){   //副院长
                        self.navGlobleview=true;//全局总览
                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 3){  //教学秘书
                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                        self.changeTeapsw=true;//功能列表
                    }
                    else if(status == 4){  //科研秘书
                        self.navGlobleview=true;//全局总览
                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                        self.navSchoolFile=true;//校发文件
                    }
                    else if(status == 5){  //研究生秘书
                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 6){  //小麦中心主任
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 7){  //系主任
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 8){  //办公室主任
                        self.navSpecial=true;//特殊功能
                        self.navAddtea=true;//添加老师
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.changeTeapsw=true;//修改老师密码
                    }
                    else if(status == 9){  //教研室主任
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 12){  //研究室主任
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    if(data.code == 0){
                        self.teacherDate = data.datas.information;
                    }else{
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            signSideBar(index){
                for(var i = 0; i < 13;i++) {
                    if (i == index) {
                        $("#for_id"+ index).addClass("is-active");
                    }else {
                        $('#for_id' + i).removeClass("is-active");
                    }
                }
            },
        },
        mounted() {
            this.getTeacherData();
        },
        watch:{
            $route(to) {
                switch(to.name){
                    case 'infor':
                        this.signSideBar(0);
                        break;
                    case 'artical':
                    case 'selfInfor':
                        this.signSideBar(1);
                        break;
                    case 'project':
                    case 'selfProject':
                        this.signSideBar(2);
                        break;
                    case 'book':
                    case 'selfBook':
                        this.signSideBar(3);
                        break;
                    case 'award':
                    case 'selfAward':
                        this.signSideBar(4);
                        break;
                    case 'patent':
                    case 'selfPatent':
                        this.signSideBar(5);
                        break;
                    case 'appraisal':
                    case 'selfAppraisal':
                        this.signSideBar(6);
                        break;
                    case 'holdmeet':
                    case 'selfHoldmeet':
                        this.signSideBar(7);
                        break;
                    case 'joinmeet':
                    case 'selfJoinmeet':
                        this.signSideBar(8);
                        break;
                    case 'lecture':
                    case 'editLecture':
                        this.signSideBar(9);
                        break;
                    case 'duties':
                    case 'editDuties':
                        this.signSideBar(10);
                        break;
                    case 'schoolfile':
                    case 'selfSchoolFile':
                        $("#part-function").addClass("is-opened");
                        $("#part-function ul").css('display','block');
                        this.signSideBar(11);
                        break;
                    case 'agreement':
                    case 'editAgreement':
                        $("#part-function").addClass("is-opened");
                        $("#part-function ul").css('display','block');
                        this.signSideBar(12);
                        break;
                }
            }
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
        width:100%;
        height:35px;
        position:absolute;
        top:0;
        left:0;
        right:0;
        background-color:#123;
        color:#fff;
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
            width: 11% !important;
            color: white;
            background-color:rgb(34,45,50);
            position:absolute;
            top:35px;
            left:0;
            bottom:0;
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
        width:24%;
        float: right;
    }
    .loginName img{
        width:8%;
        vertical-align:middle;
    }
    .aside{
        width: 11%;
        color: white;
        background-color:rgb(34,45,50);

        position:absolute;
        top:35px;
        left:0;
        bottom:0;
    }

    #main{
        position: absolute;
        left: 185px;
        top: 40px;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }
    #con{
        height:100%;
        overflow:auto;
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
        color: rgb(255, 208, 75) !important;
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

