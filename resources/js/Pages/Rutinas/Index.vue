<template>
    <app-layout title="Mis rutinas">
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mis rutinas
                </h2>
                <div class="flex justify-end">
                    <agregar>
                        <template #link>
                            <Link :href="route('rutinas.create')">
                                Agregar
                            </Link>
                        </template>
                    </agregar>
                </div>
            </div>
        </template>

        <div v-for="rutina in rutinas" :key="rutina.id" class="p-2 bg-white border border-gray-300 rounded-md mb-6">
            <Link :href="route('rutinas.show', rutina.id)" class="font-semibold hover:underline">
                {{ rutina.nombre }}
            </Link>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import Agregar from '@/Shared/Botones/Agregar.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Agregar,
        },

        props: {
            rutinas: Array,
        },
    })
</script>
