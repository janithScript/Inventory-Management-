<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Inventory Management System" />
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <div class="relative flex min-h-screen flex-col items-center justify-center py-12 px-4">
            <div class="relative w-full max-w-6xl mx-auto">
                <header class="flex flex-col items-center mb-12">
                    <div class="flex items-center justify-center mb-6">
                        <svg class="h-16 w-16 text-indigo-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7L16 3M16 3L12 7M16 3V13M4 17L8 21M8 21L12 17M8 21V11M3 12H7M17 12H21M7 12V16C7 17.6569 8.34315 19 10 19H14C15.6569 19 17 17.6569 17 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h1 class="ml-4 text-3xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Inventory Management System</h1>
                    </div>
                    <p class="text-lg text-gray-300 text-center max-w-2xl">
                        A modern inventory management solution for tracking and managing your products efficiently.
                    </p>
                </header>

                <main class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-gray-700 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="p-3 rounded-lg bg-indigo-500/20 mr-4">
                                <svg class="h-6 w-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-white">Track Your Inventory</h2>
                        </div>
                        <p class="text-gray-300 mb-4">
                            Monitor stock levels, add new items, and manage your inventory with ease using our intuitive dashboard.
                        </p>
                        <ul class="text-gray-400 space-y-2">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Real-time stock tracking
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Multiple measurement units
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Comprehensive history tracking
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-gray-700 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="p-3 rounded-lg bg-purple-500/20 mr-4">
                                <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-white">Secure & Reliable</h2>
                        </div>
                        <p class="text-gray-300 mb-4">
                            Built with security and reliability in mind, ensuring your data is always safe and accessible.
                        </p>
                        <ul class="text-gray-400 space-y-2">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Secure authentication
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Audit trail for all operations
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Responsive design
                            </li>
                        </ul>
                    </div>
                </main>

                <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
                    <Link
                        v-if="canLogin"
                        :href="route('login')"
                        class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 text-center"
                    >
                        Sign In to Inventory System
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="px-8 py-4 bg-gray-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 text-center border border-gray-600"
                    >
                        Create Account
                    </Link>
                </div>

                <div class="text-center text-gray-400 text-sm pt-8 border-t border-gray-700">
                    <p>Inventory Management System v{{ laravelVersion }} (Built with Laravel & Vue.js)</p>
                </div>
            </div>
        </div>
    </div>
</template>
