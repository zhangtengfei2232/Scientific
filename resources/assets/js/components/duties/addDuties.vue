<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="125px">
                <!--<el-form-item label="老师工号">-->
                    <!--<el-input v-model="form.teacher_id" placeholder="请输入姓名"></el-input>-->
                <!--</el-form-item>-->
                <el-form-item label="老师姓名">
                    <el-input v-model="form.teacher_name" placeholder="请输入姓名" maxlength="15"></el-input>
                </el-form-item>
                <el-form-item label="职称">
                    <el-select v-model="form.du_academic" placeholder="请选择职称">
                        <el-option label="教授" value="0"></el-option>
                        <el-option label="副教授" value="1"></el-option>
                        <el-option label="讲师" value="2"></el-option>
                        <el-option label="助教" value="3"></el-option>
                        <el-option label="高级实验师" value="4"></el-option>
                        <el-option label="实验师" value="5"></el-option>
                        <el-option label="助理实验师" value="6"></el-option>
                    </el-select>
                </el-form-item>
            <el-form-item label="学历">
                <el-select v-model="form.du_education" placeholder="请选择学历">
                    <el-option label="大专" value="0"></el-option>
                    <el-option label="研究生" value="1"></el-option>
                    <el-option label="本科" value="2"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学位">
                <el-select v-model="form.du_degree" placeholder="请选择学位">
                    <el-option label="硕士" value="0"></el-option>
                    <el-option label="博士" value="1"></el-option>
                    <el-option label="学士" value="2"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="年龄">
                <el-input v-model="form.du_age" placeholder="请输入您的年龄(数字)" maxlength="3"></el-input>
            </el-form-item>

            <el-form-item label="担任学术团体名称">
                <el-input v-model="form.du_name" placeholder="请输入担任学术团体名称" maxlength="50" style="width: 480px;"></el-input>
                <!--<el-select v-model="form.level" placeholder="担任学术团体级别" style="width: 200px;">-->
                    <!--<el-option label="省级" value="1"></el-option>-->
                    <!--<el-option label="国家级" value="2"></el-option>-->
                    <!--<el-option label="国际级" value="3"></el-option>-->
                <!--</el-select>-->
            </el-form-item>

            <el-form-item label="所任职务">
                <el-input v-model="form.du_duty" placeholder="请输入所任职务" maxlength="20"></el-input>
            </el-form-item>
            <el-form-item label="担任职务年限">
                <el-date-picker
                        v-model="year1"
                        type="date"
                        format="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"
                        placeholder="选择日期">
                </el-date-picker>
                <span>-</span>
                <el-date-picker
                        v-model="year2"
                        type="date"
                        format="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"
                        placeholder="选择日期">
                </el-date-picker>
            </el-form-item>
            <el-form-item label="备注">
                <el-input type="textarea" alt="无法加载" v-model="form.du_remark"></el-input>
            </el-form-item>
            <el-form-item label="证书图片">
                <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple
                        ref="du_road"
                        :before-upload="fileProfil"
                        :auto-upload="false"
                        list-type="picture">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit(form,year1,year2)">立即添加</el-button>
                <el-button><router-link to="/duties">取消</router-link></el-button>
            </el-form-item>
        </el-form>
        </div>
    </div>
</template>

<style scoped>
    .contents{
        width:80%;
       float: left;
    }
    .add{
        margin: 35px 0 0 35px;
    }
    /*组件*/
    .el-form{
        width:58%;
        margin-top: 40px;
        margin-left: 150px;
    }
</style>
<script>
    export default {
        data() {
            return {
                dataForm: new FormData(),
                du_road: '',
                year1:'',
                year2:'',
                form: {
                    teacher_name:'',
                    du_academic: '',
                    du_education: '',
                    du_degree: '',
                    du_age: '',
                    du_name: '',
                    du_duty: '',
                    du_year_num: '',
                    year: '',
//                    date: '',
//                    delivery: false,
                    type: [],
                    du_remark: '',
                }
            }
        },
        methods:
                {
                fileProfil(file){
                    this.dataForm.append('du_road', file);
                    return false;
                },
                onSubmit(form,year1,year2) {
                    let vue = this;
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
                        this.$message.error('老师担任职务年限不能为空');
                        return
                    }else if(year2 == '') {
                        this.$message.error('老师担任职务年限不能为空');
                        return
                    }
                    this.$refs['form'].validate((valid) => {
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
                            vue.$refs.du_road.submit();
                        } else {
                            console.log('error submit!!');
                            return false
                        }
                    })
                },
                addDutiesData(data) {
                    return axios({
                        method: 'post',
                        url: 'addduties',
                        headers: {'Content-Type': 'multipart/form-data'},
                        timeout: 20000,
                        data: data
                    });
                },
            }
        }

</script>