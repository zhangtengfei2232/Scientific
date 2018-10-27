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
        <div class="navbo">
            <span class="checks"><el-checkbox v-model="checked"></el-checkbox></span>
            <span class="number">序号</span>
            <span class="info">文件名称</span>
            <span class="time">文件下发时间</span>
            <span class="do">操作</span>
        </div>
        <div class="content">
            <div class="lists" v-for="(item,index) in shooolFileDate" :key="index">
                <span class="check"><el-checkbox v-model="checked"></el-checkbox></span>
                <span class="numbers">{{ item.teacher_id }}</span>
                <span class="picture"><img src="/dist/img/cjhy.png" alt="文件加载失败"></span>
                <span class="infos">
                    <h5>{{ item.title }}</h5>
                    <p>作者 <small>特别标注</small></p>
                </span>
                <span class="times">2018-09-10</span>
                <span class="dos" @click="sentshooolFileDate(item.art_id)">编辑</span>
                <span class="tos"><router-link to="/">导出</router-link></span>
                <span class="dos" @click="sentshooolFileDate(item.art_id)">查看</span>
                <span class="del"><router-link to="/">删除</router-link></span>
                <div class="clear"></div>
            </div>
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
        margin: 15px 0 0 9%;
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
                shooolFileDate: [],
                checked: false,
                form: {
                    data1: '',
                    data2: '',
                },
            }
        },
        methods: {
            getshooolFileDate() {
                let self = this;
                axios.get("selectallschoolfile").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.shooolFileDate = data.datas;
                        constant.log("---------------")
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            sentshooolFileDate(art_id) {
                this.$router.push({
                    path: `/selfInfor/${art_id}`,
                })
            },
            byTimeSearch() {
                axios.get("",form).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.shooolFileDate = data.datas;
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
            this.getshooolFileDate();
        }
    }
</script>