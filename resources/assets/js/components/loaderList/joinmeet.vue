<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">参加会议（{{ total }}）</div>
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
                                placeholder="请输入会议名称"
                                prefix-icon="el-icon-search"
                                v-model="jo_name" @keyup.enter.native="nameSearch()">
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
                                    <el-checkbox-group v-model="form.jo_level">
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
                :data="allJoinmeet"
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
                    prop="join_people"
                    label="参加人员"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="jo_name"
                    label="学术会议名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_hold_unit"
                    label="会议主办方单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_take_unit"
                    label="会议承办方单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_level"
                    label="会议等级"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_time"
                    label="会议时间"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_place"
                    label="会议地点"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_art_num"
                    label="会议论文提交数"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_is_invite"
                    label="是否被邀大会或分会场报告"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="jo_title"
                    label="会议题目"
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
            allJoinmeet:[],
            multipleSelection: [],
            data1: '',
            jo_name:'',
            input:'',
            currentPage:1,
            total:0,
            form: {
                jo_level: [],
            },
            jo_level:[
                '省级',
                '大区级',
                '国家级',
                '国际会议',
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
                    message: '请选择要导出参加会议',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].jo_id);
                };
                this.ExcelJoinmeetDatas(art_id_datas);
            }
        },
        ExcelJoinmeetDatas(art_id_datas) {
            let self = this;
            axios.get("exportjoinmeetexcel",{
                    params:{
                    jo_id_datas:art_id_datas
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
        getJoinmeetData() {
            let self = this;
            axios.get("leaderselectalljoinmeet").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allJoinmeet = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.jo_level.length;i++){
                            if(data.datas[j].jo_level == i){  
                                data.datas[j].jo_level = self.jo_level[i];
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
            axios.get("bytimeselectjoinmeet",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allJoinmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.jo_level.length;i++){
                            if(data.datas[j].jo_level == i){  
                                data.datas[j].jo_level = self.jo_level[i];
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
            axios.get("bytimeselectjoinmeet",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allJoinmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.jo_level.length;i++){
                            if(data.datas[j].jo_level == i){  
                                data.datas[j].jo_level = self.jo_level[i];
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
            axios.get("bynameselectjoinmeet",{
                params:{
                    jo_name: self.jo_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allJoinmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.jo_level.length;i++){
                            if(data.datas[j].jo_level == i){  
                                data.datas[j].jo_level = self.jo_level[i];
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
            axios.get("combinationselectjoinmeet",{
                params:{
                    jo_level_datas: form.jo_level,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allHoldmeet = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.jo_level.length;i++){
                            if(data.datas[j].jo_level == i){  
                                data.datas[j].jo_level = self.jo_level[i];
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
        this.getJoinmeetData();
    }
}
</script>
