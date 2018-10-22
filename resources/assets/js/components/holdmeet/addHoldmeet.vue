<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="学术会议名称">
                    <el-input v-model="form.ho_name"></el-input>
                </el-form-item>
                <el-form-item label="有无论文集">
                    <el-radio-group v-model="form.ho_art_status">
                        <el-radio :label="1" style="margin:10px">有</el-radio>
                        <el-radio :label="2" style="margin:10px">无</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="参与人数">
                    <el-input v-model="form.people_num"></el-input>
                </el-form-item>
                <el-form-item label="主办单位">
                    <el-input v-model="form.ho_unit"></el-input>
                </el-form-item>
                <el-form-item label="承办单位">
                    <el-input v-model="form.undertake_unit"></el-input>
                </el-form-item> 
                <el-form-item label="会议级别">
                    <el-select v-model="form.ho_level" placeholder="请选择类别">
                        <el-option label="省级" value="1"></el-option>
                        <el-option label="大区级" value="2"></el-option>
                        <el-option label="国家级" value="3"></el-option>
                        <el-option label="国际会议" value="4"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="会议时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.ho_time" style="width: 100%;"></el-date-picker>
                    </el-col>
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
            form: {
                ho_name: '',
                ho_art_status: '',
                people_num: '',
                ho_unit: '',
                undertake_unit: '',
                ho_level: '',
                ho_time: '',
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