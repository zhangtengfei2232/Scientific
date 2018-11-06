<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header style="height: 45px;">
                    <div class="art">学生团体任职(213)</div>
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
                                    placeholder="请输入担任的学术团体名称"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">担任学术团体名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data=" StudygroupDate"
                    style="width:81%"
                    border
                    height="250">
                <el-table-column
                        fixed
                        prop="teacher_name"
                        label="作者姓名"
                        width="154">
                </el-table-column>
                <el-table-column
                        prop="du_academic"
                        label="职称"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="du_education"
                        label="学历"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="du_degree"
                        label="学位"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="du_age"
                        label="年龄"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="du_name"
                        label="担任学术团体名称"
                        width="250">
                </el-table-column>
                <el-table-column
                        prop="du_duty"
                        label="所任职务"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="du_year_num"
                        label="担任职务年限"
                        width="155">
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
                StudygroupDate: [],
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
                        self.StudygroupDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        }
    }
</script>
