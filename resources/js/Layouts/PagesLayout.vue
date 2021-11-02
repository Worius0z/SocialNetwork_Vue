<template>
    <app-layout>
        <div class="lg:px-10">
            <div>
                <slot name="title"></slot>
            </div>
            <div class="mt-5">
                <slot></slot>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue' 
    export default defineComponent({
        components: {
            AppLayout,
            //PagesLayout,
            //Welcome,
        },
    })
</script>