<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Cambiar ejercicio</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    Cambiar ejercicio
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Seleccionar ejercicio" info="Es obligatorio. Sino tiene ningun ejercicio cargado ve a la seccion 
                        'Ejercicios' que se encuentra arriba de todo en la pagina.">
                            <template #inputComponente>
                                <select v-model="form.ejercicio_id">
                                    <option v-for="ejercicio in ejercicios" :key="ejercicio.id" :value="ejercicio.id">
                                        {{ ejercicio.nombre }}
                                    </option>
                                </select>
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
    import EstructuraFormulario from '@/Shared/Formulario/EstructuraFormulario'
    import EstructuraInput from '@/Shared/Formulario/EstructuraInput'
    import InputComponente from '@/Shared/Formulario/InputComponente'
    import Guardar from '@/Shared/Botones/Guardar'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            EstructuraFormulario,
            EstructuraInput,
            InputComponente,
            Guardar,
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
