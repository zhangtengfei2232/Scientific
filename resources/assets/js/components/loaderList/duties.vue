<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header style="height: 45px;">
                    <div class="art">学生团体任职({{form.num}})</div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师姓名"
                                    prefix-icon="el-icon-search"
                                    v-model="form.name"
                                    @keyup.enter.native="byNameSearch(form)">
                            </el-input>
                            <div slot="reference">老师：姓名<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入担任的学术团体名称"
                                    prefix-icon="el-icon-search"
                                    v-model="form.groupname"
                                    @keyup.enter.native="byGroupNameSearch(form)">
                            </el-input>
                            <div slot="reference">担任学术团体名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data=" StudygroupDate"
                    style="width:81%"
                    border
                    height="550"
                    @selection-change="handleSelectionChange">
                <el-table-column
                        type="selection"
                        width="55">
                </el-table-column>
                <el-table-column
                        fixed
                        header-align="center"
                        prop="teacher_name"
                        label="作者姓名">
                </el-table-column>
                <el-table-column
                        prop="du_academic"
                        header-align="center"
                        label="职称">
                </el-table-column>
                <el-table-column
                        prop="du_education"
                        label="学历"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="du_degree"
                        label="学位"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="du_age"
                        label="年龄"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="du_name"
                        label="担任学术团体名称"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="du_duty"
                        label="所任职务"
                        header-align="center">
                </el-table-column>
                <el-table-column
                        prop="du_year_num"
                        label="担任职务年限"
                        format="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"
                        type="date"
                        header-align="center">
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
        margin: 12px 17px;
        padding-right: 24px;
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
        margin: 12px 17px;
        padding-right: 24px;
        border-right: 1px #d4d8d7 solid;
    }
    .page{
        width: 30%;
        margin: 0 auto;
    }
    /*组件*/
    .el-checkbox{
        padding-left: 10px;
    }
</style>

<script>
    export default {
        data() {
            return {
                searchValue:'',
                border:true,
                StudygroupDate: [],
                multipleSelection: [],
                data1: '',
                year1: '',
                year2: '',
                input:'',
                total:0,
                form: {
                    type:'',
                    checkList: [],
                    num:'',
                    name:'',
                    groupname:''
                },
                du_academic:[   //职称
                    '教授',
                    '副教授',
                    '讲师',
                    '助教',
                    '高级实验师',
                    '实验师',
                    '助理实验师'
                ],
                du_education:[  //学历
                    '大专',
                    '研究生',
                    '本科',
                ],
                du_degree:[     //学位
                    '硕士',
                    '博士',
                    '学士',
                ],
            }
        },
        methods: {
            getArticleData() {
                let self = this;
                axios.get("leaderselectallduties").then(function (response) {
                    var data = response.data;
                    self.form.num = data.datas.length;
                    self.total = data.datas.length;
                    for(var i=0;i<data.datas.length;i++){
                        data.datas[i].du_academic = self.du_academic[data.datas[i].du_academic];
                        data.datas[i].du_education = self.du_education[data.datas[i].du_education];
                        data.datas[i].du_degree = self.du_degree[data.datas[i].du_degree];
                    }
                    if (data.code == 0) {
                        self.StudygroupDate = data.datas;

                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            checkYearExt(time){
                let a = time.split(',');
                this.year1 = a[0];
                this.year2 = a[1];
//                console.log( this.year1,'...........');
//                console.log(this.year2,'-0----8888888');
            },
//            formatDate(timestamp) {
//                var date = new Date(timestamp);
//                var year = date.getFullYear();
//                var month = date.getMonth() + 1;
//                var day = date.getDate();
//                if (month < 10) {
//                   month = "0" + month;
//                }
//                if (day < 10) {
//                   day = "0" + day;
//                }
//
////        var hours = addZero(date.getHours());
////        var minutes = addZero(date.getMinutes());
////        var seconds = addZero(date.getSeconds());
//        // return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
//        return year + '-' + month + '-' + day;
//    },
            byNameSearch(form) {                //老师姓名
                let self = this;
                axios.get("byteachernameselectduties",{
                    params:{
                        teacher_name: form.name,
                    }
                }).then(function (response) {
                    var data = response.data;
                    self.form.num = data.datas.length;
                    for(var i=0;i<data.datas.length;i++){
                        data.datas[i].du_academic = self.du_academic[data.datas[i].du_academic];
                        data.datas[i].du_education = self.du_education[data.datas[i].du_education];
                        data.datas[i].du_degree = self.du_degree[data.datas[i].du_degree];
                    }
                    if (data.code == 0) {
                        self.StudygroupDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            byGroupNameSearch(form) {                //担任学术团体名称
                let self = this;
                axios.get("bynameselectduties",{
                    params:{
                        du_name: form.groupname,
                    }
                }).then(function (response) {
                    var data = response.data;
                    self.form.num = data.datas.length;
                    for(var i=0;i<data.datas.length;i++){
                        data.datas[i].du_academic = self.du_academic[data.datas[i].du_academic];
                        data.datas[i].du_education = self.du_education[data.datas[i].du_education];
                        data.datas[i].du_degree = self.du_degree[data.datas[i].du_degree];
                    }
                    if (data.code == 0) {
                        self.StudygroupDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            ExcelSelection() {
                var self = this;
                var dut_id_datas = [];//存放导出的数据
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要导出专家讲学',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        dut_id_datas.push(self.multipleSelection[i].du_id);
                    };
                    this.ExcelHoldmeetDatas(dut_id_datas);
                }
            },
            ExcelHoldmeetDatas(dut_id_datas) {
                let self = this;
                axios.get("exportdutiesexcel",{
                    params:{
                        du_id_datas:dut_id_datas
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
            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        }
    }
</script>
