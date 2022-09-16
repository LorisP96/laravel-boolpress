import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './pages/Home'
import About from './pages/About'
import Blog from './pages/Blog'
import NotFound from './pages/NotFound'
import SinglePost from './pages/SinglePost'
import Contacts from './pages/Contacts'

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/blog",
            name: "blog",
            component: Blog
        },
        {
            path: "/blog/:slug",
            name: "post",
            component: SinglePost
        },
        {
            path: "/contact-us",
            name: "contacts",
            component: Contacts
        },
        {
            path: "/*",
            name: "error",
            component: NotFound
        }
    ]
});

export default router;