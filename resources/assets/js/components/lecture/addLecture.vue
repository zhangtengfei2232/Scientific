<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="90px">
            <el-form-item label="专家姓名">
                <el-input v-model="form.le_expert_name" placeholder="请输入专家姓名" maxlength="15"></el-input>
            </el-form-item>
            <el-form-item label="专家级别">
                <el-select v-model="form.le_expert_level" placeholder="请选择专家级别">
                    <el-option label="院士" value="0"></el-option>
                    <el-option label="博导" value="1"></el-option>
                    <el-option label="国务院学位委员会委员" value="2"></el-option>
                    <el-option label="教授" value="3"></el-option>
                    <el-option label="其他" value="4"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="报告名称">
                <el-input v-model="form.le_report_name" placeholder="请输入报告名称" maxlength="30"></el-input>
            </el-form-item>
            <el-form-item label="邀请/未邀请">
                <el-radio-group v-model="form.le_invite_status">
                    <el-radio :label="0">邀请</el-radio>
                    <el-radio :label="1">未邀请</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="邀请单位">
                <el-input v-model="form.le_invite_unit" placeholder="请输入邀请单位" maxlength="20"></el-input>
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
            <el-form-item label="图注">
                <el-upload
                        drag
                        action="#"
                        ref="le_img_road"
                        :on-change="fileZufil"
                        :auto-upload="false"
                        :limit="1"
                        multiple
                        list-type="picture">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit(form)">立即创建</el-button>
                <el-button>取消</el-button>
            </el-form-item>
            <el-form-item label="图片">
                <el-upload
                        ref="le_image"
                        action="#"
                        :on-change="change"
                        :auto-upload="false"
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
                dataForm: new FormData(),
                dataFile: new FormData(),
                Bcode:false,
                multiple:true,
                le_img_road: '',
                le_image: '',
                le_id:0,
                index:0,
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
            change(file) {
                this.dataFile.append(this.index, file.raw);
                this.index++;
            },
            submitUploads() {
                if(this.Bcode == true){
                    let id = this.le_id;
                    this.dataFile.append('le_id', id);
                    this.dataFile.append('is_add_lecture',this.Bcode);
                    this.sendfile(this.dataFile);
                }else{
                    this.$message.error('请先添加数据信息');
                    return false
                }
            },
            fileZufil(file){
                this.dataForm.append('le_img_road', file.raw);
                return false;
            },
            sendfile(dataFile) {
                this.addBookFile(dataFile).then(res => {
                    var data = res.data;
                    if (data.code == 0) {
                        this.$message({
                            message: data.message,
                            type: 'success'
                        });
                        this.$router.push({path: '/lecture'});
                    } else {
                        this.$notify({
                            type: 'error',
                            message: data.message,
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
                    data: data,
                });
            },
            onSubmit(form) {
                let vue = this;
                if(form.le_expert_name == '') {
                    this.$message.error('专家姓名不能为空');
                    return
                }else if(form.le_expert_level == ''){
                    this.$message.error('专家级别不能为空');
                    return
                }else if(form.le_report_name == '') {
                    this.$message.error('报告名称不能为空');
                    return
                }
//                else if(!isNaN(form.le_invite_status)) {
//                    this.$message.error('邀请状态不能为空');
//                    return
//                }
                else if(form.le_invite_unit == '') {
                    this.$message.error('邀请单位不能为空');
                    return
                }else if(form.le_time == '') {
                    this.$message.error('讲学时间不能为空');
                    return
                }
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        jQuery.each(form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addLectureData(vue.dataForm).then(res => {
                            var data = res.data;
                            vue.le_id = res.data.datas;
                            if (data.code == 0) {
                                this.Bcode = true;
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        });
//                        vue.$refs.le_img_road.submit();

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
        }
    }
</script>