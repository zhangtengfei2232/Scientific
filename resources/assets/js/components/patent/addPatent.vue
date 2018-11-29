<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="专利权人">
                    <el-input v-model="form.patent_person" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="第一发明人">
                    <el-input v-model="form.first_inventor" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="全部发明人">
                    <el-input v-model="form.pa_all_author" maxlength="200"></el-input>
                </el-form-item>
                 <el-form-item label="专利类型">
                    <el-select v-model="form.pa_type" placeholder="请选择类别">
                        <el-option label="发明专利" value="0"></el-option>
                        <el-option label="实用新型专利" value="1"></el-option>
                        <el-option label="外观设计专利" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="专利名称">
                    <el-input v-model="form.pa_name" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="实施情况">
                    <el-select v-model="form.pa_imple_situ" placeholder="请选择类别">
                        <el-option label="授权" value="0"></el-option>
                        <el-option label="受理" value="1"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="授权编号或申请号">
                    <el-input v-model="form.author_num" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="授权证书编号">
                    <el-input v-model="form.author_cert_num" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="授权公告日或受理日期">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            v-model="form.author_notic_day"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.pa_integral" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.pa_remarks"></el-input>
                </el-form-item>
                <el-form-item label="专利图片">
                    <el-upload
                        class="upload-demo"
                        drag
                        action=""
                        multiple
                        ref="pa_road"
                        :limit="1"
                        :before-upload="filePatpic"
                        :auto-upload="false">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">立即创建</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<style scoped>
    .contents{
        width: 75%;
        float: left;
    }
    .add{
        width: 73%;
        margin: 35px 0 0 35px;
    }
</style>


<script>
  export default {
    data() {
      return {
            pa_road: '',
            dataForm: new FormData(),
            form: {
                patent_person:'',
                first_inventor: '',
                pa_all_author: '',
                pa_type: '',
                pa_name: '',
                pa_imple_situ: '',
                author_num: '',
                author_cert_num: '',
                author_notic_day: '',
                pa_integral: '',
                pa_remarks: '',
            }
        }
    },
    methods: {
        filePatpic(file) {
            this.checkFileExt(file.name);
            this.dataForm.append('pa_road', file);
            return false;
        },
        checkFileExt(filename){
            if(filename == '') {
                this.$message.error('上传文件不能为空');
            }
            var flag = false; //状态
            var arr = ["pdf"];
            //取出上传文件的扩展名
            var index = filename.lastIndexOf(".");
            var ext = filename.substr(index+1);
            //循环比较
            for(var i=0;i<arr.length;i++){
                if(ext == arr[i]){
                    flag = true;
                    break;
                }
            }
            if(!flag){
                this.$message.error('请上传PDF');
            }
        },
        onSubmit(form) {
            if(form.patent_person == '') {
                this.$message.error('专利权人不能为空');
                return
            }else if(form.first_inventor == '') {
                this.$message.error('第一发明人不能为空');
                return
            }else if(form.pa_all_author == ''){
                this.$message.error('全部发明人不能为空');
                return
            }else if(form.pa_type == '') {
                this.$message.error('专利类型不能为空');
                return
            }else if(form.pa_name == '') {
                this.$message.error('专利名称不能为空');
                return
            }else if(form.pa_imple_situ == '') {
                this.$message.error('实施情况不能为空');
                return
            }else if(form.author_num == '') {
                this.$message.error('授权编号或申请号不能为空');
                return
            }else if(form.author_cert_num == '') {
                this.$message.error('授权证书编号不能为空');
                return
            }else if(form.author_notic_day == '') {
                this.$message.error('授权公告日或受理日期不能为空');
                return
            }else if(form.pa_integral == '') {
                this.$message.error('积分不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                let vue = this;
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addPatentData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '添加成功',
                                    type: 'success'
                                });
                                this.$router.push({path: '/patent'});
                            }else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        })
                        vue.$refs.pa_road.submit()
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
        },
        addPatentData(data) {
            return axios({
                method: 'post',
                url: 'addpatent',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    }
  }
</script>
