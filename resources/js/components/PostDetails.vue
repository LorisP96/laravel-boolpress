<template>
  <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ post.title }}</h4>
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

<style>

</style>