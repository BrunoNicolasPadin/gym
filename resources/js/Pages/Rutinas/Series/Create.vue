<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - {{ diaEjercicio.ejercicio.nombre }} Agregar series</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    {{ diaEjercicio.ejercicio.nombre }} /
                    Agregar series
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
            <div v-for="(form, index) in form.series" :key="index" class="w-full">
                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Numero de la serie (1, 2, 3, etc...)" info="Es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.numero" autofocus placeholder="1" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Repeticiones" info="Es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.repeticiones" placeholder="6" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Peso" info="Es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.peso" placeholder="27.50" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="RPE" info="No es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.rpe" placeholder="8.5" />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <button 
                        @click="quitarSerie(index)"
                        type="button" 
                        class="border border-red-500 bg-red-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-red-700 focus:outline-none focus:shadow-outline">
                            Quitar serie
                        </button>
                    </template>
                </estructura-formulario>
            </div>

            <div class="flex justify-first">
                <button 
                @click="agregarOtraSerie()"
                type="button" 
                class="border border-blue-500 bg-blue-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Agregar serie
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
            diaEjercicio: Object,
        },

        data() {
            return {
                form: {
                    series: [{
                        numero: null,
                        repeticiones: null,
                        peso: null,
                        rpe: null,
                    }]
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.post(this.route('series.store', [this.rutina.id, this.dia.id, this.diaEjercicio.id]), this.form);
            },

            agregarOtraSerie() {
                this.form.series.push({
                    numero: null,
                    repeticiones: null,
                    peso: null,
                    rpe: null,
                });
            },

            quitarSerie(index) {
                this.form.series.splice(index, 1);
            },
        }
    })
</script>
