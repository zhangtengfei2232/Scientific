<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">项目（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
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
                                placeholder="请输入作者名"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">检索：作者<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入刊物级别"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">学校认定刊物级别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">   
                                <el-form-item label="刊物级别">
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1">SCI一区</el-checkbox>
                                        <el-checkbox :label="2">SCI二区</el-checkbox>
                                        <el-checkbox :label="3">SCI三区</el-checkbox>
                                        <el-checkbox :label="4">SCI四区</el-checkbox>
                                        <el-checkbox :label="5">EI</el-checkbox>
                                        <el-checkbox :label="6">SSCI</el-checkbox>
                                        <el-checkbox :label="7">CN</el-checkbox>
                                        <el-checkbox :label="8">CSSCI核心库</el-checkbox>
                                        <el-checkbox :label="9">中文核心</el-checkbox>
                                        <el-checkbox :label="10">CSCD核心库</el-checkbox>
                                        <el-checkbox :label="11">河南科技学院期刊</el-checkbox>  
                                    </el-checkbox-group>
                                </el-form-item> 
                                <el-form-item label="研究类别">
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1" name="type">基础研究</el-checkbox>
                                        <el-checkbox :label="2" name="type">应用研究</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button>取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">高级筛选<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                :data="allProject"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="pro_host"
                    label="项目主持人"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="pro_all_author"
                    label="项目所有参加人员"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="entry_name"
                    label="项目名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="project_category"
                    label="项目类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="approval_unit"
                    label="批准单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="approval_funds"
                    label="批准经费"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="account_outlay"
                    label="当年到账经费"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_cate_research"
                    label="研究类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_sub_category"
                    label="学科门类"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="form_cooperate"
                    label="合作形式"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="social_eco_goal"
                    label="社会经济目标"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="na_eco_industry"
                    label="服务的国民经济行业"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="project_year"
                    label="项目年份"
                    width="120">
                </el-table-column>
            </el-table>
            <div class="page">
                <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="1000">
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
        width: 80%;
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
            searchValue:'',
            border:true,
            allProject:[],
            data1: '',
            input:'',
            total:'',
            form: {
                type:'',
                checkList: [],
            },
            
        }
    },
    methods: {
        getProjectData() {
            let self = this;
            axios.get("leaderselectallproject").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allProject = data.datas;
                    self.total = data.datas.length;
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
        this.getProjectData();
    }
}
</script>
