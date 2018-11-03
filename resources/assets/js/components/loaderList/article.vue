<template>
    <div>
        <div class="header">
            <el-header>
                <span class="art"></span>
            </el-header>
        </div>
        <div class="cont">
            <el-table
                :data="allArticle"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="author"
                    label="第一作者"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="art_all_author"
                    label="全部作者"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="title"
                    label="论文题目"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="art_time"
                    label="发表时间"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="publication_name"
                    label="发表刊物名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="publication_num"
                    label="刊号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="period"
                    label="年，卷，期"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="num_words"
                    label="字数"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="percal_cate"
                    label="期刊级别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="belong_project"
                    label="所属项目"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="art_cate_research"
                    label="研究类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="art_sub_category"
                    label="学科门类"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="art_integral"
                    label="积分"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="sch_percal_cate"
                    label="学校认定刊物级别"
                    width="140">
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<style>
    .cont{
        width: 80%;
        float: left;
        margin: 20px;
    }
</style>

<script>
export default {
    data() {
        return {
            border:true,
            allArticle:[],
        }
    },
    methods: {
        getArticleData() {
                let self = this;
                axios.get("").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.allArticle = data.datas;
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
