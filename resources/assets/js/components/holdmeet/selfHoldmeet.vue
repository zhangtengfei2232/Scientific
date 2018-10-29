<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="学术会议名称">
                    <el-input v-model="form.ho_name"></el-input>
                </el-form-item>
                <el-form-item label="有无论文集">
                    <el-radio-group v-model="form.ho_art_status">
                        <el-radio :label="1" style="margin:10px">有</el-radio>
                        <el-radio :label="2" style="margin:10px">无</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="参与人数">
                    <el-input v-model="form.people_num"></el-input>
                </el-form-item>
                <el-form-item label="主办单位">
                    <el-input v-model="form.ho_unit"></el-input>
                </el-form-item>
                <el-form-item label="承办单位">
                    <el-input v-model="form.undertake_unit"></el-input>
                </el-form-item> 
                <el-form-item label="会议级别">
                    <el-select v-model="form.ho_level" placeholder="请选择类别">
                        <el-option label="省级" value="1"></el-option>
                        <el-option label="大区级" value="2"></el-option>
                        <el-option label="国家级" value="3"></el-option>
                        <el-option label="国际会议" value="4"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="会议时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.ho_time" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="会议图注">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        ref="ho_file"
                        :before-upload="fileProfil"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="餐会图注">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        ref="ho_files"
                        :before-upload="fileProfils"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">立即创建</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<style>
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
            HoldmeetSelfData: {},
            dataForm: new FormData(),
            ho_file: '',
            ho_files: '',
            fileList:'',
            fileLists:'',
            form: {
                ho_name: '',
                ho_art_status: '',
                people_num: '',
                ho_unit: '',
                undertake_unit: '',
                ho_level: '',
                ho_time: '',
            },
        }
    },
    methods: {
        getHoldmeetSelfData() {
            let self = this;
            let ho_id = self.$route.params.ho_id;
            axios.get("selectholdmeet?ho_id="+ho_id).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.HoldmeetSelfData = data.datas;
                    self.form = data.datas;
                    console.log(data.datas);
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
            this.dataForm.append('ho_file', file);
            return false;
        },
        fileProfils(file){
            this.dataForm.append('ho_files', file);
            return false;
        },
       onSubmit(form) {
            let vue = this;
            if(form.ho_name == '') {
                this.$message.error('会议名称不能为空');
            }else if(form.ho_art_status == ''){
                this.$message.error('有无论文集不能为空');
            }else if(form.people_num == '') {
                this.$message.error('参加人数不能为空');
            }else if(form.ho_unit == '') {
                this.$message.error('主办单位不能为空');
            }else if(form.undertake_unit == '') {
                this.$message.error('承办单位不能为空');
            }else if(form.ho_level == '') {
                this.$message.error('会议级别不能为空');
            }else if(form.ho_time == '') {
                this.$message.error('会议时间不能为空');
            }
            this.$refs['form'].validate((valid) => {
                var d = form.ho_time;     
                form.ho_time = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addPatentData(vue.dataForm).then(res => {
                            var data = response.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '添加成功',
                                    type: 'success'
                                });
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.msg,
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
        addHoldmeetData(data) {
            return axios({
                method: 'post',
                url: 'updateholdmeet',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getHoldmeetSelfData();
    }
}
</script>
