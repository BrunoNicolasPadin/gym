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

        <div v-for="rutina in rutinas" :key="rutina.id" class="grid grid-cols-2 p-2 bg-white border border-gray-300 rounded-md mb-6">
            <Link :href="route('rutinas.show', rutina.id)" class="font-semibold hover:underline">
                {{ rutina.nombre }}
            </Link>
            <div class="flex justify-end">
                <editar class="mr-2">
                    <template #contenido>
                        <Link :href="route('rutinas.edit', rutina.id)">
                            Editar
                        </Link>
                    </template>
                </editar>
                <eliminar>
                    <template #contenido>
                        <span @click="destroy(rutina.id)">Eliminar</span>
                    </template>
                </eliminar>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import Agregar from '@/Shared/Botones/Agregar.vue'
    import Editar from '@/Shared/Botones/Editar.vue'
    import Eliminar from '@/Shared/Botones/Eliminar.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Agregar,
            Editar,
            Eliminar,
        },

        props: {
            rutinas: Array,
        },

        methods: {
            destroy(rutina_id) {
                if (confirm('¿Estás seguro de que deseas eliminar esta rutina?')) {
                    this.$inertia.delete(this.route('rutinas.destroy', rutina_id));
                }
            }
        }
    })
</script>
