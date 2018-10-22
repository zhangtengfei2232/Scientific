<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一作者（或主编）">
                    <el-input v-model="form.op_first_author"></el-input>
                </el-form-item>
                <el-form-item label="全部作者">
                    <el-input v-model="form.op_all_author"></el-input>
                </el-form-item>
                <el-form-item label="著作名称">
                    <el-input v-model="form.op_name"></el-input>
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
                    <el-input v-model="form.op_publish"></el-input>
                </el-form-item>
                <el-form-item label="出版时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.op_publish_time" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="书号">
                    <el-input v-model="form.op_number"></el-input>
                </el-form-item>
                <el-form-item label="总字数（千字）">
                    <el-input v-model="form.op_total_words"></el-input>
                </el-form-item>
                <el-form-item label="本人字数（千字）">
                    <el-input v-model="form.op_self_words"></el-input>
                </el-form-item>
                <el-form-item label="著作类别">
                    <el-select v-model="form.op_cate_work" placeholder="请选择类别">
                        <el-option label="专著" value="1"></el-option>
                        <el-option label="教科书" value="2"></el-option>
                        <el-option label="译著" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.op_integral"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.op_cate_research" placeholder="请选择类别">
                        <el-option label="基础研究" value="1"></el-option>
                        <el-option label="应用研究" value="2"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="学科门类">
                    <el-select v-model="form.op_sub_category" placeholder="请选择学科门类">
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
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.op_remarks"></el-input>
                </el-form-item>
                <el-form-item label="著作封面及版权页图片">
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
            form: {
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