<template>
    <div>
        <h1 class="title">Hello Scientific!</h1>
        <el-button @click="test">按钮</el-button>
        <el-dialog :visible.sync="visible" title="Hello world">
            <p>欢迎使用Element</p>
        </el-dialog>
        <p class="hello">{{ this.msg }}</p>
        <el-button @click="sub">提交</el-button>
        <el-input v-model="this.informa"></el-input>
    </div>
</template>

<script>
    export default {
      data() {
          return{
              visible: false,
              msg    : '这是一个科研项目！！！！！!',
              informa: '坏小哥'
          }
      },
        methods: {
          test() {
              this.visible=true;
          },
          sub() {
             let self = this;
             this.$axios.post('test',{

             }).then(
                 function (response) {
                     let datas    = response.data.datas[0];
                     let message  = response.data.message;
                     self.informa = datas.title;
                     self.$message({
                         showClose: true,
                         message: message,
                         type: 'success'
                     })
                 }
             )
            }
        }
    }
</script>

<style scoped>
    .hello {
        text-align: center;
        font-size: 2em;
        color: green;
    }
    .title {
        margin-top: 13%;
        text-align: center;
    }

</style>