<script setup>
import { usePage, Link, useForm } from '@inertiajs/vue3';

const { props } = usePage();
const deleteForm = useForm({});

const deleteCategory = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        deleteForm.delete(route('category.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                window.location.href = route('category.index')
            alert('Product deleted successfully');
            },
        });
    }
};
</script>
<template>
    <AdminLayout>
        <Head title="Category" />
   
        <div class="w-full bg-white p-6 rounded shadow mt-10">
            <div class="flex justify-between mb-4">
                <Link :href="route('category.create')" class="bg-green-500 text-white px-4 py-2 rounded">Create New</Link> 
            </div>
            <h2 class="text-xl font-bold mb-4 text-black">Category List</h2>
            <table class="bg-white text-black">
                <thead>
                    <tr>
                        <th class="py-2">Name</th>
                        <th class="py-2">Description</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in props.categories" :key="category.id">
                        <td class="border px-4 py-2">{{ category.name }}</td>
                        <td class="border px-4 py-2">{{ category.description }}</td>
                        <td class="border px-4 py-2">
                            <Link :href="`/category/${category.id}/edit`" class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Edit</Link>
                            <button type="button" @click="deleteCategory(category.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
