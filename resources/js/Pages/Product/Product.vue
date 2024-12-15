<template>
  <AppLayout title="Productos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Productos
      </h2>
    </template>

    <div class="py-12">
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <Link :href="route('product.create')" class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary">Crear nuevo producto</button>
          </Link>


          <div class="card shadow-sm">
            <div class="card-body p-0">

              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Categoría</th>
                  <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id">
                  <td>{{ product.id }}</td>
                  <td>{{ product.nombre }}</td>
                  <td class="w-25 text-ellipsis">{{ product.descripcion }}</td>
                  <td>{{ product.precio }} Bs.</td>
                  <td>{{ product.categoria }}</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <Link :href="route('product.edit', {id: product.id})">
                        <button class="btn btn-warning btn-sm" @click="">
                          Modificar
                        </button>
                      </Link>

                      <button class="btn btn-danger btn-sm" @click="destroy(product.id)">
                        <i class="bi bi-trash me-1"></i>Eliminar
                      </button>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import {defineProps} from "vue";

defineProps({
  products: {
    type: Array,
    required: true,
  }
})

const destroy = (id) => {
  if (confirm('Desea Eliminar?')) {
    router.delete(route('product.destroy', id));
  }
};
</script>
