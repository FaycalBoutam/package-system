<script setup>
</script>
<template>
    <div v-if="$page.props.flash.success">
        <p class="bg-green-600 text-white py-2 font-bold text-center">
            {{ $page.props.flash.success }}
        </p>
    </div>
</template>
