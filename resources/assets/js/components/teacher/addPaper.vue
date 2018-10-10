<template>
    <div class="contents">
        <div class="add">
            <el-form ref="form" :model="form" label-width="80px">
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
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="字数">
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="期刊级别">
                <el-checkbox-group v-model="form.type">
                <el-checkbox label="CSCD" name="type"></el-checkbox>
                <el-checkbox label="SCI" name="type"></el-checkbox>
                <el-checkbox label="CN" name="type"></el-checkbox>
                <el-checkbox label="CSCD核心" name="type"></el-checkbox>
                </el-checkbox-group>
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
                <el-option label="农学" value="nongxue"></el-option>
                <el-option label="作物学" value="zuowuxue"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="活动时间">
                <el-col :span="11">
                <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                </el-col>
                <el-col class="line" :span="2">-</el-col>
                <el-col :span="11">
                <el-time-picker type="fixed-time" placeholder="选择时间" v-model="form.date2" style="width: 100%;"></el-time-picker>
                </el-col>
            </el-form-item>
            <el-form-item label="即时配送">
                <el-switch v-model="form.delivery"></el-switch>
            </el-form-item>
            <el-form-item label="特殊资源">
                <el-radio-group v-model="form.resource">
                <el-radio label="线上品牌商赞助"></el-radio>
                <el-radio label="线下场地免费"></el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="活动形式">
                <el-input type="textarea" v-model="form.desc"></el-input>
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