<script setup>
import { ref, watch, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const links = [
    { 
        name: 'Dashboard', 
        route: 'dashboard',
        icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
    },
    { 
        name: 'Profile', 
        route: 'profile.index',
        icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
    },
    { 
        name: 'Categories', 
        route: 'category.index',
        icon: 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'
    },
    { 
        name: 'Products', 
        route: 'product.index',
        icon: 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'
    }
];

const isOpen = ref(localStorage.getItem('sidebarOpen') === 'true');
const emit = defineEmits(['sidebarChanged']);

const toggleSidebar = () => {
    isOpen.value = !isOpen.value;
    localStorage.setItem('sidebarOpen', isOpen.value);
};

// Initialize sidebar state on component mount
onMounted(() => {
    emit('sidebarChanged', isOpen.value);
});

watch(isOpen, (newValue) => {
    emit('sidebarChanged', newValue);
});
</script>

<template>
    <div>
        <!-- Burger Menu Button -->
        <button 
            @click="toggleSidebar" 
            class="p-2 rounded-md text-white hover:text-white focus:outline-none"
        >
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-6 w-6" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor"
            >
                <path 
                    v-if="!isOpen"
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M4 6h16M4 12h16M4 18h16"
                />
                <path 
                    v-else
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

        <!-- Sidebar -->
        <div 
            :class="[
                'fixed left-0 top-0 h-full w-64 bg-gray-800 text-white transition-transform duration-300 ease-in-out z-40',
                isOpen ? 'translate-x-0' : '-translate-x-full'
            ]"
        >
            <div class="p-2 mt-16">
                <nav class="flex flex-col space-y-1">
                    <Link 
                        v-for="(link, index) in links"
                        :key="index"
                        :href="route(link.route)"
                        class="flex items-center h-12 px-4 text-base font-medium rounded-md hover:bg-gray-700 transition-colors relative"
                    >
                        <div class="absolute left-4 w-6 flex items-center justify-center">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="h-5 w-5" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2" 
                                    :d="link.icon"
                                />
                            </svg>
                        </div>
                        <span class="ml-12">{{ link.name }}</span>
                    </Link>
                </nav>
            </div>
        </div>

        <!-- Overlay -->
        <div 
            v-if="isOpen" 
            @click="toggleSidebar"
            class="fixed inset-0  transition-opacity duration-300 ease-in-out z-30"
        ></div>
    </div>
</template>
