<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
            <el-form-item label="姓名">
                <el-input v-model="form.teacher_name" placeholder="请输入姓名" maxlength="15"></el-input>
            </el-form-item>
            <el-form-item label="职称" prop="du_academic">
                <el-select v-model="form.du_academic" placeholder="请选择职称">
                    <el-option label="教授" value="0"></el-option>
                    <el-option label="副教授" value="1"></el-option>
                    <el-option label="讲师" value="2"></el-option>
                    <el-option label="助教" value="3"></el-option>
                    <el-option label="高级实验师" value="4"></el-option>
                    <el-option label="实验师" value="5"></el-option>
                    <el-option label="助理实验师" value="6"></el-option>
                    <el-option label="其他" value="7"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学历" prop="du_education">
                <el-select v-model="form.du_education" placeholder="请选择学历">
                    <el-option label="大专" value="0"></el-option>
                    <el-option label="研究生" value="1"></el-option>
                    <el-option label="本科" value="2"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学位" prop="du_degree">
                <el-select v-model="form.du_degree" placeholder="请选择学位">
                    <el-option label="硕士" value="0"></el-option>
                    <el-option label="博士" value="1"></el-option>
                    <el-option label="学士" value="2"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="年龄">
                <el-input v-model="form.du_age" maxlength="3" placeholder="请输入您的年龄(数字)"></el-input>
            </el-form-item>

            <el-form-item label="担任学术团体名称">
                <el-input v-model="form.du_name" placeholder="请输入担任学术团体名称" maxlength="50" style="width:440px;"></el-input>
            </el-form-item>

            <el-form-item label="所任职务">
                <el-input v-model="form.du_duty" placeholder="请输入所任职务" maxlength="20"></el-input>
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
                <div class="demo" v-show="type1">
                    <img :src="filelists" alt="无法加载" style="width:100px">
                </div>
            <el-form-item label="证书图片">
                <el-upload
                        class="upload-demo"
                        :auto-upload="false"
                        drag
                        action="#"
                        ref="du_road"
                        :on-change="fileProfil"
                        multiple
                        :limit="1"
                        list-type="picture">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit(form,year1,year2)">立即修改</el-button>
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
        width: 73%;
        margin: 35px 0 0 35px;
    }
    .demo{
        margin: 10px 0 10px 30%;
    }
</style>
<script>
    export default {
        data() {
            return {
                type1:false,
                DutiesData:{},
                du_road:'',
                dataForm: new FormData(),
                dataFile: new FormData(),
                filelists: '',
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
                    du_road:'',
                },
            }
        },
        methods: {
            fileProfil(file){
                this.dataForm.append('du_road', file.raw);
                return false;
            },
            getDutiesData() {
                let self = this;
                let du_id = self.$route.params.du_id;
                axios.get("selectduties?du_id="+du_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.DutiesData = data.datas;
                        self.DutiesData.du_academic = String(data.datas.du_academic);
                        self.DutiesData.du_education = String(data.datas.du_education);
                        self.DutiesData.du_degree = String(data.datas.du_degree);
                        let time = data.datas.du_year_num;
                        self.checkYearExt(time);
                        self.form = data.datas;
                        if(data.datas.du_road !== ''){
                            let road = 'showfile?disk=duties&subjection=' + data.datas.du_road;
                            self.type1=true;
                            self.filelists = road;
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
                }else if(year1 == '') {
                    this.$message.error('担任职务年限不能为空');
                    return
                }else if(year2 == '') {
                    this.$message.error('担任职务年限不能为空');
                    return
                }this.$refs['form'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addDutiesData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
                                this.$router.push({path: '/duties'});
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        });
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
            checkYearExt(time){
                let a = time.split(',');
                this.year1 = a[0];
                this.year2 = a[1];
            },

        },
        mounted() {
            this.getDutiesData();
        }
    }

</script>