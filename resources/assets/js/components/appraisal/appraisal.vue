<template>
    <div>
        <header>
            <span class="paper">
                成果鉴定
            </span>
            <span class="load">
                <router-link to="/addAppraisal">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
            <span class="searchtime">
                <el-form>
                    <div class="block">
                        <span class="demonstration">按发表时间检索:</span>
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
                        <span><el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch(form)">搜索</el-button></span>
                    </div>
                </el-form>
            </span>
        </header>
        <div class="table">
            <template>
                <el-table
                    ref="multipleTable"
                    :data="AppraisalDate"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                    <el-table-column
                    type="selection"
                    width="55">
                    </el-table-column>
                    <el-table-column
                    prop="ap_form"
                    label="鉴定形式"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="ap_res_name"
                    label="鉴定成果名称"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="ap_time"
                    label="鉴定时间"
                    show-overflow-tooltip>
                    </el-table-column>
                    <el-table-column
                        fixed="right"
                        label="操作"
                        width="250">
                        <template slot-scope="scope">
                            <el-button
                            type="text"
                            size="small">
                            <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentAppraisalSelfData(AppraisalDate[scope.$index].ap_id)"></el-button>
                            <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentAppraisalSelfData(AppraisalDate[scope.$index].ap_id)"></el-button>
                            <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteAppraisalData(AppraisalDate[scope.$index].ap_id)"></el-button>
                            <el-button type="success" icon="el-icon-download" size="mini" @click="uploadAppraisalData(AppraisalDate[scope.$index].ap_road)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection()">取消选择</el-button>
                    <el-button @click="BatchDelete()">删除</el-button>
                    <el-button @click="ExcelSelection()">导出Excel</el-button>
                    <el-button @click="BatchExport()">导出PDF</el-button>
                </div>
            </template>
        </div>
    </div>
</template>

<style scoped>
    header{
        border-bottom: 1px solid #eee;
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
         width: 60%;
         display: inline-block;
         margin: 15px 0 0 7%;
    }
    .demonstration{
        font-weight: lighter;
    }
   .table{
        float: left;
        width: 85%;
        margin: 20px 0 0 5%;
    }
</style>
<script>
    export default {
        data() {
            return {
                id:[],
                sortable:true,
                AppraisalDate: [],
                checked: false,
                multipleSelection:[],
                form: {
                    data1: '',
                    data2: '',
                },
            }
        },
        methods: {
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
                        message: '请选择要导出数据',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].ap_id);
                    };
                    this.ExcelAppraisalDatas(art_id_datas);
                }
            },
            ExcelAppraisalDatas(art_id_datas) {
                let urls =  `exportappraisalexcel?ap_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            getAppraisalDate() {
                let self = this;
                axios.get("selectallappraisal").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AppraisalDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            BatchDelete(){
		    	var self = this;
                var pro_id_datas = [];//存放删除的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '警告哦，这是一条警告消息',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        pro_id_datas.push(self.multipleSelection[i].ap_id);
                    };
                    this.deleteAppraisalDatas(pro_id_datas);
                }
            },
            deleteAppraisalDatas(pro_id_datas) {
                this.$confirm('此操作批量删除文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteappraisal",{
                        params:{
                            ap_id_datas:pro_id_datas
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message: data.message
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
            deleteAppraisalData(ap_id) {
                this.id.push(ap_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteappraisal",{
                        params:{
                            ap_id_datas:self.id
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message: data.message
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
            sentAppraisalSelfData(ap_id) {
                this.$router.push({
                path: `/selfAppraisal/${ap_id}`,
                })
            },
            uploadAppraisalData(ap_road) {
                let urls =  `downloadfile?file=appraisal/${ap_road}`;
                window.open(urls, '_blank');
            },
            BatchExport() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出数据',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].ap_id);
                    };
                    this.exportArticleDatas(art_id_datas);
                }
            },
            exportArticleDatas(art_id_datas) {
                let urls =  `exportappraisalpdfs?ap_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            byTimeSearch(form) {
                let self = this;
                if(form.data1 == '' || form.data2 == ''){
                    this.$message.error("不能输入空");
                    return
                }
                axios.get("timeselectappraisal",{
                    params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AppraisalDate = data.datas;
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
            this.getAppraisalDate();
        }
    }
</script>
