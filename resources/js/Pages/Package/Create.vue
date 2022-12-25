<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from '@vueform/multiselect';

const props = defineProps({
    users: Array
});

const form = useForm({
    user_id: '',
    status: '',
    note: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<template>
    <GuestLayout>
        <Head title="Add Package" />

        <!-- user, status, note -->

        <Multiselect
            v-model="value"
            placeholder="Assign to appartement"
            track-by="id"
            label="apartment"
            :close-on-select="false"
            :searchable="true"
            :options="users"
        />

        <form @submit.prevent="submit">
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

            <div class="mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add Package
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
