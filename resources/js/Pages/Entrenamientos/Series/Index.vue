<template>
    <teleport to="head">
        <title>Entrenamiento - {{ entrenamiento.fecha }} - {{ ejercicioEntrenamiento.dia_ejercicio.ejercicio.nombre }} - Series</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='entrenamientos.index' :idsArray=[] bread='Mis entrenamientos' />
                <breadcrumb ruta='ejercicios-del-entrenamiento.index' :idsArray='[entrenamiento.id]' :bread='entrenamiento.fecha' />
                Series de {{ ejercicioEntrenamiento.dia_ejercicio.ejercicio.nombre }}
            </h2>
        </template>

        <estructura-tabla>
            <template #head>
                <th-componente>
                    <template #th-contenido>Serie</template>
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
                    <template #th-contenido>% 1RM</template>
                </th-componente>

                <th-componente colspan=2>
                    <template #th-contenido>Acciones</template>
                </th-componente>
            </template>

            <template #tr>
                <tr v-for="(serie, index) in series" :key="serie.id" class="border-b border-gray-300">
                    <td-componente>
                        <template #td-contenido>{{ index + 1 }}</template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="serie.repeticiones">{{ serie.repeticiones }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="serie.peso">{{ serie.peso }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="serie.rpe">{{ serie.rpe }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <span v-if="serie.rm">{{ serie.rm }}</span>
                            <span v-else>-</span>
                        </template>
                    </td-componente>

                    <td-componente>
                        <template #td-contenido>
                            <editar>
                                <template #contenido>
                                    <Link :href="route('series.edit', [entrenamiento.id, ejercicioEntrenamiento.id, serie.id])">
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

        <hr class="bg-black p-px my-3">

        <form method="post" @submit.prevent="submit">

            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Repeticiones" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.repeticiones" autofocus placeholder="Ejemplo: 8" />
                        </template>
                    </estructura-input>

                    <estructura-input nombreLabel="Peso" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.peso" placeholder="Ejemplo: 27.50" />
                        </template>
                    </estructura-input>
                </template>
            </estructura-formulario>

            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="RPE" info="No es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.rpe" placeholder="Ejemplo: 8.5" />
                        </template>
                    </estructura-input>

                    <estructura-input nombreLabel="% 1RM" info="No es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.rm" placeholder="Ejemplo: 82.5" />
                        </template>
                    </estructura-input>
                </template>
            </estructura-formulario>

            <guardar />
        </form>
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
    import EstructuraFormulario from '@/Shared/Formulario/EstructuraFormulario'
    import EstructuraInput from '@/Shared/Formulario/EstructuraInput'
    import InputComponente from '@/Shared/Formulario/InputComponente'
    import Guardar from '@/Shared/Botones/Guardar'
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
            EstructuraFormulario,
            EstructuraInput,
            InputComponente,
            Guardar,
            Breadcrumb,
        },

        props: {
            entrenamiento: Object,
            ejercicioEntrenamiento: Object,
            series: Array,
        },

        data() {
            return {
                form: {
                    repeticiones: null,
                    peso: null,
                    rpe: null,
                    rm: null,
                },
            }
        },

        methods: {
            destroy(serie_id) {
                if (confirm('¿Estás seguro de que deseas eliminar esta serie?')) {
                    this.$inertia.delete(this.route('series.destroy', [this.entrenamiento.id, this.ejercicioEntrenamiento.id, serie_id]));
                }
            },

            submit() {
                this.$inertia.post(this.route('series.store', [this.entrenamiento.id, this.ejercicioEntrenamiento.id]), this.form);
                this.form.repeticiones = null
                this.form.peso = null
                this.form.rpe = null
                this.form.rm = null
            },
        }
    })
</script>
