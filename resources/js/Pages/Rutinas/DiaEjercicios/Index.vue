<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    Ejercicios
                </h2>
                <div class="flex justify-end">
                    <agregar>
                        <template #link>
                            <Link :href="route('ejercicios-del-dia.create', [rutina.id, dia.id])">
                                Agregar
                            </Link>
                        </template>
                    </agregar>
                </div>
            </div>
        </template>

        <div v-for="diaEjercicio in diaEjercicios" :key="diaEjercicio.id" class="grid grid-cols-2 p-2 bg-white border border-gray-300 rounded-md mb-6">
            <Link :href="route('ejercicios-del-dia.show', [rutina.id, dia.id, diaEjercicio.id])" class="font-semibold hover:underline">
                {{ diaEjercicio.ejercicio.nombre }}
            </Link>
            <div class="flex justify-end">
                <editar class="mr-2">
                    <template #contenido>
                        <Link :href="route('ejercicios-del-dia.edit', [rutina.id, dia.id, diaEjercicio.id])">
                            Editar
                        </Link>
                    </template>
                </editar>
                <eliminar>
                    <template #contenido>
                        <span @click="destroy(diaEjercicio.id)">Eliminar</span>
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
            rutina: Object,
            dia: Object,
            diaEjercicios: Array,
        },

        methods: {
            destroy(diaEjercicio_id) {
                if (confirm('¿Estás seguro de que deseas eliminar este ejercicio del dia?')) {
                    this.$inertia.delete(this.route('ejercicios-del-dia.destroy', [this.rutina.id, this.dia.id, diaEjercicio_id]));
                }
            }
        }
    })
</script>
