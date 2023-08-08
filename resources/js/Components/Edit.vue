<template>
    <div class="border flex space-x-4 p-4 rounded">
        <form @submit.prevent="updateRole" class="w-full">
            <div>
                <TextInput type="text" class="block px-2 py-1.5 bg-gray-100 rounded w-full" v-model="roleForm.role" />
                <small v-if="roleForm.errors['role']" class="text-red-500 mt-2 block">
                    {{ roleForm.errors['role'] }}
                </small>
            </div>
        </form>
        <div class="flex items-center gap-4">
    
            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="roleForm.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
            </Transition>
        </div>
    </div>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    role: Object,
});

const roleForm = useForm({
    role: props.role,
});

const updateRole = () => {
    roleForm.patch(`/roles/${props.role.id}`);
}


</script>
