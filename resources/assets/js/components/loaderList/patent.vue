<template>
    <div>
        <div class="cont">
            <div class="header">
                <el-header>
                    <div class="art">专利（{{ total }}）</div>
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
                :data="allPatent"
                style="width: 100%"
                border
                height="250">
                <el-table-column
                    fixed
                    prop="patent_person"
                    label="专利权人"
                    width="150">
                </el-table-column>
                <el-table-column
                    prop="first_inventor"
                    label="第一发明人"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pa_all_author"
                    label="全部发明人"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pa_type"
                    label="专利类型"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pa_name"
                    label="专利名字"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pa_imple_situ"
                    label="实施情况"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="author_num"
                    label="授权编号或者申请号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="author_cert_num"
                    label="授权证书编号"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="author_notic_day"
                    label="授权公告日或受理日期"
                    width="120">
                </el-table-column>
                <el-table-column
                    prop="pa_integral"
                    label="积分"
                    width="120">
                </el-table-column>
            </el-table>
            <div class="page">
                <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="100">
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
            allPatent:[],
            data1: '',
            input:'',
            total:'',
            form: {
                type:'',
                checkList: [],
            },
            
        }
    },
    methods: {
        getPatentData() {
            let self = this;
            axios.get("leaderselectallpatent").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
                    console.log(data.datas);
                    self.total = data.datas.length;
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
        this.getPatentData();
    }
}
</script>
