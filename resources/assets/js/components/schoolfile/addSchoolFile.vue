<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="校发文件名称">
                    <el-input v-model="form.schfile_name"></el-input>
                </el-form-item>
                <el-form-item label="校发文件编号">
                    <el-input v-model="form.schfile_num"></el-input>
                </el-form-item>
                <el-form-item label="文件下发时间">
                    <el-col :span="15">
                        <el-date-picker 
                            type="date" 
                            placeholder="选择日期" 
                            v-model="form.schfile_down_time" 
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="上传文件pdf">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        :limit="1"
                        ref="schfile_file"
                        :before-upload="fileProfil"
                        :on-preview="handlePreview"
                        accept="pdf"
                        multiple
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
                school:false,
                schoolFleData:{},
                schfile_road:'',
                dataForm: new FormData(),
                form: {
                    schfile_name: '',
                    schfile_num: '',
                    schfile_down_time: '',
                }
            }
        },
        methods: {
            fileProfil(file){
                if(file !== ''){
                    this.school=true,
                    this.dataForm.append('schfile_road', file);
                    return false;
                }else{
                    this.$message.error('pdf文件不能为空');
                    return                    
                }
            },
            handlePreview(file) {
                console.log(file);
                this.checkFileExt(file.name);
            },
            checkFileExt(filename){
                if(filename == '') {
                    this.$message.error('上传文件不能为空');
                }
                var flag = false; //状态
                var arr = ["pdf"];
                //取出上传文件的扩展名
                console.log(filename);
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
                if(form.schfile_name == '') {
                    this.$message.error('校发文件名称不能为空');
                    return
                }else if(form.schfile_num == ''){
                    this.$message.error('校发文件编号不能为空');
                    return
                }else if(form.schfile_down_time == '') {
                    this.$message.error('文件下发时间不能为空');
                    return
                }
                this.$refs['form'].validate((valid) => {
                        let vue = this;
                        if (valid) {
                            jQuery.each(vue.form,function(i,val){
                                vue.dataForm.append(i,val);
                            });
                            vue.addSchoolFileData(vue.dataForm).then(res => {
                                var data = res.data;
                                if(this.school == false){
                                    this.$message.error('pdf文件不能为空');
                                    return 
                                }
                                if (data.code == 0) {
                                    vue.$message({
                                        message: '添加成功',
                                        type: 'success'
                                    });
                                    this.$router.push({path: '/schoolfile'});
                                } else { 
                                    vue.$notify({
                                        type: 'error',
                                        message: data.message,
                                        duration: 2000,
                                    });
                                }
                            })
                            vue.$refs.schfile_road.submit();
                        } else {
                            console.log('error submit!!')
                            return false
                        }
                    })
            },
            addSchoolFileData(data) {
                return axios({
                    method: 'post',
                    url: 'addschoolfile',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
        }
    }
</script>