<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="协议名称">
                    <el-input v-model="form.agree_name"></el-input>
                </el-form-item>
                <el-form-item label="合作单位">
                    <el-input v-model="form.agree_cooperate_unit"></el-input>
                </el-form-item>
                <el-form-item label="协议时间">
                    <el-col :span="15">
                        <el-date-picker 
                        type="date"
                        placeholder="选择日期" 
                        v-model="form.agree_time" 
                        style="width: 100%;"
                        format="yyyy 年 MM 月 dd 日"
                        value-format="timestamp"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="协议附件pdf">
                    <el-upload
                            class="upload-demo"
                            :auto-upload="false"
                            drag
                            action="#"
                            ref="agree_road"
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
                AgreementeDitData: {},
                filelists: [{url:''}],
                agree_road:'',
                school:false,
                dataForm: new FormData(),
                form: {
                    agree_name: '',
                    agree_cooperate_unit: '',
                    agree_time: '',
                }
            }
        },
        methods: {
            getAgreementeDitData() {
                let self = this;
                let agree_id = self.$route.params.agree_id;
                axios.get("selectagreement?agree_id=" + agree_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AgreementeDitData = data.datas;
                        self.form = data.datas;
                        console.log(self.form);
                        self.filelists.url = 'showfile?disk=agreement&subjection=' + data.datas.agree_road;
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
                    this.school=true;
                    this.dataForm.append('agree_road', file);
                    return false;
                }else{
                    this.$message.error('文件不能为空');
                    return
                }
            },
            onSubmit(form) {
                if(form.agree_name == '') {
                    this.$message.error('协议名称不能为空');
                    return
                }else if(form.agree_cooperate_unit == ''){
                    this.$message.error('合作单位不能为空');
                    return
                }else if(form.agree_time == '') {
                    this.$message.error('协议时间不能为空');
                    return
                }this.$refs['form'].validate((valid) => {
                        let vue = this;
                        if (valid) {
                            jQuery.each(vue.form,function(i,val){
                                vue.dataForm.append(i,val);
                            });
                            vue.addAgreementData(vue.dataForm).then(res => {
                                var data = res.data;
                                if(vue.school == false){
                                    vue.$message.error('pdf文件不能为空');
                                    return 
                                }
                                if (data.code == 0) {
                                    vue.$message({
                                        message: '修改成功',
                                        type: 'success'
                                    });
                                    this.$router.push({path: '/agreement'});
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
            addAgreementData(data) {
                return axios({
                    method: 'post',
                    url: 'updateagreement',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
        },
        mounted() {
            this.getAgreementeDitData();
        }
    }
</script>