<template>
     <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="200px">
                <el-form-item label="第一获奖人">
                    <el-input v-model="form.author"></el-input>
                </el-form-item>
                <el-form-item label="全部获奖人">
                    <el-input v-model="form.art_all_author"></el-input>
                </el-form-item>
                <el-form-item label="获奖成果名称">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="奖励名称">
                    <el-input v-model="form.publication_name"></el-input>
                </el-form-item>  
                <el-form-item label="成果形式">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="论文" value="1"></el-option>
                        <el-option label="研究报告" value="2"></el-option>
                        <el-option label="新技术" value="3"></el-option>
                        <el-option label="新工艺" value="4"></el-option>
                         <el-option label="课件" value="1"></el-option>
                        <el-option label="新产品" value="2"></el-option>
                        <el-option label="专著" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="计算机软件" value="3"></el-option>
                        <el-option label="教材" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="等级">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="一等奖" value="1"></el-option>
                        <el-option label="二等奖" value="2"></el-option>
                        <el-option label="三等奖" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="奖励级别">
                    <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                        <el-option label="专著" value="1"></el-option>
                        <el-option label="教科书" value="2"></el-option>
                        <el-option label="译著" value="3"></el-option>
                        <el-option label="编著" value="4"></el-option>
                        <el-option label="其他" value="5"></el-option>
                    </el-select>
                </el-form-item>
                 <el-form-item label="授奖单位">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="授奖时间">
                    <el-col :span="15">
                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>  
                <el-form-item label="证书编号">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="我校名次">
                    <el-input v-model="form.publication_num"></el-input>
                </el-form-item>
                <el-form-item label="积分">
                    <el-input v-model="form.art_integral"></el-input>
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
            AwardSelfData: {},
            input: '',
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
                year: '',
                date2: '',
                delivery: false,
                type: [],
                resource: '',
                desc: '',
            },
        }
    },

    methods: {
        getBookSelfData() {
                let self = this;
                let art_id = self.$route.params.art_id;
                axios.get("",art_id).then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.AwardSelfData = data.datas;
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
        this.getBookSelfData();
    }
}
</script>
