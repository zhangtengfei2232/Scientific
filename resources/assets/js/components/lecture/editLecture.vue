<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="90px">
            <el-form-item label="专家姓名">
                <el-input v-model="form.le_expert_name" placeholder="请输入专家姓名"></el-input>
            </el-form-item>
            <el-form-item label="专家级别">
                <el-select v-model="form.le_expert_level" placeholder="请选择专家级别">
                    <el-option label="院士" value="1"></el-option>
                    <el-option label="博导" value="2"></el-option>
                    <el-option label="国务院学位委员会委员" value="3"></el-option>
                    <el-option label="教授" value="4"></el-option>
                    <el-option label="其他" value="5"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="报告名称">
                <el-input v-model="form.le_report_name" placeholder="请输入报告名称"></el-input>
            </el-form-item>
            <el-form-item label="邀请/未邀请">
                <el-radio-group v-model="form.le_invite_status">
                    <el-radio label="邀请"></el-radio>
                    <el-radio label="未邀请"></el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="邀请单位">
                <el-input v-model="form.le_invite_unit" placeholder="请输入邀请单位"></el-input>
            </el-form-item>
            <el-form-item label="讲学时间">
                <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.le_time"></el-date-picker>
                </el-col>
            </el-form-item>
            <el-form-item label="图注">
                <el-upload
                        class="upload-demo"
                        drag
                        action="#"
                        multiple>
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
            </el-form-item>
            <el-form-item label="图片">
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
                EditLectureData: {},
                form: {
                    le_expert_name:'',
                    le_expert_level:'',
                    le_report_name:'',
                    le_invite_status:'',
                    le_invite_unit:'',
                    le_time: '',
                    delivery: false,
                    type: [],
                }
            }
        },
        methods: {
            getEditLectureData() {
                let self = this;
                let art_id = self.$route.params.art_id;
                axios.get("",art_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.EditLectureData = data.datas;
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
            this.getEditLectureData();
        }
    }
</script>