<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - Dias</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    Dias
                </h2>
                <div class="flex justify-end">
                    <agregar>
                        <template #link>
                            <Link :href="route('dias.create', rutina.id)">
                                Agregar
                            </Link>
                        </template>
                    </agregar>
                </div>
            </div>
        </template>

        <div v-for="dia in dias" :key="dia.id" class="grid grid-cols-2 p-2 bg-white border border-gray-300 rounded-md mb-6">
            <Link :href="route('dias.show', [rutina.id, dia.id])" class="font-semibold hover:underline">
                {{ dia.nombre }}
            </Link>
            <div class="flex justify-end">
                <editar class="mr-2">
                    <template #contenido>
                        <Link :href="route('dias.edit', [rutina.id, dia.id])">
                            Editar
                        </Link>
                    </template>
                </editar>
                <eliminar>
                    <template #contenido>
                        <span @click="destroy(dia.id)">Eliminar</span>
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
            dias: Array,
            title: String,
        },

        methods: {
            destroy(dia_id) {
                if (confirm('¿Estás seguro de que deseas eliminar este dia?')) {
                    this.$inertia.delete(this.route('dias.destroy', [this.rutina.id, dia_id]));
                }
            }
        }
    })
</script>
