<template>
    <div>
        <header>
            <span class="paper">
                论文
            </span>
            <span class="load">
                <router-link to="/addPaper">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
        </header>
        <div class="navbo">
            <span class="number">序号</span>   
            <span class="info">论文信息</span>
            <span class="time">发表时间</span>
            <span class="do">操作</span>
        </div>
        <div class="content">
            <div class="lists">
                <span class="numbers">1</span>
                <span class="picture"><img src="/dist/img/text.png" alt="文件加载失败"></span>
                <span class="infos">
                    <h5>示例：论文题目</h5>
                    <p>作者 <small>特别标注</small></p>
                </span>
                <span class="times">2018-09-10</span>
                <span class="dos"><router-link>编辑</router-link></span>
                <span class="tos"><router-link>导出</router-link></span>
                <span class="del"><router-link>删除</router-link></span>
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
        margin: 22px 3% 0 37.5%;
    }
    .dos,.tos,.del{
        font-size: 13px;
        margin: 23px 0 0 0;
    }
    .dos,.tos{
        color: rgba(61, 112, 206, 0.77);
    }
    .del{
        color: rgba(229, 28, 35, 1);
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
                ArticleDate: {},
            }
        },
        methods: {
            getArticleData() {
                let self = this;
                axios.get("selectallarticalDatas").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ArticleDate = data.datas;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            }
        },
        mounted() {
            this.getArticleData();
        }
    }
</script>