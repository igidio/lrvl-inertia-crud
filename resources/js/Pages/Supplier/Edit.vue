<template>
  <AppLayout title="Modificar proveedor">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Modificar proveedor
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg">

          <form @submit.prevent="submit">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-4">
                  Llena los campos del formulario
                </h5>
                <div class="row mb-3">
                  <div class="col">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" type="text" class="form-control capitalize"
                           v-model="form.nombre" @input="validateOne('nombre', form.nombre)">
                    <ErrorList :errors="errors.nombre" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="telefono">Teléfono:</label>
                    <input for="telefono" type="number" class="form-control" v-model="form.telefono"
                           @input="validateOne('telefono', form.telefono)">
                    <ErrorList :errors="errors.telefono" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="email">Correo electrónico:</label>
                    <input id="email" type="text" class="form-control" v-model="form.email"
                           @input="validateOne('email', form.email)">
                    <ErrorList :errors="errors.email" />
                  </div>
                </div>


              </div>
              <div class="card-footer">
                <div class="row justify-content-end m-2">
                  <Link :href="route('supplier.index')" class="btn btn-secondary col-2 mr-2">
                    Cancelar
                  </Link>
                  <button class="btn btn-primary col-2" type="submit"
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
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import ErrorList from "@/Components/ErrorList.vue";
import {ref} from "vue";
import {z} from "zod";

const props = defineProps({
  supplier: {
    type: Object,
    required: true,
  }
})

const formSchema = z.object({
  nombre: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'El nombre es requerido').regex(/^[a-zA-Z0-9\s]+$/, 'El nombre no es válido'),
  telefono: z.number({ invalid_type_error: 'Introduzca un número válido' }).min(100000, 'El número telefónico debe tener entre seis y ocho dígitos').max(999999999, 'El número telefónico debe tener entre seis y ocho dígitos'),
  email: z.string({ invalid_type_error: 'El campo está vacío' }).email('El correo no es válido'),
})

const form = ref({
  nombre: props.supplier.nombre,
  telefono: props.supplier.telefono * 1,
  email: props.supplier.email,
})

const errors = ref({});

const submit = async () => {
  validate();
  if (Object.keys(errors.value).length !== 0) return;
  router.put(`/supplier/${props.supplier.id}`, form.value);
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
