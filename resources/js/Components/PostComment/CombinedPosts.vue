<template>
    <div>
        <div v-for="(post, key) in posts" :key="key">
            <post-item :post="post">

            </post-item>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import PostItem from './PostItem.vue'

    export default defineComponent({
        components: {
            PostItem,
        },
        props: [
            'posts',
        ],
    })
</script>