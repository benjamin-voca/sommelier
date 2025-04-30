<script setup lang="ts">
    import { Head, Link } from '@inertiajs/vue3';
    const search = (s) => fetch(`/api/search?search=${s}`).json()
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-16">
    <div class="grid auto-rows-min gap-4">
        <textarea></textarea>
        <button @click="search(value)">Search</button>
    </div>
    </div>
</template>
