<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art" id="arts">专家讲学({{total}})</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    讲学时间<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                    <el-dropdown-menu slot="dropdown">
                                        <!--<el-dropdown-item>全部</el-dropdown-item>-->
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
                        <el-popover
                                placement="top-start"
                                width="500"
                                trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">
                                <el-form-item label="专家级别">
                                    <el-checkbox-group v-model="form.le_expert_level">
                                        <el-checkbox :label="0">院士</el-checkbox>
                                        <el-checkbox :label="1">博导</el-checkbox>
                                        <el-checkbox :label="2">国务院学位委员会委员</el-checkbox>
                                        <el-checkbox :label="3">教授</el-checkbox>
                                        <el-checkbox :label="4">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button @click="remove()">取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">高级筛选<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <!--<div class="search">-->
                        <!--<el-form ref="form" :model="form" label-width="50px">-->
                            <!--<el-dropdown @command="levelCommand" style="font-size: 16px;">-->
                                <!--<span class="el-dropdown-link">-->
                                <!--专家级别<i class="el-icon-arrow-down el-icon&#45;&#45;right"></i>-->
                                <!--</span>-->
                                <!--<el-dropdown-menu slot="dropdown">-->
                                    <!--<el-dropdown-item command="0">院士</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="1">博导</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="2">国务院学位委员会委员</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="3">教授</el-dropdown-item>-->
                                    <!--<el-dropdown-item command="4">其他</el-dropdown-item>-->
                                <!--</el-dropdown-menu>-->
                            <!--</el-dropdown>-->
                        <!--</el-form>-->
                    <!--</div>-->
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
                start_time:0,
                end_time:0,
                values:'',
                total:0,
                le_invite_unit:'',
                le_expert_name:'',
                searchValue:'',
                border:true,
                ExperspeakDate: [],
                multipleSelection: [],
                data1: '',
                input:'',
                name:'',
                form: {
                    le_expert_level:[],
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
//                    '全部',
                    '18年-今天',
                    '17年-今天',
                    '16年-今天',
                    '15年-今天',
                    '14年-今天',
                ],
            }
        },
        methods: {
            remove() {
                document.querySelector("#arts").click();
            },
            getArticleData() {
                this.commonget(this.type);
            },
            commonget(){
                let self = this;
                axios.get("byFieldSelectLecture",{
                    params:{
                        value:self.values,
                        type: self.types,
                        page:self.currentPages,
                        total:self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.data);

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

            byNameSearch() {                //专家姓名
                let self = this;
                self.types = 'le_expert_name';
                self.values = self.le_expert_name;
                self.currentPages = 1;
                self.commonget();
            },
            byCompanySearch(){  // 邀请单位
                let self = this;
                self.types = 'le_invite_unit';
                self.values = self.le_invite_unit;
                self.currentPages = 1;
                self.commonget();
            },
            levelCommand(command){       //专家级别
                let self = this;
                self.types = 'le_expert_level';
//                console.log(self.command,'/*/*/*/');
                self.values = command;
                self.currentPages = 1;
                self.commonget();
            },
            timeSearchget(){   //时间分页
                let self = this;
                self.types = 'time';
                axios.get("byFieldSelectLecture", {
                    params: {
                        start_time:self.start_time,
                        end_time:self.end_time,
                        type: self.types,
                        page: self.currentPages,
                        total: self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.data);
                });
            },
            timeSearch(time) {
                if(time == 8) {
                    this.start_time = '1514779200000';
                }else if(time == 7) {
                    this.start_time = '1483243200000';
                }else if(time == 6) {
                    this.start_time = '1451620800000';
                }else if(time == 5) {
                    this.start_time = '1420084800000';
                }else if(time == 4) {
                    this.start_time = '1388548800000';
                }
                this.end_time = Date.parse(new Date());
                let self = this;
                self.types = 'le_time';
                self.currentPages = 1;
                self.timeSearchget();
            },
            twoTimeSearch() {
                let self = this;
                self.types = 'time';
                self.start_time = self.data1[0];
                self.end_time   = self.data1[1];
                self.currentPages = 1;
                self.timeSearchget();
            },
            groupchecks(){
                let self = this;
                axios.get("byFieldSelectLecture",{
                    params:{
                        le_expert_level_datas:self.values,
                        type: self.types,
                        page:self.currentPages,
                        total:self.pagesize,
                    }
                }).then(function (response) {
                    self.total = response.data.datas.total;
                    self.commonchange(response.data.datas.data);

                })
            },

            onSubmit(form) {
                let self = this;
                self.types = 'le_expert_level';
                self.values = form.le_expert_level;
                self.currentPages = 1;
                self.groupchecks();
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
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
        },
        mounted() {
            this.getArticleData();
        },
        watch:{
            currentPages:function (currentPages) {
                this.currentPages = currentPages;
                switch(this.types) {
                    case 'time':
                        this.timeSearchget();
                        break;
                    default:
                        this.commonget();
                        break;
                }
            }
        },
    }
</script>
