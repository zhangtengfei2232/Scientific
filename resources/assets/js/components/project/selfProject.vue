<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="主持人">
                    <el-input v-model="form.pro_host" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="所有参加人">
                    <el-input v-model="form.pro_all_author" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="项目名称">
                    <el-input v-model="form.entry_name" maxlength="200"></el-input>
                </el-form-item>
                <el-form-item label="项目类别">
                    <el-input v-model="form.project_category" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="批准单位">
                    <el-input v-model="form.approval_unit" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="批准经费">
                    <el-input v-model="form.approval_funds" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="当年到账经费">
                    <el-input v-model="form.account_outlay" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.pro_cate_research" placeholder="请选择类别">
                        <el-option label="基础研究" value="0"></el-option>
                        <el-option label="实验与发展" value="1"></el-option>
                        <el-option label="应用研究" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="学科门类">
                    <el-select v-model="form.pro_sub_category" placeholder="请选择学科门类">
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
                <el-form-item label="合作形式">
                    <el-select v-model="form.form_cooperate" placeholder="请选择类别">
                        <el-option label="与境外机构合作" value="0"></el-option>
                        <el-option label="与国内高校合作" value="1"></el-option>
                        <el-option label="与国内独立研究机构合作" value="2"></el-option>
                        <el-option label="与境内注册外商独资企业合作" value="3"></el-option>
                        <el-option label="与境内注册其他企业合作" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="社会经济目标">
                    <el-input v-model="form.social_eco_goal" maxlength="300"></el-input>
                </el-form-item>
                <el-form-item label="服务的国民经济行业">
                    <el-input v-model="form.na_eco_industry" maxlength="300"></el-input>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.pro_integral" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.pro_remarks"></el-input>
                </el-form-item>
                <el-form-item label="项目年份">
                    <el-col :span="15">
                        <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            v-model="form.project_year"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                            style="width: 100%;">
                        </el-date-picker>
                    </el-col>
                </el-form-item>
                <div class="demo" v-show="type1">
                    <el-button type="warning" size="mini" @click="watchPDF()">查看</el-button>
                </div>
                <el-form-item label="项目合同书封面">
                    <el-upload
                        class="upload-demo"
                            :auto-upload="false"
                            drag
                            action="#"
                            ref="pro_road"
                            :before-upload="fileProfil"
                            multiple
                            :limit="1">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form)">保存修改</el-button>
                    <el-button><router-link to="/project">取消</router-link></el-button>
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
    .demo{
        margin: 10px 0 10px 30%;
    }
</style>

<script>
  export default {
    data() {
      return {
            type1:false,
            ProjectSelfData: {},
            filelists: '',
            pro_road:'',
            dataForm: new FormData(),
            form: {
                pro_host: '',
                pro_all_author: '',
                entry_name: '',
                project_category: '',
                approval_unit : '',
                approval_funds: '',
                account_outlay: '',
                pro_cate_research: '',
                pro_sub_category: '',
                form_cooperate: '',
                social_eco_goal: '',
                na_eco_industry: '',
                pro_integral: '',
                pro_remarks: '',
                project_year: '',
                pro_road:''
            }
        }
    },
    methods: {
        watchPDF() {
            let urls =  `showfile?disk=project&subjection=${this.pro_road}`;
            window.open(urls, '_blank');
        },
        fileProfil(file){
            this.dataForm.append('pro_road', file);
            return false;
        },
        getProjectSelfData() {
            let self = this;
            let pro_id = self.$route.params.pro_id;
            axios.get("selectproject?pro_id="+pro_id).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.ProjectSelfData = data.datas;
                    self.form = data.datas;
                    self.form.pro_cate_research = String(data.datas.pro_cate_research);
                    self.form.pro_sub_category = String(data.datas.pro_sub_category);
                    self.form.form_cooperate = String(data.datas.form_cooperate);
                    if(data.datas.pro_road !== ''){
                        let road = 'showfile?disk=project&subjection=' + data.datas.pro_road;
                        self.type1=true;
                        self.filelists = road;
                    }
                }else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
       onSubmit(form) {
          if(form.pro_host == '') {
                this.$message.error('主持人不能为空');
                return
            }else if(form.pro_all_author == ''){
                this.$message.error('所有参加人不能为空');
                return
            }else if(form.entry_name == '') {
                this.$message.error('项目名称不能为空');
                return
            }else if(form.project_category == '') {
                this.$message.error('项目类别不能为空');
                return
            }else if(form.approval_unit == '') {
                this.$message.error('批准单位不能为空');
                return
            }else if(form.approval_funds == '') {
                this.$message.error('批准经费不能为空');
                return
            }else if(form.account_outlay == '') {
                this.$message.error('当年到账经费不能为空');
                return
            }else if(form.pro_cate_research == '') {
                this.$message.error('研究类别不能为空');
                return
            }else if(form.pro_sub_category == '') {
                this.$message.error('学科门类不能为空');
                return
            }else if(form.form_cooperate == '') {
                this.$message.error('合作形式不能为空');
                return
            }else if(form.social_eco_goal == '') {
                this.$message.error('社会经济目标不能为空');
                return
            }else if(form.na_eco_industry == '') {
                this.$message.error('服务的国民经济行业不能为空');
                return
            }else if(form.pro_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.pro_remarks == '') {
                this.$message.error('备注不能为空');
                return
            }else if(form.project_year == '') {
                this.$message.error('项目年份不能为空');
                return
            }this.$refs['form'].validate((valid) => {
                let vue = this;
                if (valid) {
                    jQuery.each(vue.form,function(i,val){
                        vue.dataForm.append(i,val);
                    });
                    vue.addProjectData(vue.dataForm).then(res => {
                        var data = res.data;
                        if (data.code == 0) {
                            vue.$message({
                                message: '修改成功',
                                type: 'success'
                            });
                            this.$router.push({path: '/project'});
                        } else {
                            vue.$notify({
                                type: 'error',
                                message: data.message,
                                duration: 2000,
                            });
                        }
                    })
                    vue.$refs.pro_road.submit();
                } else {
                    console.log('error submit!!')
                    return false
                }
            })
        },
        addProjectData(data) {
            return axios({
                method: 'post',
                url: 'updateproject',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
    },
    mounted() {
        this.getProjectSelfData();
    }
  }
</script>
