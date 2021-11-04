<template>
    
    <div class="flex flex-col min-h-screen ">
        <nav class="bg-gray-400 border-b border-blue-100 w-full fixed z-20">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <Link :href="route('dashboard.index')" class="h-3/4 w-16">
                               <img :src=" '/storage/images/logo.png' " alt="Logo"> 
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                                Dashboard
                            </jet-nav-link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:justify-end sm:ml-6 w-1/2">


                        <!-- Settings Dropdown -->
                        <div class="flex items-center ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-transparent transition duration-150 ease-in-out">
                                        <template v-if="$page.props.user">
                                            <span class="capitalize">welcome,</span>
                                            <span class="capitalize ml-1 mr-2"> {{$page.props.user.username}}</span> 
                                        </template>
                                        <span class="capitalize" v-else> welcome, user !</span>
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                    </button>

                                <button type="button" class="flex items-center text-sm  font-medium text-gray-500 
                                    hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:border-transparent 
                                    transition duration-150 ease-in-out" v-else>
                                    <div>
                                        {{ $page.props.user.name }}
                                    </div>
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Log Out
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                        Dashboard
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                            <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                        </div>

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                            Profile
                        </jet-responsive-nav-link>

                        <!-- <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link> -->

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Log Out
                            </jet-responsive-nav-link>
                        </form>
                        <!-- Team Management -> Nodepad++ -->
                        <!-- .....  -->
                    </div>
                </div>
            </div>
        </nav>
   
        <div class="flex flex-wrap pt-16 sm:flex-nowrap">
            <!-- Page SideBar -->
            <side-bar></side-bar>
            <!-- Page Content -->
            <main class="bg-gray-200 shadow rounded my-5 py-6 px-4 w-full sm:w-2/3 sm:mx-2 sm:my-3 md:mx-4 md:px-10 lg:mx-auto">
                <slot></slot>
            </main>
        </div> 

    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import SideBar from '@/Components/SideBar.vue';



    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
            SideBar,
   
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            // Khong dùng Team
            // switchToTeam(team) {
            //     this.$inertia.put(route('current-team.update'), {
            //         'team_id': team.id
            //     }, {
            //         preserveState: false
            //     })
            // },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
