<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一作者（或主编）">
                    <el-input v-model="form.op_first_author"></el-input>
                </el-form-item>
                <el-form-item label="全部作者">
                    <el-input v-model="form.op_all_author"></el-input>
                </el-form-item>
                <el-form-item label="著作名称">
                    <el-input v-model="form.op_name"></el-input>
                </el-form-item>
                <el-form-item label="编著形式">
                    <el-select v-model="form.op_form_write" placeholder="请选择类别">
                        <el-option label="主编" value="1"></el-option>
                        <el-option label="副主编" value="2"></el-option>
                        <el-option label="参编" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="出版社">
                    <el-input v-model="form.op_publish"></el-input>
                </el-form-item>
                <el-form-item label="出版时间">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期" 
                            v-model="form.op_publish_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="书号">
                    <el-input v-model="form.op_number"></el-input>
                </el-form-item>
                <el-form-item label="总字数（千字）">
                    <el-input v-model="form.op_total_words"></el-input>
                </el-form-item>
                <el-form-item label="本人字数（千字）">
                    <el-input v-model="form.op_self_words"></el-input>
                </el-form-item>
                <el-form-item label="著作类别">
                    <el-select v-model="form.op_cate_work" placeholder="请选择类别">
                        <el-option label="专著" value="1"></el-option>
                        <el-option label="教科书" value="2"></el-option>
                        <el-option label="译著" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.op_integral"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.op_cate_research" placeholder="请选择类别">
                        <el-option label="基础研究" value="1"></el-option>
                        <el-option label="应用研究" value="2"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="学科门类">
                    <el-select v-model="form.op_sub_category" placeholder="请选择学科门类">
                        <el-option label="理学" value="1"></el-option>
                        <el-option label="工学" value="2"></el-option>
                        <el-option label="农学" value="3"></el-option>
                        <el-option label="医学" value="4"></el-option>
                        <el-option label="管理学" value="5"></el-option>
                        <el-option label="马克思主义" value="6"></el-option>
                        <el-option label="哲学" value="7"></el-option>
                        <el-option label="逻辑学" value="8"></el-option>
                        <el-option label="宗教学" value="9"></el-option>
                        <el-option label="语言学" value="10"></el-option>
                        <el-option label="中国文学" value="11"></el-option>
                        <el-option label="外国文学" value="12"></el-option>
                        <el-option label="艺术学" value="13"></el-option>
                        <el-option label="历史学" value="14"></el-option>
                        <el-option label="考古学" value="15"></el-option>
                        <el-option label="经济学" value="16"></el-option>
                        <el-option label="政治学" value="17"></el-option>
                        <el-option label="法学" value="18"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.op_remarks"></el-input>
                </el-form-item>
                <el-form-item label="著作封面">
                    <el-upload
                        drag
                        action="#"
                        ref="bo_file"
                        :limit=1
                        :before-upload="fileProfil"
                        :auto-upload="true">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="版权页图片">
                    <el-upload
                        drag
                        action="#"
                        ref="bo_files"
                        :limit=1
                        :before-upload="fileProfil"
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
            bo_file: "", 
            bo_files: "", 
            dataForm: new FormData(),
            dataFile: new FormData(),
            Bcode:false,
            form: {
                op_first_author: '',
                op_all_author: '',
                op_name: '',
                op_form_write: '',
                op_publish: '',
                op_publish_time: '',
                op_number: '',
                op_total_words: '',
                op_self_words: '',
                op_cate_work: '',
                op_integral: '',  
                op_cate_research: '',
                op_sub_category: '',
                op_remarks: '',
            }
        }
    },
    methods: {
        fileProfil(file){
            if(this.Bcode == true){
                this.dataFile.append('bo_file', file);
                this.sendfile(files,1);
                this.$refs.bo_file.submit();
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }  
        },
        fileProfils(files){
            if(this.Bcode == true){
                this.dataFile.append('bo_files', files);
                this.sendfile(files,2);
                this.$refs.bo_files.submit();
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }
        },
        sendfile(file,m) {
            this.addBookFile(vue.dataFile,m).then(res => {
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
        addBookFile(data,m){
             return axios({
                method: 'post',
                url: 'addopusimage',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
        onSubmit(form) {
            if(form.op_first_author == '') {
                this.$message.error('第一作者（或主编）不能为空');
                return
            }else if(form.op_all_author == ''){
                this.$message.error('全部作者不能为空');
                return
            }else if(form.op_name == '') {
                this.$message.error('著作名称不能为空');
                return
            }else if(form.op_form_write == '') {
                this.$message.error('编著形式不能为空');
                return
            }else if(form.op_publish == '') {
                this.$message.error('出版社不能为空');
                return
            }else if(form.op_publish_time == '') {
                this.$message.error('出版时间不能为空');
                return
            }else if(form.op_number == '') {
                this.$message.error('书号不能为空');
                return
            }else if(form.op_total_words == '') {
                this.$message.error('总字数（千字）不能为空');
                return
            }else if(form.op_self_words == '') {
                this.$message.error('本人字数（千字）不能为空');
                return
            }else if(form.op_cate_work == '') {
                this.$message.error('著作类别不能为空');
                return
            }else if(form.op_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.op_cate_research == '') {
                this.$message.error('研究类别不能为空');
                return
            }else if(form.op_sub_category == '') {
                this.$message.error('学科门类不能为空');
                return
            }else if(form.op_remarks == '') {
                this.$message.error('备注不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                var d = form.op_publish_time;     
                form.op_publish_time = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                let vue = this;
                if (valid) {
                    jQuery.each(vue.form,function(i,val){
                        vue.dataForm.append(i,val);
                    });
                    vue.addBookData(vue.dataForm).then(res => {
                        var data = res.data;
                        if (data.code == 0) {
                            this.Bcode=true;
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
                } else {
                    console.log('error submit!!')
                    return false
                }
            })
        },
        addBookData(data) {
            return axios({
                method: 'post',
                url: 'addopus',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    }
  }
</script>