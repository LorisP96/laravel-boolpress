<template>
  <div class="card">
        <div class="card-body">
            <img v-if="post.cover" :src="post.cover" :alt="post.title">
            <h4 class="card-title mt-1">{{ post.title }}</h4>
            <p class="card-text">{{ sliceContent(post.content) }}</p>
            <router-link :to="{name: 'post', params : { slug: post.slug }}" class="btn btn-info">Visualizza</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name:'PostDetails',
    props: {
        post: Object,
    },
    methods: {
        sliceContent(content) {
            if(content.length > 75) {
                return content.slice(0, 75) + '...';
            } else {
                return content;
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.card {
    height: 400px;
    .card-body {
        position: relative;
        img {
            height: calc(100% - 40px);
            width: calc(100% - 40px);
            opacity: 15%;
            position: absolute;
            object-fit: cover;
        }
    }
}
</style>
