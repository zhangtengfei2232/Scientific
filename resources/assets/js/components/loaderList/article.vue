<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art" id="arts">论文（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item>全部</el-dropdown-item>
                                    <el-dropdown-item @click.native="timeSearch(8)">18年-今天</el-dropdown-item>
                                    <el-dropdown-item @click.native="timeSearch(7)">17年-今天</el-dropdown-item>
                                    <el-dropdown-item @click.native="timeSearch(6)">16年-今天</el-dropdown-item>
                                    <el-dropdown-item @click.native="timeSearch(5)">15年-今天</el-dropdown-item>
                                    <el-dropdown-item @click.native="timeSearch(4)">14年-今天</el-dropdown-item>
                                    <el-dropdown-item>
                                        <el-popover
                                            placement="top-start"
                                            width="400"
                                            trigger="click"
                                            style="width:450px !important">
                                            <span style="float:left;width: 87%;">
                                                <el-date-picker
                                                    v-model="data1"
                                                    type="daterange"
                                                    range-separator="至"
                                                    start-placeholder="开始日期"
                                                    end-placeholder="结束日期"
                                                    value-format="timestamp">
                                                </el-date-picker>
                                            </span>
                                            <span style="float:left"><el-button type="primary" icon="el-icon-search" @click="twoTimeSearch()" style="width:25px;margin: 0 5px;"></el-button></span>
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
                                v-model="art_name" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：作者<i class="el-icon-arrow-down el-icon--right"></i></div>
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
                                v-model="art_rank" @keyup.enter.native="rankSearch()">
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
                                    <el-checkbox-group :indeterminate="isIndeterminate" v-model="form.percal_cate">
                                        <el-checkbox :label="0">SCI一区</el-checkbox>
                                        <el-checkbox :label="1">SCI二区</el-checkbox>
                                        <el-checkbox :label="2">SCI三区</el-checkbox>
                                        <el-checkbox :label="3">SCI四区</el-checkbox>
                                        <el-checkbox :label="4">EI</el-checkbox>
                                        <el-checkbox :label="5">SSCI</el-checkbox>
                                        <el-checkbox :label="6">CN</el-checkbox>
                                        <el-checkbox :label="7">CSSCI核心库</el-checkbox>
                                        <el-checkbox :label="8">中文核心</el-checkbox>
                                        <el-checkbox :label="9">CSCD核心库</el-checkbox>
                                        <el-checkbox :label="10">河南科技学院期刊</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item label="研究类别">
                                    <el-checkbox-group v-model="form.art_cate_research">
                                        <el-checkbox :label="0" name="type">基础研究</el-checkbox>
                                        <el-checkbox :label="1" name="type">应用研究</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="onSubmit(form)">确定</el-button>
                                    <el-button @click="remove()">取消</el-button>
                                </el-form-item>
                            </el-form>
                            <div slot="reference">高级筛选<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                </el-header>
            </div>
            <el-table
                :data="allArticle"
                stripe
                style="width: 100%"
                border
                @selection-change="handleSelectionChange">
                <el-table-column
                type="selection"
                width="55">
                </el-table-column>
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
            <div style="margin-top: 20px">
                <el-button @click="PDFSelection()">导出PDF</el-button>
                <el-button @click="ExcelSelection()">导出Excel</el-button>
            </div>
            <div class="page">
                <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="pagesize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
                </el-pagination>
            </div>
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
        width: 85%;
        float: left;
        margin: 20px;
    }
    .search{
        float: left;
        padding: 20px 20px;
        border-right: 1px #d4d8d7 solid;
    }
    .page{
        width: 30%;
        margin: 0 auto;
    }
</style>

<script>
export default {
    data() {
        return {
            searchValue:'',
            art_rank: '',
            border:true,
            allArticle:[],
            currentPage:1,
            pagesize:10,
            data1: '',
            art_name:'',
            total: 0,
            newTime: 0,
            type: '',
            isIndeterminate: true,
            multipleSelection: [],
            form:{
                art_cate_research: [],
                percal_cate:[]
            },
            percal_cate:[
                'SCI一区',
                'SCI二区',
                'SCI三区',
                'SCI四区',
                'EI',
                'SSCI',
                'CN',
                'CSSCI核心库',
                '中文核心',
                'CSCD核心库',
                '河南科技学院期刊',
            ],
            art_cate_research:[
                '基础研究',
                '应用研究'
            ],
            art_sub_category:[
                '理学',
                '工学',
                '农学',
                '医学',
                '管理学',
                '马克思主义',
                '哲学',
                '逻辑学',
                '宗教学',
                '语言学' ,
                '中国文学',
                '外国文学',
                '艺术学',
                '历史学',
                '考古学',
                '经济学',
                '政治学',
                '法学',
            ],
        }
    },
    methods: {
        remove() {
            document.querySelector("#arts").click();
        },
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function(currentPage){
            this.currentPage = currentPage;
            switch(type) {
                case author:
                    this.nameSearch();
                    break;
                case art_time1:
                    this.timeSearch();
                    break;
                case art_time2:
                    this.twoTimeSearch();
                    break;
                case sch_percal_cate:
                    this.rankSearch();
                    break;
                case combine:
                    this.onSubmit();
                    break;
                default:
                    this.$message.error('暂无此查询');
                    break;
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
                    message: '请选择要导出论文',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].art_id);
                };
                console.log(art_id_datas);
                this.ExcelArticleDatas(art_id_datas);
            }
        },
        ExcelArticleDatas(art_id_datas) {
            let self = this;
            let urls =  `exportarticalexcel?art_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        PDFSelection() {
            var self = this;
            var art_id_datas = [];//存放导出的数据
            if(self.multipleSelection == ''){
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
        getArticleData() {
            let self = this;
            axios.get("leaderselectallartical").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        timeSearch(time) {
            this.type = 'art_time1';
            if(time == 8) {
                this.newTime = '1514779200';
            }else if(time == 7) {
                this.newTime = '1483243200';
            }else if(time == 6) {
                this.newTime = '1451620800';
            }else if(time == 5) {
                this.newTime = '1420084800';
            }else if(time == 4) {
                this.newTime = '1388548800';
            }
            var timestamp = Date.parse(new Date());
            let self = this;
            axios.get("byperiodicalselectartical",{
                params:{
                    page: self.currentPage,
                    total: self.pagesize,
                    type: 'art_time',
                    start_time:this.newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        twoTimeSearch() {
           let self = this;
           self.type = 'art_time2';
            axios.get("byperiodicalselectartical",{
                params:{
                    page: self.currentPage,
                    total: self.pagesize,
                    type: 'art_time',
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        nameSearch() {
            let self = this;
            self.type = 'author';
            axios.get("byauthorselectartical",{
                params:{
                    page: self.currentPage,
                    total: self.pagesize,
                    type: 'author',
                    value: self.art_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        rankSearch() {
            let self = this;
            self.type = 'sch_percal_cate';
            axios.get("byschoolaffirmlevelselectartical",{
                params:{
                    page: self.currentPage,
                    total: self.pagesize,
                    type: 'art_time',
                    value: self.art_rank,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        onSubmit(form) {
            let self = this;
            self.type = 'combine';
            axios.get("combinationselectartical",{
                params:{
                    page: self.currentPage,
                    total: self.pagesize,
                    percal_cate_datas: form.percal_cate,
                    art_cate_research_datas: form.art_cate_research,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allArticle = data.datas;
                    document.querySelector("#arts").click();
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.percal_cate.length;i++){
                            if(data.datas[j].percal_cate == i){
                                data.datas[j].percal_cate = self.percal_cate[i];
                            }
                        }
                        for(var i= 0;i<self.art_sub_category.length;i++){
                            if(data.datas[j].art_sub_category == i){
                                data.datas[j].art_sub_category = self.art_sub_category[i];
                            }
                        }
                        for(var i= 0;i<self.art_cate_research.length;i++){
                            if(data.datas[j].art_cate_research == i){
                                data.datas[j].art_cate_research = self.art_cate_research[i];
                            }
                        }
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
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
