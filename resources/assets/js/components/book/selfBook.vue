<template>
    <div class="information">
         <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一作者（或主编）">
                    <el-input v-model="form.op_first_author" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="全部作者">
                    <el-input v-model="form.op_all_author" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="著作名称">
                    <el-input v-model="form.op_name" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="编著形式">
                    <el-select v-model="form.op_form_write" placeholder="请选择类别">
                        <el-option label="主编" value="1"></el-option>
                        <el-option label="副主编" value="2"></el-option>
                        <el-option label="参编" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="出版社">
                    <el-input v-model="form.op_publish" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="出版时间">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            v-model="form.op_publish_time"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="书号">
                    <el-input v-model="form.op_number" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="总字数（千字）">
                    <el-input v-model="form.op_total_words" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="本人字数（千字）">
                    <el-input v-model="form.op_self_words" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="著作类别">
                    <el-select v-model="form.op_cate_work" placeholder="请选择类别">
                        <el-option label="专著" value="0"></el-option>
                        <el-option label="教科书" value="1"></el-option>
                        <el-option label="译著" value="2"></el-option>
                        <el-option label="编著" value="3"></el-option>
                        <el-option label="其他" value="4"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.op_integral" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.op_cate_research" placeholder="请选择类别">
                        <el-option label="基础研究" value="1"></el-option>
                        <el-option label="应用研究" value="2"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="学科门类">
                    <el-select v-model="form.op_sub_category" placeholder="请选择学科门类">
                       <el-option label="理学" value="0"></el-option>
                        <el-option label="工学" value="1"></el-option>
                        <el-option label="农学" value="2"></el-option>
                        <el-option label="医学" value="3"></el-option>
                        <el-option label="管理学" value="4"></el-option>
                        <el-option label="马克思主义" value="5"></el-option>
                        <el-option label="哲学" value="6"></el-option>
                        <el-option label="逻辑学" value="7"></el-option>
                        <el-option label="宗教学" value="8"></el-option>
                        <el-option label="语言学" value="9"></el-option>
                        <el-option label="中国文学" value="10"></el-option>
                        <el-option label="外国文学" value="11"></el-option>
                        <el-option label="艺术学" value="12"></el-option>
                        <el-option label="历史学" value="13"></el-option>
                        <el-option label="考古学" value="14"></el-option>
                        <el-option label="经济学" value="15"></el-option>
                        <el-option label="政治学" value="16"></el-option>
                        <el-option label="法学" value="17"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.op_remarks"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                <div class="demo" v-show="type1">
                    <img :src="filelist" alt="无法加载" style="width:100px">
                </div>
                <el-form-item label="著作封面">
                    <el-upload
                        class="upload-demo"
                        ref="op_cover_road"
                        action="#"
                        :before-upload="fileProfil"
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :auto-upload="false"
                        :limit="1"
                        list-type="picture">
                        <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                    </el-upload>
                </el-form-item>
                <div class="demo" v-show="type2">
                    <img :src="filelists" alt="无法加载" style="width:100px">
                </div>
                <el-form-item label="版权页图片">
                    <el-upload
                        class="upload-demo"
                        ref="op_coright_road"
                        action="#"
                        :before-upload="fileProfils"
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :auto-upload="false"
                        :limit="1"
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
    .demo{
        margin: 10px 0 10px 30%;
    }
</style>

<script>
export default {
    data() {
        return {
            type1:false,
            type2:false,
            BookSelfData: {},
            op_coright_road: '',
            op_cover_road: '',
            filelist: '',
            filelists: '',
            dataForm: new FormData(),
            dataFile: new FormData(),
            form: {
                op_id:'',
                op_first_author: '',
                op_all_author: '',
                op_name: '',
                op_form_write: '',
                op_publish: '',
                op_publish_time: '',
                op_number: '',
                op_total_words: '',
                op_self_words: '',
                op_cate_work: '',
                op_integral: '',
                op_cate_research: '',
                op_sub_category: '',
                op_remarks: '',
            },
        }
    },
    methods: {
        getBookSelfData() {
            let self = this;
            this.form.op_id = self.$route.params.op_id;
            axios.get("selectopus?op_id="+this.form.op_id).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.BookSelfData = data.datas;
                    self.form = data.datas;
                    self.form.op_form_write = String(data.datas.op_form_write);
                    self.form.op_cate_work = String(data.datas.op_cate_work);
                    self.form.op_sub_category = String(data.datas.op_sub_category);
                    if(data.datas.op_cover_road !== ''){
                        self.type1=true;
                        self.filelist = 'showfile?disk=opus&subjection=' + data.datas.op_cover_road;
                    }
                    if(data.datas.op_coright_road !== ''){
                        self.type2=true;
                        self.filelists = 'showfile?disk=opus&subjection=' + data.datas.op_coright_road;
                    }
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        submitUpload() {
            this.$refs.op_cover_road.submit();
        },
        submitUploads() {
            this.$refs.op_coright_road.submit();
        },
        handleRemove(file, fileList) {
            console.log(file, fileList);
        },
        handlePreview(file) {
            console.log(file);
        },
        fileProfil(file){
            if(file !== ''){
                this.dataFile.append('op_cover_road', file);
                let id = this.form.op_id;
                this.dataFile.append('op_id', id);
                this.sendfile(this.dataFile);
            }else{
                this.$message.error('请先添加文件');
                return false
            }
        },
        fileProfils(files){
            if(files !== ''){
                this.dataFile.append('op_coright_road', files);
                let id = this.form.op_id;
                this.dataFile.append('op_id', id);
                this.sendfile(this.dataFile);
            }else{
                this.$message.error('请先添加文件');
                return false
            }
        },
        sendfile(dataFile) {
            let vue = this;
            this.addBookFile(dataFile).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    vue.$message({
                        message: '修改成功',
                        type: 'success'
                    });
                    location. reload();
                } else {
                    vue.$notify({
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
                url: 'updateopusimage',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data,
            });
        },
        onSubmit(form) {
            if(form.op_first_author == '') {
                this.$message.error('第一作者（或主编）不能为空');
                return
            }else if(form.op_all_author == ''){
                this.$message.error('全部作者不能为空');
                return
            }else if(form.op_name == '') {
                this.$message.error('著作名称不能为空');
                return
            }else if(form.op_form_write == '') {
                this.$message.error('编著形式不能为空');
                return
            }else if(form.op_publish == '') {
                this.$message.error('出版社不能为空');
                return
            }else if(form.op_publish_time == '') {
                this.$message.error('出版时间不能为空');
                return
            }else if(form.op_number == '') {
                this.$message.error('书号不能为空');
                return
            }else if(form.op_total_words == '') {
                this.$message.error('总字数（千字）不能为空');
                return
            }else if(form.op_self_words == '') {
                this.$message.error('本人字数（千字）不能为空');
                return
            }else if(form.op_cate_work == '') {
                this.$message.error('著作类别不能为空');
                return
            }else if(form.op_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.op_cate_research == '') {
                this.$message.error('研究类别不能为空');
                return
            }else if(form.op_sub_category == '') {
                this.$message.error('学科门类不能为空');
                return
            }else if(form.op_remarks == '') {
                this.$message.error('备注不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                let vue = this;
                if (valid) {
                    jQuery.each(vue.form,function(i,val){
                        vue.dataForm.append(i,val);
                    });
                    vue.addBookData(vue.dataForm).then(res => {
                        var data = res.data;
                        if (data.code == 0) {
                            vue.$message({
                                message: '修改成功',
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
        addBookData(data) {
            return axios({
                method: 'post',
                url: 'updateopus',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getBookSelfData();
    }
}
</script>
