<script setup>
import { computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    transactions: Array,
    item: Object
});

const hasTransactions = computed(() => props.transactions && props.transactions.length > 0);

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleString();
};

const getTransactionIcon = (type) => {
    return type === 'add' 
        ? 'M12 6v6m0 0v6m0-6h6m-6 0H6' 
        : 'M20 12H4';
};

const getTransactionColor = (type) => {
    return type === 'add' 
        ? 'text-green-600 bg-green-100' 
        : 'text-red-600 bg-red-100';
};
</script>

<template>
    <Head :title="`Transactions - ${item?.name || 'Item'}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Transaction History</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1" v-if="item">
                        {{ item.name }} ({{ item.unit.symbol }})
                    </p>
                </div>
                <Link
                    :href="route('inventory.index')"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                >
                    Back to Inventory
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <!-- Item Summary -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700" v-if="item">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ item.name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Unit: {{ item.unit.name }} ({{ item.unit.symbol }})</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ parseFloat(item.quantity).toFixed(2) }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Current Stock</p>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions List -->
                    <div class="p-6" v-if="hasTransactions">
                        <h4 class="text-md font-medium text-gray-900 dark:text-gray-200 mb-4">Transaction History</h4>
                        <div class="space-y-4">
                            <div 
                                v-for="transaction in transactions" 
                                :key="transaction.id"
                                class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg"
                            >
                                <div class="flex items-center space-x-3">
                                    <div 
                                        class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center"
                                        :class="transaction.type === 'add' ? 'text-green-600 bg-green-100 dark:bg-green-900/30' : 'text-red-600 bg-red-100 dark:bg-red-900/30'"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path 
                                                stroke-linecap="round" 
                                                stroke-linejoin="round" 
                                                stroke-width="2" 
                                                :d="getTransactionIcon(transaction.type)"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                            {{ transaction.type === 'add' ? 'Stock Added' : 'Stock Deducted' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ formatDate(transaction.created_at) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold" :class="transaction.type === 'add' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                        {{ transaction.type === 'add' ? '+' : '-' }}{{ parseFloat(transaction.quantity).toFixed(2) }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ item?.unit.symbol }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="p-6 text-center">
                        <svg
                            class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                            />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">No transactions</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            This item doesn't have any transaction history yet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>