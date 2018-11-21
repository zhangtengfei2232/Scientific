<template>
    <div>
        <div class="table">
            <div class="information">
                <div class="add">
                    <el-form ref="form" :model="form" label-width="200px">
                        <el-form-item label="第一作者（通讯录作者）">
                            <el-input v-model="form.author" maxlength="100"></el-input>
                        </el-form-item>
                        <el-form-item label="全部作者">
                            <el-input v-model="form.art_all_author" maxlength="200"></el-input>
                        </el-form-item>
                        <el-form-item label="论文题目">
                            <el-input v-model="form.title" maxlength="150"></el-input>
                        </el-form-item>
                        <el-form-item label="发表时间" >
                            <el-col :span="15">
                            <el-date-picker
                                v-model="form.art_time"
                                type="date"
                                placeholder="选择日期"
                                format="yyyy 年 MM 月 dd 日"
                                value-format="timestamp"
                                style="width: 100%;">
                            </el-date-picker>
                            </el-col>
                        </el-form-item>
                        <el-form-item label="发表刊物名称">
                            <el-input v-model="form.publication_name" maxlength="150"></el-input>
                        </el-form-item>
                        <el-form-item label="刊号">
                            <el-input v-model="form.publication_num" maxlength="20"></el-input>
                        </el-form-item>
                        <el-form-item label="年，卷，期">
                            <el-col :span="1" style="width:50px;margin:0 10px 0 0">
                               <el-date-picker
                               v-model="year1"
                               type="year"
                               placeholder="选择年份"
                               style="width: 100px;"
                               format="yyyy 年 MM 月 dd 日"
                               value-format="timestamp"></el-date-picker>
                            </el-col>
                            <el-col :span="1" style="width:50px;margin: 0px -36px 0px 6%;">
                                ，
                            </el-col>
                            <el-col :span="1" style="width:80px;margin:0 10px 0 0">
                                <el-input v-model="year2" placeholder="卷"></el-input>
                            </el-col>
                            <el-col :span="1"  style="width:80px;margin:0px -57px 0px 0px">
                                (
                            </el-col>
                            <el-col :span="1"  style="width:80px;margin:0 10px 0 0">
                                <el-input v-model="year3" placeholder="卷号"></el-input>
                            </el-col>
                            <el-col :span="1" style="width:80px;margin:0 10px 0 0">
                                )
                            </el-col>
                            <el-col :span="1" style="width:80px;margin:0px -37px 0px -47px;">
                                :
                            </el-col>
                            <el-col :span="1" style="width:80px;margin:0 10px 0 0">
                                <el-input v-model="year4" placeholder="开始期"></el-input>
                            </el-col>
                            <el-col :span="1" style="width:80px;margin:0px -51px 0px 14px">
                                -
                            </el-col>
                            <el-col :span="1"  style="width:80px;margin:0 10px 0 0">
                                <el-input v-model="year5" placeholder="结束期"></el-input>
                            </el-col>
                        </el-form-item>
                        <el-form-item label="字数">
                            <el-input v-model="form.num_words" maxlength="20"></el-input>
                        </el-form-item>
                        <el-form-item label="期刊级别">
                            <el-radio-group v-model="form.percal_cate">
                                <el-radio :label="0" style="margin:10px">SCI一区</el-radio>
                                <el-radio :label="1" style="margin:10px">SCI二区</el-radio>
                                <el-radio :label="2" style="margin:10px">SCI三区</el-radio>
                                <el-radio :label="3" style="margin:10px">SCI四区</el-radio>
                                <el-radio :label="4" style="margin:10px">EI</el-radio>
                                <el-radio :label="5" style="margin:10px">SSCI</el-radio>
                                <el-radio :label="6" style="margin:10px">CN</el-radio>
                                <el-radio :label="7" style="margin:10px">CSSCI核心库</el-radio>
                                <el-radio :label="8" style="margin:10px">中文核心</el-radio>
                                <el-radio :label="9" style="margin:10px">CSCD核心库</el-radio>
                                <el-radio :label="10" style="margin:10px">河南科技学院期刊</el-radio>
                            </el-radio-group>
                        </el-form-item>
                        <el-form-item label="所属项目">
                            <el-input v-model="form.belong_project" maxlength="100"></el-input>
                        </el-form-item>
                        <el-form-item label="研究类别">
                            <el-select v-model="form.art_cate_research" placeholder="请选择类别">
                                <el-option label="基础研究" value="0"></el-option>
                                <el-option label="应用研究" value="1"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="学科门类">
                            <el-select v-model="form.art_sub_category" placeholder="请选择学科门类">
                                <el-option label="理学" value="0"></el-option>
                                <el-option label="工学" value="1"></el-option>
                                <el-option label="农学" value="2"></el-option>
                                <el-option label="医学" value="3"></el-option>
                                <el-option label="管理学" value="4"></el-option>
                                <el-option label="马克思主义" value="5"></el-option>
                                <el-option label="哲学" value="6"></el-option>
                                <el-option label="逻辑学" value="7"></el-option>
                                <el-option label="宗教学" value="8"></el-option>
                                <el-option label="语言学" value="9"></el-option>
                                <el-option label="中国文学" value="10"></el-option>
                                <el-option label="外国文学" value="11"></el-option>
                                <el-option label="艺术学" value="12"></el-option>
                                <el-option label="历史学" value="13"></el-option>
                                <el-option label="考古学" value="14"></el-option>
                                <el-option label="经济学" value="15"></el-option>
                                <el-option label="政治学" value="16"></el-option>
                                <el-option label="法学" value="17"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="积分">
                            <el-input v-model="form.art_integral" maxlength="20"></el-input>
                        </el-form-item>
                        <el-form-item label="学校认定刊物级别">
                            <el-input v-model="form.sch_percal_cate" maxlength="100"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="onSubmit(form,year2,year3,year4,year5,year1)">保存修改</el-button>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="warning" size="mini" @click="watchPDF()">查看论文</el-button>
                        </el-form-item>
                        <el-form-item label="论文全文PDF上传">
                            <el-upload
                                class="upload-demo"
                                action="#"
                                multiple
                                ref="art_pdf"
                                :on-change="fileArtpdf"
                                :auto-upload="false"
                                :limit="1">
                                <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                                <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                            </el-upload>
                        </el-form-item>
                        <el-form-item v-show="pdfType">
                            <el-button type="warning" size="mini" @click="watchSCI()">查看SCI</el-button>
                        </el-form-item>
                        <el-form-item label="SCI索引检索报告">
                            <el-upload
                                class="upload-demo"
                                action="#"
                                multiple
                                ref="art_sci"
                                :on-change="fileArtsci"
                                :auto-upload="false"
                                :limit="1">
                                <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                                <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                            </el-upload>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
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
            ArticleSelfData: {},
            dataForm: new FormData(),
            dataFile: new FormData(),
            year1: '',
            year2: '',
            year3: '',
            year4: '',
            year5: '',
            art_road: '',
            art_id:'',
            art_sci_road: '',
            pdfType:false,
            id_nav:false,
            form: {
                author: '',
                art_all_author: '',
                title: '',
                publication_name: '',
                publication_num : '',
                num_words: 0,
                periodical_cate: '',
                belong_project: '',
                art_cate_research: 0,
                art_sub_category: '',
                art_integral: 0,
                period: '',
                percal_cate: 0,
                sch_percal_cate:'',
                art_time: '',
                period:''
            },
        }
    },

    methods: {
        watchPDF() {
            let urls =  `showfile?disk=artical&subjection=${this.art_road}`;
            window.open(urls, '_blank');
        },
        watchSCI() {
            let urls =  `showfile?disk=artical&subjection=${this.art_sci_road}`;
            window.open(urls, '_blank');
        },
        submitUpload(){
            let id = this.art_id;
            this.dataFile.append('art_id', id);
            if (this.id_nav = true) {
                this.sendfile(this.dataFile);
            }else{
                this.$message.error('文件不能为空');
            }
        },
        fileArtpdf(file){
            this.dataFile.append('art_road', file.raw);
            this.id_nav = true;
        },
        sendfile(dataFile) {
            this.addBookFile(this.dataFile).then(res => {
                var data = res.data;
                if (data.code == 0) {
                    this.$message({
                        message: '修改成功',
                        type: 'success'
                    });
                    location. reload();
                } else {
                    this.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            })
        },
        addBookFile(data) {
            return axios({
                method: 'post',
                url: 'updatearticalself',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
        fileArtsci(file){
            this.dataFile.append('art_sci_road', file.raw);
        },
        getArticleSelfData() {
            let self = this;
            self.art_id = self.$route.params.art_id;
            axios.get("selectartical?art_id="+self.art_id).then(function (response) {
                var data = response.data;
                if (data.code == 0) {
                    self.ArticleSelfData = data.datas;
                    self.art_road = data.datas.art_road;
                    if(data.datas.art_sci_road != ''){
                        self.pdfType = true;
                        self.art_sci_road = data.datas.art_sci_road;
                    }
                    self.ArticleSelfData.art_cate_research = String(data.datas.art_cate_research);
                    self.ArticleSelfData.art_sub_category = String(data.datas.art_sub_category);
                    let time = data.datas.period;
                    self.checkYearExt(time);
                    self.form = data.datas;
                } else {
                    self.$notify({
                        type: 'error',
                        message: data.message,
                        duration: 2000,
                    });
                }
            });
        },
        onSubmit(form,year2,year3,year4,year5,year1) {
            form.period = year1+","+year2+","+year3+","+year4+","+year5;
            if(form.author == '') {
                this.$message.error('第一作者不能为空');
                return
            }else if(form.art_all_author == ''){
                this.$message.error('全部作者不能为空');
                return
            }else if(form.title == '') {
                this.$message.error('论文题目不能为空');
                return
            }else if(form.publication_name == '') {
                this.$message.error('发表刊物名称不能为空');
                return
            }else if(form.publication_num == '') {
                this.$message.error('刊号不能为空');
                return
            }else if(year1 == '') {
                this.$message.error('年，卷，期不能为空');
                return
            }else if(year2 == '') {
                this.$message.error('年，卷，期不能为空');
                return
            }else if(year3 == '') {
                this.$message.error('年，卷，期不能为空');
                return
            }else if(year4 == '') {
                this.$message.error('年，卷，期不能为空');
                return
            }else if(year5 == '') {
                this.$message.error('年，卷，期不能为空');
                return
            }else if(form.num_words == '') {
                this.$message.error('字数不能为空');
                return
            }else if(form.periodical_cate == '') {
                this.$message.error('期刊级别不能为空');
                return
            }else if(form.belong_project == '') {
                this.$message.error('所属项目不能为空');
                return
            }else if(form.art_cate_research == '') {
                this.$message.error('研究类别不能为空');
                return
            }else if(form.art_sub_category == '') {
                this.$message.error('学科门类不能为空');
                return
            }else if(form.art_integral == '') {
                this.$message.error('积分不能为空');
                return
            }else if(form.name == '') {
                this.$message.error('学校认定刊物级别不能为空');
                return
            }
            this.$refs['form'].validate((valid) => {
                let vue = this;
                if (valid) {
                    jQuery.each(vue.form,function(i,val){
                        vue.dataForm.append(i,val);
                    });
                    vue.updateArtical(vue.dataForm).then(res => {
                        var data = res.data;
                        if (data.code == 0) {
                            vue.$message({
                                message: '修改成功',
                                type: 'success'
                            });
                            this.$router.push({path: '/paper'});
                        } else {
                            vue.$notify({
                                type: 'error',
                                message: data.message,
                                duration: 2000,
                            });
                        }
                    })
                    vue.$refs.art_pdf.submit()
                } else {
                    console.log('error submit!!')
                    return false
                }
            })
        },
        updateArtical(data) {
            return axios({
                method: 'post',
                url: 'updatearticalinformation',
                headers: {'Content-Type': 'multipart/form-data'},
                timeout: 20000,
                data: data
            });
        },
        checkFileExt(filename){
            if(filename == '') {
                this.$message.error('上传文件不能为空');
            }
            var flag = false; //状态
            var arr = ["pdf"];
            //取出上传文件的扩展名
            console.log(filename);
            var index = filename.lastIndexOf(".");
            var ext = filename.substr(index+1);
            //循环比较
            for(var i=0;i<arr.length;i++){
                if(ext == arr[i]){
                    flag = true;
                    break;
                }
            }
            if(!flag){
                this.$message.error('请上传PDF');
            }
        },
        checkYearExt(time){
            let a = time.split(',');
            this.year1 = a[0];
            this.year2 = a[1];
            this.year3 = a[2];
            this.year4 = a[3];
            this.year5 = a[4];
        },
    },
    mounted() {
        this.getArticleSelfData();
    }
}
</script>
