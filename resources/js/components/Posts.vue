<template>
    <main>
        <h1 class="text-center m-5">Lista dei Post</h1>
        <div class="container">

            <div class="row row-cols-3">

                <div class="col mb-4" v-for="post in posts" :key="post.id">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ post.title }}</h4>
                            <!-- <h6 class="card-subtitle mb-2 text-muted">{{ post.category_id }}</h6> -->
                            <p class="card-text">{{ sliceContent(post.content) }}</p>
                            <!-- <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>

<script>

export default {
    name: 'Posts',
    data() {
        return {
            posts: []
        }
    },
    methods: {
        getArrayFromApi() {
            axios.get('/api/posts')
            .then((response) => {
            this.posts = response.data.results;
        })
        },
        sliceContent(content) {
            if(content.length > 75) {
                return content.slice(0, 75) + '...';
            } else {
                return content;
            }
        }
    },
    mounted() {
        this.getArrayFromApi();
    }
}
</script>
