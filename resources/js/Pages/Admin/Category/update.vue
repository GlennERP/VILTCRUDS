<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    category: Object
});

const form = useForm({
    name: props.category.name || '',
    description: props.category.description || '',
});

const submit = () => {
    form.put(route('category.update', props.category.id), {
        onSuccess: () => {
            alert('Category updated successfully');
            window.location.href = route('category.index');
        },
    });
};
</script>

<template>
    <AdminLayout>
        <Head title="Update Category" />
        <div>
            <form @submit.prevent="submit" class="space-y-6">
            <!-- Name Field -->
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
     

                <!-- Submit and Action Buttons -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded">Update Category</button>
                    <Link :href="route('category.index')" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Back</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
