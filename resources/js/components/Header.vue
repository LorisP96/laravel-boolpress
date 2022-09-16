<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" v-for="link, index in NavLinks" :key="index">
                <router-link :to="{name: link.name}" class="nav-link">{{ link.label }}</router-link>
            </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            NavLinks: [
            {
                name: 'home',
                label: 'Home'
            },
            {
                name: 'about',
                label: 'About'
            },
            {
                name: 'blog',
                label: 'Blog'
            },
            {
                name: 'contacts',
                label: 'Contattaci'
            }
        ]
        }
    }

}
</script>

<style>

</style>