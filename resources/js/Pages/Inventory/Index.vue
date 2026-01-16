<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SearchInput from '@/Components/Inventory/SearchInput.vue';
import ItemCard from '@/Components/Inventory/ItemCard.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    items: Array,
    search: String
});

const searchQuery = ref(props.search || '');

const filteredItems = computed(() => {
    return props.items || [];
});

const hasItems = computed(() => filteredItems.value.length > 0);
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inventory Management</h2>
                <div class="flex space-x-2">
                    <Link
                        :href="route('inventory.create')"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Add Items
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Search Section -->
                <div class="mb-8">
                    <div class="max-w-md">
                        <SearchInput v-model="searchQuery" />
                    </div>
                    <p class="mt-2 text-sm text-gray-600" v-if="searchQuery">
                        {{ filteredItems.length }} item{{ filteredItems.length !== 1 ? 's' : '' }} found for "{{ searchQuery }}"
                    </p>
                    <p class="mt-2 text-sm text-gray-600" v-else>
                        {{ filteredItems.length }} total item{{ filteredItems.length !== 1 ? 's' : '' }}
                    </p>
                </div>

                <!-- Inventory Grid -->
                <div v-if="hasItems" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <ItemCard 
                        v-for="item in filteredItems" 
                        :key="item.id" 
                        :item="item" 
                    />
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-12">
                    <svg
                        class="mx-auto h-12 w-12 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            vector-effect="non-scaling-stroke"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No inventory items</h3>
                    <p class="mt-1 text-sm text-gray-500" v-if="searchQuery">
                        No items match your search criteria.
                    </p>
                    <p class="mt-1 text-sm text-gray-500" v-else>
                        Get started by adding some inventory items.
                    </p>
                    <div class="mt-6">
                        <Link
                            :href="route('inventory.create')"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Add Items
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>