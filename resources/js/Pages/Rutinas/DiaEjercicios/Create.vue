<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - Agregar ejercicios</title>
    </teleport>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                <breadcrumb ruta='dias.index' :idsArray='[rutina.id]' :bread='rutina.nombre' />
                <breadcrumb ruta='ejercicios-del-dia.index' :idsArray='[rutina.id, dia.id]' :bread='"Ejercicios del " + dia.nombre' />
                Agregar ejercicios
            </h2>
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

                <estructura-formulario class="flex justify-end">
                    <template #estructuraInput>
                        <button 
                        @click="quitarEjercicio(index)"
                        type="button" 
                        class="border border-red-500 bg-red-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-red-700 focus:outline-none focus:shadow-outline">
                            Quitar ejercicio
                        </button>
                    </template>
                </estructura-formulario>

                <hr class="p-px bg-black">
            </div>


            <div class="flex justify-end">
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
    import Breadcrumb from '@/Shared/Cabecera/Breadcrumb.vue';

    export default defineComponent({
        components: {
            AppLayout,
            Link,
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
        },

        data() {
            return {
                form: {
                    diaEjercicios: [{
                        ejercicio_id: '',
                        series: null,
                        repeticiones: null,
                        peso: null,
                        rpe: null,
                        cadencia: null,
                        descanso: null,
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
                    series: null,
                    repeticiones: null,
                    peso: null,
                    rpe: null,
                    cadencia: null,
                    descanso: null,
                });
            },

            quitarEjercicio(index) {
                this.form.diaEjercicios.splice(index, 1);
            },
        }
    })
</script>
