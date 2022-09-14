<template>
    <section>
        <h2 class="text-center m-5">Lista dei Post</h2>
        <div class="container">

            <div class="row row-cols-3">

                <div class="col mb-4" v-for="post in posts" :key="post.id">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ post.title }}</h4>
                            <p class="card-text">{{ sliceContent(post.content) }}</p>
                            <router-link to="post" class="btn btn-info">Visualizza</router-link>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="container mb-5">
                <a @click.prevent="getApi(currentPage - 1)" href="#" type="button" class="btn btn-info" :class="{'disabled' : currentPage == 1}">Prev</a>
                <a v-for="number in lastPage" :key="number" @click.prevent="getApi(number)" href="#" type="button" class="btn btn-info" :class="{'active' : currentPage == number}">{{ number }}</a>
                <a @click.prevent="getApi(currentPage + 1)" href="#" type="button" class="btn btn-info" :class="{'disabled' : currentPage == lastPage}">Next</a>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    name: 'Posts',
    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: null
        }
    },
    methods: {
        getApi(pageNumber) {
            axios.get('/api/posts?page=' + pageNumber)
            .then((response) => {
            this.posts = response.data.results.data;
            this.currentPage = response.data.results.current_page;
            this.lastPage = response.data.results.last_page;
        })
        },
        sliceContent(content) {
            if(content.length > 75) {
                return content.slice(0, 75) + '...';
            } else {
                return content;
            }
        },
    },
    mounted() {
        this.getApi(this.currentPage);
    }
}
</script>
