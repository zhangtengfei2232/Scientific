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
                <div class="demo" v-show="picType">
                    <img :src="filelist" alt="无法加载" style="width:100px">
                </div>
            <el-form-item label="图注">
                <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple
                        :file-list="filelists"
                        ref="le_img_road"
                        :auto-upload="false"
                        :before-upload="fileZufil">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button><router-link to="/lecture">取消</router-link></el-button>
                </el-form-item>
                <div class="demo" v-show="picTypes">
                    <thead>
                    <li v-for="(index,items) in filelists" v-bind:key="items">
                        <img :src="items.url" alt="无法加载">
                        <el-button type="primary" @click="deletePic(items)">保存修改</el-button>
                    </li>
                    </thead>
                </div>
                <el-form-item label="图片">
                    <el-upload
                            ref="le_image"
                            action="#"
                            :before-upload="filePicfil"
                            :on-preview="handlePreview"
                            :on-remove="handleRemove"
                            :auto-upload="false"
                            :limit="1">
                        <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUploads">上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                    </el-upload>
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
                le_id:'',
                le_image:[],
                le_img_road:'',
                picType:false,
                picTypes:false,
                Bcode:false,
                multiple: true,
                dataForm: new FormData(),
                dataFile: new FormData(),
                EditLectureData: {},
                filelists:[],
                filelist: '',
                form: {
                    le_id:'',
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
            getEditLectureData() {
                let self = this;
                let le_id = self.$route.params.le_id;
                axios.get("selectlecture?le_id="+le_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.EditLectureData = data.datas;
                        self.form = data.datas.lecture_information;
                        if(data.datas.lecture_information.le_img_road == ''){
                            self.picType=false;
                        }else{
                            self.picType=true;
                            self.filelist = 'showfile?disk=lecture&subjection=' + data.datas.lecture_information.le_img_road;
                        }
                        let image = data.datas.image;
                        if(image.length !== 0){
                            self.picTypes = true;
                            self.filelists = 'showfile?disk=lecture&subjection=' + image;
                        }
//                        self.filelists.url='../../storage/app/data/lecture/'+data.datas.le_img_road;
//                        let image = data.datas.lecture_information.le_image;
//                        if(image !== ''){
//                            self.picType = true;
//                            self.filelists = 'showfile?disk=holdmeet&subjection=' + image;
//                        }
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            },
            submitUploads() {
                this.$refs.le_img_road.submit();
            },
            handleRemove(file, fileList) {
//                console.log(file, fileList);
            },
            handlePreview(files) {
//                console.log(file);
            },
            fileZufil(file){
                this.dataForm.append('le_img_road', file);
                return false;
            },
            filePicfil(files){
                console.log(files,'-you---======');
                if(this.Bcode == true){
//
                    this.dataFile.append('le_image', files);
                    let id = this.form.le_id;
                    this.sendfile(this.dataFile);
                    this.$refs.le_image.submit();
                }else{
                    this.$message.error('请先添加数据信息');
                    return false
                }
            },
            sendfile(dataFile) {
                this.addBookFile(dataFile,id).then(res => {
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
            addBookFile(data,id){
                return axios({
                    method: 'post',
                    url: 'addLectureImages',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data,
                    le_id:id
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
                        console.log(vue.form,"修改+++++++++++++");
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
                        vue.$refs.le_img_road.submit();
//                        vue.$refs.le_image.submit();
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