<template>
    <div>
        <header>
            <span class="paper">
                专家讲学
            </span>
        <span class="load">
                <router-link to="/addLecture">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
            <span class="searchtime">
                    <el-form>
                        <div class="block">
                            <span class="demonstration">按讲学时间检索:</span>
                            <el-date-picker
                                    v-model="form.data1"
                                    type="date"
                                    placeholder="选择日期"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                            <span>-</span>
                            <el-date-picker
                                    v-model="form.data2"
                                    type="date"
                                    placeholder="选择日期"
                                    format="yyyy 年 MM 月 dd 日"
                                    value-format="timestamp">
                            </el-date-picker>
                            <el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch(form)">搜索</el-button>
                        </div>
                    </el-form>
                </span>
            </header>

        <div class="table">
            <template>
                <el-table
                        ref="multipleTable"
                        :data="ExperspeakDate"
                        tooltip-effect="dark"
                        style="width: 100%"
                        @selection-change="handleSelectionChange">
                    <el-table-column
                            type="selection"
                            width="55">
                    </el-table-column>
                    <el-table-column
                            prop="le_expert_name"
                            label="专家姓名"
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="le_expert_level"
                            label="专家级别"
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="le_time"
                            label="讲学时间">
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                            width="200">
                        <template slot-scope="scope">
                            <el-button
                                    type="text"
                                    size="small">
                                <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentExperspeakDate(ExperspeakDate[scope.$index].le_id)"></el-button>
                                <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentExperspeakDate(ExperspeakDate[scope.$index].le_id)"></el-button>
                                <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteExperspeakDate(ExperspeakDate[scope.$index].le_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection()">取消选择</el-button>
                    <el-button @click="BatchDelete()">删除</el-button>
                    <el-button @click="ExcelSelection()">导出Excel</el-button>
                </div>
            </template>
        </div>
    </div>
</template>
<style scoped>
    header{
        border-bottom: 1px solid #eee;
    }
    .table{
        float: left;
        width: 80%;
        margin: 20px 0 0 5%;
    }
    .paper{
        font-size: 18px;
        color: #090909;
        display: inline-block;
        padding: 23px 60px;
        border-right: 1px solid #eee;
    }
    .load{
        display: inline-block;
        margin: 0;
        padding: 16px 60px;
        border-right: 1px solid #eee;
    }
    .searchtime{
        /*width: 45%;*/
        display: inline-block;
        margin: 15px 0 0 7%;
    }
    .demonstration{
        font-weight: lighter;
    }
    .dos a,.tos a{
        color: rgba(61, 112, 206, 0.77)!important;
    }
    .del a{
        color: rgba(229, 28, 35, 1)!important;
    }
    .clear{
        clear: both;
        content: '';
    }
</style>
<script>
    export default {
        data() {
            return {
                id:[],
                sortable:true,
                ExperspeakDate: [],
                checked: false,
                le_expert_level:[
                    '院士',
                    '博导',
                    '国务院学位委员会委员',
                    '教授',
                    '其他'
                ],
                dataForm: new FormData(),
                form: {
                    le_expert_name:'',
                    data1: '',
                    data2: '',
                },

            }
        },
        methods: {
            deleteRow(index, rows) {
                rows.splice(index, 1);
            },
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            ExcelSelection() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出的专家讲学',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].le_id);
                    }
                    this.ExcelJoinmeetDatas(art_id_datas);
                }
            },
            ExcelJoinmeetDatas(art_id_datas) {
                let urls =  `exportlectureexcel?le_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            BatchDelete(){
                var self = this;
                var le_id_datas = [];//存放删除的数据
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要删除论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        le_id_datas.push(self.multipleSelection[i].le_id);
                        //删除数组——删除选择的行
                    }
                    this.deleteExperspeakDates(le_id_datas);
                }
            },
            getExperspeakDate() {
                let self = this;
                axios.get("selectalllecture").then(function (response) {
                    var data = response.data;
                    var length_data = response.data.datas;
                    for(var i=0;i<length_data.length;i++){
                        length_data[i].le_expert_level = self.le_expert_level[length_data[i].le_expert_level];
                    }
                    if (response.data.code == 0) {
                        self.ExperspeakDate = length_data;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            deleteExperspeakDates(le_id_datas) {
                this.$confirm('此操作批量删除文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deletelecture",{
                        params:{
                            le_id_datas:le_id_datas
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message:data.message,
                            });
                            location.reload();
                        } else {
                            self.$notify({
                                type: 'error',
                                message: data.message,
                                duration: 2000,
                            });
                        }
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            deleteExperspeakDate(le_id) {
                this.id.push(le_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    cancelButtonText: '取消',
                    confirmButtonText: '确定',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deletelecture",{
                        params:{
                            le_id_datas:this.id
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                            self.$message({
                                type: 'success',
                                message:data.message
                            });
                            location.reload();
                        } else {
                            self.$notify({
                                type: 'error',
                                message: data.message,
                                duration: 2000,
                            });
                        }
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            sentExperspeakDate(le_id) {
                this.$router.push({
                    path: `/editLecture/${le_id}`,
                })
            },
            byTimeSearch(form) {
                if(form.data1 == ''||form.data2 == ''){
                    this.$message.error("搜索时间不能为空！");
                    return;
                }
                let self = this;
                axios.get("timeselectlecture",{
                    params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ExperspeakDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },

        },

        mounted() {
            this.getExperspeakDate();
        }
    }
</script>