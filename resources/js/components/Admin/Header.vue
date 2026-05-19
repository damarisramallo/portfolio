<template>
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Panel Administrativo</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">{{ auth?.user?.name }}</span>
                    <button class="text-red-600 hover:text-red-800 text-sm">Cerrar Sesión</button>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
    import { defineProps } from 'vue'

    defineProps({
        auth: Object,
    })
</script>
