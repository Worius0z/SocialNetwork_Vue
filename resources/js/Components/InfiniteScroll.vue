<template>
    <slot></slot>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
         mounted() {
            window.addEventListener('scroll', _.debounce((e) =>{
                let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop
                - window.innerHeight
                if(pixelsFromBottom < 200) {
                    this.$emit('loadMore')
                }
            }, 100))
        },
    })
</script>
