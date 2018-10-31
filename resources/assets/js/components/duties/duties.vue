<template>
    <div>
        <header>
            <span class="paper">
                担任学术团体职务
            </span>
            <span class="load">
                <router-link to="/addDuties">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
            <span class="searchtime">
                <el-form>
                    <div class="block">
                        <span class="demonstration">按老师姓名检索:</span>
                        <el-input v-model="form.teacher_name" placeholder="请输入老师姓名" style="width: 30%;"></el-input>
                        <el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch(form)">搜索</el-button>
                    </div>
                </el-form>
            </span>
        </header>
        <div class="table">
            <template>
                <el-table
                        ref="multipleTable"
                        :data="StudygroupDate"
                        tooltip-effect="dark"
                        style="width: 100%"
                        @selection-change="handleSelectionChange">
                    <el-table-column
                            type="selection"
                            width="55">
                    </el-table-column>
                    <el-table-column
                            prop="du_id"
                            label="序号"
                            sortable
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="teacher_name"
                            label="老师姓名"
                            width="120">
                    </el-table-column>
                    <el-table-column
                            prop="du_name"
                            label="担任学术团体名称"
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
                                <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentStudygroupDate(StudygroupDate[scope.$index].du_id)"></el-button>
                                <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentStudygroupDate(StudygroupDate[scope.$index].du_id)"></el-button>
                                <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteStudygroupDate(StudygroupDate[scope.$index].du_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([StudygroupDate[0], StudygroupDate[1],StudygroupDate[2]])">选中前三条</el-button>
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
        padding: 23px 48px;
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
        margin: 15px 0 0 12%;
    }
    .demonstration{
        font-weight: lighter;
    }.navbo{
         border-bottom: 1px solid #eee;
         background: rgba(187, 187, 187, 0.1);
         height: 40px;
     }
    .info,.number,.do,.time{
        display: inline-block;
        padding: 10px;
        font-size: 14px;
    }
    .number{
        margin: 0 2% 0 3%;
    }
    .time{
        margin: 0 6% 0 45%;
    }
    .lists{
        border-bottom: 1px solid #eee;
        height: 80px;
    }
    .del,.times,.infos,.numbers,.dos,.tos{
        display: inline-block;
        padding: 10px;
        font-size: 14px;
    }
    .lists span{
        float: left;
    }
    .lists img{
        width: 35px;
    }
    /*.numbers{*/
        /*margin: 20px 2% 0 3.5%;*/
    /*}*/
    /*.check{*/
        /*margin: 25px 2% 0 3%;*/
    /*}*/
    /*.checks{*/
        /*margin: 0 2% 0 3%;*/
    /*}*/
    /*.picture{*/
        /*margin: 20px 5px 0 1%;*/
    /*}*/
    /*.infos{*/
        /*margin: 10px 2% 0 0;*/
    /*}*/
    .infos h5{
        font-size: 14px;
        font-weight: lighter;
    }
    .infos p{
        font-size: 13px;
        font-weight: lighter;
        margin: 8px 0 0 0;
    }
    .infos p small{
        color: orange;
        padding: 0 0 0 5px;
    }
    .times{
        margin: 22px 2% 0 39%;
    }
    .dos,.tos,.del{
        font-size: 13px;
        margin: 23px 0 0 0;
        color: rgba(61, 112, 206, 0.77)!important;
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
    @media screen and (max-width: 1400px){
        .searchtime{
        width: 34%;
        }
    }
</style>
<script>
    export default {
        data() {
            return {
                id: [],
                dataForm: new FormData(),
                StudygroupDate: [],
                sortable:true,
                checked: false,
                form: {
                    teacher_name:'',
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
            BatchDelete(){
                var self = this;
                var du_id_datas = [];//存放删除的数据
                if(self.multipleSelection == undefined){
                    self.$message({
                        message: '请选择要删除论文',
                        type: 'warning'
                    });
                }else{
                    for (var i = 0; i < self.multipleSelection.length; i++) {
                        du_id_datas.push(self.multipleSelection[i].du_id);
                    };
                    this.deleteDutiesDatas(du_id_datas);
                }
            },

            getStudygroupDate() {
                let self = this;
                axios.get("selectallduties").then(function (response) {
                    var data = response.data;
//                    console.log(data.datas);
                    if (data.code == 0) {
                        self.StudygroupDate = data.datas;
//                        console.log(data.datas);
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            deleteDutiesDatas(du_id_datas) {
                console.log(du_id_datas,'批量删除啊@@@@@@@@!!');
                this.$confirm('此操作批量删除文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteduties",{
                        params:{
                            du_id_datas:du_id_datas
                        }
                    }).then(function (response) {
                        var data = response.data;
                        if (data.code == 0) {
                            self.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
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

            deleteStudygroupDate(du_id) {
                this.id.push(du_id);
//                this.id = du_id;
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("deleteduties",{
                        params:{
                            du_id_datas:this.id
                        }

                    }).then(function (response) {
                    var data = response.data;
                        if (data.code == 0) {
                            this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                        }else{
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
            sentStudygroupDate(du_id) {
                this.$router.push({
                    path: `/editDuties/${du_id}`,
                })
            },
            byTimeSearch() {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.StudygroupDate = data.datas;
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
            this.getStudygroupDate();
        }
    }
</script>