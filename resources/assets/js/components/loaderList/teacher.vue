<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art" id="arts">所有成员({{total}})</div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师姓名(回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="name"
                                    @keyup.enter.native="byNameSearch()">
                            </el-input>
                            <div slot="reference">老师：姓名<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <!--<div class="search">-->
                        <!--<el-dropdown  @command="titleCommand" style="font-size: 16px;">-->
                            <!--<span class="el-dropdown-link">-->
                            <!--老师职称<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i>-->
                            <!--</span>-->
                            <!--<el-dropdown-menu slot="dropdown">-->
                                <!--<el-dropdown-item command="0">教授</el-dropdown-item>-->
                                <!--<el-dropdown-item command="1">副教授</el-dropdown-item>-->
                                <!--<el-dropdown-item command="2">讲师</el-dropdown-item>-->
                                <!--<el-dropdown-item command="3">助教</el-dropdown-item>-->
                                <!--<el-dropdown-item command="4">高级实验师</el-dropdown-item>-->
                                <!--<el-dropdown-item command="5">实验师</el-dropdown-item>-->
                                <!--<el-dropdown-item command="6">助理实验师</el-dropdown-item>-->
                                <!--<el-dropdown-item command="7">其他</el-dropdown-item>-->
                            <!--</el-dropdown-menu>-->
                        <!--</el-dropdown>-->
                    <!--</div>-->
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师所属教研室和实验室(回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="te_re_department"
                                    @keyup.enter.native="byLabSearch()">
                            </el-input>
                            <div slot="reference">所属教研室和实验室<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师现从事专业(回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="work_major"
                                    @keyup.enter.native="byMajorSearch()">
                            </el-input>
                            <div slot="reference">现从事专业<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <!--<div class="search">-->
                        <!--<el-form ref="form" :model="form" label-width="50px">-->
                            <!--<el-dropdown @command="levelCommand" style="font-size: 16px;">-->
                                <!--<span class="el-dropdown-link">-->
                                <!--职务级别<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i>-->
                                <!--</span>-->
                                <!--<el-dropdown-menu slot="dropdown">-->
                                    <!--<el-dropdown-item command="0">正处</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="1">副处</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="2">正科</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="3">副科</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="4">其他</el-dropdown-item>-->
                                <!--</el-dropdown-menu>-->
                            <!--</el-dropdown>-->
                        <!--</el-form>-->
                    <!--</div>-->
                    <!--<div class="search">-->
                        <!--<el-dropdown @command="postCommand" style="font-size: 16px;">-->
                            <!--<span class="el-dropdown-link">-->
                            <!--行政职务<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i>-->
                            <!--</span>-->
                            <!--<el-dropdown-menu slot="dropdown">-->
                                <!--<el-dropdown-item command="0">普通老师</el-dropdown-item>-->
                                <!--<el-dropdown-item command="1">院长</el-dropdown-item>-->
                                <!--<el-dropdown-item command="2">副院长</el-dropdown-item>-->
                                <!--<el-dropdown-item command="3">教学秘书</el-dropdown-item>-->
                                <!--<el-dropdown-item command="4">科研秘书</el-dropdown-item>-->
                                <!--<el-dropdown-item command="5">研究生秘书</el-dropdown-item>-->
                                <!--<el-dropdown-item command="6">小麦中心主任</el-dropdown-item>-->
                                <!--<el-dropdown-item command="7">系主任</el-dropdown-item>-->
                                <!--<el-dropdown-item command="8">办公室主任</el-dropdown-item>-->
                                <!--<el-dropdown-item command="9">教研室主任</el-dropdown-item>-->
                                <!--<el-dropdown-item command="10">党委书记</el-dropdown-item>-->
                                <!--<el-dropdown-item command="11">党委副书记</el-dropdown-item>-->
                                <!--<el-dropdown-item command="12">研究室主任</el-dropdown-item>-->
                                <!--<el-dropdown-item command="13">实验室主任</el-dropdown-item>-->
                            <!--</el-dropdown-menu>-->
                        <!--</el-dropdown>-->
                    <!--</div>-->

                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="500"
                                trigger="click">
                            <el-form ref="form" :model="form" :indeterminate="isIndeterminate" label-width="80px">
                                <el-form-item label="老师职称">
                                    <el-checkbox-group v-model="form.academic_title">
                                        <el-checkbox :label="0">教授</el-checkbox>
                                        <el-checkbox :label="1">副教授</el-checkbox>
                                        <el-checkbox :label="2">讲师</el-checkbox>
                                        <el-checkbox :label="3">助教</el-checkbox>
                                        <el-checkbox :label="4">高级实验师</el-checkbox>
                                        <el-checkbox :label="5">实验师</el-checkbox>
                                        <el-checkbox :label="6">助理实验师</el-checkbox>
                                        <el-checkbox :label="7">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item label="职务级别">
                                    <el-checkbox-group v-model="form.job_level">
                                        <el-checkbox :label="0">正处</el-checkbox>
                                        <el-checkbox :label="1">副处</el-checkbox>
                                        <el-checkbox :label="2">正科</el-checkbox>
                                        <el-checkbox :label="3">副科</el-checkbox>
                                        <el-checkbox :label="4">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item label="行政职务">
                                    <el-checkbox-group v-model="form.admin_duties">
                                        <el-checkbox :label="0">普通老师</el-checkbox>
                                        <el-checkbox :label="1">院长</el-checkbox>
                                        <el-checkbox :label="2">副院长</el-checkbox>
                                        <el-checkbox :label="3">教学秘书</el-checkbox>
                                        <el-checkbox :label="4">科研秘书</el-checkbox>
                                        <el-checkbox :label="5">研究生秘书</el-checkbox>
                                        <el-checkbox :label="6">小麦中心主任</el-checkbox>
                                        <el-checkbox :label="7">系主任</el-checkbox>
                                        <el-checkbox :label="8">办公室主任</el-checkbox>
                                        <el-checkbox :label="9">教研室主任</el-checkbox>
                                        <el-checkbox :label="10">党委书记</el-checkbox>
                                        <el-checkbox :label="11">党委副书记</el-checkbox>
                                        <el-checkbox :label="12">研究室主任</el-checkbox>
                                        <el-checkbox :label="13">实验室主任</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click.native="onSubmit(form)">确定</el-button>
                                    <el-button @click="remove()">取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">高级筛选<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>

                </el-header>
            </div>
            <el-table
                    :data="teacherDate"
                    style="width:100%"
                    border
                    @selection-change="handleSelectionChange">
                <el-table-column
                    type="selection"
                    width="55">
                </el-table-column>
                <el-table-column
                        fixed
                        prop="name"
                        label="姓名">
                </el-table-column>
                <el-table-column
                        prop="teacher_department"
                        label="老师所属部门"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="teacher_id"
                        label="老师工号">
                </el-table-column>
                <el-table-column
                        prop="office_phone"
                        label="办公电话"
                        width="113">
                </el-table-column>
                <el-table-column
                        prop="home_phone"
                        label="住宅电话"
                        width="113">
                </el-table-column>
                <el-table-column
                        prop="phone"
                        label="手机号"
                        width="113">
                </el-table-column>
                <el-table-column
                        prop="sex"
                        label="性别"
                        width="40">
                </el-table-column>
                <el-table-column
                        prop="nation"
                        label="民族">
                </el-table-column>
                <el-table-column
                        prop="borth"
                        label="出生年月"
                        align="center"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="polit_outlook"
                        label="政治面貌">
                </el-table-column>
                <el-table-column
                        prop="native_place"
                        label="籍贯">
                </el-table-column>
                <el-table-column
                        prop="admin_duties"
                        label="行政职务">
                </el-table-column>
                <el-table-column
                        prop="admin_tenure_time"
                        label="任职时间"
                        align="center"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="job_level"
                        label="职务级别">
                </el-table-column>
                <el-table-column
                        prop="technical_position"
                        label="专业技术职务">
                </el-table-column>
                <el-table-column
                        prop="academic_title"
                        label="老师职称">
                </el-table-column>
                <el-table-column
                        prop="review_time"
                        label="评审通过时间"
                        align="center"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="appointment_time"
                        label="聘任时间"
                        align="center"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="series"
                        label="系列">
                </el-table-column>
                <!--<el-table-column-->
                        <!--prop="post_category"-->
                        <!--label="岗位类别">-->
                <!--</el-table-column>-->
                <el-table-column
                        prop="company"
                        label="所在单位">
                </el-table-column>
                <el-table-column
                        prop="te_re_department"
                        label="所属教研室和实验室">
                </el-table-column>
                <el-table-column
                        prop="working_hours"
                        label="来校工作时间"
                        align="center"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="origin_work_unit"
                        label="原工作单位">
                </el-table-column>
                <el-table-column
                        prop="certificate_num"
                        label="教师资格证编号">
                </el-table-column>
                <el-table-column
                    prop="identity_card"
                    label="身份证号">
                </el-table-column>
                <el-table-column
                        prop="edu_school"
                        label="毕业院校">
                </el-table-column>
                <el-table-column
                        prop="first_academic"
                        label="第一学历学位">
                </el-table-column>
                <el-table-column
                        prop="first_graduate_school"
                        label="第一毕业学校">
                </el-table-column>
                <el-table-column
                        prop="first_study_major"
                        label="第一所学专业">
                </el-table-column>
                <el-table-column
                        prop="first_graduation_time"
                        label="第一毕业时间"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="most_academic"
                        label="最高学历学位">
                </el-table-column>
                <el-table-column
                        prop="most_graduate_school"
                        label="最高毕业学校">
                </el-table-column>
                <el-table-column
                        prop="most_study_major"
                        label="最高所学专业">
                </el-table-column>
                <el-table-column
                        prop="most_graduation_time"
                        label="最高毕业时间"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="work_major"
                        label="从事专业">
                </el-table-column>
                <el-table-column
                        prop="belong_subject"
                        label="从事专业所属学科">
                </el-table-column>
                <el-table-column
                        prop="teach_course"
                        label="任教课程">
                </el-table-column>
                <el-table-column
                        prop="master_company"
                        label="硕博导授予单位">
                </el-table-column>
                <el-table-column
                        prop="master_time"
                        label="硕博获得时间"
                        width="100">
                </el-table-column>
            </el-table>
            <el-button @click="ExcelSelection()"style="margin-top: 20px;">导出Excel</el-button>
            <div class="page">
                <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPages"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="pagesize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
                </el-pagination>
            </div>
        </div>
    </div>
</template>

<style>
    .header{
        background: #f4f5f5;
    }
    .art{
        padding: 20px 10px;
        float: left;
        border-right: 1px #d4d8d7 solid;
    }
    .cont{
        width: 95%;
        float: left;
        margin: 20px;
    }
    .search{
        float: left;
        padding: 20px 20px;
        border-right: 1px #d4d8d7 solid;
    }
    .page{
        width: 30%;
        margin: 0 auto;
    }
</style>

<script>
    export default {
        data() {
            return {
                types:'',
                currentPages:1,
                pagesize:10,
                start_time:0,
                end_time:0,
                values:'',
                total:0,
                searchValue:'',
                border:true,
                isIndeterminate: true,
                teacherDate:[],
                data1: '',
                name:'',
                te_re_department:'',
                work_major:'',
                academic:'',
                job:'',
                admin:'',
                form: {
                    admin_duties:[],
                    academic_title:[],
                    job_level:[],
                    type:'',
                    checkList: [],
                },
                teacher_department:[//所属部门
                    '生物工程系',
                    '生物技术系',
                    '农学系',
                    '领导行政政工',
                    '在外人员',
                    '其他',
                ],
                sex:[
                    '男',
                    '女',
                ],
                polit_outlook:[//政治面貌
                    '积极分子',
                    '发展对象',
                    '预备党员',
                    '共产党员',
                    '其他',
                ],
                job_level:[ //职务级别
                    '正处',
                    '副处',
                    '正科',
                    '副科',
                    '其他'
                ],
                technical_position:[//专业技术职务
                    '初级',
                    '中级',
                    '副高',
                    '正高',
                    '其他',
                ],
                academic_title:[    //老师职称
                    '教授',
                    '副教授',
                    '讲师',
                    '助教',
                    '高级实验师',
                    '实验师',
                    '助理实验师',
                    '其他',
                ],
                admin_duties:[     //行政职务
                    '普通老师',
                    '院长',
                    '副院长',
                    '教学秘书',
                    '科研秘书',
                    '研究生秘书',
                    '小麦中心主任',
                    '系主任',
                    '办公室主任',
                    '教研室主任',
                    '党委书记',
                    '党委副书记',
                    '研究室主任',
                    '实验室主任',
                ],
                first_academic:[//第一学历学位
                    '大专',
                    '本科',
                    '其他',
                ],
                most_academic:[//最高学历/学位
                    '硕士',
                    '博士',
                    '其他',
                ],
            }
        },
        methods: {
            remove() {
                document.querySelector("#arts").click();
            },
            getArticleData() {
                this.commonget(this.type);
            },
            commonget(){
                let self = this;
                axios.get("byfieldselectteacher",{
                    params:{
                        value:self.values,
                        type: self.types,
                        page:self.currentPages,
                        total:self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.teacher_data);

                })
            },
            commonchange(data){
                let self = this;
                for(var i=0;i<data.length;i++){
                    data[i].sex = self.sex[data[i].sex];
                    data[i].first_academic = self.first_academic[data[i].first_academic];
                    data[i].most_academic = self.most_academic[data[i].most_academic];
                    data[i].polit_outlook = self.polit_outlook[data[i].polit_outlook];
                    data[i].teacher_department = self.teacher_department[data[i].teacher_department];
                    data[i].job_level = self.job_level[data[i].job_level];
                    data[i].technical_position = self.technical_position[data[i].technical_position];
                    data[i].academic_title = self.academic_title[data[i].academic_title];
                    data[i].admin_duties = self.admin_duties[data[i].admin_duties];
                }
                self.teacherDate = data;
            },
            byNameSearch() {                //老师姓名
                let self = this;
                self.types = 'name';
                self.values = self.name;
                self.currentPages = 1;
                self.commonget();
            },
            byLabSearch(){                  //所属教研室和实验室
                let self = this;
                self.types = 'te_re_department';
                self.values = self.te_re_department;
                self.currentPages = 1;
                self.commonget();
            },
            byMajorSearch(){                    //现从事专业
                let self = this;
                self.types = 'work_major';
                self.values = self.work_major;
                self.currentPages = 1;
                self.commonget();
            },
            groupchecks(){
                let self = this;
                axios.get("byfieldselectteacher",{
                    params:{
                        academic_title_datas:self.academic,
                        job_level_datas:self.job,
                        admin_duties_datas:self.admin,
                        type: self.types,
                        page:self.currentPages,
                        total:self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.teacher_data);

                })
            },
            onSubmit(form) {
                let self = this;
                self.types = 'composite_query';
                self.academic = form.academic_title;
                self.job = form.job_level;
                self.admin = form.admin_duties;
                self.currentPages = 1;
                self.groupchecks();
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            handleSizeChange(val) {
                this.pagesize = val;
                this.commonget(this.types,this.values);
            },
            handleCurrentChange(val) {
                this.currentPages=val;
            },
            ExcelSelection() {
                var self = this;
                var tea_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出的老师信息',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        tea_id_datas.push(self.multipleSelection[i].teacher_id);
                    };
                    this.ExcelHoldmeetDatas(tea_id_datas);
                }
            },
            ExcelHoldmeetDatas(tea_id_datas) {
                let self = this;
                let urls =  `exportteacherexcel?tea_id_datas=${tea_id_datas}`;
                window.location.href = urls;
            },
        },
        mounted() {
            this.getArticleData();
        },
        watch:{
            currentPages:function (currentPages) {
                this.currentPages = currentPages;
                switch(this.types) {
                    case 'time':
                        this.timeSearchget();
                        break;
                    case 'composite_query':
                        this.groupchecks();
                        break;
                    default:
                        this.commonget();
                        break;
                }
            }
        },
    }
</script>
