<script setup>
import { computed, ref, onMounted, onUnmounted, watch } from 'vue';
import { usePage, Link, router } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';

const user = computed(() => usePage().props.auth.user);
const appName = computed(() => usePage().props.appName || 'Laravel 11');
const showDropdown = ref(false);
const sidebarOpen = ref(localStorage.getItem('sidebarOpen') === 'true');

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const closeDropdown = (e) => {
    if (!e.target.closest('.dropdown')) {
        showDropdown.value = false;
    }
};

const handleLogout = () => {
    router.post(route('logout'));
};

const handleSidebarChange = (isOpen) => {
    sidebarOpen.value = isOpen;
    localStorage.setItem('sidebarOpen', isOpen);
};

onMounted(() => {
    document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <header class="fixed top-0 right-0 w-full bg-white-800 shadow-md py-9 z-30 flex justify-center items-center">
            <div 
                :class="[
                    'absolute left-0 transition-transform duration-300 ease-in-out px-5 flex items-center',
                    sidebarOpen ? 'left-64' : 'left-0'
                ]"
            >
                <Sidebar @sidebar-changed="handleSidebarChange" class="inline-flex" />
                <Link :href="route('dashboard')" class="text-white text-lg ml-2">{{ appName }}</Link>
            </div>

            <div class="absolute right-0 px-8">
                <div class="dropdown relative">
                    <button 
                        v-if="user" 
                        @click="toggleDropdown"
                        class="flex items-center space-x-2 text-white hover:text-orange-500 cursor-pointer"
                    >
                        <span>{{ user.name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div v-show="showDropdown" class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-1 z-10">
                        <Link :href="route('profile.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">Manage Profile</Link>
                        <div class="border-t border-gray-200"></div>

                        <button @click="handleLogout" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main layout with sidebar -->
        <div class="flex pt-20">
            <main :class="[
                'flex-1 p-20 transform flex justify-center',
                sidebarOpen ? 'transition-transform duration-500 ease-in-out ml-64' : 'transition-transform duration-100 delay-150 ease-in-out ml-0'
            ]">
                <div class="w-full max-w-7xl">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    position: absolute;
    right: 0;
    min-width: 160px;
    z-index: 1;
}

.transform {
    transform-style: preserve-3d;
    backface-visibility: hidden;
}
</style>
