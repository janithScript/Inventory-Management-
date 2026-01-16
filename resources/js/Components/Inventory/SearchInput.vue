<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue']);

const searchInput = ref(props.modelValue);

const debouncedSearch = useDebounceFn((value) => {
    router.get(route('inventory.index'), 
        { search: value }, 
        { 
            preserveState: true, 
            replace: true 
        }
    );
}, 300);

watch(searchInput, (value) => {
    emit('update:modelValue', value);
    debouncedSearch(value);
});
</script>

<template>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input
            v-model="searchInput"
            type="search"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Search items..."
        />
    </div>
</template>