<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="鉴定第一作者">
                    <el-input v-model="form.ap_first_author"></el-input>
                </el-form-item>
                <el-form-item label="全部完成（参与）人">
                    <el-input v-model="form.ap_all_author"></el-input>
                </el-form-item>
                <el-form-item label="鉴定成果名称">
                    <el-input v-model="form.ap_res_name"></el-input>
                </el-form-item>
                <el-form-item label="鉴定形式">
                    <el-input v-model="form.ap_form"></el-input>
                </el-form-item> 
                <el-form-item label="鉴定编号">
                    <el-input v-model="form.ap_num"></el-input>
                </el-form-item>
                <el-form-item label="鉴定结论">
                    <el-input v-model="form.ap_conclusion"></el-input>
                </el-form-item>
                 <el-form-item label="鉴定时间">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期" 
                            v-model="form.ap_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                 <el-form-item label="鉴定级别">
                    <el-select v-model="form.ap_level" placeholder="请选择类别">
                        <el-option label="国家级" value="1"></el-option>
                        <el-option label="省级" value="2"></el-option>
                        <el-option label="厅级" value="3"></el-option>
                        <el-option label="校级" value="4"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.ap_integral"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.ap_remarks"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                <el-form-item label="成果封面">
                    <el-upload
                        class="upload-demo"
                        ref="ap_cover_road"
                        action="#"
                        :before-upload="fileProfil"
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :auto-upload="false"
                        :limit="1"
                        list-type="picture">
                        <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="成果鉴定证书图片">
                    <el-upload
                        class="upload-demo"
                        ref="ap_road"
                        action="#"
                        :before-upload="fileProfils"
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :auto-upload="false"
                        :limit="1"
                        list-type="picture">
                        <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUploads">上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                    </el-upload>
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
            ap_cover_road: '',
            ap_road: '',
            dataForm: new FormData(),
            dataFile: new FormData(),
            Bcode:false,
            form: {
                ap_first_author: '',
                ap_all_author: '',
                ap_res_name: '',
                ap_form: '',
                ap_num : '',
                ap_conclusion: '',
                ap_time: '',
                ap_level: '',
                ap_integral: '',
                ap_remarks: '',
            }
        }
    },
    methods: {
        submitUpload() {
            this.$refs.ap_cover_road.submit();
        },
        submitUploads() {
            this.$refs.ap_road.submit();
        },
        handleRemove(file, fileList) {
            console.log(file, fileList);
        },
        handlePreview(file) {
            console.log(file);
        },
        fileProfil(file){
            if(this.Bcode == true){
                this.dataFile.append('ap_cover_road', file);
                let id = this.form.ap_id;
                this.sendfile(dataFile,id);
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }  
        },
        fileProfils(files){
            if(this.Bcode == true){
                this.dataFile.append('ap_road', files);
                let id = this.form.ap_id;
                this.sendfile(dataFile,id);
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }
        },
        sendfile(dataFile,id) {
            this.addBookFile(vue.dataFile,id).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    vue.$message({
                        message: '添加成功',
                        type: 'success'
                    });
                } else {
                    vue.$notify({
                        type: 'error',
                        message: '添加失败',
                        duration: 2000,
                    });
                }
            })  
        },
        addBookFile(data,id){
             return axios({
                method: 'post',
                url: 'addappraisalimage',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
        onSubmit(form) {
            let vue = this;
            if(form.ap_first_author == '') {
                this.$message.error('第一发明人不能为空');
                return
            }else if(form.ap_all_author == ''){
                this.$message.error('全部发明人不能为空');
                return
            }else if(form.ap_res_name == '') {
                this.$message.error('鉴定成果名称不能为空');
                return
            }else if(form.ap_form == '') {
                this.$message.error('鉴定形式不能为空');
                return
            }else if(form.pa_imple_situ == '') {
                this.$message.error('鉴定编号不能为空');
                return
            }else if(form.ap_conclusion == '') {
                this.$message.error('鉴定结论不能为空');
                return
            }else if(form.ap_time == '') {
                this.$message.error('鉴定时间不能为空');
                return
            }else if(form.ap_level == '') {
                this.$message.error('鉴定级别不能为空');
                return
            }else if(form.ap_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.ap_remarks == '') {
                this.$message.error('备注不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                if (valid) {
                    jQuery.each(vue.form,function(i,val){
                        vue.dataForm.append(i,val);
                    });
                    vue.addAppraisalData(vue.dataForm).then(res => {
                        var data = res.data;
                        if (data.code == 0) {
                            this.Bcode = true;
                            vue.$message({
                                message: '添加成功',
                                type: 'success'
                            });
                        } else {
                            vue.$notify({
                                type: 'error',
                                message: '添加失败',
                                duration: 2000,
                            });
                        }
                    })
                    vue.$refs.pat_pic.submit()
                } else {
                    console.log('error submit!!')
                    return false
                }
            })
        },
        addAppraisalData(data) {
            return axios({
                method: 'post',
                url: 'addappraisal',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    }
  }
</script>