<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="参会人">
                    <el-input v-model="form.author"></el-input>
                </el-form-item>
                <el-form-item label="学术会议名称">
                    <el-input v-model="form.art_all_author"></el-input>
                </el-form-item>
                 <el-form-item label="主办单位">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="承办单位">
                    <el-input v-model="form.publication_name"></el-input>
                </el-form-item> 
                <el-form-item label="会议级别">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="省级" value="1"></el-option>
                        <el-option label="大区级" value="2"></el-option>
                        <el-option label="国家级" value="3"></el-option>
                        <el-option label="国际会议" value="4"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="会议时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="会议地点">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="提交论文数">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="是否被邀大会或分会场报告">
                    <el-radio-group v-model="form.periodical_cate">
                        <el-radio :label="1" style="margin:10px">是</el-radio>
                        <el-radio :label="2" style="margin:10px">否</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="报告题目">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="会议图注">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="餐会图注">
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
                delivery: false,
                type: [],
                resource: '',
                desc: ''
            }
        }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      }
    }
  }
</script>