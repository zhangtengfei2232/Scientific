<template>
    <div class="information">
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
                            :auto-upload="false"
                            drag
                            action="#"
                            ref="schfile_file"
                            :before-upload="fileProfil"
                            :file-list="filelists"
                            multiple>
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
    .information{
        width: 75%;
        float: left;
    }
    .add{
        width: 80%;
        margin: 35px 0 0 35px;
    }
</style>

<script>
    export default {
        data() {
            return {
                schoolFleData:{},
                filelists: [{url:''}],
                schfile_file:'',
                dataForm: new FormData(),
                form: {
                    schfile_name: '',
                    schfile_num: '',
                    schfile_down_time: '',
                }
            }
        },
        methods: {
            getSchoolFileData() {
                let self = this;
                let schfile_id = self.$route.params.schfile_id;
                axios.get("selectschoolfile?schfile_id=" + schfile_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.schoolFleData = data.datas;
                        self.form = data.datas;
                        self.schfile_road = 'showfile?disk=project&subjection=' + data.datas.schfile_road;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            fileProfil(file){
                if(file !== ''){
                    this.dataForm.append('schfile_file', file);
                    return false;
                }else{
                    this.$message.error('文件不能为空');                    
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
                }this.$refs['form'].validate((valid) => {
                        let vue = this;
                        if (valid) {
                            jQuery.each(vue.form,function(i,val){
                                vue.dataForm.append(i,val);
                            });
                            vue.addSchoolFileData(vue.dataForm).then(res => {
                                var data = res.data;
                                if (data.code == 0) {
                                    vue.$message({
                                        message: '修改成功',
                                        type: 'success'
                                    });
                                    this.$router.push({path: '/schoolfile'});
                                } else { 
                                    vue.$notify({
                                        type: 'error',
                                        message: '修改失败',
                                        duration: 2000,
                                    });
                                }
                            })
                            vue.$refs.pro_file.submit();
                        } else {
                            console.log('error submit!!')
                            return false
                        }
                    })
            },
            addSchoolFileData(data) {
                return axios({
                    method: 'post',
                    url: 'updateschoolfile',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
        },
        mounted() {
            this.getSchoolFileData();
        }
    }
</script>