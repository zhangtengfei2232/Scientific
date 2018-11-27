<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art" id="arts">获奖（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    授予时间<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
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
                                    <el-button @click="remove()">取消</el-button>
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
                @selection-change="handleSelectionChange">
                <el-table-column
                    type="selection"
                    width="55">
                </el-table-column>
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
            <el-button @click="ExcelSelection()" style="margin-top: 20px;">导出Excel</el-button>
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
        width: 95%;
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

            searchValue:'',
            border:true,
            allAward:[],
            multipleSelection: [],
            data1: '',
            newTime:0,
            aw_first_author:'',
            award_name:'',
            currentPage:1,
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
        remove() {
            document.querySelector("#arts").click();
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
                    message: '请选择要导出获奖',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].aw_id);
                };
                this.ExcelAwardDatas(art_id_datas);
            }
        },
        ExcelAwardDatas(art_id_datas) {
            let self = this;
            let urls =  `exportawardexcel?aw_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getAwardData() {
            this.commonget(this.type);
        },
        commonget(){
            let self = this;
            axios.get("byfieldselectaward",{
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
                data[i].form_achievement = self.form_achievement[data[i].form_achievement];
                data[i].aw_grade = self.aw_grade[data[i].aw_grade];
                data[i].aw_level = self.aw_level[data[i].aw_level];
            }
            self.allAward = data;
        },
        timeSearchget(){   //时间分页
            let self = this;
            self.types = 'time';
            axios.get("byfieldselectaward", {
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
            self.types = 'aw_grant_time';
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
        nameSearch() {
            let self = this;
            self.types = 'aw_first_author';
            self.values = self.aw_first_author;
            self.currentPages = 1;
            self.commonget();
        },
        awNameSearch() {
            let self = this;
            self.types = 'award_name';
            self.values = self.award_name;
            self.currentPages = 1;
            self.commonget();
        },
        groupchecks(){
            let self = this;
            axios.get("byfieldselectaward",{
                params:{
                    aw_level_datas:self.values,
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
            self.types = 'aw_level';
            self.values = form.aw_level;
            self.currentPages = 1;
            self.groupchecks();
        }
    },
    mounted() {
        this.getAwardData();
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
