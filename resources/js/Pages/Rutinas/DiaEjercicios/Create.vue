<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Agregar ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    Agregar ejercicios
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
            <div v-for="(form, index) in form.diaEjercicios" :key="index" class="w-full">
                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Seleccionar ejercicio" info="Es obligatorio. Sino tiene ningun ejercicio cargado ve a la seccion 
                        'Ejercicios' que se encuentra arriba de todo en la pagina.">
                            <template #inputComponente>
                                <select v-model="form.ejercicio_id" autofocus>
                                    <option value="" disabled>Seleccionar ejercicio</option>
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
                        <button 
                        @click="quitarEjercicio(index)"
                        type="button" 
                        class="border border-red-500 bg-red-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-red-700 focus:outline-none focus:shadow-outline">
                            Quitar ejercicio
                        </button>
                    </template>
                </estructura-formulario>
            </div>

            <div class="flex justify-first">
                <button 
                @click="agregarOtroEjercicio()"
                type="button" 
                class="border border-blue-500 bg-blue-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Agregar ejercicio
                </button>
            </div>

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
        },

        data() {
            return {
                form: {
                    diaEjercicios: [{
                        ejercicio_id: '',
                    }]
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.post(this.route('ejercicios-del-dia.store', [this.rutina.id, this.dia.id]), this.form);
            },

            agregarOtroEjercicio() {
                this.form.diaEjercicios.push({
                    ejercicio_id: '',
                });
            },

            quitarEjercicio(index) {
                this.form.diaEjercicios.splice(index, 1);
            },
        }
    })
</script>
