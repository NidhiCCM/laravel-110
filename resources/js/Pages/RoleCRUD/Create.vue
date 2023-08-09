<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { 
    Head,
    Link, 
    useForm } from '@inertiajs/vue3';

const form = useForm({
    role: '',
});

const createRole = () => {
    form.post(route('roles-table.store'));
};
</script>

<template>
    <Head title="roles-table-Create"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Role</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-2xl mt-10 mb-10 ">
                    <form @submit.prevent="createRole" class="border flex space-x-4 p-4 rounded">
                        <div class="flex-1">
                            <input class="block px-2 py-1.5 bg-gray-100 rounded w-full" placeholder="Enter your role..."
                                type="text" v-model="form.role" />
                            <small v-if="form.errors.role" class="text-red-500 mt-2 block">
                                {{ form.errors.role }}
                            </small>
                        </div>
                        <div class="flex items-center gap-4">
                            <button :disabled="form.processing" 
                                class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none">Add</button>
                        </div>
                        <Link class=" px-4 py-2 text-sm text-white bg-blue-500 rounded" :href="route('roles-table.index')">
                        Back
                        </Link>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


