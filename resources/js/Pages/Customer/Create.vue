<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const form = reactive({
    nombres: null,
    apellidos: null,
    ci: null,
    email: null,
    telefono: null,
    direccion: null,
    fecha_nacimiento: null,
});

const submit = () => {
    console.log("holaaa")
    router.post('customer', form);
}
</script>

<template>
    <AppLayout title="Crear Cliente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Cliente
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg overflow-x-auto">

                    <form @submit.prevent="submit">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    Llena los campos del formulario
                                </h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="nombres">Nombres:</label>
                                        <input id="nombres" type="text" class="form-control" v-model="form.nombres">
                                    </div>
                                    <div class="col">
                                        <label for="nombres">Apellidos:</label>
                                        <input id="nombres" type="text" class="form-control" v-model="form.apellidos">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ci">CI:</label>
                                    <input id="ci" type="number" class="form-control" v-model="form.ci">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono">Teléfono:</label>
                                    <input for="telefono" type="number" class="form-control" v-model="form.telefono">
                                </div>

                                <div class="mb-3">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion" class="form-control" v-model="form.direccion">
                                </div>

                                <div class="mb-3">
                                    <label for="email">e-mail</label>
                                    <input type="text" id="email" class="form-control" v-model="form.email">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="text" id="fecha_nacimiento" class="form-control"
                                        v-model="form.fecha_nacimiento">
                                </div>


                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end m-2">
                                    <button class="btn btn-secondary col-2 mr-2">Cancelar</button>
                                    <button class="btn btn-primary col-2">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- </div> -->
    </AppLayout>

    <hr>


</template>