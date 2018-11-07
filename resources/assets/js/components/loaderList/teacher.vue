<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header style="height: 45px;">
                    <div class="art">所有成员(213)</div>
                    <!--<div class="search">-->
                        <!--<el-row>-->
                            <!--<el-col :span="12">-->
                                <!--<el-dropdown>-->
                                <!--<span class="el-dropdown-link">-->
                                    <!--讲学时间：全部<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i>-->
                                <!--</span>-->
                                    <!--<el-dropdown-menu slot="dropdown">-->
                                        <!--<el-dropdown-item>全部</el-dropdown-item>-->
                                        <!--<el-dropdown-item>18年-今天</el-dropdown-item>-->
                                        <!--<el-dropdown-item>17年-今天</el-dropdown-item>-->
                                        <!--<el-dropdown-item>16年-今天</el-dropdown-item>-->
                                        <!--<el-dropdown-item>15年-今天</el-dropdown-item>-->
                                        <!--<el-dropdown-item>14年-今天</el-dropdown-item>-->
                                        <!--<el-dropdown-item>-->
                                            <!--<el-popover-->
                                                    <!--placement="top-start"-->
                                                    <!--width="400"-->
                                                    <!--trigger="click">-->
                                                <!--<el-date-picker-->
                                                        <!--v-model="data1"-->
                                                        <!--type="daterange"-->
                                                        <!--range-separator="至"-->
                                                        <!--start-placeholder="开始日期"-->
                                                        <!--end-placeholder="结束日期">-->
                                                <!--</el-date-picker>-->
                                                <!--<div slot="reference">自定义时段<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i></div>-->
                                            <!--</el-popover>-->
                                        <!--</el-dropdown-item>-->
                                    <!--</el-dropdown-menu>-->
                                <!--</el-dropdown>-->
                            <!--</el-col>-->
                        <!--</el-row>-->
                    <!--</div>-->
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师姓名"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">老师：姓名<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入职称"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">老师职称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师行政职务"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">行政职务<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师所属教研室和实验室"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
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
                                    placeholder="请输入老师现从事专业"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">现从事专业<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-form ref="form" :model="form" label-width="50px">
                                <el-form-item>
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1" name="type">正处</el-checkbox>
                                        <el-checkbox :label="2" name="type">副处</el-checkbox>
                                        <el-checkbox :label="3" name="type">正科</el-checkbox>
                                        <el-checkbox :label="4" name="type">副科</el-checkbox>
                                        <el-checkbox :label="5" name="type">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button>取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">职务级别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-form ref="form" :model="form" label-width="50px">
                                <el-form-item>
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1" name="type">教学秘书</el-checkbox>
                                        <el-checkbox :label="2" name="type">院长</el-checkbox>
                                        <el-checkbox :label="3" name="type">办公室主任</el-checkbox>
                                        <el-checkbox :label="4" name="type">副主任</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button>取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">岗位类别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data="teacherDate"
                    style="width:100%"
                    border
                    height="250">
                <el-table-column
                        fixed
                        prop="teacher_department"
                        label="老师所属部门">
                </el-table-column>
                <el-table-column
                        prop="teacher_id"
                        label="老师工号">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="姓名">
                </el-table-column>
                <el-table-column
                        prop="office_phone"
                        label="办公电话">
                </el-table-column>
                <el-table-column
                        prop="home_phone"
                        label="住宅电话">
                </el-table-column>
                <el-table-column
                        prop="phone"
                        label="手机号">
                </el-table-column>
                <el-table-column
                        prop="sex"
                        label="性别">
                </el-table-column>
                <el-table-column
                        prop="nation"
                        label="民族">
                </el-table-column>
                <el-table-column
                        prop="borth"
                        label="出生年月">
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
                        label="任职时间">
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
                        label="评审通过时间">
                </el-table-column>
                <el-table-column
                        prop="appointment_time"
                        label="聘任时间">
                </el-table-column>
                <el-table-column
                        prop="series"
                        label="系列">
                </el-table-column>
                <el-table-column
                        prop="post_category"
                        label="岗位类别">
                </el-table-column>
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
                        label="来校工作时间">
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
                        label="第一毕业时间">
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
                        label="最高毕业时间">
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
                        label="硕博获得时间">
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作">
                    <template slot-scope="scope">
                        <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
                        <el-button type="text" size="small">编辑</el-button>
                    </template>
                </el-table-column>

            </el-table>
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="1000">
            </el-pagination>
        </div>
    </div>
</template>

<style>
    .header{
        background: #f4f5f5;
    }
    .art{
        margin: 12px 17px;
        padding-right: 24px;
        float: left;
        border-right: 1px #d4d8d7 solid;
    }
    .cont{
        width: 85%;
        float: left;
        /*margin: 20px;*/
    }
    .search{
        float: left;
        margin: 12px 17px;
        padding-right: 24px;
        border-right: 1px #d4d8d7 solid;
    }
</style>

<script>
    export default {
        data() {
            return {
                searchValue:'',
                border:true,
                teacherDate:[],
                data1: '',
                input:'',
                form: {
                    type:'',
                    checkList: [],
                },

            }
        },
        methods: {
            getArticleData() {
                let self = this;
                axios.get("").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.teacherDate = data.datas;
                        console.log(self.teacherDate,'===================')
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            handleClick(row) {
                console.log(row);
            },
            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        }
    }
</script>
