<template>
    <form @submit.prevent="acceptFriend">
        <green-button type="submit" class="text-xs mr-1">
            <trinity-rings-spinner
                :animation-duration="1500"
                :size="20"
                color="#ff1d5e"
                v-if="loading"
            />
            <template v-else>
                Accept
                <icon name="add-friend" class="h-4 w-4 fill-current ml-1"></icon>
            </template>
        </green-button>
    </form>
</template>

<script>
    import {defineComponent} from 'vue'
    import GreenButton from '@/Components/Buttons/GreenButton.vue'
    import Icon from '@/Components/Icon.vue'
    import { TrinityRingsSpinner } from 'epic-spinners'

    export default defineComponent({
        props: [
            'profile',
        ],
        components: {
            GreenButton,
            Icon,
            TrinityRingsSpinner,
        },
        data() {
            return {
                acceptFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading:false,
            }
        },
        methods: {
            acceptFriend() {
                this.loading = true
                this.acceptFriendForm.patch(this.route('friends.update', this.profile.id)
                , {
                    preserveScroll: true,
                    onSuccess: ()=>{
                        this.loading = false
                    }
                })
            }
        }
    })
</script>