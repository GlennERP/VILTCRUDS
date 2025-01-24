<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const user = computed(() => usePage().props.auth.user);
const appName = computed(() => usePage().props.appName || 'Laravel 11');
const showDropdown = ref(false);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const closeDropdown = (e) => {
    if (!e.target.closest('.dropdown')) {
        showDropdown.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
});
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 text-white">
        <header class="w-full bg-white-800 shadow-md py-4">
            <div class="container mx-auto flex justify-between items-center px-6">
                <Link :href="route('dashboard')" class="text-white text-lg">{{ appName }}</Link>
                
                <div class="flex-1 flex justify-center space-x-8">
                    <Link :href="route('dashboard')" class="hover:underline hover:text-orange-500 text-white">Home</Link>
                    <Link :href="route('product.index')" class="hover:underline hover:text-orange-500 text-white">Products</Link>
                </div>
                
                <div class="dropdown relative mr-7">
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
                        <Link 
                            href="/profile" 
                            class="block text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 "
                        >
                                                    Manage Profile
                        </Link>
                        <div class="border-t border-gray-200"></div>
                        <Link 
                            :href="route('logout')" 
                            method="post" 
                            class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left"
                        >
                            Log out 
                        </Link>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-grow w-full flex flex-col items-center justify-center">
            <slot />
        </main>
        <footer class="w-full py-4 bg-black text-center">
            <p>© 2021 Laravel 11</p>
        </footer>
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
</style>
