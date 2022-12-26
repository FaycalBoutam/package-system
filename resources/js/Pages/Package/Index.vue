<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    packages: Object
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Packages" />

        <div v-if="!packages.data.length">No packages for you, yet.</div>
        <div v-else>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Apartment</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-for="pack in packages.data">
                    <tr>
                        <td>{{ pack.id }}</td>
                        <td>{{ pack.user.apartment }}</td>
                        <td>{{ pack.user.email }}</td>
                        <td>{{ pack.user.phone }}</td>
                        <td>{{ pack.status }}</td>
                        <td>{{ pack.note }}</td>
                        <td>Edit</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
