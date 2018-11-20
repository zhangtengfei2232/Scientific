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
                    <!--<el-dialog title="重置密码"-->
                    <!--:visible.sync="dialogFormVisible"-->
                    <!--:close-on-click-modal="false"-->
                    <!--@close="closeDialog"-->
                    <!--center>-->
                    <!--<el-form :model="changeform" style="padding: 11px 20px;" ref="changeform">-->
                    <!--<el-form-item label="老师工号">-->
                    <!--<el-input type="text" v-model="changeform.teacher_id" placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherNum"></el-input>-->
                    <!--</el-form-item>-->
                    <!--</el-form>-->
                    <!--<div slot="footer" class="dialog-footer">-->
                    <!--<el-button @click="dialogFormVisible = false">取 消</el-button>-->
                    <!--<el-button type="primary" @click.native="changepsw()">重 置</el-button>-->
                    <!--</div>-->
                    <!--</el-dialog>-->
                    <!--<div v-show="changeTeapsw" style="display: inline-block;">-->
                        <!--<el-button type="text" @click="dialogFormVisible  = true" style="color:rgb(255,152,41)">重置老师密码</el-button>-->
                    <!--</div>-->
                    <el-dropdown>
                      <span class="el-dropdown-link" style="color:rgb(255,152,41)" v-show="changeTeapsw">
                        修 改<i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item command="a" @click.native="dialogFormVisible  = true">重置密码</el-dropdown-item>
                            <el-dropdown-item command="b" @click.native="dialogWorkVisible  = true">岗位类别</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>

                    <el-dialog title="重置密码"
                        :visible.sync="dialogFormVisible"
                        :close-on-click-modal="false"
                        @close="closeDialog"
                        center>
                    <el-form :model="changeform" style="padding: 11px 20px;" ref="changeform">
                        <el-form-item label="老师工号">
                            <el-input type="text" v-model="changeform.teacher_id" placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherNum"></el-input>
                        </el-form-item>
                    </el-form>
                    <div slot="footer" class="dialog-footer">
                        <el-button @click="dialogFormVisible = false">取 消</el-button>
                        <el-button type="primary" @click.native="changepsw(changeform)">重 置</el-button>
                    </div>
                    </el-dialog>

                    <el-dialog title="修改老师岗位类别"
                               :visible.sync="dialogWorkVisible"
                               :close-on-click-modal="false"
                               @close="closeWorkDialog"
                               center>
                        <el-form :model="changework" style="padding: 11px 20px;" ref="changework">
                            <el-form-item label="老师工号">
                                <el-input type="text" v-model="changework.teacher_id" placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherId"></el-input>
                            </el-form-item>
                            <el-form-item label="岗位类别" prop="post_category">
                                <el-select v-model="changework.post_category" placeholder="请选择老师岗位类别" id="teaPost">
                                    <el-option label="普通老师" value="0"></el-option>
                                    <el-option label="院长" value="1"></el-option>
                                    <el-option label="副院长" value="2"></el-option>
                                    <el-option label="教学秘书" value="3"></el-option>
                                    <el-option label="科研秘书" value="4"></el-option>
                                    <el-option label="研究生秘书" value="5"></el-option>
                                    <el-option label="副主任" value="6"></el-option>
                                    <el-option label="系主任" value="7"></el-option>
                                    <el-option label="办公室主任" value="8"></el-option>
                                    <el-option label="教研室主任" value="9"></el-option>
                                    <el-option label="党委书记" value="10"></el-option>
                                    <el-option label="党委副书记" value="11"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialogWorkVisible = false">取 消</el-button>
                            <el-button type="primary" @click.native="changeWork(changework)">重 置</el-button>
                        </div>
                    </el-dialog>


                    <!--<div v-show="changeTeapsw" style="display: inline-block;">-->
                        <!--<el-button type="text" @click="dialogFormVisible  = true" style="color:rgb(255,152,41)">重置老师密码</el-button>-->
                    <!--</div>-->
                        <!--<el-dialog title="重置密码"-->
                                   <!--:visible.sync="dialogFormVisible"-->
                                   <!--:close-on-click-modal="false"-->
                                   <!--@close="closeDialog"-->
                                   <!--center>-->
                            <!--<el-form :model="changeform" style="padding: 11px 20px;" ref="changeform">-->
                                <!--<el-form-item label="老师工号">-->
                                    <!--<el-input type="text" v-model="changeform.teacher_id" placeholder="请输入需重置密码老师工号" maxlength="10" id="teacherNum"></el-input>-->
                                <!--</el-form-item>-->
                            <!--</el-form>-->
                            <!--<div slot="footer" class="dialog-footer">-->
                                <!--<el-button @click="dialogFormVisible = false">取 消</el-button>-->
                                <!--<el-button type="primary" @click.native="changepsw()">重 置</el-button>-->
                            <!--</div>-->
                        <!--</el-dialog>-->



                    <a style="margin-left: 10px;color: white"href="leavelogin">退出系统</a><i class="el-icon-caret-right"></i>
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
                        <!--<div v-show="navJudgment">-->
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
                        <!--</div>-->
                        <div v-show="navGlobleview">
                            <el-menu-item index="/Glverview" style="border-bottom:1px solid gray;">
                                <i class="el-icon-view"></i>
                                <span slot="title">全局总览</span>
                            </el-menu-item>
                        </div>
                        <div v-show="navSpecial">
                            <el-submenu index="1">
                                <template slot="title">
                                    <i class="el-icon-menu"></i>
                                    <span>特殊功能</span>
                                </template>
                                <el-menu-item-group>
                                    <div v-show="navSchoolFile">
                                        <el-menu-item index="/schoolfile" style="padding-left: 30px;">校发文件</el-menu-item>
                                    </div>
                                    <div v-show="navAddtea">
                                        <el-menu-item index="/addteacher" style="padding-left: 30px;">添加老师</el-menu-item>
                                    </div>
                                    <div v-show="navAgrement">
                                        <el-menu-item index="/agreement" style="padding-left: 30px;">教学科研等合作协议</el-menu-item>
                                    </div>
                                </el-menu-item-group>
                            </el-submenu>
                        </div>
                        <div v-show="allResult">
                            <el-submenu index="2">
                                <template slot="title">
                                    <i class="el-icon-setting"></i>
                                    <span>成果汇总</span>
                                </template>
                                <el-menu-item-group style="background-color: plum !important;">
                                    <div v-show="navTeacherInfo">
                                        <el-menu-item index="/loaderList/teacher">老师管理</el-menu-item>
                                    </div>
                                <div v-show="resultCollect">
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
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                dialogFormVisible: false,
                dialogWorkVisible:false,
                changeform:{
                    teacher_id:'',
                },
                changework:{
                    teacher_id:'',
                    post_category:'',
                },
                visible: true,
                dataForm: new FormData(),

                teacherDate:[] ,
                show: false,
//                navJudgment:false,
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
//                    {icon:'el-icon-picture',name:'/',navItem:'ft'},
                    {icon:'el-icon-bell',name:'/paper',navItem:'学术论文'},
                    {icon:'el-icon-tickets',name:'/project',navItem:'科研项目'},
                    {icon:'el-icon-edit',name:'/book',navItem:'学术著作'},
                    {icon:'el-icon-star-off',name:'/award',navItem:'获奖成果'},
                    {icon:'el-icon-edit-outline',name:'/patent',navItem:'学术专利'},
                    {icon:'el-icon-document',name:'/appraisal',navItem:'成果鉴定'},
                    {icon:'el-icon-time',name:'/holdmeet',navItem:'举办会议'},
                    {icon:'el-icon-edit-outline',name:'/joinmeet',navItem:'参加会议'},
                    {icon:'el-icon-date',name:'/lecture',navItem:'专家讲学'},

                ]
            }
        },
        methods: {
//            handleCommand(command) {
//
//            },
            closeDialog:function(){
                this.changeform.teacher_id = '';
            },
            closeWorkDialog:function(){
                this.changework.post_category = '';
                this.changeform.teacher_id = '';
            },
            changepsw(changeform){  // 重置老师密码
                if($(" #teacherNum ").val() == '') {
                    this.$message.error('老师工号不能为空');
                }
                this.$refs['changeform'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.changeform,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.restetTeaPsw(vue.dataForm).then(res => {
                            var data = res.data;
                            console.log(data,'\\\\密码\\\\');
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
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
            changeWork(changework){  // 修改老师岗位类别
                if($(" #teacherId ").val() == '') {
                    this.$message.error('老师工号不能为空');
                }else if($(" #teaPost ").val() == '') {
                    this.$message.error('岗位类别不能为空');
                }
                this.$refs['changework'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.changework,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.changeTeaWork(vue.dataForm).then(res => {
                            var data = res.data;
//                            console.log(data,'\\\\密码\\\\');
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
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
            changeTeaWork(data) { //修改岗位类别
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
//                        self.navAddtea=true;//添加老师
//                        self.navAgrement=true;//教学科研等合作协议
                        self.navTeacherInfo=true;//老师管理
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//各项统计
                    }
                    else if(status == 2){   //副院长

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

                        self.changeTeapsw=true;//修改老师密码
                    }
                    else if(status == 4){  //科研秘书

                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总


                    }
                    else if(status == 5){  //研究生秘书

                        self.navSpecial=true;//特殊功能
                        self.navSchoolFile=true;//校发文件
                        self.navAgrement=true;//教学科研等合作协议
                        self.allResult=true;//成果汇总
                        self.resultCollect=true;//成果汇总
                    }
                    else if(status == 6){  //副主任

                    }
                    else if(status == 7){  //系主任

                    }
                    else if(status == 8){  //办公室主任

                        self.navSpecial=true;//特殊功能
                        self.navAddtea=true;//添加老师
                        self.navSchoolFile=true;//校发文件
                        self.allResult=true;//成果汇总
                        self.navTeacherInfo=true;//老师管理
                        self.navAgrement=true;//教学科研等合作协议
                    }
                    else if(status == 9){  //教研室主任

                    }

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
//            handleOpen(key, keyPath) {
//                console.log(key, keyPath);
//            },
//            handleClose(key, keyPath) {
//                console.log(key, keyPath);
//            },
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
=======
    .el-dialog {
        width: 28%;
    }
    .el-dropdown-link {
        cursor: pointer;
        color: #409EFF;
    }
    .el-icon-arrow-down {
        font-size: 12px;
    }
</style>
