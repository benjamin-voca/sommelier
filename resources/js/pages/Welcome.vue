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
    
    <div class="min-h-screen  flex-col items-center bg-[rgb(83,94,217)] p-6 text-[#1b1b18] light:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center gap-4">
                <div class="ml-78 flex justify-center">
                    <input
                        v-model="userInput"
                        @keydown.enter="fetchData"
                        class=" h-10  w-64 rounded-lg text-sm text-white bg bg-[#3a43a7] placeholder: "placeholder="Search your Fragrance ... "
                    />
                    <button class="text-white ml-3 bg-[#3a43a7] h-8 w-15 rounded-lg" @click="fetchData"><img class="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Search_Icon.svg/500px-Search_Icon.svg.png?20181016161702" ></button>
                </div>
            </nav>
        </header>
        <div class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div class="overflow-x-auto mt-13 w-full">
                     <table class="w-full divide-y divide-gray-200 rounded-lg overflow-hidden bg-white dark:bg-gray-800 shadow">
                        <thead class="w-full bg-[#3a43a7]">
                            <tr>
                                <th class="w-[33%] px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-200 uppercase tracking-wider">Dior</th>
                                <th class="w-[33%] px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-200 uppercase tracking-wider">Original</th>
                                <th class="w-[33%] px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-200 uppercase tracking-wider">Dupe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in response.results" :key="item"> 
                                <td class="px-4 py-2 bg-[rgb(83,94,217,0.67)] dark:text-gray-100 hover:bg-gray-800">{{item.dior}}</td>
                                <td class="px-4 py-2 bg-[rgb(83,94,217,0.67)] dark:text-gray-100 hover:bg-gray-800">{{item.original}}</td>
                                <td class="px-4 py-2 bg-[rgb(83,94,217,0.67)] dark:text-gray-100 hover:bg-gray-800">{{item.dupe}}</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>                
            </main>
        </div>
    </div>
</template>