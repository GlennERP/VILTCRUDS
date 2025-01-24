<script setup>
import { usePage, router, Link } from '@inertiajs/vue3';

</script>
<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 text-white">
        <header class="w-full py-1 bg-black shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <Link href="/" class="text-white font-bold text-lg ml-10">Laravel 11</Link>
                <div>
                    <div class="flex space-x-4 p-4 mr-10">
                        <Link :href="route('home')">Home</Link>
                        <Link :href="route('login')">Login</Link>
                        <Link :href="route('register')">Register</Link>
                        <Link :href="route('about')">About</Link>
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

