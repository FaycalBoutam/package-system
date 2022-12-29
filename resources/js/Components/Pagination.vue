<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    links: Object,
});
</script>

<template>
    <div class="mt-8 float-right">
        <Link 
            v-for="link in links"
            v-html="link.label"
            :class="(link.url ? 'text-blue-500' : 'text-gray-500 pointer-events-none'), (link.active ? 'border-b-4 border-blue-500' : '')"
            class="px-1"
            :href="link.url">
        </Link>
    </div>
</template>