<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一作者（通讯录作者）">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="全部作者">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="论文题目">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="发表刊物名称">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="刊号">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="年，卷，期">
                    <el-col :span="11">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="字数">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="期刊级别">
                    <el-radio-group v-model="form.type">
                        <el-radio :label="3">CSCD</el-radio>
                        <el-radio :label="6">核心</el-radio>
                        <el-radio :label="9">一般CN</el-radio>
                        <el-radio :label="12">国外出版外文刊</el-radio>
                        <el-radio :label="15">其他</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="所属项目">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="研究类别">
                    <el-select v-model="form.region" placeholder="请选择类别">
                    <el-option label="1" value="1"></el-option>
                    <el-option label="2" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="学科门类">
                    <el-select v-model="form.region" placeholder="请选择学科门类">
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
                    <el-input v-model="form.name"></el-input>
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