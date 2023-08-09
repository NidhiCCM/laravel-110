<script setup>
const props = defineProps({
    modalTitle: String,
    form: Object,
    isActive: Boolean
});

const emits = defineEmits(['isActive', 'save']);
</script>

<template>
    <div class="container mx-auto">
        <div class="flex justify-center ">
            <div v-show="isActive"
                class=" absolute z-10 inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 "
                @click.self="emits('isActive')">
                <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl w-screen">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">{{ modalTitle }}</h3>
                        <svg @click="emits('isActive')" xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-red-900 cursor-pointer" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <form @submit.prevent="emits('save', form)">
                        <input class="block px-2 py-1.5 bg-gray-100 rounded w-full mt-10 mb-10"
                            placeholder="Enter your role..." type="text" v-model="form.role" />
                        <small v-if="form.errors.role" class="text-red-500 mt-2 block">
                            {{ form.errors.role }}
                        </small>
                        <div class="mt-4">
                            <button @click="emits('isActive')"
                                class="px-6 py-2 text-blue-800 border border-blue-600 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 ml-2 text-blue-100 bg-blue-600 rounded">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
