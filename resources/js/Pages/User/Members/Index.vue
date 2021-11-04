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
                    <Link :href="route('friends.index')" class="underline hover:text-green-500">
                        <b>friends</b> 
                    </Link>
                </span>
            </div>
        </template>
        <!-------Phan trang members---->
            <infinite-scroll @loadMore="loadMoreMembers">
                <user-block :items="allMembers.data"></user-block>
            </infinite-scroll>

    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import PagesLayout from '@/Layouts/PagesLayout.vue'
    import UserBlock from '@/Components/UserBlock.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import InfiniteScroll from '@/Components/InfiniteScroll.vue';
    export default defineComponent({
        components: {
            PagesLayout,
            Link,
            UserBlock,
            InfiniteScroll,
        },
        props: [
            'members',
        ],
        data() {
            return {
                allMembers: this.members
            }
        },
        methods: {
            loadMoreMembers() {
                if (!this.allMembers.next_page_url) {
                    return
                }
                return axios.get(this.allMembers.next_page_url)
                    .then(resp => {
                        this.allMembers = {
                            ...resp.data,
                            data: [
                                ...this.allMembers.data, ...resp.data.data
                            ]
                        }
                    })
            }
        },
    })
</script>