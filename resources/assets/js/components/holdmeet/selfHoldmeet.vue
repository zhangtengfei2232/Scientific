<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="学术会议名称">
                    <el-input v-model="form.ho_name" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="有无论文集">
                    <el-radio-group v-model="form.ho_art_status">
                        <el-radio :label="1" style="margin:10px">有</el-radio>
                        <el-radio :label="2" style="margin:10px">无</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="参与人数" maxlength="100">
                    <el-input v-model="form.people_num"></el-input>
                </el-form-item>
                <el-form-item label="主办单位">
                    <el-input v-model="form.ho_unit" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="承办单位">
                    <el-input v-model="form.undertake_unit" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="会议级别">
                    <el-select v-model="form.ho_level" placeholder="请选择类别">
                        <el-option label="省级" value="0"></el-option>
                        <el-option label="大区级" value="1"></el-option>
                        <el-option label="国家级" value="2"></el-option>
                        <el-option label="国际会议" value="3"></el-option>
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
                 <div class="demo" v-show="picType">
                    <img :src="filelist" alt="无法加载" style="width:100px">
                </div>
                <el-form-item label="会议图注">
                    <el-upload
                        drag
                        action="#"
                        ref="ho_graph_inject"
                        :on-change="fileProfil"
                        :auto-upload="false"
                        :limit="1"
                        list-type="picture">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
                <div class="demo" v-show="picTypes">
                    <thead>
                        <li v-for="(index,items) in filelists" v-bind:key="items">
                            <img :src="index.image_road" alt="无法加载" style="width:100px">
                            <el-button type="primary" size="mini"  @click="deletePic(index.im_id)">删除</el-button>
                        </li>
                    </thead>
                </div>
                <el-form-item label="会议图片">
                    <el-upload
                        ref="ho_file"
                        action="#"
                        accept=".jpg,.jpeg,.png,.JPG,.JPEG"
                        :auto-upload="false"
                        :on-change="change1"
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
    thead li{
        float: left;
        margin: 20px;
    }
</style>

<script>
export default {
    data() {
        return {
            picType:false,
            picTypes:false,
            filelist:'',
            HoldmeetSelfData: {},
            dataForm: new FormData(),
            dataFile: new FormData(),
            ho_file: '',
            ho_graph_inject: '',
            filelists:[],
            ho_id:'',
            index:0,
            form: {
                ho_name: '',
                ho_art_status: '',
                people_num: '',
                ho_unit: '',
                undertake_unit: '',
                ho_level: '',
                ho_time:' ',
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
                    self.ho_id = data.datas.information.ho_id;
                    self.form.ho_level = String(data.datas.information.ho_level);
                    if(data.datas.information.ho_graph_inject !== ''){
                        self.picType = true;
                        self.filelist = 'showfile?disk=holdmeet&subjection=' + data.datas.information.ho_graph_inject;
                    }
                    let image = data.datas.hold_images;
                    if(image.length !== 0){
                        self.picTypes = true;
                        self.filelists =  image;
                        for(var i =0;i<self.filelists.length;i++){
                            self.filelists[i].image_road = 'showfile?disk=holdmeet&subjection=' + image[i].image_road;
                        }
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
        fileProfil(file){
            this.dataForm.append('ho_graph_inject', file.raw);
            return false;
        },
        change1(files) {
            this.dataFile.append(this.index, files.raw);
            this.index++;
        },
        submitUploads() {
            let id = this.ho_id;
            this.dataFile.append('ho_id', id);
            this.sendfile(this.dataFile);
        },
        sendfile(dataFile) {
            this.addBookFile(dataFile).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    this.$message({
                        message: data.message,
                        type: 'success'
                    });
                    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                        window.location.reload();//页面刷新
                    },1000);
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
                url: 'addholdmeetimages',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data,
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
            axios.get("deleteholdmeetimage",{
                params:{
                    im_id:id
                }
            }).then(function (response) {
            var data = response.data;
                if (data.code == 0) {
                        self.$message({
                        type: 'success',
                        message: '删除成功!'
                    });
                    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                        window.location.reload();//页面刷新
                    },1000);
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
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
