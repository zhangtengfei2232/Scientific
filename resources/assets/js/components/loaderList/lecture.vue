<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header style="height: 45px;">
                    <div class="art">专家讲学(213)</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    讲学时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item>全部</el-dropdown-item>
                                        <el-dropdown-item>18年-今天</el-dropdown-item>
                                        <el-dropdown-item>17年-今天</el-dropdown-item>
                                        <el-dropdown-item>16年-今天</el-dropdown-item>
                                        <el-dropdown-item>15年-今天</el-dropdown-item>
                                        <el-dropdown-item>14年-今天</el-dropdown-item>
                                        <el-dropdown-item>
                                            <el-popover
                                                    placement="top-start"
                                                    width="400"
                                                    trigger="click">
                                                <el-date-picker
                                                        v-model="data1"
                                                        type="daterange"
                                                        range-separator="至"
                                                        start-placeholder="开始日期"
                                                        end-placeholder="结束日期">
                                                </el-date-picker>
                                                <div slot="reference">自定义时段<i class="el-icon-arrow-down el-icon--right"></i></div>
                                            </el-popover>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </el-col>
                        </el-row>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入专家姓名"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">专家：姓名<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入邀请单位"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
                            </el-input>
                            <div slot="reference">邀请单位<i class="el-icon-arrow-down el-icon--right"></i></div>
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
                                        <el-checkbox :label="1" name="type">院士</el-checkbox>
                                        <el-checkbox :label="2" name="type">博导</el-checkbox>
                                        <el-checkbox :label="3" name="type">国务院学位委员会委员</el-checkbox>
                                        <el-checkbox :label="4" name="type">教授</el-checkbox>
                                        <el-checkbox :label="5" name="type">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button>取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">专家级别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data=" ExperspeakDate"
                    style="width:100%"
                    border
                    height="250">
                <el-table-column
                        fixed
                        prop="le_expert_name"
                        label="专家姓名"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="le_expert_level"
                        label="专家级别"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="le_report_name"
                        label="报告名称"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="le_invite_status"
                        label="邀请/被邀"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="le_invite_unit"
                        label="邀请单位"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="le_time"
                        label="讲学时间"
                        header-align="center">
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
                ExperspeakDate: [],
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
                axios.get("leaderselectalllecture").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ExperspeakDate = data.datas;
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
