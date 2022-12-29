<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <FlashMessage />
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('welcome')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink 
                                    v-if="$page.props.auth.user.role == 0"
                                    :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                                    Dashboard
                                </NavLink>
                                <NavLink 
                                    :href="route('packages.index')" :active="route().current('packages.index')">
                                    Packages
                                </NavLink>
                                <NavLink 
                                    v-if="$page.props.auth.user.role == 0 || $page.props.auth.user.role == 1"
                                    :href="route('packages.create')" :active="route().current('packages.create')">
                                    New Package
                                </NavLink>
                                <NavLink 
                                    :href="route('logout')" method="post" as="button">
                                    Log Out
                                </NavLink>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div
                            v-if="$page.props.auth.user.role == 2" 
                            class="flex justify-center flex-col text-slate-500 text-xs text-right space-x-8 sm:-my-px sm:ml-10">
                            <p>Apartment: {{ $page.props.auth.user.apartment }}</p>
                            <p>Email: {{ $page.props.auth.user.email }}</p>
                            <p>Phone: {{ $page.props.auth.user.phone }}</p>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <ResponsiveNavLink :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('packages.index')" :active="route().current('packages.index')">
                        Packages
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </ResponsiveNavLink>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="mx-auto my-4 max-w-6xl">
                <slot />
            </main>
        </div>
    </div>
</template>
