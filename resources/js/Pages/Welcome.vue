<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link
                v-if="$page.props.auth.user && $page.props.auth.user.role == 0"
                :href="route('dashboard.index')"
                class="text-sm text-gray-700 dark:text-gray-500 underline pr-4"
                >Dashboard</Link
            >
            <Link
                v-if="$page.props.auth.user"
                :href="route('packages.index')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Packages</Link
            >

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div>
                <p>Hi there,</p>
                <p>You can try with one of these accounts:</p>

                <div class="pt-8">
                    <p class="font-bold">User (can only see their packages):</p>
                    <p>email: user@email.com pass: user123</p>
                </div>

                <div class="pt-8">
                    <p class="font-bold">Staff (can see all packages, add & edit them):</p>
                    <p>email: staff@email.com pass: staff123</p>
                </div>

                <div class="pt-8">
                    <p class="font-bold">Admin (like staff but can delete packages & edit users):</p>
                    <p>email: admin@email.com pass: admin123</p>
                </div>
            </div>
        </div>
         
    </div>
</template>
