<script setup>
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import RoleForm from './RoleForm.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    roles: Array,
});

let form = useForm({
    id: null,
    role: null,

});

let isActive = ref(false);
let modalTitle = '';

const create = () =>  {
    form.reset()
}

const store = () => {
    form.post(route('roles-table.store'), {
        onSuccess: (response) => {
            console.log(response);
            Swal.fire(
                'role has been created!',
                'Success!',
                'success'
            )
        },
    });
}

const edit = (role) => {
    form.id = role.id;
    form.role = role.role;
}

const update = (roleId) => {
    form.put(route('roles-table.update', roleId), {
        onSuccess: (response) => {
            Swal.fire(
                'role has been updated!',
                'Success!',
                'success'
            )
        },
    });
}

const destroy = (roleId) => {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('roles-table.destroy', roleId));
            Swal.fire(
                'Deleted!',
                'role has been deleted.',
                'success'
            )
        }
    })
}

const save = () =>{
    if (form.id) {
        update(form.id)
    } else {
        store()
        create()
    }
    form.reset()
}
</script>

<template>
    <role-form 
    :modalTitle="modalTitle" 
    :form="form" 
    :isActive="isActive" 
    @isActive="isActive = false" 
    @save="save"/>

    <Head title="role" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
                List of role
            </h2>
        </template>
        <template #default>
            <div class="max-w-7xl mx-auto my-5 py-6 px-4 sm:px-6 lg:px-8 bg-white shadow">
                <button @click="isActive = true, create(), modalTitle = 'Create role'"
                    class="flex rounded-md bg-blue-500 py-2 px-4 mb-2 text-white transition-all duration-150 ease-in-out hover:bg-blue-600 block float-right">
                    <svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
                    </svg>
                    Create role
                </button>
                <DataTable class="min-w-max w-full table-fixed display">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 text-left border">ID</th>
                            <th class="py-3 px-6 text-left border">Role</th>
                            <th class="py-3 px-6 text-center border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border"
                             v-for="role in roles" 
                                    :key="role.id"
                        >
                            <td class="py-3 px-6 text-left ">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ role.id }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ role.role }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer"
                                        @click="isActive = true, edit(role), modalTitle = 'Edit role'">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer"
                                        @click="destroy(role.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </DataTable>
            </div>
        </template>
    </AuthenticatedLayout>
</template>