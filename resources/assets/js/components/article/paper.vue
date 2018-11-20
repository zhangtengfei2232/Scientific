<template>
    <div class="all">
        <header>
            <span class="paper">
                论文
            </span>
            <span class="load">
                <router-link to="/addPaper">
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
                    :data="ArticleDate"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                    <el-table-column
                    type="selection"
                    width="55">
                    </el-table-column>
                    <el-table-column
                    prop="art_id"
                    sortable
                    label="序号"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="title"
                    label="论文名称"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    prop="art_time"
                    label="发表日期"
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
                                <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentArticleSelfData(ArticleDate[scope.$index].art_id)"></el-button>
                                <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentArticleSelfData(ArticleDate[scope.$index].art_id)"></el-button>
                                <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteArticleData(ArticleDate[scope.$index].art_id)"></el-button>
                                <el-button type="success" icon="el-icon-download" size="mini" @click="uploadArticleData(ArticleDate[scope.$index].art_road)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([ArticleDate[0], ArticleDate[1],ArticleDate[2]])">选中前三条</el-button>
                    <el-button @click="toggleSelection()">取消选择</el-button>
                    <el-button @click="BatchDelete()">删除</el-button>
                    <el-button @click="BatchExport()">导出PDF</el-button>
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
         width: 45%;
         display: inline-block;
         margin: 15px 0 0 7%;
    }
    .demonstration{
        font-weight: lighter;
    }
</style>
<script>
    export default {
        data() {
            return {
                id: [],
                multipleSelection: [],
                sortable:true,
                ArticleDate: [],
                checked: false,
                checkAll: false,
                isIndeterminate: true,
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
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要导出论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].art_id);
                    };
                    this.ExcelArticleDatas(art_id_datas);
                }
            },
            ExcelArticleDatas(art_id_datas) {
                let urls =  `exportarticalexcel?art_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            uploadArticleData(art_road) {
                let urls =  `downloadfile?file=artical/${art_road}`;
                window.location.href = urls;
            },
            getArticleData() {
                let self = this;
                axios.get("selectallattical").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ArticleDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            sentArticleSelfData(art_id) {
                this.$router.push({
                    path: `/selfInfor/${art_id}`,
                })
            },
            BatchExport() {
                var self = this;
                var art_id_datas = [];//存放导出的数据
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要导出论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].art_id);
                    };
                    this.exportArticleDatas(art_id_datas);
                }
            },
            exportArticleDatas(art_id_datas) {
                let urls =  `exportallartical?art_id_datas=${art_id_datas}`;
                window.location.href = urls;
            },
            BatchDelete(){
		    	var self = this;
                var art_id_datas = [];//存放删除的数据
                if(self.multipleSelection == undefined){
                    this.$message({
                        message: '请选择要删除论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        art_id_datas.push(self.multipleSelection[i].art_id);
                    };
                    this.deleteArticleDatas(art_id_datas);
                }
            },
            deleteArticleDatas(art_id_datas) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteartical",{
                         params:{
                            artical_id:art_id_datas
                        }
                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                             self.$message({
                                showClose: true,
                                message: '删除成功!',
                                type: 'success'
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
            deleteArticleData(art_id) {
                this.id.push(art_id);
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteartical",{
                         params:{
                            artical_id:self.id
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
                let self = this;
                axios.get("timeselectattical",{
                     params:{
                        start_time: form.data1,
                        end_time: form.data2,
                    }
                }).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ArticleDate = data.datas;
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
            this.getArticleData();
        }
    }
</script>
