<template>
    <teleport to="head">
        <title>{{ entrenamiento.fecha }} - Ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ entrenamiento.fecha }} /
                Ejercicios
            </h2>
        </template>

        <estructura-tabla>
            <template #head>
                <th-componente>
                    <template #th-contenido>#</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Ejercicio</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Series</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Repeticiones</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Peso</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>RPE</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Cadencia</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Descanso</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Acciones</template>
                </th-componente>
            </template>

            <template #tr>
                <tr v-for="(diaEjercicio, index) in diaEjercicios" :key="diaEjercicio.id" class="border-b border-gray-300">
                    <td-componente>
                        <template #td-contenido>{{ index + 1 }}</template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            {{ diaEjercicio.ejercicio.nombre }}
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.series">{{ diaEjercicio.series }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.repeticiones">{{ diaEjercicio.repeticiones }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.peso">{{ diaEjercicio.peso }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.rpe">{{ diaEjercicio.rpe }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.cadencia">{{ diaEjercicio.cadencia }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="diaEjercicio.descanso">{{ diaEjercicio.descanso }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <agregar>
                                <template #link>
                                    <Link :href="route('entrenamientos.create')">
                                        Hacer
                                    </Link>
                                </template>
                            </agregar>
                        </template>
                    </td-componente>
                </tr>
            </template>
        </estructura-tabla>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import Agregar from '@/Shared/Botones/Agregar.vue'
    import Eliminar from '@/Shared/Botones/Eliminar.vue'
    import EstructuraTabla from '@/Shared/Tabla/EstructuraTabla'
    import TdComponente from '@/Shared/Tabla/Td'
    import ThComponente from '@/Shared/Tabla/Th'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Agregar,
            Eliminar,
            EstructuraTabla,
            TdComponente,
            ThComponente,
        },

        props: {
            entrenamiento: Object,
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
