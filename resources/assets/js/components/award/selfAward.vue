<template>
     <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一获奖人">
                    <el-input v-model="form.aw_first_author"></el-input>
                </el-form-item>
                <el-form-item label="全部获奖人">
                    <el-input v-model="form.aw_all_author"></el-input>
                </el-form-item>
                <el-form-item label="获奖成果名称">
                    <el-input v-model="form.prize_win_name"></el-input>
                </el-form-item>
                <el-form-item label="奖励名称">
                    <el-input v-model="form.award_name"></el-input>
                </el-form-item>  
                <el-form-item label="成果形式">
                    <el-select v-model="form.form_achievement" placeholder="请选择类别">
                        <el-option label="论文" value="1"></el-option>
                        <el-option label="研究报告" value="2"></el-option>
                        <el-option label="新技术" value="3"></el-option>
                        <el-option label="新工艺" value="4"></el-option>
                         <el-option label="课件" value="1"></el-option>
                        <el-option label="新产品" value="2"></el-option>
                        <el-option label="专著" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="计算机软件" value="3"></el-option>
                        <el-option label="教材" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="等级">
                    <el-select v-model="form.aw_grade" placeholder="请选择类别">
                        <el-option label="一等奖" value="1"></el-option>
                        <el-option label="二等奖" value="2"></el-option>
                        <el-option label="三等奖" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="奖励级别">
                    <el-select v-model="form.aw_level" placeholder="请选择类别">
                        <el-option label="国家级" value="1"></el-option>
                        <el-option label="省部级" value="2"></el-option>
                        <el-option label="厅局级" value="3"></el-option>
                        <el-option label="校级" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="授奖单位">
                    <el-input v-model="form.aw_grant_unit"></el-input>
                </el-form-item>
                <el-form-item label="授奖时间">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期" 
                            v-model="form.aw_grant_time" 
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>  
                <el-form-item label="证书编号">
                    <el-input v-model="form.aw_certi_number"></el-input>
                </el-form-item>
                <el-form-item label="我校名次">
                    <el-input v-model="form.aw_sch_rank"></el-input>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.aw_integral"></el-input>
                </el-form-item>
                <el-form-item label="证书图片">
                    <el-upload
                        class="upload-demo"
                        drag
                        ref="aw_pic"
                        :before-upload="filePic"
                        action="#"
                        filelist="filelist"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">立即创建</el-button>
                    <el-button><router-link to="/award">取消</router-link></el-button>
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
            AwardSelfData: {},
            filelist: [{url:''}],
            dataForm: new FormData(),
            aw_pic:'',
            form: {
                aw_first_author: '',
                aw_first_author: '',
                prize_win_name: '',
                award_name: '',
                form_achievement : '',
                aw_grade: '',
                aw_level: '',
                aw_grant_unit: '',
                aw_grant_time: '',
                aw_certi_number: '',
                aw_sch_rank: '',  
                aw_integral: '',
            },
        }
    },
    methods: {
        getAwardSelfData() {
                let self = this;
                let aw_id = self.$route.params.aw_id;
                axios.get("selectAward?aw_id="+aw_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AwardSelfData = data.datas;
                        self.form = data.datas;
                        self.filelist.url = 'showimage?disk=award&subjection=' + data.datas.aw_road; 
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,         
                        });
                    }
                });
        },
        filePic(file) {
            this.dataForm.append('aw_pic', file);
            return false;
        },
        onSubmit(form) {
            if(form.aw_first_author == '') {
                this.$message.error('第一获奖人不能为空');
                return
            }else if(form.aw_all_author == ''){
                this.$message.error('全部获奖人不能为空');
                return
            }else if(form.prize_win_name == '') {
                this.$message.error('获奖成果名称不能为空');
                return
            }else if(form.award_name == '') {
                this.$message.error('奖励名称不能为空');
                return
            }else if(form.form_achievement == '') {
                this.$message.error('成果形式不能为空');
                return
            }else if(form.aw_grade == '') {
                this.$message.error('等级不能为空');
                return
            }else if(form.aw_level == '') {
                this.$message.error('奖励级别不能为空');
                return
            }else if(form.aw_grant_unit == '') {
                this.$message.error('授奖单位不能为空');
                return
            }else if(form.aw_grant_time == '') {
                this.$message.error('授奖时间不能为空');
                return
            }else if(form.aw_certi_number == '') {
                this.$message.error('证书编号不能为空');
                return
            }else if(form.aw_sch_rank == '') {
                this.$message.error('我校名次不能为空');
                return
            }else if(form.aw_integral == '') {
                this.$message.error('积分不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                    let vue = this;
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addAwardData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: '修改成功',
                                    type: 'success'
                                });
                                this.$router.push({path: '/award'});
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: '修改失败',
                                    duration: 2000,
                                });
                            }
                        })
                        vue.$refs.aw_pic.submit()
                    } else {
                        console.log('error submit!!')
                        return false
                    }
                })
        },
        addAwardData(data) {
            return axios({
                method: 'post',
                url: 'updateAward',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getAwardSelfData();
    }
}
</script>
