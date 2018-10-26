<template>
    <div class="content1">
        <header>
            <div class="paper">
                 论文(66)
            </div>

                <el-input class="search" v-model="form.name" placeholder="搜索结果"
                          prefix-icon="el-icon-search"></el-input>

            <el-dropdown class="paper">
                <span class="el-dropdown-link">
                    时间：全部<i class="el-icon-caret-bottom"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>黄金糕就看不上</el-dropdown-item>
                    <el-dropdown-item>狮子头</el-dropdown-item>
                    <el-dropdown-item>螺蛳粉</el-dropdown-item>
                    <el-dropdown-item>双皮奶</el-dropdown-item>
                    <el-dropdown-item>蚵仔煎</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

            <el-dropdown trigger="click"class="paper">
                <span class="el-dropdown-link">
                    成员：全部<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>黄金糕</el-dropdown-item>
                    <el-dropdown-item>狮子头</el-dropdown-item>
                    <el-dropdown-item>螺蛳粉</el-dropdown-item>
                    <el-dropdown-item>双皮奶</el-dropdown-item>
                    <el-dropdown-item>蚵仔煎</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

            <el-dropdown trigger="click"class="paper">
                <span class="el-dropdown-link">
                    高级筛选<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>黄金糕</el-dropdown-item>
                    <el-dropdown-item>狮子头</el-dropdown-item>
                    <el-dropdown-item>螺蛳粉</el-dropdown-item>
                    <el-dropdown-item>双皮奶</el-dropdown-item>
                    <el-dropdown-item>蚵仔煎</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

            <div class="pull-right">
                <el-button>默认按钮</el-button>
                <el-button>默认按钮</el-button>
                <el-button style="background-color: #007D71;color: white">导出PDF</el-button>
            </div>

        </header>

        <!--<div class="navbo">-->
            <!--<span class="checks"><el-checkbox v-model="checked"></el-checkbox></span>-->
            <!--<span class="number">序号</span>-->
            <!--<span class="info">协议名称</span>-->
            <!--<span class="time">合作时间</span>-->
            <!--<span class="do">操作</span>-->
        <!--</div>-->
        <el-table
                :data="tableData"
                border
                style="width:88%">
            <el-table-column
                    fixed
                    prop="date"
                    label="日期"
                    width="110">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="province"
                    label="省份"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="province"
                    label="省份"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="province"
                    label="省份"
                    width="120">
            </el-table-column> <el-table-column
                prop="province"
                label="省份"
                width="120">
        </el-table-column>


            <el-table-column
                    prop="city"
                    label="市区"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="address"
                    label="地址"
                    width="300">
            </el-table-column>
            <el-table-column
                    prop="zip"
                    label="邮编"
                    width="120">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="100">
                <template slot-scope="scope">
                    <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
                    <el-button type="text" size="small">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>
<style>
    header{
        background: rgb(222, 225, 230);
        font-size: 14px;
        color: #606266;
        /*min-height: 54px;*/
    }
    .paper{
        display: inline-block;
        margin: 0;
        padding: 16px 25px;
    }
    .pull-right{
        padding: 10px 20px;
        float: right;
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
        margin: 0 6% 0 30%;
    }
    .lists span{
        float: left;
    }
    .lists img{
        width: 35px;
    }
    .checks{
        margin: 0 2% 0 3%;
    }
    /*.dos a,.tos a{*/
        /*color: rgba(61, 112, 206, 0.77)!important;*/
    /*}*/
    /*.del a{*/
        /*color: rgba(229, 28, 35, 1)!important;*/
    /*}*/
    .clear{
        clear: both;
        content: '';
    }
    /*组件*/
    .pull-right button{
        padding: 8px 20px !important;
    }
    .search{
        width: 15%;
        background:rgb(243, 243, 243);
        height: 30px;
    }
    .search i{
        font-size: 20px;
    }
</style>
<script>
    export default{
        data(){
            return {
                checked: false,
                form:{
                    name:'',

                },
                tableData: [{
                    date: '2016-05-03',
                    name: '王小虎',
                    province: '上海',
                    city: '普陀区',
                    address: '上海市普陀区金沙江路 1518 弄',
                    zip: 200333
                }, {
                    date: '2016-05-02',
                    name: '王小虎',
                    province: '上海',
                    city: '普陀区',
                    address: '上海市普陀区金沙江路 1518 弄',
                    zip: 200333
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    province: '上海',
                    city: '普陀区',
                    address: '上海市普陀区金沙江路 1518 弄',
                    zip: 200333
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    province: '上海',
                    city: '普陀区',
                    address: '上海市普陀区金沙江路 1518 弄',
                    zip: 200333
                }]
            }
        },

        methods: {
            handleClick(row) {
                console.log(row);
            }
        },
    }

</script>