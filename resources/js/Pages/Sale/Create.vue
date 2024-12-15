<template>
  <AppLayout title="Crear Venta">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear Venta
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
                    <label for="cliente">Cliente:</label>
                    <select id="cliente" class="form-control" v-model="form.id_cliente"
                            @change="validateOne('id_cliente', form.id_cliente)">
                      <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                        {{ customer.nombres }} {{ customer.apellidos }}
                      </option>
                    </select>
                    <ErrorList :errors="errors.id_cliente"/>
                  </div>
                </div>


                <div class="row mb-3" v-for="(product, index) in form.productos" :key="index">
                  <div class="col">
                    <label :for="'producto-' + index">Producto:</label>
                    <select :id="'producto-' + index" class="form-control" v-model="product.id"
                            @change="updateTotal">
                      <option v-for="product in products" :key="product.id" :value="product.id">
                        {{ product.nombre }}
                      </option>
                    </select>

                    <span v-if="product.id" class="mr-4">Precio total del elemento: {{
                        (props.products.find(p => p.id === product.id).precio * product.cantidad).toFixed(2)
                      }} Bs.   </span>

                    <button type="button" class="btn btn-danger mt-4" @click="removeProduct(index)">Eliminar</button>

                  </div>
                  <div class="col">
                    <label :for="'cantidad-' + index">Cantidad:</label>
                    <input :id="'cantidad-' + index" type="number" class="form-control" v-model="product.cantidad"
                           @input="updateTotal">
                  </div>
                </div>
                <ErrorList :errors="errors.productos"/>

                <div class="row mb-3">
                  <div class="col">
                    <button type="button" class="btn btn-secondary" @click="addProduct">Agregar Producto</button>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col text-right">
                    <h5>Total: {{ total.toFixed(2) }} Bs.</h5>
                  </div>
                </div>

              </div>
              <div class="card-footer">
                <div class="row justify-content-end m-2">
                  <Link :href="route('sale.index')" class="btn btn-secondary col-2 mr-2">
                    Cancelar
                  </Link>
                  <button class="btn btn-primary col-2" type="submit"
                          :disabled="Object.keys(errors).length !== 0">Enviar
                  </button>
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
import {ref, computed} from "vue";
import {z} from "zod";

const removeProduct = (index) => {
  form.value.productos.splice(index, 1);
  updateTotal();
}

const props = defineProps({
  customers: {
    type: Array,
    required: true,
  },
  products: {
    type: Array,
    required: true,
  }
})

const formSchema = z.object({
  id_cliente: z.number({invalid_type_error: 'Seleccione un cliente válido'}).min(1, 'El cliente es requerido'),
  productos: z.array(z.object({
    id: z.number({invalid_type_error: 'Seleccione un producto válido'}).min(1, 'El producto es requerido'),
    cantidad: z.number({invalid_type_error: 'Introduzca un número válido'}).min(1, 'La cantidad debe ser mayor o igual a 1'),
  })).min(1, 'Debe agregar al menos un producto')
})

const form = ref({
  id_cliente: '',
  productos: [{id: '', cantidad: 1}],
})

const errors = ref({});

const total = computed(() => {
  return form.value.productos.reduce((sum, product) => {
    const producto = props.products.find(p => p.id === product.id);
    return sum + (producto ? producto.precio * product.cantidad : 0);
  }, 0);
});

const addProduct = () => {
  form.value.productos.push({id: '', cantidad: 1});
}

const submit = async () => {
  validate();
  if (Object.keys(errors.value).length !== 0) return;
  router.post(`/sale`, {
    ...form.value,
    total: total.value,
  });
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

const updateTotal = () => {
  total.value;
}
</script>
