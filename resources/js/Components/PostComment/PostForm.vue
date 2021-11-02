<template>
     <form @submit.prevent="method" class="w-full">
        <div>
            <textarea name="post" id="" rows="3" class="border rounded px-2 py-2 w-full"
            :placeholder="`Hãy viết gì đó ${$page.props.user.username} ...`" v-model="form.body"></textarea>
        </div>
        <div class="flex justify-between my-3">
            <div>
                <jet-input-error :message="form.errors.body" class="mt-2" v-if="form.errors.body">

                </jet-input-error>
            </div>
            <div>
                <blue-button type="submit" class="text-xs" :class="{ 'opacity-25' : form.processing }"
                :disable="form.processing">
                <trinity-rings-spinner
                    :animation-duration="1500"
                    :size="20"
                    color="#ff1d5e"
                    v-if="form.processing"
                />
                <span v-else>{{ text }}</span>
                </blue-button>
            </div>
        </div>

    </form>
</template>

<script>
    import { defineComponent } from 'vue'
    import BlueButton from '@/Components/Buttons/BlueButton'
    import { TrinityRingsSpinner } from 'epic-spinners'
    import JetInputError from '@/Jetstream/InputError.vue'
    export default defineComponent({
        components: {
            BlueButton,
            TrinityRingsSpinner,
            JetInputError,
        },
        props: [
            'method',
            'form',
            'text',
        ],
    })
</script>
