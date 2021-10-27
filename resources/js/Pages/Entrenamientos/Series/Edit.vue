<template>
    <teleport to="head">
        <title>Entrenamiento - {{ entrenamiento.fecha }} - {{ ejercicioEntrenamiento.dia_ejercicio.ejercicio.nombre }} - Editar serie</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='entrenamientos.index' :idsArray=[] bread='Mis entrenamientos' />
                <breadcrumb ruta='ejercicios-del-entrenamiento.index' :idsArray='[entrenamiento.id]' :bread='entrenamiento.fecha' />
                <breadcrumb ruta='series.index' :idsArray='[entrenamiento.id, ejercicioEntrenamiento.id]' 
                    :bread='ejercicioEntrenamiento.dia_ejercicio.ejercicio.nombre' />
                Editar serie
            </h2>
        </template>

        <form method="post" @submit.prevent="submit">
            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Repeticiones" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.repeticiones" autofocus/>
                        </template>
                    </estructura-input>

                    <estructura-input nombreLabel="Peso" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.peso"/>
                        </template>
                    </estructura-input>
                </template>
            </estructura-formulario>

            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="RPE" info="No es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.rpe"/>
                        </template>
                    </estructura-input>

                    <estructura-input nombreLabel="% 1RM" info="No es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.rm"/>
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
            entrenamiento: Object,
            ejercicioEntrenamiento: Object,
            serie: Object,
        },

        data() {
            return {
                form: {
                    repeticiones: this.serie.repeticiones,
                    peso: this.serie.peso,
                    rpe: this.serie.rpe,
                    rm: this.serie.rm,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('series.update', [this.entrenamiento.id, this.ejercicioEntrenamiento.id, this.serie.id]), this.form);
            },
        },
    })
</script>
