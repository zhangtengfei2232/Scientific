<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">学生团体任职({{total}})</div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click"
                                >
                            <el-input
                                    placeholder="请输入老师姓名 (回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="teacher_name"
                                    @keyup.enter.native="byNameSearch()"
                                    >
                            </el-input>
                            <div slot="reference">老师：姓名<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                                placement="top-start"
                                width="400"
                                trigger="click"
                                >
                            <el-input
                                    placeholder="请输入担任的学术团体名称 (回车搜索)"
                                    prefix-icon="el-icon-search"
                                    v-model="du_name"
                                    @keyup.enter.native="byGroupNameSearch()"
                                    >
                            </el-input>
                            <div slot="reference">担任学术团体名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                    :data=" StudygroupDate"
                    style="width:100%"
                    border
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
                        label="担任职务年限"
                        header-align="center"
                        width="200">
                    <el-table-column
                            prop="start_time"
                            label="开始时间"
                            header-align="center"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            prop="end_time"
                            label="截止时间"
                            header-align="center"
                            width="100">
                    </el-table-column>
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

<style scoped>
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
                searchValue:'',
                border:true,
                StudygroupDate: [],
                multipleSelection: [],
                values:'',
                data1: '',
                year1: '',
                year2: '',
                input:'',
                total:0,
                du_name:'',
                teacher_name:'',
                form: {
                    type:'',
                    checkList: [],
                    num:'',
                },
                du_academic:[   //职称
                    '教授',
                    '副教授',
                    '讲师',
                    '助教',
                    '高级实验师',
                    '实验师',
                    '助理实验师',
                    '其他',
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
                 this.commonget(this.type)
            },
            commonget(){
                let self = this;
                axios.get("byfieldselectduties",{
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
                    data[i].du_academic = self.du_academic[data[i].du_academic];
                    data[i].du_education = self.du_education[data[i].du_education];
                    data[i].du_degree = self.du_degree[data[i].du_degree];
                }
                self.StudygroupDate = data;
            },
            byNameSearch() {                //老师姓名
                let self = this;
                self.types = 'teacher_name';
                self.values = self.teacher_name;
                self.currentPages = 1;
                self.commonget();
            },
            byGroupNameSearch() {                //担任学术团体名称
                let self = this;
                self.types = 'du_name';
                self.values = self.du_name;
                self.currentPages = 1;
                self.commonget();
            },
            ExcelSelection() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出的担任学术团体职务',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].du_id);
                    };
                    this.ExcelHoldmeetDatas(art_id_datas);
                }
            },
            ExcelHoldmeetDatas(art_id_datas) {
                let self = this;
                let urls =  `exportdutiesexcel?du_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },

            //分页
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
            onSubmit() {

            }
        },
        mounted() {
            this.getArticleData();
        },
        watch:{
            currentPages:function (currentPages) {
                this.currentPages = currentPages;
                this.commonget(this.types,this.values)
            }
        },
    }
</script>
