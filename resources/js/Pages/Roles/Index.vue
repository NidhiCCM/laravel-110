<script setup>
import RoleList from '@/Components/RoleList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddRoleForm from '@/Components/AddRoleForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    roles: Object,
});
</script>

<template>
    <Head title="Roles" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mx-auto max-w-3xl mt-10 mb-10  px-4">
                        <h1 class="font-light text-3xl">My Roles List</h1>
                        <div class="flex flex-col space-y-4 mt-5">
                            <add-role-form/>
                            <role-list
                            v-for="role in roles.data" 
                            :key="role.id" 
                            :role="role"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

