<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - Editar día "{{ diaRutina.nombre }}"</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                <breadcrumb ruta='dias.index' :idsArray='[rutina.id]' :bread='rutina.nombre' />
                Editar día "{{ diaRutina.nombre }}"
            </h2>
        </template>

        <form method="post" @submit.prevent="submit">
            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Nombre" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.nombre" autofocus />
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
            diaRutina: Object,
        },

        data() {
            return {
                form: {
                    nombre: this.diaRutina.nombre,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('dias.update', [this.rutina.id, this.diaRutina.id]), this.form);
            },
        }
    })
</script>
