<template>
    <teleport to="head">
        <title>Mis rutinas - Crear</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                Crear
            </h2>
        </template>

        <form method="post" @submit.prevent="submit">
            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Nombre" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.nombre" autofocus/>
                        </template>
                    </estructura-input>
                </template>
            </estructura-formulario>

            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Descripción" info="No es obligatorio.">
                        <template #inputComponente>
                            <textarea 
                            class="bg-white rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" 
                            name="body" 
                            placeholder='Descripción...' 
                            v-model="form.descripcion"/>
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

        data() {
            return {
                form: {
                    nombre: null,
                    descripcion: null,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.post(this.route('rutinas.store'), this.form);
            },
        }
    })
</script>
