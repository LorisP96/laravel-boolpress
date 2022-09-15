<template>
    <div class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>
            <img v-if="post.cover" :src="post.cover" :alt="post.title" class="w-50">
            <p>{{ post.content }}</p>
            <div v-if="post.tags.length > 0"> Tags:
                <span class="badge badge-danger d-inline-block mr-1" v-for="tag in post.tags" :key="tag.id">{{tag.name}}</span>
            </div>
            <div v-if="post.category"> Categoria:
                <span class="badge badge-success">{{post.category.name}}</span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    mounted() {
        axios.get('/api/posts/' + this.$route.params.slug)
        .then((response) => {
            this.post = response.data.results;
        })
    }
}
</script>

<style>

</style>