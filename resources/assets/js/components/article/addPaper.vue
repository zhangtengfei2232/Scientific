<template>
    <div class="contents">
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
                <el-form-item label="发表时间">
                    <el-col :span="15">
                        <el-date-picker type="date"
                            placeholder="选择日期"
                            v-model="form.art_time"
                            style="width: 100%;"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"></el-date-picker>
                        </el-col>
                </el-form-item>
                <el-form-item label="发表刊物名称">
                    <el-input v-model="form.publication_name" maxlength="100"></el-input>
                </el-form-item>
                <el-form-item label="刊号">
                    <el-input v-model="form.publication_num" maxlength="50"></el-input>
                </el-form-item>
                <el-form-item label="年，卷，期" v-model="form.period">
                    <el-col :span="1" style="width:50px;margin:0 10px 0 0">
                        <el-date-picker
                            v-model="year1"
                            type="year"
                            value-format="timestamp"
                            placeholder="年"
                            style="width: 100px;">
                        </el-date-picker>
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
                        <el-input v-model="year4" placeholder="起始页"></el-input>
                    </el-col>
                    <el-col :span="1" style="width:80px;margin:0px -51px 0px 14px">
                        -
                    </el-col>
                    <el-col :span="1"  style="width:80px;margin:0 10px 0 0">
                        <el-input v-model="year5" placeholder="结束页"></el-input>
                    </el-col>
                </el-form-item>
                <el-form-item label="字数">
                    <el-input v-model="form.num_words"></el-input>
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
                <el-form-item label="备注">
                    <el-input type="textarea" v-model="form.art_remarks"></el-input>
                </el-form-item>
                <el-form-item label="论文全文PDF上传">
                    <el-upload
                            class="upload-demo"
                            drag
                            action="#"
                            :limit="1"
                            multiple
                            ref="art_pdf"
                            accept=".pdf,.PDF"
                            :on-change="fileArtpdf"
                            :auto-upload="false">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="SCI索引检索报告">
                    <el-upload
                            class="upload-demo"
                            drag
                            action="#"
                            :limit="1"
                            multiple
                            accept=".pdf,.PDF"
                            ref="art_sci"
                            :on-change="fileArtsci"
                            :auto-upload="false">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    </el-upload>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit(form,year2,year3,year4,year5,year1)">添 加</el-button>
                    <el-button><router-link to="/paper">取消</router-link></el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<style scoped>
    .contents{
        width: 85%;
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
                year1: '',
                year2: '',
                year3: '',
                year4: '',
                year5: '',
                art_road: '',
                art_sci_road: '',
                art_id:'',
                dataForm: new FormData(),
                Bcode:false,
                form: {
                    author: '',
                    art_all_author: '',
                    title: '',
                    art_time: '',
                    publication_name: '',
                    publication_num : '',
                    num_words: '',
                    sch_percal_cate: '',
                    belong_project: '',
                    art_cate_research: '',
                    art_sub_category: '',
                    art_integral: '',
                    percal_cate: '',
                    art_remarks: "",
                    period:''
                }
            }
        },
        methods: {
            fileArtpdf(file){
                if(file !== ''){
                    this.dataForm.append('art_road', file.raw);
                }else{
                    this.$message.error('请先添加pdf信息');
                    return false
                }
            },
            fileArtsci(file){
                this.dataForm.append('art_sci_road',file.raw);
            },
            onSubmit(form,year2,year3,year4,year5,year1) {
                let vue = this;
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
                }else if(form.periodical_cate == '') {
                    this.$message.error('期刊级别不能为空');
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
                    if (valid) {
                        jQuery.each(vue.form,function(i,val){
                            vue.dataForm.append(i,val);
                        });
                        vue.addArticleData(vue.dataForm).then(res => {
                            var data = res.data;
                            if (data.code == 0) {
                                vue.$message({
                                    message: data.message,
                                    type: 'success'
                                });
                                this.Bcode = true;
                                vue.art_id = res.data.datas;
                                this.$router.push({path: '/paper'});
                            } else {
                                vue.$notify({
                                    type: 'error',
                                    message: data.message,
                                    duration: 2000,
                                });
                            }
                        })
                    } else {
                        vue.$notify({
                            type: 'error',
                            message: "提交失败",
                            duration: 2000,
                        });
                    }
                })
            },
            addArticleData(data) {
                return axios({
                    method: 'post',
                    url: 'addartical',
                    headers: {'Content-Type': 'multipart/form-data'},
                    timeout: 20000,
                    data: data
                });
            },
            checkFileExt(filename){
                if(filename == '') {
                    this.$message.error('上传文件不能为空');
                }
                var flag = false;
                var arr = ["pdf"];
                var index = filename.lastIndexOf(".");
                var ext = filename.substr(index+1);
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
        },
    }
</script>
