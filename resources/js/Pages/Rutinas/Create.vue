<template>
    <app-layout title="Mis rutinas - Crear">
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mis rutinas / 
                    Crear rutina
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Nombre" info="Es obligatorio.">
                        <template #inputComponente>
                            <input-componente type="text" v-model="form.nombre" />
                        </template>
                    </estructura-input>
                </template>
            </estructura-formulario>

            <estructura-formulario>
                <template #estructuraInput>
                    <estructura-input nombreLabel="Descripcion" info="No es obligatorio.">
                        <template #inputComponente>
                            <textarea 
                            class="bg-white rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" 
                            name="body" 
                            placeholder='Descripcion...' 
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
    import { Link } from '@inertiajs/inertia-vue3';
    import Agregar from '@/Shared/Botones/Agregar.vue'
    import EstructuraFormulario from '@/Shared/Formulario/EstructuraFormulario'
    import EstructuraInput from '@/Shared/Formulario/EstructuraInput'
    import InputComponente from '@/Shared/Formulario/InputComponente'
    import Guardar from '@/Shared/Botones/Guardar'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Agregar,
            EstructuraFormulario,
            EstructuraInput,
            InputComponente,
            Guardar,
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
