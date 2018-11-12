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
                                    <el-dropdown-item @click="timeSearch(8)">18年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(7)">17年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(6)">16年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(5)">15年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(4)">14年-今天</el-dropdown-item>
                                    <el-dropdown-item>
                                        <el-popover
                                            placement="top-start"
                                            width="400"
                                            trigger="click"
                                            style="width:450px !important">
                                            <span style="float:left;width: 87%;">
                                                <el-date-picker
                                                    v-model="data1"
                                                    type="daterange"
                                                    range-separator="至"
                                                    start-placeholder="开始日期"
                                                    end-placeholder="结束日期"
                                                    value-format="timestamp">
                                                </el-date-picker>
                                            </span>
                                            <span style="float:left"><el-button type="primary" icon="el-icon-search" @click="twoTimeSearch()" style="width:25px;margin: 0 5px;"></el-button></span>
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
                                placeholder="请输入主持人姓名"
                                prefix-icon="el-icon-search"
                                v-model="pro_name" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：主持人<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入项目类别"
                                prefix-icon="el-icon-search"
                                v-model="project_category" @keyup.enter.native="typeSearch()">
                            </el-input>
                            <div slot="reference">项目类别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入批准单位"
                                prefix-icon="el-icon-search"
                                v-model="approval_unit" @keyup.enter.native="approveSearch()">
                            </el-input>
                            <div slot="reference">批准单位<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">   
                                <el-form-item label="学科门类">
                                    <el-checkbox-group v-model="form.pro_sub_category">
                                        <el-checkbox :label="0">理学</el-checkbox>
                                        <el-checkbox :label="1">工学</el-checkbox>
                                        <el-checkbox :label="2">农学</el-checkbox>
                                        <el-checkbox :label="3">医学</el-checkbox>
                                        <el-checkbox :label="4">管理学</el-checkbox>
                                        <el-checkbox :label="5">马克思主义</el-checkbox>
                                        <el-checkbox :label="6">哲学</el-checkbox>
                                        <el-checkbox :label="7">逻辑学</el-checkbox>
                                        <el-checkbox :label="8">宗教学</el-checkbox>
                                        <el-checkbox :label="9">语言学</el-checkbox>
                                        <el-checkbox :label="10">中国文学</el-checkbox> 
                                        <el-checkbox :label="11">外国文学</el-checkbox>
                                        <el-checkbox :label="12">艺术学</el-checkbox>
                                        <el-checkbox :label="13">历史学</el-checkbox>
                                        <el-checkbox :label="14">考古学</el-checkbox>
                                        <el-checkbox :label="15">经济学</el-checkbox>
                                        <el-checkbox :label="16">政治学</el-checkbox>  
                                        <el-checkbox :label="17">法学</el-checkbox>  
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
        width: 85%;
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
            pro_name:'',
            project_category:'',
            total:0,
            approval_unit:'',
            form: {
                pro_sub_category:[],
            },
            pro_cate_research: [
                '基础研究',
                '实验与发展',
                '应用研究',
            ],
            pro_sub_category: [
                '理学',
                '工学',   
                '农学',
                '医学',
                '管理学',
                '马克思主义',
                '哲学',
                '逻辑学',
                '宗教学',
                '语言学' ,
                '中国文学',
                '外国文学',
                '艺术学',
                '历史学',
                '考古学',
                '经济学',
                '政治学',
                '法学',
            ],
            form_cooperate: [
                '与境外机构合作',
                '与国内高校合作',   
                '与国内独立研究机构合作',
                '与境内注册外商独资企业合作',
                '与境内注册其他企业合作',
                '其他',
            ]
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
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.pro_cate_research.length;i++){
                            if(data.datas[j].pro_cate_research == i){  
                                data.datas[j].pro_cate_research = self.pro_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.pro_sub_category.length;i++){
                            if(data.datas[j].pro_sub_category == i){  
                                data.datas[j].pro_sub_category = self.pro_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.form_cooperate.length;i++){
                            if(data.datas[j].form_cooperate == i){  
                                data.datas[j].form_cooperate = self.form_cooperate[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
         timeSearch(time) {
            if(time == 8) {
                this.newTime = '1514779200';
            }else if(time == 7) {
                this.newTime = '1483243200';
            }else if(time == 6) {
                this.newTime = '1451620800';
            }else if(time == 5) {
                this.newTime = '1420084800';
            }else if(time == 4) {
                this.newTime = '1388548800';
            }
            var timestamp = Date.parse(new Date());
            let self = this;
            axios.get("byyearselectproject",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allProject = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
        twoTimeSearch() {
           let self = this;
            axios.get("byyearselectproject",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allProject = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
        nameSearch() {
            let self = this;
            axios.get("byhostselectproject",{
                params:{
                    pro_host: self.pro_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
        typeSearch() {
            let self = this;
            axios.get("bycategoryselectproject",{
                params:{
                    project_category: self.project_category,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
        approveSearch() {
            let self = this;
            axios.get("byapprovalunitaelectproject",{
                params:{
                    approval_unit: self.approval_unit,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
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
