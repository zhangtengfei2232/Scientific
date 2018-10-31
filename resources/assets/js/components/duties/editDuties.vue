<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="125px">
            <el-form-item label="姓名">
                <el-input v-model="form.teacher_name" placeholder="请输入姓名"></el-input>
            </el-form-item>
            <el-form-item label="职称">
                <el-select v-model="form.du_academic" placeholder="请选择职称">
                    <el-option label="教授" value="1"></el-option>
                    <el-option label="副教授" value="2"></el-option>
                    <el-option label="讲师" value="3"></el-option>
                    <el-option label="助教" value="4"></el-option>
                    <el-option label="高级实验师" value="5"></el-option>
                    <el-option label="实验师" value="6"></el-option>
                    <el-option label="助理实验师" value="7"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学历">
                <el-select v-model="form.du_education" placeholder="请选择学历">
                    <el-option label="大专" value="1"></el-option>
                    <el-option label="研究生" value="2"></el-option>
                    <el-option label="本科" value="3"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学位">
                <el-select v-model="form.du_degree" placeholder="请选择学位">
                    <el-option label="硕士" value="1"></el-option>
                    <el-option label="博士" value="2"></el-option>
                    <el-option label="学士" value="3"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="年龄">
                <el-input v-model="form.du_age" placeholder="请输入您的年龄(数字)"></el-input>
            </el-form-item>

            <el-form-item label="担任学术团体名称">
                <el-input v-model="form.du_name" placeholder="请输入担任学术团体名称"style="width: 370px;"></el-input>
                <!--<el-select v-model="form.level" placeholder="担任学术团体级别" style="width: 200px;">-->
                    <!--<el-option label="省级" value="1"></el-option>-->
                    <!--<el-option label="国家级" value="2"></el-option>-->
                    <!--<el-option label="国际级" value="3"></el-option>-->
                <!--</el-select>-->
            </el-form-item>

            <el-form-item label="所任职务">
                <el-input v-model="form.du_duty" placeholder="请输入所任职务"></el-input>
            </el-form-item>
            <el-form-item label="担任职务年限">
                <el-date-picker
                        v-model="year1"
                        type="date"
                        fo  rmat="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"
                        placeholder="选择日期">
                </el-date-picker>
                <span>-</span>
                <el-date-picker
                        v-model="year2"
                        format="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"
                        type="date"
                        placeholder="选择日期">
                </el-date-picker>
            </el-form-item>
            <el-form-item label="备注">
                <el-input type="textarea" v-model="form.du_remark"></el-input>
            </el-form-item>
            <el-form-item label="证书图片">
                <el-upload
                        class="upload-demo"
                        drag
                        action=""
                        multiple
                        :file-list="filelist"
                        ref="pic_file"
                        :before-upload="fileProfil"
                        :auto-upload="false">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit(form,year1,year2)">立即创建</el-button>
                <el-button><router-link to="/duties">取消</router-link></el-button>
            </el-form-item>
        </el-form>
        </div>
    </div>
</template>

<style scoped>
    .information{
        width: 75%;
        float: left;
    }
    .add{
        width: 80%;
        margin: 35px 0 0 35px;
    }
    /*组件*/
    .el-form{
        width:62%;
        margin-top: 40px;
        margin-left: 150px;
    }
</style>
<script>
    export default {
        data() {
            return {
                DutiesData:{},
                pic_file:'',
                dataForm: new FormData(),
                dataFile: new FormData(),
                Bcode:false,
                multiple: true,
                filelist: [{url:''}],
                year1: '',
                year2: '',
                form: {
                    du_academic: '',
                    du_education: '',
                    du_degree: '',
                    du_age: '',
                    du_name: '',
                    du_duty: '',
                    du_year_num: '',
                    data1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    du_remark: '',
                }
            }
        },
        methods: {
            fileProfil(file){
                this.dataForm.append('pic_file', file);
                return false;
            },
            getDutiesData() {
                let self = this;
                let du_id = self.$route.params.du_id;
                axios.get("selectduties?du_id="+du_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.DutiesData = data.datas;
                        console.log(self.DutiesData,'书看@@@@@@@@!!');
                        let time = data.datas.du_year_num;
//                        let time1 = data.datas.year1;
//                        let time2 = data.datas.year2;
//                        let time = time1+","+time2;
//                        console.log(time,'f时间m@@@@@@@@!!');
                        self.form = data.datas;
                        self.checkYearExt(time);

                        let road = 'showimage?disk=duties&subjection=' + data.datas.du_road;
                        self.filelist.url = road;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            onSubmit(form,year1,year2) {
                form.du_year_num = year1+","+year2;
                if(form.teacher_name == '') {
                    this.$message.error('老师姓名不能为空');
                    return
                }else if(form.du_academic == ''){
                    this.$message.error('老师职称不能为空');
                    return
                }else if(form.du_education == '') {
                    this.$message.error('老师学历不能为空');
                    return
                }else if(form.du_degree == '') {
                    this.$message.error('老师学位不能为空');
                    return
                }else if(form.du_age == '') {
                    this.$message.error('老师年龄不能为空');
                    return
                }else if(form.du_name == '') {
                    this.$message.error('担任学术团体名称不能为空');
                    return
                }else if(form.du_duty == '') {
                    this.$message.error('老师所任职务不能为空');
                    return
                }this.$refs['form'].validate((valid) => {
                    var d = form.project_year;
                    form.project_year = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addDutiesData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '修改成功',
                                    type: 'success'
                                });
                                this.$router.push({path: '/duties'});
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: '修改失败',
                                    duration: 2000,
                                });
                            }
                        })
                        vue.$refs.pic_file.submit();
                    } else {
                        console.log('error submit!!');
                        return false
                    }
                })
            },
            addDutiesData(data) {
                return axios({
                    method: 'post',
                    url: 'updateduties',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
//            checkFileExt(filename){
//                if(filename == '') {
//                    this.$message.error('上传文件不能为空');
//                }
//                var flag = false; //状态
//                var arr = ["pdf"];
//                //取出上传文件的扩展名
//                console.log(filename);
//                var index = filename.lastIndexOf(".");
//                var ext = filename.substr(index+1);
//                //循环比较
//                for(var i=0;i<arr.length;i++){
//                    if(ext == arr[i]){
//                        flag = true;
//                        break;
//                    }
//                }
//                if(!flag){
//                    this.$message.error('请上传PDF');
//                }
//            },
            checkYearExt(time){
                let a = time.split(',');
//                console.log(a);
                this.year1 = a[0];
                this.year2 = a[1];
//                console.log(this.year1);
//                console.log(this.year2);
            },
        },
        mounted() {
            this.getDutiesData();
        }
    }

</script>