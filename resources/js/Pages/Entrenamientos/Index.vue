<template>
    <teleport to="head">
        <title>Mis entrenamientos</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis entrenamientos
            </h2>
        </template>

        <estructura-tabla>
            <template #head>
                <th-componente>
                    <template #th-contenido>#</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Fecha</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Rutina</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Dia</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Editar</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Eliminar</template>
                </th-componente>
            </template>

            <template #tr>
                <tr v-for="(entrenamiento, index) in entrenamientosFiltrados.data" :key="entrenamiento.id" class="border-b border-gray-300">
                    <td-componente>
                        <template #td-contenido>{{ index + 1 }}</template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <Link :href="route('ejercicios-del-entrenamiento.index', entrenamiento.id)" class="font-semibold hover:underline">
                                {{ entrenamiento.fecha }}
                            </Link>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <Link :href="route('dias.index', entrenamiento.dia_rutina.rutina_id)" class="font-semibold hover:underline">
                                {{ entrenamiento.dia_rutina.rutina.nombre }}
                            </Link>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <Link :href="route('ejercicios-del-dia.index', [entrenamiento.dia_rutina.rutina_id, entrenamiento.dia_rutina.id])" 
                            class="font-semibold hover:underline">
                                {{ entrenamiento.dia_rutina.nombre }}
                            </Link>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <editar>
                                <template #contenido>
                                    <Link :href="route('entrenamientos.edit', entrenamiento.id)">
                                        Editar
                                    </Link>
                                </template>
                            </editar>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <eliminar>
                                <template #contenido>
                                    <span @click="destroy(entrenamiento.id)">Eliminar</span>
                                </template>
                            </eliminar>
                        </template>
                    </td-componente>
                </tr>
            </template>
        </estructura-tabla>

        <div class="flex flex-wrap my-3">
            <div v-for="(link, index, key) in entrenamientosFiltrados.links" :key="key">
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
    import EstructuraTabla from '@/Shared/Tabla/EstructuraTabla'
    import TdComponente from '@/Shared/Tabla/Td'
    import ThComponente from '@/Shared/Tabla/Th'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Agregar,
            Editar,
            Eliminar,
            EstructuraTabla,
            TdComponente,
            ThComponente,
        },

        props: {
            rutina: Object,
            entrenamientos: Object,
        },

        data() {
            return {
                entrenamientosFiltrados: this.entrenamientos,
                page: 1,
            }
        },

        methods: {
            destroy(entrenamiento_id) {
                if (confirm('¿Estás seguro de que deseas eliminar este entrenamiento?')) {
                    this.$inertia.delete(this.route('entrenamientos.destroy', entrenamiento_id));
                }
            },

            otraPagina(index) {
                this.page = index
                axios.get('http://gym.test/entrenamientos/paginarEntrenamientos?page='+ this.page)
                .then(response => {
                    this.entrenamientosFiltrados = response.data
                })
                .catch(e => {
                    alert('Ocurrió un error pero no es tu culpa. Mejor inténtalo mas tarde.');
                })
            },
        }
    })
</script>
