<template>
    <div>
        <Header/>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>

import Header from '../components/header';

export default {
    name: 'App',
    components: {
        Header,
    }
}
</script>
