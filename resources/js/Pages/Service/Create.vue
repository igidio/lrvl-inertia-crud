<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import { z } from 'zod';
import ErrorList from '@/Components/ErrorList.vue'

const pricesRegex = /^\d+(\.\d{1,2})?$/;

const formSchema = z.object({
    nombre: z.string({ invalid_type_error: 'El campo está vacío' }),
    descripcion: z.string({ invalid_type_error: 'El campo está vacío' }),
    duracion: z.number({
        invalid_type_error: 'Un número es requerido para este campo'
    })
        .positive('El valor introducido debe ser positivo')
        .min(1, 'El tiempo de duración introducido no es válido')
        .max(999, 'El tiempo de duración introducido no es válido'),
    precio: z.number({ invalid_type_error: 'El campo numérico está vacío' })
        .positive('El valor introducido debe ser positivo')
        .max(9999.99, 'El precio introducido no es válido')
        .refine((precio) => /^(\d+)(\.\d{2})?$/.test(precio.toString()), {
            message: "El precio debe ser un número positivo con cero o dos decimales.",
        })

})

const form = ref({
    nombre: null,
    descripcion: null,
    duracion: null,
    precio: null,
});

const errors = ref({});
const submit = async () => {
    validate();
    if (Object.keys(errors.value).length !== 0) return;
    await router.post('/service', form.value);
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
    <AppLayout title="Crear Servicio">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Servicio
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

                                        <div class="mb-3">
                                            <label for="nombres">Nombre de servicio:</label>
                                            <input id="nombre" type="text" class="form-control capitalize"
                                                v-model="form.nombre" @input="validateOne('nombre', form.nombre)">
                                            <ErrorList :errors="errors.nombre" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion">Descripción:</label>
                                            <textarea id="descripcion" type="text" class="form-control"
                                                v-model="form.descripcion"
                                                @input="validateOne('descripcion', form.descripcion)" />
                                            <ErrorList :errors="errors.descripcion" />
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col">
                                                <label for="duracion">Duración (en minutos)</label>
                                                <input id="duracion" type="number" class="form-control capitalize"
                                                    v-model="form.duracion"
                                                    @input="validateOne('duracion', form.duracion)">
                                                <ErrorList :errors="errors.duracion" />
                                            </div>
                                            <div class="col">
                                                <label for="precio">Precio</label>
                                                <input id="precio" type="number" class="form-control"
                                                    v-model="form.precio" @input="validateOne('precio', form.precio)">
                                                <ErrorList :errors="errors.precio" />
                                            </div>
                                        </div>


                                    </div>

                                </div>







                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end m-2">
                                    <Link :href="route('customer.index')" class="btn btn-secondary col-2 mr-2">
                                    Cancelar
                                    </Link>
                                    <button class="btn btn-primary col-2"
                                        :disabled="Object.keys(errors).length !== 0">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </AppLayout>
</template>