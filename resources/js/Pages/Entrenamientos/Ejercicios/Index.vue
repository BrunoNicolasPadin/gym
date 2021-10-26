<template>
    <teleport to="head">
        <title>Entrenamiento - {{ entrenamiento.fecha }} - Ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Entrenamiento /
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
                    <template #th-contenido>Eliminar</template>
                </th-componente>
            </template>

            <template #tr>
                <tr v-for="(ejercicioEntrenamiento, index) in ejerciciosEntrenamiento" :key="ejercicioEntrenamiento.id" class="border-b border-gray-300">
                    <td-componente>
                        <template #td-contenido>{{ index + 1 }}</template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            {{ ejercicioEntrenamiento.dia_ejercicio.ejercicio.nombre }}
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.series">{{ ejercicioEntrenamiento.dia_ejercicio.series }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.repeticiones">{{ ejercicioEntrenamiento.dia_ejercicio.repeticiones }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.peso">{{ ejercicioEntrenamiento.dia_ejercicio.peso }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.rpe">{{ ejercicioEntrenamiento.dia_ejercicio.rpe }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.cadencia">{{ ejercicioEntrenamiento.dia_ejercicio.cadencia }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="ejercicioEntrenamiento.dia_ejercicio.descanso">{{ ejercicioEntrenamiento.dia_ejercicio.descanso }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <eliminar>
                                <template #contenido>
                                    <span @click="destroy(ejercicioEntrenamiento.id)">Eliminar</span>
                                </template>
                            </eliminar>
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
            entrenamiento: Object,
            ejerciciosEntrenamiento: Array,
        },

        methods: {
            destroy(ejercicio_entrenamiento_id) {
                if (confirm('¿Estás seguro de que deseas eliminar este ejercicio del entrenamiento?')) {
                    this.$inertia.delete(this.route('ejercicios-del-entrenamientos.destroy', [this.entrenamiento.id, ejercicio_entrenamiento_id]));
                }
            },
        }
    })
</script>
