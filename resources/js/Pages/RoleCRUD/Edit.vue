<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    role: Object,
});

const form = useForm({
    id: props.role.id,
    role: props.role.role,
});

const updateRole = () => {
    form.put(route('rolesCRUD.update', form.id));
};
</script>

<template>
    <Head title="RolesCRUD" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Role</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-2xl mt-10 mb-10 ">
                    <form @submit.prevent="updateRole" class="border flex space-x-4 p-4 rounded">
                        <div class="flex-1">
                            <TextInput type="text" class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                                v-model="form.role" />
                            <small v-if="form.errors.role" class="text-red-500 mt-2 block">
                                {{ form.errors.role }}
                            </small>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type:submit :disabled="form.processing"
                                class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none">Edit</button>
                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
                            </Transition>
                        </div>
                        <Link class=" px-4 py-2 text-sm text-white bg-blue-500 rounded" :href="route('rolesCRUD.index')">
                        Back
                        </Link>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


