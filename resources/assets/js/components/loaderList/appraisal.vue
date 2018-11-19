<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">成果鉴定（{{ total }}）</div>
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
                                placeholder="请输入第一作者"
                                prefix-icon="el-icon-search"
                                v-model="ap_first_author" @keyup.enter.native="nameSearch()">
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
                                placeholder="请输入鉴定成果名称"
                                prefix-icon="el-icon-search"
                                v-model="ap_res_name" @keyup.enter.native="apNameSearch()">
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
                                v-model="ap_form" @keyup.enter.native="formSearch()">
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
                                    <el-checkbox-group v-model="form.ap_level">
                                        <el-checkbox :label="0">国家级</el-checkbox>
                                        <el-checkbox :label="1">省级</el-checkbox>
                                        <el-checkbox :label="2">厅级</el-checkbox>
                                        <el-checkbox :label="3">校级</el-checkbox>
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
                height="250"
                @selection-change="handleSelectionChange">
                <el-table-column
                    type="selection"
                    width="55">
                </el-table-column>
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
            <el-button @click="ExcelSelection()">导出Excel</el-button>
            <div class="page">
                <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
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
            multipleSelection: [],
            data1: '',
            ap_first_author:'',
            pagesize:20,
            ap_res_name:'',
            ap_form:'',
            currentPage:1,
            total: 0,
            form: {
                ap_level: [],
            },   
            ap_level: [
                '国家级',
                '省级',
                '厅级',
                '校级',
            ]       
        }
    },
    methods: {
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function(currentPage){
            this.currentPage = currentPage;
        },
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        ExcelSelection() {
            var self = this;
            var art_id_datas = [];//存放导出的数据
            if(self.multipleSelection == undefined){
                this.$message({
                    message: '请选择要导出论文',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].ap_id);
                };
                this.ExcelAppraisalDatas(art_id_datas);
            }
        },
        ExcelAppraisalDatas(art_id_datas) {
            let self = this;
            let urls =  `exportappraisalexcel?ap_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getAppraisalData() {
            let self = this;
            axios.get("leaderselectallappraisal").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
        paNameSearch() {
            let self = this;
            axios.get("bynameselectappraisal",{
                params:{
                    ap_res_name: self.ap_res_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
        nameSearch() {
            let self = this;
            axios.get("byhostselectappraisal",{
                params:{
                    ap_first_author: self.ap_first_author,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
        formSearch() {
            let self = this;
            axios.get("byformselectappraisal",{
                params:{
                    ap_form: self.ap_form,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
            axios.get("bytimeselectappraisal",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
        twoTimeSearch() {
           let self = this;
            axios.get("combinationselectappraisal",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
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
        onSubmit(form) {
            let self = this;
            axios.get("combinationselectappraisal",{
                params:{
                    ap_level_datas:form.ap_level,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAppraisal = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ap_level.length;i++){
                            if(data.datas[j].ap_level == i){  
                                data.datas[j].ap_level = self.ap_level[i];
                            }
                        }
                    }
                }else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        }
    },
    mounted() {
        this.getAppraisalData();
    }
}
</script>
