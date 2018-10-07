<template>
    <div>
        <header>
            <span class="paper">
                论文
            </span>
            <span class="load">
                <router-link to="/">
                    <el-button type="primary"><i class="el-icon-plus el-icon--left">上传</i></el-button>
                </router-link>
            </span>
        </header>
        <div class="navbo">
            <span class="number">序号</span>
            <span class="info">论文信息</span>
            <span class="time">发表时间</span>
            <span class="do">操作</span>
        </div>
        <div class="content">
            <div class="lists" v-for="">
                <span class="numbers"></span>
                <span><img src="" alt=""></span>
                <span class="infos"></span>
                <span class="times"></span>
                <span class="dos"></span>
            </div>
        </div>
    </div>
</template>

<style scoped>
    header{
        border-bottom: 1px solid #eee;
    }
    .paper{
        font-size: 18px;
        color: #090909;
        display: inline-block;
        padding: 23px 60px;

        border-right: 1px solid #eee;
    }
    .load{
        display: inline-block;
        margin: 0;
        padding: 16px 60px;
        border-right: 1px solid #eee;
    }
    .navbo{
        border-bottom: 1px solid #eee;
        background: rgba(187, 187, 187, 0.1);
        height: 40px;
    }
    .info,.number,.do,.time{
        display: inline-block;
        padding: 10px;
        font-size: 14px;
    }
    .number{
        margin: 0 2% 0 3%;
    }
    .time{
        margin: 0 3% 0 50%;
    }
    .lists{
        border-bottom: 1px solid #eee;
        height: 80px;
    }
    .numbers{
        
    }
</style>
<script>
    export default {

        data() {
            return {

            }

        },

    }


</script>