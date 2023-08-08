<script setup>
    import { useForm } from "@inertiajs/vue3";
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const roleForm = useForm({
        role: '',
    });

    const createRole = () => {
        roleForm.post(route('rolesCRUD.store'));
    };
</script>

<template>
    <form
        @submit.prevent="createRole"
        class="border flex space-x-4 p-4 rounded"
    >
        <div class="flex-1">
            <input
                class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                placeholder="Enter your role..."
                type="text"
                v-model="roleForm.role"
            />
            <small v-if="roleForm.errors['role']"
                class="text-red-500 mt-2 block">
                {{ roleForm.errors['role'] }}
            </small>
        </div>

        <div class="flex items-center gap-4">
                <PrimaryButton :disabled="roleForm.processing">Add</PrimaryButton>
            </div>
    </form>
</template>

