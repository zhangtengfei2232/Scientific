<template>
    <div>
        <header>
            <span class="paper">
                获奖
            </span>
            <span class="load">
                <router-link to="/addAward">
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
                        placeholder="选择日期">
                        </el-date-picker>
                        <span>-</span>
                        <el-date-picker
                        v-model="form.data2"
                        type="date"
                        placeholder="选择日期">
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
                    :data="AwardDate"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                    <el-table-column
                    type="selection"
                    width="55">
                    </el-table-column>
                    <el-table-column
                    prop="aw_id"
                    label="序号"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="award_name"
                    label="奖励名称"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="aw_grant_time"
                    label="授予时间"
                    show-overflow-tooltip>
                    </el-table-column>
                    <el-table-column
                        fixed="right"
                        label="操作"
                        width="200">
                        <template slot-scope="scope">
                            <el-button
                            @click.native.prevent="deleteRow(scope.$index, AwardDate)"
                            type="text"
                            size="small">
                            <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentAwardSelfData(aw_id)"></el-button>
                            <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentAwardSelfData(aw_id)"></el-button>
                            <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteAwardData(aw_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([AwardDate[1], AwardDate[2]])">切换第二、第三行的选中状态</el-button>
                    <el-button @click="toggleSelection()">取消选择</el-button>
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
         width: 45%;
         display: inline-block;
         margin: 15px 0 0 18%;
    }
    .demonstration{
        font-weight: lighter;
    }
    .table{
        float: left;
        width: 80%;
        margin: 20px 0 0 5%;
    } 
</style>
<script>
    export default {
        data() {
            return {
                AwardDate: [],
                checkAll: false,
                checked: false,
                form: {
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
            getAwardDate() {
                let self = this;
                axios.get("selectallaward").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AwardDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            sentAwardSelfData(aw_id) {
                this.$router.push({
                path: `/selfAward/${aw_id}`,
                })
            },
            deleteAwardData(aw_id) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("",aw_id).then(function (response) {
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
            byTimeSearch(form) {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AwardDate = data.datas;
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
            this.getAwardDate();
        }
    }
</script>