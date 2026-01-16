<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gradient-to-br from-gray-900 to-black pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-lg">
                    <svg class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 7L16 3M16 3L12 7M16 3V13M4 17L8 21M8 21L12 17M8 21V11M3 12H7M17 12H21M7 12V16C7 17.6569 8.34315 19 10 19H14C15.6569 19 17 17.6569 17 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-gray-800/30 backdrop-blur-sm border border-gray-700/50 px-6 py-4 shadow-xl sm:max-w-md sm:rounded-xl"
        >
            <slot />
        </div>
    </div>
</template>
