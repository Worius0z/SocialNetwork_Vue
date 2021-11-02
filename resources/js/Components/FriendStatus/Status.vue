<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="friendRequestRecievedFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-3"></ignore>
        </template>

        <template v-else-if="friendRequestSentTo">
            <h3 class="font-semibold text--md text-gray-800 leading-tight">
                Pending...
            </h3>
        </template>

        <template v-else-if="isFriendsWith">
            <form @submit.prevent="deleteFriend">
                <jet-danger-button type="submit">
                    <trinity-rings-spinner
                        :animation-duration="1500"
                        :size="20"
                        color="#ff1d5e"
                        v-if="loading"
                    />
                    <template v-else>
                        Unfriend
                        <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
                    </template>
                    
                </jet-danger-button>
            </form>
        </template>

        <template v-else-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <blue-button type="submit" class=" text-xs">
                    <!--hieu ung spinners--->
                    <trinity-rings-spinner
                        :animation-duration="1500"
                        :size="20"
                        color="#ff1d5e"
                        v-if="loading"
                    />
                    <template v-else>
                        Add Friend 
                        <icon class="h-4 w-4 fill-current ml-1" name="add-friend"></icon>
                    </template>
                </blue-button>
            </form>
        </template>
    </div>
</template>

<script>
    import {defineComponent} from 'vue'
    import { TrinityRingsSpinner } from 'epic-spinners'
    import Icon from '@/Components/Icon.vue'
    import BlueButton from '@/Components/Buttons/BlueButton.vue'
    import Accept from '@/Components/FriendStatus/Accept.vue'
    import Ignore from '@/Components/FriendStatus/Ignore.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    export default defineComponent({
        components: { 
            Icon, 
            BlueButton,
            Accept,
            Ignore,
            JetDangerButton,
            TrinityRingsSpinner,
        },
        props: [
            'profile',
            'isFriendsWith',
            'friendRequestSentTo',
            'friendRequestRecievedFrom',
        ],
        data(){
            return {
                
                addFriendForm: this.$inertia.form({
                    user: this.profile 
                }),
                deleteFriendForm: this.$inertia.form({
                    user: this.profile 
                }),
                loading:false,
            }
        },
        methods: {
            addFriend() {
                this.loading = true,
                this.addFriendForm.post(this.route('friends.store', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{
                        this.loading = false
                    },
                })
            },
            deleteFriend() {
                this.loading = true
                this.deleteFriendForm.delete(this.route('friends.destroy', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{
                        this.loading = false
                    },
                })
            }
        }
        
    })
</script>