<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    units: {
        type: Array,
        required: true
    },
    errors: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['update:items']);

const items = ref([
    { name: '', unit_id: '', quantity: 0 }
]);

const addItem = () => {
    items.value.push({ name: '', unit_id: '', quantity: 0 });
    emitUpdate();
};

const removeItem = (index) => {
    if (items.value.length > 1) {
        items.value.splice(index, 1);
        emitUpdate();
    }
};

const emitUpdate = () => {
    emit('update:items', items.value);
};

defineExpose({
    items
});
</script>

<template>
    <div class="space-y-6">
        <div 
            v-for="(item, index) in items" 
            :key="index"
            class="p-6 bg-gray-50 rounded-lg border"
        >
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Item {{ index + 1 }}
                </h3>
                <SecondaryButton 
                    v-if="items.length > 1"
                    @click="removeItem(index)"
                    type="button"
                    class="text-red-600 hover:text-red-900"
                >
                    Remove
                </SecondaryButton>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Item Name -->
                <div>
                    <InputLabel :for="`item_name_${index}`" value="Item Name" />
                    <TextInput
                        :id="`item_name_${index}`"
                        v-model="item.name"
                        @input="emitUpdate"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="errors[`items.${index}.name`]" class="mt-2" />
                </div>

                <!-- Unit -->
                <div>
                    <InputLabel :for="`item_unit_${index}`" value="Unit" />
                    <select
                        :id="`item_unit_${index}`"
                        v-model="item.unit_id"
                        @change="emitUpdate"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        required
                    >
                        <option value="">Select Unit</option>
                        <option v-for="unit in units" :key="unit.id" :value="unit.id">
                            {{ unit.name }} ({{ unit.symbol }})
                        </option>
                    </select>
                    <InputError :message="errors[`items.${index}.unit_id`]" class="mt-2" />
                </div>

                <!-- Initial Quantity -->
                <div>
                    <InputLabel :for="`item_quantity_${index}`" value="Initial Quantity" />
                    <TextInput
                        :id="`item_quantity_${index}`"
                        v-model="item.quantity"
                        @input="emitUpdate"
                        type="number"
                        step="0.01"
                        min="0"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="errors[`items.${index}.quantity`]" class="mt-2" />
                </div>
            </div>
        </div>

        <button
            @click="addItem"
            type="button"
            class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Another Item
        </button>
    </div>
</template>