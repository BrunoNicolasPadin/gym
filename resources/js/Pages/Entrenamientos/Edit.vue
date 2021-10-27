<template>
    <app-layout title="Mis entrenamientos - Editar">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='entrenamientos.index' :idsArray=[] bread='Mis entrenamientos' />
                Editar
            </h2>
        </template>

        <form method="post" @submit.prevent="submit">
            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Fecha" info="Es obligatorio. Formato: DD-MM-AAAA.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.fecha" autofocus/>
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
        },

        data() {
            return {
                form: {
                    fecha: this.entrenamiento.fecha,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('entrenamientos.update', this.entrenamiento.id), this.form);
            },
        }
    })
</script>
