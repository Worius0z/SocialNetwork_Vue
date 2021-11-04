<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <span class="underline">
                        {{ `${$page.props.user.username}'s Friends` }}
                    </span>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Browse
                    <Link :href="route('members.index')" class="underline hover:text-green-500">
                        members
                    </Link>
                </span>
            </div>
        </template>
        <div >
            <h3 class=" font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friend Requests: 
            </h3>
            <div v-if="requests.length <= 0">
                <h3>Bạn chưa có yêu cầu kết bạn nào</h3>
            </div>
            <user-block :items="requests"></user-block>
        </div>
        <div >
            <h3 class=" font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friends: 
            </h3>
            <div v-if="friends.length <= 0">
                <h3>Bạn chưa có bạn bè</h3>
                
            </div>
            <user-block :items="friends"></user-block>
        </div>

    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link}  from '@inertiajs/inertia-vue3'
    import PagesLayout from '@/Layouts/PagesLayout.vue'
    import UserBlock from '@/Components/UserBlock.vue'

    export default defineComponent({
        setup() {
            
        },
        props: [
            'friends',
            'requests',
        ],
        components: {
            PagesLayout,
            Link,
            UserBlock,
        }
    })
</script>
