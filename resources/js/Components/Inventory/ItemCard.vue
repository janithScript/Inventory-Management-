<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    item: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border dark:border-gray-700 hover:shadow-md transition-shadow duration-200 dark:hover:bg-gray-700">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                        {{ item.name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Unit: {{ item.unit.name }} ({{ item.unit.symbol }})
                    </p>
                </div>
                <div class="flex-shrink-0 text-right">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ parseFloat(item.quantity).toFixed(2) }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ item.unit.symbol }}
                    </p>
                </div>
            </div>
            
            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div 
                        class="flex-shrink-0 w-2 h-2 rounded-full"
                        :class="{
                            'bg-red-400': item.quantity == 0,
                            'bg-yellow-400': item.quantity > 0 && item.quantity <= 10,
                            'bg-green-400': item.quantity > 10
                        }"
                    ></div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ item.quantity == 0 ? 'Out of stock' : item.quantity <= 10 ? 'Low stock' : 'In stock' }}
                    </span>
                </div>
                
                <Link 
                    :href="route('transactions.show', item.id)"
                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 text-sm font-medium"
                >
                    View History
                </Link>
            </div>
        </div>
    </div>
</template>