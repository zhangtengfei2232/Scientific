<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="主持人">
                    <el-input v-model="form.author"></el-input>
                </el-form-item>
                <el-form-item label="全部完成（参与）人">
                    <el-input v-model="form.art_all_author"></el-input>
                </el-form-item>
                <el-form-item label="鉴定成果名称">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="鉴定形式">
                    <el-input v-model="form.publication_name"></el-input>
                </el-form-item> 
                <el-form-item label="鉴定证号">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="鉴定结论">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                 <el-form-item label="鉴定时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                 <el-form-item label="鉴定级别">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="国家级" value="1"></el-option>
                        <el-option label="省级" value="2"></el-option>
                        <el-option label="厅级" value="3"></el-option>
                        <el-option label="校级" value="4"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.art_integral"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.desc"></el-input>
                </el-form-item>
                <el-form-item label="成果封面">
                    <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="成果鉴定证书图片">
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