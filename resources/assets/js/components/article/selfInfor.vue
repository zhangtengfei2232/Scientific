<template>
    <div>
        <div class="table">
            <div class="information">
                <div class="add">
                    <el-form ref="form" :model="form" label-width="200px">
                        <el-form-item label="第一作者（通讯录作者）">
                            <el-input v-model="form.author"></el-input>
                        </el-form-item>
                        <el-form-item label="全部作者">
                            <el-input v-model="form.art_all_author"></el-input>
                        </el-form-item>
                        <el-form-item label="论文题目">
                            <el-input v-model="form.title"></el-input>
                        </el-form-item>
                        <el-form-item label="发表刊物名称">
                            <el-input v-model="form.publication_name"></el-input>
                        </el-form-item>
                        <el-form-item label="刊号">
                            <el-input v-model="form.publication_num"></el-input>
                        </el-form-item>
                        <el-form-item label="年，卷，期">
                            <el-col :span="11">
                            <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                            </el-col>
                        </el-form-item>
                        <el-form-item label="字数">
                            <el-input v-model="form.num_words"></el-input>
                        </el-form-item>
                        <el-form-item label="期刊级别">
                            <el-radio-group v-model="form.periodical_cate">
                                <el-radio :label="1">CSCD</el-radio>
                                <el-radio :label="2">核心</el-radio>
                                <el-radio :label="3">一般CN</el-radio>
                                <el-radio :label="4">国外出版外文刊</el-radio>
                                <el-radio :label="5">其他</el-radio>
                            </el-radio-group>
                        </el-form-item>
                        <el-form-item label="所属项目">
                            <el-input v-model="form.belong_project"></el-input>
                        </el-form-item>
                        <el-form-item label="研究类别">
                            <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                            <el-option label="1" value="1"></el-option>
                            <el-option label="2" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="学科门类">
                            <el-select v-model="form.art_sub_category" placeholder="请选择学科门类">
                            <el-option label="逻辑学" value="nongxue"></el-option>
                            <el-option label="宗教学" value="nongxue"></el-option>
                            <el-option label="语言学" value="nongxue"></el-option>
                            <el-option label="中国文学" value="nongxue"></el-option>
                            <el-option label="外国文学" value="nongxue"></el-option>
                            <el-option label="艺术学" value="nongxue"></el-option>
                            <el-option label="历史学" value="nongxue"></el-option>
                            <el-option label="考古学" value="nongxue"></el-option>
                            <el-option label="经济学" value="nongxue"></el-option>
                            <el-option label="政治学" value="nongxue"></el-option>
                            <el-option label="法学" value="nongxue"></el-option>
                            <el-option label="农学" value="nongxue"></el-option>
                            <el-option label="作物学" value="zuowuxue"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="积分">
                            <el-input v-model="form.art_integral"></el-input>
                        </el-form-item>
                        <el-form-item label="学校认定刊物级别">
                            <el-input v-model="form.name"></el-input>
                        </el-form-item>
                        <el-form-item label="论文全文PDF上传">
                            <el-upload
                                class="upload-demo"
                                drag
                                action="#"
                                multiple>
                                <i class="el-icon-upload"></i>
                                <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                            </el-upload>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="onSubmit">立即创建</el-button>
                            <el-button>取消</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
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
            ArticleSelfData: {},
            form: {
                author: '1',
                art_all_author: '1',
                title: '2',
                publication_name: '3',
                publication_num : '4',
                num_words: '456',
                periodical_cate: '',
                belong_project: 'xgxy',
                art_cate_research: '',
                art_sub_category: '',
                art_integral: '',
                region: '',
                date1: '',
                date2: '',
                delivery: false,
                type: [],
                resource: '',
                desc: ''
            },
        }
    },

    methods: {
        getArticleSelfData() {
                let self = this;
                let art_id = self.$route.params.paper_id;
                axios.get("selectartical",art_id).then(function (response) {
                    var data = response.data;
                    //console.log(data);
                    if (data.code == 0) {
                        self.ArticleSelfData = data.datas;
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
        },
    },
    mounted() {
        this.getArticleSelfData();
    }
}
</script>
