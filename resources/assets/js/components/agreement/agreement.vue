<template>
    <div>
        <header>
            <span class="paper">
                教学科研等合作协议
            </span>
            <span class="load">
                <router-link to="/addAgreement">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
            <span class="searchtime">
                <el-form>
                    <div class="block">
                        <span class="demonstration">按合作时间检索:</span>
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
                        :data="agreementDate"
                        tooltip-effect="dark"
                        style="width: 100%"
                        @selection-change="handleSelectionChange">
                    <el-table-column
                            type="selection"
                            width="55">
                    </el-table-column>
                    <el-table-column
                            prop="agree_cooperate_unit"
                            label="合作单位"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="agree_name"
                            label="协议名称"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="agree_time"
                            label="日期"
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
                                <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentAgreementData(agreementDate[scope.$index].agree_id)"></el-button>
                                <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentAgreementData(agreementDate[scope.$index].agree_id)"></el-button>
                                <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteAgreementDate(agreementDate[scope.$index].agree_id)"></el-button>
                                <el-button type="success" icon="el-icon-download" size="mini" @click="uploadAgreementData(agreementDate[scope.$index].agree_road)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([agreementDate[0],agreementDate[1], agreementDate[2]])">选中前三条</el-button>
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
        width: 85%;
        margin: 20px 0 0 5%;
    }
    .paper{
        font-size: 18px;
        color: #090909;
        display: inline-block;
        padding: 23px 20px;
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
    @media screen and (max-width: 1400px){
        .paper{
            font-size: 16px;
            padding: 22px 40px;
        }
        .load{
            padding: 22px 40px;
        }
        .searchtime{
            width: 47% ;
        }
    }
</style>
<script>
    export default {
        data() {
            return {
                agreementDate: [],
                checked: false,
                multipleSelection:[],
                id:[],
                form: {
                    data1: '',
                    data2: '',
                },
            }
        },
        methods: {
            handleSelectionChange(val) {
                this.multipleSelection = val;
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
            ExcelSelection() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要导出论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].agree_id);
                    };
                    this.ExcelAgreementDatas(art_id_datas);
                }
            },
            ExcelAgreementDatas(art_id_datas) {
                let urls =  `exportagreementexcel?agree_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            uploadAgreementData(agree_road) {
                let urls =  `downloadfile?file=agreement/${agree_road}`;
                window.location.href = urls;
            },
             BatchDelete(){
		    	var self = this;
                var pro_id_datas = [];//存放删除的数据
                if(self.multipleSelection == ''){
                    this.$message({
                        message: '请选择要删除的数据',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        pro_id_datas.push(self.multipleSelection[i].agree_id);
                    };
                    this.deleteshoolFileDates(pro_id_datas);
                }
		    },
            deleteAgreementDates(pro_id_datas) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteagreement",{
                         params:{
                            ag_id_datas:pro_id_datas
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
            deleteAgreementDate(agree_id) {
                this.id.push(agree_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteagreement",{
                        params:{
                            ag_id_datas:agree_id
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
            getagreementDate() {
                let self = this;
                axios.get("selectallagreement").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.agreementDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            sentAgreementData(agree_id) {
                this.$router.push({
                    path: `/editAgreement/${agree_id}`,
                })
            },
            byTimeSearch(form) {
                let self = this;
                if(form.data1 == '' || form.data2 == ''){
                    this.$message.error("不能输入空");
                    return
                }
                axios.get("timeselectagreement",{
                    params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.agreementDate = data.datas;
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
            this.getagreementDate();
        }
    }
</script>
