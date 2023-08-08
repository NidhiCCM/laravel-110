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

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="roleForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
    </form>
</template>

<script setup>
    // Import the useForm helper
    import { useForm } from "@inertiajs/vue3";
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    // Initialise the form with the properties we want to update client-side send to the server-side
    const roleForm = useForm({
        role: '',
    });

    // Create a method that tells the form to submit to TodoController@store
    const createRole = () => {
        roleForm.post('/roles');
    };
</script>