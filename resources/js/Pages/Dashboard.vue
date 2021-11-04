<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
                    <span class="capitalize ml-2">Dashboard</span>
                </h2>
            </div>
        </template>
        
        <post-form :method="submit" :form="form" :text="'Post'"></post-form>

        <suggestion-block :suggestions="suggestions"></suggestion-block>

        <!-- <combined-posts :posts="combinedPosts.data"></combined-posts> -->

        <infinite-scroll @loadMore="loadMorePosts">
                <combined-posts :posts="allPosts.data" :paginations="pagination"></combined-posts>
        </infinite-scroll>

    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'  
    import PagesLayout from '@/Layouts/PagesLayout.vue'
    import CombinedPosts from '@/Components/PostComment/CombinedPosts.vue'
    import PostForm from '@/Components/PostComment/PostForm.vue'
    import SuggestionBlock from '@/Components/SuggestionBlock.vue'
    import InfiniteScroll from '@/Components/InfiniteScroll.vue'

    import BlueButton from '@/Components/Buttons/BlueButton'
    import { TrinityRingsSpinner } from 'epic-spinners'
    import JetInputError from '@/Jetstream/InputError.vue'

    export default defineComponent({
        components: {
            PagesLayout,
            CombinedPosts,
            JetInputError,
            BlueButton,
            TrinityRingsSpinner,
            PostForm,
            SuggestionBlock,
            InfiniteScroll,

            BlueButton,
            TrinityRingsSpinner,
            JetInputError,
        },
        props: [
            'combinedPosts', 'suggestions'
        ],
        data() {
            return {
                form: this.$inertia.form({
                    user_id: this.$page.props.user.id,
                    body: this.body,
                }),
                allPosts: this.combinedPosts,
            }
        },
        computed: {
            pagination() {
                return this.allPosts = this.combinedPosts
            }
        },
        methods: {
            submit(){
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.body = null
                    }
                })
            },
            loadMorePosts() {
                if (!this.allPosts.next_page_url) {
                    return
                }
                return axios.get(this.allPosts.next_page_url)
                    .then(resp => {
                        this.allPosts = {
                            ...resp.data,
                            data: [
                                ...this.allPosts.data, ...resp.data.data
                            ]
                        }
                    })
            }
        },
    })
</script>
