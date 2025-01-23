<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    product: Object
});

const form = useForm({
    category: props.product.category || '',
    name: props.product.name || '',
    description: props.product.description || '',
    price: props.product.price || '',
    qty: props.product.qty || '',
    image: null,
});

const handleFileChange = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    form.put(route('product.update', props.product.id), {
        onSuccess: () => {
            // Optionally show a success message or navigate
        },
    });
};
</script>

<template>
    <AdminLayout>
        <Head title="Update Product" />
        <div>
            <form @submit.prevent="submit" class="space-y-6">
                <!-- Category Field -->
                <div>
                    <label>Category</label>
                    <input type="text" v-model="form.category" />
                    <span v-if="form.errors.category" class="error">{{ form.errors.category }}</span>
                </div>

                <!-- Name Field -->
                <div>
                    <label>Name</label>
                    <input type="text" v-model="form.name" />
                    <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
                </div>

                <!-- Description Field -->
                <div>
                    <label>Description</label>
                    <input type="text" v-model="form.description" />
                    <span v-if="form.errors.description" class="error">{{ form.errors.description }}</span>
                </div>

                <!-- Price Field -->
                <div>
                    <label>Price</label>
                    <input type="text" v-model="form.price" />
                    <span v-if="form.errors.price" class="error">{{ form.errors.price }}</span>
                </div>

                <!-- Quantity Field -->
                <div>
                    <label>Quantity</label>
                    <input type="text" v-model="form.qty" />
                    <span v-if="form.errors.qty" class="error">{{ form.errors.qty }}</span>
                </div>

                <!-- Image File Field -->
                <div class="space-y-2 flex flex-col display-inline-block">
                    <label>Image</label>
                    <input type="file" @change="handleFileChange" />
                    <span v-if="form.errors.image" class="error">{{ form.errors.image }}</span>
                    <div v-if="form.image" class="mt-2">
                        <img :src="URL.createObjectURL(form.image)" alt="Selected Image" class="w-32 h-32 object-cover" />
                    </div>
                </div>
              

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded">Update Product</button>
                     <Link href="/product" class="bg-green-500 text-white px-4 py-2 rounded">Back</Link>
                     <Link href="/product/destroy" class="bg-red-500 text-white px-4 py-2 rounded">Delete</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
