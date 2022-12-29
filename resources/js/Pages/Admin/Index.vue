<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    users: Object,
    loggedInRole: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="loggedInRole == 0">
                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        #
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        First Name
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Last Name
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Role
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Apartment
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Email
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Phone
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-for="user in users.data" class="bg-white dark:bg-slate-800">
                                <tr>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.id }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.first_name }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.last_name }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.role }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.apartment }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.email }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ user.phone }}
                                    </td>
                                    <td 
                                        class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        <Link
                                            class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                            :href="route('dashboard.edit', user.id)">
                                            Edit
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="users.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
