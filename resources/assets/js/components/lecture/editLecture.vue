<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="90px">
            <el-form-item label="专家姓名">
                <el-input v-model="form.le_expert_name" placeholder="请输入专家姓名"></el-input>
            </el-form-item>
            <el-form-item label="专家级别">
                <el-select v-model="form.le_expert_level" placeholder="请选择专家级别">
                    <el-option label="院士" value="1"></el-option>
                    <el-option label="博导" value="2"></el-option>
                    <el-option label="国务院学位委员会委员" value="3"></el-option>
                    <el-option label="教授" value="4"></el-option>
                    <el-option label="其他" value="5"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="报告名称">
                <el-input v-model="form.le_report_name" placeholder="请输入报告名称"></el-input>
            </el-form-item>
            <el-form-item label="邀请/未邀请">
                <el-radio-group v-model="form.le_invite_status">
                    <el-radio :label="1">邀请</el-radio>
                    <el-radio :label="2">未邀请</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="邀请单位">
                <el-input v-model="form.le_invite_unit" placeholder="请输入邀请单位">
                </el-input>
            </el-form-item>
            <el-form-item label="讲学时间">
                <el-col :span="15">
                    <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            v-model="form.le_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp">
                    </el-date-picker>
                </el-col>
            </el-form-item>
                <el-form-item label="图片">
                    <el-upload
                            class="upload-demo"
                            drag
                            action="#"
                            ref="pic_file"
                            :before-upload="filePicfil"
                            :file-list="filelist"
                            multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
            <el-form-item label="图注">
                <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple
                        :file-list="filelists"
                        ref="zu_file"
                        :before-upload="fileZufil">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                <el-button><router-link to="/lecture">取消</router-link></el-button>
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
    /*组件*/
    .el-form{
        width:62%;
        margin-top: 40px;
        margin-left: 150px;
    }
</style>
<script>
    export default {
        data() {
            return {
                pic_file:'',
                zu_file:'',
                Bcode:false,
                multiple: true,
                dataForm: new FormData(),
                dataFile: new FormData(),
                EditLectureData: {},
                filelists:[],
                filelist: [{url:''}],
                form: {
                    le_expert_name:'',
                    le_expert_level:'',
                    le_report_name:'',
                    le_invite_status:'',
                    le_invite_unit:'',
                    le_time: '',
                    delivery: false,
                    type: [],
                }
            }
        },
        methods: {
            filePicfil(file){
                this.dataForm.append('pic_file', file);
                return false;
            },
            fileZufil(file){
                if(this.Bcode == true){
                    this.dataForm.append('zu_file', file);
                    this.sendfile(files);
                    this.$refs.zu_file.submit();
                }else{
                    this.$message.error('请先添加数据信息');
                    return false
                }
            },
            sendfile(file) {
                this.addBookFile(vue.dataFile).then(res => {
                    var data = res.data;
                    if (data.code == 0) {
                        vue.$message({
                            message: '修改成功',
                            type: 'success'
                        });
                    } else {
                        vue.$notify({
                            type: 'error',
                            message: '修改失败',
                            duration: 2000,
                        });
                    }
                })
            },
            addBookFile(data){
                return axios({
                    method: 'post',
                    url: 'addLectureImages',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
            getEditLectureData() {
                let self = this;
                let le_id = self.$route.params.le_id;
                axios.get("selectlecture?le_id="+le_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.EditLectureData = data.datas;
                        self.form = data.datas.lecture_information;
//                        self.filelists.url='../../storage/app/data/lecture/'+data.datas.le_img_road
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            onSubmit(form) {
//                console.log(form,"修改成功啦+++++++++++++");
                if(form.le_expert_name == '') {
                    this.$message.error('专家姓名不能为空');
                    return
                }else if(form.le_expert_level == ''){
                    this.$message.error('专家级别不能为空');
                    return
                }else if(form.le_report_name == '') {
                    this.$message.error('报告名称不能为空');
                    return
                }else if(form.le_invite_status == '') {
                    this.$message.error('邀请状态不能为空');
                    return
                }else if(form.le_invite_unit == '') {
                    this.$message.error('邀请单位不能为空');
                    return
                }else if(form.le_time == '') {
                    this.$message.error('讲学时间不能为空');
                    return
                }this.$refs['form'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addLectureData(vue.dataForm).then(res => {
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
                                    message: data.msg,
                                    duration: 2000,
                                });
                            }
                        })
//                        vue.$refs.zu_file.submit();
                        vue.$refs.pic_file.submit();
                    } else {
                        console.log('error submit!!');
                        return false
                    }
                })
            },
            addLectureData(data) {
                return axios({
                    method: 'post',
                    url: 'addLecture',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
        },
        mounted() {
            this.getEditLectureData();
        }
    }
</script>