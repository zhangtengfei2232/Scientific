<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="主持人">
                    <el-input v-model="form.author"></el-input>
                </el-form-item>
                <el-form-item label="所有参加人">
                    <el-input v-model="form.art_all_author"></el-input>
                </el-form-item>
                <el-form-item label="项目名称">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="项目类别">
                    <el-input v-model="form.publication_name"></el-input>
                </el-form-item>
                <el-form-item label="批准单位">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="批准经费">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="当年到账经费">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="基础研究" value="1"></el-option>
                        <el-option label="实验与发展" value="2"></el-option>
                        <el-option label="应用研究" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="学科门类">
                    <el-select v-model="form.art_sub_category" placeholder="请选择学科门类">
                        <el-option label="理学" value="1"></el-option>
                        <el-option label="工学" value="2"></el-option>
                        <el-option label="农学" value="3"></el-option>
                        <el-option label="医学" value="4"></el-option>
                        <el-option label="管理学" value="5"></el-option>
                        <el-option label="马克思主义" value="6"></el-option>
                        <el-option label="哲学" value="7"></el-option>
                        <el-option label="逻辑学" value="8"></el-option>
                        <el-option label="宗教学" value="9"></el-option>
                        <el-option label="语言学" value="10"></el-option>
                        <el-option label="中国文学" value="11"></el-option>
                        <el-option label="外国文学" value="12"></el-option>
                        <el-option label="艺术学" value="13"></el-option>
                        <el-option label="历史学" value="14"></el-option>
                        <el-option label="考古学" value="15"></el-option>
                        <el-option label="经济学" value="16"></el-option>
                        <el-option label="政治学" value="17"></el-option>
                        <el-option label="法学" value="18"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="合作形式">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="与境外机构合作" value="1"></el-option>
                        <el-option label="与国内高校合作" value="2"></el-option>
                        <el-option label="与国内独立研究机构合作" value="3"></el-option>
                        <el-option label="与境内注册外商独资企业合作" value="4"></el-option>
                        <el-option label="与境内注册其他企业合作" value="5"></el-option>               
                        <el-option label="其他" value="6"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="社会经济目标">
                    <el-input v-model="form.num_words"></el-input>
                </el-form-item>
                <el-form-item label="服务的国民经济行业">
                    <el-input v-model="form.belong_project"></el-input>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.art_integral"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.desc"></el-input>
                </el-form-item>
                <el-form-item label="项目合同书封面图片">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                 <el-form-item label="项目年份">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">立即创建</el-button>
                    <el-button>取消</el-button>
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
            ProjectSelfData: {},
            input : '',
            form: {
                author: '',
                art_all_author: '',
                title: '',
                publication_name: '',
                publication_num : '',
                num_words: '',
                periodical_cate: '',
                belong_project: '',
                art_cate_research: '',
                art_sub_category: '',
                art_integral: '',  
                name: '',
                region: '',
                date1: '',
                date2: '',
                type: [],
                desc: ''
            }
        }
    },
    methods: {
        getProjectSelfData() {
                let self = this;
                let art_id = self.$route.params.art_id;
                axios.get("selectartical",art_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ProjectSelfData = data.datas;
                        console.log(data.datas);
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,         
                        });
                    }
                });
        },
        onSubmit() {
            console.log('submit!');
        }
    },
    mounted() {
        this.ProjectSelfData();
    }
  }
</script>