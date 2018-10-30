<template>
    <div class="information">
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
                <el-form-item label="成果封面">
                    <el-upload
                        class="upload-demo"
                        drag
                        ref="pat_pics"
                        :before-upload="filePatpics"
                        :file-list="filelists"
                        action="#"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="成果鉴定证书图片">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple
                        :file-list="filelist"
                        ref="pat_pic"
                        :before-upload="filePatpic"
                        :auto-upload="false">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">立即修改</el-button>
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
            AppraisalSelfData: {},
            dataForm: new FormData(),
            dataFile: new FormData(),
            Bcode:false,
            filelist: [{url:''}],
            filelists: [{url:''}],
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
            },
        }
    },

    methods: {
        getAppraisalSelfData() {
                let self = this;
                let ap_id = self.$route.params.ap_id;
                axios.get("selectappraisal?ap_id="+ap_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AppraisalSelfData = data.datas;
                        self.form = data.datas;
                        self.filelist.url = 'showimage?disk=appraisal&subjection=' + data.datas.pro_road;
                        self.filelists.url = 'showimage?disk=appraisal&subjection=' + data.datas.ap_cover_road; 
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,         
                        });
                    }
                });
        },
        filePatpic(file){
            if(this.Bcode == true){
                this.dataFile.append('pat_pic', file);
                this.sendfile(files,1);
                this.$refs.pat_pic.submit();
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }  
        },
        filePatpics(files){
            if(this.Bcode == true){
                this.dataFile.append('pat_pic', files);
                this.sendfile(files,2);
                this.$refs.pat_pics.submit();
                this.$router.push({path: '/appraisal'});
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
                    });A
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
                url: '',
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
                            var data = response.data;
                            if (data.code == 0) {
                                this.Bcode = true;
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
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
        },
        addAppraisalData(data) {
            return axios({
                method: 'post',
                url: 'updateappraisal',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getAppraisalSelfData();
    }
}
</script>
