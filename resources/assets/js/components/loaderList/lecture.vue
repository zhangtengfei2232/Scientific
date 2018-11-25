<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">专家讲学({{total}})</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    讲学时间<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item>全部</el-dropdown-item>
                                        <el-dropdown-item @click.native="timeSearch(8)">18年-今天</el-dropdown-item>
                                        <el-dropdown-item @click.native="timeSearch(7)">17年-今天</el-dropdown-item>
                                        <el-dropdown-item @click.native="timeSearch(6)">16年-今天</el-dropdown-item>
                                        <el-dropdown-item @click.native="timeSearch(5)">15年-今天</el-dropdown-item>
                                        <el-dropdown-item @click.native="timeSearch(4)">14年-今天</el-dropdown-item>
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
                                    placeholder="请输入专家姓名 (回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="le_expert_name"
                                    @keyup.enter.native="byNameSearch()">
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
                                    placeholder="请输入邀请单位 (回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="le_invite_unit"
                                    @keyup.enter.native="byCompanySearch()">
                            </el-input>
                            <div slot="reference">邀请单位<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-form ref="form" :model="form" label-width="50px">
                            <el-dropdown @command="levelCommand" style="font-size: 16px;">
                                <span class="el-dropdown-link">
                                专家级别<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item command="0">院士</el-dropdown-item>
                                    <el-dropdown-item command="1">博导</el-dropdown-item>
                                    <el-dropdown-item command="2">国务院学位委员会委员</el-dropdown-item>
                                    <el-dropdown-item command="3">教授</el-dropdown-item>
                                    <el-dropdown-item command="4">其他</el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </el-form>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data=" ExperspeakDate"
                    style="width:100%"
                    border
                    @selection-change="handleSelectionChange">
                <el-table-column
                        type="selection"
                        width="55">
                </el-table-column>
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
            <el-button @click="ExcelSelection()"style="margin-top: 20px;">导出Excel</el-button>
            <div class="page">
                <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="currentPages"
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
        width:95%;
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
                types:'',
                currentPages:1,
                pagesize:10,
                newTime: '',
                timestamp:0,
                values:'',
                total:0,
                le_invite_unit:'',
                le_expert_name:'',
//                le_time:'',
//                le_expert_level:'',
//                le_invite_status:'',
                searchValue:'',
                border:true,
                ExperspeakDate: [],
                multipleSelection: [],
                data1: '',
                input:'',
                name:'',
                form: {
                    type:'',
//                    company:'',
                    checkList: [],
                    num:'',
                },
                le_invite_status:[
                    '邀请',
                    '未邀请'
                ],
                le_expert_level:[
                    '院士',
                    '博导',
                    '国务院学位委员会委员',
                    '教授',
                    '其他'
                ],
                le_time:[
                    '全部',
                    '18年-今天',
                    '17年-今天',
                    '16年-今天',
                    '15年-今天',
                    '14年-今天',
                ],
            }
        },
        methods: {
            getArticleData() {
                this.commonget(this.type)
            },
            commonget(){
                let self = this;
                axios.get("bynameselectlecture",{
                    params:{
                        value:self.values,
                        type: self.types,
                        page:self.currentPages,
                        total:self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.du_datas);

                })
            },
            commonchange(data){
                let self = this;
                for(var i=0;i<data.length;i++){
                    data[i].le_invite_status = self.le_invite_status[data[i].le_invite_status];
                    data[i].le_expert_level = self.le_expert_level[data[i].le_expert_level];
                }
                self.ExperspeakDate = data;
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },



            byNameSearch() {                //专家姓名
                let self = this;
                self.types = 'le_expert_name';
                self.values = self.le_expert_name;
                self.commonget();
            },
            byCompanySearch(){  // 邀请单位
                let self = this;
                self.types = 'le_invite_unit';
                self.values = self.le_invite_unit;
                self.commonget();
            },

//            dropDown(command){
//                let self = this;
//                axios.get("bylevelselectlecture", {
//                    params: {
//                        le_expert_level: command,
//                        value: self.values,
//                        type: self.types,
//                        page: self.currentPages,
//                        total: self.pagesize,
//                    }
//                }).then(function (response) {
//                    self.total = response.data.datas.total;
//                    self.commonchange(response.data.datas.du_datas);
//                });
//            },
            levelCommand(){       //专家级别
                let self = this;
//                le_expert_level: command;
                self.types = 'le_expert_level';
                self.values = self.command;
                self.commonget();
            },
            timeSearchget(){   //时间分页

                let self = this;
//                console.log(timestamp);
//                return ;
                axios.get("byinvitetimeselectlecture", {
                    params: {
                        start_time:this.newTime,
                        end_time:this.timestamp,
                        type: self.types,
                        page: self.currentPages,
                        total: self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.du_datas);
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
                this.timestamp = Date.parse(new Date());
                let self = this;
                self.types = 'le_time';
                self.values = self.le_time;
                self.timeSearchget();

//                console.log(timestamp,'=-=-=-=-')
//                let self = this;
//                axios.get("byinvitetimeselectlecture",{
//                    params:{
//                        start_time:this.newTime,
//                        end_time:timestamp,
//                        page: self.currentPage,
//                        total: self.pagesize,
//                        type: 'art_time',
//                    }
//                }).then(function (response) {
//                    var data = response.data;
//                    if (data.code == 0) {
//                        self.ExperspeakDate = data.datas;
//                        for(var j=0;j<data.datas.length;j++){
//                            for(var i= 0;i<self.le_expert_level.length;i++){
//                                if(data.datas[j].le_expert_level == i){
//                                    data.datas[j].le_expert_level = self.le_expert_level[i];
//                                }
//                            }
//                        }
//                    } else {
//                        self.$notify({
//                            type: 'error',
//                            message: data.message,
//                            duration: 2000,
//                        });
//                    }
//                });
            },
            twoTimeSearch() {
                self.type = 'art_time2';
                let self = this;
                self.values = self.le_time;
                self.timeSearchget();
//                axios.get("byinvitetimeselectlecture",{
//                    params:{
//                        page: self.currentPage,
//                        total: self.pagesize,
//                        type: 'art_time',
//                        start_time:self.data1[0],
//                        end_time:self.data1[1],
//                    }
//                }).then(function (response) {
//                    var data = response.data;
//                    if (data.code == 0) {
//                        self.ExperspeakDate = data.datas;
//                        for(var j=0;j<data.datas.length;j++){
//                            for(var i= 0;i<self.le_expert_level.length;i++){
//                                if(data.datas[j].le_expert_level == i){
//                                    data.datas[j].le_expert_level = self.le_expert_level[i];
//                                }
//                            }
//                        }
//                    } else {
//                        self.$notify({
//                            type: 'error',
//                            message: data.message,
//                            duration: 2000,
//                        });
//                    }
//                });
            },
            handleSizeChange(val) {
                this.pagesize = val;
                this.commonget(this.types,this.values);
            },
            handleCurrentChange(val) {
                this.currentPages=val;
            },
            ExcelSelection() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出专家讲学',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].le_id);
                    };
                    this.ExcelHoldmeetDatas(art_id_datas);
                }
            },
            ExcelHoldmeetDatas(art_id_datas) {
                let self = this;
                let urls =  `exportlectureexcel?le_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        },
        watch:{
            currentPages:function (currentPages) {
                this.currentPages = currentPages;
                this.commonget(this.types,this.values);
//                this.byNameSearch();
//                this.byGroupNameSearch();
                switch(types) {
                    case le_expert_name:
                        this.byNameSearch();
                        break;
                    case art_time1:
                        this.timeSearch(this.newTime);
                        break;
                    case art_time2:
                        this.twoTimeSearch();
                        break;
                    case le_invite_unit:    //邀请单位
                        this.byCompanySearch();
                        break;
//                    case combine:
//                        this.onSubmit();
//                        break;
                    default:
                        this.$message.error('暂无此查询');
                        break;
                }
            }
        },
    }
</script>
