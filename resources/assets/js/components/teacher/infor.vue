<template>
    <div>
        <div class="main">
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
                        <p >{{ teacherDate.name }}<span class="change">修改</span></p>
                        <p>
                            <select id="test">
                                <option value="0" selected>请选择 </option>
                                <option value="1">一组</option>
                                <option value="2">二组</option>
                                <option value="3">三组</option>
                            </select>
                        </p>
                        <p>{{ teacherDate.teacher_id }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.office_phone }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.home_phone }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.phone }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.native_place }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.number }}<span class="change">修改</span></p>
                        <p>
                            <select id="nation">
                                <option value="0" selected>汉</option>
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
                                <option value="0" selected>副处</option>
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
                                <option value="0" selected>高级工程师</option>
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
                        <p>{{ teacherDate.company }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.te_re_department }}<span class="change">修改</span></p>
                        <p>
                            <input id="workTime" type="date" value=""/>
                        </p>
                        <p>{{ teacherDate.origin_work_unit }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.certificate_num }}<span class="change">修改</span></p>
                        <p>{{ teacherDate.identity_card }}<span class="change">修改</span></p>
                        <p></p><br>
                        <p>
                            <select id="firstEducation">
                                <option value="0" selected>博士 </option>
                                <option value="1">硕士</option>
                            </select>
                        </p>
                        <p>{{ teacherDate.edu_school }}<span class="change">修改</span></p>
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
            <div style="clear: both"></div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                fileList2: [{name: 'food.jpeg', url: '/dist/img/wang_light.png'}, {name: 'food2.jpeg', url: '/dist/img/wang_light.png'}],
                teacherDate: {},
                show: false,
            }
        },
        methods: {
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file){
                console.log(file);
            },
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    console.log(data);
                    if(data.code == 0){
                        self.teacherDate = data.datas;
                        console.log(self.teacherDate);
//                        if (teacherDate['teacher_id'] == 1) {
//                            show = true;
//                        }else if(teacherDate['teacher_id'] == 2) {
//                            show = true;
//                        }
                    }else{
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },

        },
        mounted() {
            this.getTeacherData();
        },

    }
</script>

<style>
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