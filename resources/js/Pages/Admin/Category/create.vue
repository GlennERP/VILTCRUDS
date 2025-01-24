<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
});

const submit = () => {
    form.post(route('category.store'), {
        onSuccess: () => {
            alert('Category added successfully');
            form.reset();
        }
    });
};
</script>

<template>
<AdminLayout>
    <Head title="Create Category" />
    <div>
        <form @submit.prevent="submit" class="space-y-6">
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

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
            </div>
        </form>
    </div>
</AdminLayout>
</template>