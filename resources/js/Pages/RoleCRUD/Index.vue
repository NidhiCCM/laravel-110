<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
    Head, 
    Link, } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import { router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue'

defineProps({
    roles: Object,
});

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
            router.delete(route('roles-table.destroy', id))
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
    <Head title="roles-table" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">roles-table</h2>
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
                                <Link class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                    :href="route('roles-table.create')">
                                Create Role
                                </Link>
                            </div>
                            <table class="table-fixed w-full" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2 w-20">No.</th>
                                        <th class="border px-4 py-2 w-20">Role</th>
                                        <th class="border px-4 py-2 w-40">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="role in roles.data" 
                                        :key="role.id"
                                    >
                                        <td class="border px-4 py-2 w-20  text-center">{{ role.id }}</td>
                                        <td class="border px-4 py-2 w-20">{{ role.role }}</td>
                                        <td class="border px-4 py-2 w-20">
                                            <Link class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                                :href="route('roles-table.edit', role.id)">
                                            Edit
                                            </Link>
                                            <Link class="mx-2 px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                                :href="route('roles-table.show', role.id)">
                                            Show
                                            </Link>
                                            <DangerButton @click="destroy(role.id)">Delete</DangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination class="mt-6" :links="roles.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

