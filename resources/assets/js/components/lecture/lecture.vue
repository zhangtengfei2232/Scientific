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
                        <span class="demonstration">按专家姓名检索:</span>
                         <el-input v-model="form.le_expert_name" placeholder="请输入专家姓名" style="width:30%;"></el-input>
                        <el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch">搜索</el-button>
                    </div>
                </el-form>
            </span>
    </header>
        <!--<div class="navbo">-->
            <!--<span class="checks"><el-checkbox v-model="checked"></el-checkbox></span>-->
            <!--<span class="number">序号</span>-->
            <!--<span class="info">专家姓名</span>-->
            <!--<span class="time">讲学时间</span>-->
            <!--<span class="do">操作</span>-->
        <!--</div>-->
        <div class="content">
            <el-table
                    ref="multipleTable"
                    :data="ExperspeakDate"
                    tooltip-effect="dark"
                    style="width: 80%"
                    @selection-change="handleCheckedCitiesChange">
                <el-table-column
                        type="selection"
                        header-align="center"
                        align="center">
                </el-table-column>
                <el-table-column
                        label="专家姓名"
                        sortable
                        pror="le_expert_name"
                        header-align="center"
                        align="center">
                    <template slot-scope="scope">{{ scope.row.date }}</template>
                </el-table-column>
                <el-table-column
                        prop="le_time"
                        label="讲学时间"
                        header-align="center"
                        align="center"
                        sortable>
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作">
                    <template slot-scope="scope">
                        <el-button
                                @click.native.prevent="deleteRow(scope.$index, tableData4)"
                                type="text"
                                size="small">
                            移除
                        </el-button>
                    </template>
                </el-table-column>
                <!--<el-table-column-->
                        <!--label="操作"-->
                        <!--header-align="center"-->
                        <!--align="center">-->
                    <!--<template slot-scope="scope">-->
                        <!--<el-button size="mini" @click="sentExperspeakDate(item.pro_id)">编辑</el-button>-->
                        <!--<el-button size="mini" @click="sentExperspeakDate(item.pro_id)">查看</el-button>-->
                        <!--<el-button size="mini" type="danger" @click="deleteExperspeakDate(item.pro_id)">删除</el-button>-->
                    <!--</template>-->
                <!--</el-table-column>-->
            </el-table>

            <!--<div class="lists" v-for="(item,index) in ExperspeakDate" :key="index">-->
                <!--<span class="check"><el-checkbox v-model="checked"></el-checkbox></span>-->
                <!--<span class="numbers">{{ item.le_id }}</span>-->
                <!--&lt;!&ndash;<span class="picture"><img src="/dist/img/text.png" alt="文件加载失败"></span>&ndash;&gt;-->
                <!--<span class="infos">-->
                    <!--<h5>{{ item.le_expert_name }}</h5>-->
                    <!--&lt;!&ndash;<p>作者 <small>特别标注</small></p>&ndash;&gt;-->
                <!--</span>-->
                <!--<span class="times">2018-09-10</span>-->
                <!--<span class="dos" @click="sentExperspeakDate(item.art_id)">编辑</span>-->
                <!--<span class="tos"><router-link to="/">导出</router-link></span>-->
                <!--<span class="dos" @click="sentExperspeakDate(item.art_id)">查看</span>-->
                <!--<span class="del"><router-link to="/">删除</router-link></span>-->
                <!--<div class="clear"></div>-->
            <!--</div>-->

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
        margin: 15px 0 0 12%;
    }
    .demonstration{
        font-weight: lighter;
    }
    /*.navbo{*/
         /*border-bottom: 1px solid #eee;*/
         /*background: rgba(187, 187, 187, 0.1);*/
         /*height: 40px;*/
     /*}*/
    /*.info,.number,.do,.time{*/
        /*display: inline-block;*/
        /*padding: 10px;*/
        /*font-size: 14px;*/
    /*}*/
    /*.number{*/
        /*margin: 0 2% 0 3%;*/
    /*}*/
    /*.time{*/
        /*margin: 0 6% 0 45%;*/
    /*}*/
    /*.lists{*/
        /*border-bottom: 1px solid #eee;*/
        /*height: 80px;*/
    /*}*/
    /*.del,.times,.infos,.numbers,.dos,.tos{*/
        /*display: inline-block;*/
        /*padding: 10px;*/
        /*font-size: 14px;*/
    /*}*/
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
    .picture{
        margin: 20px 5px 0 1%;
    }
    /*.infos{*/
        /*margin: 19px 2% 0 0;*/
        /*padding-left: 32px;*/
    /*}*/
    /*.infos h5{*/
        /*font-size: 14px;*/
        /*font-weight: lighter;*/
    /*}*/
    /*.infos p{*/
        /*font-size: 13px;*/
        /*font-weight: lighter;*/
        /*margin: 8px 0 0 0;*/
    /*}*/
    /*.infos p small{*/
        /*color: orange;*/
        /*padding: 0 0 0 5px;*/
    /*}*/
    /*.times{*/
        /*margin: 22px 2% 0 40%;*/
    /*}*/
    /*.dos,.tos,.del{*/
        /*font-size: 13px;*/
        /*margin: 23px 0 0 0;*/
        /*color: rgba(61, 112, 206, 0.77)!important;*/
    /*}*/
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
                ExperspeakDate: [],
                checked: false,
                form: {
                    le_expert_name:'',
                    data1: '',
                    data2: '',
                },

            }
        },
        methods: {
            handleCheckAllChange(val) {
                this.checkedCities = val ? this.ExperspeakDate : [];
                this.isIndeterminate = false;
            },
            handleCheckedCitiesChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.ExperspeakDate.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.ExperspeakDate.length;
            },
            getExperspeakDate() {
                let self = this;
                axios.get("selectalllecture").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ExperspeakDate = data.datas;
                        console.log(data.datas);
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            sentExperspeakDate(art_id) {
                this.$router.push({
                    path: `/selfInfor/${art_id}`,
                })
            },
            deleteExperspeakDate(pro_id) {
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
            byTimeSearch() {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ExperspeakDate = data.datas;
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
            this.getExperspeakDate();
        }
    }
</script>