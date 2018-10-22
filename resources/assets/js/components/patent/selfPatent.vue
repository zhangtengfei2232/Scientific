<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="专利权人">
                    <el-input v-model="form.teacher_id"></el-input>
                </el-form-item>
                <el-form-item label="第一发明人">
                    <el-input v-model="form.first_inventor"></el-input>
                </el-form-item>
                <el-form-item label="全部发明人">
                    <el-input v-model="form.pa_all_author"></el-input>
                </el-form-item>
                 <el-form-item label="专利类型">
                    <el-select v-model="form.pa_type" placeholder="请选择类别">
                        <el-option label="发明专利" value="1"></el-option>
                        <el-option label="实用新型专利" value="2"></el-option>
                        <el-option label="外观设计专利" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="专利名称">
                    <el-input v-model="form.pa_name"></el-input>
                </el-form-item>  
                <el-form-item label="实施情况">
                    <el-select v-model="form.pa_imple_situ" placeholder="请选择类别">
                        <el-option label="授权" value="1"></el-option>
                        <el-option label="受理" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="授权编号或申请号">
                    <el-input v-model="form.author_num"></el-input>
                </el-form-item>
                <el-form-item label="授权证书编号">
                    <el-input v-model="form.author_cert_num"></el-input>
                </el-form-item>
                <el-form-item label="授权公告日或受理日期">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.author_notic_day" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.pa_integral"></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.pa_remarks"></el-input>
                </el-form-item>
                <el-form-item label="专利图片">
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
            PatetSelfData: {},
            form: {
                teacher_id: '',
                first_inventor: '',
                pa_all_author: '',
                pa_type: '',
                pa_name: '',
                pa_imple_situ: '',
                author_num: '',
                author_cert_num: '',
                author_notic_day: '',
                pa_integral: '',
                pa_remarks: '',
            },
        }
    },

    methods: {
        getPatentSelfData() {
                let self = this;
                let art_id = self.$route.params.art_id;
                axios.get("",art_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.PatentSelfData = data.datas;
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
        this.getPatentSelfData();
    }
}
</script>
