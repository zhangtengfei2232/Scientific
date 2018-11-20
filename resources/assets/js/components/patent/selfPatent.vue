<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="专利权人">
                    <el-input v-model="form.patent_person"></el-input>
                </el-form-item>
                <el-form-item label="第一发明人">
                    <el-input v-model="form.first_inventor"></el-input>
                </el-form-item>
                <el-form-item label="全部发明人">
                    <el-input v-model="form.pa_all_author"></el-input>
                </el-form-item>
                 <el-form-item label="专利类型">
                    <el-select v-model="form.pa_type" placeholder="请选择类别">
                        <el-option label="发明专利" value="0"></el-option>
                        <el-option label="实用新型专利" value="1"></el-option>
                        <el-option label="外观设计专利" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="专利名称">
                    <el-input v-model="form.pa_name"></el-input>
                </el-form-item>  
                <el-form-item label="实施情况">
                    <el-select v-model="form.pa_imple_situ" placeholder="请选择类别">
                        <el-option label="授权" value="0"></el-option>
                        <el-option label="受理" value="1"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="授权编号或申请号">
                    <el-input v-model="form.author_num"></el-input>
                </el-form-item>
                <el-form-item label="授权证书编号">
                    <el-input v-model="form.author_cert_num"></el-input>
                </el-form-item>
                <el-form-item label="授权公告日或受理日期">
                    <el-col :span="15">
                        <el-date-picker 
                            type="date" 
                            placeholder="选择日期" 
                            v-model="form.author_notic_day" 
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.pa_integral"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.pa_remarks"></el-input>
                </el-form-item>
                <div class="demo" v-show="type1">
                    <img :src="filelist " alt="无法加载" style="width:100px">
                </div>
                <el-form-item label="专利图片">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        :limit="1"
                        ref="pa_road"
                        :before-upload="filePatpic"
                        multiple
                        list-type="picture"
                        :auto-upload="false">
                        <i class="el-icon-upload"
                        ></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
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
    .demo{
        margin: 10px 0 10px 30%;
    }
</style>

<script>
export default {
    data() {
        return {
            type1:false,
            pa_road:'',
            PatetSelfData: {},
            filelist:'',
            dataForm: new FormData(),
            form: {
                pa_id:'',
                patent_person: '',
                first_inventor: '',
                pa_all_author: '',
                pa_type: '',
                pa_name: '',
                pa_imple_situ: '',
                author_num: '',
                author_cert_num: '',
                author_notic_day: '',
                pa_integral: '',
                pa_remarks: '',
            },
        }
    },

    methods: {
        filePatpic(file) {
            this.dataForm.append('pa_road', file);
            return false;
        },
        getPatentSelfData() {
                let self = this;
                let pa_id = self.$route.params.pa_id;
                axios.get("selectpatent?pa_id="+pa_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.PatentSelfData = data.datas;
                        self.form = data.datas;
                        self.form.pa_type = String(data.datas.pa_type);
                        self.form.pa_imple_situ = String(data.datas.pa_imple_situ);
                        if(data.datas.pa_road !== ''){
                            self.type1=true;
                            self.filelist= 'showfile?disk=joinmeet&subjection=' + data.datas.pa_road; 
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
        onSubmit(form) {
            let vue = this;
            if(form.patent_person == '') {
                this.$message.error('专利权人不能为空');
                return
            }else if(form.first_inventor == '') {
                this.$message.error('第一发明人不能为空');
                return
            }else if(form.pa_all_author == ''){
                this.$message.error('全部发明人不能为空');
                return
            }else if(form.pa_type == '') {
                this.$message.error('专利类型不能为空');
                return
            }else if(form.pa_name == '') {
                this.$message.error('专利名称不能为空');
                return
            }else if(form.pa_imple_situ == '') {
                this.$message.error('实施情况不能为空');
                return
            }else if(form.author_num == '') {
                this.$message.error('授权编号或申请号不能为空');
                return
            }else if(form.author_cert_num == '') {
                this.$message.error('授权证书编号不能为空');
                return
            }else if(form.author_notic_day == '') {
                this.$message.error('授权公告日或受理日期不能为空');
                return
            }else if(form.pa_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.pa_remarks == '') {
                this.$message.error('备注不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addPatentData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '修改成功',
                                    type: 'success'
                                });
                                this.$router.push({path: '/patent'});
                            }else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        })
                        vue.$refs.pa_road.submit()
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
        },
        addPatentData(data) {
            return axios({
                method: 'post',
                url: 'updatepatent',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getPatentSelfData();
    }
}
</script>
