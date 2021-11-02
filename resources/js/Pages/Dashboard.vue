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

        <combined-posts :posts="combinedPosts.data"></combined-posts>

    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'  
    import PagesLayout from '@/Layouts/PagesLayout.vue'
    import CombinedPosts from '@/Components/PostComment/CombinedPosts.vue'
    import PostForm from '@/Components/PostComment/PostForm.vue'
    import SuggestionBlock from '@/Components/SuggestionBlock.vue'

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
                })
            }
        },
        methods: {
            submit(){
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess: () => {}
                })
            }
        },
    })
</script>
