<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                    <breadcrumb ruta='dias.index' :idsArray='[rutina.id]' :bread='rutina.nombre' />
                    Ejercicios del {{ dia.nombre }}
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
                    <template #th-contenido>Editar</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Eliminar</template>
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
                            <editar>
                                <template #contenido>
                                    <Link :href="route('ejercicios-del-dia.edit', [rutina.id, dia.id, diaEjercicio.id])">
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
                                    <span @click="destroy(diaEjercicio.id)">Eliminar</span>
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
    import Breadcrumb from '@/Shared/Cabecera/Breadcrumb.vue';

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
            Breadcrumb,
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
