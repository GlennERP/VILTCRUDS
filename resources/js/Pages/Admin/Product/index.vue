<script setup>
import { usePage, Link, useForm } from '@inertiajs/vue3';

const { props } = usePage();
const deleteForm = useForm({});

const deleteAccount = (id) => {
    if (confirm('Are you sure you want to delete this Account?')) {
        deleteForm.delete(route('profile.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                window.location.href = route('/login')
            alert('Product deleted successfully');
            },
        });
    }
};
</script>
<template>
    <AdminLayout>
        <Head title="Products" />
   
        <div class="w-full bg-white p-6 rounded shadow mt-10">
            <div class="flex justify-between mb-4">
                <Link :href="route('product.create')" class="bg-green-500 text-white px-4 py-2 rounded">Create New</Link>
            </div>
            <h2 class="text-xl font-bold mb-4 text-black">Product List</h2>
            <table class="bg-white text-black">
                <thead>
                    <tr>
                        <th class="py-2">Category</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Description</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Image</th>
                        <th class="py-2">Date Created</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in props.products" :key="product.id">
                        <td class="border px-4 py-2">{{ product.category }}</td>
                        <td class="border px-4 py-2">{{ product.name }}</td>
                        <td class="border px-4 py-2">{{ product.description }}</td>
                        <td class="border px-4 py-2">{{ product.price }}</td>
                        <td class="border px-4 py-2">{{ product.qty }}</td>
                        <td class="border px-4 py-2">
                            <img :src="product.image_url" alt="Product Image" class="w-16 h-16 object-cover" />
                        </td>
                        <td class="border px-4 py-2">{{ product.created_at }}</td>
                        <td class="border px-4 py-2">
                            <Link :href="`/product/${product.id}/update`" class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Edit</Link>
                            <button type="button" @click="deleteAccount(user.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
