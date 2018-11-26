<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">校发文件（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
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
                                placeholder="请输入校发文件名称"
                                prefix-icon="el-icon-search"
                                v-model="schfile_name" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">文件名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                :data="allSchoolfile"
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
                    prop="schfile_name"
                    label="校发文件名称"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="schfile_num"
                    label="文件编号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="schfile_down_time"
                    label="文件日期"
                    width="120">
                </el-table-column>
            </el-table>
            <el-button @click="ExcelSelection()">导出Excel</el-button>
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
            types:'',
            currentPages:1,
            pagesize:10,
            start_time:0,
            end_time:0,
            values:'',
            total:0,
            newTime:0,
            searchValue:'',
            border:true,
            allSchoolfile:[],
            multipleSelection: [],
            data1: '',
            currentPage:1,
            schfile_name:'',
        }
    },
    methods: {
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
                    message: '请选择要导出数据',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].schfile_id);
                };
                this.ExcelSchoolfileDatas(art_id_datas);
            }
        },
        ExcelSchoolfileDatas(art_id_datas) {
            let urls =  `exportschoolfileexcel?schfile_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getSchoolfileData() {
            this.commonget(this.type);
//            let self = this;
//            axios.get("leaderselectallschoolfile").then(function (response) {
//                var data = response.data;
//                if (data.code == 0) {
//                    self.allSchoolfile = data.datas;
//                    self.total = data.datas.length;
//                } else {
//                    self.$notify({
//                        type: 'error',
//                        message: data.message,
//                        duration: 2000,
//                    });
//                }
//            });
        },
        commonget(){
            let self = this;
            axios.get("byfieldselectschoofile",{
                params:{
                    value:self.values,
                    type: self.types,
                    page:self.currentPages,
                    total:self.pagesize,
                }
            }).then(function (response) {
                self.total = response.data.datas.total;
//                self.commonchange(response.data.datas.data);

            })
        },
//        commonchange(data){
//            let self = this;
//            for(var i=0;i<data.length;i++){
//                data[i].le_invite_status = self.le_invite_status[data[i].le_invite_status];
//                data[i].le_expert_level = self.le_expert_level[data[i].le_expert_level];
//            }
//            self.ExperspeakDate = data;
//        },
        timeSearchget(){   //时间分页
            let self = this;
            self.types = 'time';
            axios.get("byfieldselectschoofile", {
                params: {
                    start_time:self.start_time,
                    end_time:self.end_time,
                    type: self.types,
                    page: self.currentPages,
                    total: self.pagesize,
                }
            }).then(function (response) {
                self.total = response.data.datas.total;
//                self.commonchange(response.data.datas.data);
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
            this.end_time = Date.parse(new Date());
            let self = this;
            self.types = 'le_time';
            self.timeSearchget();
//            var timestamp = Date.parse(new Date());
//            let self = this;
//            axios.get("bytimeselectschoofile",{
//                params:{
//                    start_time:this.newTime,
//                    end_time:timestamp
//                }
//            }).then(function (response) {
//                var data = response.data;
//                if (data.code == 0) {
//                    self.allSchoolfile = data.datas;
//                } else {
//                    self.$notify({
//                        type: 'error',
//                        message: data.message,
//                        duration: 2000,
//                    });
//                }
//            });
        },
        twoTimeSearch() {
            let self = this;
            self.types = 'time';
            self.start_time = self.data1[0];
            self.end_time   = self.data1[1];
            self.timeSearchget();
//           let self = this;
//            axios.get("bytimeselectschoofile",{
//                params:{
//                    start_time:self.data1[0],
//                    end_time:self.data1[1],
//                }
//            }).then(function (response) {
//                var data = response.data;
//                if (data.code == 0) {
//                    self.allSchoolfile = data.datas;
//                } else {
//                    self.$notify({
//                        type: 'error',
//                        message: data.message,
//                        duration: 2000,
//                    });
//                }
//            });
        },
        nameSearch() {
            let self = this;
            self.types = 'schfile_name';
            self.values = self.schfile_name;
            self.commonget();
//            let self = this;
//            axios.get("bynameselectschoofile",{
//                params:{
//                    schfile_name: self.schfile_name,
//                }
//            }).then(function (response) {
//                var data = response.data;
//                if (data.code == 0) {
//                    self.allSchoolfile = data.datas;
//                } else {
//                    self.$notify({
//                        type: 'error',
//                        message: data.message,
//                        duration: 2000,
//                    });
//                }
//            });
        },
    },
    mounted() {
        this.getSchoolfileData();
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
