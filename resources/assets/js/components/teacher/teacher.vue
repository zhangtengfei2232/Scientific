<template>
    <div>
        <el-input v-model="tableDataName" placeholder="请输入姓名" style="width:240px"></el-input>
        <el-button type="primary" @click="doFilter">搜索</el-button>
        <el-button type="primary" @click="openData">展示数据</el-button>
        <el-table
                :data="tableDataEnd"
                border
                style="width: 100%">
            <el-table-column
                    prop="date"
                    label="日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="address"
                    label="地址">
            </el-table-column>
        </el-table>
        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page="currentPage"
                :page-sizes="[1, 2, 3, 4]"
                :page-size="pageSize"
                layout="total, sizes, prev, pager, next, jumper"
                :total="totalItems">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableDataBegin: [
                    {
                        date: "2016-05-01",
                        name: "王小虎",
                        address: "上海市普陀区金沙江路 1518 弄"
                    },
                    {
                        date: "2016-05-02",
                        name: "王小虎",
                        address: "上海市普陀区金沙江路 1517 弄"
                    },
                    {
                        date: "2016-05-03",
                        name: "王二虎",
                        address: "上海市普陀区金沙江路 1519 弄"
                    },
                    {
                        date: "2016-05-04",
                        name: "王二虎",
                        address: "上海市普陀区金沙江路 1516 弄"
                    },
                    {
                        date: "2016-05-05",
                        name: "王三虎",
                        address: "上海市普陀区金沙江路 1518 弄"
                    },
                    {
                        date: "2016-05-06",
                        name: "王三虎",
                        address: "上海市普陀区金沙江路 1517 弄"
                    },
                    {
                        date: "2016-05-07",
                        name: "王小虎",
                        address: "上海市普陀区金沙江路 1519 弄"
                    },
                    {
                        date: "2016-05-08",
                        name: "王小虎",
                        address: "上海市普陀区金沙江路 1516 弄"
                    }
                ],
                tableDataName: "",
                tableDataEnd: [],
                currentPage: 4,
                pageSize: 2,
                totalItems: 0,
                filterTableDataEnd:[],
                flag:false
            };
        },
        created() {
            this.totalItems = this.tableDataBegin.length;
            if (this.totalItems > this.pageSize) {
                for (let index = 0; index < this.pageSize; index++) {
                    this.tableDataEnd.push(this.tableDataBegin[index]);
                }
            } else {
                this.tableDataEnd = this.tableDataBegin;
            }
        },
        methods: {
            //前端搜索功能需要区分是否检索,因为对应的字段的索引不同
            //用两个变量接收currentChangePage函数的参数
            doFilter() {
                if (this.tableDataName == "") {
                    this.$message.warning("查询条件不能为空！");
                    return;
                }
                this.tableDataEnd = []
                //每次手动将数据置空,因为会出现多次点击搜索情况
                this.filterTableDataEnd=[]
                this.tableDataBegin.forEach((value, index) => {
                    if(value.name){
                        if(value.name.indexOf(this.tableDataName)>=0){
                            this.filterTableDataEnd.push(value)
                        }
                    }
                });
                //页面数据改变重新统计数据数量和当前页
                this.currentPage=1
                this.totalItems=this.filterTableDataEnd.length
                //渲染表格,根据值
                this.currentChangePage(this.filterTableDataEnd)
                //页面初始化数据需要判断是否检索过
                this.flag=true
            },
            openData() {},
            handleSizeChange(val) {
                console.log(`每页 ${val} 条`);
                this.pageSize = val;
                this.handleCurrentChange(this.currentPage);
            },
            handleCurrentChange(val) {
                console.log(`当前页: ${val}`);
                this.currentPage = val;
                //需要判断是否检索
                if(!this.flag){
                    this.currentChangePage(this.tableDataEnd)
                }else{
                    this.currentChangePage(this.filterTableDataEnd)
                }
            }, //组件自带监控当前页码
            currentChangePage(list) {
                let from = (this.currentPage - 1) * this.pageSize;
                let to = this.currentPage * this.pageSize;
                this.tableDataEnd = [];
                for (; from < to; from++) {
                    if (list[from]) {
                        this.tableDataEnd.push(list[from]);
                    }
                }
            }
        }
    };
</script>



<!--<template>-->
    <!--<div>-->
        <!--<el-container style="height: 500px; border: 1px solid #eee">-->
            <!--<el-aside width="200px" style="background-color: rgb(238, 241, 246)">-->
                <!--<el-menu :default-openeds="['1', '3']">-->
                    <!--<el-submenu index="1">-->
                        <!--<template slot="title"><i class="el-icon-message"></i><router-link to="/paper">论文</router-link></template>-->
                        <!--<el-menu-item-group>-->
                            <!--<template slot="title">分组一</template>-->
                            <!--<el-menu-item index="1-1">选项1</el-menu-item>-->
                            <!--<el-menu-item index="1-2">选项2</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-menu-item-group title="分组2">-->
                            <!--<el-menu-item index="1-3">选项3</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-submenu index="1-4">-->
                            <!--<template slot="title">选项4</template>-->
                            <!--<el-menu-item index="1-4-1">选项4-1</el-menu-item>-->
                        <!--</el-submenu>-->
                    <!--</el-submenu>-->
                    <!--<el-submenu index="2">-->
                        <!--<template slot="title"><i class="el-icon-menu"></i>导航二</template>-->
                        <!--<el-menu-item-group>-->
                            <!--<template slot="title">分组一</template>-->
                            <!--<el-menu-item index="2-1">选项1</el-menu-item>-->
                            <!--<el-menu-item index="2-2">选项2</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-menu-item-group title="分组2">-->
                            <!--<el-menu-item index="2-3">选项3</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-submenu index="2-4">-->
                            <!--<template slot="title">选项4</template>-->
                            <!--<el-menu-item index="2-4-1">选项4-1</el-menu-item>-->
                        <!--</el-submenu>-->
                    <!--</el-submenu>-->
                    <!--<el-submenu index="3">-->
                        <!--<template slot="title"><i class="el-icon-setting"></i>导航三</template>-->
                        <!--<el-menu-item-group>-->
                            <!--<template slot="title">分组一</template>-->
                            <!--<el-menu-item index="3-1">选项1</el-menu-item>-->
                            <!--<el-menu-item index="3-2">选项2</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-menu-item-group title="分组2">-->
                            <!--<el-menu-item index="3-3">选项3</el-menu-item>-->
                        <!--</el-menu-item-group>-->
                        <!--<el-submenu index="3-4">-->
                            <!--<template slot="title">选项4</template>-->
                            <!--<el-menu-item index="3-4-1">选项4-1</el-menu-item>-->
                        <!--</el-submenu>-->
                    <!--</el-submenu>-->
                <!--</el-menu>-->
            <!--</el-aside>-->

            <!--<el-container>-->
                <!--<el-header style="text-align: right; font-size: 12px">-->
                    <!--<el-dropdown>-->
                        <!--<i class="el-icon-setting" style="margin-right: 15px"></i>-->
                        <!--<el-dropdown-menu slot="dropdown">-->
                            <!--<el-dropdown-item>查看</el-dropdown-item>-->
                            <!--<el-dropdown-item>新增</el-dropdown-item>-->
                            <!--<el-dropdown-item>删除</el-dropdown-item>-->
                        <!--</el-dropdown-menu>-->
                    <!--</el-dropdown>-->
                    <!--<span>王小虎</span>-->
                <!--</el-header>-->

                <!--<el-main>-->
                    <!--<el-table :data="tableData">-->
                        <!--<el-table-column prop="date" label="日期" width="140">-->
                        <!--</el-table-column>-->
                        <!--<el-table-column prop="name" label="姓名" width="120">-->
                        <!--</el-table-column>-->
                        <!--<el-table-column prop="address" label="地址">-->
                        <!--</el-table-column>-->
                    <!--</el-table>-->
                <!--</el-main>-->
            <!--</el-container>-->
        <!--</el-container>-->
    <!--</div>-->
<!--</template>-->
<!--<style>-->
    <!--.el-header {-->
        <!--background-color: #B3C0D1;-->
        <!--color: #333;-->
        <!--line-height: 60px;-->
    <!--}-->

    <!--.el-aside {-->
        <!--color: #333;-->
    <!--}-->
<!--</style>-->

<!--<script>-->
    <!--export default {-->
        <!--data() {-->
            <!--const item = {-->
                <!--date: '2016-05-02',-->
                <!--name: '王小虎',-->
                <!--address: '上海市普陀区金沙江路 1518 弄'-->
            <!--};-->
            <!--return {-->
                <!--tableData: Array(20).fill(item)-->
            <!--}-->
        <!--}-->
    <!--};-->
<!--</script>-->