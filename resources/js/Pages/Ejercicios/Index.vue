<template>
    <teleport to="head">
        <title>Mis ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mis ejercicios
                </h2>
                <div class="flex justify-end">
                    <agregar>
                        <template #link>
                            <Link :href="route('ejercicios.create')">
                                Agregar
                            </Link>
                        </template>
                    </agregar>
                </div>
            </div>
        </template>

        <div v-for="ejercicio in ejerciciosFiltrados.data" :key="ejercicio.id" 
            class="grid grid-cols-1 md:grid-cols-2 p-2 font-semibold bg-white border border-gray-300 rounded-md mb-6">
            <div class="mb-4 md:mb-0">
                {{ ejercicio.nombre }}
            </div>
            <div class="flex justify-end">
                <editar class="mr-2">
                    <template #contenido>
                        <Link :href="route('ejercicios.edit', ejercicio.id)">
                            Editar
                        </Link>
                    </template>
                </editar>
                <eliminar>
                    <template #contenido>
                        <span @click="destroy(ejercicio.id)">Eliminar</span>
                    </template>
                </eliminar>
            </div>
        </div>

        <div class="flex flex-wrap my-3">
            <div v-for="(link, index, key) in ejerciciosFiltrados.links" :key="key">
                <button @click="otraPagina(link.label)" 
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-black rounded hover:bg-white" 
                :class="{ 'bg-white': link.active }" v-html="link.label" />
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
            ejercicios: Object,
        },

        data() {
            return {
                ejerciciosFiltrados: this.ejercicios,
                page: 1,
            }
        },

        methods: {
            destroy(ejercicio_id) {
                if (confirm('¿Estás seguro de que deseas eliminar este ejercicio?')) {
                    this.$inertia.delete(this.route('ejercicios.destroy', ejercicio_id));
                }
            },

            otraPagina(index) {
                this.page = index
                axios.get('http://gym.test/ejercicios/paginarEjercicios?page='+ this.page)
                .then(response => {
                    this.ejerciciosFiltrados = response.data
                })
                .catch(e => {
                    alert('Ocurrió un error pero no es tu culpa. Mejor inténtalo mas tarde.');
                })
            },
        }
    })
</script>
