<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="参会人">
                    <el-input v-model="form.join_people" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="学术会议名称">
                    <el-input v-model="form.jo_name" maxlength="200"></el-input>
                </el-form-item>
                 <el-form-item label="主办单位">
                    <el-input v-model="form.jo_hold_unit" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="承办单位">
                    <el-input v-model="form.jo_take_unit" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="会议级别">
                    <el-select v-model="form.jo_level" placeholder="请选择类别">
                        <el-option label="省级" value="1"></el-option>
                        <el-option label="大区级" value="2"></el-option>
                        <el-option label="国家级" value="3"></el-option>
                        <el-option label="国际会议" value="4"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="会议时间">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期"
                             v-model="form.jo_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="会议地点">
                    <el-input v-model="form.jo_place" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="提交论文数">
                    <el-input v-model="form.jo_art_num" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="是否被邀大会或分会场报告">
                    <el-input v-model="form.jo_is_invite" maxlength="300"></el-input>
                </el-form-item>
                <el-form-item label="报告题目">
                    <el-input v-model="form.jo_title" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="会议图注">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        ref="jo_graph_inject"
                        :on-change="fileProfil"
                        :auto-upload="false"
                        list-type="picture">
                        <i class="el-icon-upload"
                        show-file-list='true'></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">添 加</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                <el-form-item label="会议图片">
                    <el-upload
                        class="upload-demo"
                        ref="jo_image"
                        action="#"
                        multiple
                        accept=".jpg,.jpeg,.png,.JPG,.JPEG"
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
</style>


<script>
  export default {
    data() {
      return {
            dataForm: new FormData(),
            jo_image: '',
            jo_graph_inject: '',
            dataFile: new FormData(),
            Bcode:false,
            multiple:true,
            jo_id:'',
            index:0,
            form: {
                join_people: '',
                jo_name: '',
                jo_hold_unit: '',
                jo_take_unit: '',
                jo_level: '',
                jo_time: '',
                jo_place: '',
                jo_art_num: '',
                jo_is_invite: '',
                jo_title: '',
            },
        }
    },
    methods: {
        submitUploads() {
            if(this.Bcode == true){
                let id = this.jo_id;
                this.dataFile.append('jo_id', id);
                this.dataFile.append('is_add_joinmeet',this.Bcode);
                this.sendfile(this.dataFile);
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }
        },
        fileProfil(file){
            this.dataForm.append('jo_graph_inject', file.raw);
            return false;
        },
        change(files){
            this.dataFile.append(this.index, files.raw);
            this.index++;
        },
        sendfile(dataFile) {
            this.addBookFile(dataFile).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    this.$message({
                        message: data.message,
                        type: 'success'
                    });
                    this.$router.push({path: '/joinmeet'});
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
                url: 'addjoinmeetimage',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data,
            });
        },
       onSubmit(form) {
            let vue = this;
            if(form.join_people == '') {
                this.$message.error('参加人员不能为空');
                return
            }else if(form.jo_name == ''){
                this.$message.error('会议名称不能为空');
                return
            }else if(form.jo_hold_unit == '') {
                this.$message.error('主办单位不能为空');
                return
            }else if(form.jo_take_unit == '') {
                this.$message.error('承办单位不能为空');
                return
            }else if(form.jo_level == '') {
                this.$message.error('会议等级不能为空');
                return
            }else if(form.jo_time == '') {
                this.$message.error('会议时间不能为空');
                return
            }else if(form.jo_plac == '') {
                this.$message.error('会议地点不能为空');
                return
             }else if(form.jo_art_num == '') {
                this.$message.error('论文提交数量不能为空');
                return
            }else if(form.jo_is_invit == '') {
                this.$message.error('是否被邀请不能为空');
                return
            }else if(form.jo_title == '') {
                this.$message.error('会议题目不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addJoinmeetData(vue.dataForm).then(res => {
                            var data = res.data;
                            vue.jo_id = res.data.datas;
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
                        })
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
        },
        addJoinmeetData(data) {
            return axios({
                method: 'post',
                url: 'addjoinmeet',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    }
  }
</script>
