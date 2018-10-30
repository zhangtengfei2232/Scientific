<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
            <el-form-item label="头像">
                <img src="/dist/img/pic_fill.png" alt="未加载">
            </el-form-item>
            <el-form-item label="老师所属部门" prop="teacher_department">
                <el-input v-model="form.teacher_department"></el-input>
            </el-form-item>
            <el-form-item label="老师工号" prop="teacher_id">
                <el-input v-model="form.teacher_id"></el-input>
            </el-form-item>
            <el-form-item label="姓名" prop="name">
                <el-input v-model="form.name"></el-input>
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
            <el-form-item label="编号" prop="number">
                <el-input v-model="form.number"></el-input>
            </el-form-item>
            <el-form-item label="性别" prop="sex">
                <el-input v-model="form.sex"></el-input>
            </el-form-item>
            <el-form-item label="民族" prop="nation">
                <el-input v-model="form.nation"></el-input>
            </el-form-item>
            <el-form-item label="出生年月" prop="borth">
                <el-input v-model="form.borth"></el-input>
            </el-form-item>
            <el-form-item label="政治面貌" prop="polit_outlook">
                <el-input v-model="form.polit_outlook"></el-input>
            </el-form-item>
            <el-form-item label="籍贯" prop="native_place">
                <el-input v-model="form.native_place"></el-input>
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
            <el-form-item label="专业技术职务" prop="technical_position">
                <el-input v-model="form.technical_position"></el-input>
            </el-form-item>
            <el-form-item label="老师职称" prop="academic_title">
                <el-input v-model="form.academic_title"></el-input>
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
            <el-form-item label="老师毕业院校" prop="edu_school">
                <el-input v-model="form.edu_school"></el-input>
            </el-form-item>

            <el-form-item label="第一学历：" ></el-form-item>

            <el-form-item label="第一学历/学位" prop="first_graduate_school">
                <el-input v-model="form.first_graduate_school"></el-input>
            </el-form-item>
            <el-form-item label="第一毕业学校" prop="edu_school">
                <el-input v-model="form.edu_school"></el-input>
            </el-form-item>
            <el-form-item label="第一所学专业" prop="first_study_major">
                <el-input v-model="form.first_study_major"></el-input>
            </el-form-item>
            <el-form-item label="第一毕业时间" prop="first_graduation_time">
                <el-input v-model="form.first_graduation_time"></el-input>
            </el-form-item>

            <el-form-item label="最高学历：" ></el-form-item>

            <el-form-item label="最高学历/学位" prop="most_academic">
                <el-input v-model="form.most_academic"></el-input>
            </el-form-item>
            <el-form-item label="最高毕业学校" prop="most_graduate_school">
                <el-input v-model="form.most_graduate_school"></el-input>
            </el-form-item>
            <el-form-item label="最高所学专业" prop="most_study_major">
                <el-input v-model="form.most_study_major"></el-input>
            </el-form-item>
            <el-form-item label="最高毕业时间" prop="most_graduation_time">
                <el-input v-model="form.most_graduation_time"></el-input>
            </el-form-item>



            <el-form-item label="现从事专业" prop="work_major">
                <el-input v-model="form.work_major"></el-input>
            </el-form-item>
            <el-form-item label="从事专业所属学科" prop="belong_subject">
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

            <el-form-item label="毕业证书图片">
                <el-upload
                        class="upload-demo"
                        action=""
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :before-upload="fileArtpdf"
                        ref="gra_cert_road"
                        :file-list="fileList2"
                        list-type="picture">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>

            </el-form-item>
            <el-form-item label="学历证书图片">
                <el-upload
                        class="upload-demo"
                        action=""
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :before-upload="fileArtedu"
                        ref="edu_cert_road"
                        :file-list="fileList2"
                        list-type="picture">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">保存修改</el-button>
                <!--<el-button><router-link to="/paper">取消</router-link></el-button>-->
            </el-form-item>
        </el-form>
        </div>
    </div>

</template>
<style>
    .contents{
        width: 75%;
        float: left;
    }
    .add{
        width: 73%;
        margin: 35px 0 0 35px;
    }
</style>
<script>
    export default{
        data(){
            return{
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

                    academic_title:'',
                    nation:'',
                    edu_school:'',
                    first_graduate_school:'',
                    most_graduation_time:'',
                    most_graduate_school:'',
                    edu_cert_road:'',



                    polit_outlook:'',
                    admin_duties:'',
                    admin_tenure_time:'',
                    technical_position:'',
                    review_time:'',
                    appointment_time:'',
                    series:'',
                    post_category:'',
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
                    gra_cert_road:'',

                },
            }
        },
        methods:{
            fileArtpdf(file){
                this.dataForm.append('gra_cert_road', file);
                return false;
            },
            fileArtedu(file){
                this.dataForm.append('edu_cert_road', file);
                return false;
            },
        }
    }
</script>