<template>
    <div v-for="(comment, index) in comments" :key="index">
        <comment-item :comment="comment"></comment-item>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import CommentItem from './CommentItem.vue'

    export default defineComponent({
        components: { 
            CommentItem 
        },
        props:[
            'comments',
        ],
    })
</script>
