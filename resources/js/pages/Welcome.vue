<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const userInput = ref(''); 
const response = ref()

async function fetchData1(){
    const array = await fetch(`http://localhost:8069/api/search?search=a`) 
    response.value = await array.json()    
}
fetchData1()

async function fetchData(){
    const array = await fetch(`http://localhost:8069/api/search?search=${userInput.value}`) 
    response.value = await array.json()    
}
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    
    <div class="min-h-screen flex flex-col items-center bg-gradient-to-br from-purple-200 via-pink-100 to-yellow-100 p-6 text-gray-900 dark:bg-gray-900 dark:text-gray-100 lg:justify-center lg:p-8">
        <header class="mb-8 w-full max-w-2xl">
            <nav class="flex items-center justify-center gap-4">
                <div class="flex items-center w-full max-w-lg bg-white dark:bg-gray-800 rounded-full shadow-lg px-4 py-2">
                    <input
                        v-model="userInput"
                        @keydown.enter="fetchData"
                        class="flex-1 bg-transparent outline-none text-lg text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                        placeholder="Search your Fragrance ..."
                    />
                    <button class="ml-2 p-2 rounded-full bg-gradient-to-tr from-pink-400 to-purple-400 hover:from-purple-400 hover:to-pink-400 transition-colors shadow" @click="fetchData">
                        <img class="w-6 h-6" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Search_Icon.svg/500px-Search_Icon.svg.png?20181016161702" alt="Search">
                    </button>
                </div>
            </nav>
        </header>
        <div class="flex w-full items-center justify-center lg:grow">
            <main class="flex w-full max-w-2xl flex-col overflow-hidden rounded-2xl shadow-2xl bg-white/80 dark:bg-gray-800/90 backdrop-blur-lg">
                <div class="overflow-x-auto w-full">
                    <table class="w-full divide-y divide-pink-200 dark:divide-gray-700 rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-purple-400 via-pink-400 to-yellow-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">Dior</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">Original</th>
                                <th class="px-6 py-4 text-left font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">Dupe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in response.results" :key="item" class="hover:bg-pink-100 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-3">{{item.dior}}</td>
                                <td class="px-6 py-3">{{item.original}}</td>
                                <td class="px-6 py-3">{{item.dupe}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </main>
        </div>
    </div>
</template>