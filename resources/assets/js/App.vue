<template>
    <div>
        <div class="nav">
            <div class="navLeft">
                <img src="/dist/img/hist.png" alt="未加载">
            </div>
            <div class="navRight">
                <span><img src="/dist/img/sort.png" alt="未加载"></span>
                <span>生命科技学院科研管理系统</span>
                <div class="loginName">
                    <img src="/dist/img/my.png" alt="未加载">
                    <span>金凯杰</span>
                    <!--<span class="house">-->
                        <img src="/dist/img/home.png" alt="未加载">
                    <!--</span>-->
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="main">
            <div class="aside">
                <ul>
                    <li class="signIn"><img src="/dist/img/wang_light.png" alt=""><span>金凯杰</span></li>
                    <li><i class="el-icon-tickets"></i> &nbsp;论文</li>
                    <li><i class="el-icon-edit-outline"></i> &nbsp;项目</li>
                    <li><i class="el-icon-edit"></i> &nbsp;著作</li>
                    <li><i class="el-icon-setting"></i> &nbsp;获奖</li>
                    <li><i class="el-icon-star-on"></i> &nbsp;专利</li>
                    <li><i class="el-icon-setting"></i> &nbsp;成果鉴定</li>
                    <li><i class="el-icon-setting"></i> &nbsp;举办会议</li>
                    <li><i class="el-icon-setting"></i> &nbsp;参加会议</li>
                    <li><i class="el-icon-setting"></i> &nbsp;专家讲学</li>
                    <li><i class="el-icon-setting"></i> &nbsp;专担任学术团体职务</li>
                </ul>
            </div>

            <div class="content">
                <div class="perInfo"><span style="margin-left: 15px;">个人信息</span></div>
                <div class="detial">
                    <div class="detiaLeft">
                        <p>头像</p>
                        <p>姓名</p>
                        <p>分组</p>
                        <p>工号</p>
                        <p>办公电话</p>
                        <p>住宅电话</p>
                        <p>手机</p>
                        <p>籍贯</p>
                        <p>编号</p>
                        <p>民族</p>
                        <p>出生年月</p>
                        <p>政治面貌</p>
                        <p>行政职务</p>
                        <p>任职时间</p>
                        <p>职务级别</p>
                        <p>任职时间</p>
                        <p>专业技术职务</p>
                        <p>评审通过时间</p>
                        <p>聘任时间</p>
                        <p>系列</p>
                        <p>岗位类别</p>
                        <p>所在单位</p>
                        <p>所属教研室和实验室</p>
                        <p>来校工作时间</p>
                        <p>原工作单位</p>
                        <p>教师资格证书编号</p>
                        <p>身份证号</p><br/>
                        <p>第一学历：</p>
                        <p>学历/学位</p>
                        <p>毕业学校</p>
                        <p>所学专业</p>
                        <p>毕业时间</p><br/>
                        <p>最高学历：</p>
                        <p>学历/学位</p>
                        <p>毕业学校</p>
                        <p>所学专业</p>
                        <p>毕业时间</p><br/>

                        <p>现从事专业</p>
                        <p>所属学科</p>
                        <p>任教课程</p><br/>
                        <p>硕(博)导：</p>
                        <p>授予单位</p>
                        <p>获得时间</p><br/>

                        <p>毕业证书图片</p>
                    </div>
                    <div class="detialRight">
                        <p><img src="/dist/img/pic_fill.png" alt=""></p>
                        <p >茹振钢<span class="change">修改</span></p>
                        <p>
                            <select id="test">
                                <option value="0" selected>请选择 </option>
                                <option value="1">一组</option>
                                <option value="2">二组</option>
                                <option value="3">三组</option>
                            </select>
                        </p>
                        <p>skxy001<span class="change">修改</span></p>
                        <p>2634113752<span class="change">修改</span></p>
                        <p>2634113752<span class="change">修改</span></p>
                        <p>13663907506<span class="change">修改</span></p>
                        <p>河南省新乡市红旗区华兰大道河南科技学院<span class="change">修改</span></p>
                        <p>001<span class="change">修改</span></p>
                        <p>
                            <select id="nation">
                                <option value="0" selected>汉 </option>
                                <option value="1">回族</option>
                                <option value="2">维吾尔族</option>
                                <option value="3">苗族</option>
                            </select>
                        </p>
                        <p>
                            <select id="birth">
                                <option value="0" selected>请选择 </option>
                                <option value="1">option-1</option>
                                <option value="2">option-2</option>
                                <option value="3">option-3</option>
                            </select>
                        </p>
                        <p>
                            <select id="politics">
                                <option value="0" selected>团员 </option>
                                <option value="1">党员</option>
                                <option value="2">共青团员</option>
                                <option value="3">积极分子</option>
                            </select>
                        </p>
                        <p>
                            <select id="job">
                                <option value="0" selected>教务处 </option>
                                <option value="1">办公室</option>
                                <option value="2">后勤部</option>
                                <option value="3">党办</option>
                            </select>
                        </p>
                        <p>
                            <input id="meeting" type="date" value=""/>
                        </p>
                        <p>
                            <select id="level">
                                <option value="0" selected>副处 </option>
                                <option value="1">正处</option>
                                <option value="2">院长</option>
                                <option value="3">级别</option>
                            </select>
                        </p>
                        <p>
                            <input id="tenure" type="date" value=""/>
                        </p>
                        <p>
                            <select id="majorSkill">
                                <option value="0" selected>高级工程师 </option>
                                <option value="1">，，</option>
                                <option value="2">，，</option>
                            </select>
                        </p>
                        <p>
                            <input id="passTime" type="date" value=""/>
                        </p>
                        <p>
                            <input id="useTime" type="date" value=""/>
                        </p>
                        <p>
                            <select id="system">
                                <option value="0" selected>中文系 </option>
                                <option value="1">外语系</option>
                                <option value="2">国贸系</option>
                            </select>
                        </p>
                        <p>
                            <select id="quarters">
                                <option value="0" selected>教师岗位 </option>
                                <option value="1">行政岗位</option>
                            </select>
                        </p>
                        <p>河南科技学院<span class="change">修改</span></p>
                        <p>三月<span class="change">修改</span></p>
                        <p>
                            <input id="workTime" type="date" value=""/>
                        </p>
                        <p>河南科技学院<span class="change">修改</span></p>
                        <p>456757723796359<span class="change">修改</span></p>
                        <p>41272219882238769<span class="change">修改</span></p>
                        <p></p><br>
                        <p>
                            <select id="firstEducation">
                                <option value="0" selected>博士 </option>
                                <option value="1">硕士</option>
                            </select>
                        </p>
                        <p>河南科技学院<span class="change">修改</span></p>
                        <p>信息工程专业<span class="change">修改</span></p>
                        <p>
                            <input id="firstGraduation" type="date" value=""/>
                        </p>
                        <p></p><br>
                        <p>
                            <select id="highEducation">
                                <option value="0" selected>博士 </option>
                                <option value="1">硕士</option>
                            </select>
                        </p>
                        <p>河南科技学院<span class="change">修改</span></p>
                        <p>信息工程专业<span class="change">修改</span></p>
                        <p>
                            <input id="highGraduation" type="date" value=""/>
                        </p><br>
                        <p>教师<span class="change">修改</span></p>
                        <p>心理<span class="change">修改</span></p>
                        <p>计算机科学与技术<span class="change">修改</span></p><br>
                        <p>中国石油大学 鲍志东<span class="change">修改</span></p>
                        <p>河南科技学院<span class="change">修改</span></p>
                        <p>
                            <input id="getTime" type="date" value=""/>
                        </p><br>
                        <p>
                            <el-upload
                                    class="upload-demo"
                                    action="https://jsonplaceholder.typicode.com/posts/"
                                    :on-preview="handlePreview"
                                    :on-remove="handleRemove"
                                    :file-list="fileList2"
                                    list-type="picture">
                                <el-button size="small" type="primary">点击上传</el-button>
                                <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                            </el-upload>
                        </p>
                        
                    </div>
                  
                </div>
            </div>
        </div>
        <!--<router-view></router-view>-->
    </div>
</template>
<script>
    export default {
        data() {
            return {
                fileList2: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
            };
        },
        methods: {
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
            }
        }
    }
//    export default {
//        methods: {
//            handleOpen(key, keyPath) {
//                console.log(key, keyPath);
//            },
//            handleClose(key, keyPath) {
//                console.log(key, keyPath);
//            }
//        }
//    }
function fun(){
    var val = document.getElementById("val").value;
    var txt = document.getElementById("txt").value;
    var sel = document.getElementById("test");
    var option = new Option(txt, val);
    sel.options.add(option);
}
//    var oLis=document.getElementsByTagName("li");
//    var i,j;
//    var length=oLis.length;
//    for(i=0;i<length;i++){
//        oLis[i].onclick=function(){
//            for(j=0;j<length;j++){
//                oLis[j].className="";
//            }
//            this.className+="clickstyle";
//        }
//    }

//    export default {
//        data(){
//            return {
//                msg: "Vue"
//            }
//        }
//
//    }
</script>

<style>
    *,ul,li,a{
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
    }
    body, html{
        width: 100%;
        height: 100%;
    }
    .nav{
        width: 100%;
        height:35px;
        background-color: plum;
    }

    .navLeft{
        width: 12%;
        height: 100%;
        float: left;
        text-align: center;
        background-color:rgb(0,125,113) ;
    }
    .navRight{
        width: 88%;
        height: 100%;
        float: right;
        color: white;
        text-align: center;
        line-height:31px;
        background-color: rgb(0,150,136);
    }
    .navLeft img{
        width: 11%;
        margin-top: 5px;
    }
    .navRight span:first-child{
        width: 5%;
        height: 100%;
        float: left;
    }
    .navRight span:first-child img{
        width:42%;
    }
    .loginName{
        width:15%;
        height: 100%;
        float: right;
    }
    .loginName img{
        width:10%;
        vertical-align:middle;
    }

    .aside{
        width: 12%;
        height:935px;
        color: white;
        float: left;
        background-color:rgb(34,45,50);
        /*display: inline-block;*/
    }
    .aside li:first-child{
        /*position: absolute;*/
        height: 70px;
        background-color: black;
        /*vertical-align:middle;*/
    }
    .aside li:first-child span{
        margin-left: 20px;
        /*margin-top: 5px;*/
    }
    .signIn img{
        width:22%;
        vertical-align:middle;
        /*margin-top: 10px;*/
    }
    .aside li{
        height:55px;
        text-align :center;
        line-height: 55px;
        background-color:rgb(34,45,50);
        /*background-color: plum;*/
        border-bottom: 0.5px solid gray;
    }
    .aside li a{
        list-style: none;
        color: white;
        text-decoration: none;
    }
    .main{
        width: 100%;
        height: 935px;
        margin:0 auto
        /*text-align: center;*/
        /*background-color: #1b6d85;*/
        /*display: inline-block;*/
    }
    .content{
        width: 87%;
        /*background-color: #1b6d85;*/
        /*margin: 0;*/
        float: right;
    }
    .perInfo{
        width: 100%;
        height: 50px;
        line-height: 52px;
        /*margin-left: 20px;*/
        border-bottom: 1px solid gray;
    }
    /*.detial{*/
        /*width: 80%;*/
        /*background-color: #5bc0de;*/
    /*}*/
    /*.detial li{*/
        /*height: 50px;*/
    /*}*/
    /*.space{*/
        /*margin-left: 70px;*/
    /*}*/
    /*.space img{*/
        /*width: 33px;*/
        /*vertical-align:middle;*/
    /*}*/
    .detiaLeft{
        width: 10%;
        /*background-color: #2ab27b;*/
        float: left;
        margin-left: 10%;
    }
    .detialRight{
        width: 78%;
        float: right;
        /*background-color: #4bb1b1;*/
    }
    .detial{
        margin-top: 3%;
    }
    .detial p{
        line-height: 43px;
        height:50px;
    }
    .detialRight img{
        width: 33px;
    /*vertical-align:middle;*/
    }
    #test,#birth,#politics,#nation,#job,#meeting,#level,
    #tenure,#passTime,#useTime,#majorSkill,#system,#workTime,
    #quarters,#firstEducation,#firstGraduation,#highGraduation,
    #highEducation,#getTime{
        width: 165px;
        height: 30px;
        border: 1px solid lightgray;
        border-radius: 5px;
    }
    #meeting,#tenure,#passTime,#useTime,#workTime,#firstGraduation,#highGraduation,#getTime
   {
        border-color: rgb(169, 169, 169);
        margin: 0;
        padding: 0;
    }
    .change{
        color: rgba(0, 179, 138, 1);
        margin-left:4%;
    }
    /*//组件*/
    /*.el-input el-input--suffix input{*/
        /*margin: 10px -2%;*/
    /*}*/
    .upload-demo{
        width: 320px;
    }

</style>