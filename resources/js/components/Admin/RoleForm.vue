<template>
    <form @submit.prevent="$emit('submit', form)">
        <!-- Nombre del Rol -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre del Rol
            </label>
            <input
                v-model="form.name"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text"
                id="name"
                placeholder="Ej: Editor"
                required
            />
            <span v-if="errors?.name" class="text-red-500 text-xs">{{ errors.name }}</span>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Descripción (opcional)
            </label>
            <textarea
                v-model="form.description"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="description"
                rows="3"
                placeholder="Descripción del rol"
            ></textarea>
        </div>

        <!-- Permisos -->
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-3">
                Permisos
            </label>
            <div class="grid grid-cols-2 gap-3">
                <label v-for="permission in permissions" :key="permission.id" class="flex items-center">
                    <input
                        v-model="form.permissions"
                        :value="permission.id"
                        type="checkbox"
                        class="w-4 h-4 text-blue-500"
                    />
                    <span class="ml-2 text-gray-700">{{ permission.name }}</span>
                </label>
            </div>
        </div>

        <!-- Slot para botones personalizados -->
        <slot name="buttons">
            <div class="flex gap-4">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Guardar
                </button>
            </div>
        </slot>
    </form>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

defineProps({
    permissions: {
        type: Array,
        required: true,
    },
    initialData: {
        type: Object,
        default: () => ({
            name: '',
            description: '',
            permissions: [],
        }),
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
})

defineEmits(['submit'])

const form = reactive(initialData)
</script>
