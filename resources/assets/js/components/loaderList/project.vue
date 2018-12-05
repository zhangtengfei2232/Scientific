<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art" id="arts">项目（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    项目年份<i class="el-icon-arrow-down el-icon--right"></i>
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
                                placeholder="请输入主持人姓名"
                                prefix-icon="el-icon-search"
                                v-model="pro_host" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：主持人<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入项目类别"
                                prefix-icon="el-icon-search"
                                v-model="project_category" @keyup.enter.native="typeSearch()">
                            </el-input>
                            <div slot="reference">项目类别<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入批准单位"
                                prefix-icon="el-icon-search"
                                v-model="approval_unit" @keyup.enter.native="approveSearch()">
                            </el-input>
                            <div slot="reference">批准单位<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">
                                <el-form-item label="学科门类">
                                    <el-checkbox-group v-model="form.pro_sub_category">
                                        <el-checkbox :label="0">理学</el-checkbox>
                                        <el-checkbox :label="1">工学</el-checkbox>
                                        <el-checkbox :label="2">农学</el-checkbox>
                                        <el-checkbox :label="3">医学</el-checkbox>
                                        <el-checkbox :label="4">管理学</el-checkbox>
                                        <el-checkbox :label="5">马克思主义</el-checkbox>
                                        <el-checkbox :label="6">哲学</el-checkbox>
                                        <el-checkbox :label="7">逻辑学</el-checkbox>
                                        <el-checkbox :label="8">宗教学</el-checkbox>
                                        <el-checkbox :label="9">语言学</el-checkbox>
                                        <el-checkbox :label="10">中国文学</el-checkbox>
                                        <el-checkbox :label="11">外国文学</el-checkbox>
                                        <el-checkbox :label="12">艺术学</el-checkbox>
                                        <el-checkbox :label="13">历史学</el-checkbox>
                                        <el-checkbox :label="14">考古学</el-checkbox>
                                        <el-checkbox :label="15">经济学</el-checkbox>
                                        <el-checkbox :label="16">政治学</el-checkbox>
                                        <el-checkbox :label="17">法学</el-checkbox>
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
                :data="allProject"
                style="width: 100%"
                border
                @selection-change="handleSelectionChange">
                <el-table-column
                    type="selection"
                    width="55">
                </el-table-column>
                <el-table-column
                    fixed
                    prop="pro_host"
                    label="项目主持人"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="pro_all_author"
                    label="项目所有参加人员"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="entry_name"
                    label="项目名称"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="project_category"
                    label="项目类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="approval_unit"
                    label="批准单位"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="approval_funds"
                    label="批准经费"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="account_outlay"
                    label="当年到账经费"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_level"
                    label="项目级别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_cate_research"
                    label="研究类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_sub_category"
                    label="学科门类"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="form_cooperate"
                    label="合作形式"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="social_eco_goal"
                    label="社会经济目标"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="na_eco_industry"
                    label="服务的国民经济行业"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pro_integral"
                    label="积分"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="project_year"
                    label="项目年份"
                    width="120">
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        align="center">
                    <template slot-scope="scope">
                        <el-button type="success" icon="el-icon-download" size="mini" @click="uploadProjectData(allProject[scope.$index].pro_road)"></el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-button @click="PDFSelection()">导出PDF</el-button>
            <el-button @click="ExcelSelection()" style="margin-top: 20px;">导出Excel</el-button>
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
            pro_name:'',
            newTime:0,
            searchValue:'',
            border:true,
            allProject:[],
            multipleSelection: [],
            data1: '',
            pro_host:'',
            project_category:'',
            currentPage:1,
            approval_unit:'',
            form: {
                pro_sub_category:[],
            },
            pro_cate_research: [
                '基础研究',
                '实验与发展',
                '应用研究',
            ],
            pro_sub_category: [
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
            form_cooperate: [
                '与境外机构合作',
                '与国内高校合作',
                '与国内独立研究机构合作',
                '与境内注册外商独资企业合作',
                '与境内注册其他企业合作',
                '独立完成',
                '其他',
            ],
            pro_level:[
                '市厅级',
                '省部级',
                '国家级',
                '其他'
            ]
        }
    },
    methods: {
        uploadProjectData(pro_road) {
            let urls =  `downloadfile?file=project/${pro_road}`;
            window.open(urls, '_blank');
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
                    art_id_datas.push(self.multipleSelection[i].pro_id);
                };
                this.exportArticleDatas(art_id_datas);
            }
        },
        exportArticleDatas(art_id_datas) {
            let urls =  `exportprojectpdfs?pro_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        ExcelSelection() {
            var self = this;
            var art_id_datas = [];//存放导出的数据
            if(self.multipleSelection == ''){
                this.$message({
                    message: '请选择要导出项目',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].pro_id);
                };
                this.ExcelProjectDatas(art_id_datas);
            }
        },
        ExcelProjectDatas(art_id_datas) {
            let self = this;
            let urls =  `exportprojectexcel?pro_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getProjectData() {
            this.commonget(this.type);
        },
        commonget(){
            let self = this;
            axios.get("byfieldselectproject",{
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
                data[i].pro_cate_research = self.pro_cate_research[data[i].pro_cate_research];
                data[i].pro_sub_category = self.pro_sub_category[data[i].pro_sub_category];
                data[i].form_cooperate = self.form_cooperate[data[i].form_cooperate];
                data[i].pro_level = self.pro_level[data[i].pro_level];
            }
            self.allProject = data;
        },
        timeSearchget(){   //时间分页
            let self = this;
            self.types = 'time';
            axios.get("byfieldselectproject", {
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
            self.types = 'project_year';
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
            self.types = 'pro_host';
            self.values = self.pro_host;
            self.currentPages = 1;
            self.commonget();
        },
        typeSearch() {
            let self = this;
            self.types = 'project_category';
            self.values = self.project_category;
            self.currentPages = 1;
            self.commonget();
        },
        approveSearch() {
            let self = this;
            self.types = 'approval_unit';
            self.values = self.approval_unit;
            self.currentPages = 1;
            self.commonget();
        },

        groupchecks(){
            let self = this;
            axios.get("byfieldselectproject",{
                params:{
                    pro_sub_category_datas:self.values,
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
            self.types = 'pro_sub_category';
            self.values = form.pro_sub_category;
            self.currentPages = 1;
            self.groupchecks();
            document.querySelector("#arts").click();
        }
    },
    mounted() {
        this.getProjectData();
    },
    watch:{
        currentPages:function (currentPages) {
            this.currentPages = currentPages;
            switch(this.types) {
                case 'time':
                    this.timeSearchget();
                    break;
                case 'pro_sub_category':
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
