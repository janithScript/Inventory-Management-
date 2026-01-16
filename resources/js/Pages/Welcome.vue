<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const observer = ref(null);
const scrollY = ref(0);

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

function handleScroll() {
    scrollY.value = window.scrollY;
}

onMounted(() => {
    // Set up enhanced Intersection Observer for scroll animations
    observer.value = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '-50px'
    });

    // Observe elements with the scroll-animate class
    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.value.observe(el);
    });

    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    if (observer.value) {
        observer.value.disconnect();
    }
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <Head title="Inventory Management System" />
    <div class="min-h-screen bg-black text-white overflow-hidden">
        <!-- Animated background gradient -->
        <div class="fixed inset-0 bg-gradient-to-br from-gray-950 via-black to-gray-900 opacity-90"></div>
        
        <!-- Subtle grid pattern -->
        <div class="fixed inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <!-- Animated orbs -->
        <div class="fixed top-0 right-0 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="fixed bottom-0 left-0 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
        <div class="fixed top-1/2 left-1/2 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>

        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center py-16 px-4">
            <div class="relative w-full max-w-6xl mx-auto">
                <!-- Hero Section -->
                <section class="scroll-animate opacity-0 mb-24">
                    <header class="flex flex-col items-center text-center">
                        <!-- Logo with glow effect -->
                        <div class="relative mb-8 group">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full blur-2xl opacity-30 group-hover:opacity-50 transition-opacity duration-500"></div>
                            <div class="relative flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-2xl backdrop-blur-sm border border-indigo-500/20">
                                <svg class="h-10 w-10 text-indigo-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 7L16 3M16 3L12 7M16 3V13M4 17L8 21M8 21L12 17M8 21V11M3 12H7M17 12H21M7 12V16C7 17.6569 8.34315 19 10 19H14C15.6569 19 17 17.6569 17 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-tight">
                            <span class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">Inventory</span>
                            <br>
                            <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-300 bg-clip-text text-transparent">Management System</span>
                        </h1>
                        
                        <p class="text-lg md:text-xl text-gray-400 max-w-2xl leading-relaxed mb-8">
                            A modern solution for tracking and managing your products with precision and efficiency
                        </p>
                        
                        <!-- Call to Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-16">
                            <Link
                                v-if="canLogin"
                                :href="route('login')"
                                class="group relative px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-indigo-500/25 transition-all duration-300 text-center overflow-hidden"
                            >
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <span class="relative flex items-center justify-center">
                                    Sign In to Inventory System
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="group relative px-8 py-4 bg-gray-900/50 text-white font-semibold rounded-xl shadow-lg backdrop-blur-sm border border-gray-700 hover:border-gray-600 hover:bg-gray-800/50 transition-all duration-300 text-center"
                            >
                                <span class="relative flex items-center justify-center">
                                    Create Account
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </Link>
                        </div>
                    </header>
                </section>

                <!-- Features Grid -->
                <section class="mb-24">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Feature Card 1 -->
                        <div class="scroll-animate opacity-0 group">
                            <div class="relative h-full bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-gray-800/50 hover:border-indigo-500/30 transition-all duration-500 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative">
                                    <div class="flex items-center mb-6">
                                        <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="h-6 w-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-semibold text-white">Track Your Inventory</h2>
                                    </div>
                                    
                                    <p class="text-gray-400 mb-6 leading-relaxed">
                                        Monitor stock levels, add new items, and manage your inventory with ease using our intuitive dashboard
                                    </p>
                                    
                                    <ul class="space-y-3">
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Real-time stock tracking</span>
                                        </li>
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Multiple measurement units</span>
                                        </li>
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Comprehensive history tracking</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Feature Card 2 -->
                        <div class="scroll-animate opacity-0 group">
                            <div class="relative h-full bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-gray-800/50 hover:border-purple-500/30 transition-all duration-500 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative">
                                    <div class="flex items-center mb-6">
                                        <div class="p-3 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/10 mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-semibold text-white">Secure & Reliable</h2>
                                    </div>
                                    
                                    <p class="text-gray-400 mb-6 leading-relaxed">
                                        Built with security and reliability in mind, ensuring your data is always safe and accessible
                                    </p>
                                    
                                    <ul class="space-y-3">
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Secure authentication</span>
                                        </li>
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Audit trail for all operations</span>
                                        </li>
                                        <li class="flex items-center text-gray-300 group/item">
                                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 group-hover/item:bg-green-500/30 transition-colors">
                                                <svg class="h-3 w-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Responsive design</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Stats Section -->
                <section class="mb-24 scroll-animate opacity-0">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="group relative bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-800/50 hover:border-indigo-500/30 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                            <div class="relative">
                                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent mb-2">100+</div>
                                <div class="text-sm text-gray-400">Items Tracked</div>
                            </div>
                        </div>
                        <div class="group relative bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-800/50 hover:border-purple-500/30 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                            <div class="relative">
                                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-purple-300 bg-clip-text text-transparent mb-2">24/7</div>
                                <div class="text-sm text-gray-400">Availability</div>
                            </div>
                        </div>
                        <div class="group relative bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-800/50 hover:border-green-500/30 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                            <div class="relative">
                                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-400 to-green-300 bg-clip-text text-transparent mb-2">Real-time</div>
                                <div class="text-sm text-gray-400">Updates</div>
                            </div>
                        </div>
                        <div class="group relative bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-800/50 hover:border-blue-500/30 transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                            <div class="relative">
                                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-400 to-blue-300 bg-clip-text text-transparent mb-2">Secure</div>
                                <div class="text-sm text-gray-400">Platform</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- How It Works Section -->
                <section class="mb-24">
                    <div class="text-center mb-16 scroll-animate opacity-0">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">How It Works</h2>
                        <p class="text-gray-400 max-w-2xl mx-auto">Simple steps to get started with our inventory management system</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="scroll-animate opacity-0 group">
                            <div class="relative h-full bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-gray-800/50 hover:border-indigo-500/30 transition-all duration-500 text-center overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-2xl font-bold text-indigo-400">1</span>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white mb-3">Sign Up</h3>
                                    <p class="text-gray-400 text-sm leading-relaxed">Create your account and set up your inventory management system</p>
                                </div>
                            </div>
                        </div>
                        <div class="scroll-animate opacity-0 group">
                            <div class="relative h-full bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-gray-800/50 hover:border-purple-500/30 transition-all duration-500 text-center overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500/20 to-purple-600/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-2xl font-bold text-purple-400">2</span>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white mb-3">Add Items</h3>
                                    <p class="text-gray-400 text-sm leading-relaxed">Start adding your inventory items with different measurement units</p>
                                </div>
                            </div>
                        </div>
                        <div class="scroll-animate opacity-0 group">
                            <div class="relative h-full bg-gradient-to-br from-gray-900/50 to-gray-900/30 backdrop-blur-sm rounded-2xl p-8 border border-gray-800/50 hover:border-green-500/30 transition-all duration-500 text-center overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500/20 to-green-600/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-2xl font-bold text-green-400">3</span>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white mb-3">Manage</h3>
                                    <p class="text-gray-400 text-sm leading-relaxed">Track, add, deduct, and monitor your inventory in real-time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="text-center text-gray-500 text-sm pt-8 border-t border-gray-800/50 scroll-animate opacity-0">
                    <p>Inventory Management System (ashkaNet) v{{ laravelVersion }} (Built with Laravel & Vue.js)</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-blob {
    animation: blob 15s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.scroll-animate:nth-child(1) { animation-delay: 0.1s; }
.scroll-animate:nth-child(2) { animation-delay: 0.2s; }
.scroll-animate:nth-child(3) { animation-delay: 0.3s; }
.scroll-animate:nth-child(4) { animation-delay: 0.4s; }
.scroll-animate:nth-child(5) { animation-delay: 0.5s; }
.scroll-animate:nth-child(6) { animation-delay: 0.6s; }
</style>