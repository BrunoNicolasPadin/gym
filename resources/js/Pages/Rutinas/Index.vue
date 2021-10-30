<template>
    <teleport to="head">
        <title>Mis rutinas</title>
    </teleport>
    <app-layout>
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

        <div v-for="rutina in rutinasFiltradas.data" :key="rutina.id" 
            class="grid grid-cols-1 md:grid-cols-2 p-2 bg-white border border-gray-300 rounded-md mb-6">
            <Link :href="route('dias.index', rutina.id)" class="font-semibold hover:underline">
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

        <div class="flex flex-wrap my-3">
            <div v-for="(link, index, key) in rutinasFiltradas.links" :key="key">
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
            rutinas: Object,
        },

        data() {
            return {
                rutinasFiltradas: this.rutinas,
                page: 1,
            }
        },

        methods: {
            destroy(rutina_id) {
                if (confirm('¿Estás seguro de que deseas eliminar esta rutina?')) {
                    this.$inertia.delete(this.route('rutinas.destroy', rutina_id));
                }
            },

            otraPagina(index) {
                this.page = index
                axios.get('http://gym.test/rutinas/paginarRutinas?page='+ this.page)
                .then(response => {
                    this.rutinasFiltradas = response.data
                })
                .catch(e => {
                    alert('Ocurrió un error pero no es tu culpa. Mejor inténtalo mas tarde.');
                })
            },
        }
    })
</script>
