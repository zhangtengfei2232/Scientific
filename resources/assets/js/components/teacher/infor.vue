<template>
    <div>
        <div class="main">
            <!--{{ $route.params.art_id }}-->
            <div class="content">
                <div class="perInfo"><span style="margin-left: 15px;">个人信息</span></div>
                <!--<el-form ref="form" :model="form" label-width="200px">-->
                <div class="detial">
                    <!--<div class="detiaLeft">-->
                        <!--<p>头像</p>-->
                        <!--<p>姓名</p>-->
                        <!--<p>性别</p>-->
                        <!--<p>分组</p>-->
                        <!--<p>工号</p>-->
                        <!--<p>办公电话</p>-->
                        <!--<p>住宅电话</p>-->
                        <!--<p>手机号</p>-->
                        <!--<p>籍贯</p>-->
                        <!--<p>编号</p>-->
                        <!--<p>民族</p>-->
                        <!--<p>出生年月</p>-->
                        <!--<p>政治面貌</p>-->
                        <!--<p>行政职务</p>-->
                        <!--<p>任职时间</p>-->
                        <!--<p>职务级别</p>-->
                        <!--<p>任职时间</p>-->
                        <!--<p>专业技术职务</p>-->
                        <!--<p>评审通过时间</p>-->
                        <!--<p>聘任时间</p>-->
                        <!--<p>系列</p>-->
                        <!--<p>岗位类别</p>-->
                        <!--<p>所在单位</p>-->
                        <!--<p>所属教研室和实验室</p>-->
                        <!--<p>来校工作时间</p>-->
                        <!--<p>原工作单位</p>-->
                        <!--<p>教师资格证书编号</p>-->
                        <!--<p>身份证号</p><br/>-->
                        <!--<p>第一学历：</p>-->
                        <!--<p>学历/学位</p>-->
                        <!--<p>毕业学校</p>-->
                        <!--<p>所学专业</p>-->
                        <!--<p>毕业时间</p><br/>-->
                        <!--<p>最高学历：</p>-->
                        <!--<p>学历/学位</p>-->
                        <!--<p>毕业学校</p>-->
                        <!--<p>所学专业</p>-->
                        <!--<p>毕业时间</p><br/>-->
                        <!--<p>现从事专业</p>-->
                        <!--<p>所属学科</p>-->
                        <!--<p>任教课程</p><br/>-->
                        <!--<p>硕(博)导：</p>-->
                        <!--<p>授予单位</p>-->
                        <!--<p>获得时间</p><br/>-->
                        <!--<p>毕业证书图片</p>-->
                    <!--</div>-->
                    <div class="detialRight">
                        <el-form ref="form" :model="form" label-width="200px">
                            <!--<p>头像<img src="/dist/img/pic_fill.png" alt="未加载"></p>-->
                            <el-form-item label="头像">
                                <img src="/dist/img/pic_fill.png" alt="未加载">
                            </el-form-item>
                            <el-form-item label="姓名" prop="name">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="性别" prop="sex">
                                <el-input v-model="form.sex"></el-input>
                            </el-form-item>
                            <el-form-item label="分组" prop="teacher_department">
                                <el-input v-model="form.teacher_department"></el-input>
                            </el-form-item>
                            <el-form-item label="工号" prop="teacher_id">
                                <el-input v-model="form.teacher_id"></el-input>
                            </el-form-item>
                            <el-form-item label="办公电话" prop="office_phone">
                                <el-input v-model="form.office_phone"></el-input>
                            </el-form-item>
                            <el-form-item label="住宅电话" prop="home_phone">
                                <el-input v-model="form.home_phone"></el-input>
                            </el-form-item>
                            <el-form-item label="手机号" prop="phone">
                                <el-input v-model="form.phone"></el-input>
                            </el-form-item>
                            <el-form-item label="籍贯" prop="native_place">
                                <el-input v-model="form.native_place"></el-input>
                            </el-form-item>
                            <el-form-item label="编号" prop="number">
                                <el-input v-model.number="form.number"></el-input>
                            </el-form-item>

                            <el-form-item label="出生年月" prop="borth">
                                <el-input v-model="form.borth"></el-input>
                            </el-form-item>
                            <el-form-item label="政治面貌" prop="polit_outlook">
                                <el-input v-model="form.polit_outlook"></el-input>
                            </el-form-item>
                            <el-form-item label="行政职务" prop="admin_duties">
                                <el-input v-model="form.admin_duties"></el-input>
                            </el-form-item>
                            <el-form-item label="任职时间" prop="admin_tenure_time">
                                <el-input v-model="form.admin_tenure_time"></el-input>
                            </el-form-item>
                            <el-form-item label="职务级别" prop="job_level">
                                <el-input v-model="form.job_level"></el-input>
                            </el-form-item>
                            <el-form-item label="任职时间" prop="admin_tenure_time">
                                <el-input v-model="form.admin_tenure_time"></el-input>
                            </el-form-item>

                            <el-form-item label="专业技术职务" prop="technical_position">
                                <el-input v-model="form.technical_position"></el-input>
                            </el-form-item>
                            <el-form-item label="评审通过时间" prop="review_time">
                                <el-input v-model="form.review_time"></el-input>
                            </el-form-item>
                            <el-form-item label="聘任时间" prop="appointment_time">
                                <el-input v-model="form.appointment_time"></el-input>
                            </el-form-item>
                            <el-form-item label="系列" prop="series">
                                <el-input v-model="form.series"></el-input>
                            </el-form-item>
                            <el-form-item label="岗位类别" prop="post_category">
                                <el-input v-model="form.post_category"></el-input>
                            </el-form-item>

                            <el-form-item label="所在单位" prop="company">
                                <el-input v-model="form.company"></el-input>
                            </el-form-item>
                            <el-form-item label="所属教研室和实验室" prop="te_re_department">
                                <el-input v-model="form.te_re_department"></el-input>
                            </el-form-item>
                            <el-form-item label="来校工作时间" prop="working_hours">
                                <el-input v-model="form.working_hours"></el-input>
                            </el-form-item>
                            <el-form-item label="原工作单位" prop="origin_work_unit">
                                <el-input v-model="form.origin_work_unit"></el-input>
                            </el-form-item>
                            <el-form-item label="教师资格证书编号" prop="certificate_num">
                                <el-input v-model="form.certificate_num"></el-input>
                            </el-form-item>
                            <el-form-item label="身份证号" prop="identity_card">
                                <el-input v-model="form.identity_card"></el-input>
                            </el-form-item>

                            <el-form-item label="第一学历：" ></el-form-item>

                            <el-form-item label="学历/学位" prop="most_academic">
                                <el-input v-model="form.most_academic"></el-input>
                            </el-form-item>
                            <el-form-item label="毕业学校" prop="edu_school">
                                <el-input v-model="form.edu_school"></el-input>
                            </el-form-item>
                            <el-form-item label="所学专业" prop="first_study_major">
                                <el-input v-model="form.first_study_major"></el-input>
                            </el-form-item>
                            <el-form-item label="毕业时间" prop="first_graduation_time">
                                <el-input v-model="form.first_graduation_time"></el-input>
                            </el-form-item>
                            <el-form-item label="现从事专业" prop="work_major">
                                <el-input v-model="form.work_major"></el-input>
                            </el-form-item>
                            <el-form-item label="所属学科" prop="belong_subject">
                                <el-input v-model="form.belong_subject"></el-input>
                            </el-form-item>
                            <el-form-item label="任教课程" prop="teach_course">
                                <el-input v-model="form.teach_course"></el-input>
                            </el-form-item>
                            <el-form-item label="硕(博)导：" ></el-form-item>

                            <el-form-item label="授予单位" prop="master_company">
                                <el-input v-model="form.master_company"></el-input>
                            </el-form-item>
                            <el-form-item label="获得时间" prop="master_time">
                                <el-input v-model="form.master_time"></el-input>
                            </el-form-item>
                            <!--<el-form-item label="毕业证书图片" prop="gra_cert_road">-->
                                <!--<el-input v-model="form.gra_cert_road"></el-input>-->
                            <!--</el-form-item>-->

                            <el-form-item label="毕业证书图片">
                                <el-upload
                                        class="upload-demo"
                                        drag
                                        action=""
                                        multiple
                                        ref="tea_pic"
                                        :before-upload="fileArtpdf"
                                        :auto-upload="false">
                                    <i class="el-icon-upload"></i>
                                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                                </el-upload>
                            </el-form-item>


                            <el-form-item>
                                <el-button type="primary" @click="onSubmit('form')">保存修改</el-button>
                                <!--<el-button><router-link to="/paper">取消</router-link></el-button>-->
                            </el-form-item>

                            <!--<p class="graduationPic">-->
                                <!--<el-upload-->
                                    <!--class="upload-demo"-->
                                    <!--drag-->
                                    <!--action=""-->
                                    <!--multiple-->
                                    <!--ref="tea_pic"-->
                                    <!--:before-upload="fileTeaPic"-->
                                    <!--:auto-upload="false">-->
                                    <!--<el-button size="small" type="primary">点击上传</el-button>-->
                                    <!--<div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>-->
                                <!--</el-upload>-->
                            <!--</p>-->
                            <!--<el-button type="primary" class="commit" @click="onSubmit(teacherDate)">保存修改</el-button>-->
                        </el-form>
                    </div>
                </div>
                <!--</el-form>-->
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form:{
                    name:'',
                    sex:'',
                    teacher_department:'',
                    teacher_id:'',
                    office_phone:'',
                    home_phone:'',
                    phone:'',
                    native_place:'',
                    number:'',
                    borth:'',

                    polit_outlook:'',
                    admin_duties:'',
                    admin_tenure_time:'',
                    technical_position:'',
                    review_time:'',
                    appointment_time:'',
                    series:'',
                    post_category:'',

                    company:'',
                    te_re_department:'',
                    working_hours:'',
                    belong_subject:'',
                    certificate_num:'',
                    identity_card:'',
                    most_academic:'',
                    edu_school:'',

                    first_study_major:'',
                    first_graduation_time:'',
                    work_major:'',
                    origin_work_unit:'',
                    teach_course:'',
                    master_company:'',
                    master_time:'',
                    gra_cert_road:'',


                },
                gra_cert_road:'',
                tea_pic: '',
                dataForm: new FormData(),
                teacherDate: [],
                show: false,
                pickerOptions1: {
                    disabledDate(time) {
                        return time.getTime() > Date.now();
                    },
                },
                value1: '',
            }
        },
        methods: {
            fileArtpdf(file){
                this.dataForm.append('tea_pic', file);
                return false;
            },
            handleRemove(file, fileList) {
                //console.log(file, fileList);
            },
            handlePreview(file){
                //console.log(file);
            },
            getInputValue(){

            },
            fileTeaPic(file){
                this.dataForm.append('art_pdf', file);
                return false;
            },
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    if(data.code == 0){
                        self.form = data.datas.information;
                        console.log(self.form);
                    }else{
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            onSubmit(form) {
//                console.log(teacherDate);
                let vue = this;
                if(form.name == '') {
                    this.$message.error('老师姓名不能为空');
                }else if(form.teacher_id == '') {
                    this.$message.error('老师性别不能为空');
                }
//                else if(teacherDate.teacher_department == '') {
//                    this.$message.error('老师分组不能为空');
//                }else if(teacher_id == '') {
//                    this.$message.error('老师工号不能为空');
//                }else if(office_phone == '') {
//                    this.$message.error('办公电话不能为空');
//                }else if(home_phone == '') {
//                    this.$message.error('住宅电话不能为空');
//                }else if(phone == '') {
//                    this.$message.error('手机号不能为空');
//                }else if(native_place == '') {
//                    this.$message.error('籍贯不能为空');
//                }else if(form.number == '') {
//                    this.$message.error('老师编号不能为空');
//                }else if(form.nation == '') {
//                    this.$message.error('民族不能为空');
//                }else if(form.borth == '') {
//                    this.$message.error('出生年月不能为空');
//                }else if(form.polit_outlook == '') {
//                    this.$message.error('政治面貌不能为空');
//                }else if(form.admin_duties == '') {
//                    this.$message.error('行政职务不能为空');
//                }else if(form.admin_tenure_time == '') {
//                    this.$message.error('任职时间不能为空');
//                }else if(form.job_level == '') {
//                    this.$message.error('职务级别不能为空');
//                }else if(form.admin_tenure_time == '') {
//                    this.$message.error('任职时间不能为空');
//                }else if(form.technical_position == '') {
//                    this.$message.error('专业技术职务不能为空');
//                }else if(form.review_time == '') {
//                    this.$message.error('评审通过时间不能为空');
//                }else if(form.appointment_time == '') {
//                    this.$message.error('聘任时间不能为空');
//                }else if(form.series == '') {
//                    this.$message.error('老师系列不能为空');
//                }else if(form.post_category == '') {
//                    this.$message.error('岗位类别不能为空');
//                }else if(form.company == '') {
//                    this.$message.error('所在单位不能为空');
//                }else if(form.te_re_department == '') {
//                    this.$message.error('所属教研室和实验室不能为空');
//                }else if(form.working_hours == '') {
//                    this.$message.error('来校工作时间不能为空');
//                }else if(form.origin_work_unit == '') {
//                    this.$message.error('原工作单位不能为空');
//                }else if(form.certificate_num == '') {
//                    this.$message.error('教师资格证书编号不能为空');
//                }else if(form.identity_card == '') {
//                    this.$message.error('身份证号不能为空');
//                }else if(form.most_academic == '') {
//                    this.$message.error('学历/学位不能为空');
//                }else if(form.most_graduate_school == '') {
//                    this.$message.error('毕业学校不能为空');
//                }else if(form.most_study_major == '') {
//                    this.$message.error('所学专业不能为空');
//                }else if(form.most_graduation_time == '') {
//                    this.$message.error('毕业时间不能为空');
//                }else if(form.work_major == '') {
//                    this.$message.error('现从事专业不能为空');
//                }else if(form.belong_subject == '') {
//                    this.$message.error('所属学科不能为空');
//                }else if(form.teach_course == '') {
//                    this.$message.error('任教课程不能为空');
//                }else if(form.master_company == '') {
//                    this.$message.error('授予单位不能为空');
//                }else if(form.master_time == '') {
//                    this.$message.error('获得时间不能为空');
//                }

                    vue.$refs['form'].validate((valid) => {
//                        console.log(vue.$refs['form']);
//                        console.log('--------------');
                    if (valid) {
//                        console.log(vue.form,"8888888888888");
                        jQuery.each(vue.form,function(i,val){
//                            console.log(i + val);
                            vue.dataForm.append(i,val);
                        });
//                        console.log(vue.dataForm);
                        vue.addTeacherData(vue.dataForm).then(res => {
                            var data = response.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '添加成功',
                                    type: 'success'
                                });
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.msg,
                                    duration: 2000,
                                });
                            }
                        })
//                        vue.$refs.tea_pic.submit()
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
            },
            addTeacherData(data) {
                console.log(data,'--------------');
                return axios({
                    method: 'post',
                    url: 'updateteacher',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
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
        /*float: right;*/
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
        margin-bottom: 20px;
        /*margin-right: 30%;*/
    }
    .graduationPic{
        margin-bottom: 193px;
    }
    /*//组件*/

    .upload-demo{
        width: 320px;
    }
    .el-input{
        width: 217px;
    }
</style>
