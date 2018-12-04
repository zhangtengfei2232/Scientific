<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="协议名称">
                    <el-input v-model="form.agree_name" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="合作单位">
                    <el-input v-model="form.agree_cooperate_unit" maxlength="200"></el-input>
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
                <el-form-item>
                    <el-button type="warning" size="mini" @click="watchPDF()">查看协议</el-button>
                </el-form-item>
                <el-form-item label="协议附件pdf">
                    <el-upload
                            class="upload-demo"
                            :auto-upload="false"
                            drag
                            action="#"
                            :limit="1"
                            ref="agree_road"
                            :before-upload="fileProfil"
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
            watchPDF() {
                let urls =  `showfile?disk=agreement&subjection=${this.agree_road}`;
                window.open(urls, '_blank');
            },
            getAgreementeDitData() {
                let self = this;
                let agree_id = self.$route.params.agree_id;
                axios.get("selectagreement?agree_id=" + agree_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AgreementeDitData = data.datas;
                        self.form = data.datas;
                        self.agree_road = data.datas.agree_road;
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.message,
                            duration: 2000,
                        });
                    }
                });
            },
            fileProfil(file){
                if(file !== ''){
                    this.checkFileExt(file.name);
                    this.school=true;
                    this.dataForm.append('agree_road', file);
                    return false;
                }else{
                    this.$message.error('文件不能为空');
                }
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
                                if (data.code == 0) {
                                    vue.$message({
                                        message: data.message,
                                        type: 'success'
                                    });
                                    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                                        window.location.reload();//页面刷新
                                    },1000);
                                } else {
                                    vue.$notify({
                                        type: 'error',
                                        message: data.message,
                                        duration: 2000,
                                    });
                                }
                            })
                            vue.$refs.agree_road.submit();
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
