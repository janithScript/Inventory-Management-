<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ItemForm from '@/Components/Inventory/ItemForm.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    units: Array,
    errors: Object
});

const itemFormRef = ref();
const formItems = ref([]);

const form = useForm({
    items: []
});

const updateItems = (items) => {
    formItems.value = items;
    form.items = items;
};

const submit = () => {
    form.post(route('inventory.store'), {
        onSuccess: () => {
            // Form will redirect on success
        }
    });
};
</script>

<template>
    <Head title="Add Items" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Inventory Items</h2>
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
                            <ItemForm
                                ref="itemFormRef"
                                :units="units"
                                :errors="errors"
                                @update:items="updateItems"
                            />

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
                                    {{ form.processing ? 'Creating...' : 'Create Items' }}
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>