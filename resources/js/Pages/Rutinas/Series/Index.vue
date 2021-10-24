<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - {{ diaEjercicio.ejercicio.nombre }} - Series</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    {{ diaEjercicio.ejercicio.nombre }} /
                    Series
                </h2>
                <div class="flex justify-end">
                    <agregar>
                        <template #link>
                            <Link :href="route('series.create', [rutina.id, dia.id, diaEjercicio.id])">
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
                    <template #th-contenido>Repeticiones</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Peso</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>RPE</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Editar</template>
                </th-componente>

                <th-componente>
                    <template #th-contenido>Eliminar</template>
                </th-componente>
            </template>

            <template #tr>
                <tr v-for="serie in series" :key="serie.id" class="border-b border-gray-300">
                    <td-componente>
                        <template #td-contenido>{{ serie.numero }}</template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            {{ serie.repeticiones }}
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            {{ serie.peso }}
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            {{ serie.rpe }}
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <editar>
                                <template #contenido>
                                    <Link :href="route('series.edit', [rutina.id, dia.id, diaEjercicio.id, serie.id])">
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
                                    <span @click="destroy(serie.id)">Eliminar</span>
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
            rutina: Object,
            dia: Object,
            diaEjercicio: Object,
            series: Array,
        },

        methods: {
            destroy(serie_id) {
                if (confirm('¿Estás seguro de que deseas eliminar esta serie?')) {
                    this.$inertia.delete(this.route('series.destroy', [this.rutina.id, this.dia.id, this.diaEjercicio.id, serie_id]));
                }
            }
        }
    })
</script>
