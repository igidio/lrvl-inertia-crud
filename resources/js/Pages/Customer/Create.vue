<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive, ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { z } from 'zod';
import ErrorList from '@/Components/ErrorList.vue'

const onlyLettersRegex = /^[a-zA-Z]*$/;

const formSchema = z.object({
    nombres: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'Los nombres son requeridos').regex(onlyLettersRegex, 'El nombre no es válido'),
    apellidos: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'Los apellidos son requeridos').regex(onlyLettersRegex, 'El apellido no es válido'),
    ci: z.number({ invalid_type_error: 'CI: Un número es requerido para este campo' }).min(100000, 'El carnet introducido no es válido').max(999999999, 'El carnet introducido no es válido'),
    email: z.string({ invalid_type_error: 'El campo está vacío' }).email('El correo no es válido'),
    telefono: z.number({ invalid_type_error: 'El campo está vacío' }).min(1000000, 'El número telefónico no es válido').max(999999999, 'El número telefónico no es válido'),
    direccion: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'La dirección es requerida'),
    fecha_nacimiento: z.date({ invalid_type_error: 'El campo está vacío' }),
});


const form = ref({
    nombres: null,
    apellidos: null,
    ci: null,
    email: null,
    telefono: null,
    direccion: null,
    fecha_nacimiento: null,
});

const errors = ref({});
const submit = async () => {
    validate();
    if (errors.value) return;
    router.post('customer', form.value);
}

const validate = () => {
    try {
        formSchema.parse(form.value);
        errors.value = {};
    } catch (error) {
        if (error instanceof z.ZodError) {
            errors.value = error.flatten().fieldErrors;
        }
    }
}

const validateOne = (field, value) => {
    try {
        formSchema.shape[field].parse(value);
        delete errors.value[field]
    } catch (error) {
        if (error instanceof z.ZodError) {
            errors.value[field] = error.flatten().formErrors;
        }
    }
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
                                        <input id="nombres" type="text" class="form-control capitalize"
                                            v-model="form.nombres" @input="validateOne('nombres', form.nombres)">
                                        <ErrorList :errors="errors.nombres" />
                                    </div>
                                    <div class="col">
                                        <label for="apellidos">Apellidos:</label>
                                        <input id="apellidos" type="text" class="form-control capitalize"
                                            v-model="form.apellidos" @input="validateOne('apellidos', form.apellidos)">
                                        <ErrorList :errors="errors.apellidos" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="ci">CI:</label>
                                    <input id="ci" type="number" class="form-control" v-model="form.ci"
                                        @input="validateOne('ci', form.ci)">
                                    <ErrorList :errors="errors.ci" />
                                </div>
                                <div class="mb-3">
                                    <label for="telefono">Teléfono:</label>
                                    <input for="telefono" type="number" class="form-control" v-model="form.telefono"
                                        @input="validateOne('telefono', form.telefono)">
                                    <ErrorList :errors="errors.telefono" />
                                </div>

                                <div class="mb-3">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion" class="form-control" v-model="form.direccion"
                                        @input="validateOne('direccion', form.direccion)">
                                    <ErrorList :errors="errors.direccion" />
                                </div>

                                <div class="mb-3">
                                    <label for="email">e-mail</label>
                                    <input type="text" id="email" class="form-control" v-model="form.email"
                                        @input="validateOne('email', form.email)">
                                    <ErrorList :errors="errors.email" />
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="text" id="fecha_nacimiento" class="form-control"
                                        v-model="form.fecha_nacimiento">
                                    <ErrorList :errors="errors.fecha_nacimiento" />
                                </div>


                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end m-2">
                                    <button class="btn btn-secondary col-2 mr-2">Cancelar</button>
                                    <button class="btn btn-primary col-2"
                                        :disabled="Object.keys(errors).length !== 0">Enviar</button>
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