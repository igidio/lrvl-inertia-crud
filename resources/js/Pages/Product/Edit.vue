<template>
  <AppLayout title="Modificar producto">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Modificar producto
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
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" type="text" class="form-control"
                           v-model="form.descripcion" @input="validateOne('descripcion', form.descripcion)">
                    <ErrorList :errors="errors.descripcion" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="precio">Precio:</label>
                    <input id="precio" type="number" class="form-control" v-model="form.precio" step=".01"
                           @input="validateOne('precio', form.precio)">
                    <ErrorList :errors="errors.precio" />
                  </div>
                </div>


                <div class="row mb-3">
                  <div class="col">
                    <label for="id_categoria">Categoría:</label>
                    <select id="id_categoria" class="form-control" v-model="form.id_categoria"
                            @change="validateOne('id_categoria', form.id_categoria)">

                      <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.nombre }}
                      </option>
                    </select>
                    <ErrorList :errors="errors.id_categoria" />
                  </div>
                </div>

              </div>
              <div class="card-footer">
                <div class="row justify-content-end m-2">
                  <Link :href="route('product.index')" class="btn btn-secondary col-2 mr-2">
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
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import ErrorList from "@/Components/ErrorList.vue";
import {ref} from "vue";
import {z} from "zod";

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array,
    required: true,
  }
})

const formSchema = z.object({
  nombre: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'El nombre es requerido').regex(/^[a-zA-Z0-9\s]+$/, 'El nombre no es válido'),
  descripcion: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'La descripción es requerida'),
  precio: z.number({ invalid_type_error: 'Introduzca un número válido' }).min(0, 'El precio debe ser mayor o igual a 0'),
  id_categoria: z.number({ invalid_type_error: 'Seleccione una categoría válida' }).min(1, 'La categoría es requerida'),
})

const form = ref({
  nombre: props.product.nombre,
  descripcion: props.product.descripcion,
  precio: props.product.precio * 1,
  id_categoria: props.product.id_categoria,
})

const errors = ref({});

const submit = async () => {
  validate();
  if (Object.keys(errors.value).length !== 0) return;
  router.put(`/product/${props.product.id}`, form.value);
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
