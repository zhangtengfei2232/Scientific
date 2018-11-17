<template>
    <div>
        <div class="datas">
            <div class="navL">
                <p>数据中心</p>
            </div>
            <div class="list1">
                <el-row :gutter="20">
                    <router-link to="/loaderList/article">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(92, 109, 133);margin-left:20px" >
                                <span>论文</span>
                                <p>{{ AllDate[0] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/project">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(255, 135, 0)">
                                <span>项目</span>
                                <p>{{ AllDate[1] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/project">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(0, 172, 255)">
                                <span>著作</span>
                                <p>{{ AllDate[2] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/award">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(47, 101, 235)">
                                <span>获奖</span>
                                <p>{{ AllDate[3] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/patent">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(0, 142, 106)">
                                <span>专利</span>
                                <p>{{ AllDate[4] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/appraisal">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(3, 186, 0)">
                                <span>成果鉴定</span>
                                <p>{{ AllDate[5] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/holdmeet">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(234, 75, 140)">
                                <span>举办会议</span>
                                <p>{{ AllDate[6] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/joinmeet">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(255, 69, 48);">
                                <span>参加会议</span>
                                <p>{{ AllDate[7] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/lecture">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(255, 189, 20);margin-left:20px">
                                <span>专家讲学</span>
                                <p>{{ AllDate[8] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                    <router-link to="/loaderList/duties">
                        <el-col :span="3">
                            <div class="grid-content bg-purple" style="background:rgb(0, 199, 209)">
                                <span>担任学术团体职务</span>
                                <p>{{ AllDate[9] }}</p>
                            </div>
                        </el-col>
                    </router-link>
                </el-row>
            </div>  
            <div class="char">
                <div class="navL">
                        <p>图标概况</p>
                    </div>
                <div class="list2">      
                    <span class="span">师资图</span>
                    <div id="myChart" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini" @click="getTeacherDate()">学历</el-button>
                    <el-button type="danger" size="mini" @click="rank()">职称</el-button>
                </div>  
                <div class="list3">
                    <span class="span">论文图</span>
                    <div id="myArticle" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini">刊物级别</el-button>
                </div>
                <div class="list4">
                    <span class="span">项目图</span>
                    <div id="myProject" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini" @click="getProjectDate()">学科门类</el-button>
                    <el-button type="danger" size="mini" @click="ProType()">研究类别</el-button>
                </div>
                <div class="list5">
                    <span class="span">著作图</span>
                    <div id="myOpus" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini" @click="getOpusDate()">著作类别</el-button>
                    <el-button type="danger" size="mini" @click="OpusType()">编著形式</el-button>
                </div>
                <div class="list6">
                    <span class="span">获奖图</span>
                    <div id="myAward" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini" @click="getAwardDate()">奖励级别</el-button>
                    <el-button type="danger" size="mini" @click="AwardType()">成果形式</el-button>
                </div>
                <div class="list7">
                    <span class="span">专利图</span>
                    <div id="myPatent" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini">专利类型</el-button>
                </div>
                <div class="list8">
                    <span class="span">成果鉴定图</span>
                    <div id="myAppraisal" :style="{width: '320px', height: '300px'}"></div>
                    <el-button type="primary" size="mini">鉴定级别</el-button>
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
    .list2,.list3,.list4,.list5,.list6,.list7,.list8{
        width: 30%;
        height: 390px;
        float: left;
        margin: 0 0 0 10%;
        border-bottom: #eee solid 1px;
    }
    .list2 .span,.list3 .span,.list4 .span,.list5 .span,.list6 .span,.list7 .span,.list8 .span{
        display: inline-block;
        padding: 10px 25px;
    }
</style>

<script>

export default {
    name: 'eCharts',
    data () {
        return {
            AllDate:[],
            teacherMicDate:[],
            teacherRanDate:[],
            ArticleDate:[],
            ProjectDate:[],
            OpusDate:[],
            AwardDate:[],
            PatentDate:[],
            AppraisalDate:[]
        }
    },
    methods: {
        getAllData() {
            let self = this;
            axios.get("counteverymodular").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AllDate = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        getTeacherDate() {
            let self = this;
            axios.get("groupbyteachertechnicaltitle").then(function (response) {
                var data = response.data;
                console.log(response.data);
                if (data.code == 0) {
                    self.teacherMicDate = data.datas;
                    self.drawLine(self.teacherMicDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLine(datas){
            var myChart = this.$echarts.init(document.getElementById('myChart'));
            myChart.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '博士'+'('+datas[0]+')', value: datas[0]},
                        {name: '硕士'+'('+datas[1]+')', value: datas[1]},
                        {name: '研究生'+'('+datas[2]+')', value: datas[2]}
                    ]
                }
            });
        },
        rank() {
            let self = this;
            axios.get("groupbyteachereducation").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.teacherRanDate = data.datas;
                    self.drawLineRank(self.teacherRanDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineRank(datas) {
            var myChart = this.$echarts.init(document.getElementById('myChart'));
             myChart.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '初级'+'('+datas[0]+')', value: datas[0]},
                        {name: '中级'+'('+datas[1]+')', value: datas[1]},
                        {name: '副高'+'('+datas[2]+')', value: datas[2]},
                        {name: '正高'+'('+datas[3]+')', value: datas[3]}
                    ]
                }
            });
        },
        getArticleDate() {
            let self = this;
            axios.get("groupbyarticaljournallevel").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.ArticleDate = data.datas;
                    self.drawLineArt(self.ArticleDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineArt(datas) {
            var myArticle = this.$echarts.init(document.getElementById('myArticle'));
            myArticle.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: 'SCI一区'+'('+datas[0]+')', value: datas[0]},
                        {name: 'SCI二区'+'('+datas[1]+')', value: datas[1]},
                        {name: 'SCI三区'+'('+datas[2]+')', value: datas[2]},
                        {name: 'SCI四区'+'('+datas[3]+')', value: datas[3]},
                        {name: 'EI'+'('+datas[4]+')', value: datas[4]},
                        {name: 'SSCI'+'('+datas[5]+')', value: datas[5]},
                        {name: 'CN'+'('+datas[6]+')', value: datas[6]},
                        {name: 'CSSCI核心库'+'('+datas[7]+')', value: datas[7]},
                        {name: '中文核心'+'('+datas[8]+')', value: datas[8]},
                        {name: 'CSCD核心库'+'('+datas[9]+')', value: datas[9]},
                        {name: '河南科技学院期刊'+'('+datas[10]+')', value: datas[10]},
                    ]
                }
            });
        },
        getProjectDate() {
            let self = this;
            axios.get("groupbyprojectcertificatelevel").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.ProjectDate = data.datas;
                    self.drawLinePro(self.ProjectDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLinePro(datas) {
             var myProject = this.$echarts.init(document.getElementById('myProject'));
             myProject.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '理学'+'('+datas[0]+')', value: datas[0]},
                        {name: '工学'+'('+datas[1]+')', value: datas[1]},
                        {name: '农学'+'('+datas[2]+')', value: datas[2]},
                        {name: '医学'+'('+datas[3]+')', value: datas[3]},
                        {name: '管理学'+'('+datas[4]+')', value: datas[4]},
                        {name: '马克思主义'+'('+datas[5]+')', value: datas[5]},
                        {name: '哲学'+'('+datas[6]+')', value: datas[6]},
                        {name: '逻辑学'+'('+datas[7]+')', value: datas[7]},
                        {name: '宗教学'+'('+datas[8]+')', value: datas[8]},
                        {name: '语言学'+'('+datas[9]+')', value: datas[9]},
                        {name: '中国文学'+'('+datas[10]+')', value: datas[10]},
                        {name: '外国文学'+'('+datas[11]+')', value: datas[11]},
                        {name: '艺术学'+'('+datas[12]+')', value: datas[12]},
                        {name: '历史学'+'('+datas[13]+')', value: datas[13]},
                        {name: '考古学'+'('+datas[14]+')', value: datas[14]},
                        {name: '经济学'+'('+datas[15]+')', value: datas[15]},
                        {name: '政治学'+'('+datas[16]+')', value: datas[16]},
                        {name: '法学'+'('+datas[17]+')', value: datas[17]},
                    ]
                }
            });
        },
        ProType() {
            let self = this;
            axios.get("groupbyprojetcateresearch").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.ProjectDate = data.datas;
                    self.drawLineTypePro(self.ProjectDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineTypePro(datas) {
            var myProject = this.$echarts.init(document.getElementById('myProject'));
             myProject.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '基础研究'+'('+datas[0]+')', value: datas[0]},
                        {name: '实验与发展'+'('+datas[1]+')', value: datas[1]},
                        {name: '应用研究'+'('+datas[2]+')', value: datas[2]},
                    ]
                }
            });
        },
        getOpusDate() {
            let self = this;
            axios.get("gropubyopuscategory").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.OpusDate = data.datas;
                    self.drawLineOpu(self.OpusDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineOpu(datas) {
            var myOpus = this.$echarts.init(document.getElementById('myOpus'));
             myOpus.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '专著'+'('+datas[0]+')', value: datas[0]},
                        {name: '教科书'+'('+datas[1]+')', value: datas[1]},
                        {name: '译著'+'('+datas[2]+')', value: datas[2]},
                        {name: '编著'+'('+datas[3]+')', value: datas[3]},
                        {name: '其他'+'('+datas[4]+')', value: datas[4]},              
                    ]
                }
            });
        },
        OpusType() {
             let self = this;
            axios.get("groupbyopusformwrite").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.OpusDate = data.datas;
                    self.drawLineTypeOpu(self.OpusDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineTypeOpu(datas) {
             var myOpus = this.$echarts.init(document.getElementById('myOpus'));
             myOpus.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '主编'+'('+datas[0]+')', value: datas[0]},
                        {name: '副主编'+'('+datas[1]+')', value: datas[1]},
                        {name: '参编'+'('+datas[2]+')', value: datas[2]},
                        {name: '编著'+'('+datas[3]+')', value: datas[3]},
                        {name: '其他'+'('+datas[4]+')', value: datas[4]},              
                    ]
                }
            });
        },
        getAwardDate() {
            let self = this;
            axios.get("groupbywinlevel").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AwardDate = data.datas;
                    self.drawLineAwa(self.AwardDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineAwa(datas) {
            var myAward = this.$echarts.init(document.getElementById('myAward'));
            myAward.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '国家级'+'('+datas[0]+')', value: datas[0]},
                        {name: '省部级'+'('+datas[1]+')', value: datas[1]},
                        {name: '厅局级'+'('+datas[2]+')', value: datas[2]},
                        {name: '校级'+'('+datas[3]+')', value: datas[3]},
                        {name: '其他'+'('+datas[4]+')', value: datas[4]},              
                    ]
                }
            });
        },
        AwardType() {
            let self = this;
            axios.get("groupbyformachievement").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AwardDate = data.datas;
                    self.drawLineTypeAwa(self.AwardDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineTypeAwa(datas) {
            var myAward = this.$echarts.init(document.getElementById('myAward'));
            myAward.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '论文'+'('+datas[0]+')', value: datas[0]},
                        {name: '研究报告'+'('+datas[1]+')', value: datas[1]},
                        {name: '新技术'+'('+datas[2]+')', value: datas[2]},
                        {name: '新工艺'+'('+datas[3]+')', value: datas[3]},
                        {name: '课件'+'('+datas[4]+')', value: datas[4]},    
                        {name: '专著'+'('+datas[5]+')', value: datas[5]},             
                        {name: '编著'+'('+datas[6]+')', value: datas[6]},   
                        {name: '计算机软件'+'('+datas[7]+')', value: datas[7]},   
                        {name: '教材'+'('+datas[8]+')', value: datas[8]},   
                        {name: '其他'+'('+datas[9]+')', value: datas[9]},   
                    ]
                }
            });
        },
        getPatentDate() {
            let self = this;
            axios.get("groupbypatenttype").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.PatentDate = data.datas;
                    self.drawLinePat(self.PatentDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLinePat(datas) {
            var myPatent = this.$echarts.init(document.getElementById('myPatent'));
             myPatent.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '发明专利'+'('+datas[0]+')', value: datas[0]},
                        {name: '实用新型专利'+'('+datas[1]+')', value: datas[1]},
                        {name: '外观设计专利'+'('+datas[2]+')', value: datas[2]},             
                    ]
                }
            });
        },
        getAppraisalDate() {
            let self = this;
            axios.get("groupbyappraisallevel").then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.AppraisalDate = data.datas;
                    self.drawLineApp(self.AppraisalDate);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        drawLineApp(datas) {
            var myAppraisal = this.$echarts.init(document.getElementById('myAppraisal'));
             myAppraisal.setOption({
                series: {
                    type: 'pie',
                    radius : '55%',
                    data: [
                        {name: '国家级'+'('+datas[0]+')', value: datas[0]},
                        {name: '省级'+'('+datas[1]+')', value: datas[1]},
                        {name: '厅级'+'('+datas[2]+')', value: datas[2]}, 
                        {name: '校级'+'('+datas[3]+')', value: datas[3]},             
                    ]
                }
            });
        },
    },
    mounted(){
        this.getTeacherDate();
        this.getArticleDate();
        this.getProjectDate();
        this.getOpusDate();
        this.getAwardDate();
        this.getPatentDate();
        this.getAppraisalDate();
        this.getAllData();
    },
}
</script>