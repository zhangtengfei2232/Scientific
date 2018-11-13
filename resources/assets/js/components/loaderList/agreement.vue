<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">教学科研等合作协议（{{ total }}）</div>
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
                                placeholder="请输入协议名称"
                                prefix-icon="el-icon-search"
                                v-model="agree_name" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：协议名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                :data="allAgreement"
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
                    prop="agree_name"
                    label="协议名称"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="agree_cooperate_unit"
                    label="合作单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="agree_time"
                    label="日期"
                    width="120">
                </el-table-column>
            </el-table>
            <el-button @click="ExcelSelection()">导出Excel</el-button>
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
            allAgreement:[],
            multipleSelection: [],
            data1: '',
            agree_name:'',
            total:0
        }
    },
    methods: {
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
                    art_id_datas.push(self.multipleSelection[i].agree_id);
                };
                this.ExcelArticleDatas(art_id_datas);
            }
        },
        ExcelArticleDatas(art_id_datas) {
            let self = this;
            axios.get("",{
                    params:{
                    agree_id_datas:art_id_datas
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                        self.$message({
                        showClose: true,
                        message: '导出成功!',
                        type: 'success'
                    });
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        getAgreementData() {
            let self = this;
            axios.get("leaderselectallagreement").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAgreement = data.datas;
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
            axios.get("bytimeselectagreement",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAgreement = data.datas;
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
            axios.get("bytimeselectagreement",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAgreement = data.datas;
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
            axios.get("bynameselectagreement",{
                params:{
                    agree_name: self.agree_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allSchoolfile = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
    },
    mounted() {
        this.getAgreementData();
    }
}
</script>
