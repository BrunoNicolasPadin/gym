<template>
    <teleport to="head">
        <title>Mis ejercicios - Editar {{ ejercicio.nombre }}</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mis ejercicios /
                    Editar {{ ejercicio.nombre }}
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
                            <input-componente type="text" v-model="form.descripcion" />
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

    export default defineComponent({
        components: {
            AppLayout,
            EstructuraFormulario,
            EstructuraInput,
            InputComponente,
            Guardar,
        },

        props: {
            ejercicio: Object,
        },

        data() {
            return {
                form: {
                    nombre: this.ejercicio.nombre,
                    descripcion: this.ejercicio.descripcion,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('ejercicios.update', this.ejercicio.id), this.form);
            },
        }
    })
</script>
