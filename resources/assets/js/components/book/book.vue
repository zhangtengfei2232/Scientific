<template>
    <div>
        <header>
            <span class="paper">
                著作
            </span>
            <span class="load">
                <router-link to="/addBook">
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

        <div class="table" v-show="cont">
            <template>
                <el-table
                    ref="multipleTable"
                    :data="BookDate"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                    <el-table-column
                    type="selection"
                    width="55">
                    </el-table-column>
                    <el-table-column
                    prop="op_id"
                    label="序号"
                    sortable
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="op_name"
                    label="著作名称"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="op_publish_time"
                    label="出版时间"
                    show-overflow-tooltip>
                    </el-table-column>
                    <el-table-column
                        fixed="right"
                        label="操作"
                        width="200">
                        <template slot-scope="scope">
                            <el-button
                            type="text"
                            size="small">
                            <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentBookSelfData(BookDate[scope.$index].op_id)"></el-button>
                            <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentBookSelfData(BookDate[scope.$index].op_id)"></el-button>
                            <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteBookData(BookDate[scope.$index].op_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([BookDate[1], BookDate[2], BookDate[0]])">选中前三条</el-button>
                    <el-button @click="toggleSelection()">取消选择</el-button>
                    <el-button @click="BatchDelete()">删除</el-button>
                    <el-button @click="ExcelSelection()">导出Excel</el-button>
                </div>
            </template>
        </div>
        <div class="null" v-show="conts">
            <img src="/dist/img/null.png" alt="">
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
    .null{
        margin: 0 auto;
        width: 150px;
    }
</style>

<script>
    export default {
        data() {
            return {
                id:[],
                BookDate: [],
                checked: false,
                multipleSelection:[],
                checkAll: false,
                sortable:true,
                cont:true,
                conts:false,
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
                        message: '请选择要导出著作',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].op_id);
                    };
                    this.ExcelOpusDatas(art_id_datas);
                }
            },
            ExcelOpusDatas(art_id_datas) {
                let urls =  `exportopusexcel?op_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            getBookData() {
                let self = this;
                axios.get("selectallopus").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.BookDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            sentBookSelfData(op_id) {
                this.$router.push({
                path: `/selfBook/${op_id}`,
                })
            },
            BatchDelete(){
		    	var self = this;
                var pro_id_datas = [];//存放删除的数据
                if(self.multipleSelection == ''){
                    self.$message({
                        message: '警告哦，这是一条警告消息',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        pro_id_datas.push(self.multipleSelection[i].op_id);
                    };
                    this.deleteBookDatas(pro_id_datas);
                }
		    },
             deleteBookDatas(pro_id_datas) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteopus",{
                        params:{
                            op_id_datas:pro_id_datas
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                            location. reload();
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
            deleteBookData(op_id) {
                this.id.push(op_id);
                console.log(this.id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteopus",{
                        params:{
                            op_id_datas:self.id
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                            location. reload();
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
            byTimeSearch(form) {
                axios.get("timeselectopus",{
                    params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    console.log(data.datas);
                    if (data.code == 0) {
                        self.BookDate = data.datas;
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
            this.getBookData();
        }
    }
</script>
