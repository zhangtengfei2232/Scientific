<template>
    <div>
        <div class="main">
            <div class="content">
                <div class="perInfo"><span style="margin-left: 15px;">个人信息</span></div>
                <div class="detial">
                    <div class="detiaLeft">
                        <p>头像</p>
                        <p>姓名</p>
                        <p>性别</p>
                        <p>分组</p>
                        <p>工号</p>
                        <p>办公电话</p>
                        <p>住宅电话</p>
                        <p>手机</p>
                        <p>籍贯</p>
                        <p>编号</p>
                        <p>民族</p>
                        <p>出生年月</p>
                        <p>政治面貌</p>
                        <p>行政职务</p>
                        <p>任职时间</p>
                        <p>职务级别</p>
                        <p>任职时间</p>
                        <p>专业技术职务</p>
                        <p>评审通过时间</p>
                        <p>聘任时间</p>
                        <p>系列</p>
                        <p>岗位类别</p>
                        <p>所在单位</p>
                        <p>所属教研室和实验室</p>
                        <p>来校工作时间</p>
                        <p>原工作单位</p>
                        <p>教师资格证书编号</p>
                        <p>身份证号</p><br/>
                        <p>第一学历：</p>
                        <p>学历/学位</p>
                        <p>毕业学校</p>
                        <p>所学专业</p>
                        <p>毕业时间</p><br/>
                        <p>最高学历：</p>
                        <p>学历/学位</p>
                        <p>毕业学校</p>
                        <p>所学专业</p>
                        <p>毕业时间</p><br/>
                        <p>现从事专业</p>
                        <p>所属学科</p>
                        <p>任教课程</p><br/>
                        <p>硕(博)导：</p>
                        <p>授予单位</p>
                        <p>获得时间</p><br/>
                        <p>毕业证书图片</p>
                    </div>
                    <div class="detialRight">
                        <p><img src="/dist/img/pic_fill.png" alt="未加载"></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.sex"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.teacher_id"></el-input></p>
                        <p><el-input :value=" teacherDate.office_phone"></el-input></p>
                        <p><el-input :value=" teacherDate.home_phone"></el-input></p>
                        <p><el-input :value=" teacherDate.phone"></el-input></p>
                        <p><el-input :value=" teacherDate.native_place"></el-input></p>
                        <p><el-input :value=" teacherDate.number"></el-input></p>
                        <p><el-input :value=" teacherDate.nation"></el-input></p>
                        <p><el-input :value=" teacherDate.borth"></el-input></p>
                        <p><el-input :value=" teacherDate.polit_outlook"></el-input></p>
                        <p><el-input :value=" teacherDate.admin_duties"></el-input></p>
                        <p><el-input :value=" teacherDate.tenure_time"></el-input></p>
                        <p><el-input :value=" teacherDate.job_level"></el-input></p>
                        <p><el-input :value=" teacherDate.tenure_time"></el-input></p>
                        <p>
                            <!--专业技术职务-->
                            <el-input :value=" teacherDate.edu_school"></el-input>
                        </p>
                        <p><el-input :value="teacherDate.name"></el-input></p>
                        <p><el-input :value="teacherDate.name"></el-input></p>
                        <p>
                            <!--系列-->
                            <el-input :value=" teacherDate.series"></el-input>
                        </p>
                        <p><el-input :value="teacherDate.post_category"></el-input></p>
                        <p><el-input :value=" teacherDate.company"></el-input></p>
                        <!--请输入所属教研室和实验室-->
                        <p><el-input :value=" teacherDate.te_re_department"></el-input></p>
                        <p><el-input :value=" teacherDate.working_hours"></el-input></p>
                        <p><el-input :value=" teacherDate.origin_work_unit"></el-input></p>
                        <p><el-input :value=" teacherDate.certificate_num"></el-input></p>
                        <p><el-input :value=" teacherDate.identity_card"></el-input></p>
                        <p></p><br>
                        <!--第一学历-->
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.edu_school"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p></p><br>
                        <!--最高学历-->
                        <p><el-input :value=" teacherDate.academic_id"></el-input></p>
                        <p><el-input :value=" teacherDate.edu_school"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <br>
                        <p><el-input :value=" teacherDate.work_major"></el-input></p>
                        <p><el-input :value=" teacherDate.belong_subject"></el-input></p>
                        <p><el-input :value=" teacherDate.teach_course"></el-input></p><br>
                        <br><br>
                        <!--硕博导-->
                        <p><el-input :value=" teacherDate.name"></el-input></p>
                        <p><el-input :value=" teacherDate.name"></el-input>
                        </p><br>
                        <p class="graduationPic">
                            <el-upload
                                    class="upload-demo"
                                    action="https://jsonplaceholder.typicode.com/posts/"
                                    :on-preview="handlePreview"
                                    :on-remove="handleRemove"
                                    :file-list="fileList2"
                                    list-type="picture">
                                <el-button size="small" type="primary">点击上传</el-button>
                                <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                            </el-upload>
                        </p>
                        <el-button type="primary" plain disabled class="commit">保存修改</el-button>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fileList2: [{name: 'food.jpeg', url: '/dist/img/wang_light.png'}],
//                fileList2: [{name: 'food.jpeg', url: teacherDate.gra_cert_road}],
                teacherDate: {},
                show: false,
//                inputJob:'' ,
//                input: '',

                pickerOptions1: {
                    disabledDate(time) {
                        return time.getTime() > Date.now();
                    },
                },
                value1: '',
            }
        },
        methods: {
            handleRemove(file, fileList) {
                //console.log(file, fileList);
            },
            handlePreview(file){
                //console.log(file);
            },
            getInputValue(){

            },
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    console.log(data.datas);
                    if(data.code == 0){
                        self.teacherDate = data.datas;
//                        if (self.teacherDate.teacher_id == 1) {
//                            show = true;
//                        }else if(self.teacherDate.teacher_id == 2) {
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
//            this.clickchange();
        },

    }
</script>

<style>
    .main{
        width: 100%;
        margin:0 auto
    }
    .content{
        width: 87%;
        float: right;
    }
    .perInfo{
        width: 100%;
        height: 50px;
        line-height: 52px;
        border-bottom: 1px solid gray;
    }
    .body{
        Font-size:25%
    }
    .detiaLeft{
        width: 12%;
        /*background-color: #2ab27b;*/
        font-size:0.95em;
        float: left;
        margin-left: 10%;
    }

    .detialRight{
        width: 78%;
        float: right;
    }
    .detial{
        margin-top: 3%;
    }
    .detial p{
        line-height: 43px;
        height:50px;
    }
    .detialRight img{
        width: 33px;
    }
    .el-date-editor.el-input{
        width: 217px;
    }

    .change{
        color: rgba(0, 179, 138, 1);
        margin-left:2%;
    }
    .commit{
        /*float: right;*/
        width: 320px;
        /*margin-right: 30%;*/
    }
    .graduationPic{
        margin-bottom: 170px;
    }
    /*//组件*/

    .upload-demo{
        width: 320px;
    }
    .el-input{
        width: 217px;
    }
</style>
