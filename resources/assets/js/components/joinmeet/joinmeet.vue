<template>
    <div>
        <header>
            <span class="paper">
                参加会议
            </span>
            <span class="load">
                <router-link to="/addJoinmeet">
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
                        <el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch(form)">搜索</el-button>
                    </div>
                </el-form>
            </span>
        </header>
        <div class="table">
            <template>
                <el-table
                    ref="multipleTable"
                    :data="JoinmeetDate"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                    <el-table-column
                    type="selection"
                    width="55">
                    </el-table-column>
                    <el-table-column
                    prop="jo_id"
                    label="序号"
                    sortable
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="jo_name"
                    label="学术会议名称"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="jo_time"
                    label="会议时间"
                    show-overflow-tooltip>
                    </el-table-column>
                    <el-table-column
                        fixed="right"
                        label="操作"
                        width="200">
                        <template slot-scope="scope">
                            <el-button
                            @click.native.prevent="deleteRow(scope.$index, JoinmeetDate)"
                            type="text"
                            size="small">
                            <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentJoinmeetSelfData(JoinmeetDate[scope.$index].jo_id)"></el-button>
                            <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentJoinmeetSelfData(JoinmeetDate[scope.$index].jo_id)"></el-button>
                            <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteJoinmeetData(JoinmeetDate[scope.$index].jo_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([JoinmeetDate[0],JoinmeetDate[1], JoinmeetDate[2]])">选中前三条</el-button>
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
                id:[],
                sortable:true,
                JoinmeetDate: [],
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
            getJoinmeetDate() {
                let self = this;
                axios.get("selectalljoinmeet").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.JoinmeetDate = data.datas;
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
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '警告哦，这是一条警告消息',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        pro_id_datas.push(self.multipleSelection[i].jo_id);
                    };
                    this.deleteJoinmeetDatas(pro_id_datas);
                }
		    },
            deleteJoinmeetDatas(pro_id_datas) {
                this.$confirm('此操作批量删除文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deletejoinmeet",{
                        params:{
                            jo_id_datas:pro_id_datas
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message: '删除成功!'
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
            deleteJoinmeetData(jo_id) {
                this.id.push(jo_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deletejoinmeet",{
                        params:{
                            jo_id_datas:this.id
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             this.$message({
                                type: 'success',
                                message: '删除成功!'
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
            sentJoinmeetSelfData(jo_id) {
                this.$router.push({
                    path: `/selfJoinmeet/${jo_id}`,
                })
            },
            byTimeSearch(form) {
                if(form.data1 == '' || form.data2 == ''){
                    this.$message.error("不能输入空");
                    return
                }
                axios.get("timeselectjoinmeet",{
                    params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.JoinmeetDate = data.datas;
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
            this.getJoinmeetDate();
        }
    }
</script>