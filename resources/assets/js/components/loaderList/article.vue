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
                                    发表时间<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
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
                                v-model="author" @keyup.enter.native="nameSearch()">
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
                                v-model="sch_percal_cate" @keyup.enter.native="rankSearch()">
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
                <el-table-column
                        fixed="right"
                        label="操作"
                        align="center">
                    <template slot-scope="scope">
                        <el-button type="success" icon="el-icon-download" size="mini" @click="uploadArticleData(allArticle[scope.$index].art_road)"></el-button>
                    </template>
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
                    :current-page="currentPages"
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
        width:95%;
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
            types:'',
            currentPages:1,
            pagesize:10,
            start_time:0,
            end_time:0,
            values:'',
            total:0,
            searchValue:'',
            art_rank: '',
            border:true,
            allArticle:[],
            currentPage:1,
            data1: '',
            art_name:'',
            newTime: 0,
            type: '',
            isIndeterminate: true,
            multipleSelection: [],
            sch_percal_cate: '',
            percal:'',
            art_cate:'',
            author:'',
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
        uploadArticleData(art_road) {
            let urls =  `downloadfile?file=artical/${art_road}`;
            window.location.href = urls;
        },
        remove() {
            document.querySelector("#arts").click();
        },
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        handleSizeChange(val) {
            this.pagesize = val;
            this.commonget(this.types,this.values);
        },
        handleCurrentChange(val) {
            this.currentPages=val;
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
            let urls =  `exportarticalpdfs?art_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getArticleData() {
            this.commonget(this.type);
        },
        commonget(){
            let self = this;
            axios.get("byfieldselectartical",{
                params:{
                    value:self.values,
                    type: self.types,
                    page:self.currentPages,
                    total:self.pagesize,
                }
            }).then(function (response) {
                self.total = response.data.datas.total;
                self.commonchange(response.data.datas.data);

            })
        },
        commonchange(data){
            let self = this;
            for(var i=0;i<data.length;i++){
                data[i].percal_cate = self.percal_cate[data[i].percal_cate];
                data[i].art_sub_category = self.art_sub_category[data[i].art_sub_category];
                data[i].art_cate_research = self.art_cate_research[data[i].art_cate_research];
            }
            self.allArticle = data;
        },
        timeSearchget(){   //时间分页
            let self = this;
            self.types = 'time';
            axios.get("byfieldselectartical", {
                params: {
                    start_time:self.start_time,
                    end_time:self.end_time,
                    type: self.types,
                    page: self.currentPages,
                    total: self.pagesize,
                }
            }).then(function (response) {
                self.total = response.data.datas.total;
                self.commonchange(response.data.datas.data);
            });
        },
        timeSearch(time) {
            if(time == 8) {
                this.start_time = '1514779200000';
            }else if(time == 7) {
                this.start_time = '1483243200000';
            }else if(time == 6) {
                this.start_time = '1451620800000';
            }else if(time == 5) {
                this.start_time = '1420084800000';
            }else if(time == 4) {
                this.start_time = '1388548800000';
            }
            this.end_time = Date.parse(new Date());
            let self = this;
            self.types = 'art_time';
            self.currentPages = 1;
            self.timeSearchget();
        },
        twoTimeSearch() {
            let self = this;
            self.types = 'time';
            self.start_time = self.data1[0];
            self.end_time   = self.data1[1];
            self.currentPages = 1;
            self.timeSearchget();
        },
        nameSearch() {
            let self = this;
            self.types = 'author';
            self.values = self.author;
            self.currentPages = 1;
            self.commonget();
        },
        rankSearch() {
            let self = this;
            self.types = 'sch_percal_cate';
            self.values = self.sch_percal_cate;
            self.currentPages = 1;
            self.commonget();
        },
        groupchecks(){
            let self = this;
            axios.get("byfieldselectartical",{
                params:{
                    art_percal_cate_datas:self.percal,
                    art_cate_research_datas:self.art_cate,
                    type: self.types,
                    page:self.currentPages,
                    total:self.pagesize,
                }
            }).then(function (response) {
                self.total = response.data.datas.total;
                self.commonchange(response.data.datas.data);

            })
        },
        onSubmit(form) {
            let self = this;
            self.types = 'composite_query';
            self.percal = form.percal_cate;
            self.art_cate = form.art_cate_research;
            self.currentPages = 1;
            self.groupchecks();
            document.querySelector("#arts").click();
        },
    },
    mounted() {
        this.getArticleData();
    },
    watch:{
        currentPages:function (currentPages) {
            this.currentPages = currentPages;
            switch(this.types) {
                case 'time':
                    this.timeSearchget();
                    break;
                case 'composite_query':
                    this.groupchecks();
                    break;
                default:
                    this.commonget();
                    break;
            }
        }
    },
}
</script>
