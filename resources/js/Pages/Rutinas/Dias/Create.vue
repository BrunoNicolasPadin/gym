<template>
    <teleport to="head">
        <title>{{ rutina.nombre }} - Agregar días</title>
    </teleport>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <breadcrumb ruta='rutinas.index' :idsArray=[] bread='Mis rutinas' />
                    <breadcrumb ruta='dias.index' :idsArray='[rutina.id]' :bread='rutina.nombre' />
                    Agregar días
                </h2>
            </div>
        </template>

        <form method="post" @submit.prevent="submit">
            <div v-for="(form, index) in form.dias" :key="index" class="w-full">
                <estructura-formulario>
                    <template #estructuraInput>
                        <estructura-input nombreLabel="Nombre" info="Es obligatorio.">
                            <template #inputComponente>
                                <input-componente type="text" v-model="form.nombre" autofocus />
                            </template>
                        </estructura-input>
                    </template>
                </estructura-formulario>

                <estructura-formulario>
                    <template #estructuraInput>
                        <button 
                        @click="quitarDia(index)"
                        type="button" 
                        class="border border-red-500 bg-red-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-red-700 focus:outline-none focus:shadow-outline">
                            Quitar día
                        </button>
                    </template>
                </estructura-formulario>
            </div>

            <div class="flex justify-first">
                <button 
                @click="agregarOtroDia()"
                type="button" 
                class="border border-blue-500 bg-blue-500 text-white rounded-full px-4 py-2 my-8 transition duration-500 ease select-none hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Agregar día
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
        },

        data() {
            return {
                form: {
                    dias: [{
                        nombre: null,
                    }]
                },
            }
        },

        methods: {
            submit() {
                this.$inertia.post(this.route('dias.store', this.rutina.id), this.form);
            },

            agregarOtroDia() {
                this.form.dias.push({
                    nombre: null,
                });
            },

            quitarDia(index) {
                this.form.dias.splice(index, 1);
            },
        }
    })
</script>
