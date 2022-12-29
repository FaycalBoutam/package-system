<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from '@vueform/multiselect';

const props = defineProps({
    user: Object,
    loggedInRole: Number
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    phone: props.user.phone,
    apartment: props.user.apartment,
    role: props.user.role,
    password: props.user.password,
});

const submit = () => {
    form.patch(route('dashboard.update', props.user.id), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Package" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="loggedInRole == 0">
                        <form @submit.prevent="submit">
                
                            <!-- First Name -->
                            <div>
                                <InputLabel for="first_name" value="First Name" />
                                
                                <TextInput
                                    id="first_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.first_name"
                                    required
                                    autofocus
                                    autocomplete="first_name"
                                />
                
                                <InputError class="mt-2" :message="form.errors.first_name" />
                            </div>
                
                            <!-- Last Name -->
                            <div class="mt-4">
                                <InputLabel for="last_name" value="Last Name" />
                                
                                <TextInput
                                    id="last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.last_name"
                                    required
                                    autocomplete="last_name"
                                />
                
                                <InputError class="mt-2" :message="form.errors.last_name" />
                            </div>

                            <!-- Email -->
                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                                
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                />
                
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <!-- Phone -->
                            <div class="mt-4">
                                <InputLabel for="phone" value="Phone" />
                                
                                <TextInput
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                    required
                                    autocomplete="phone"
                                />
                
                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <!-- Apartment -->
                            <div class="mt-4">
                                <InputLabel for="apartment" value="Apartment" />
                                
                                <TextInput
                                    id="apartment"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.apartment"
                                    required
                                    autocomplete="apartment"
                                />
                
                                <InputError class="mt-2" :message="form.errors.apartment" />
                            </div>

                            <!-- Role -->
                            <div class="mt-4">
                                <InputLabel for="role" value="Role" />
                                
                                <Multiselect
                                    id="role"
                                    v-model="form.role"
                                    placeholder="Role"
                                    :options="[
                                        { value: 0, label: 'Admin' },
                                        { value: 1, label: 'Staff' },
                                        { value: 2, label: 'User' },
                                    ]"
                                />
                
                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <InputLabel for="password" value="Password" />
                                
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                />
                
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                
                            <div class="mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update User
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>

    </AuthenticatedLayout>
</template>
