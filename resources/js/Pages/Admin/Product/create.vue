<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    category: '',
    name: '',
    description: '',
    price: '',
    qty: '',
    image: null,
});

const handleFileChange = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    form.post(route('product.store'), {
        onSuccess: () => {
            alert('Product added successfully');
            form.reset();
        }
    });
};
</script>
<template>
    <AdminLayout>
        <Head title="Products" />
        <div>
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label>Category</label>
                    <input type="text" v-model="form.category" />
                    <span v-if="form.errors.category" class="error">{{ form.errors.category }}</span>
                </div>
                <div>
                    <label>Name</label>
                    <input type="text" v-model="form.name" />
                    <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
                </div>
                <div>
                    <label>Description</label>
                    <input type="text" v-model="form.description" />
                    <span v-if="form.errors.description" class="error">{{ form.errors.description }}</span>
                </div>
                <div>
                    <label>Price</label>
                    <input type="text" v-model="form.price" />
                    <span v-if="form.errors.price" class="error">{{ form.errors.price }}</span>
                </div>
                <div>
                    <label>Quantity</label>
                    <input type="text" v-model="form.qty" />
                    <span v-if="form.errors.qty" class="error">{{ form.errors.qty }}</span>
                    <input type="file" @change="handleFileChange" />
                </div>
                <div>
                    <span v-if="form.errors.image" class="error">{{ form.errors.image }}</span>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded">Add Product</button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>