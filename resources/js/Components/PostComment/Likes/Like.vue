<template>
    <div class="flex item-center">
        <span>{{ item.liked }}</span>
        <form @submit.prevent="method">
            <button type="submit" class="focus:outline-none">
                <icon name="thumbs-up" class="w-3 h-3 fill-current hover:text-green-600"></icon>
            </button>

        </form>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import Icon from '@/Components/Icon.vue'
    export default defineComponent({
        
        props: [
            'item', 'method'
        ],
        components: {
            Icon,
        }
    })
</script>
