<template>
    <div class="information">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="协议名称">
                    <el-input v-model="form.ag_name"></el-input>
                </el-form-item>
                <el-form-item label="合作单位">
                    <el-input v-model="form.cooperate_unit"></el-input>
                </el-form-item>
                <el-form-item label="协议时间">
                    <el-col :span="15">
                        <el-date-picker type="date" placeholder="选择日期" v-model="form.create_time" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="协议附件pdf">
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
                AgreementeDitData: {},
                form: {
                    ag_name: '',

                    cooperate_unit: '',
                    create_time: '',

                }
            }
        },
        methods: {
            getAgreementeDitData() {
                let self = this;
                let art_id = self.$route.params.art_id;
                axios.get("",art_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AgreementeDitData = data.datas;
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
            this.getAgreementeDitData();
        }
    }
</script>