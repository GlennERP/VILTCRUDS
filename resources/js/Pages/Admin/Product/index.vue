<script setup>
import { usePage, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

const { props } = usePage();
const search = ref(props.filters.search || '');

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        axios.delete(route('product.destroy', id)).then(() => {
            alert('Product successfully deleted.');
            location.reload();
        });
    }
};

const searchProducts = debounce(() => {
    router.get(route('product.index'), { search: search.value }, { preserveState: true, replace: true });
}, 2000);

watch(search, (newSearch) => {
    searchProducts();
});
</script>
<template>
    <AdminLayout>
        <Head title="Products" />
   
        <div class="w-full bg-white p-6 rounded shadow mt-10">
            <div class="flex justify-between mb-4">
                <Link :href="route('product.create')" class="bg-green-500 text-white px-4 py-2 rounded">Create New</Link>
                <input v-model="search" type="text" placeholder="Search..." class="border px-4 py-2 rounded" />
                <button @click="search = ''" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Clear</button>
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
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in props.products.data" :key="product.id">
                        <td class="border px-4 py-2">{{ product.category }}</td>
                        <td class="border px-4 py-2">{{ product.name }}</td>
                        <td class="border px-4 py-2">{{ product.description }}</td>
                        <td class="border px-4 py-2">{{ product.price }}</td>
                        <td class="border px-4 py-2">{{ product.qty }}</td>
                        <td class="border px-4 py-2">
                            <img :src="product.image_url" alt="Product Image" class="w-16 h-16 object-cover" />
                        </td>
                        <td class="border px-4 py-2">
                            <Link :href="`/product/${product.id}/update`" class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Edit</Link>
                            <button @click="deleteProduct(product.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 flex justify-between">
                <button @click="router.get(props.products.prev_page_url, {}, { preserveState: true, replace: true })" :disabled="!props.products.prev_page_url" class="px-4 py-2 bg-gray-300 rounded mr-2">Previous</button>
                <button @click="router.get(props.products.next_page_url, {}, { preserveState: true, replace: true })" :disabled="!props.products.next_page_url" class="px-4 py-2 bg-gray-300 rounded">Next</button>
            </div>
        </div>
    </AdminLayout>
</template>
