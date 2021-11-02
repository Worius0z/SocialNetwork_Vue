<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <Link :href="route('members.index')" class="capitalize underline">
                        Members
                    </Link>
                </h2>
                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Visit your 
                    <Link href="#" class="underline hover:text-green-500">
                        <b>friends</b> 
                    </Link>
                </span>
            </div>
        </template>
            <user-block :items="members"></user-block>
    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import PagesLayout from '@/Layouts/PagesLayout.vue'
    import UserBlock from '@/Components/UserBlock.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    export default defineComponent({
        components: {
            PagesLayout,
            Link,
            UserBlock,
        },
        props: [
            'members',
        ],
    })
</script>