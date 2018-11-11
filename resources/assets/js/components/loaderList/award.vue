<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">获奖（{{ total }}）</div>
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
                                placeholder="请输入第一获奖人"
                                prefix-icon="el-icon-search"
                                v-model="aw_first_author" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：获奖人<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                           <el-input
                                placeholder="请输入奖励名称"
                                prefix-icon="el-icon-search"
                                v-model="award_name" @keyup.enter.native="awNameSearch()">
                            </el-input>
                            <div slot="reference">检索：奖励名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">
                                <el-form-item label="奖励级别">
                                    <el-checkbox-group v-model="form.aw_level">
                                        <el-checkbox :label="0" name="type">国家级</el-checkbox>
                                        <el-checkbox :label="1" name="type">省部级</el-checkbox>
                                        <el-checkbox :label="2" name="type">厅局级</el-checkbox>
                                        <el-checkbox :label="3" name="type">校级</el-checkbox>
                                        <el-checkbox :label="4" name="type">其他</el-checkbox>
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
                :data="allAward"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="aw_first_author"
                    label="第一获奖人"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="aw_all_author"
                    label="全部获奖人"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="prize_win_name"
                    label="获奖成果名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="award_name"
                    label="奖励名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="form_achievement"
                    label="成果形式"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_level"
                    label="奖励级别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_grade"
                    label="奖励等级"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_grant_unit"
                    label="授予单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_grant_time"
                    label="授予时间"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_certi_number"
                    label="证书编号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_sch_rank"
                    label="校级名次"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="aw_integral"
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
            allAward:[],
            data1: '',
            aw_first_author:'',
            award_name:'',
            total:'',
            form: {
                aw_level: [],
            },
            form_achievement:[
                '论文',
                '研究报告',
                '新技术',
                '新工艺',
                '课件',
                '新产品',
                '专著',
                '编著',
                '计算机软件',
                '教材',
                '其他',
            ],
            aw_grade: [
                '一等奖',
                '二等奖',
                '三等奖',
            ],
            aw_level: [
                '国家级',
                '省部级',
                '厅局级',
                '校级',
                '其他',
            ]
        }
    },
    methods: {
        getAwardData() {
            let self = this;
            axios.get("leaderselectallaward").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAward = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.form_achievement.length;i++){
                            if(data.datas[j].form_achievement == i){  
                                data.datas[j].form_achievement = self.form_achievement[i];
                            }
                        }
                        for(var i= 0;i<self.aw_grade.length;i++){
                            if(data.datas[j].aw_grade == i){  
                                data.datas[j].aw_grade = self.aw_grade[i];
                            }
                        }
                        for(var i= 0;i<self.aw_level.length;i++){
                            if(data.datas[j].aw_level == i){  
                                data.datas[j].aw_level = self.aw_level[i];
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
            axios.get("byawardtimeselectaward",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAward = data.datas;
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
            axios.get("byawardtimeselectaward",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAward = data.datas;
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
            axios.get("byfirstwinnerselectaward",{
                params:{
                    aw_first_author: self.aw_first_author,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAward = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,         
                    });
                }
            });
        },
         awNameSearch() {
            let self = this;
            axios.get("bynameselectaward",{
                params:{
                    award_name: self.award_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allAward = data.datas;
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
        this.getAwardData();
    }
}
</script>
