<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';
import { router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import Create from '@/Components/Create.vue';
import Edit from '@/Components/Edit.vue';
import Show from '@/Components/Show.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';

DataTable.use(DataTablesLib);

const props = defineProps([
    'roles'
]);
const openCreateModal = ref(false);

const addNewRole = () => {
    openCreateModal.value = true;
};

const closeCreateModal = () => {
    openCreateModal.value = false;
};
const openEditModal = ref(false);

const editRole = () => {
    openEditModal.value = true;
};

const closeEditModal = () => {
    openEditModal.value = false;
};
const openShowModal = ref(false);

const showRole = () => {
    openShowModal.value = true;
};

const closeShowModal = () => {
    openShowModal.value = false;
};

const destroy = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('rolesCRUD.destroy', id))
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
</script>

<template>
    <Head title="RolesCRUD" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Table</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mx-auto max-w-2xl mt-10 mb-10 ">
                        <div v-if="$page.props.flash.success" class="text-green-600 mb-4">
                            {{ $page.props.flash.success }}
                        </div>
                        <div class="flex flex-col space-y-4 mt-5">
                            <div class="flex  mb-6">
                                <DangerButton @click="addNewRole">Add</DangerButton>
                                <Modal :show="openCreateModal" @close="closeCreateModal">
                                    <div class="p-6">
                                        <Create />
                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="closeCreateModal"> Cancel </SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </div>
                            <DataTable class="display">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2 w-20">No.</th>
                                        <th class="border px-4 py-2 w-20">Role</th>
                                        <th class="border px-4 py-2 w-40">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="role in roles" :key="role.id">
                                        <td class="border px-4 py-2 w-20  text-center">{{ role.id }}</td>
                                        <td class="border px-4 py-2 w-20">{{ role.role }}</td>
                                        <td class="border px-4 py-2 w-20">
                                            <SecondaryButton @click="editRole(role.id)">Edit</SecondaryButton>

                                            <SecondaryButton @click="showRole(role.id)">Show</SecondaryButton>

                                            <DangerButton @click="destroy(role.id)">Delete</DangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="openEditModal" @close="closeEditModal">
            <div class="p-6">
                <Edit />
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeEditModal"> Cancel </SecondaryButton>
                </div>
            </div>
        </Modal>
        <Modal :show="openShowModal" @close="closeShowModal">
            <div class="p-6">
                <Show/>
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeShowModal"> Cancel </SecondaryButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

<style>
@import 'datatables.net-dt';
</style>
