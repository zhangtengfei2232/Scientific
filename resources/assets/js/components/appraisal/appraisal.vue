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
                        placeholder="选择日期">
                        </el-date-picker>
                        <span>-</span>
                        <el-date-picker
                        v-model="form.data2"
                        type="date"
                        placeholder="选择日期">
                        </el-date-picker>
                        <span><el-button type="primary" style="margin-left:10px" v-on:click="byTimeSearch">搜索</el-button></span>
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
                    prop="ap_id"
                    label="序号"
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
                        width="200">
                        <template slot-scope="scope">
                            <el-button
                            @click.native.prevent="deleteRow(scope.$index, AppraisalDate)"
                            type="text"
                            size="small">
                            <el-button type="primary" icon="el-icon-edit" size="mini" @click="sentAppraisalSelfData(ap_id)"></el-button>
                            <el-button type="warning" icon="el-icon-zoom-in" size="mini" @click="sentAppraisalSelfData(ap_id)"></el-button>
                            <el-button type="danger" icon="el-icon-delete" size="mini" @click="deleteArticleData(ap_id)"></el-button>
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="toggleSelection([AppraisalDate[1], AppraisalDate[2]])">切换第二、第三行的选中状态</el-button>
                    <el-button @click="toggleSelection()">取消选择</el-button>
                </div>
            </template>
        </div>


        <!-- <div class="navbo">
            <span class="checks"><el-checkbox v-model="checked"></el-checkbox></span>
            <span class="number">序号</span>   
            <span class="info">成果鉴定信息</span>
            <span class="time">发表时间</span>
            <span class="do">操作</span>
        </div>
        <div class="content">
            <div class="lists" v-for="(item,index) in AppraisalDate" :key="index">
                <span class="check"><el-checkbox v-model="checked"></el-checkbox></span>
                <span class="numbers">{{ item.ap_id }}</span>
                <span class="picture"><img src="/dist/img/cgjd.png" alt="文件加载失败"></span>
                <span class="infos">
                    <h5>{{ item.title }}</h5>
                    <p>作者 <small>特别标注</small></p>
                </span>
                <span class="times">2018-09-10</span>
                <span class="dos" @click="sentAppraisalSelfData(item.art_id)">编辑</span>
                <span class="tos"><router-link to="/">导出</router-link></span>
                <span class="dos" @click="sentAppraisalSelfData(item.art_id)">查看</span>
                <span class="del"><router-link to="/">删除</router-link></span>
                <div class="clear"></div>
            </div>
        </div> -->
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
         margin: 15px 0 0 9%;
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
                AppraisalDate: [],
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
            getAppraisalDate() {
                let self = this;
                axios.get("selectallappraisal").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AppraisalDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            sentAppraisalSelfData(art_id) {
                this.$router.push({
                path: `/selfInfor/${art_id}`,
                })
            },
            byTimeSearch() {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AppraisalDate = data.datas;
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
            this.getAppraisalDate();
        }
    }
</script>