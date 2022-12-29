<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Multiselect from '@vueform/multiselect';

const props = defineProps({
    users: Object,
    pack: Object
});

const form = useForm({
    user_id: props.pack.user_id,
    status: props.pack.status,
    note: props.pack.note,
});

const submit = () => {
    form.patch(route('packages.update', props.pack.id));
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Package" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">

                        <!-- User -->
                        <div>
                            <InputLabel for="apartment" value="App" />

                            <Multiselect
                                id="apartment"
                                v-model="form.user_id"
                                placeholder="Assign to appartement"
                                track-by="id"
                                label="apartment"
                                :searchable="true"
                                :options="users"
                            />

                            <InputError class="mt-2" :message="form.errors.user_id" />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <InputLabel for="status" value="Status" />

                            <Multiselect
                                id="status"
                                v-model="form.status"
                                placeholder="Status of the package"
                                :options="['Arrived', 'Delivering', 'Delivered', 'Returned']"
                            />

                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                        <!-- Note -->
                        <div class="mt-4">
                            <InputLabel for="note" value="Notes (the package owner can see this)" />

                            <textarea 
                                id="note" 
                                class="mt-1 block w-full" 
                                v-model="form.note"
                                name="note"
                                placeholder="Add if needed">
                            </textarea>

                            <InputError class="mt-2" :message="form.errors.note" />
                        </div>

                        <div class="mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update Package
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </AuthenticatedLayout>
</template>
