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
                                placeholder="请输入第一作者"
                                prefix-icon="el-icon-search"
                                v-model="input">
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
                                v-model="input">
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
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1">专著</el-checkbox>
                                        <el-checkbox :label="2">教科书</el-checkbox>
                                        <el-checkbox :label="3">译注</el-checkbox>
                                        <el-checkbox :label="4">编著</el-checkbox>
                                        <el-checkbox :label="5">其他</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item> 
                                <el-form-item label="编著形式">
                                    <el-checkbox-group v-model="form.checkList">
                                        <el-checkbox :label="1" name="type">主编</el-checkbox>
                                        <el-checkbox :label="2" name="type">副主编</el-checkbox>
                                        <el-checkbox :label="3" name="type">参编</el-checkbox>
                                        <el-checkbox :label="4" name="type">编著</el-checkbox>
                                        <el-checkbox :label="5" name="type">其他</el-checkbox>
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
                :data="allOpus"
                style="width: 100%"
                border
                height="250">
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
            <el-pagination
                background
                layout="prev, pager, next"
                :total="100">
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
            allOpus:[],
            data1: '',
            input:'',
            form: {
                type:'',
                checkList: [],
            },
            
        }
    },
    methods: {
        getOpusData() {
            let self = this;
            axios.get("").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allOpus = data.datas;
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
        this.getOpusData();
    }
}
</script>
