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
                                placeholder="请输入第一发明人"
                                prefix-icon="el-icon-search"
                                v-model="first_inventor" @keyup.enter.native="nameSearch()">
                            </el-input>
                            <div slot="reference">检索：发明人<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="click">
                            <el-input
                                placeholder="请输入专利名称"
                                prefix-icon="el-icon-search"
                                v-model="pa_name" @keyup.enter.native="paNameSearch()">
                            </el-input>
                            <div slot="reference">专利名称<i class="el-icon-arrow-down el-icon--right"></i></div>
                        </el-popover>
                    </div>
                    <div class="search">
                        <el-popover
                            placement="top-start"
                            width="500"
                            trigger="click">
                            <el-form ref="form" :model="form" label-width="80px">   
                                <el-form-item label="刊物级别">
                                    <el-checkbox-group v-model="form.pa_type">
                                        <el-checkbox :label="0">发明专利</el-checkbox>
                                        <el-checkbox :label="1">实用新型专利</el-checkbox>
                                        <el-checkbox :label="2">外观设计专利</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item> 
                                <el-form-item label="研究类别">
                                    <el-checkbox-group v-model="form.pa_imple_situ">
                                        <el-checkbox :label="0" name="type">授权</el-checkbox>
                                        <el-checkbox :label="1" name="type">受理</el-checkbox>
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
            allPatent:[],
            data1: '',
            first_inventor:'',
            pa_name:'',
            total:0,
            form: {
                pa_type:[],
                pa_imple_situ: [],
            },
            pa_type:[
                '发明专利',
                '实用新型专利',
                '外观设计专利',
            ],
            pa_imple_situ:[
                '授权',
                '受理',
            ],
        }
    },
    methods: {
        getPatentData() {
            let self = this;
            axios.get("leaderselectallpatent").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
                    self.total = data.datas.length;
                    for(var j=0;j<data.datas.length;j++){
                        for(var i= 0;i<self.pa_type.length;i++){
                            if(data.datas[j].pa_type == i){  
                                data.datas[j].pa_type = self.pa_type[i];
                            }
                        }
                        for(var i= 0;i<self.pa_imple_situ.length;i++){
                            if(data.datas[j].pa_imple_situ == i){  
                                data.datas[j].pa_imple_situ = self.pa_imple_situ[i];
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
        paNameSearch() {
            let self = this;
            axios.get("bynameselectpatent",{
                params:{
                    first_inventor: self.first_inventor,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
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
            axios.get("byfirstinventorselectpatent",{
                params:{
                    pa_name: self.pa_name,
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
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
            axios.get("byadmissibilitydayselectpatent",{
                params:{
                    start_time:newTime,
                    end_time:timestamp
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
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
            axios.get("byadmissibilitydayselectpatent",{
                params:{
                    start_time:self.data1[0],
                    end_time:self.data1[1],
                }
            }).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.allPatent = data.datas;
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
