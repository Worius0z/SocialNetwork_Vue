<template>
    <aside class="flex flex-col bg-white shadow py-6 w-full sm:w-1/4 lg:w-1/6">
        <Link :href="link.route" v-for="link in sideBarLinks" :key="link.name"
        class="flex items-end pl-6 py-2"  :class="route().current(link.route) ? 'text-white bg-gray-800 hover:bg-gray-500' : ' text-gray-800 hover:bg-gray-500 hover:text-white transition duration-150 ease-in-out'">
            <img :src="link.image" :alt="link.alt" class="h-8 w-8 rounded-full object-cover" v-if="link.image">
            <icon class="fill-current w-8 h-8" :name="link.icon" v-if="link.icon"></icon>
            <span class="capitalize ml-2"> {{ link.name }} </span>
        </Link>
    </aside>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Icon from '@/Components/Icon.vue'
    export default defineComponent({
        components:{
            Link,
            Icon,
        },
        computed: {
            sideBarLinks() {
                return [
                    {name: `${this.$page.props.user.username}`, image:`${this.$page.props.user.profile_photo_url}`,alt: `${this.$page.props.user.username}`, 
                    route: route('profiles.show',`${this.$page.props.user.username}`)
                    },

                    {name: 'Members', route: route('members.index'), icon: `users`},

                    {name: 'Friends', route: route('friends.index'), icon: `user-friends`},

                    {name:'edit profile', route: route('profile.show'), icon: `user-edit`},

                    
                ]
            }
        }
    });
</script>