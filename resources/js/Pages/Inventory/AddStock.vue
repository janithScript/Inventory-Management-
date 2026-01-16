<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    items: Array,
    errors: Object
});

const operations = ref([
    { item_id: '', quantity: '' }
]);

const form = useForm({
    operations: []
});

const addOperation = () => {
    operations.value.push({ item_id: '', quantity: '' });
    updateForm();
};

const removeOperation = (index) => {
    if (operations.value.length > 1) {
        operations.value.splice(index, 1);
        updateForm();
    }
};

const updateForm = () => {
    form.operations = operations.value;
};

const getItemName = (itemId) => {
    const item = props.items.find(i => i.id == itemId);
    return item ? `${item.name} (${item.unit.symbol})` : '';
};

const selectedItems = computed(() => {
    return operations.value.map(op => op.item_id).filter(Boolean);
});

const availableItems = computed(() => {
    return props.items.filter(item => !selectedItems.value.includes(item.id.toString()));
});

const submit = () => {
    updateForm();
    form.post(route('inventory.store-add-stock'));
};
</script>

<template>
    <Head title="Add Stock" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Stock</h2>
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
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <div class="space-y-6">
                                <div 
                                    v-for="(operation, index) in operations" 
                                    :key="index"
                                    class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-gray-600"
                                >
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                            Stock Addition {{ index + 1 }}
                                        </h3>
                                        <SecondaryButton 
                                            v-if="operations.length > 1"
                                            @click="removeOperation(index)"
                                            type="button"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        >
                                            Remove
                                        </SecondaryButton>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Item Selection -->
                                        <div>
                                            <InputLabel :for="`item_${index}`" value="Item" />
                                            <select
                                                :id="`item_${index}`"
                                                v-model="operation.item_id"
                                                @change="updateForm"
                                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required
                                            >
                                                <option value="">Select Item</option>
                                                <option 
                                                    v-for="item in availableItems" 
                                                    :key="item.id" 
                                                    :value="item.id"
                                                >
                                                    {{ item.name }} ({{ item.unit.symbol }}) - Current: {{ parseFloat(item.quantity).toFixed(2) }}
                                                </option>
                                                <option 
                                                    v-if="operation.item_id && !availableItems.find(i => i.id == operation.item_id)"
                                                    :value="operation.item_id"
                                                >
                                                    {{ getItemName(operation.item_id) }}
                                                </option>
                                            </select>
                                            <InputError :message="errors[`operations.${index}.item_id`]" class="mt-2" />
                                        </div>

                                        <!-- Quantity -->
                                        <div>
                                            <InputLabel :for="`quantity_${index}`" value="Quantity to Add" />
                                            <TextInput
                                                :id="`quantity_${index}`"
                                                v-model="operation.quantity"
                                                @input="updateForm"
                                                type="number"
                                                step="0.01"
                                                min="0.01"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required
                                            />
                                            <InputError :message="errors[`operations.${index}.quantity`]" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button
                                @click="addOperation"
                                type="button"
                                class="mt-6 w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Another Item
                            </button>

                            <div class="mt-6 flex items-center justify-end space-x-4">
                                <SecondaryButton
                                    type="button"
                                    @click="$inertia.visit(route('inventory.index'))"
                                >
                                    Cancel
                                </SecondaryButton>
                                
                                <PrimaryButton
                                    type="submit"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    {{ form.processing ? 'Adding Stock...' : 'Add Stock' }}
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>