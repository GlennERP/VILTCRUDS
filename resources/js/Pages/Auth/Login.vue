<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    
    email: '',
    password: '',
  
});

const submit = () => {
    form.post('/login', {
        onSuccess: () => {
            alert('Login Successful');
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
    <Head title="Login" />
    <div >
        <h1 class= "font-extrabold text-black text-4xl mt-20">This is Login Page</h1>

        <div>
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label>Email</label>
                    <input type="email" v-model="form.email" />
                    <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
                </div>

                <div>
                    <label>Password</label>
                    <input type="password" v-model="form.password" />
                    <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded">Login</button>
                </div>
            </form>
    </div>
</div>
</GuestLayout>
</template>