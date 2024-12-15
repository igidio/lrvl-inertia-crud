<template>
  <AppLayout title="Modificar producto">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Adicionar productos
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
                    <label for="proveedor">Proveedor:</label>
                    <select id="proveedor" class="form-control" v-model="form.proveedor_id"
                            @change="validateOne('proveedor_id', form.proveedor_id)">
                      <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                        {{ supplier.nombre }}
                      </option>
                    </select>
                    <ErrorList :errors="errors.proveedor_id" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="producto">Producto de Inventario:</label>
                    <select id="producto" class="form-control" v-model="form.inventario_id"
                            @change="validateOne('inventario_id', form.inventario_id)">
                      <option v-for="product in inventory_products" :key="product.id" :value="product.id">
                        {{ product.nombre }}
                      </option>
                    </select>
                    <ErrorList :errors="errors.inventario_id" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="cantidad">Cantidad:</label>
                    <input id="cantidad" type="number" class="form-control" v-model="form.cantidad"
                           @input="validateOne('cantidad', form.cantidad)">
                    <ErrorList :errors="errors.cantidad" />
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
  inventory_products: {
    type: Array,
    required: true,
  },
  suppliers: {
    type: Array,
    required: true,
  }
})

const formSchema = z.object({
  proveedor_id: z.number({ invalid_type_error: 'Seleccione un proveedor válido' }).min(1, 'El proveedor es requerido'),
  inventario_id: z.number({ invalid_type_error: 'Seleccione un producto válido' }).min(1, 'El producto es requerido'),
  cantidad: z.number({ invalid_type_error: 'Introduzca un número válido' }).min(1, 'La cantidad debe ser mayor o igual a 1'),
})

const form = ref({
  proveedor_id: '',
  inventario_id: '',
  cantidad: undefined,
})

const errors = ref({});

const submit = async () => {
  validate();
  if (Object.keys(errors.value).length !== 0) return;
  router.post(`/addition`, form.value);
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
