<template>
    <form @submit.prevent="ignoreRequest">
        <jet-danger-button type="submit" class="text-xs">
            <trinity-rings-spinner
                :animation-duration="1500"
                :size="20"
                color="#ff1d5e"
                v-if="loading"
            />
            <template v-else>
                Ignore
                <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
            </template>
            
        </jet-danger-button>
    </form>
</template>

<script>
    import {defineComponent} from 'vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import { TrinityRingsSpinner } from 'epic-spinners'

import Icon from '../Icon.vue'
    export default defineComponent({
        props: [
            'profile',
        ],
        components: {
            JetDangerButton,
            Icon, 
            TrinityRingsSpinner,   
        },
        data(){
            return{ 
                loading: false
            }
        },
        methods: {
            ignoreRequest() {
                this.loading=true
                this.$inertia.get(this.route('friends.deny', this.profile.id) 
                , {
                    onSuccess: ()=>{
                        this.loading=false
                    }
                })
                
            }
        },
    })
</script>