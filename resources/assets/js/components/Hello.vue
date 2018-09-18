<template>
    <div>
        <h1 class="title">Hello Scientific!</h1>
        <el-button @click="test">按钮</el-button>
        <el-dialog :visible.sync="visible" title="Hello world">
            <p>欢迎使用Element</p>
        </el-dialog>
        <p  class="hello">{{ msg }}</p>
    </div>
</template>

<script>
    export default {
      data() {
          return{
              visible: false,
              msg    : '这是一个科研项目！！！！！!',
          }
      },
        methods: {
          test() {
              this.visible=true;
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