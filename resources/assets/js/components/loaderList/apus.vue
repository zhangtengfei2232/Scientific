<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">著作（{{ total }}）</div>
                    <div class="search">
                        <el-row>
                            <el-col :span="12">
                                <el-dropdown>
                                <span class="el-dropdown-link">
                                    时间：全部<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item>全部</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(8)">18年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(7)">17年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(6)">16年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(5)">15年-今天</el-dropdown-item>
                                    <el-dropdown-item @click="timeSearch(4)">14年-今天</el-dropdown-item>
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
                                placeholder="请输入第一作者"
                                prefix-icon="el-icon-search"
                                v-model="op_first_author" @keyup.enter.native="nameSearch()">
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
                                placeholder="请输入奖励名称"
                                prefix-icon="el-icon-search"
                                v-model="op_name" @keyup.enter.native="apNameSearch()">
                            </el-input>
                            <div slot="reference">奖励名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">
                                <el-form-item label="著作类别">
                                    <el-checkbox-group v-model="form.op_cate_work">
                                        <el-checkbox :label="0">专著</el-checkbox>
                                        <el-checkbox :label="1">教科书</el-checkbox>
                                        <el-checkbox :label="2">译注</el-checkbox>
                                        <el-checkbox :label="3">编著</el-checkbox>
                                        <el-checkbox :label="4">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item label="编著形式">
                                    <el-checkbox-group v-model="form.op_form_write">
                                        <el-checkbox :label="0" name="type">主编</el-checkbox>
                                        <el-checkbox :label="1" name="type">副主编</el-checkbox>
                                        <el-checkbox :label="2" name="type">参编</el-checkbox>
                                        <el-checkbox :label="3" name="type">编著</el-checkbox>
                                        <el-checkbox :label="4" name="type">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <el-form-item label="研究类别">
                                    <el-checkbox-group v-model="form.op_cate_research">
                                        <el-checkbox :label="0" name="type">基础研究</el-checkbox>
                                        <el-checkbox :label="1" name="type">应用研究</el-checkbox>
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
                :data="allOpus"
                style="width: 100%"
                border
                height="250"
                @selection-change="handleSelectionChange">
                <el-table-column
                    type="selection"
                    width="55">
                </el-table-column>
                <el-table-column
                    fixed
                    prop="op_first_author"
                    label="第一作者"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="op_all_author"
                    label="全部作者"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_name"
                    label="著作姓名"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_form_write"
                    label="编著形式"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_publish"
                    label="著作出版社"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_publish_time"
                    label="著作出版时间"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_number"
                    label="书号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_total_words"
                    label="著作总字数"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_self_words"
                    label="著作本人字数"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_cate_work"
                    label="著作类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_integral"
                    label="著作积分"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_cate_research"
                    label="著作研究类别"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="art_integral"
                    label="积分"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="op_sub_category"
                    label="著作学科门类"
                    width="140">
                </el-table-column>
            </el-table>
            <el-button @click="ExcelSelection()">导出Excel</el-button>
            <div class="page">
                <el-pagination
                    background
                    layout="prev, pager, next"
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
            border:true,
            allOpus:[],
            multipleSelection: [],
            data1: '',
            op_first_author:'',
            op_name:'',
            total:0,
            form: {
                op_cate_work: [],
                op_form_write: [],
                op_cate_research: [],
            },
            op_form_write: [
                '主编',
                '副主编',
                '参编',
                '编著',
                '其他',
            ],
            op_cate_research:[
                '基础研究',
                '应用研究'
            ],
            op_cate_work:[
                '专著',
                '教科书',
                '译著',
                '编著',
                '其他',
            ],
            op_sub_category:[
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
            ]
        }
    },
    methods: {
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        ExcelSelection() {
            var self = this;
            var art_id_datas = [];//存放导出的数据
            if(self.multipleSelection == ''){
                this.$message({
                    message: '请选择要导出著作',
                    type: 'warning'
                });
            }else{
                for (var i = 0; i < self.multipleSelection.length; i++) {
                    art_id_datas.push(self.multipleSelection[i].op_id);
                };
                this.ExcelArticleDatas(art_id_datas);
            }
        },
        ExcelArticleDatas(art_id_datas) {
            let self = this;
            let urls =  `exportopusexcel?op_id_datas=${art_id_datas}`;
            window.location.href = urls;
        },
        getOpusData() {
            let self = this;
            axios.get("leaderselecttallopus").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
            axios.get("bypublicationdateselectopus",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
            axios.get("bypublicationdateselectopus",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
            axios.get("byauthorselectopus",{
                params:{
                    op_first_author: self.op_first_author,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
        apNameSearch() {
            let self = this;
            axios.get("bynameselectopus",{
                params:{
                    op_name: self.op_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
            axios.get("combinationselectopus",{
                params:{
                    op_cate_work_datas: form.op_cate_work,
                    op_form_write_datas: form.op_form_write,
                    op_cate_research_datas: form.op_cate_research
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.op_form_write.length;i++){
                            if(data.datas[j].op_form_write == i){
                                data.datas[j].op_form_write = self.op_form_write[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_research.length;i++){
                            if(data.datas[j].op_cate_research == i){
                                data.datas[j].op_cate_research = self.op_cate_research[i];
                            }
                        }
                        for(var i= 0;i<self.op_cate_work.length;i++){
                            if(data.datas[j].op_cate_work == i){
                                data.datas[j].op_cate_work = self.op_cate_work[i];
                            }
                        }
                        for(var i= 0;i<self.op_sub_category.length;i++){
                            if(data.datas[j].op_sub_category == i){
                                data.datas[j].op_sub_category = self.op_sub_category[i];
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
        this.getOpusData();
    }
}
</script>
