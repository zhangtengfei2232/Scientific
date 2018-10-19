<template>
    <div>
        <header>
            <span class="paper">
                项目
            </span>
            <span class="load">
                <router-link to="/addProject">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
            <span class="searchtimes">
                <el-form>
                    <div class="blocks">
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
        <div class="navbo">
            <span class="checks"><el-checkbox v-model="checked"></el-checkbox></span>
            <span class="number">序号</span>   
            <span class="info">论文信息</span>
            <span class="time">发表时间</span>
            <span class="do">操作</span>
        </div>
        <div class="content">
            <el-checkbox-group v-model="checkAll" @change="handleCheckedCitiesChange"> 
                <div class="lists" v-for="(item,index) in ProjectDate" :key="index">
                    <span class="check"><el-checkbox v-model="checked"></el-checkbox></span>
                    <span class="numbers">{{ item.teacher_id }}</span>
                    <span class="picture"><img src="/dist/img/text.png" alt="文件加载失败"></span>
                    <span class="infos">
                        <h5>{{ item.title }}</h5>
                        <p>作者 <small>特别标注</small></p>
                    </span>
                    <span class="times">2018-09-10</span>
                    <span class="dos" @click="sentProjectSelfData(item.pro_id)">编辑</span>
                    <span class="tos"><router-link to="/">导出</router-link></span>
                    <span class="dos" @click="sentProjectSelfData(item.pro_id)">查看</span>
                    <span class="del" @click="deleteProjectData(item.pro_id)">删除</span>
                    <div class="clear"></div>
                </div>
            </el-checkbox-group>
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
    .searchtimes{
         width: 45%;
         display: inline-block;
         margin: 15px 0 0 18%;
    }
    .demonstration{
        font-weight: lighter;
    }
    .navbo{
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
    .numbers{
        margin: 20px 2% 0 3.5%;
    }
    .check{
        margin: 25px 2% 0 3%;
    }
    .checks{
        margin: 0 2% 0 3%;
    }
    .picture{
        margin: 20px 5px 0 1%;
    }
    .infos{
        margin: 10px 2% 0 0;
    }
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
</style>
<script>
    export default {
        data() {
            return {
                ProjectDate: [],
                checked: false,
                form: {
                    data1: '',
                    data2: '',
                },
            }
        },
        methods: {
            handleCheckAllChange(val) {
                this.checkedCities = val ? this.ProjectDate : [];
                this.isIndeterminate = false;
            },
             handleCheckedCitiesChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.ProjectDate.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.ProjectDate.length;
            },
            getProjectData() {
                let self = this;
                axios.get("selectproject").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ProjectDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            deleteProjectData(pro_id) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let self = this;
                    axios.get("",pro_id).then(function (response) {
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
                let self = this;
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ProjectDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,         
                        });
                    }
                });
            },
            sentProjectSelfData(pro_id) {
                this.$router.push({
                    path: `/selfProject/${pro_id}`,
                })
            }

        },
        mounted() {
            this.getProjectData();
        }
    }
</script>