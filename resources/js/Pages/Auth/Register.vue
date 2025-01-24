<script setup>
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    name: '',
    email: '',
    password: '',
    contact: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register', {
        onSuccess: () => {
            alert('Registration successful! Redirecting to Login');
            form.reset();
        },
        onError: () => {
            alert('There were errors with your submission.');
        }
    });
};
</script>

<template>
<GuestLayout>
    <Head title="Register" />
    <div>
        <h1 class="title">Register your account</h1>

        <div class="max-w-md mx-auto">
            <form @submit.prevent="submit" class="space-y-6">
                <div class ="relative z-0 w-full mb-5 group">
                    <label class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transfarent border-0 border-b2 border-gray-300 appearance-none dark:text-black dark:border-gray">Name</label>
                    <input type="text" v-model="form.name" />
                    <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
                </div>

                <div class ="relative z-0 w-full mb-5 group">
                    <label>Email</label>
                    <input type="email" v-model="form.email" />
                    <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
                </div>

                <div>
                    <label>Contact</label>
                    <input type="text" v-model="form.contact" />
                    <span v-if="form.errors.contact" class="error">{{ form.errors.contact }}</span>
                </div>

                <div>
                    <label>Password</label>
                    <input type="password" v-model="form.password" />
                    <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
                </div>

                <div>
                    <label>Confirm Password</label>
                    <input type="password" v-model="form.password_confirmation" />
                    <span v-if="form.errors.password_confirmation" class="error">{{ form.errors.password_confirmation }}</span>
                </div>

                <button class="primary-btn">Register</button>
                <div class="text-center mt-4">
                    <p class="text-gray-700">Already have an account? <a href="/login" class="text-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</GuestLayout>
</template>