<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px"style="display: flex;">
                <div class="contentLeft"style="width: 50%;">
                    <el-form-item label="老师所属部门" prop="teacher_department">
                        <el-select v-model="form.teacher_department" placeholder="请选择老师所属部门">
                            <el-option label="生工" value="0"></el-option>
                            <el-option label="生物技术系" value="1"></el-option>
                            <el-option label="农学系" value="2"></el-option>
                            <el-option label="领导行政政工" value="3"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="老师工号" prop="teacher_id">
                        <el-input v-model="form.teacher_id" id='name' @blur="checkName(form.teacher_id)"@focus="getFoce()" maxlength="7"></el-input>
                        <span id='usernameWarn' v-show="form.is_exist_teacher_id">已存在</span>
                    </el-form-item>

                    <el-form-item label="姓名" prop="name">
                        <el-input v-model="form.name" maxlength="15"></el-input>
                    </el-form-item>
                    <el-form-item label="办公电话" prop="office_phone">
                        <el-input v-model="form.office_phone" maxlength="11"></el-input>
                    </el-form-item>
                    <el-form-item label="住宅电话" prop="home_phone">
                        <el-input v-model="form.home_phone" maxlength="11"></el-input>
                    </el-form-item>
                    <el-form-item label="手机号" prop="phone">
                        <el-input v-model="form.phone" maxlength="11"></el-input>
                    </el-form-item>
                    <el-form-item label="编号" prop="number">
                        <el-input v-model="form.number" maxlength="10"></el-input>
                    </el-form-item>
                    <el-form-item label="性别">
                        <el-radio-group v-model="form.sex">
                            <el-radio :label="0">男</el-radio>
                            <el-radio :label="1">女</el-radio>
                        </el-radio-group>
                        <!--<el-input v-model="form.sex"></el-input>-->
                    </el-form-item>
                    <el-form-item label="民族" prop="nation">
                        <el-input v-model="form.nation" maxlength="20"></el-input>
                    </el-form-item>
                    <el-form-item label="出生年月" prop="borth">
                        <el-col :span="15">
                            <el-date-picker
                                    type="date"
                                    placeholder="选择日期"
                                    v-model="form.borth"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                        </el-col>
                        <!--<el-input v-model="form.borth"></el-input>-->
                    </el-form-item>
                    <el-form-item label="政治面貌" prop="polit_outlook">
                        <el-select v-model="form.polit_outlook" placeholder="请选择老师政治面貌">
                            <el-option label="积极分子" value="0"></el-option>
                            <el-option label="发展对象" value="1"></el-option>
                            <el-option label="预备党员" value="2"></el-option>
                            <el-option label="党员" value="3"></el-option>
                        </el-select>
                        <!--<el-input v-model="form.polit_outlook"></el-input>-->
                    </el-form-item>
                    <el-form-item label="籍贯" prop="native_place">
                        <el-input v-model="form.native_place"></el-input>
                    </el-form-item>
                    <el-form-item label="行政职务" prop="admin_duties">
                        <!--<el-input v-model="form.admin_duties" maxlength="30"></el-input>-->
                        <el-select v-model="form.admin_duties" placeholder="请选择老师行政职务">
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
                            <el-option label="研究生主任" value="12"></el-option>
                            <el-option label="实验室主任" value="13"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="任职时间">
                        <el-col :span="15">
                            <el-date-picker
                                    type="date"
                                    placeholder="选择日期"
                                    v-model="form.admin_tenure_time"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                        </el-col>
                        <!--<el-input v-model="form.admin_tenure_time"></el-input>-->
                    </el-form-item>
                    <el-form-item label="职务级别">
                        <el-select v-model="form.job_level" placeholder="请选择老师级别">
                            <el-option label="正处" value="0"></el-option>
                            <el-option label="副处" value="1"></el-option>
                            <el-option label="正科" value="2"></el-option>
                            <el-option label="副科" value="3"></el-option>
                            <el-option label="其他" value="4"></el-option>
                        </el-select>
                        <!--<el-input v-model="form.job_level"></el-input>-->
                    </el-form-item>
                    <el-form-item label="专业技术职务" prop="technical_position">
                        <el-select v-model="form.technical_position" placeholder="老师专业技术职务">
                            <el-option label="初级" value="0"></el-option>
                            <el-option label="中级" value="1"></el-option>
                            <el-option label="副高" value="2"></el-option>
                            <el-option label="正高" value="3"></el-option>
                        </el-select>
                        <!--<el-input v-model="form.technical_position"></el-input>-->
                    </el-form-item>
                    <el-form-item label="老师职称">
                        <el-select v-model="form.academic_title" placeholder="请选择老师职称">
                            <el-option label="教授" value="0"></el-option>
                            <el-option label="副教授" value="1"></el-option>
                            <el-option label="讲师" value="2"></el-option>
                            <el-option label="助教" value="3"></el-option>
                            <el-option label="高级实验师" value="4"></el-option>
                            <el-option label="实验师" value="5"></el-option>
                            <el-option label="助理实验师" value="6"></el-option>
                        </el-select>
                        <!--<el-input v-model="form.academic_title"></el-input>-->
                    </el-form-item>
                    <el-form-item label="评审通过时间" prop="review_time">
                        <el-col :span="15">
                            <el-date-picker
                                    type="date"
                                    placeholder="选择日期"
                                    v-model="form.review_time"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                        </el-col>
                        <!--<el-input v-model="form.review_time"></el-input>-->
                    </el-form-item>
                    <el-form-item label="聘任时间">
                        <el-col :span="15">
                            <el-date-picker
                                    type="date"
                                    placeholder="选择日期"
                                    v-model="form.appointment_time"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                        </el-col>
                        <!--<el-input v-model="form.appointment_time"></el-input>-->
                    </el-form-item>
                    <el-form-item label="系列" prop="series">
                        <el-input v-model="form.series" maxlength="20"></el-input>
                    </el-form-item>
                    <!--<el-form-item label="岗位类别" prop="post_category">-->
                        <!--<el-select v-model="form.post_category" placeholder="请选择老师岗位类别">-->
                            <!--<el-option label="普通老师" value="0"></el-option>-->
                            <!--<el-option label="院长" value="1"></el-option>-->
                            <!--<el-option label="副院长" value="2"></el-option>-->
                            <!--<el-option label="教学秘书" value="3"></el-option>-->
                            <!--<el-option label="科研秘书" value="4"></el-option>-->
                            <!--<el-option label="研究生秘书" value="5"></el-option>-->
                            <!--<el-option label="副主任" value="6"></el-option>-->
                            <!--<el-option label="系主任" value="7"></el-option>-->
                            <!--<el-option label="办公室主任" value="8"></el-option>-->
                            <!--<el-option label="教研室主任" value="9"></el-option>-->
                            <!--<el-option label="党委书记" value="10"></el-option>-->
                            <!--<el-option label="党委副书记" value="11"></el-option>-->
                        <!--</el-select>-->
                        <!--&lt;!&ndash;<el-input v-model="form.post_category"></el-input>&ndash;&gt;-->
                    <!--</el-form-item>-->
                    <el-form-item label="所在单位" prop="company">
                        <el-input v-model="form.company" maxlength="20"></el-input>
                    </el-form-item>
                    <el-form-item label="所属教研室和实验室" prop="te_re_department">
                        <el-input v-model="form.te_re_department" maxlength="30"></el-input>
                    </el-form-item>
                    <el-form-item label="来校工作时间" prop="working_hours">
                        <el-col :span="15">
                            <el-date-picker
                                    type="date"
                                    placeholder="选择日期"
                                    v-model="form.working_hours"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                        </el-col>
                        <!--<el-input v-model="form.working_hours"></el-input>-->
                    </el-form-item>
                    <el-form-item label="原工作单位" prop="origin_work_unit">
                        <el-input v-model="form.origin_work_unit" maxlength="20"></el-input>
                    </el-form-item>
                </div>
                <div class="contentRight"style="width: 50%;">

                    <el-form-item label="教师资格证书编号" prop="certificate_num">
                        <el-input v-model="form.certificate_num" maxlength="20"></el-input>
                    </el-form-item>
                    <el-form-item label="身份证号" prop="identity_card">
                        <el-input v-model="form.identity_card" maxlength="18"></el-input>
                    </el-form-item>
                    <el-form-item label="老师毕业院校" prop="edu_school">
                        <el-input v-model="form.edu_school" maxlength="30"></el-input>
                    </el-form-item>

                <el-form-item label="第一学历：" style="font-weight:800 !important; font-size: 17px;"></el-form-item>

                <el-form-item label="第一学历/学位" prop="first_academic">
                    <el-select v-model="form.first_academic" placeholder="请选择老师第一学历学位">
                        <el-option label="大专" value="0"></el-option>
                        <el-option label="本科" value="1"></el-option>
                        <el-option label="其他" value="2"></el-option>
                    </el-select>
                    <!--<el-input v-model="form.first_graduate_school"></el-input>-->
                </el-form-item>
                <el-form-item label="第一毕业学校" prop="first_graduate_school">
                    <el-input v-model="form.first_graduate_school" maxlength="30"></el-input>
                </el-form-item>
                <el-form-item label="第一所学专业" prop="first_study_major">
                    <el-input v-model="form.first_study_major" maxlength="20"></el-input>
                </el-form-item>
                <el-form-item label="第一毕业时间" prop="first_graduation_time">
                    <el-col :span="15">
                        <el-date-picker
                                type="date"
                                placeholder="选择日期"
                                v-model="form.first_graduation_time"
                                format="yyyy 年 MM 月 dd 日"
                                value-format="timestamp">
                        </el-date-picker>
                    </el-col>
                </el-form-item>

                <el-form-item label="最高学历："style="font-weight:800 !important; font-size: 17px;" ></el-form-item>

                <el-form-item label="最高学历/学位" prop="most_academic">
                    <el-select v-model="form.most_academic" placeholder="请选择老师最高学历/学位">
                        <el-option label="硕士" value="0"></el-option>
                        <el-option label="博士" value="1"></el-option>
                        <el-option label="其他" value="2"></el-option>
                    </el-select>
                    <!--<el-input v-model="form.most_academic"></el-input>-->
                </el-form-item>
                <el-form-item label="最高毕业学校" prop="most_graduate_school">
                    <el-input v-model="form.most_graduate_school" maxlength="30"></el-input>
                </el-form-item>
                <el-form-item label="最高所学专业" prop="most_study_major">
                    <el-input v-model="form.most_study_major" maxlength="20"></el-input>
                </el-form-item>
                <el-form-item label="最高毕业时间" prop="most_graduation_time">
                    <el-col :span="15">
                        <el-date-picker
                                type="date"
                                placeholder="选择日期"
                                v-model="form.most_graduation_time"
                                format="yyyy 年 MM 月 dd 日"
                                value-format="timestamp">
                        </el-date-picker>
                    </el-col>
                </el-form-item>

                <el-form-item label="现从事专业" prop="work_major">
                    <el-input v-model="form.work_major" maxlength="30"></el-input>
                </el-form-item>
                <el-form-item label="从事专业所属学科" prop="belong_subject">
                    <el-input v-model="form.belong_subject" maxlength="30"></el-input>
                </el-form-item>
                <el-form-item label="任教课程" prop="teach_course">
                    <el-input v-model="form.teach_course" maxlength="20"></el-input>
                </el-form-item>
                <el-form-item label="硕(博)导："style="font-weight:800 !important; font-size: 17px;" ></el-form-item>

                <el-form-item label="授予单位" prop="master_company">
                    <el-input v-model="form.master_company" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="获得时间" prop="master_time">
                    <el-col :span="15">
                        <el-date-picker
                                type="date"
                                placeholder="选择日期"
                                v-model="form.master_time"
                                format="yyyy 年 MM 月 dd 日"
                                value-format="timestamp">
                        </el-date-picker>
                    </el-col>
                    <!--<el-input v-model="form.master_time"></el-input>-->
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">添 加</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                    <el-form-item label="毕业证书图片">
                        <el-upload
                            ref="gra_cert_road"
                            action="#"
                            :before-upload="fileProfil"
                            :on-preview="handlePreview"
                            :on-remove="handleRemove"
                            :auto-upload="false"
                            :limit="1"
                            list-type="picture">
                            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="学历证书图片">
                        <el-upload
                                class="upload-demo"
                                ref="edu_cert_road"
                                action="#"
                                :before-upload="fileEdufil"
                                :on-preview="handlePreview"
                                :on-remove="handleRemove"
                                :auto-upload="false"
                                :limit="1"
                                list-type="picture">
                            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUploads">上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                        </el-upload>
                    </el-form-item>
            </div>
        </el-form>
        </div>
    </div>

</template>
<style>
    .contents{
        /*width: 87%;*/
        /*float: left;*/
    }
    #usernameWarn{
        color: red;
    }
    .add{
        /*width: 73%;*/
        margin: 35px 0 0 35px;
    }
    /*组件*/
    .el-input {
        width: 240px;
    }
    .el-date-editor.el-input, .el-date-editor.el-input__inner {
        width: 240px;
    }
    .el-form-item__content {
        width: 290px;
        color: red;
    }
</style>
<script>
    export default{
        data(){
            return{
                error_id_msg:'',
                gra_cert_road: '',
                edu_cert_road: '',
                dataForm: new FormData(),
                dataFile: new FormData(),
                dataFiles: new FormData(),
                Bcode:false,
                teaId:[],
                form:{
                    is_exist_teacher_id:false,
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

                    academic_title:'',
                    nation:'',
                    edu_school:'',
                    first_graduate_school:'',
                    most_graduation_time:'',
                    most_graduate_school:'',

                    polit_outlook:'',
                    admin_duties:'',
                    admin_tenure_time:'',
                    technical_position:'',
                    review_time:'',
                    appointment_time:'',
                    series:'',
//                    post_category:'',
                    most_study_major:'',

                    company:'',
                    te_re_department:'',
                    working_hours:'',
                    belong_subject:'',
                    certificate_num:'',
                    identity_card:'',
                    most_academic:'',

                    first_study_major:'',
                    first_graduation_time:'',
                    work_major:'',
                    origin_work_unit:'',
                    teach_course:'',
                    master_company:'',
                    master_time:'',
                },
                polit_outlook:[//政治面貌
                    '积极分子',
                    '发展对象',
                    '预备党员',
                    '党员',
                ],
            }
        },
        methods:{
            getTeacherId(){
                    let self = this;
                    axios.get("selectAllTeacherId",{
                        params:{
                            teacher_id:self.form.teacher_id
                        }
                    }).then(function (response) {
                        self.teaId = response.data.datas;
            })},
            checkName() {
                let self = this;
                var teacher_id_datas = self.teaId;
                for(var i = 0; i < teacher_id_datas.length; i++ ){
                         if(teacher_id_datas[i].teacher_id == self.form.teacher_id){
                             self.form.is_exist_teacher_id = true;
                         }
                }
            },
            getFoce(){
                this.form.is_exist_teacher_id = false;
            },
            submitUpload() {
                this.$refs.gra_cert_road.submit();
            },
            submitUploads() {
                this.$refs.edu_cert_road.submit();
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file){
                console.log(file);
            },

            fileProfil(file){
                if(this.Bcode == true){
                    this.dataFile.append('gra_cert_road', file);
                    let id = this.form.teacher_id;
                    this.dataFile.append('teacher_id', id);
                    this.dataFile.append('is_add_teacher',this.Bcode);
                    this.sendfile(this.dataFile);
                }else{
                    this.$message.error('请先添加毕业证书图片');
                    return false
                }
            },
            fileEdufil(files){
                if(this.Bcode == true){
                    this.dataFiles.append('edu_cert_road', files);
                    let id = this.form.teacher_id;
                    this.dataFiles.append('teacher_id', id);
                    this.dataFiles.append('is_add_teacher',this.Bcode);
                    this.sendfile(this.dataFiles);
                }else{
                    this.$message.error('请先添加学历证书图片');
                    return false
                }
            },
            sendfile(dataFile) {
                this.addTeacherFile(dataFile).then(res => {
                    var data = res.data;
                    if (data.code == 0) {
                        this.$message({
                            message: data.message,
                            type: 'success'
                        });
                    } else {
                        this.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                })
            },
            addTeacherFile(data){
                return axios({
                    method: 'post',
                    url: 'addcertificate',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
            onSubmit(form) {
                let vue = this;
                if(form.name == '') {
                    this.$message.error('老师姓名不能为空');
                    return
                }
//                else if(form.sex == '') {
//                    this.$message.error('老师性别不能为空');
//                }
                else if(form.teacher_department == '') {
                    this.$message.error('老师所属部门不能为空');
                    return
                }else if(form.teacher_id == '') {
                    this.$message.error('老师工号不能为空');
                    return
                }else if(form.office_phone == '') {
                    this.$message.error('办公电话不能为空');
                    return
                }else if(form.home_phone == '') {
                    this.$message.error('住宅电话不能为空');
                    return
                }else if(form.phone == '') {
                    this.$message.error('手机号不能为空');
                    return
                }else if(form.native_place == '') {
                    this.$message.error('籍贯不能为空');
                    return
                }else if(form.number == '') {
                    this.$message.error('老师编号不能为空');
                    return
                }else if(form.nation == '') {
                    this.$message.error('民族不能为空');
                    return
                }else if(form.borth == '') {
                    this.$message.error('出生年月不能为空');
                    return
                }else if(form.polit_outlook == '') {
                    this.$message.error('政治面貌不能为空');
                    return
                }else if(form.admin_duties == '') {
                    this.$message.error('行政职务不能为空');
                    return
                }else if(form.admin_tenure_time == '') {
                    this.$message.error('任职时间不能为空');
                    return
                }else if(form.job_level == '') {
                    this.$message.error('职务级别不能为空');
                    return
                }
//                else if(form.academic_title == '') {
//                    this.$message.error('老师职称不能为空');
//                }
                else if(form.technical_position == '') {
                    this.$message.error('专业技术职务不能为空');
                    return
                }else if(form.review_time == '') {
                    this.$message.error('评审通过时间不能为空');
                    return
                }else if(form.appointment_time == '') {
                    this.$message.error('聘任时间不能为空');
                    return
                }else if(form.series == '') {
                    this.$message.error('老师系列不能为空');
                    return
                }
//                else if(form.post_category == '') {
//                    this.$message.error('岗位类别不能为空');
//                    return
//                }
                else if(form.company == '') {
                    this.$message.error('所在单位不能为空');
                    return
                }else if(form.te_re_department == '') {
                    this.$message.error('所属教研室和实验室不能为空');
                    return
                }else if(form.working_hours == '') {
                    this.$message.error('来校工作时间不能为空');
                    return
                }else if(form.origin_work_unit == '') {
                    this.$message.error('原工作单位不能为空');
                    return
                }else if(form.certificate_num == '') {
                    this.$message.error('教师资格证书编号不能为空');
                    return
                }else if(form.identity_card == '') {
                    this.$message.error('身份证号不能为空');
                    return
                }else if(form.edu_school == '') {
                    this.$message.error('毕业院校不能为空');
                    return
                }else if(form.first_academic == '') {
                    this.$message.error('第一学历学位不能为空');
                    return
                }else if(form.first_graduate_school == '') {
                    this.$message.error('第一毕业学校不能为空');
                    return
                }else if(form.first_study_major == '') {
                    this.$message.error('第一所学专业不能为空');
                    return
                }else if(form.first_graduation_time == '') {
                    this.$message.error('第一毕业时间不能为空');
                    return
                }else if(form.most_academic == '') {
                    this.$message.error('学历/学位不能为空');
                    return
                }else if(form.most_graduate_school == '') {
                    this.$message.error('毕业学校不能为空');
                    return
                }else if(form.most_study_major == '') {
                    this.$message.error('所学专业不能为空');
                    return
                }else if(form.most_graduation_time == '') {
                    this.$message.error('毕业时间不能为空');
                    return
                }else if(form.work_major == '') {
                    this.$message.error('现从事专业不能为空');
                    return
                }else if(form.belong_subject == '') {
                    this.$message.error('所属学科不能为空');
                    return
                }else if(form.teach_course == '') {
                    this.$message.error('任教课程不能为空');
                    return
                }else if(form.master_company == '') {
                    this.$message.error('授予单位不能为空');
                    return
                }else if(form.master_time == '') {
                    this.$message.error('获得时间不能为空');
                    return
                }
                vue.$refs['form'].validate((valid) => {
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addTeaDate(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                this.Bcode=true;
//                                vue.form.teacher_id =  res.data.datas;
                                vue.$message({
                                    message:  data.message,
                                    type: 'success'
                                });
//                                this.$router.push({path: '/paper'});
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        });
//                        vue.$refs.gra_cert_road.submit();
                        vue.$refs.edu_cert_road.submit()
                    } else {
                        console.log('error submit!!');
                        return false
                    }
                })
            },
            addTeaDate(data) {
                return axios({
                    method: 'post',
                    url: 'addteacher',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
        },
        mounted(){
            this.getTeacherId();
        }
    }
</script>