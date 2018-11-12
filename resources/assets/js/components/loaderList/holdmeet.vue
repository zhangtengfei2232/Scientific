<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">举办会议（{{ total }}）</div>
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
                                placeholder="会议名称"
                                prefix-icon="el-icon-search"
                                v-model="ho_name" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">会议名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">   
                                <el-form-item label="会议级别">
                                    <el-checkbox-group v-model="form.ho_level">
                                        <el-checkbox :label="0">省级</el-checkbox>
                                        <el-checkbox :label="1">大区级</el-checkbox>
                                        <el-checkbox :label="2">国家级</el-checkbox>
                                        <el-checkbox :label="3">国际会议</el-checkbox>
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
                :data="allHoldmeet"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="ho_name"
                    label="会议名称"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="ho_art_status"
                    label="会议有无论文集"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="people_num"
                    label="会议参加人数"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ho_unit"
                    label="会议主办方单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="undertake_unit"
                    label="会议承办方单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ho_level"
                    label="会议级别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="ho_time"
                    label="会议时间"
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
            allHoldmeet:[],
            data1: '',
            ho_name:'',
            total:0,
            form: {
                ho_level: [],
            },
            ho_level:[
                '省级',
                '大区级',
                '国家级',
                '国际会议',
            ]
        }
    },
    methods: {
        getHoldmeetData() {
            let self = this;
            axios.get("leaderselectallholdmeet").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ho_level.length;i++){
                            if(data.datas[j].ho_level == i){  
                                data.datas[j].ho_level = self.ho_level[i];
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
            axios.get("bytimeselectholdmeet",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ho_level.length;i++){
                            if(data.datas[j].ho_level == i){  
                                data.datas[j].ho_level = self.ho_level[i];
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
            axios.get("bytimeselectholdmeet",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ho_level.length;i++){
                            if(data.datas[j].ho_level == i){  
                                data.datas[j].ho_level = self.ho_level[i];
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
            axios.get("bynameselectholdmeet",{
                params:{
                    ho_name: self.ho_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ho_level.length;i++){
                            if(data.datas[j].ho_level == i){  
                                data.datas[j].ho_level = self.ho_level[i];
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
            axios.get("combinationselectholdmeet",{
                params:{
                    ho_level_datas: form.ho_level,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.ho_level.length;i++){
                            if(data.datas[j].ho_level == i){  
                                data.datas[j].ho_level = self.ho_level[i];
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
        }
    },
    mounted() {
        this.getHoldmeetData();
    }
}
</script>
