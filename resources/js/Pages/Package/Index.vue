<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
                        <th v-if="user_role <=1"></th>
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
                        <td v-if="user_role <=1">
                            <Link :href="route('packages.edit', pack.id)">Edit</Link>
                            <PrimaryButton 
                                v-if="user_role == 0" 
                                @click="removePackage(pack.id)" 
                                :class="{ 'opacity-25': form.processing }" 
                                :disabled="form.processing">
                                Remove
                            </PrimaryButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
