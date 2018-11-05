<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">成果鉴定（）</div>
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
                                placeholder="请输入主持人"
                                prefix-icon="el-icon-search"
                                v-model="input">
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
                                placeholder="请输入鉴定成果名称"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">鉴定成果名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入鉴定形式"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">鉴定形式<i class="el-icon-arrow-down el-icon--right"></i></div>
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
                :data="allAppraisal"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="ap_first_author"
                    label="鉴定第一作者"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="ap_all_author"
                    label="全部参与人"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_res_name"
                    label="鉴定成果名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_form"
                    label="鉴定形式"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_num"
                    label="鉴定编号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_conclusion"
                    label="鉴定结论"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_time"
                    label="鉴定时间"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_level"
                    label="鉴定级别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ap_integral"
                    label="积分"
                    width="120">
                </el-table-column>
            </el-table>
            <div class="page">
                <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="100">
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
            allAppraisal:[],
            data1: '',
            input:'',
            form: {
                type:'',
                checkList: [],
            },
            
        }
    },
    methods: {
        getAppraisalData() {
            let self = this;
            axios.get("").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
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
        this.getAppraisalData();
    }
}
</script>
