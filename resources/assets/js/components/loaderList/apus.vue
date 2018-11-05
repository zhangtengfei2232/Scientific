<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">著作（）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item>全部</el-dropdown-item>
                                    <el-dropdown-item>18年-今天</el-dropdown-item>
                                    <el-dropdown-item>17年-今天</el-dropdown-item>
                                    <el-dropdown-item>16年-今天</el-dropdown-item>
                                    <el-dropdown-item>15年-今天</el-dropdown-item>
                                    <el-dropdown-item>14年-今天</el-dropdown-item>
                                    <el-dropdown-item>
                                        <el-popover
                                            placement="top-start"
                                            width="400"
                                            trigger="click">
                                            <el-date-picker
                                                v-model="data1"
                                                type="daterange"
                                                range-separator="至"
                                                start-placeholder="开始日期"
                                                end-placeholder="结束日期">
                                            </el-date-picker>
                                            <div slot="reference">自定义时段<i class="el-icon-arrow-down el-icon--right"></i></div>
                                        </el-popover>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                                </el-dropdown>
                            </el-col>
                        </el-row>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                           <el-input
                                placeholder="请输入作者名"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">成员：作者<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入刊物级别"
                                prefix-icon="el-icon-search"
                                v-model="input">
                            </el-input>
                            <div slot="reference">学校认定刊物级别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">   
                                <el-form-item label="刊物级别">
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1">SCI一区</el-checkbox>
                                        <el-checkbox :label="2">SCI二区</el-checkbox>
                                        <el-checkbox :label="3">SCI三区</el-checkbox>
                                        <el-checkbox :label="4">SCI四区</el-checkbox>
                                        <el-checkbox :label="5">EI</el-checkbox>
                                        <el-checkbox :label="6">SSCI</el-checkbox>
                                        <el-checkbox :label="7">CN</el-checkbox>
                                        <el-checkbox :label="8">CSSCI核心库</el-checkbox>
                                        <el-checkbox :label="9">中文核心</el-checkbox>
                                        <el-checkbox :label="10">CSCD核心库</el-checkbox>
                                        <el-checkbox :label="11">河南科技学院期刊</el-checkbox>  
                                    </el-checkbox-group>
                                </el-form-item> 
                                <el-form-item label="研究类别">
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1" name="type">基础研究</el-checkbox>
                                        <el-checkbox :label="2" name="type">应用研究</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button>取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">高级筛选<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
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
            <el-pagination
                background
                layout="prev, pager, next"
                :total="1000">
            </el-pagination>
        </div>
    </div>
</template>

<style>
    .header{
        background: #f4f5f5;
    }
    .art{
        padding: 20px 10px;
        float: left;
        border-right: 1px #d4d8d7 solid;
    }
    .cont{
        width: 80%;
        float: left;
        margin: 20px;
    }
    .search{
        float: left;
        padding: 20px 20px;
        border-right: 1px #d4d8d7 solid;
    }
</style>

<script>
export default {
    data() {
        return {
            searchValue:'',
            border:true,
            allArticle:[],
            data1: '',
            input:'',
            form: {
                type:'',
                checkList: [],
            },
            
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
        onSubmit() {
            
        }
    },
    mounted() {
        this.getArticleData();
    }
}
</script>
