<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - {{ dia.nombre }} - {{ diaEjercicio.ejercicio.nombre }} Editar serie</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ rutina.nombre }} /
                    {{ dia.nombre }} /
                    {{ diaEjercicio.ejercicio.nombre }} /
                    Editar serie
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
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
            serie: Object,
        },

        data() {
            return {
                form: {
                    numero: this.serie.numero,
                    repeticiones: this.serie.repeticiones,
                    peso: this.serie.peso,
                    rpe: this.serie.rpe,
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('series.update', [this.rutina.id, this.dia.id, this.diaEjercicio.id, this.serie.id]), this.form);
            },
        }
    })
</script>
