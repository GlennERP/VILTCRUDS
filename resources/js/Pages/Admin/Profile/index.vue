<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    ...usePage().props.auth.user,
    password: '',
    password_confirmation: ''
});

const showDeleteModal = ref(false);
const deleteForm = useForm({
    password: ''
});

const submit = () => {
    if (form.password && form.password !== form.password_confirmation) {
        form.errors.password = 'Passwords do not match';
        return;
    }
    
    form.put(route('profile.update'), {
        onSuccess: () => {
            alert('Profile updated successfully');
        },
    });
};

const openDeleteModal = () => {
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
};

const confirmDelete = () => {
    deleteForm.delete(route('profile.destroy'), {
        onSuccess: () => {
            window.location.href = route('login');
        },
        onError: () => {
            deleteForm.reset();
        }
    });
};
</script>

<template>
    <AdminLayout>
        <Head title="Profile" />
        <div class="p-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-6 text-black">User Profile</h2>

                <form @submit.prevent="submit" class="space-y-6 mt-6 w-80">
                    <div>
                        <label>Name</label>
                        <input type="text" v-model="form.name" />
                        <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
                    </div>
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
                        <label>Confirm Password</label>
                        <input type="password" v-model="form.password_confirmation" />
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                        <button type="button" @click="openDeleteModal" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-xl font-bold mb-4">Confirm Account Deletion</h3>
                <p class="mb-4 text-red-600">This action cannot be undone. Please enter your password to confirm.</p>
                
                <form @submit.prevent="confirmDelete">
                    <div class="mb-4">
                        <label class="block mb-2">Password</label>
                        <input 
                            type="password" 
                            v-model="deleteForm.password"
                            class="w-full border rounded px-3 py-2"
                            required
                        />
                        <div v-if="deleteForm.errors.password" class="text-red-500 text-sm mt-1">
                            {{ deleteForm.errors.password }}
                        </div>
                    </div>
                    
                    <div class="flex  justify-end space-x-3 text-black">
                        <button type="button" @click="closeDeleteModal"class="px-4 py-2 bg-green-500 text-white rounded" >Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded" :disabled="deleteForm.processing">Delete permanently</button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>