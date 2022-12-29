<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    packages: Object,
    user_role: Number,
});

const form = useForm();

function removePackage(id) {
    if (confirm("Do you really want to remove this package?")) {
        form.delete(route('packages.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Packages" />
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div v-if="!packages.data.length">No packages for you, yet.</div>
                    
                    <div v-else>
                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        #
                                    </th>
                                    <th v-if="user_role == 1 || user_role == 0" class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Apartment
                                    </th>
                                    <th v-if="user_role == 1 || user_role == 0" class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Email
                                    </th>
                                    <th v-if="user_role == 1 || user_role == 0" class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Phone
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Status
                                    </th>
                                    <th class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Note
                                    </th>
                                    <th 
                                    class="border-b dark:border-slate-600 font-medium p-2 pl-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                                        v-if="user_role <= 1"></th>
                                </tr>
                            </thead>
                            <tbody v-for="pack in packages.data" class="bg-white dark:bg-slate-800">
                                <tr>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.id }}
                                    </td>
                                    <td v-if="user_role == 1 || user_role == 0" class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.user.apartment }}
                                    </td>
                                    <td v-if="user_role == 1 || user_role == 0" class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.user.email }}
                                    </td>
                                    <td v-if="user_role == 1 || user_role == 0" class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.user.phone }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.status }}
                                    </td>
                                    <td class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400">
                                        {{ pack.note }}
                                    </td>
                                    <td 
                                        class="border-b border-slate-200 dark:border-slate-600 p-2 pl-4 text-slate-500 dark:text-slate-400" 
                                        v-if="user_role <=1">
                                        <Link
                                            class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                            :href="route('packages.edit', pack.id)">
                                            Edit
                                        </Link>
                                        <button
                                        class="inline-flex items-center px-2 py-1 mt-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" 
                                            v-if="user_role == 0" 
                                            @click="removePackage(pack.id)" 
                                            :class="{ 'opacity-25': form.processing }" 
                                            :disabled="form.processing">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="packages.meta.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
