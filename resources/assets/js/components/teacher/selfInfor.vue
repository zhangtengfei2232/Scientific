<template>
    <div>
        <div class=""></div>
        <h1>{{ this.$route.params.teacher_id }}</h1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ArticleSelfData: {},
        }
    },

    methods: {
        getArticleSelfData() {
                let self = this;
                axios.get("selectallattical").then(function (response) {
                    var data = response.data;
                    if (data.code == 0) {
                        self.ArticleDate = data.datas;
                        console.log(data.datas);
                    } else {
                        self.$notify({
                            type: 'error',
                            message: data.msg,
                            duration: 2000,
                        });
                    }
                });
            }
    }
}
</script>
