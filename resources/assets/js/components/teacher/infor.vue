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
                        <p><img src="/dist/img/pic_fill.png" alt="未加载"></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change" @click.native = "clickchange">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change" @click.native = "clickchange">修改</span></p>
                        <p><el-input :value=" teacherDate.teacher_id" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.office_phone" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.home_phone" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.phone" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.native_place" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.number" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.nation" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.borth" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.polit_outlook" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.admin_duties" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.tenure_time" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.job_level" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.tenure_time" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p>
                            <!--专业技术职务-->
                            <el-input :value=" teacherDate.edu_school":disabled="true"></el-input><span class="change">修改</span>
                        </p>
                        <p><el-input :value="teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value="teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p>
                            <!--系列-->
                            <el-input :value=" teacherDate.series" :disabled="true"></el-input><span class="change">修改</span>
                        </p>
                        <p><el-input :value="teacherDate.post_category" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.company" :disabled="true"></el-input><span class="change">修改</span></p>
                        <!--请输入所属教研室和实验室-->
                        <p><el-input :value=" teacherDate.te_re_department":disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.working_hours" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.origin_work_unit" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.certificate_num" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.identity_card" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p></p><br>
                        <!--第一学历-->
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.edu_school" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p></p><br>
                        <!--最高学历-->
                        <p><el-input :value=" teacherDate.academic_id" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.edu_school" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <br>
                        <p><el-input :value=" teacherDate.work_major" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.belong_subject" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.teach_course" :disabled="true"></el-input><span class="change">修改</span></p><br>
                        <br><br>
                        <!--硕博导-->
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span></p>
                        <p><el-input :value=" teacherDate.name" :disabled="true"></el-input><span class="change">修改</span>
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
//                list:[
//                    {lis:'头像'}, {lis:'姓名'}, {lis:'分组'}, {lis:'工号'}, {lis:'办公电话'}, {lis:'住宅电话'},
//                    {lis:'手机'}, {lis:'籍贯'}, {lis:'编号'}, {lis:'民族'}, {lis:'出生年月'}, {lis:'政治面貌'},
//                    {lis:'行政职务'}, {lis:'任职时间'}, {lis:'职务级别'}, {lis:'任职时间'}, {lis:'专业技术职务'},
//                    {lis:'评审通过时间'}, {lis:'聘任时间'}, {lis:'系列'}, {lis:'岗位类别'}, {lis:'所在单位'},
//                    {lis:'所属教研室和实验室'}, {lis:'来校工作时间'}, {lis:'原工作单位'}, {lis:'教师资格证书编号'},
//                    {lis:'身份证号'},
//                    {lis:'第一学历'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'},
//                    {lis:'最高学历：'}, {lis:'学历/学位'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'},
//                    {lis:'最高学历：'}, {lis:'毕业学校'}, {lis:'所学专业'}, {lis:'毕业时间'}, {lis:'现从事专业'},
//                    {lis:'所属学科'}, {lis:'任教课程'}, {lis:'硕(博)导：'}, {lis:'授予单位'}, {lis:'获得时间'},
//                    {lis:'毕业证书图片'},
//
//                ],
                fileList2: [{name: 'food.jpeg', url: '/dist/img/wang_light.png'}, {name: 'food2.jpeg', url: '/dist/img/wang_light.png'}],
                teacherDate: {},
                show: false,
                inputJob:'' ,
                input: '',
                options: [{
                    value: '选项1',
                    label: '黄金糕'
                }, {
                    value: '选项4',
                    label: '龙须面'
                }, {
                    value: '选项5',
                    label: '北京烤鸭'
                }],
                options1:[{
                    value: '选项1',
                    label: '12'
                },],
                value: '',

                pickerOptions1: {
                    disabledDate(time) {
                        return time.getTime() > Date.now();
                    },
                },
                value1: '',
            }
        },
        methods: {
            handleRemove(file, fileList) {
                //console.log(file, fileList);
            },
            handlePreview(file){
                //console.log(file);
            },

//          getPage:function () {
//              let self = this;
//              axios.get("selectteacher").then(function (response) {
//                    self.options = response.data;
//              });
//          },
            clickchange(){
                var change = document.getElementsByClassName("change")[0];
                var txtArrs = document.getElementsByTagName('input');
                for ( var i = 0; i < change.length; i++) {
                    var txt = change[i];

                    if (txt.type == 'text') {
                        if (txt.disabled == true) {
                            txt.disabled = false;
                        } else {
                            //txt.disabled = false;
                        }
                    }
                }
            },
            getTeacherData(){
                let self = this;
                axios.get("selectteacher").then(function (response) {
                    var data = response.data;
                    if(data.code == 0){
                        self.teacherDate = data.datas;
//                        if (self.teacherDate.teacher_id == 1) {
//                            show = true;
//                        }else if(self.teacherDate.teacher_id == 2) {
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
            this.clickchange();
        },

    }
    //    function clickchange() {

    //        var txtArrs = document.getElementsByTagName('input');
    //        for ( var i = 0; i < txtArrs.length; i++) {
    //            var txt = txtArrs[i];
    //            if (txt.type == 'text') {
    //                if (txt.disabled == true) {
    //                    txt.disabled = false;
    //                } else {
    //                    //txt.disabled = false;
    //                }
    //            }
    //        }
    //    }
</script>

<style>
    .main{
        width: 100%;
        /*height: 935px;*/
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
    .body{
        Font-size:25%
    }
    .detiaLeft{
        width: 10%;
        /*background-color: #2ab27b;*/
        font-size:0.95em;
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
    .el-date-editor.el-input{
        width: 217px;
    }

    .change{
        color: rgba(0, 179, 138, 1);
        margin-left:2%;
    }
    /*//组件*/

    .upload-demo{
        width: 320px;
    }
    .el-input{
        width: 217px;
    }
</style>
