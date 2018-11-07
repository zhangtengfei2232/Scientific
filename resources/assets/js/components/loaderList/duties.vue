<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header style="height: 45px;">
                    <div class="art">学生团体任职(213)</div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click">
                            <el-input
                                    placeholder="请输入老师姓名"
                                    prefix-icon="el-icon-search"
                                    v-model="input">
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
                                    v-model="input">
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
                    height="550">
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
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="1000">
            </el-pagination>
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
        /*margin: 20px;*/
    }
    .search{
        float: left;
        margin: 12px 17px;
        padding-right: 24px;
        border-right: 1px #d4d8d7 solid;
    }
</style>

<script>
    export default {
        data() {
            return {
                searchValue:'',
                border:true,
                StudygroupDate: [],
                data1: '',
                year1: '',
                year2: '',
                input:'',
                form: {
                    type:'',
                    checkList: [],
                },

            }
        },
        methods: {
            getArticleData() {
                let self = this;
                axios.get("leaderselectallduties").then(function (response) {
                    var data = response.data;
                    var time = data.datas[0].du_year_num;
                    console.log(time,"**************");
                     self.checkYearExt(time);
//                    var kk =self.year1;
//                    var kk2 =self.year2;
//                    var kk =self.formatDate(999999)
//                    console.log(kk,'=========')
//                    var kk2 =self.formatDate(666666)
//                    console.log(kk2,'[[[[[[]]]]]')
                     var star = self.formatDate(parseInt(self.year1));
                    console.log(star,"**///////");
                    var end = self.formatDate(parseInt(self.year2));
                    console.log(end,"**///////");
                    self.du_year_num = star+"-"+end;
//
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
                console.log( this.year1,'...........');
                console.log(this.year2,'-0----8888888');
            },
            formatDate(timestamp) {
                var date = new Date(timestamp);
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();
                if (month < 10) {
                   month = "0" + month;
                }
                if (day < 10) {
                   day = "0" + day;
                }

//        var hours = addZero(date.getHours());
//        var minutes = addZero(date.getMinutes());
//        var seconds = addZero(date.getSeconds());
        // return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
        return year + '-' + month + '-' + day;
    },

            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        }
    }
</script>
