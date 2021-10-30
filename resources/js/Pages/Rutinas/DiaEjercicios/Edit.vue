<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Editar ejercicio</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                <breadcrumb ruta='dias.index' :idsArray='[rutina.id]' :bread='rutina.nombre' />
                <breadcrumb ruta='ejercicios-del-dia.index' :idsArray='[rutina.id, dia.id]' :bread='"Ejercicios del " + dia.nombre' />
                Editar ejercicio
            </h2>
        </template>

        <form method="post" @submit.prevent="submit">
                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Seleccionar ejercicio" info="Es obligatorio. Sino tiene ningun ejercicio cargado ve a la seccion 
                        'Ejercicios' que se encuentra arriba de todo en la pagina.">
                            <template #inputComponente>
                                <select v-model="form.ejercicio_id" autofocus>
                                    <option v-for="ejercicio in ejercicios" :key="ejercicio.id" :value="ejercicio.id">
                                        {{ ejercicio.nombre }}
                                    </option>
                                </select>
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Series" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.series" placeholder="Ejemplo: 4" />
                            </template>
                        </estructura-input>

                        <estructura-input nombreLabel="Repeticiones" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.repeticiones" placeholder="Ejemplo: 8-12" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Peso" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.peso" placeholder="Ejemplo: 27.50" />
                            </template>
                        </estructura-input>

                        <estructura-input nombreLabel="RPE" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.rpe" placeholder="Ejemplo: 8.5" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Cadencia" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.cadencia" placeholder="Ejemplo: 1.3.1" />
                            </template>
                        </estructura-input>

                        <estructura-input nombreLabel="Descanso" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.descanso" placeholder="Ejemplo: 3 minutos" />
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
    import EstructuraFormulario from '@/Shared/Formulario/EstructuraFormulario'
    import EstructuraInput from '@/Shared/Formulario/EstructuraInput'
    import InputComponente from '@/Shared/Formulario/InputComponente'
    import Guardar from '@/Shared/Botones/Guardar'
    import Breadcrumb from '@/Shared/Cabecera/Breadcrumb.vue';

    export default defineComponent({
        components: {
            AppLayout,
            EstructuraFormulario,
            EstructuraInput,
            InputComponente,
            Guardar,
            Breadcrumb,
        },

        props: {
            rutina: Object,
            dia: Object,
            ejercicios: Array,
            diaEjercicio: Object,
        },

        data() {
            return {
                form: {
                    ejercicio_id: this.diaEjercicio.ejercicio_id,
                    series: this.diaEjercicio.series,
                    repeticiones: this.diaEjercicio.repeticiones,
                    peso: this.diaEjercicio.peso,
                    rpe: this.diaEjercicio.rpe,
                    cadencia: this.diaEjercicio.cadencia,
                    descanso: this.diaEjercicio.descanso,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('ejercicios-del-dia.update', [this.rutina.id, this.dia.id, this.diaEjercicio.id]), this.form);
            },
        }
    })
</script>
