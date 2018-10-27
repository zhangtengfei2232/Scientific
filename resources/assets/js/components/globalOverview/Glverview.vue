<template>
    <div>
        <div class="datas">
            <div class="navL">
                <p>数据中心</p>
            </div>
            <div class="list1">
                <el-row :gutter="20">
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(92, 109, 133);margin-left:20px" >
                            <span>论文</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(255, 135, 0)">
                            <span>项目</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(0, 172, 255)">
                            <span>著作</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(47, 101, 235)">
                            <span>获奖</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(0, 142, 106)">
                            <span>专利</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(3, 186, 0)">
                            <span>成果鉴定</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(234, 75, 140)">
                            <span>举办会议</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(255, 69, 48);">
                            <span>参加会议</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(255, 189, 20);margin-left:20px">
                            <span>专家讲学</span>
                            <p>21</p>
                        </div>
                    </el-col>
                    <el-col :span="3">
                        <div class="grid-content bg-purple" style="background:rgb(0, 199, 209)">
                            <span>担任学术团体职务</span>
                            <p>21</p>
                        </div>
                    </el-col>
                </el-row>
            </div>  
            <div class="char">
                <div class="navL">
                        <p>图标概况</p>
                    </div>
                <div class="list2">      
                    <span>师资图</span>
                    <div id="myChart" :style="{width: '300px', height: '300px'}"></div>
                </div>  
                <div class="list3">
                    <span>师资图</span>
                    <div id="myArticle" :style="{width: '300px', height: '300px'}"></div>
                </div>
                <div class="list4">
                    <span>师资图</span>
                    <div id="myAward" :style="{width: '300px', height: '300px'}"></div>
                </div>
            </div>
             
        </div>
    </div>
</template>

<style>
    body{
        background: #f9fafc;  
        overflow-x: hidden; 
    }
    .datas{
        width:85%;
        float: left;
    }
    .el-row {
        margin-bottom: 20px;
        margin-right: 0 !important;
        &:last-child {
            margin-bottom: 0;
        }
    }
    .list1{
        margin: 0;
    }
    .el-col {
        border-radius: 4px;
    }
    .bg-purple {
        margin-top: 20px;
        color: #fff;
        font-size: 13px;
    }
    .bg-purple-light {
        background: #e5e9f2;
    }
    .grid-content {
        border-radius: 4px;
        min-height: 36px;
    }
    .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }
    .bg-purple span{
        display: inline-block;
        padding: 10px 20px;
        width: 100%;
        border-bottom: 1px solid #fff;
    }
    .bg-purple p{
        padding: 20px 0;
        width: 100%;
        text-align: center;
    }
    .datas{
        margin: 20px;
        background: #fff;
    }
    .datas .navL{
        border-bottom: 1px solid #e5e9f2;
        padding: 0 20px;
    }
    .datas .navL p{
        line-height: 60px;
    }
    .list2{
        width: 40%;
        float: left;
        margin: 0 0 0 10%;
    }
    .list2 span,.list3 span,.list4{
        display: inline-block;
        padding: 10px 25px;
    }
    .list3{
        width: 40%;
        float: left;
    }
    .list4{
        width: 40%;
        float: left;
    }
</style>

<script>

export default {
    name: 'eCharts',
    data () {
        return {
            
        }
    },
    mounted(){
        this.drawLine();
    },
    methods: {
        drawLine(){
            var myChart = this.$echarts.init(document.getElementById('myChart'));
            var myArticle = this.$echarts.init(document.getElementById('myArticle'));
            var myAward = this.$echarts.init(document.getElementById('myAward'));
            myChart.setOption({
                series: {
                    type: 'pie',
                    data: [
                        {name: 'A', value: 1212},
                        {name: 'B', value: 2323},
                        {name: 'C', value: 1919}
                    ]
                }
            });
            myArticle.setOption({
                series: {
                    type: 'pie',
                    data: [
                        {name: 'A', value: 1212},
                        {name: 'B', value: 2323},
                        {name: 'C', value: 1919}
                    ]
                }
            });
            myAward.option = {
                legend: {},
                tooltip: {},
                dataset: {
                    source: [
                        ['product', '2015', '2016', '2017'],
                        ['Matcha Latte', 43.3, 85.8, 93.7],
                        ['Milk Tea', 83.1, 73.4, 55.1],
                        ['Cheese Cocoa', 86.4, 65.2, 82.5],
                        ['Walnut Brownie', 72.4, 53.9, 39.1]
                    ]
                },
                xAxis: {type: 'category'},
                yAxis: {},
                series: [
                    {type: 'bar'},
                    {type: 'bar'},
                    {type: 'bar'}
                ]
            };
        }
    }
}
</script>
