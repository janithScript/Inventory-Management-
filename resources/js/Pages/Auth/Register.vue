<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <!-- Register Form -->
        <form @submit.prevent="submit">
            <!-- Name Field -->
            <div class="mb-5">
                <InputLabel for="name" value="Full Name" class="block text-gray-300 mb-2 text-sm font-medium" />
                <TextInput
                    id="name"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                />
                <InputError class="mt-2 text-red-400 text-xs" :message="form.errors.name" />
            </div>

            <!-- Email Field -->
            <div class="mb-5">
                <InputLabel for="email" value="Email Address" class="block text-gray-300 mb-2 text-sm font-medium" />
                <TextInput
                    id="email"
                    type="email"
                    class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="Enter your email"
                />
                <InputError class="mt-2 text-red-400 text-xs" :message="form.errors.email" />
            </div>

            <!-- Password Field -->
            <div class="mb-5">
                <InputLabel for="password" value="Password" class="block text-gray-300 mb-2 text-sm font-medium" />
                <TextInput
                    id="password"
                    type="password"
                    class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Create a strong password"
                />
                <InputError class="mt-2 text-red-400 text-xs" :message="form.errors.password" />
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-6">
                <InputLabel for="password_confirmation" value="Confirm Password" class="block text-gray-300 mb-2 text-sm font-medium" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />
                <InputError class="mt-2 text-red-400 text-xs" :message="form.errors.password_confirmation" />
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-400 hover:text-gray-300 transition-colors duration-200"
                >
                    Already have an account?
                </Link>

                <PrimaryButton
                    class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                    :class="{ 'opacity-75 cursor-not-allowed': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Creating...
                    </span>
                    <span v-else>Create Account</span>
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
