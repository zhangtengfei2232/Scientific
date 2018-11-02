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
                        <el-date-picker
                            type="date"
                            placeholder="选择日期" 
                            v-model="form.ho_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="会议图注">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        ref="ho_files"
                        :file-list="filelists"
                        :before-upload="fileProfils"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                <div class="demo" v-show="picType">
                    <thead>
                        <!-- <li v-for="(id,filelists) in items" v-bind:key="filelists">
                            <img src="{{ items.url }}" alt="无法加载">
                            <el-button type="primary" @click="deletePic(items)">保存修改</el-button>
                        </li> -->
                    </thead>
                </div>
                <el-form-item label="会议图片">
                    <el-upload
                        drag
                        ref="ho_file"
                        action="#"
                        :before-upload="fileProfil"
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
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
            picType:false,
            filelist:[{url:''}],
            HoldmeetSelfData: {},
            dataForm: new FormData(),
            dataFile: new FormData(),
            ho_file: '',
            ho_graph_inject: '',
            filelists:[{}],
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
                    self.HoldmeetSelfData = data.datas.information;
                    self.form = data.datas.information;
                    self.filelist.url = 'showfile?disk=holdmeet&subjection=' + data.datas.information.ho_graph_inject;
                    // let image = data.datas.information.ho_image;
                    // if(image !== ''){
                    //     this.picType = true;
                    //     self.filelists = 'showfile?disk=holdmeet&subjection=' + image;
                    // }   
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
            this.$refs.ho_graph_inject.submit();
        },
        handleRemove(file, fileList) {
            console.log(file, fileList);
        },
        handlePreview(file) {
            console.log(file);
        },
        fileProfil(file){
            this.dataForm.append('ho_file', file);
            return false;
        },
        fileProfils(files){
            if(this.Bcode == true){
                this.dataFile.append('ho_graph_inject', files);
                let id = this.form.ho_id;
                this.sendfile(dataFile,id);      
            }else{
                this.$message.error('请先添加数据信息');
                return false
            }
        },
        sendfile(file) {
            this.addBookFile(dataFile,id).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    this.$message({
                        message: '修改成功',
                        type: 'success'
                    });
                } else {
                    this.$notify({
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
                url: 'addholdmeetimages',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
       onSubmit(form) {
            let vue = this;
            if(form.ho_name == '') {
                this.$message.error('会议名称不能为空');
                return
            }else if(form.ho_art_status == ''){
                this.$message.error('有无论文集不能为空');
                return
            }else if(form.people_num == '') {
                this.$message.error('参加人数不能为空');
                return
            }else if(form.ho_unit == '') {
                this.$message.error('主办单位不能为空');
                return
            }else if(form.undertake_unit == '') {
                this.$message.error('承办单位不能为空');
                return
            }else if(form.ho_level == '') {
                this.$message.error('会议级别不能为空');
                return
            }else if(form.ho_time == '') {
                this.$message.error('会议时间不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addHoldmeetData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                this.Bcode = true;
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
                        vue.$refs.ho_file.submit()
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
         deletePic(id) {
            let self = this;
            axios.get("",{
                params:{
                    id:id
                }
            }).then(function (response) {
            var data = response.data;
                if (data.code == 0) {
                        self.$message({
                        type: 'success',
                        message: '删除成功!'
                    });
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.msg,
                        duration: 2000,
                    });
                }
            });
        },
    },
    mounted() {
        this.getHoldmeetSelfData();
    }
}
</script>
