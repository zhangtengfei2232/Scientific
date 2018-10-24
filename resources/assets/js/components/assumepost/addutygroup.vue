<template>
    <div class="content">
        <el-form ref="form" :model="form" label-width="125px">
            <el-form-item label="姓名">
                <el-input v-model="form.expertname" placeholder="请输入姓名"></el-input>
            </el-form-item>
            <el-form-item label="职称">
                <el-select v-model="form.du_academic" placeholder="请选择职称">
                    <el-option label="教授" value="1"></el-option>
                    <el-option label="副教授" value="2"></el-option>
                    <el-option label="讲师" value="3"></el-option>
                    <el-option label="助教" value="4"></el-option>
                    <el-option label="高级实验师" value="5"></el-option>
                    <el-option label="实验师" value="6"></el-option>
                    <el-option label="助理实验师" value="7"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学历">
                <el-select v-model="form.du_education" placeholder="请选择学历">
                    <el-option label="大专" value="1"></el-option>
                    <el-option label="研究生" value="2"></el-option>
                    <el-option label="本科" value="3"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="学位">
                <el-select v-model="form.du_degree" placeholder="请选择学位">
                    <el-option label="硕士" value="1"></el-option>
                    <el-option label="博士" value="2"></el-option>
                    <el-option label="学士" value="3"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="年龄">
                <el-input v-model="form.du_age" placeholder="请输入您的年龄(数字)"></el-input>
            </el-form-item>

            <el-form-item label="担任学术团体名称">
                <el-input v-model="form.du_name" placeholder="请输入担任学术团体名称"style="width: 400px;"></el-input>
                <el-select v-model="form.level" placeholder="担任学术团体级别" style="width: 200px;">
                    <el-option label="省级" value="1"></el-option>
                    <el-option label="国家级" value="2"></el-option>
                    <el-option label="国际级" value="3"></el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="所任职务">
                <el-input v-model="form.du_duty" placeholder="请输入所任职务"></el-input>
            </el-form-item>
            <el-form-item label="担任职务年限">
                <el-date-picker
                        v-model="form.data1"
                        type="date"
                        placeholder="选择日期">
                </el-date-picker>
                <span>-</span>
                <el-date-picker
                        v-model="form.data2"
                        type="date"
                        placeholder="选择日期">
                </el-date-picker>
            </el-form-item>
            <el-form-item label="备注">
                <el-input type="textarea" v-model="form.desc"></el-input>
            </el-form-item>
            <el-form-item label="证书图片">
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
</template>

<style scoped>
    .content{
        width: 80%;
        display: flex;
        margin-top: 20px;
        /*margin-left: 130px;*/
        /*background-color: plum;*/
    }
    /*组件*/
    .el-form{
        width:62%;
        margin-top: 40px;
        margin-left: 150px;
    }
</style>
<script>
    export default {
        data() {
            return {
                form: {
                    expertname:'',
                    level:'',

                    du_academic:'',
                    du_education:'',
                    du_degree:'',
                    du_age:'',
                    du_name:'',
                    du_duty:'',
                    du_year_num: '',
                    data1:'',
                    date2: '',
                    delivery: false,
                    type: [],
                    desc: '',
//                    radio: '1'
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