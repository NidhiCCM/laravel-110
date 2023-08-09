<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { 
    Head, 
    Link 
} from '@inertiajs/vue3';

const props = defineProps({
    role: Object,
});
</script>

<template>
    <Head title="roles-table" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Role</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-2xl mt-10 mb-10 ">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ role.role }}</h2>
                    <div class="flex items-center gap-4 mt-5">
                        <Link class=" px-4 py-2 text-sm text-white bg-blue-500 rounded" :href="route('roles-table.index')">
                        Back
                        </Link>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>


