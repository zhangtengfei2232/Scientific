<template>
    <div>
        <header>
            <span class="paper">
                校发文件
            </span>
            <span class="load">
                <router-link to="/addschoolFile">
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
                                placeholder="选择日期">
                        </el-date-picker>
                        <span>-</span>
                        <el-date-picker
                                v-model="form.data2"
                                type="date"
                                placeholder="选择日期">
                        </el-date-picker>
                        <el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch">搜索</el-button>
                    </div>
                </el-form>
            </span>
        </header>
        <div class="table">
            <template>
                <el-table
                        ref="multipleTable"
                        :data="shoolFileDate"
                        tooltip-effect="dark"
                        style="width: 100%"
                        @selection-change="handleSelectionChange">
                    <el-table-column
                            type="selection"
                            width="55">
                    </el-table-column>
                    <el-table-column
                            prop="schfile_id"
                            label="序号"
                            sortable
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="schfile_name"
                            label="文件名称"
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="schfile_down_time"
                            label="文件下发时间"
                            sortable
                            show-overflow-tooltip>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                            width="200">
                        <template slot-scope="scope">
                            <el-button
                                    @click.native.prevent="deleteRow(scope.$index, shoolFileDate)"
                                    type="text"
                                    size="small">
                                <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentshoolFileDate(shoolFileDate[scope.$index].schfile_id)"></el-button>
                                <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentshoolFileDate(shoolFileDate[scope.$index].schfile_id)"></el-button>
                                <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteshooolFileDate(shoolFileDate[scope.$index].schfile_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([shoolFileDate[0],shoolFileDate[1], shoolFileDate[2]])">切换第二、第三行的选中状态</el-button>
                    <el-button @click="toggleSelection()">取消选择</el-button>
                    <el-button @click="BatchDelete()">删除</el-button>
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
        width: 45%;
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
                id:[],
                shoolFileDate: [],
                checked: false,
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
            BatchDelete(){
		    	var self = this;
                var pro_id_datas = [];//存放删除的数据
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要删除的数据',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        pro_id_datas.push(self.multipleSelection[i].schfile_id);
                    };
                    this.deleteProjectDatas(pro_id_datas);
                }
		    },
            deleteshoolFileDates(pro_id_datas) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteschoolfile",{
                         params:{
                            sc_id_datas:pro_id_datas
                        }
                    }).then(function (response) {
                        var data = response.data;
                        if (data.code == 0) {
                            this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                        } else {
                            self.$notify({
                                type: 'error',
                                message: data.msg,
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
            deleteshoolFileDate(schfile_id) {
                this.id.push(schfile_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteschoolfile",{
                        params:{
                            sc_id_datas:schfile_id
                        }
                    }).then(function (response) {
                        var data = response.data;
                        if (data.code == 0) {
                            this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                        } else {
                            self.$notify({
                                type: 'error',
                                message: data.msg,
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
            getshoolFileDate() {
                let self = this;
                axios.get("selectallschoolfile").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.shoolFileDate = data.datas;
                        console.log(self.shoolFileDate);
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            sentshoolFileDate(schfile_id) {
                this.$router.push({
                    path: `/selfSchoolFile/${schfile_id}`,
                })
            },
            byTimeSearch() {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.shoolFileDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
        },
        mounted() {
            this.getshoolFileDate();
        }
    }
</script>